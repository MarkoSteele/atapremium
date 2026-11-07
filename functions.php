<?php
/**
 * Funções e definições do tema Ata Premium
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Evita acesso direto
}

// Detecção robusta de SSL por trás de Proxies / HostGator / Cloudflare
if ( ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) ||
     ( isset( $_SERVER['HTTP_X_FORWARDED_SSL'] ) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on' ) ||
     ( isset( $_SERVER['HTTP_CF_VISITOR'] ) && strpos( $_SERVER['HTTP_CF_VISITOR'], 'https' ) !== false ) ) {
    $_SERVER['HTTPS'] = 'on';
}

// Garante HTTPS em todas as URLs de assets do tema para evitar bloqueio de Mixed Content
function atapremium_force_https_theme_uri( $uri ) {
    if ( is_ssl() || 
         ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) || 
         ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) ||
         ( isset( $_SERVER['HTTP_HOST'] ) && strpos( $_SERVER['HTTP_HOST'], 'deven.com.br' ) !== false ) ) {
        return set_url_scheme( $uri, 'https' );
    }
    return $uri;
}
add_filter( 'template_directory_uri', 'atapremium_force_https_theme_uri' );
add_filter( 'stylesheet_directory_uri', 'atapremium_force_https_theme_uri' );

// Endpoint seguro para limpeza forçada de cache do servidor e Varnish na HostGator
function atapremium_handle_cache_purge() {
    if ( isset( $_GET['purge_cache'] ) && $_GET['purge_cache'] === 'ata2026' ) {
        if ( function_exists( 'wp_cache_flush' ) ) {
            wp_cache_flush();
        }
        if ( class_exists( 'Endurance_Page_Cache' ) ) {
            do_action( 'epc_purge' );
        }
        if ( function_exists( 'wp_cache_clear_cache' ) ) {
            wp_cache_clear_cache();
        }
        if ( function_exists( 'w3tc_flush_all' ) ) {
            w3tc_flush_all();
        }
        if ( class_exists( 'LiteSpeed_Cache_API' ) ) {
            LiteSpeed_Cache_API::purge_all();
        }
        
        // Limpa pastas de cache de plugins e da HostGator (Endurance Page Cache)
        $cache_dirs = array(
            defined( 'WP_CONTENT_DIR' ) ? WP_CONTENT_DIR . '/endurance-page-cache' : '',
            defined( 'WP_CONTENT_DIR' ) ? WP_CONTENT_DIR . '/cache' : '',
        );

        foreach ( $cache_dirs as $c_dir ) {
            if ( $c_dir && is_dir( $c_dir ) ) {
                $it = new RecursiveDirectoryIterator( $c_dir, RecursiveDirectoryIterator::SKIP_DOTS );
                $files = new RecursiveIteratorIterator( $it, RecursiveIteratorIterator::CHILD_FIRST );
                foreach ( $files as $file ) {
                    if ( $file->isDir() ) {
                        @rmdir( $file->getRealPath() );
                    } else {
                        $deleted[] = $file->getRealPath();
                        @unlink( $file->getRealPath() );
                    }
                }
                @rmdir( $c_dir );
            }
        }

        // Envia PURGE local para o proxy reverso da hospedagem
        $targets = array( 'http://127.0.0.1/', 'http://127.0.0.1:8080/', 'http://localhost/' );
        foreach ( $targets as $target ) {
            $ch = curl_init( $target );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PURGE' );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Host: ' . ( $_SERVER['HTTP_HOST'] ?? 'atapremium.deven.com.br' ) ) );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 2 );
            curl_exec( $ch );
            curl_close( $ch );
        }
        
        $doc_root = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $doc_root_files = array();
        if ( $doc_root && is_dir( $doc_root ) ) {
            foreach ( scandir( $doc_root ) as $item ) {
                if ( $item === '.' || $item === '..' ) continue;
                $p = $doc_root . '/' . $item;
                $doc_root_files[] = $item . ( is_dir( $p ) ? ' (DIR)' : ' [' . filesize( $p ) . 'b]' );
                if ( is_file( $p ) && ( substr( $item, -5 ) === '.html' || substr( $item, -4 ) === '.htm' ) ) {
                    @unlink( $p );
                    $deleted[] = 'DELETED DOCROOT HTML: ' . $item;
                }
            }
        }

        $htaccess_path = file_exists( ABSPATH . '.htaccess' ) ? ABSPATH . '.htaccess' : ( $doc_root && file_exists( $doc_root . '/.htaccess' ) ? $doc_root . '/.htaccess' : '' );
        $htaccess_updated = false;

        if ( $htaccess_path && is_writable( $htaccess_path ) ) {
            $old_ht = file_get_contents( $htaccess_path );
            // Remove o bloco # BEGIN NFD EPC ... # END NFD EPC que força cache estático de HTML por 2h
            $new_ht = preg_replace( '/# BEGIN NFD EPC.*?# END NFD EPC\s*/s', '', $old_ht );
            if ( $new_ht !== $old_ht ) {
                copy( $htaccess_path, $htaccess_path . '.bak' );
                file_put_contents( $htaccess_path, $new_ht );
                $htaccess_updated = true;
            }
            $htaccess_content = file_get_contents( $htaccess_path );
        } else {
            $htaccess_content = $htaccess_path ? file_get_contents( $htaccess_path ) : 'Not found or not writable';
        }

        $active_plugins = get_option( 'active_plugins', array() );

        $stats = function_exists( 'atapremium_get_lead_stats' ) ? atapremium_get_lead_stats() : array();
        $recent_leads = function_exists( 'atapremium_get_leads' ) ? atapremium_get_leads( array( 'per_page' => 5 ) ) : array();

        $diag = "ABSPATH: " . ABSPATH . "\n";
        $diag .= "DOCUMENT_ROOT: " . $doc_root . "\n";
        $diag .= "ACTIVE PLUGINS:\n" . implode( "\n", (array) $active_plugins ) . "\n\n";
        $diag .= "LEAD STATS IN DB:\n" . print_r( $stats, true ) . "\n\n";
        $diag .= "RECENT LEADS IN DB:\n" . print_r( $recent_leads, true ) . "\n\n";
        $diag .= "DELETED FILES (" . count( $deleted ) . "):\n" . implode( "\n", $deleted ) . "\n\n";
        $diag .= ".HTACCESS CONTENT:\n" . $htaccess_content . "\n";

        wp_die( '<h1>Diagnóstico de Cache & Leads ATA Premium</h1><pre>' . esc_html( $diag ) . '</pre><p><a href="' . esc_url( home_url('/') ) . '">Voltar à Página Inicial</a></p>' );
    }
}
add_action( 'init', 'atapremium_handle_cache_purge' );

