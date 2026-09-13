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
                <div class="program-card-media">
                    <img src="https://images.unsplash.com/photo-1549476464-37392f717541?q=80&w=800&auto=format&fit=crop" alt="Programa ATA Tigers (3 a 6 anos)" class="program-card-img" loading="lazy">
                    <div class="program-media-overlay"></div>
                    <span class="program-tag-badge" data-i18n="program_tigers_tag">3 a 6 anos</span>
                </div>
                <div class="program-card-header">
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
                <div class="program-card-media">
                    <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=800&auto=format&fit=crop" alt="Programa ATA Kids (7 a 13 anos)" class="program-card-img" loading="lazy">
                    <div class="program-media-overlay"></div>
                    <span class="program-tag-badge" data-i18n="program_kids_tag">7 a 13 anos</span>
                </div>
                <div class="program-card-header">
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
                <div class="program-card-media">
                    <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=800&auto=format&fit=crop" alt="Programa ATA Teens (11 a 15 anos)" class="program-card-img" loading="lazy">
                    <div class="program-media-overlay"></div>
                    <span class="program-tag-badge" data-i18n="program_teens_tag">11 a 15 anos</span>
                </div>
                <div class="program-card-header">
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
                <div class="program-card-media">
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=800&auto=format&fit=crop" alt="Programa ATA Adultos e Masters" class="program-card-img" loading="lazy">
                    <div class="program-media-overlay"></div>
                    <span class="program-tag-badge" data-i18n="program_adults_tag">Adultos & Família</span>
                </div>
                <div class="program-card-header">
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
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ata-unidade-1-capa.webp' ); ?>" alt="Unidade Alves de Brito Centro" class="unit-img" loading="lazy">
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
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/unidade-2.png' ); ?>" alt="Unidade Colégio Catarinense" class="unit-img" loading="lazy">
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
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ata-spotmarket-capa.webp' ); ?>" alt="Unidade Spotmarkt Córrego Grande" class="unit-img" loading="lazy">
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

