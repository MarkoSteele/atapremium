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
        '1.5.2'
    );

    // JS de Internacionalização (i18n - Português, Inglês e Espanhol)
    wp_enqueue_script(
        'atapremium-i18n',
        $theme_uri . '/assets/js/i18n.js',
        array(),
        '1.5.2',
        true
    );

    // JS Principal / Captura de Leads / Interatividades
    wp_enqueue_script(
        'atapremium-form-lead',
        $theme_uri . '/assets/js/form-lead.js',
        array('atapremium-i18n'),
        '1.5.2',
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
 * Roteamento automático para as páginas de unidades e institucional da ATA Premium
 * Permite que /unidade-alves-de-brito/, /unidade-colegio-catarinense/, /unidade-spotmarkt/ e /sobre-a-ata/
 * carreguem seus conteúdos ricos automaticamente mesmo antes de serem criadas no painel.
 */
function atapremium_virtual_unit_templates( $template ) {
    $request_uri = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    
    // Roteamento das Unidades
    $unit_slugs = [
        'unidade-alves-de-brito'       => 'alves-de-brito',
        'unidade-colegio-catarinense'  => 'colegio-catarinense',
        'unidade-spotmarkt'            => 'spotmarkt',
    ];
    
    foreach ( $unit_slugs as $slug => $id ) {
        if ( $request_uri === $slug || substr( $request_uri, -strlen($slug) ) === $slug ) {
            $_GET['unidade'] = $id;
            $unit_template = get_template_directory() . '/page-unidade.php';
            if ( file_exists( $unit_template ) ) {
                status_header( 200 );
                return $unit_template;
            }
        }
    }

    // Roteamento da Página Sobre a ATA
    $about_slugs = ['sobre-a-ata', 'sobre', 'sobre-a-ata-premium', 'quem-somos'];
    foreach ( $about_slugs as $slug ) {
        if ( $request_uri === $slug || substr( $request_uri, -strlen($slug) ) === $slug ) {
            $about_template = get_template_directory() . '/page-sobre.php';
            if ( file_exists( $about_template ) ) {
                status_header( 200 );
                return $about_template;
            }
        }
    }
    
    return $template;
}
add_filter( 'template_include', 'atapremium_virtual_unit_templates', 99 );