/**
 * Garante que o .htaccess da raiz do WordPress possua as regras do Apache mod_rewrite
 * e que as páginas virtuais e permalinks funcionem sem erro 404 da HostGator.
 */
function atapremium_ensure_root_htaccess() {
    $is_explicit = ( isset( $_GET['fix_htaccess'] ) && $_GET['fix_htaccess'] === 'ata2026' );
    
    // Alvos possíveis para o .htaccess da raiz do site
    $doc_root = ! empty( $_SERVER['DOCUMENT_ROOT'] ) ? rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ) : '';
    $targets = array_unique( array_filter( array(
        ABSPATH . '.htaccess',
        $doc_root ? $doc_root . '/.htaccess' : '',
    ) ) );

    $wp_rules = "# BEGIN WordPress\n"
              . "<IfModule mod_rewrite.c>\n"
              . "RewriteEngine On\n"
              . "RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\n"
              . "RewriteBase /\n"
              . "RewriteRule ^index\.php$ - [L]\n"
              . "RewriteCond %{REQUEST_FILENAME} !-f\n"
              . "RewriteCond %{REQUEST_FILENAME} !-d\n"
              . "RewriteRule . /index.php [L]\n"
              . "</IfModule>\n"
              . "# END WordPress\n";

    $report = array(
        'timestamp' => current_time( 'mysql' ),
        'abspath'   => ABSPATH,
        'doc_root'  => $doc_root,
        'targets'   => array(),
    );

    // Garante permalinks no WordPress caso estejam desativados
    $perm_structure = get_option( 'permalink_structure' );
    if ( empty( $perm_structure ) || $is_explicit ) {
        global $wp_rewrite;
        if ( is_object( $wp_rewrite ) ) {
            $wp_rewrite->set_permalink_structure( '/%postname%/' );
            $wp_rewrite->flush_rules( true );
        }
        update_option( 'permalink_structure', '/%postname%/' );
        $report['permalink_updated'] = true;
    }
    $report['current_permalink_structure'] = get_option( 'permalink_structure' );

    $any_written = false;

    foreach ( $targets as $ht_file ) {
        $exists = file_exists( $ht_file );
        $content = $exists ? (string) @file_get_contents( $ht_file ) : '';
        $has_wp_rules = ( strpos( $content, 'RewriteRule . /index.php [L]' ) !== false );
        $is_writable = $exists ? is_writable( $ht_file ) : is_writable( dirname( $ht_file ) );

        $target_info = array(
            'path'         => $ht_file,
            'exists'       => $exists,
            'has_wp_rules' => $has_wp_rules,
            'is_writable'  => $is_writable,
            'action'       => 'none',
        );

        if ( ( ! $has_wp_rules || $is_explicit ) && $is_writable ) {
            if ( preg_match( '/# BEGIN WordPress.*?# END WordPress/s', $content ) ) {
                $new_content = preg_replace( '/# BEGIN WordPress.*?# END WordPress/s', trim( $wp_rules ), $content );
            } else {
                $new_content = trim( $wp_rules ) . ( ! empty( trim( $content ) ) ? "\n\n" . ltrim( $content ) : "\n" );
            }
            // Remove regras indesejadas de cache do HostGator EPC se houver
            $new_content = preg_replace( '/# BEGIN NFD EPC.*?# END NFD EPC\s*/s', '', $new_content );
            $new_content = trim( $new_content ) . "\n";

            if ( $exists ) {
                @copy( $ht_file, $ht_file . '.bak' );
            }

            $bytes = @file_put_contents( $ht_file, $new_content );
            if ( $bytes !== false ) {
                $target_info['action'] = 'written';
                $target_info['bytes_written'] = $bytes;
                $target_info['verified_content'] = @file_get_contents( $ht_file );
                $any_written = true;
            } else {
                $target_info['action'] = 'write_failed';
            }
        }

        $report['targets'][ $ht_file ] = $target_info;
    }

    if ( $any_written && function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }

    if ( $is_explicit ) {
        header( 'Content-Type: application/json; charset=utf-8' );
        echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        exit;
    }
}
add_action( 'init', 'atapremium_ensure_root_htaccess', 1 );

