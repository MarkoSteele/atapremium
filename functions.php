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
        '1.5.7'
    );

    // JS de Internacionalização (i18n - Português, Inglês e Espanhol)
    wp_enqueue_script(
        'atapremium-i18n',
        $theme_uri . '/assets/js/i18n.js',
        array(),
        '1.5.7',
        true
    );

    // JS Principal / Captura de Leads / Interatividades
    wp_enqueue_script(
        'atapremium-form-lead',
        $theme_uri . '/assets/js/form-lead.js',
        array('atapremium-i18n'),
        '1.5.7',
        true // Carrega no rodapé
    );

    // Passa a URL do REST API local para o script JS de forma elegante
    wp_localize_script( 'atapremium-form-lead', 'wpApiSettings', array(
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'atapremium_enqueue_assets' );

// Inclui a integração de API/CRM
require_once get_template_directory() . '/inc/crm-integration.php';

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
