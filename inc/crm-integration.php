<?php
/**
 * Integração de Captura de Leads via REST API e AJAX do WordPress (ATA Premium)
 * 
 * Endpoints:
 * - POST /wp-json/atapremium/v1/lead (Principal REST)
 * - POST /wp-json/api/v1/lead (Retrocompatibilidade)
 * - POST /wp-admin/admin-ajax.php?action=atapremium_lead (Fallback AJAX Universal)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Garante carregamento do banco de dados
require_once get_template_directory() . '/inc/lead-database.php';

// Garante que o endpoint público de captura de leads nunca seja bloqueado por verificação de cookies/nonce
add_filter( 'rest_authentication_errors', function( $result ) {
    $current_uri = $_SERVER['REQUEST_URI'] ?? '';
    if ( strpos( $current_uri, '/atapremium/v1/lead' ) !== false || 
         strpos( $current_uri, '/api/v1/lead' ) !== false ) {
        return true; // Bypass seguro para rota pública de leads
    }
    return $result;
}, 5 );

add_action( 'rest_api_init', function () {
    // Rota Principal da ATA Premium
    register_rest_route( 'atapremium/v1', '/lead', array(
        'methods'             => 'POST',
        'callback'            => 'atapremium_process_rest_lead',
        'permission_callback' => '__return_true',
    ) );

    // Alias de retrocompatibilidade
    register_rest_route( 'api/v1', '/lead', array(
        'methods'             => 'POST',
        'callback'            => 'atapremium_process_rest_lead',
        'permission_callback' => '__return_true',
    ) );
} );

/**
 * Processa a submissão de lead via REST API
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function atapremium_process_rest_lead( $request ) {
    $params = $request->get_json_params();
    if ( empty( $params ) ) {
        $params = $request->get_params();
    }

    // Sanitização e Normalização de Dados
    $nome     = sanitize_text_field( $params['nome'] ?? '' );
    $telefone = sanitize_text_field( $params['telefone'] ?? '' );
    $email    = sanitize_email( $params['email'] ?? '' );
    $unidade  = atapremium_normalize_unit( $params['unidade'] ?? 'Central' );
    $programa = sanitize_text_field( $params['programa'] ?? ( $params['faixa_etaria'] ?? '' ) );
    $origem   = atapremium_normalize_origin( $params['origem'] ?? 'whatsapp_modal' );

    // Parâmetros de UTM (Rastreamento de Tráfego)
    $utm_source   = sanitize_text_field( $params['utm_source'] ?? '' );
    $utm_medium   = sanitize_text_field( $params['utm_medium'] ?? '' );
    $utm_campaign = sanitize_text_field( $params['utm_campaign'] ?? '' );
    $utm_content  = sanitize_text_field( $params['utm_content'] ?? '' );
    $utm_term     = sanitize_text_field( $params['utm_term'] ?? '' );

    // Se a empresa foi enviada (campo legado do formulário home), extrai programa/unidade se vazios
    if ( ! empty( $params['empresa'] ) ) {
        $empresa_str = sanitize_text_field( $params['empresa'] );
        if ( empty( $programa ) && strpos( $empresa_str, 'Faixa:' ) !== false ) {
            $parts = explode( '|', $empresa_str );
            foreach ( $parts as $part ) {
                if ( strpos( $part, 'Faixa:' ) !== false ) {
                    $programa = trim( str_replace( 'Faixa:', '', $part ) );
                }
            }
        }
    }

    // Validação básica obrigatória: Nome e Telefone
    if ( empty( $nome ) || empty( $telefone ) ) {
        return new WP_REST_Response( array(
            'success' => false,
            'message' => 'Por favor, informe seu nome e número de WhatsApp.'
        ), 400 );
    }

    // Captura IP e User Agent
    $ip = '';
    if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] )[0];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    }
    $ip = sanitize_text_field( $ip );
    $user_agent = sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' );

    // 1. Grava no banco de dados personalizado
    $lead_data = array(
        'nome'         => $nome,
        'telefone'     => $telefone,
        'email'        => $email,
        'unidade'      => $unidade,
        'programa'     => $programa,
        'origem'       => $origem,
        'utm_source'   => $utm_source,
        'utm_medium'   => $utm_medium,
        'utm_campaign' => $utm_campaign,
        'utm_content'  => $utm_content,
        'utm_term'     => $utm_term,
        'ip'           => $ip,
        'user_agent'   => $user_agent,
        'status'       => 'Novo'
    );

    $lead_id = atapremium_insert_lead( $lead_data );

    // 2. Mapeamento de Telefones Oficiais das Unidades
    $wpp_numbers = array(
        'Alves de Brito'      => '5548999313558',
        'Colégio Catarinense' => '5548999313558',
        'Spotmarkt'           => '5548999313558',
        'Central'             => '5548999313558',
    );

    $target_number = $wpp_numbers[ $unidade ] ?? '5548999313558';

    // 3. Montagem da Mensagem Personalizada do WhatsApp
    $programa_text = ! empty( $programa ) && $programa !== 'Não informada' ? " (Interesse: *{$programa}*)" : '';
    $wpp_msg = "Olá! Meu nome é *{$nome}*. Gostaria de agendar uma Aula Experimental Gratuita na Unidade *{$unidade}*{$programa_text}. Vim pelo site da ATA Premium.";
    $wpp_redirect_url = "https://wa.me/{$target_number}?text=" . rawurlencode( $wpp_msg );

    return new WP_REST_Response( array(
        'success'      => true,
        'lead_id'      => $lead_id ? $lead_id : 0,
        'message'      => 'Lead registrado com sucesso!',
        'redirect_url' => $wpp_redirect_url,
        'unidade'      => $unidade,
        'nome'         => $nome
    ), 200 );
}

/**
 * Fallback universal via AJAX do WordPress (admin-ajax.php)
 */
function atapremium_handle_ajax_lead() {
    $raw_input = file_get_contents( 'php://input' );
    $data = array();
    if ( ! empty( $raw_input ) ) {
        $json = json_decode( $raw_input, true );
        if ( is_array( $json ) ) {
            $data = $json;
        }
    }
    if ( empty( $data ) ) {
        $data = $_POST;
    }

    $request = new WP_REST_Request( 'POST', '/atapremium/v1/lead' );
    foreach ( $data as $k => $v ) {
        $request->set_param( $k, $v );
    }

    $response = atapremium_process_rest_lead( $request );
    $status = $response->get_status();
    $response_data = $response->get_data();

    wp_send_json( $response_data, $status );
}
add_action( 'wp_ajax_nopriv_atapremium_lead', 'atapremium_handle_ajax_lead' );
add_action( 'wp_ajax_atapremium_lead', 'atapremium_handle_ajax_lead' );
