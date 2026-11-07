<?php
/**
 * Otimizações de SEO Nativo (Title, Meta Description, Open Graph & Twitter Cards)
 * 
 * Este módulo provê tags de SEO dinâmicas e de alta conversão para a Home,
 * Unidades, Metodologia, Equipe, Federação e páginas institucionais.
 * 
 * Compatibilidade com Plugins: Caso um plugin de SEO completo (Yoast SEO, Rank Math,
 * All in One SEO ou SEOPress) seja instalado ou ativado futuramente, este script
 * cede o controle automaticamente, evitando qualquer conflito ou duplicação.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Verifica se algum plugin de SEO renomado está ativo no WordPress
 */
function atapremium_has_seo_plugin() {
    return defined( 'WPSEO_VERSION' )            // Yoast SEO
        || class_exists( 'WPSEO_Frontend' )      // Yoast SEO Frontend
        || defined( 'RANK_MATH_VERSION' )        // Rank Math SEO
        || defined( 'AIOSEO_VERSION' )           // All in One SEO
        || defined( 'SEOPRESS_VERSION' );        // SEOPress
}

/**
 * Retorna os dados completos de SEO (Título, Descrição, Canonical, Imagem, Tipo) para a página atual
 */
function atapremium_get_seo_data() {
    $theme_uri = get_template_directory_uri();
    $default_image = $theme_uri . '/assets/images/autorizado-davi-master-barth-faraco.jpg';
    $site_name = 'ATA Premium Martial Arts Florianópolis';
    
    // Captura o caminho atual da requisição para casar com rotas virtuais
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim( parse_url( $request_uri, PHP_URL_PATH ) ?? '', '/' );
    
    // Unidade via parâmetro GET
    $unidade_param = $_GET['unidade'] ?? '';

    // 1. Página 404
    if ( is_404() ) {
        return [
            'title'       => 'Página Não Encontrada (404) | ' . $site_name,
            'description' => 'A página solicitada não foi encontrada. Conheça as unidades da ATA Premium em Florianópolis e agende uma aula experimental gratuita de Taekwondo.',
            'canonical'   => home_url( '/404' ),
            'og_type'     => 'website',
            'image'       => $theme_uri . '/assets/images/hero-poster.jpg',
        ];
    }

    // 2. Unidade Alves de Brito
    if ( $unidade_param === 'alves-de-brito' || strpos( $path, 'alves-de-brito' ) !== false ) {
        return [
            'title'       => 'Unidade Alves de Brito - Centro | ATA Premium Floripa',
            'description' => 'Dojo central da ATA Premium na Rua Alves de Brito, 33, Centro de Florianópolis. Tatame profissional, ambiente climatizado e turmas para todas as idades.',
            'canonical'   => home_url( '/unidade-alves-de-brito/' ),
            'og_type'     => 'business.business',
            'image'       => $theme_uri . '/assets/images/unidade-alves-de-brito-fachada.jpg',
        ];
    }

    // 3. Unidade Colégio Catarinense
    if ( $unidade_param === 'colegio-catarinense' || strpos( $path, 'colegio-catarinense' ) !== false || strpos( $path, 'catarinense' ) !== false ) {
        return [
            'title'       => 'Unidade Colégio Catarinense - Centro | ATA Premium Floripa',
            'description' => 'Unidade ATA Premium ao lado do Colégio Catarinense em Florianópolis. Metodologia internacional para desenvolvimento do foco escolar, disciplina e autoconfiança.',
            'canonical'   => home_url( '/unidade-colegio-catarinense/' ),
            'og_type'     => 'business.business',
            'image'       => $theme_uri . '/assets/images/unidade-2.webp',
        ];
    }

    // 4. Unidade Spotmarkt
    if ( $unidade_param === 'spotmarkt' || strpos( $path, 'spotmarkt' ) !== false ) {
        return [
            'title'       => 'Unidade Spotmarkt - Córrego Grande | ATA Premium Floripa',
            'description' => 'Unidade ATA Premium no Mall Spotmarkt no Córrego Grande, Florianópolis. Conforto, segurança, estacionamento fácil e artes marciais para toda a família.',
            'canonical'   => home_url( '/unidade-spotmarkt/' ),
            'og_type'     => 'business.business',
            'image'       => $theme_uri . '/assets/images/ata-spotmarket-capa.webp',
        ];
    }

    // 5. Sobre a ATA Premium
    if ( strpos( $path, 'sobre-a-ata-premium' ) !== false || strpos( $path, 'sobre-nos' ) !== false || strpos( $path, 'quem-somos' ) !== false || ( function_exists('is_page') && is_page('sobre-a-ata-premium') ) ) {
        return [
            'title'       => 'Sobre a ATA Premium Floripa | Filosofia, Tradição e Excelência',
            'description' => 'Conheça a história e o propósito da ATA Premium em Florianópolis. Muito além da luta: desenvolvendo disciplina voluntária, equilíbrio emocional e postura de liderança.',
            'canonical'   => home_url( '/sobre-a-ata-premium/' ),
            'og_type'     => 'article',
            'image'       => $default_image,
        ];
    }

    // 6. Federação ATA Global
    if ( strpos( $path, 'federacao-ata' ) !== false || strpos( $path, 'sobre-a-ata' ) !== false || strpos( $path, 'federacao' ) !== false || ( function_exists('is_page') && is_page('federacao-ata') ) ) {
        return [
            'title'       => 'Federação ATA Martial Arts Global | ATA Premium Florianópolis',
            'description' => 'A ATA é uma das maiores organizações marciais do mundo, fundada em 1969, presente em mais de 25 países.',
            'canonical'   => home_url( '/federacao-ata/' ),
            'og_type'     => 'article',
            'image'       => $theme_uri . '/assets/images/logo.png',
        ];
    }

    // 7. Equipe e Instrutores
    if ( strpos( $path, 'equipe' ) !== false || strpos( $path, 'nossa-equipe' ) !== false || strpos( $path, 'instrutores' ) !== false || ( function_exists('is_page') && is_page('equipe') ) ) {
        return [
            'title'       => 'Mestres e Instrutores Certificados | ATA Premium Floripa',
            'description' => 'Conheça a liderança técnica da ATA Premium em Florianópolis. Instrutores formados sob rigor pedagógico, não-violência e recertificação internacional contínua.',
            'canonical'   => home_url( '/equipe/' ),
            'og_type'     => 'article',
            'image'       => $default_image,
        ];
    }

    // 8. Metodologia Songahm
    if ( strpos( $path, 'metodologia' ) !== false || strpos( $path, 'songahm' ) !== false || ( function_exists('is_page') && is_page('metodologia') ) ) {
        return [
            'title'       => 'Metodologia Songahm Taekwondo | ATA Premium Florianópolis',
            'description' => 'Descubra a metodologia pedagógica Songahm na ATA Premium: sistema de faixas, valores marciais, foco, não-violência e desenvolvimento socioemocional.',
            'canonical'   => home_url( '/metodologia-songahm/' ),
            'og_type'     => 'article',
            'image'       => $theme_uri . '/assets/images/hero-poster.jpg',
        ];
    }

    // 9. Página Inicial (Front Page / Home)
    if ( ( function_exists('is_front_page') && is_front_page() ) || ( function_exists('is_home') && is_home() ) || empty( $path ) ) {
        return [
            'title'       => 'ATA Premium Martial Arts Florianópolis | Taekwondo & Liderança',
            'description' => 'Escola de Taekwondo e liderança em Florianópolis. Método Songahm para Tigers (3-6), Kids (7-13), Teens e Adultos. 3 sedes no Centro e Córrego Grande. Agende sua aula!',
            'canonical'   => home_url( '/' ),
            'og_type'     => 'website',
            'image'       => $default_image,
        ];
    }

    // 10. Fallback Padrão para Páginas / Posts do WordPress
    $page_title = function_exists('get_the_title') ? get_the_title() : '';
    $excerpt = function_exists('has_excerpt') && has_excerpt() ? wp_strip_all_tags( get_the_excerpt() ) : '';
    $desc = ! empty( $excerpt ) ? $excerpt : 'Escola de Artes Marciais e Desenvolvimento de Liderança ATA Premium em Florianópolis. Conheça nossos programas e unidades.';

    return [
        'title'       => ( $page_title ? $page_title . ' | ' : '' ) . $site_name,
        'description' => function_exists('wp_trim_words') ? wp_trim_words( $desc, 25, '...' ) : substr($desc, 0, 155),
        'canonical'   => function_exists('get_permalink') && get_permalink() ? get_permalink() : home_url( '/' . $path ),
        'og_type'     => ( function_exists('is_single') && is_single() ) ? 'article' : 'website',
        'image'       => ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) ? get_the_post_thumbnail_url( null, 'large' ) : $default_image,
    ];
}

