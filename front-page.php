<?php
/**
 * Template Name: Landing Page - ATA Martial Arts Premium (Preto & Dourado)
 * Front page template unificado e focado em alta conversão
 */

get_header(); ?>

<!-- 1. HERO SECTION -->
<section id="hero" class="hero-section">
    <div class="hero-bg-media">
        <video autoplay muted loop playsinline webkit-playsinline preload="auto" class="hero-video-bg" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-poster.jpg' ); ?>">
            <source src="<?php echo esc_url( get_template_directory_uri() . '/hero-ata.mp4' ); ?>" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-content reveal-on-scroll">
            <span class="hero-badge-pill" data-i18n="hero_badge">★ ATA MARTIAL ARTS • MÉTODO SONGAHM | FLORIANÓPOLIS ★</span>
            
            <h1 class="hero-title" data-i18n="hero_title">
                Mais disciplina, foco e segurança para seus filhos — <span class="gold-gradient">dentro e fora do tatame.</span>
            </h1>
            
            <p class="hero-subtitle" data-i18n="hero_subtitle">
                Na ATA Premium em Florianópolis, cada treino é estruturado para desenvolver caráter, autocontrole e respeito por meio de uma metodologia internacional com mais de 1,5 milhão de praticantes.
            </p>

            <div class="hero-ctas">
                <a href="#contato" class="btn-hero-primary" data-track="cta_hero_agendar">
                    <span data-i18n="hero_cta_agendar">Agendar Aula Experimental Grátis</span>
                    <svg class="btn-arrow-svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="https://wa.me/5548999313558?text=Olá!%20Gostaria%20de%20informações%20sobre%20a%20aula%20experimental%20na%20ATA%20Premium." target="_blank" rel="noopener" class="btn-hero-wpp" data-track="cta_hero_wpp">
                    <svg class="wpp-svg-icon" viewBox="0 0 24 24" width="19" height="19" fill="currentColor">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span data-i18n="hero_cta_wpp">Falar com Central WhatsApp</span>
                </a>
            </div>

            <div class="hero-perks">
                <div class="perk-pill">
                    <span class="perk-check-badge">
                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <span data-i18n="hero_perk_1">Turmas 100% divididas por idade</span>
                </div>
                <div class="perk-pill">
                    <span class="perk-check-badge">
                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <span data-i18n="hero_perk_2">Ambiente seguro, acolhedor e supervisionado</span>
                </div>
                <div class="perk-pill">
                    <span class="perk-check-badge">
                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <span data-i18n="hero_perk_3">3 unidades completas em Florianópolis</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. PROVA SOCIAL & AUTORIDADE NUMÉRICA -->
<section id="autoridade" class="metrics-section">
    <div class="container">
        <div class="metrics-grid">
            <div class="metric-card reveal-on-scroll delay-1">
                <div class="metric-number" data-i18n="metric_num_1">+1.5 Milhão</div>
                <div class="metric-label" data-i18n="metric_lbl_1">Praticantes no Mundo</div>
                <p class="metric-desc" data-i18n="metric_desc_1">Taekwondo Songahm presente em dezenas de países (ATA / WTTU / STF)</p>
            </div>
            <div class="metric-card reveal-on-scroll delay-2">
                <div class="metric-number" data-i18n="metric_num_2">3 Unidades</div>
                <div class="metric-label" data-i18n="metric_lbl_2">Em Florianópolis</div>
                <p class="metric-desc" data-i18n="metric_desc_2">Estruturas completas no Centro e Córrego Grande (Spotmarkt)</p>
            </div>
            <div class="metric-card reveal-on-scroll delay-3">
                <div class="metric-number" data-i18n="metric_num_4">100%</div>
                <div class="metric-label" data-i18n="metric_lbl_4">Instrutores Certificados</div>
                <p class="metric-desc" data-i18n="metric_desc_4">Formação internacional contínua e foco no desenvolvimento humano</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. FILOSOFIA & MANIFESTO ATA -->
<section id="filosofia" class="philosophy-section">
    <div class="container">
        <div class="philosophy-box reveal-on-scroll">
            <span class="badge-gold" data-i18n="philosophy_badge">NOSSO COMPROMISSO</span>
            <h2 class="philosophy-quote" data-i18n="philosophy_quote">
                "Aqui, o objetivo não é formar lutadores. <span class="gold-gradient">É formar atitudes!</span>"
            </h2>
            <div class="gold-divider"></div>
            <p class="philosophy-text" data-i18n="philosophy_text">
                Escolher onde seu filho vai treinar é escolher com quem ele vai conviver. Na <strong>ATA Premium</strong>, criamos um ambiente de influência positiva estruturado para transformar limites em conquistas, canalizar energias e desenvolver competências socioemocionais indispensáveis para a vida toda: <strong>obediência por respeito, autocontrole emocional e persistência diante de desafios.</strong>
            </p>
            <div class="philosophy-instagram-callout">
                <span data-i18n="philosophy_insta_callout">Acompanhe os bastidores da nossa formação de líderes:</span>
                <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener" class="insta-link-badge">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    <span data-i18n="philosophy_insta_btn">@ata.premium no Instagram</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 4. PROGRAMAS POR FAIXA ETÁRIA -->
