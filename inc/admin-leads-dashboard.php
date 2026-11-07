<?php
/**
 * Painel Administrativo de Leads & Conversões da ATA Premium
 * 
 * Exibe contadores em tempo real, filtros por unidade, gestão de status e exportação em CSV.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Carrega o módulo de banco de dados
require_once get_template_directory() . '/inc/lead-database.php';

/**
 * Adiciona a página de menu no painel do WordPress
 */
function atapremium_register_admin_menu() {
    add_menu_page(
        '🥋 ATA Leads',
        '🥋 ATA Leads',
        'manage_options',
        'atapremium-leads',
        'atapremium_render_leads_dashboard',
        'dashicons-groups',
        25
    );
}
add_action( 'admin_menu', 'atapremium_register_admin_menu' );

/**
 * Processa ações administrativas (mudança de status, exclusão e exportação CSV)
 */
function atapremium_handle_admin_actions() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Exportação para CSV
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'atapremium_export_csv' ) {
        check_admin_referer( 'atapremium_export_csv_nonce' );

        $unidade = sanitize_text_field( $_GET['unidade'] ?? '' );
        $status  = sanitize_text_field( $_GET['status'] ?? '' );
        $search  = sanitize_text_field( $_GET['s'] ?? '' );

        $result = atapremium_get_leads( array(
            'per_page' => 5000,
            'page'     => 1,
            'unidade'  => $unidade,
            'status'   => $status,
            'search'   => $search,
        ) );

        $leads = $result['leads'];

        // Envia headers para download do arquivo CSV
        $filename = 'leads_ata_premium_' . date( 'Y-m-d_H-i' ) . '.csv';
        header( 'Content-Type: text/csv; charset=UTF-8' );
        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
        header( 'Pragma: no-cache' );
        header( 'Expires: 0' );

        $output = fopen( 'php://output', 'w' );
        // UTF-8 BOM para abrir com acentos perfeitos no Microsoft Excel
        fputs( $output, "\xEF\xBB\xBF" );

        // Cabeçalhos das colunas
        fputcsv( $output, array(
            'ID', 'Data/Hora', 'Nome', 'WhatsApp', 'Email', 'Unidade',
            'Programa', 'Origem', 'UTM Source', 'UTM Campaign', 'UTM Medium', 'Status', 'IP'
        ), ';' );

        foreach ( $leads as $lead ) {
            fputcsv( $output, array(
                $lead['id'],
                $lead['data_hora'],
                $lead['nome'],
                $lead['telefone'],
                $lead['email'],
                $lead['unidade'],
                $lead['programa'],
                $lead['origem'],
                $lead['utm_source'],
                $lead['utm_campaign'],
                $lead['utm_medium'],
                $lead['status'],
                $lead['ip']
            ), ';' );
        }

        fclose( $output );
        exit;
    }

    // Alteração de Status
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'atapremium_update_status' ) {
        check_admin_referer( 'atapremium_update_status_nonce' );
        $lead_id = (int) ( $_POST['lead_id'] ?? 0 );
        $novo_status = sanitize_text_field( $_POST['novo_status'] ?? '' );
        if ( $lead_id && ! empty( $novo_status ) ) {
            atapremium_update_lead_status( $lead_id, $novo_status );
            wp_safe_redirect( add_query_arg( array( 'page' => 'atapremium-leads', 'updated' => 'status' ), admin_url( 'admin.php' ) ) );
            exit;
        }
    }

    // Exclusão de Lead
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'atapremium_delete_lead' ) {
        $lead_id = (int) ( $_GET['lead_id'] ?? 0 );
        check_admin_referer( 'atapremium_delete_lead_' . $lead_id );
        if ( $lead_id ) {
            atapremium_delete_lead( $lead_id );
            wp_safe_redirect( add_query_arg( array( 'page' => 'atapremium-leads', 'updated' => 'deleted' ), admin_url( 'admin.php' ) ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'atapremium_handle_admin_actions' );

/**
 * Renderiza a página principal do Dashboard de Leads no WP Admin
 */
function atapremium_render_leads_dashboard() {
    $stats = atapremium_get_lead_stats();

    // Filtros atuais
    $current_page    = max( 1, (int) ( $_GET['paged'] ?? 1 ) );
    $filter_unidade  = sanitize_text_field( $_GET['unidade'] ?? '' );
    $filter_status   = sanitize_text_field( $_GET['status'] ?? '' );
    $search_query    = sanitize_text_field( $_GET['s'] ?? '' );

    $leads_data = atapremium_get_leads( array(
        'per_page' => 20,
        'page'     => $current_page,
        'unidade'  => $filter_unidade,
        'status'   => $filter_status,
        'search'   => $search_query,
    ) );

    $leads = $leads_data['leads'];
    $total_leads = $leads_data['total'];
    $total_pages = $leads_data['pages'];
    ?>
    <div class="wrap atapremium-admin-wrap" style="max-width: 1400px; margin-top: 18px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        
        <!-- Header da Página -->
        <div style="background: linear-gradient(135deg, #0A0C10 0%, #141720 100%); border: 1px solid rgba(212, 175, 55, 0.35); border-radius: 10px; padding: 20px 24px; margin-bottom: 24px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.15); border: 1px solid rgba(212, 175, 55, 0.4); padding: 3px 12px; border-radius: 999px; color: #FDE68A; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                    🥋 ATA Premium Martial Arts • Gestão de Captação
                </div>
                <h1 style="color: #FFFFFF; margin: 0; font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">
                    Painel Central de Leads &amp; Conversões
                </h1>
                <p style="color: #94A3B8; margin: 4px 0 0 0; font-size: 13px;">
                    Acompanhe em tempo real as solicitações de aulas gratuitas, contatos de WhatsApp e parâmetros UTM de campanhas.
                </p>
            </div>

            <div>
                <a href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'atapremium_export_csv', 'unidade' => $filter_unidade, 'status' => $filter_status, 's' => $search_query ) ), 'atapremium_export_csv_nonce' ); ?>" class="button button-primary" style="background: #D4AF37; border-color: #B8860B; color: #000; font-weight: 700; height: 38px; line-height: 36px; padding: 0 16px; border-radius: 6px; box-shadow: 0 4px 12px rgba(212,175,55,0.25);">
                    📥 Exportar Leads em CSV (Excel)
                </a>
            </div>
        </div>

        <?php if ( isset( $_GET['updated'] ) ) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #10B981;">
                <p>
                    <?php
                    if ( $_GET['updated'] === 'status' ) echo 'Status do lead atualizado com sucesso!';
                    if ( $_GET['updated'] === 'deleted' ) echo 'Lead removido do sistema.';
                    ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- KPI Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
            <!-- Card 1: Total Geral -->
            <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.25); border-radius: 8px; padding: 18px 20px;">
                <div style="color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Total Geral de Leads</div>
                <div style="color: #FFFFFF; font-size: 28px; font-weight: 800; margin: 6px 0 2px 0;">
                    <?php echo number_format( $stats['total'], 0, ',', '.' ); ?>
                </div>
                <div style="color: #D4AF37; font-size: 11px; font-weight: 600;">Todos os registros salvos</div>
            </div>

            <!-- Card 2: Mês Atual -->
            <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.25); border-radius: 8px; padding: 18px 20px;">
                <div style="color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Leads Este Mês</div>
                <div style="color: #6EE7B7; font-size: 28px; font-weight: 800; margin: 6px 0 2px 0;">
                    <?php echo number_format( $stats['mes_atual'], 0, ',', '.' ); ?>
                </div>
                <div style="color: #94A3B8; font-size: 11px;">Mês de <?php echo date_i18n( 'F/Y' ); ?></div>
            </div>

            <!-- Card 3: Leads de Hoje -->
            <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.25); border-radius: 8px; padding: 18px 20px;">
                <div style="color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Leads Hoje</div>
                <div style="color: #FDE68A; font-size: 28px; font-weight: 800; margin: 6px 0 2px 0;">
                    <?php echo number_format( $stats['hoje'], 0, ',', '.' ); ?>
                </div>
                <div style="color: #94A3B8; font-size: 11px;">Entradas nas últimas 24h</div>
            </div>

            <!-- Card 4: Modal WhatsApp vs Formulário -->
            <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.25); border-radius: 8px; padding: 18px 20px;">
                <div style="color: #94A3B8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Origem dos Contatos</div>
                <div style="display: flex; gap: 12px; align-items: baseline; margin-top: 6px;">
                    <div>
                        <span style="color: #25D366; font-size: 18px; font-weight: 800;">💬 <?php echo $stats['whatsapp_modal']; ?></span>
                        <div style="color: #64748B; font-size: 10px;">WhatsApp Modal</div>
                    </div>
                    <div>
                        <span style="color: #60A5FA; font-size: 18px; font-weight: 800;">📝 <?php echo $stats['form_home']; ?></span>
                        <div style="color: #64748B; font-size: 10px;">Formulário Home</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contagem por Unidades -->
        <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 8px; padding: 16px 20px; margin-bottom: 24px;">
            <div style="color: #FDE68A; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                📍 Distribuição por Unidade em Florianópolis:
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 14px;">
                <?php
                $unidades_nomes = array(
                    'Alves de Brito'      => '📍 Alves de Brito (Centro)',
                    'Colégio Catarinense' => '🏫 Colégio Catarinense (Centro)',
                    'Colegio Catarinense' => '🏫 Colégio Catarinense (Centro)',
                    'Spotmarkt'           => '🛍️ Mall Spotmarkt (Córrego Grande)',
                    'Central'             => '🥋 Central Geral'
                );

                foreach ( array('Alves de Brito', 'Colégio Catarinense', 'Spotmarkt', 'Central') as $u_key ) :
                    $count = $stats['unidades'][$u_key] ?? ( $u_key === 'Colégio Catarinense' ? ($stats['unidades']['Colegio Catarinense'] ?? 0) : 0 );
                    $label = $unidades_nomes[$u_key] ?? $u_key;
                ?>
                    <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 8px 14px; border-radius: 6px; display: flex; align-items: center; gap: 10px;">
                        <span style="color: #CBD5E1; font-size: 12px; font-weight: 600;"><?php echo esc_html($label); ?>:</span>
                        <span style="background: rgba(212,175,55,0.2); color: #FDE68A; font-weight: 800; font-size: 12px; padding: 2px 8px; border-radius: 4px; border: 1px solid rgba(212,175,55,0.3);">
                            <?php echo $count; ?> leads
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Filtros e Barra de Busca -->
        <div style="background: #111318; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 14px 18px; margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
            <form method="GET" action="" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; flex: 1;">
                <input type="hidden" name="page" value="atapremium-leads">

                <!-- Busca por Nome / Telefone -->
                <input type="text" name="s" value="<?php echo esc_attr( $search_query ); ?>" placeholder="Buscar por nome, telefone ou UTM..." style="min-width: 260px; height: 34px; padding: 0 10px; background: #0A0C10; border: 1px solid rgba(255,255,255,0.2); border-radius: 4px; color: #FFF;">

                <!-- Filtro por Unidade -->
                <select name="unidade" style="height: 34px; background: #0A0C10; border: 1px solid rgba(255,255,255,0.2); border-radius: 4px; color: #FFF;">
                    <option value="">Todas as Unidades</option>
                    <option value="Alves de Brito" <?php selected( $filter_unidade, 'Alves de Brito' ); ?>>Alves de Brito</option>
                    <option value="Colégio Catarinense" <?php selected( $filter_unidade, 'Colégio Catarinense' ); ?>>Colégio Catarinense</option>
                    <option value="Spotmarkt" <?php selected( $filter_unidade, 'Spotmarkt' ); ?>>Spotmarkt</option>
                    <option value="Central" <?php selected( $filter_unidade, 'Central' ); ?>>Central</option>
                </select>

                <!-- Filtro por Status -->
                <select name="status" style="height: 34px; background: #0A0C10; border: 1px solid rgba(255,255,255,0.2); border-radius: 4px; color: #FFF;">
                    <option value="">Todos os Status</option>
                    <option value="Novo" <?php selected( $filter_status, 'Novo' ); ?>>Novo</option>
                    <option value="Contatado" <?php selected( $filter_status, 'Contatado' ); ?>>Contatado</option>
                    <option value="Aula Agendada" <?php selected( $filter_status, 'Aula Agendada' ); ?>>Aula Agendada</option>
                    <option value="Matriculado" <?php selected( $filter_status, 'Matriculado' ); ?>>Matriculado</option>
                    <option value="Arquivado" <?php selected( $filter_status, 'Arquivado' ); ?>>Arquivado</option>
                </select>

                <button type="submit" class="button" style="height: 34px; line-height: 32px; background: #1E293B; color: #FFF; border-color: rgba(255,255,255,0.2);">
                    🔍 Filtrar
                </button>

                <?php if ( ! empty( $search_query ) || ! empty( $filter_unidade ) || ! empty( $filter_status ) ) : ?>
                    <a href="<?php echo admin_url( 'admin.php?page=atapremium-leads' ); ?>" style="color: #F87171; text-decoration: none; font-size: 12px; margin-left: 6px;">
                        ✕ Limpar filtros
                    </a>
                <?php endif; ?>
            </form>

            <div style="color: #94A3B8; font-size: 13px;">
                Exibindo <strong><?php echo count( $leads ); ?></strong> de <strong><?php echo $total_leads; ?></strong> leads
            </div>
        </div>

        <!-- Tabela de Leads -->
        <div style="background: #111318; border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 8px; overflow-x: auto; -webkit-overflow-scrolling: touch; box-shadow: 0 4px 20px rgba(0,0,0,0.25);">
            <table class="wp-list-table widefat striped table-view-list" style="border: none; background: transparent; color: #CBD5E1; min-width: 1080px; width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #0D0E12; border-bottom: 2px solid rgba(212,175,55,0.3);">
                        <th style="min-width: 130px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Data / Hora</th>
                        <th style="min-width: 170px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Nome do Lead</th>
                        <th style="min-width: 150px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">WhatsApp</th>
                        <th style="min-width: 150px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Unidade</th>
                        <th style="min-width: 130px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Programa</th>
                        <th style="min-width: 110px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Origem</th>
                        <th style="min-width: 160px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">UTM / Campanha</th>
                        <th style="min-width: 130px; white-space: nowrap; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Status</th>
                        <th style="min-width: 90px; white-space: nowrap; text-align: right; color: #FDE68A; font-weight: 700; padding: 12px 14px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( empty( $leads ) ) : ?>
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 36px; color: #94A3B8;">
                                <div style="font-size: 24px; margin-bottom: 8px;">🥋</div>
                                Nenhum lead encontrado para os filtros selecionados.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $leads as $lead ) : 
                            $clean_phone = preg_replace( '/[^0-9]/', '', $lead['telefone'] );
                            if ( substr( $clean_phone, 0, 2 ) !== '55' && strlen( $clean_phone ) >= 10 ) {
                                $clean_phone = '55' . $clean_phone;
                            }
                            $wpp_direct_link = "https://wa.me/{$clean_phone}?text=" . rawurlencode( "Olá {$lead['nome']}, aqui é da ATA Premium! Recebemos seu interesse na Unidade {$lead['unidade']}." );

                            $status_color = '#FDE68A';
                            $status_bg = 'rgba(212,175,55,0.15)';
                            if ( $lead['status'] === 'Matriculado' ) {
                                $status_color = '#6EE7B7';
                                $status_bg = 'rgba(16,185,129,0.2)';
                            } elseif ( $lead['status'] === 'Contatado' || $lead['status'] === 'Aula Agendada' ) {
                                $status_color = '#93C5FD';
                                $status_bg = 'rgba(59,130,246,0.2)';
                            } elseif ( $lead['status'] === 'Arquivado' ) {
                                $status_color = '#94A3B8';
                                $status_bg = 'rgba(148,163,184,0.15)';
                            }
                        ?>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="font-size: 12px; color: #94A3B8;">
                                    <?php echo date( 'd/m/Y H:i', strtotime( $lead['data_hora'] ) ); ?>
                                </td>
                                <td>
                                    <strong style="color: #FFFFFF; font-size: 13px;"><?php echo esc_html( $lead['nome'] ); ?></strong>
                                    <?php if ( ! empty( $lead['email'] ) ) : ?>
                                        <div style="font-size: 11px; color: #64748B;"><?php echo esc_html( $lead['email'] ); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url( $wpp_direct_link ); ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 4px; color: #25D366; font-weight: 700; text-decoration: none; background: rgba(37,211,102,0.1); padding: 3px 8px; border-radius: 4px; border: 1px solid rgba(37,211,102,0.3);">
                                        💬 <?php echo esc_html( $lead['telefone'] ); ?>
                                    </a>
                                </td>
                                <td>
                                    <span style="font-size: 12px; font-weight: 600; color: #E2E8F0;">
                                        <?php echo esc_html( $lead['unidade'] ); ?>
                                    </span>
                                </td>
                                <td style="font-size: 12px; color: #CBD5E1;">
                                    <?php echo esc_html( $lead['programa'] ?: 'Geral' ); ?>
                                </td>
                                <td>
                                    <?php if ( $lead['origem'] === 'whatsapp_modal' ) : ?>
                                        <span style="background: rgba(37,211,102,0.15); color: #86EFAC; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 3px;">Modal WA</span>
                                    <?php else : ?>
                                        <span style="background: rgba(59,130,246,0.15); color: #93C5FD; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 3px;">Form Home</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size: 11px; color: #94A3B8;">
                                    <?php if ( ! empty( $lead['utm_source'] ) || ! empty( $lead['utm_campaign'] ) ) : ?>
                                        <div><strong style="color: #D4AF37;"><?php echo esc_html( $lead['utm_source'] ); ?></strong></div>
                                        <div><?php echo esc_html( $lead['utm_campaign'] ); ?></div>
                                    <?php else : ?>
                                        <span style="color: #64748B;">Direto / Orgânico</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="" style="margin: 0;">
                                        <?php wp_nonce_field( 'atapremium_update_status_nonce' ); ?>
                                        <input type="hidden" name="action" value="atapremium_update_status">
                                        <input type="hidden" name="lead_id" value="<?php echo (int) $lead['id']; ?>">
                                        <select name="novo_status" onchange="this.form.submit()" style="font-size: 11px; font-weight: 700; color: <?php echo $status_color; ?>; background: <?php echo $status_bg; ?>; border: 1px solid rgba(255,255,255,0.15); border-radius: 4px; padding: 2px 4px; cursor: pointer;">
                                            <option value="Novo" <?php selected( $lead['status'], 'Novo' ); ?>>Novo</option>
                                            <option value="Contatado" <?php selected( $lead['status'], 'Contatado' ); ?>>Contatado</option>
                                            <option value="Aula Agendada" <?php selected( $lead['status'], 'Aula Agendada' ); ?>>Aula Agendada</option>
                                            <option value="Matriculado" <?php selected( $lead['status'], 'Matriculado' ); ?>>Matriculado</option>
                                            <option value="Arquivado" <?php selected( $lead['status'], 'Arquivado' ); ?>>Arquivado</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'atapremium_delete_lead', 'lead_id' => $lead['id'] ) ), 'atapremium_delete_lead_' . $lead['id'] ); ?>" onclick="return confirm('Deseja realmente excluir este lead permanentemente?');" style="color: #EF4444; text-decoration: none; font-size: 14px;" title="Excluir Lead">
                                        🗑️
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <?php if ( $total_pages > 1 ) : ?>
            <div style="margin-top: 18px; display: flex; justify-content: flex-end; gap: 6px;">
                <?php
                echo paginate_links( array(
                    'base'      => add_query_arg( 'paged', '%#%' ),
                    'format'    => '',
                    'prev_text' => '« Anterior',
                    'next_text' => 'Próxima »',
                    'total'     => $total_pages,
                    'current'   => $current_page,
                ) );
                ?>
            </div>
        <?php endif; ?>

    </div>
    <?php
}