<!-- 7. DEPOIMENTOS DE FAMÍLIAS & ALUNOS (AVALIAÇÕES GOOGLE & RELATOS EM VÍDEO DO INSTAGRAM) -->
<section id="depoimentos" class="testimonials-section">
    <div class="container">
        <!-- Cabeçalho da Seção com Selo de Avaliação do Google -->
        <div class="section-title text-center reveal-on-scroll">
            <span class="badge-gold" data-i18n="testi_badge">★ PROVA SOCIAL • RECONHECIMENTO REAL ★</span>
            <h2 data-i18n="testi_title">Histórias de Transformação: O Relato das Famílias</h2>
            <p data-i18n="testi_subtitle">Veja como o Método Songahm desenvolveu foco, disciplina voluntária e confiança em nossos alunos em Florianópolis.</p>
            
            <!-- Barra de Confiança Google 5.0 -->
            <div class="google-trust-bar">
                <div class="google-rating-box">
                    <svg class="google-g-icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <div class="google-stars" aria-label="5 de 5 estrelas">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="google-score-info">
                        <strong>5.0 / 5.0</strong>
                        <span data-i18n="testi_google_count">• Mais de 150+ avaliações no Google</span>
                    </div>
                </div>
                <span class="google-verified-pill" data-i18n="testi_google_verified">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.6"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    Avaliações Verificadas
                </span>
            </div>
        </div>

        <!-- PARTE 1: Grid de Depoimentos Textuais (Mockups Google Reviews) -->
        <div class="reviews-grid-wrapper">
            <div class="reviews-grid">
                <!-- Review 1: Mariana Silveira -->
                <div class="review-card reveal-on-scroll delay-1">
                    <div class="review-card-header">
                        <div class="reviewer-avatar avatar-purple">MS</div>
                        <div class="reviewer-meta">
                            <h4>Mariana Silveira</h4>
                            <span class="reviewer-role">Mãe do Theo (6 anos) • Tigers</span>
                        </div>
                        <div class="google-mini-badge" title="Avaliação Google">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        </div>
                    </div>
                    <div class="review-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="review-text">
                        "O desenvolvimento do Theo depois que começou no programa Tigers foi impressionante. Ele era agitado e disperso, e hoje demonstra escuta atenta, postura firme e um respeito lindo pelos professores e colegas. O ambiente é acolhedor e muito seguro!"
                    </p>
                    <div class="review-footer">
                        <span class="review-unit-tag">📍 Unidade Alves de Brito</span>
                        <span class="review-date">Há 2 semanas</span>
                    </div>
                </div>

                <!-- Review 2: Carlos Eduardo Menezes -->
                <div class="review-card reveal-on-scroll delay-2">
                    <div class="review-card-header">
                        <div class="reviewer-avatar avatar-gold">CM</div>
                        <div class="reviewer-meta">
                            <h4>Carlos Eduardo Menezes</h4>
                            <span class="reviewer-role">Pai da Sofia (9 anos) • Kids</span>
                        </div>
                        <div class="google-mini-badge" title="Avaliação Google">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        </div>
                    </div>
                    <div class="review-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="review-text">
                        "A conveniência de ser ao lado do Colégio Catarinense facilitou a nossa rotina, mas o método nos conquistou logo na primeira aula. A Sofia ganhou uma autoconfiança notável que transformou a segurança dela na escola. Didática impecável!"
                    </p>
                    <div class="review-footer">
                        <span class="review-unit-tag">📍 Unidade Col. Catarinense</span>
                        <span class="review-date">Há 3 semanas</span>
                    </div>
                </div>

                <!-- Review 3: Renata & Gustavo Becker -->
                <div class="review-card reveal-on-scroll delay-3">
                    <div class="review-card-header">
                        <div class="reviewer-avatar avatar-blue">RB</div>
                        <div class="reviewer-meta">
                            <h4>Renata & Gustavo Becker</h4>
                            <span class="reviewer-role">Treino em Família • Adultos & Kids</span>
                        </div>
                        <div class="google-mini-badge" title="Avaliação Google">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        </div>
                    </div>
                    <div class="review-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="review-text">
                        "Treinar juntos virou o melhor momento da nossa semana. No Spotmarkt a estrutura é fantástica, com estacionamento amplo e segurança. Os professores ensinam com muita dedicação e respeito. Toda família deveria experimentar esse método!"
                    </p>
                    <div class="review-footer">
                        <span class="review-unit-tag">📍 Unidade Spotmarkt</span>
                        <span class="review-date">Há 1 mês</span>
                    </div>
                </div>

                <!-- Review 4: Lucas Fagundes -->
                <div class="review-card reveal-on-scroll delay-4">
                    <div class="review-card-header">
                        <div class="reviewer-avatar avatar-emerald">LF</div>
                        <div class="reviewer-meta">
                            <h4>Lucas Fagundes</h4>
                            <span class="reviewer-role">Faixa Vermelha • Programa Adultos</span>
                        </div>
                        <div class="google-mini-badge" title="Avaliação Google">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        </div>
                    </div>
                    <div class="review-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="review-text">
                        "Comecei aos 28 anos sem flexibilidade e buscando aliviar o estresse do trabalho. Na ATA encontrei disciplina marcial genuína, perdi 12kg e conquistei uma clareza e foco mental que utilizo diariamente na gestão dos meus negócios."
                    </p>
                    <div class="review-footer">
                        <span class="review-unit-tag">📍 Unidade Alves de Brito</span>
                        <span class="review-date">Há 1 mês</span>
                    </div>
                </div>

                <!-- Review 5: Juliana Castro -->
                <div class="review-card reveal-on-scroll delay-1">
                    <div class="review-card-header">
                        <div class="reviewer-avatar avatar-rose">JC</div>
                        <div class="reviewer-meta">
                            <h4>Juliana Castro</h4>
                            <span class="reviewer-role">Mãe do Bernardo (11 anos) • Teens</span>
                        </div>
                        <div class="google-mini-badge" title="Avaliação Google">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        </div>
                    </div>
                    <div class="review-stars">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="review-text">
                        "Meu filho era retraído e tímido. Na ATA ele foi acolhido de forma individualizada, fez amizades saudáveis e aprendeu a se posicionar com liderança. A melhora na postura corporal e nas notas foi visível em poucos meses."
                    </p>
                    <div class="review-footer">
                        <span class="review-unit-tag">📍 Unidade Spotmarkt</span>
                        <span class="review-date">Há 2 meses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PARTE 2: Cards de Depoimentos em Vídeo (Links Oficiais do Instagram) -->
        <div class="video-testimonials-block reveal-on-scroll">
            <div class="video-testimonials-header">
                <div class="video-header-badge-wrap">
                    <span class="badge-gold">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        <span>RELATOS EM VÍDEO</span>
                    </span>
                    <h3>Veja os Depoimentos em Vídeo no Instagram</h3>
                </div>
                <p>Assista aos relatos reais gravados diretamente por nossas famílias, pais e alunos sobre a experiência no tatame:</p>
            </div>

            <div class="video-testimonials-grid">
                <!-- Vídeo 1: Marlon e Filha -->
                <a href="https://www.instagram.com/p/DcEKY_PjI8l/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_marlon">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">👨‍👧 Família ATA</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Marlon e Filha</h4>
                        <p class="video-excerpt">"A conexão profunda entre pai e filha através da arte marcial e do exemplo de liderança."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>

                <!-- Vídeo 2: Dudu Ferreira -->
                <a href="https://www.instagram.com/p/DagBrKrpyRb/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_dudu">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">🥋 Superação & Foco</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Dudu Ferreira</h4>
                        <p class="video-excerpt">"Superando limites, conquistando autoconfiança e evoluindo a cada troca de faixa."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>

                <!-- Vídeo 3: Rogério Penetra -->
                <a href="https://www.instagram.com/p/DZPtAxXiNpt/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_rogerio">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">🔥 Disciplina & Rotina</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Rogério Penetra</h4>
                        <p class="video-excerpt">"Condicionamento físico, saúde integral e a construção de hábitos consistentes."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>

                <!-- Vídeo 4: Rodrigo -->
                <a href="https://www.instagram.com/p/DZNqdb-FH9a/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_rodrigo">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">⚡ Autocontrole & Mente</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Rodrigo</h4>
                        <p class="video-excerpt">"A vivência marcial além do tatame: autocontrole emocional, respeito e foco no dia a dia."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>

                <!-- Vídeo 5: Lorenzo Serpa -->
                <a href="https://www.instagram.com/p/DYxo9AeiCoo/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_lorenzo">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">🐯 Kids & Disciplina</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Lorenzo Serpa</h4>
                        <p class="video-excerpt">"Foco escolar, respeito aos limites e a alegria contagiante de treinar com propósito."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>

                <!-- Vídeo 6: Pedro e Família -->
                <a href="https://www.instagram.com/p/DYfLDatj18G/" target="_blank" rel="noopener noreferrer" class="video-testi-card" data-track="video_testimonial_pedro">
                    <div class="video-testi-media">
                        <div class="video-testi-overlay"></div>
                        <div class="video-play-badge">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="#ffffff"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                        <div class="video-insta-icon" title="Instagram">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#ffffff" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </div>
                        <span class="video-tag-pill">🌟 União Familiar</span>
                    </div>
                    <div class="video-testi-content">
                        <h4>Pedro e Família</h4>
                        <p class="video-excerpt">"Valores compartilhados e união entre gerações fortalecendo os laços familiares no tatame."</p>
                        <span class="video-cta-link">
                            Assistir no Instagram 
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Botão CTA Final da Seção -->
        <div class="testi-cta-bottom text-center reveal-on-scroll">
            <a href="#contato" class="btn btn-gold btn-lg" data-track="cta_testi_agendar">
                <span>Agendar Minha Aula Experimental Gratuita</span>
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<!-- 8. QUEBRA DE OBJEÇÕES (FAQ ACORDEON) -->
<section id="faq" class="faq-section">
    <!-- Efeito Parallax da Logo no Background do FAQ -->
    <div class="faq-parallax-watermark" aria-hidden="true">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="" class="faq-parallax-logo" loading="lazy">
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

    // Efeito Parallax Suave nas Logos de Fundo (Jornada e FAQ)
    const journeySec = document.querySelector('#jornada');
    const journeyLogo = document.querySelector('.journey-parallax-watermark');
    const faqSec = document.querySelector('#faq');
    const faqLogo = document.querySelector('.faq-parallax-watermark');

    const updateLogosParallax = () => {
        const windowHeight = window.innerHeight;

        if (journeySec && journeyLogo) {
            const rect = journeySec.getBoundingClientRect();
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 160;
                journeyLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
            }
        }

        if (faqSec && faqLogo) {
            const rect = faqSec.getBoundingClientRect();
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 160;
                faqLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
            }
        }
    };

    if (journeySec || faqSec) {
        window.addEventListener('scroll', updateLogosParallax, { passive: true });
        window.addEventListener('resize', updateLogosParallax, { passive: true });
        updateLogosParallax();
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