<section id="programas" class="programs-section">
    <div class="container">
        <div class="section-title text-center reveal-on-scroll">
            <span class="badge-gold" data-i18n="programs_badge">DIDÁTICA E METODOLOGIA</span>
            <h2 data-i18n="programs_title">Programas Estruturados por Idade</h2>
            <p data-i18n="programs_subtitle">Cada estágio do desenvolvimento exige estímulos, didática e linguagem adequados.</p>
        </div>

        <div class="programs-grid-4">
            <!-- Tigers -->
            <div class="program-card reveal-on-scroll delay-1">
                <div class="program-card-header">
                    <span class="program-tag" data-i18n="program_tigers_tag">3 a 6 anos</span>
                    <h3 data-i18n="program_tigers_title">Tigers</h3>
                    <p class="program-tagline" data-i18n="program_tigers_tagline">Primeiros limites, primeiras conquistas.</p>
                </div>
                <div class="program-card-body">
                    <p class="program-desc" data-i18n="program_tigers_desc">Aulas lúdicas e altamente dinâmicas que ensinam respeito às regras, canalização de energia e desenvolvimento motor.</p>
                    <ul class="program-benefits">
                        <li data-i18n="program_tigers_b1">Coordenação motora ampla e equilíbrio</li>
                        <li data-i18n="program_tigers_b2">Capacidade de escuta ativa e atenção</li>
                        <li data-i18n="program_tigers_b3">Socialização e primeiros limites</li>
                        <li data-i18n="program_tigers_b4">Noções fundamentais de autoproteção</li>
                    </ul>
                </div>
                <div class="program-card-footer">
                    <a href="#contato" class="btn btn-gold btn-block" data-track="program_tigers" data-i18n="program_tigers_btn">Agendar Tigers</a>
                </div>
            </div>

            <!-- Kids -->
            <div class="program-card reveal-on-scroll delay-2">
                <div class="program-card-header">
                    <span class="program-tag" data-i18n="program_kids_tag">7 a 13 anos</span>
                    <h3 data-i18n="program_kids_title">Kids</h3>
                    <p class="program-tagline" data-i18n="program_kids_tagline">Foco escolar, autoconfiança e anti-bullying.</p>
                </div>
                <div class="program-card-body">
                    <p class="program-desc" data-i18n="program_kids_desc">Fase decisiva para a construção de hábitos duradouros, fortalecimento da autoestima e disciplina que reflete nas notas.</p>
                    <ul class="program-benefits">
                        <li data-i18n="program_kids_b1">Disciplina voluntária e foco nos estudos</li>
                        <li data-i18n="program_kids_b2">Postura corporal firme contra o bullying</li>
                        <li data-i18n="program_kids_b3">Resiliência para lidar com frustrações</li>
                        <li data-i18n="program_kids_b4">Respeito aos pais e espírito de liderança</li>
                    </ul>
                </div>
                <div class="program-card-footer">
                    <a href="#contato" class="btn btn-gold btn-block" data-track="program_kids" data-i18n="program_kids_btn">Agendar Kids</a>
                </div>
            </div>

            <!-- Teens -->
            <div class="program-card reveal-on-scroll delay-3">
                <div class="program-card-header">
                    <span class="program-tag" data-i18n="program_teens_tag">11 a 15 anos</span>
                    <h3 data-i18n="program_teens_title">Adolescentes</h3>
                    <p class="program-tagline" data-i18n="program_teens_tagline">Estrutura, pertencimento e inteligência emocional.</p>
                </div>
                <div class="program-card-body">
                    <p class="program-desc" data-i18n="program_teens_desc">Um refúgio de convivência saudável para canalizar ansiedades, desintoxicar das telas e blindar a identidade.</p>
                    <ul class="program-benefits">
                        <li data-i18n="program_teens_b1">Condicionamento físico e flexibilidade</li>
                        <li data-i18n="program_teens_b2">Controle emocional e tomada de decisão</li>
                        <li data-i18n="program_teens_b3">Postura firme e descompressão digital</li>
                        <li data-i18n="program_teens_b4">Ambiente positivo de amizades sólidas</li>
                    </ul>
                </div>
                <div class="program-card-footer">
                    <a href="#contato" class="btn btn-gold btn-block" data-track="program_teens" data-i18n="program_teens_btn">Agendar Teens</a>
                </div>
            </div>

            <!-- Adultos & Família -->
            <div class="program-card reveal-on-scroll delay-4">
                <div class="program-card-header">
                    <span class="program-tag" data-i18n="program_adults_tag">Adultos & Família</span>
                    <h3 data-i18n="program_adults_title">Adultos e Masters</h3>
                    <p class="program-tagline" data-i18n="program_adults_tagline">Saúde, alívio do estresse e tempo de qualidade.</p>
                </div>
                <div class="program-card-body">
                    <p class="program-desc" data-i18n="program_adults_desc">Treinamento completo para queima calórica, defesa pessoal funcional e a oportunidade única de pais e filhos treinarem juntos.</p>
                    <ul class="program-benefits">
                        <li data-i18n="program_adults_b1">Perda de peso e tonificação muscular</li>
                        <li data-i18n="program_adults_b2">Defesa pessoal prática e inteligente</li>
                        <li data-i18n="program_adults_b3">Treino conjunto com a família</li>
                        <li data-i18n="program_adults_b4">Alívio do estresse e ganho de mobilidade</li>
                    </ul>
                </div>
                <div class="program-card-footer">
                    <a href="#contato" class="btn btn-gold btn-block" data-track="program_adultos" data-i18n="program_adults_btn">Agendar Adultos</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. SEÇÃO DE VÍDEOS VERTICAIS DO INSTAGRAM (@ATA.PREMIUM) -->
