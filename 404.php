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
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-gold btn-lg" data-i18n="p404_btn_home">
                    Voltar para o Início
                </a>
                <a href="https://wa.me/5548999313558?text=Olá!%20Estava%20navegando%20no%20site%20da%20ATA%20Premium%20e%20preciso%20de%20ajuda." target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg" data-i18n="p404_btn_wpp">
                    Falar no WhatsApp
                </a>
            </div>

            <!-- Cards de Atalhos Rápidos -->
            <div class="error-404-shortcuts">
                <a href="<?php echo esc_url( home_url( '/#programas' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon">🥋</div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card1_title">Programas por Idade</strong>
                        <span data-i18n="p404_card1_desc">Tigers (3-6), Kids (7-13), Teens e Adultos.</span>
                    </div>
                    <span class="shortcut-arrow">→</span>
                </a>

                <a href="<?php echo esc_url( home_url( '/#unidades' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon">📍</div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card2_title">Nossas 3 Unidades</strong>
                        <span data-i18n="p404_card2_desc">Alves de Brito, Col. Catarinense e Spotmarkt.</span>
                    </div>
                    <span class="shortcut-arrow">→</span>
                </a>

                <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="shortcut-card">
                    <div class="shortcut-icon">⚡</div>
                    <div class="shortcut-content">
                        <strong data-i18n="p404_card3_title">Aula Grátis</strong>
                        <span data-i18n="p404_card3_desc">Agende sua aula experimental sem compromisso.</span>
                    </div>
                    <span class="shortcut-arrow">→</span>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
