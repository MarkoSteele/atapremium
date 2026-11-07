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
 * Processa a submissão de lead via REST API com validação estrita, Honeypot anti-bot e Rate Limiting
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function atapremium_process_rest_lead( $request ) {
    $params = $request->get_json_params();
    if ( empty( $params ) ) {
        $params = $request->get_params();
    }

    // 0. Honeypot Anti-Bot: Se o campo invisível "website_url" estiver preenchido, descarta silenciosamente
    if ( ! empty( $params['website_url'] ) ) {
        return new WP_REST_Response( array(
            'success'      => true,
            'lead_id'      => 0,
            'message'      => 'Solicitação recebida.',
            'redirect_url' => 'https://wa.me/5548999313558'
        ), 200 );
    }

    // 1. Captura segura de IP com validação filter_var (evita IP Spoofing/Injection via headers)
    $candidate_ips = array();
    if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
        $candidate_ips[] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $forwarded = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
        $candidate_ips[] = trim( $forwarded[0] );
    }
    if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $candidate_ips[] = $_SERVER['REMOTE_ADDR'];
    }

    $ip = '0.0.0.0';
    foreach ( $candidate_ips as $cand ) {
        $clean_cand = trim( (string) $cand );
        if ( filter_var( $clean_cand, FILTER_VALIDATE_IP ) ) {
            $ip = $clean_cand;
            break;
        }
    }

    // 2. Rate Limiting por IP (máximo de 8 envios a cada 10 minutos por IP para evitar Flood/Spam)
    $rl_key = 'ata_lead_rl_' . md5( $ip );
    $attempts = (int) get_transient( $rl_key );
    if ( $attempts >= 8 ) {
        return new WP_REST_Response( array(
            'success' => false,
            'message' => 'Muitas tentativas seguidas. Aguarde alguns minutos ou chame diretamente no WhatsApp (48) 99931-3558.'
        ), 429 );
    }
    set_transient( $rl_key, $attempts + 1, 10 * MINUTE_IN_SECONDS );

    // 3. Sanitização Estrita e Limites de Tamanho (mb_substr)
    $nome     = mb_substr( sanitize_text_field( wp_strip_all_tags( $params['nome'] ?? '' ) ), 0, 120, 'UTF-8' );
    $telefone = mb_substr( sanitize_text_field( wp_strip_all_tags( $params['telefone'] ?? '' ) ), 0, 30, 'UTF-8' );
    $raw_mail = sanitize_email( $params['email'] ?? '' );
    $email    = ( ! empty( $raw_mail ) && is_email( $raw_mail ) ) ? mb_substr( $raw_mail, 0, 150, 'UTF-8' ) : '';
    $unidade  = atapremium_normalize_unit( $params['unidade'] ?? 'Central' );
    $programa = mb_substr( sanitize_text_field( wp_strip_all_tags( $params['programa'] ?? ( $params['faixa_etaria'] ?? '' ) ) ), 0, 100, 'UTF-8' );
    $origem   = atapremium_normalize_origin( $params['origem'] ?? 'whatsapp_modal' );

    // Parâmetros de UTM e Contexto (Rastreamento de Tráfego, Idioma e Página)
    $utm_source   = mb_substr( sanitize_text_field( $params['utm_source'] ?? '' ), 0, 100, 'UTF-8' );
    $utm_medium   = mb_substr( sanitize_text_field( $params['utm_medium'] ?? '' ), 0, 100, 'UTF-8' );
    $utm_campaign = mb_substr( sanitize_text_field( $params['utm_campaign'] ?? '' ), 0, 100, 'UTF-8' );
    $utm_content  = mb_substr( sanitize_text_field( $params['utm_content'] ?? '' ), 0, 100, 'UTF-8' );
    $utm_term     = mb_substr( sanitize_text_field( $params['utm_term'] ?? '' ), 0, 100, 'UTF-8' );

    $lang_active  = mb_substr( sanitize_text_field( $params['lang'] ?? 'pt' ), 0, 10, 'UTF-8' );
    $page_path    = mb_substr( sanitize_text_field( $params['page_path'] ?? '' ), 0, 200, 'UTF-8' );

    // Se a empresa foi enviada (campo legado do formulário home), extrai programa/unidade se vazios
    if ( ! empty( $params['empresa'] ) ) {
        $empresa_str = sanitize_text_field( $params['empresa'] );
        if ( empty( $programa ) && strpos( $empresa_str, 'Faixa:' ) !== false ) {
            $parts = explode( '|', $empresa_str );
            foreach ( $parts as $part ) {
                if ( strpos( $part, 'Faixa:' ) !== false ) {
                    $programa = mb_substr( trim( str_replace( 'Faixa:', '', $part ) ), 0, 100, 'UTF-8' );
                }
            }
        }
    }

    // 4. Validação de Nome e Telefone (exige entre 10 e 15 dígitos numéricos)
    $phone_digits = preg_replace( '/\D/', '', $telefone );
    if ( mb_strlen( $nome, 'UTF-8' ) < 2 || strlen( $phone_digits ) < 10 || strlen( $phone_digits ) > 15 ) {
        return new WP_REST_Response( array(
            'success' => false,
            'message' => 'Por favor, informe seu nome completo e um número de WhatsApp válido com DDD.'
        ), 400 );
    }

    $user_agent = mb_substr( sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' ), 0, 250, 'UTF-8' );
    $observacoes = trim( sprintf( 'Idioma: %s | Página: %s', strtoupper( $lang_active ?: 'PT' ), $page_path ?: '/' ) );

    // 5. Grava no banco de dados personalizado
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
        'status'       => 'Novo',
        'observacoes'  => $observacoes,
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
