<?php
/**
 * Template padrão para Páginas Genéricas - ATA Premium
 */

get_header(); ?>

<main id="primary" class="site-main page-generic-main">
    <div class="container page-generic-container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article-card' ); ?>>
                    <header class="entry-header">
                        <span class="badge-gold">ATA MARTIAL ARTS FLORIANÓPOLIS</span>
                        <h1 class="entry-title gold-gradient"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content" style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.8;">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'atapremium' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="text-center" style="padding: 60px 20px; background: var(--bg-card); border: 1px solid var(--border-card); border-radius: var(--radius-lg);">
                <span class="badge-gold" style="margin-bottom: 16px; display: inline-block;">ATA PREMIUM</span>
                <h2 style="font-size: 2rem; margin-bottom: 16px;">Página em Construção</h2>
                <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto 30px auto;">O conteúdo desta página estará disponível em breve. Enquanto isso, conheça nossos programas e unidades.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-gold">Voltar para a Página Inicial</a>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
