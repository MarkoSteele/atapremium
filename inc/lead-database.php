<?php
/**
 * Gerenciamento de Banco de Dados de Leads da ATA Premium
 * 
 * Cria a tabela personalizada wp_atapremium_leads e fornece funções de CRUD e estatísticas.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Cria ou atualiza a tabela de leads no banco de dados
 */
function atapremium_create_leads_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        nome VARCHAR(150) NOT NULL,
        telefone VARCHAR(30) NOT NULL,
        email VARCHAR(150) NULL DEFAULT '',
        unidade VARCHAR(100) NOT NULL DEFAULT 'Central',
        programa VARCHAR(100) NULL DEFAULT '',
        origem VARCHAR(50) NOT NULL DEFAULT 'whatsapp_modal',
        utm_source VARCHAR(100) NULL DEFAULT '',
        utm_medium VARCHAR(100) NULL DEFAULT '',
        utm_campaign VARCHAR(100) NULL DEFAULT '',
        utm_content VARCHAR(100) NULL DEFAULT '',
        utm_term VARCHAR(100) NULL DEFAULT '',
        ip VARCHAR(45) NULL DEFAULT '',
        user_agent VARCHAR(255) NULL DEFAULT '',
        status VARCHAR(50) NOT NULL DEFAULT 'Novo',
        observacoes TEXT NULL,
        PRIMARY KEY  (id),
        KEY unidade_idx (unidade),
        KEY status_idx (status),
        KEY data_hora_idx (data_hora),
        KEY origem_idx (origem)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
add_action( 'after_setup_theme', 'atapremium_create_leads_table' );

/**
 * Normaliza o nome da unidade para padrão do sistema
 */
function atapremium_normalize_unit( $raw ) {
    $u = mb_strtolower( (string) $raw, 'UTF-8' );
    if ( strpos( $u, 'alves' ) !== false || strpos( $u, 'brito' ) !== false ) {
        return 'Alves de Brito';
    }
    if ( strpos( $u, 'catarinense' ) !== false || strpos( $u, 'colegio' ) !== false ) {
        return 'Colégio Catarinense';
    }
    if ( strpos( $u, 'spot' ) !== false || strpos( $u, 'markt' ) !== false || strpos( $u, 'corrego' ) !== false ) {
        return 'Spotmarkt';
    }
    return 'Central';
}

/**
 * Normaliza a origem do lead
 */
function atapremium_normalize_origin( $raw ) {
    $o = strtolower( (string) $raw );
    if ( strpos( $o, 'whatsapp' ) !== false || strpos( $o, 'modal' ) !== false || strpos( $o, 'wpp' ) !== false ) {
        return 'whatsapp_modal';
    }
    if ( strpos( $o, 'home' ) !== false || strpos( $o, 'form' ) !== false ) {
        return 'form_home';
    }
    return ! empty( $raw ) ? sanitize_text_field( $raw ) : 'whatsapp_modal';
}

/**
 * Insere um novo lead no banco de dados
 *
 * @param array $data
 * @return int|false ID do lead inserido ou false em caso de erro
 */
function atapremium_insert_lead( $data ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';

    // Garante que a tabela existe
    atapremium_create_leads_table();

    $nome     = sanitize_text_field( $data['nome'] ?? '' );
    $telefone = sanitize_text_field( $data['telefone'] ?? '' );
    $email    = sanitize_email( $data['email'] ?? '' );
    $unidade  = atapremium_normalize_unit( $data['unidade'] ?? 'Central' );
    $programa = sanitize_text_field( $data['programa'] ?? '' );
    $origem   = atapremium_normalize_origin( $data['origem'] ?? 'whatsapp_modal' );
    
    // UTMs
    $utm_source   = sanitize_text_field( $data['utm_source'] ?? '' );
    $utm_medium   = sanitize_text_field( $data['utm_medium'] ?? '' );
    $utm_campaign = sanitize_text_field( $data['utm_campaign'] ?? '' );
    $utm_content  = sanitize_text_field( $data['utm_content'] ?? '' );
    $utm_term     = sanitize_text_field( $data['utm_term'] ?? '' );

    // Metadados
    $ip          = sanitize_text_field( $data['ip'] ?? ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
    $user_agent  = sanitize_text_field( substr( $data['user_agent'] ?? ( $_SERVER['HTTP_USER_AGENT'] ?? '' ), 0, 255 ) );
    $status      = sanitize_text_field( $data['status'] ?? 'Novo' );
    $observacoes = sanitize_text_field( $data['observacoes'] ?? '' );

    if ( empty( $nome ) || empty( $telefone ) ) {
        return false;
    }

    $insert_data = array(
        'data_hora'    => current_time( 'mysql' ),
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
        'status'       => $status,
        'observacoes'  => $observacoes,
    );

    $format = array(
        '%s', '%s', '%s', '%s', '%s', '%s', '%s',
        '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
    );

    $result = $wpdb->insert( $table_name, $insert_data, $format );

    if ( $result ) {
        $lead_id = $wpdb->insert_id;

        // Backup seguro em options para contingência
        $backup = get_option( 'atapremium_leads_backup', array() );
        $insert_data['id'] = $lead_id;
        $backup[] = $insert_data;
        update_option( 'atapremium_leads_backup', array_slice( $backup, -500 ) );

        return $lead_id;
    }

    return false;
}

/**
 * Obtém estatísticas gerais e contadores para o painel administrativo
 *
 * @return array
 */
function atapremium_get_lead_stats() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';

    $empty_stats = array(
        'total'          => 0,
        'mes_atual'      => 0,
        'hoje'           => 0,
        'whatsapp_modal' => 0,
        'form_home'      => 0,
        'unidades'       => array(
            'Alves de Brito'      => 0,
            'Colégio Catarinense' => 0,
            'Spotmarkt'           => 0,
            'Central'             => 0,
        ),
    );

    // Se a tabela ainda não existir, retorna zeros
    if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) !== $table_name ) {
        return $empty_stats;
    }

    $total = (int) $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );
    
    $mes_atual = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE YEAR(data_hora) = %d AND MONTH(data_hora) = %d",
        current_time( 'Y' ),
        current_time( 'm' )
    ) );

    $hoje = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE DATE(data_hora) = %s",
        current_time( 'Y-m-d' )
    ) );

    $wpp_modal = (int) $wpdb->get_var(
        "SELECT COUNT(*) FROM $table_name WHERE origem IN ('whatsapp_modal', 'modal_whatsapp')"
    );

    $form_home = (int) $wpdb->get_var(
        "SELECT COUNT(*) FROM $table_name WHERE origem IN ('form_home', 'home_form')"
    );

    // Contagem agrupada por unidade com normalização
    $unidades_raw = $wpdb->get_results(
        "SELECT unidade, COUNT(*) as qtd FROM $table_name GROUP BY unidade",
        ARRAY_A
    );

    $unidades = array(
        'Alves de Brito'      => 0,
        'Colégio Catarinense' => 0,
        'Spotmarkt'           => 0,
        'Central'             => 0,
    );

    if ( ! empty( $unidades_raw ) ) {
        foreach ( $unidades_raw as $row ) {
            $u_norm = atapremium_normalize_unit( $row['unidade'] );
            $unidades[ $u_norm ] = ( $unidades[ $u_norm ] ?? 0 ) + (int) $row['qtd'];
        }
    }

    return array(
        'total'          => $total,
        'mes_atual'      => $mes_atual,
        'hoje'           => $hoje,
        'whatsapp_modal' => $wpp_modal,
        'form_home'      => $form_home,
        'unidades'       => $unidades,
    );
}