<section id="instagram" class="instagram-section">
    <div class="container">
        <div class="insta-section-header reveal-on-scroll">
            <div class="insta-header-left">
                <span class="badge-gold">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    <span data-i18n="insta_badge">@ATA.PREMIUM NO INSTAGRAM</span>
                </span>
                <h2 data-i18n="insta_title">Treinos e Bastidores em Vídeo</h2>
                <p data-i18n="insta_subtitle">Veja a energia, a disciplina e a evolução dos nossos alunos direto do tatame de Florianópolis.</p>
            </div>
            <div class="insta-header-right">
                <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener noreferrer" class="btn btn-gold">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    <span data-i18n="insta_btn_follow">Seguir @ata.premium</span>
                </a>
            </div>
        </div>

        <!-- Grid de 4 Vídeos Verticais (Aspect Ratio 9:16) com Autoplay Contínuo -->
        <div class="reels-grid">
            <!-- Reel 1: Unidade Alves de Brito -->
            <div class="reel-card is-playing reveal-on-scroll delay-1" data-video="alves-de-brito">
                <div class="reel-media-wrapper">
                    <video class="reel-video-element" autoplay muted loop playsinline webkit-playsinline preload="auto" poster="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=800&auto=format&fit=crop">
                        <source src="<?php echo esc_url( get_template_directory_uri() . '/Unidade1-card.mp4' ); ?>" type="video/mp4">
                    </video>
                    <div class="reel-overlay">
                        <span class="reel-tag-badge" data-i18n="reel_tag_1">Unidade Alves de Brito</span>
                        <button class="reel-play-btn" type="button" aria-label="Pausar ou reproduzir vídeo da Unidade Alves de Brito">
                            <svg class="icon-play" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                        <div class="reel-meta">
                            <p class="reel-title" data-i18n="reel_title_1">Treinos, energia e foco na Unidade Centro - Alves de Brito 🥋⚡</p>
                            <span class="reel-views" data-i18n="reel_view_insta">▶ Ver no Instagram</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reel 2: Unidade Colégio Catarinense -->
            <div class="reel-card is-playing reveal-on-scroll delay-2" data-video="catarinense">
                <div class="reel-media-wrapper">
                    <video class="reel-video-element" autoplay muted loop playsinline webkit-playsinline preload="auto" poster="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=800&auto=format&fit=crop">
                        <source src="<?php echo esc_url( get_template_directory_uri() . '/Unidade2-card.mp4' ); ?>" type="video/mp4">
                    </video>
                    <div class="reel-overlay">
                        <span class="reel-tag-badge" data-i18n="reel_tag_2">Unidade Col. Catarinense</span>
                        <button class="reel-play-btn" type="button" aria-label="Pausar ou reproduzir vídeo da Unidade Colégio Catarinense">
                            <svg class="icon-play" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                        <div class="reel-meta">
                            <p class="reel-title" data-i18n="reel_title_2">Estrutura completa e disciplina na Unidade Colégio Catarinense 🛡️</p>
                            <span class="reel-views" data-i18n="reel_view_insta">▶ Ver no Instagram</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reel 3: Unidade Spotmarkt -->
            <div class="reel-card is-playing reveal-on-scroll delay-3" data-video="spotmarkt">
                <div class="reel-media-wrapper">
                    <video class="reel-video-element" autoplay muted loop playsinline webkit-playsinline preload="auto" poster="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800&auto=format&fit=crop">
                        <source src="<?php echo esc_url( get_template_directory_uri() . '/Spotmarket-card.mp4' ); ?>" type="video/mp4">
                    </video>
                    <div class="reel-overlay">
                        <span class="reel-tag-badge" data-i18n="reel_tag_3">Unidade Spotmarkt</span>
                        <button class="reel-play-btn" type="button" aria-label="Pausar ou reproduzir vídeo da Unidade Spotmarkt">
                            <svg class="icon-play" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                        <div class="reel-meta">
                            <p class="reel-title" data-i18n="reel_title_3">Treinamento e conveniência no Mall Spotmarkt - Córrego Grande 🔥</p>
                            <span class="reel-views" data-i18n="reel_view_insta">▶ Ver no Instagram</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reel 4: Evento & Espetáculo -->
            <div class="reel-card is-playing reveal-on-scroll delay-4" data-video="espetaculo">
                <div class="reel-media-wrapper">
                    <video class="reel-video-element" autoplay muted loop playsinline webkit-playsinline preload="auto" poster="https://images.unsplash.com/photo-1509824227185-9c5a01ceba0d?q=80&w=800&auto=format&fit=crop">
                        <source src="<?php echo esc_url( get_template_directory_uri() . '/' . rawurlencode('ESPETÁCULO 1.mp4') ); ?>" type="video/mp4">
                    </video>
                    <div class="reel-overlay">
                        <span class="reel-tag-badge" data-i18n="reel_tag_4">Evento Oficial ATA</span>
                        <button class="reel-play-btn" type="button" aria-label="Pausar ou reproduzir vídeo do Espetáculo e Graduação">
                            <svg class="icon-play" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </button>
                        <div class="reel-meta">
                            <p class="reel-title" data-i18n="reel_title_4">O grande espetáculo e cerimônia de graduação das faixas 🥇✨</p>
                            <span class="reel-views" data-i18n="reel_view_insta">▶ Ver no Instagram</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="insta-bottom-cta text-center reveal-on-scroll">
            <p data-i18n="insta_community_text">Junte-se à nossa comunidade de mais de <strong>10 mil seguidores</strong> no Instagram!</p>
            <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener noreferrer" class="insta-follow-btn">
                <span class="insta-icon-circle">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                </span>
                <span data-i18n="insta_community_btn">@ata.premium • Acompanhar no Instagram</span>
            </a>
        </div>
    </div>