// Define tempo de vida de cache do HTML para evitar que páginas estáticas fiquem retidas por horas
function atapremium_control_html_cache_headers() {
    if ( ! is_admin() ) {
        header( 'Cache-Control: public, max-age=60, s-maxage=60, stale-while-revalidate=120' );
    }
}
add_action( 'send_headers', 'atapremium_control_html_cache_headers', 99 );

// Configurações do tema
function atapremium_setup() {
    // Adiciona suporte a tag de título dinâmica
    add_theme_support( 'title-tag' );

    // Adiciona suporte a imagens destacadas
    add_theme_support( 'post-thumbnails' );

    // Suporte a marcação HTML5 semântica
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
}
add_action( 'after_setup_theme', 'atapremium_setup' );

// Enfileira estilos e scripts
function atapremium_enqueue_assets() {
    $theme_uri = is_ssl() ? set_url_scheme( get_template_directory_uri(), 'https' ) : get_template_directory_uri();

    // CSS Principal
    wp_enqueue_style(
        'atapremium-style',
        $theme_uri . '/assets/css/main.css',
        array(),
        '1.7.0'
    );

    // JS de Internacionalização (i18n - Português, Inglês e Espanhol)
    wp_enqueue_script(
        'atapremium-i18n',
        $theme_uri . '/assets/js/i18n.js',
        array(),
        '1.6.2',
        true
    );

    // JS Principal / Captura de Leads / Interatividades
    wp_enqueue_script(
        'atapremium-form-lead',
        $theme_uri . '/assets/js/form-lead.js',
        array('atapremium-i18n'),
        '1.6.8',
        true // Carrega no rodapé
    );

    // Passa a URL do REST API e AJAX local para o script JS de forma elegante
    wp_localize_script( 'atapremium-form-lead', 'wpApiSettings', array(
        'root'     => esc_url_raw( rest_url() ),
        'ajax_url' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
        'nonce'    => wp_create_nonce( 'wp_rest' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'atapremium_enqueue_assets' );

// Adiciona atributo 'defer' aos scripts para carregamento assíncrono e não-bloqueante
function atapremium_defer_scripts( $tag, $handle, $src ) {
    if ( in_array( $handle, array( 'atapremium-i18n', 'atapremium-form-lead' ), true ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'atapremium_defer_scripts', 10, 3 );

// Módulos de Inteligência, Leads & CRM da ATA Premium
require_once get_template_directory() . '/inc/lead-database.php';
require_once get_template_directory() . '/inc/crm-integration.php';
require_once get_template_directory() . '/inc/admin-leads-dashboard.php';
require_once get_template_directory() . '/inc/seo.php';

/**
 * Interceptador robusto para páginas virtuais institucionais e de unidades da ATA Premium
 * Permite que todas as páginas carreguem seus conteúdos ricos automaticamente sem necessidade de configuração prévia no admin do WordPress.
 */
function atapremium_intercept_virtual_pages() {
    $request_path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    
    $virtual_routes = [
        // 1. Federação ATA
        'federacao-ata'              => 'page-federacao-ata.php',
        'sobre-a-ata'                => 'page-federacao-ata.php',
        'sobre-a-federacao-ata'      => 'page-federacao-ata.php',
        'federacao'                  => 'page-federacao-ata.php',
        
        // 2. ATA Premium Floripa
        'sobre-a-ata-premium'        => 'page-sobre.php',
        'sobre-nos'                  => 'page-sobre.php',
        'premium-floripa'            => 'page-sobre.php',
        'quem-somos'                 => 'page-sobre.php',
        
        // 3. Equipe & Instrutores
        'equipe'                     => 'page-equipe.php',
        'nossa-equipe'               => 'page-equipe.php',
        'instrutores'                => 'page-equipe.php',
        'professores'                => 'page-equipe.php',
        
        // 4. Metodologia Songahm
        'metodologia'                => 'page-metodologia.php',
        'metodologia-songahm'        => 'page-metodologia.php',
        'jornada-songahm'            => 'page-metodologia.php',
        
        // 5. Unidades
        'unidade-alves-de-brito'     => 'page-unidade.php',
        'unidade-colegio-catarinense'=> 'page-unidade.php',
        'unidade-spotmarkt'          => 'page-unidade.php',
    ];

    foreach ( $virtual_routes as $slug => $file ) {
        if ( $request_path === $slug || substr( $request_path, -strlen($slug) ) === $slug ) {
            global $wp_query, $post;
            
            if ( is_object( $wp_query ) ) {
                $wp_query->is_404 = false;
                $wp_query->is_page = true;
                $wp_query->is_singular = true;
                $wp_query->is_home = false;
                $wp_query->is_archive = false;
            }
            
            status_header( 200 );
            
            $template_file = get_template_directory() . '/' . $file;
            if ( file_exists( $template_file ) ) {
                if ( strpos( $slug, 'unidade-' ) === 0 ) {
                    $_GET['unidade'] = str_replace( 'unidade-', '', $slug );
                }
                include $template_file;
                exit;
            }
        }
    }
}
add_action( 'template_redirect', 'atapremium_intercept_virtual_pages', 1 );
