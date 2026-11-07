<?php
/**
 * Template Name: Blog & Artigos ATA Premium
 * Template Post Type: page
 * Descrição: Listagem oficial do Blog da ATA Premium Florianópolis com filtro de categorias, busca, destaque principal e grid no padrão Obsidian & Gold.
 */

get_header();

$selected_cat = isset( $_GET['categoria'] ) ? sanitize_text_field( wp_unslash( $_GET['categoria'] ) ) : '';
if ( empty( $selected_cat ) && is_category() ) {
    $queried_cat = get_queried_object();
    if ( $queried_cat && ! empty( $queried_cat->slug ) ) {
        $selected_cat = $queried_cat->slug;
    }
}

$search_term = isset( $_GET['busca'] ) ? sanitize_text_field( wp_unslash( $_GET['busca'] ) ) : '';
$paged       = max( 1, get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : ( isset( $_GET['pg'] ) ? (int) $_GET['pg'] : 1 ) );

$query_args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 12,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
);

if ( ! empty( $selected_cat ) ) {
    $query_args['category_name'] = $selected_cat;
}

if ( ! empty( $search_term ) ) {
    $query_args['s'] = $search_term;
}

$blog_query = new WP_Query( $query_args );

// Categorias disponíveis para os filtros
$all_categories = get_categories( array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'exclude'    => array( 1 ), // Exclui "Sem categoria" / "Uncategorized" se houver outras
) );
if ( empty( $all_categories ) ) {
    $all_categories = get_categories( array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ) );
}
?>

<!-- 1. HERO DO BLOG -->
<section class="blog-hero-section">
    <div class="blog-hero-glow"></div>
    <div class="container blog-hero-container text-center">
        <span class="badge-gold">★ CONTEÚDO OFICIAL • ATA PREMIUM FLORIANÓPOLIS ★</span>
        <h1 class="blog-hero-title">
            Blog & Inteligência Marcial: <span class="gold-gradient">Formando Atitudes para a Vida</span>
        </h1>
        <p class="blog-hero-subtitle">
            Artigos aprofundados sobre desenvolvimento infantil, foco escolar, neurociência do esporte, rotina em família e os pilares do Método Songahm.
        </p>

        <!-- Barra de Categorias & Busca Rápida -->
        <div class="blog-controls-bar">
            <div class="blog-category-pills" role="tablist" aria-label="Filtrar artigos por categoria">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"
                   class="blog-cat-pill <?php echo empty( $selected_cat ) ? 'is-active' : ''; ?>"
                   data-cat-filter="all">
                    Todos os Artigos
                </a>
                <?php foreach ( $all_categories as $cat ) : ?>
                    <?php if ( in_array( strtolower( $cat->slug ), array( 'uncategorized', 'sem-categoria' ), true ) && count( $all_categories ) > 1 ) continue; ?>
                    <a href="<?php echo esc_url( add_query_arg( 'categoria', $cat->slug, home_url( '/blog/' ) ) ); ?>"
                       class="blog-cat-pill <?php echo ( $selected_cat === $cat->slug ) ? 'is-active' : ''; ?>"
                       data-cat-filter="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <form class="blog-search-form" action="<?php echo esc_url( home_url( '/blog/' ) ); ?>" method="get">
                <?php if ( ! empty( $selected_cat ) ) : ?>
                    <input type="hidden" name="categoria" value="<?php echo esc_attr( $selected_cat ); ?>">
                <?php endif; ?>
                <div class="blog-search-input-wrap">
                    <svg class="search-icon" viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="search" id="blogQuickSearch" name="busca" value="<?php echo esc_attr( $search_term ); ?>" placeholder="Buscar tema (ex: foco, telas, faixas)..." aria-label="Buscar artigos no blog">
                </div>
            </form>
        </div>
    </div>
</section>