</section>

<!-- 6. NOSSAS UNIDADES EM FLORIANÓPOLIS (Cards com Imagem que levam à Página da Unidade) -->
<section id="unidades" class="units-section">
    <div class="container">
        <div class="section-title text-center reveal-on-scroll">
            <span class="badge-gold" data-i18n="units_badge">LOCALIZAÇÃO & CONVENIÊNCIA</span>
            <h2 data-i18n="units_title">Nossas 3 Unidades em Florianópolis</h2>
            <p data-i18n="units_subtitle">Clique na unidade para ver fotos, infraestrutura e horários exclusivos de cada dojo.</p>
        </div>

        <div class="units-grid">
            <!-- Unidade 1: Centro - Alves de Brito -->
            <div class="unit-card-interactive reveal-on-scroll delay-1">
                <a href="<?php echo esc_url( home_url( '/unidade-alves-de-brito/' ) ); ?>" class="unit-card-link-wrapper" title="Ver Unidade Alves de Brito">
                    <div class="unit-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=800&auto=format&fit=crop" alt="Unidade Alves de Brito Centro" class="unit-img" loading="lazy">
                        <div class="unit-badge-pill" data-i18n="unit_pill_1">Unidade 1 • Centro</div>
                        <div class="unit-image-overlay">
                            <span class="view-unit-badge" data-i18n="unit_hover_label">Ver Página da Unidade &rarr;</span>
                        </div>
                    </div>
                </a>
                
                <div class="unit-card-info">
                    <h3>
                        <a href="<?php echo esc_url( home_url( '/unidade-alves-de-brito/' ) ); ?>" data-i18n="unit_name_1">Unidade Alves de Brito</a>
                    </h3>
                    <div class="unit-details-list">
                        <p class="unit-detail-item">
                            <span class="icon">📍</span>
                            <span data-i18n="unit_addr_1">Rua Alves de Brito, nº 33 – Centro</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">📞</span>
                            <span>(48) 3039-0446</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">🕒</span>
                            <span data-i18n="unit_hours_1">Seg a Sex: 09h às 12h | 15h às 21h</span>
                        </p>
                    </div>

                    <div class="unit-card-actions">
                        <a href="<?php echo esc_url( home_url( '/unidade-alves-de-brito/' ) ); ?>" class="btn btn-gold btn-sm" data-i18n="unit_btn_explore">
                            Conhecer Unidade
                        </a>
                        <a href="https://wa.me/5548999313558?text=Olá,%20gostaria%20de%20agendar%20uma%20aula%20na%20Unidade%20Alves%20de%20Brito" target="_blank" rel="noopener" class="btn btn-outline-gold btn-sm" data-unidade="Alves de Brito" data-track="whatsapp_unidade" data-i18n="unit_btn_wpp">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Unidade 2: Centro - Colégio Catarinense -->
            <div class="unit-card-interactive reveal-on-scroll delay-2">
                <a href="<?php echo esc_url( home_url( '/unidade-colegio-catarinense/' ) ); ?>" class="unit-card-link-wrapper" title="Ver Unidade Colégio Catarinense">
                    <div class="unit-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=800&auto=format&fit=crop" alt="Unidade Colégio Catarinense" class="unit-img" loading="lazy">
                        <div class="unit-badge-pill" data-i18n="unit_pill_2">Unidade 2 • Centro</div>
                        <div class="unit-image-overlay">
                            <span class="view-unit-badge" data-i18n="unit_hover_label">Ver Página da Unidade &rarr;</span>
                        </div>
                    </div>
                </a>

                <div class="unit-card-info">
                    <h3>
                        <a href="<?php echo esc_url( home_url( '/unidade-colegio-catarinense/' ) ); ?>" data-i18n="unit_name_2">Unidade Colégio Catarinense</a>
                    </h3>
                    <div class="unit-details-list">
                        <p class="unit-detail-item">
                            <span class="icon">📍</span>
                            <span data-i18n="unit_addr_2">Ao lado do Colégio Catarinense – Centro</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">📞</span>
                            <span>(48) 3028-0446</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">🕒</span>
                            <span data-i18n="unit_hours_2">Seg a Sex: 09h às 12h | 15h às 21h</span>
                        </p>
                    </div>

                    <div class="unit-card-actions">
                        <a href="<?php echo esc_url( home_url( '/unidade-colegio-catarinense/' ) ); ?>" class="btn btn-gold btn-sm" data-i18n="unit_btn_explore">
                            Conhecer Unidade
                        </a>
                        <a href="https://wa.me/5548999313558?text=Olá,%20gostaria%20de%20agendar%20uma%20aula%20na%20Unidade%20Colégio%20Catarinense" target="_blank" rel="noopener" class="btn btn-outline-gold btn-sm" data-unidade="Colegio Catarinense" data-track="whatsapp_unidade" data-i18n="unit_btn_wpp">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Unidade 3: Córrego Grande - Spotmarkt -->
            <div class="unit-card-interactive reveal-on-scroll delay-3">
                <a href="<?php echo esc_url( home_url( '/unidade-spotmarkt/' ) ); ?>" class="unit-card-link-wrapper" title="Ver Unidade Spotmarkt">
                    <div class="unit-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800&auto=format&fit=crop" alt="Unidade Spotmarkt Córrego Grande" class="unit-img" loading="lazy">
                        <div class="unit-badge-pill" data-i18n="unit_pill_3">Unidade 3 • Córrego Grande</div>
                        <div class="unit-image-overlay">
                            <span class="view-unit-badge" data-i18n="unit_hover_label">Ver Página da Unidade &rarr;</span>
                        </div>
                    </div>
                </a>

                <div class="unit-card-info">
                    <h3>
                        <a href="<?php echo esc_url( home_url( '/unidade-spotmarkt/' ) ); ?>" data-i18n="unit_name_3">Unidade Spotmarkt</a>
                    </h3>
                    <div class="unit-details-list">
                        <p class="unit-detail-item">
                            <span class="icon">📍</span>
                            <span data-i18n="unit_addr_3">Mall Spotmarkt – Córrego Grande</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">📞</span>
                            <span>(48) 99951-0446</span>
                        </p>
                        <p class="unit-detail-item">
                            <span class="icon">🕒</span>
                            <span data-i18n="unit_hours_3">Seg a Sex: 09h às 12h | 15h às 21h</span>
                        </p>
                    </div>

                    <div class="unit-card-actions">
                        <a href="<?php echo esc_url( home_url( '/unidade-spotmarkt/' ) ); ?>" class="btn btn-gold btn-sm" data-i18n="unit_btn_explore">
                            Conhecer Unidade
                        </a>
                        <a href="https://wa.me/5548999313558?text=Olá,%20gostaria%20de%20agendar%20uma%20aula%20na%20Unidade%20Spotmarkt" target="_blank" rel="noopener" class="btn btn-outline-gold btn-sm" data-unidade="Spotmarkt" data-track="whatsapp_unidade" data-i18n="unit_btn_wpp">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. A JORNADA DAS FAIXAS (SONGAHM) - TIMELINE INTERATIVA COM SCROLL -->
