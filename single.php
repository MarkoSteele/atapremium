<?php
/**
 * Template para Artigos Individuais (Single Post) - ATA Premium Martial Arts
 * Inclui Sumário Interativo (TOC) automático para H2/H3, barra de progresso de leitura,
 * compartilhamento, CTA lateral e seção de Artigos Similares (Mesma Categoria).
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        $post_id      = get_the_ID();
        $categories   = get_the_category( $post_id );
        $primary_cat  = ! empty( $categories ) ? $categories[0] : null;
        $cover_url    = atapremium_get_post_cover_url( $post_id );
        $reading_time = atapremium_reading_time( get_post_field( 'post_content', $post_id ) );

        $raw_content  = apply_filters( 'the_content', get_the_content() );
        $parsed       = atapremium_parse_content_and_toc( $raw_content );
        $post_html    = $parsed['content'];
        $toc_items    = $parsed['toc'];

        $related_posts = atapremium_get_related_posts( $post_id, 3 );
        $share_url     = rawurlencode( get_permalink( $post_id ) );
        $share_title   = rawurlencode( get_the_title( $post_id ) );
        ?>

        <!-- Barra de Progresso de Leitura no Topo -->
        <div class="reading-progress-container" aria-hidden="true">
            <div class="reading-progress-bar" id="readingProgressBar"></div>
        </div>

        <!-- 1. CABEÇALHO DO ARTIGO (SINGLE HERO) -->
        <article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'single-article-wrapper' ); ?>>
            <header class="single-hero-section">
                <div class="single-hero-glow"></div>
                <div class="container single-hero-container">
                    <!-- Breadcrumb Semântico -->
                    <nav class="single-breadcrumb" aria-label="Navegação estrutural">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
                        <span class="bc-sep">/</span>
                        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                        <?php if ( $primary_cat ) : ?>
                            <span class="bc-sep">/</span>
                            <a href="<?php echo esc_url( add_query_arg( 'categoria', $primary_cat->slug, home_url( '/blog/' ) ) ); ?>">
                                <?php echo esc_html( $primary_cat->name ); ?>
                            </a>
                        <?php endif; ?>
                    </nav>

                    <div class="single-meta-top">
                        <?php if ( $primary_cat ) : ?>
                            <a href="<?php echo esc_url( add_query_arg( 'categoria', $primary_cat->slug, home_url( '/blog/' ) ) ); ?>" class="single-cat-badge">
                                <?php echo esc_html( $primary_cat->name ); ?>
                            </a>
                        <?php endif; ?>
                        <span class="single-meta-pill">📅 <?php echo esc_html( get_the_date( 'd \d\e F \d\e Y', $post_id ) ); ?></span>
                        <span class="single-meta-pill">⏱ <?php echo esc_html( $reading_time ); ?></span>
                    </div>

                    <h1 class="single-post-title"><?php the_title(); ?></h1>

                    <?php if ( has_excerpt( $post_id ) ) : ?>
                        <p class="single-post-lead"><?php echo esc_html( get_the_excerpt( $post_id ) ); ?></p>
                    <?php endif; ?>

                    <div class="single-author-share-bar">
                        <div class="single-author-info">
                            <div class="single-author-avatar">🥋</div>
                            <div>
                                <strong>Equipe Pedagógica ATA Premium</strong>
                                <span>Especialistas no Método Songahm • Florianópolis</span>
                            </div>
                        </div>

                        <div class="single-share-actions">
                            <span class="share-label">Compartilhar:</span>
                            <a href="https://wa.me/?text=<?php echo $share_title . '%20-%20' . $share_url; ?>" target="_blank" rel="noopener" class="share-btn" title="Compartilhar no WhatsApp" aria-label="Compartilhar no WhatsApp">
                                WhatsApp
                            </a>
                            <button type="button" class="share-btn" id="btnCopyPostLink" data-url="<?php echo esc_attr( get_permalink( $post_id ) ); ?>">
                                Copiar Link
                            </button>
                        </div>
                    </div>

                    <!-- Imagem Destacada Principal -->
                    <div class="single-featured-image-card">
                        <img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" class="single-featured-img" loading="eager">
                    </div>
                </div>
            </header>

            <!-- 2. CORPO DO ARTIGO + SIDEBAR COM SUMÁRIO (TOC) -->
            <section class="single-body-section">
                <div class="container">
                    <div class="single-layout-grid">
                        <!-- Coluna Lateral: Sumário dos Títulos (TOC) & Card de Conversão -->
                        <aside class="single-sidebar" aria-label="Sumário do artigo e agendamento">
                            <div class="single-sticky-box">
                                <?php if ( ! empty( $toc_items ) ) : ?>
                                    <div class="toc-card" id="articleTocCard">
                                        <button type="button" class="toc-header-toggle" id="tocMobileToggle" aria-expanded="true">
                                            <div class="toc-title-wrap">
                                                <span class="toc-icon">📑</span>
                                                <strong>Sumário do Artigo</strong>
                                            </div>
                                            <span class="toc-chevron">▾</span>
                                        </button>
                                        <nav class="toc-nav" id="tocNavContent" aria-label="Índice de seções">
                                            <ol class="toc-list">
                                                <?php foreach ( $toc_items as $item ) : ?>
                                                    <li class="toc-item toc-level-<?php echo esc_attr( $item['level'] ); ?>">
                                                        <a href="#<?php echo esc_attr( $item['id'] ); ?>" class="toc-link" data-target="<?php echo esc_attr( $item['id'] ); ?>">
                                                            <?php echo esc_html( $item['title'] ); ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </nav>
                                    </div>
                                <?php endif; ?>

                                <!-- Card Lateral de Aula Experimental -->
                                <div class="sidebar-cta-card">
                                    <span class="badge-gold">★ AULA GRÁTIS EM FLORIPA ★</span>
                                    <h3>Desenvolva Foco, Disciplina e Confiança</h3>
                                    <p>Traga seu filho para vivenciar uma aula experimental gratuita na unidade mais próxima (Centro ou Córrego Grande).</p>
                                    <ul class="sidebar-cta-perks">
                                        <li>✓ Turmas divididas por faixa etária</li>
                                        <li>✓ Instrutores certificados ATA</li>
                                        <li>✓ 3 unidades em Florianópolis</li>
                                    </ul>
                                    <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-block btn-sm">
                                        Agendar Aula Experimental
                                    </a>
                                </div>
                            </div>
                        </aside>

                        <!-- Coluna Principal: Conteúdo do Artigo -->
                        <div class="single-main-column">
                            <div class="single-post-content" id="singlePostContent">
                                <?php echo $post_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>

                            <!-- Box Final de Autor e Categorias -->
                            <footer class="single-post-footer">
                                <div class="single-tags-row">
                                    <span class="tags-label">Categoria:</span>
                                    <?php foreach ( $categories as $cat ) : ?>
                                        <a href="<?php echo esc_url( add_query_arg( 'categoria', $cat->slug, home_url( '/blog/' ) ) ); ?>" class="single-tag-pill">
                                            <?php echo esc_html( $cat->name ); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                                <div class="single-author-bio-card">
                                    <div class="author-bio-icon">🥋</div>
                                    <div class="author-bio-text">
                                        <span class="badge-gold">SOBRE A ESCOLA</span>
                                        <h3>ATA Premium Martial Arts Florianópolis</h3>
                                        <p>Referência oficial do Método Songahm em Florianópolis. Com 3 unidades modernas (Alves de Brito, Colégio Catarinense e Spotmarkt), nossa missão não é formar lutadores, é formar atitudes e líderes para toda a vida.</p>
                                        <div class="author-bio-links">
                                            <a href="<?php echo esc_url( home_url( '/sobre-a-ata-premium/' ) ); ?>" class="btn btn-outline-gold btn-sm">Conhecer Nossa Escola</a>
                                            <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-sm">Agendar Aula Grátis</a>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. ARTIGOS SIMILARES (MESMA CATEGORIA) -->
            <?php if ( ! empty( $related_posts ) ) : ?>
                <section class="single-related-section">
                    <div class="container">
                        <div class="section-title text-center">
                            <span class="badge-gold">
                                ★ <?php echo $primary_cat ? 'MESMA CATEGORIA: ' . esc_html( strtoupper( $primary_cat->name ) ) : 'CONTINUE EVOLUINDO'; ?> ★
                            </span>
                            <h2>Artigos Similares que Você Vai Gostar</h2>
                            <p>Aprofunde seu conhecimento com outros conteúdos selecionados para a sua família.</p>
                        </div>

                        <div class="blog-cards-grid">
                            <?php foreach ( $related_posts as $rel_post ) : ?>
                                <?php
                                $r_id    = $rel_post->ID;
                                $r_cats  = get_the_category( $r_id );
                                $r_cat   = ! empty( $r_cats ) ? $r_cats[0] : null;
                                $r_cover = atapremium_get_post_cover_url( $r_id );
                                $r_time  = atapremium_reading_time( $rel_post->post_content );
                                $r_link  = get_permalink( $r_id );
                                $r_exc   = has_excerpt( $r_id ) ? get_the_excerpt( $r_id ) : wp_trim_words( wp_strip_all_tags( $rel_post->post_content ), 20 );
                                ?>
                                <article class="blog-card">
                                    <a href="<?php echo esc_url( $r_link ); ?>" class="blog-card-media">
                                        <img src="<?php echo esc_url( $r_cover ); ?>" alt="<?php echo esc_attr( get_the_title( $r_id ) ); ?>" loading="lazy">
                                        <?php if ( $r_cat ) : ?>
                                            <span class="blog-card-cat-pill"><?php echo esc_html( $r_cat->name ); ?></span>
                                        <?php endif; ?>
                                    </a>

                                    <div class="blog-card-body">
                                        <div class="blog-card-meta">
                                            <span>📅 <?php echo esc_html( get_the_date( 'd M Y', $r_id ) ); ?></span>
                                            <span>•</span>
                                            <span>⏱ <?php echo esc_html( $r_time ); ?></span>
                                        </div>

                                        <h3 class="blog-card-title">
                                            <a href="<?php echo esc_url( $r_link ); ?>"><?php echo esc_html( get_the_title( $r_id ) ); ?></a>
                                        </h3>

                                        <p class="blog-card-excerpt"><?php echo esc_html( $r_exc ); ?></p>

                                        <div class="blog-card-footer">
                                            <a href="<?php echo esc_url( $r_link ); ?>" class="blog-read-more-link">
                                                Ler artigo completo
                                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <div class="text-center" style="margin-top: 38px;">
                            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn-outline-gold">
                                &larr; Ver Todos os Artigos do Blog
                            </a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </article>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Barra de progresso de leitura e ScrollSpy do Sumário (TOC)
            var progressBar = document.getElementById('readingProgressBar');
            var contentEl = document.getElementById('singlePostContent');
            var tocLinks = document.querySelectorAll('.toc-link');
            var headings = contentEl ? contentEl.querySelectorAll('h2[id], h3[id]') : [];

            function updateReadingProgress() {
                if (!contentEl || !progressBar) return;
                var rect = contentEl.getBoundingClientRect();
                var windowHeight = window.innerHeight;
                var total = rect.height - windowHeight * 0.5;
                var current = -rect.top + windowHeight * 0.25;
                var pct = Math.max(0, Math.min(100, (current / Math.max(1, total)) * 100));
                progressBar.style.width = pct + '%';

                if (headings.length && tocLinks.length) {
                    var activeId = headings[0].id;
                    for (var i = 0; i < headings.length; i++) {
                        if (headings[i].getBoundingClientRect().top <= 150) {
                            activeId = headings[i].id;
                        }
                    }
                    tocLinks.forEach(function(link) {
                        if (link.getAttribute('data-target') === activeId) {
                            link.classList.add('is-active');
                        } else {
                            link.classList.remove('is-active');
                        }
                    });
                }
            }

            window.addEventListener('scroll', updateReadingProgress, { passive: true });
            updateReadingProgress();

            // 2. Scroll suave ao clicar nos itens do Sumário
            tocLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    var targetId = this.getAttribute('data-target');
                    var targetEl = document.getElementById(targetId);
                    if (targetEl) {
                        e.preventDefault();
                        var y = targetEl.getBoundingClientRect().top + window.pageYOffset - 110;
                        window.scrollTo({ top: y, behavior: 'smooth' });
                    }
                });
            });

            // 3. Toggle mobile do Sumário
            var tocToggle = document.getElementById('tocMobileToggle');
            var tocCard = document.getElementById('articleTocCard');
            if (tocToggle && tocCard) {
                tocToggle.addEventListener('click', function() {
                    var isCollapsed = tocCard.classList.toggle('is-collapsed');
                    this.setAttribute('aria-expanded', !isCollapsed ? 'true' : 'false');
                });
            }

            // 4. Botão Copiar Link
            var copyBtn = document.getElementById('btnCopyPostLink');
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    var url = this.getAttribute('data-url');
                    if (navigator.clipboard && url) {
                        navigator.clipboard.writeText(url);
                        var orig = this.textContent;
                        this.textContent = '✓ Link Copiado!';
                        var self = this;
                        setTimeout(function() { self.textContent = orig; }, 2200);
                    }
                });
            }
        });
        </script>
        <?php
    endwhile;
endif;

get_footer();
