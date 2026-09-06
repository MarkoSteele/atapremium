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
        '1.0.0'
    );

    // JS para envio assíncrono do formulário
    wp_enqueue_script(
        'atapremium-form-lead',
        get_template_directory_uri() . '/assets/js/form-lead.js',
        array(),
        '1.0.0',
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