<section id="jornada" class="journey-section">
    <!-- Foto de Fundo com Blur & Gradiente de Profundidade -->
    <div class="journey-bg-wrapper" aria-hidden="true">
        <div class="journey-bg-image"></div>
        <div class="journey-bg-overlay"></div>
    </div>

    <div class="container journey-container">
        <div class="section-title text-center reveal-on-scroll">
            <span class="badge-gold" data-i18n="journey_badge">TRADIÇÃO & METÁFORA</span>
            <h2 data-i18n="journey_title">A Jornada Songahm: Do Templo ao Pinheiro</h2>
            <p data-i18n="journey_subtitle">O crescimento só é sólido quando as raízes são tão fortes quanto a copa da árvore.</p>
        </div>

        <div class="journey-timeline-wrapper">
            <!-- Trilho Vertical & Barra de Progresso Dourada Preenchida ao Rolar -->
            <div class="timeline-vertical-track" aria-hidden="true">
                <div class="timeline-progress-bar"></div>
            </div>

            <div class="journey-timeline">
                <!-- Passo 1: Branca -->
                <div class="timeline-item reveal-on-scroll delay-1" data-step="1">
                    <div class="timeline-marker">
                        <span class="marker-glow"></span>
                        <span class="marker-dot belt-white"></span>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <span class="timeline-step-pill" data-i18n="timeline_step_1">1ª ETAPA • A SEMENTE</span>
                            <span class="belt-label-tag belt-tag-white" data-i18n="belt_tag_1">Faixa Branca</span>
                        </div>
                        <h3 data-i18n="timeline_title_1">O Início da Jornada</h3>
                        <p data-i18n="timeline_desc_1">O aluno inicia sem conhecimento prévio — a terra pura pronta para ser cultivada. Aprende a etiqueta do tatame, a ouvir com atenção e os fundamentos do respeito e da postura marcial.</p>
                    </div>
                </div>

                <!-- Passo 2: Coloridas -->
                <div class="timeline-item reveal-on-scroll delay-2" data-step="2">
                    <div class="timeline-marker">
                        <span class="marker-glow"></span>
                        <span class="marker-dot belt-gold"></span>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <span class="timeline-step-pill" data-i18n="timeline_step_2">2ª ETAPA • AS RAÍZES</span>
                            <span class="belt-label-tag belt-tag-gold" data-i18n="belt_tag_2">Faixas Coloridas</span>
                        </div>
                        <h3 data-i18n="timeline_title_2">A Criação das Raízes</h3>
                        <p data-i18n="timeline_desc_2">Fase de desenvolvimento e superação de barreiras. O praticante desenvolve tônus muscular, agilidade, perseverança e aprende a transformar erros em aprendizado constante.</p>
                    </div>
                </div>

                <!-- Passo 3: Vermelha -->
                <div class="timeline-item reveal-on-scroll delay-3" data-step="3">
                    <div class="timeline-marker">
                        <span class="marker-glow"></span>
                        <span class="marker-dot belt-red"></span>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <span class="timeline-step-pill" data-i18n="timeline_step_3">3ª ETAPA • O SOL POENTE</span>
                            <span class="belt-label-tag belt-tag-red" data-i18n="belt_tag_3">Faixa Vermelha</span>
                        </div>
                        <h3 data-i18n="timeline_title_3">A Maturidade Técnica</h3>
                        <p data-i18n="timeline_desc_3">Fase de nobreza e consolidação técnica. A disciplina física atinge excelência e o aluno passa a focar no refinamento mental, autocontrole e liderança.</p>
                    </div>
                </div>

                <!-- Passo 4: Preta -->
                <div class="timeline-item reveal-on-scroll delay-4" data-step="4">
                    <div class="timeline-marker">
                        <span class="marker-glow"></span>
                        <span class="marker-dot belt-black"></span>
                    </div>
                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <span class="timeline-step-pill" data-i18n="timeline_step_4">4ª ETAPA • O PINHEIRO ETERNO</span>
                            <span class="belt-label-tag belt-tag-black" data-i18n="belt_tag_4">Faixa Preta</span>
                        </div>
                        <h3 data-i18n="timeline_title_4">A Formação de Atitudes</h3>
                        <p data-i18n="timeline_desc_4">A vitória sobre a dúvida e a escuridão da ignorância. Não é a linha de chegada, mas o verdadeiro recomeço onde o praticante lidera pelo exemplo e planta sementes para toda a comunidade.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. QUEBRA DE OBJEÇÕES (FAQ ACORDEON) -->