<!-- 2. LISTAGEM DE ARTIGOS (DESTAQUE + GRID) -->
<section class="blog-listing-section">
    <div class="container">
        <?php if ( $blog_query->have_posts() ) : ?>
            <?php
            $posts_array = $blog_query->posts;
            $featured_post = ( $paged === 1 && empty( $search_term ) && empty( $selected_cat ) && ! empty( $posts_array ) ) ? $posts_array[0] : null;
            ?>

            <?php if ( $featured_post ) : ?>
                <?php
                $feat_id    = $featured_post->ID;
                $feat_cats  = get_the_category( $feat_id );
                $feat_cat   = ! empty( $feat_cats ) ? $feat_cats[0] : null;
                $feat_cover = atapremium_get_post_cover_url( $feat_id );
                $feat_time  = atapremium_reading_time( $featured_post->post_content );
                $feat_link  = get_permalink( $feat_id );
                ?>
                <!-- Artigo em Destaque Principal -->
                <article class="blog-featured-card" data-post-cat="<?php echo esc_attr( $feat_cat ? $feat_cat->slug : 'geral' ); ?>">
                    <a href="<?php echo esc_url( $feat_link ); ?>" class="blog-featured-media">
                        <img src="<?php echo esc_url( $feat_cover ); ?>" alt="<?php echo esc_attr( get_the_title( $feat_id ) ); ?>" loading="eager">
                        <span class="featured-ribbon">★ ARTIGO EM DESTAQUE</span>
                    </a>
                    <div class="blog-featured-content">
                        <div class="blog-post-meta">
                            <?php if ( $feat_cat ) : ?>
                                <span class="post-cat-badge"><?php echo esc_html( $feat_cat->name ); ?></span>
                            <?php endif; ?>
                            <span class="post-meta-item">📅 <?php echo esc_html( get_the_date( 'd M Y', $feat_id ) ); ?></span>
                            <span class="post-meta-item">⏱ <?php echo esc_html( $feat_time ); ?></span>
                        </div>
                        <h2 class="blog-featured-title">
                            <a href="<?php echo esc_url( $feat_link ); ?>"><?php echo esc_html( get_the_title( $feat_id ) ); ?></a>
                        </h2>
                        <p class="blog-featured-excerpt">
                            <?php echo esc_html( has_excerpt( $feat_id ) ? get_the_excerpt( $feat_id ) : wp_trim_words( wp_strip_all_tags( $featured_post->post_content ), 32 ) ); ?>
                        </p>
                        <div class="blog-featured-footer">
                            <div class="post-author-mini">
                                <span class="author-badge-circle">🥋</span>
                                <div>
                                    <strong>Equipe Pedagógica ATA Premium</strong>
                                    <span>Método Songahm • Florianópolis</span>
                                </div>
                            </div>
                            <a href="<?php echo esc_url( $feat_link ); ?>" class="btn btn-gold btn-sm">
                                Ler Artigo Completo &rarr;
                            </a>
                        </div>
                    </div>
                </article>
            <?php endif; ?>

            <!-- Grid de Artigos -->
            <div class="blog-cards-grid" id="blogCardsGrid">
                <?php foreach ( $posts_array as $index => $post_item ) : ?>
                    <?php
                    $p_id    = $post_item->ID;
                    $p_cats  = get_the_category( $p_id );
                    $p_cat   = ! empty( $p_cats ) ? $p_cats[0] : null;
                    $p_cover = atapremium_get_post_cover_url( $p_id );
                    $p_time  = atapremium_reading_time( $post_item->post_content );
                    $p_link  = get_permalink( $p_id );
                    $p_exc   = has_excerpt( $p_id ) ? get_the_excerpt( $p_id ) : wp_trim_words( wp_strip_all_tags( $post_item->post_content ), 22 );
                    ?>
                    <article class="blog-card" data-post-cat="<?php echo esc_attr( $p_cat ? $p_cat->slug : 'geral' ); ?>" data-post-title="<?php echo esc_attr( strtolower( get_the_title( $p_id ) . ' ' . $p_exc ) ); ?>">
                        <a href="<?php echo esc_url( $p_link ); ?>" class="blog-card-media">
                            <img src="<?php echo esc_url( $p_cover ); ?>" alt="<?php echo esc_attr( get_the_title( $p_id ) ); ?>" loading="lazy">
                            <?php if ( $p_cat ) : ?>
                                <span class="blog-card-cat-pill"><?php echo esc_html( $p_cat->name ); ?></span>
                            <?php endif; ?>
                        </a>

                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span>📅 <?php echo esc_html( get_the_date( 'd M Y', $p_id ) ); ?></span>
                                <span>•</span>
                                <span>⏱ <?php echo esc_html( $p_time ); ?></span>
                            </div>

                            <h3 class="blog-card-title">
                                <a href="<?php echo esc_url( $p_link ); ?>"><?php echo esc_html( get_the_title( $p_id ) ); ?></a>
                            </h3>

                            <p class="blog-card-excerpt"><?php echo esc_html( $p_exc ); ?></p>

                            <div class="blog-card-footer">
                                <a href="<?php echo esc_url( $p_link ); ?>" class="blog-read-more-link">
                                    Ler artigo completo
                                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ( $blog_query->max_num_pages > 1 ) : ?>
                <div class="blog-pagination">
                    <?php
                    echo paginate_links( array(
                        'total'     => $blog_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '&larr; Anterior',
                        'next_text' => 'Próxima &rarr;',
                    ) );
                    ?>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="blog-empty-state text-center">
                <span class="badge-gold">NENHUM ARTIGO ENCONTRADO</span>
                <h2>Não encontramos artigos para essa busca</h2>
                <p>Experimente limpar o filtro ou visualizar todos os artigos do nosso blog.</p>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-gold">Ver Todos os Artigos</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 3. CTA DE CONVERSÃO DO BLOG -->
<section class="blog-bottom-cta-section">
    <div class="container">
        <div class="blog-cta-banner text-center">
            <span class="badge-gold">★ DA TEORIA PARA A PRÁTICA NO TATAME ★</span>
            <h2>Quer ver esses benefícios na rotina do seu filho?</h2>
            <p>Agende uma aula experimental gratuita em uma de nossas 3 unidades em Florianópolis (Alves de Brito, Col. Catarinense ou Spotmarkt) e conheça o Método Songahm de perto.</p>
            <div class="blog-cta-actions">
                <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-lg">Agendar Aula Experimental Grátis</a>
                <a href="https://wa.me/5548999313558?text=Ol%C3%A1!%20Estava%20lendo%20o%20Blog%20da%20ATA%20Premium%20e%20gostaria%20de%20agendar%20uma%20aula%20experimental." target="_blank" rel="noopener" class="btn btn-outline-gold btn-lg" data-track="whatsapp_blog_cta">Falar no WhatsApp</a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('blogQuickSearch');
    var cards = document.querySelectorAll('#blogCardsGrid .blog-card');
    if (searchInput && cards.length) {
        searchInput.addEventListener('input', function() {
            var q = this.value.toLowerCase().trim();
            cards.forEach(function(card) {
                var text = card.getAttribute('data-post-title') || '';
                card.style.display = (!q || text.indexOf(q) !== -1) ? '' : 'none';
            });
        });
    }
});
</script>

<?php get_footer(); ?>
