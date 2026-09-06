<?php
/**
 * Funções e definições do tema Ata Premium
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Evita acesso direto
}

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
    // CSS principal
    wp_enqueue_style(
        'atapremium-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        '1.4.0'
    );

    // JS de Internacionalização (i18n - Português, Inglês e Espanhol)
    wp_enqueue_script(
        'atapremium-i18n',
        get_template_directory_uri() . '/assets/js/i18n.js',
        array(),
        '1.4.0',
        true
    );

    // JS para envio assíncrono do formulário e interações
    wp_enqueue_script(
        'atapremium-form-lead',
        get_template_directory_uri() . '/assets/js/form-lead.js',
        array('atapremium-i18n'),
        '1.4.0',
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