<section id="faq" class="faq-section">
    <!-- Efeito Parallax da Logo no Background do FAQ -->
    <div class="faq-parallax-watermark" aria-hidden="true">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/logo.png' ); ?>" alt="" class="faq-parallax-logo" loading="lazy">
    </div>

    <div class="container">
        <div class="section-title text-center reveal-on-scroll">
            <span class="badge-gold" data-i18n="faq_badge">DÚVIDAS FREQUENTES</span>
            <h2 data-i18n="faq_title">Perguntas Frequentes dos Pais</h2>
            <p data-i18n="faq_subtitle">Respostas diretas e transparentes para você se sentir 100% seguro.</p>
        </div>

        <div class="faq-container">
            <div class="faq-item reveal-on-scroll delay-1">
                <button class="faq-question" type="button">
                    <span data-i18n="faq_q1">Meu filho já é muito agitado/hiperativo. Ele vai ficar mais agressivo fazendo Taekwondo?</span>
                </button>
                <div class="faq-answer">
                    <p data-i18n="faq_a1">Não, muito pelo contrário. No método Songahm da ATA, a energia excedente da criança é canalizada de forma positiva e produtiva. O treino desenvolve autocontrole, concentração, respiração e respeito rigoroso aos limites. Nossos alunos aprendem desde o primeiro dia que as técnicas marciais existem exclusivamente para autoproteção em situações extremas, e nunca para iniciar conflitos ou intimidar colegas.</p>
                </div>
            </div>

            <div class="faq-item reveal-on-scroll delay-2">
                <button class="faq-question" type="button">
                    <span data-i18n="faq_q2">Existe contato físico violento nas aulas? Meu filho corre risco de se machucar?</span>
                </button>
                <div class="faq-answer">
                    <p data-i18n="faq_a2">A integridade e segurança dos alunos são prioridades absolutas. O treino com contato é gradual, estritamente controlado e supervisionado por professores com certificação internacional. Todas as atividades contam com equipamentos de proteção homologados (capacetes, protetores torácicos, luvas e caneleiras), respeitando o ritmo e a anatomia de cada faixa etária.</p>
                </div>
            </div>

            <div class="faq-item reveal-on-scroll delay-3">
                <button class="faq-question" type="button">
                    <span data-i18n="faq_q3">Meu filho é tímido e tem dificuldade de fazer amigos. Ele vai conseguir se adaptar?</span>
                </button>
                <div class="faq-answer">
                    <p data-i18n="faq_a3">Com certeza. O ambiente da ATA é acolhedor, inclusivo e totalmente livre de comparações depreciativas. No tatame, a criança tímida é encorajada a se expressar, adquire postura corporal firme, passa a olhar nos olhos com segurança e desenvolve autoconfiança convivendo com colegas que celebram cada conquista em grupo.</p>
                </div>
            </div>

            <div class="faq-item reveal-on-scroll delay-4">
                <button class="faq-question" type="button">
                    <span data-i18n="faq_q4">Meninas e mulheres podem treinar na ATA?</span>
                </button>
                <div class="faq-answer">
                    <p data-i18n="faq_a4">Com certeza! O Taekwondo Songahm baseia-se em biomecânica, alavancagem, velocidade e técnica — e não em force bruta. É uma das artes marciais mais recomendadas do mundo para desenvolver autoconfiança, condicionamento físico e habilidades práticas de defesa pessoal feminina.</p>
                </div>
            </div>

            <div class="faq-item reveal-on-scroll delay-5">
                <button class="faq-question" type="button">
                    <span data-i18n="faq_q5">Adultos sem nenhum preparo físico ou flexibilidade podem começar a treinar?</span>
                </button>
                <div class="faq-answer">
                    <p data-i18n="faq_a5">Sim, você pode começar exatamente como está! Mais de 80% dos nossos alunos adultos nunca haviam praticado arte marcial antes. Nossas aulas são planejadas para que você evolua no seu próprio ritmo, ganhando mobilidade, queima calórica e condicionamento gradualmente, sem risco de sobrecarga.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 9. FORMULÁRIO FINAL DE CAPTURA & CONVERSÃO -->
