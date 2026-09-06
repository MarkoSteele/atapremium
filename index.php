<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header(); ?>

<main id="primary" class="site-main container" style="padding-top: 160px; padding-bottom: 100px; min-height: 80vh;">
    <div style="max-width: 860px; margin: 0 auto;">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article-card' ); ?> style="background: var(--bg-card); border: 1px solid var(--border-card); border-radius: var(--radius-lg); padding: 40px; box-shadow: var(--shadow-card); margin-bottom: 30px;">
                    <header class="entry-header" style="margin-bottom: 20px;">
                        <h1 class="entry-title gold-gradient" style="font-size: 2.4rem; font-weight: 800;"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content" style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.8;">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="text-center" style="padding: 60px 20px; background: var(--bg-card); border: 1px solid var(--gold-border); border-radius: var(--radius-lg); box-shadow: var(--shadow-card);">
                <span class="badge-gold" style="margin-bottom: 16px; display: inline-block;">★ ATA MARTIAL ARTS FLORIANÓPOLIS ★</span>
                <h1 style="font-size: 2.2rem; margin-bottom: 14px; font-weight: 800;">Treinamento de Liderança e Artes Marciais</h1>
                <p style="color: var(--text-muted); max-width: 550px; margin: 0 auto 30px auto; font-size: 1.05rem;">Conheça a metodologia internacional Songahm e agende uma aula experimental gratuita em uma de nossas 3 unidades em Florianópolis.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-gold btn-lg">Explorar Página Inicial</a>
            </div>
        <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