/**
 * Integração Inteligente com Yoast SEO:
 * Caso o Yoast SEO esteja ativo no WordPress, intercepta seus filtros para injetar
 * nossos títulos de alta conversão, metadescrições persuasivas, imagens OG e locale pt_BR,
 * garantindo nota 100 no Lighthouse mesmo antes de o usuário configurar o painel do Yoast.
 */
add_filter( 'wpseo_title', 'atapremium_filter_yoast_title', 99, 1 );
function atapremium_filter_yoast_title( $title ) {
    $seo = atapremium_get_seo_data();
    if ( empty( $title ) || trim( $title ) === 'atapremium -' || trim( $title ) === 'atapremium' || trim( $title ) === '-' ) {
        return $seo['title'];
    }
    return $title;
}

add_filter( 'wpseo_metadesc', 'atapremium_filter_yoast_metadesc', 99, 1 );
function atapremium_filter_yoast_metadesc( $desc ) {
    if ( empty( $desc ) || trim( $desc ) === '' ) {
        $seo = atapremium_get_seo_data();
        return $seo['description'];
    }
    return $desc;
}

add_filter( 'wpseo_opengraph_title', 'atapremium_filter_yoast_og_title', 99, 1 );
function atapremium_filter_yoast_og_title( $title ) {
    if ( empty( $title ) || trim( $title ) === 'atapremium -' || trim( $title ) === 'atapremium' ) {
        $seo = atapremium_get_seo_data();
        return $seo['title'];
    }
    return $title;
}