/**
 * Obtém lista paginada e filtrada de leads
 *
 * @param array $args
 * @return array ['leads' => array, 'total' => int, 'pages' => int]
 */
function atapremium_get_leads( $args = array() ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';

    if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) !== $table_name ) {
        return array( 'leads' => array(), 'total' => 0, 'pages' => 1 );
    }

    $defaults = array(
        'per_page' => 20,
        'page'     => 1,
        'unidade'  => '',
        'status'   => '',
        'search'   => '',
        'orderby'  => 'data_hora',
        'order'    => 'DESC',
    );

    $r = wp_parse_args( $args, $defaults );

    $where = array('1=1');
    $query_params = array();

    if ( ! empty( $r['unidade'] ) ) {
        $where[] = 'unidade = %s';
        $query_params[] = $r['unidade'];
    }

    if ( ! empty( $r['status'] ) ) {
        $where[] = 'status = %s';
        $query_params[] = $r['status'];
    }

    if ( ! empty( $r['search'] ) ) {
        $search_like = '%' . $wpdb->esc_like( $r['search'] ) . '%';
        $where[] = '(nome LIKE %s OR telefone LIKE %s OR email LIKE %s OR utm_campaign LIKE %s)';
        $query_params[] = $search_like;
        $query_params[] = $search_like;
        $query_params[] = $search_like;
        $query_params[] = $search_like;
    }

    $where_sql = implode( ' AND ', $where );

    // Total de registros para paginação
    if ( ! empty( $query_params ) ) {
        $total_sql = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE $where_sql", $query_params );
    } else {
        $total_sql = "SELECT COUNT(*) FROM $table_name WHERE $where_sql";
    }
    $total = (int) $wpdb->get_var( $total_sql );

    $offset = ( $r['page'] - 1 ) * $r['per_page'];
    $allowed_orders = array( 'ASC', 'DESC' );
    $order = in_array( strtoupper( $r['order'] ), $allowed_orders, true ) ? strtoupper( $r['order'] ) : 'DESC';
    $allowed_orderby = array( 'id', 'data_hora', 'nome', 'unidade', 'status' );
    $orderby = in_array( $r['orderby'], $allowed_orderby, true ) ? $r['orderby'] : 'data_hora';

    $limit_sql = $wpdb->prepare( "LIMIT %d OFFSET %d", $r['per_page'], $offset );

    if ( ! empty( $query_params ) ) {
        $sql = $wpdb->prepare(
            "SELECT * FROM $table_name WHERE $where_sql ORDER BY $orderby $order $limit_sql",
            $query_params
        );
    } else {
        $sql = "SELECT * FROM $table_name WHERE $where_sql ORDER BY $orderby $order $limit_sql";
    }

    $leads = $wpdb->get_results( $sql, ARRAY_A );
    $pages = ceil( $total / $r['per_page'] );

    return array(
        'leads' => $leads,
        'total' => $total,
        'pages' => max( 1, (int) $pages ),
    );
}

/**
 * Atualiza o status de um lead
 *
 * @param int $id
 * @param string $status
 * @return bool
 */
function atapremium_update_lead_status( $id, $status ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';
    $allowed = array( 'Novo', 'Contatado', 'Aula Agendada', 'Matriculado', 'Arquivado' );
    if ( ! in_array( $status, $allowed, true ) ) {
        return false;
    }
    return (bool) $wpdb->update( $table_name, array( 'status' => $status ), array( 'id' => (int) $id ), array( '%s' ), array( '%d' ) );
}

/**
 * Remove um lead do banco de dados
 *
 * @param int $id
 * @return bool
 */
function atapremium_delete_lead( $id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'atapremium_leads';
    return (bool) $wpdb->delete( $table_name, array( 'id' => (int) $id ), array( '%d' ) );
}