<section id="contato" class="contact-section">
    <div class="container">
        <div class="contact-card-wrapper reveal-on-scroll">
            <div class="contact-card-header text-center">
                <span class="badge-gold" data-i18n="contact_badge">VAGAS LIMITADAS POR TURMA</span>
                <h2 data-i18n="contact_title">Dê o Primeiro Passo: Agende Sua Aula Gratuita</h2>
                <p data-i18n="contact_subtitle">Preencha os dados abaixo e nossa equipe entrará em contato via WhatsApp para confirmar o melhor horário na unidade de sua preferência.</p>
            </div>

            <div class="form-container-box">
                <form id="form-lead-home" class="lead-capture-form">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="nome" data-i18n="form_lbl_name">Nome Completo (do aluno ou responsável) *</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" data-i18n-ph="form_ph_name" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone" data-i18n="form_lbl_phone">WhatsApp (com DDD) *</label>
                            <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(48) 99999-9999" data-i18n-ph="form_ph_phone" required>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="unidade" data-i18n="form_lbl_unit">Unidade de Preferência em Floripa *</label>
                            <select id="unidade" name="unidade" class="form-control" required>
                                <option value="" disabled selected data-i18n="form_opt_unit_placeholder">Selecione a unidade mais próxima...</option>
                                <option value="Unidade 1 - Alves de Brito (Centro)" data-i18n="form_opt_u1">Unidade 1 - Rua Alves de Brito, nº 33 (Centro)</option>
                                <option value="Unidade 2 - Colégio Catarinense (Centro)" data-i18n="form_opt_u2">Unidade 2 - Ao lado do Col. Catarinense (Centro)</option>
                                <option value="Unidade 3 - Spotmarkt (Córrego Grande)" data-i18n="form_opt_u3">Unidade 3 - Spotmarkt (Córrego Grande)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="faixa_etaria" data-i18n="form_lbl_program">Faixa Etária / Programa de Interesse *</label>
                            <select id="faixa_etaria" name="faixa_etaria" class="form-control" required>
                                <option value="" disabled selected data-i18n="form_opt_prog_placeholder">Selecione o programa...</option>
                                <option value="Tigers (3 a 6 anos)" data-i18n="form_opt_p1">Tigers (3 a 6 anos)</option>
                                <option value="Kids (7 a 13 anos)" data-i18n="form_opt_p2">Kids (7 a 13 anos)</option>
                                <option value="Teens (11 a 15 anos)" data-i18n="form_opt_p3">Adolescentes / Teens (11 a 15 anos)</option>
                                <option value="Adultos e Família" data-i18n="form_opt_p4">Adultos e Família (Masters)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" data-i18n="form_lbl_email">E-mail (opcional)</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="seu@email.com" data-i18n-ph="form_ph_email">
                    </div>

                    <button type="submit" class="btn btn-gold btn-block btn-lg" data-track="cta_form_final" data-i18n="form_btn_submit">
                        Confirmar Agendamento Gratuito
                    </button>
                    
                    <p class="form-security-note" data-i18n="form_security_note">
                        🔒 Seus dados estão 100% seguros. Não enviamos spam. Contato exclusivo para confirmação da aula experimental.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Interações JS: FAQ Acordeon + Rastreamento GTM -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // FAQ Acordeon
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            const isActive = item.classList.contains('active');

            document.querySelectorAll('.faq-item').forEach(other => {
                other.classList.remove('active');
                const ans = other.querySelector('.faq-answer');
                if (ans) ans.style.maxHeight = null;
            });

            if (!isActive) {
                item.classList.add('active');
                const answer = item.querySelector('.faq-answer');
                if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });

    // Autoplay Contínuo com IntersectionObserver nos Vídeos Verticais (Reels)
    const reelCards = document.querySelectorAll('.reel-card');
    const playVideo = (video, card) => {
        video.muted = true;
        const playPromise = video.play();
        if (playPromise !== undefined) {
            playPromise.then(() => {
                card.classList.add('is-playing');
            }).catch(() => {});
        }
    };

    if ('IntersectionObserver' in window) {
        const videoObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const card = entry.target;
                const video = card.querySelector('.reel-video-element');
                if (!video) return;
                if (entry.isIntersecting) {
                    playVideo(video, card);
                }
            });
        }, { threshold: 0.15 });

        reelCards.forEach(card => videoObserver.observe(card));
    } else {
        reelCards.forEach(card => {
            const video = card.querySelector('.reel-video-element');
            if (video) playVideo(video, card);
        });
    }

    reelCards.forEach(card => {
        const video = card.querySelector('.reel-video-element');
        const playBtn = card.querySelector('.reel-play-btn');
        if (!video) return;

        // Clique no botão ou card para alternar reprodução
        if (playBtn) {
            playBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (video.paused) {
                    playVideo(video, card);
                } else {
                    video.pause();
                    card.classList.remove('is-playing');
                }
            });
        }

        card.addEventListener('click', (e) => {
            if (e.target.closest('.reel-play-btn')) return;
            if (video.paused) {
                playVideo(video, card);
            }
        });
    });

    // Efeito Parallax Suave na Logo de Fundo do FAQ
    const faqSection = document.querySelector('#faq');
    const faqLogo = document.querySelector('.faq-parallax-watermark');
    if (faqSection && faqLogo) {
        const updateFaqParallax = () => {
            const rect = faqSection.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 140; // Amplitude suave
                faqLogo.style.transform = `translate(-50%, calc(-50% + ${translateY}px))`;
            }
        };
        window.addEventListener('scroll', updateFaqParallax, { passive: true });
        updateFaqParallax();
    }

    // Rastreamento WhatsApp Dinâmico (GTM DataLayer)
    document.querySelectorAll('[data-track="whatsapp_unidade"], [data-track="cta_hero_wpp"]').forEach(link => {
        link.addEventListener('click', function() {
            const unidade = this.getAttribute('data-unidade') || 'Central';
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'click_whatsapp',
                unidade_clicada: unidade,
                link_url: this.href
            });
        });
    });
});
</script>

<?php get_footer(); ?>