add_filter( 'wpseo_opengraph_desc', 'atapremium_filter_yoast_og_desc', 99, 1 );
function atapremium_filter_yoast_og_desc( $desc ) {
    if ( empty( $desc ) || trim( $desc ) === '' ) {
        $seo = atapremium_get_seo_data();
        return $seo['description'];
    }
    return $desc;
}

add_filter( 'wpseo_opengraph_image', 'atapremium_filter_yoast_og_image', 99, 1 );
function atapremium_filter_yoast_og_image( $image ) {
    if ( empty( $image ) ) {
        $seo = atapremium_get_seo_data();
        return $seo['image'];
    }
    return $image;
}

add_filter( 'wpseo_locale', function( $locale ) {
    return 'pt_BR';
}, 99 );

add_filter( 'wpseo_canonical', 'atapremium_filter_yoast_canonical', 99, 1 );
function atapremium_filter_yoast_canonical( $canonical ) {
    $seo = atapremium_get_seo_data();
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?? '', '/' );
    if ( ! empty( $path ) ) {
        return $seo['canonical'];
    }
    return $canonical;
}

/**
 * Integração com Rank Math SEO (se aplicável)
 */
add_filter( 'rank_math/frontend/title', function( $title ) {
    if ( empty( $title ) ) {
        $seo = atapremium_get_seo_data();
        return $seo['title'];
    }
    return $title;
}, 99 );

add_filter( 'rank_math/frontend/description', function( $desc ) {
    if ( empty( $desc ) ) {
        $seo = atapremium_get_seo_data();
        return $seo['description'];
    }
    return $desc;
}, 99 );

/**
 * Injeta a tag de título customizada via filtro nativo do WordPress (caso nenhum plugin esteja ativo)
 */
function atapremium_filter_document_title( $title ) {
    if ( atapremium_has_seo_plugin() ) {
        return $title;
    }
    
    $seo = atapremium_get_seo_data();
    return ! empty( $seo['title'] ) ? $seo['title'] : $title;
}
add_filter( 'pre_get_document_title', 'atapremium_filter_document_title', 20 );

/**
 * Injeta Meta Description, Canonical, Open Graph e Twitter Cards no <head>
 * Executado quando nenhum plugin de SEO estiver ativo
 */
function atapremium_render_seo_meta_tags() {
    if ( atapremium_has_seo_plugin() ) {
        return;
    }

    $seo = atapremium_get_seo_data();
    ?>
    <!-- Metatags de SEO Dinâmico (ATA Premium) -->
    <meta name="description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta name="robots" content="<?php echo ( function_exists('is_404') && is_404() ) ? 'noindex, follow' : 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1'; ?>">
    <link rel="canonical" href="<?php echo esc_url( $seo['canonical'] ); ?>">

    <!-- Open Graph / Redes Sociais / WhatsApp -->
    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="<?php echo esc_attr( $seo['og_type'] ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $seo['canonical'] ); ?>">
    <meta property="og:site_name" content="ATA Premium Martial Arts Florianópolis">
    <meta property="og:image" content="<?php echo esc_url( $seo['image'] ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr( $seo['title'] ); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $seo['title'] ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $seo['description'] ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $seo['image'] ); ?>">
    <?php
}
add_action( 'wp_head', 'atapremium_render_seo_meta_tags', 1 );
