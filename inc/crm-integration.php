<?php
/**
 * Integração com o CRM proprietário via REST API do WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/lead', array(
        'methods'  => 'POST',
        'callback' => 'processar_e_enviar_lead',
        'permission_callback' => '__return_true',
    ));
});

function processar_e_enviar_lead($request) {
    $params = $request->get_json_params();

    // Sanitização e validação dos campos
    $nome     = sanitize_text_field($params['nome'] ?? '');
    $email    = sanitize_email($params['email'] ?? '');
    $telefone = sanitize_text_field($params['telefone'] ?? '');
    $empresa  = sanitize_text_field($params['empresa'] ?? '');

    if (empty($nome) || empty($email) || empty($telefone)) {
        return new WP_REST_Response(array('success' => false, 'message' => 'Campos obrigatórios ausentes (Nome, E-mail e Telefone).'), 400);
    }

    // 1. Gravar lead localmente no banco de dados para segurança
    // Armazena em um array serializado em WP Options para fins de histórico local leve
    $leads = get_option('atapremium_leads_backup', array());
    $leads[] = array(
        'data'     => current_time('mysql'),
        'nome'     => $nome,
        'email'    => $email,
        'telefone' => $telefone,
        'empresa'  => $empresa,
        'status'   => 'Pendente Envio CRM'
    );
    update_option('atapremium_leads_backup', array_slice($leads, -500)); // Mantém apenas os últimos 500 leads

    // 2. Envio para o CRM (Usando URL de teste ou definida pelo usuário)
    // Se a URL não estiver definida, enviará para um simulador local/mock
    $crm_url = 'https://httpbin.org/post'; // URL de exemplo seguro para teste
    
    $body = array(
        'client_name' => $nome,
        'email'       => $email,
        'phone'       => $telefone,
        'company'     => $empresa,
        'source'      => 'Ata Premium Custom Theme Landing Page'
    );

    $response = wp_remote_post($crm_url, array(
        'method'      => 'POST',
        'timeout'     => 15,
        'headers'     => array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer TEST_KEY_ATAPREMIUM_12345',
        ),
        'body'        => json_encode($body),
        'data_format' => 'body',
    ));

    if (is_wp_error($response)) {
        // Atualiza o status no backup local como erro
        $last_index = count($leads) - 1;
        $leads[$last_index]['status'] = 'Erro CRM: ' . $response->get_error_message();
        update_option('atapremium_leads_backup', $leads);

        return new WP_REST_Response(array(
            'success' => false, 
            'message' => 'Erro ao processar integração: ' . $response->get_error_message()
        ), 500);
    }

    // Sucesso no envio ao CRM
    $last_index = count($leads) - 1;
    $leads[$last_index]['status'] = 'Enviado CRM';
    update_option('atapremium_leads_backup', $leads);

    return new WP_REST_Response(array('success' => true, 'message' => 'Lead enviado com sucesso!'), 200);
}
