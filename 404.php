<?php
/**
 * Template da Página 404 - Página Não Encontrada
 * ATA Martial Arts Premium Florianópolis
 */

get_header(); ?>

<main id="primary" class="site-main error-404-main">
    <!-- Imagem de fundo com foto da equipe/mestres e overlay de alto padrão -->
    <div class="error-404-bg-media">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/404-bg.jpg' ); ?>" alt="Equipe ATA Martial Arts Florianópolis" class="error-404-bg-img" loading="eager">
        <div class="error-404-overlay"></div>
    </div>

    <!-- Efeitos de iluminação de fundo -->
    <div class="error-404-glow-bg"></div>

    <div class="container error-404-container">
        <div class="error-404-card">
            <!-- Badge Superior -->
            <span class="badge-gold" data-i18n="p404_badge">★ ERRO 404 • PÁGINA NÃO ENCONTRADA ★</span>

            <!-- Número 404 Gigante Estilizado com Efeito Dourado -->
            <div class="error-404-number-wrap">
                <span class="error-404-number gold-gradient">404</span>
                <div class="error-404-belt-symbol">
                    <span class="belt-stripe black"></span>
                    <span class="belt-stripe gold"></span>
                </div>
            </div>

            <!-- Título e Mensagem Temática Marcial -->
            <h1 class="error-404-title" data-i18n="p404_title">
                Golpe fora do tatame? <span class="gold-gradient">Esta página não foi encontrada.</span>
            </h1>
            
            <p class="error-404-desc" data-i18n="p404_desc">
                Assim como no método Songahm, quando erramos um movimento, respiramos fundo e retornamos à postura de prontidão. Escolha um dos caminhos abaixo para continuar sua jornada:
            </p>

            <!-- Ações Principais -->
            <div class="error-404-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-404-primary" data-i18n="p404_btn_home">
                    <svg class="btn-icon-svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Voltar para o Início</span>
                </a>
                <a href="https://wa.me/5548999313558?text=Olá!%20Estava%20navegando%20no%20site%20da%20ATA%20Premium%20e%20preciso%20de%20ajuda." target="_blank" rel="noopener noreferrer" class="btn-404-wpp" data-i18n="p404_btn_wpp">
                    <svg class="btn-icon-svg wpp-svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Falar no WhatsApp</span>
                </a>
            </div>

            <!-- Cards de Atalhos Rápidos Elegantes -->
            <div class="error-404-shortcuts">
                <a href="<?php echo esc_url( home_url( '/#programas' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon-badge">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 2a10 10 0 0 0 0 20v-20z"></path>
                            <circle cx="12" cy="16.5" r="1.5" fill="currentColor"></circle>
                            <circle cx="12" cy="7.5" r="1.5" fill="#000"></circle>
                        </svg>
                    </div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card1_title">Programas por Idade</strong>
                        <span data-i18n="p404_card1_desc">Tigers (3-6), Kids (7-13), Teens e Adultos</span>
                    </div>
                    <div class="shortcut-arrow-btn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>

                <a href="<?php echo esc_url( home_url( '/#unidades' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon-badge">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card2_title">Nossas 3 Unidades</strong>
                        <span data-i18n="p404_card2_desc">Alves de Brito, Col. Catarinense e Spotmarkt</span>
                    </div>
                    <div class="shortcut-arrow-btn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>

                <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon-badge">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card3_title">Aula Cortesia</strong>
                        <span data-i18n="p404_card3_desc">Agende sua aula experimental sem compromisso</span>
                    </div>
                    <div class="shortcut-arrow-btn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
