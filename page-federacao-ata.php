<?php
/**
 * Template Name: Federação ATA (Always Take Action)
 * Template Post Type: page
 * Descrição: Página institucional dedicada à Federação Mundial ATA, história do Taekwondo Songahm, Grão-Mestre H.U. Lee e presença global.
 */

get_header(); ?>

<main id="primary" class="site-main page-federacao-main">
    <!-- 1. Hero Federação ATA -->
    <section class="federacao-hero-section">
        <div class="federacao-hero-glow"></div>
        <div class="container federacao-hero-container">
            <div class="federacao-hero-content text-center">
                <span class="badge-gold">★ FEDERAÇÃO INTERNACIONAL ATA • DESDE 1969 ★</span>
                <h1 class="federacao-hero-title">
                    ATA Martial Arts: <span class="gold-gradient">Always Take Action</span>
                </h1>
                <p class="federacao-hero-subtitle">
                    A maior organização de Taekwondo Songahm do planeta. Uma história de liderança, tradição e desenvolvimento humano que já transformou a vida de mais de 1,5 milhão de praticantes ao redor do mundo.
                </p>
                <div class="federacao-hero-ctas">
                    <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-lg" data-track="cta_fed_agendar">
                        <span>Experimentar o Método em Floripa</span>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#historia" class="btn btn-outline-gold btn-lg">Conhecer Nossa História ↓</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Números Globais de Autoridade -->
    <section class="federacao-metrics-bar">
        <div class="container">
            <div class="fed-metrics-grid">
                <div class="fed-metric-card">
                    <span class="fed-metric-num gold-gradient">+1.5M</span>
                    <span class="fed-metric-lbl">Alunos Formados</span>
                    <p>Praticantes que desenvolveram caráter e disciplina no tatame</p>
                </div>
                <div class="fed-metric-card">
                    <span class="fed-metric-num gold-gradient">1969</span>
                    <span class="fed-metric-lbl">Ano de Fundação</span>
                    <p>Mais de 5 décadas de refinamento pedagógico contínuo</p>
                </div>
                <div class="fed-metric-card">
                    <span class="fed-metric-num gold-gradient">+20 Países</span>
                    <span class="fed-metric-lbl">Presença Internacional</span>
                    <p>América do Norte, América do Sul, Europa, Ásia e África</p>
                </div>
                <div class="fed-metric-card">
                    <span class="fed-metric-num gold-gradient">100%</span>
                    <span class="fed-metric-lbl">Padronização Global</span>
                    <p>O mesmo currículo de excelência ensinado em qualquer dojo do mundo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. História & O Legado do Eternal Grand Master H.U. Lee -->
    <section id="historia" class="federacao-history-section">
        <div class="container">
            <div class="fed-history-grid">
                <div class="fed-history-text">
                    <span class="badge-gold">ORIGEM & PROPÓSITO</span>
                    <h2>A Visão Revolucionária do <span class="gold-gradient">Grão-Mestre H.U. Lee</span></h2>
                    
                    <p class="lead-p">
                        Em 1969, nos Estados Unidos, o <strong>Eternal Grand Master Haeng Ung Lee</strong> fundou a <em>American Taekwondo Association (ATA)</em> com uma missão clara: resgatar a essência ética e formativa das artes marciais tradicionais, integrando-a a métodos pedagógicos modernos e científicos.
                    </p>
                    
                    <p>
                        Diferente dos sistemas focados unicamente em combate esportivo agressivo, o Grão-Mestre Lee desenvolveu o <strong>Método Songahm</strong>, concebido para que pessoas de todas as idades — crianças a partir dos 3 anos até adultos masters — pudessem evoluir com segurança anatômica, foco no desenvolvimento do caráter e formação de líderes para a sociedade.
                    </p>

                    <div class="fed-quote-box">
                        <p class="quote-text">
                            "O verdadeiro propósito do Taekwondo Songahm não é vencer o oponente lá fora, mas vencer as próprias fraquezas interiores: a dúvida, a preguiça e a falta de foco."
                        </p>
                        <span class="quote-author">— Eternal Grand Master H.U. Lee (1936–2000)</span>
                    </div>
                </div>

                <div class="fed-history-card-box">
                    <div class="fed-meaning-card">
                        <div class="meaning-header">
                            <span class="meaning-icon">⚡</span>
                            <h3>O Significado de ATA: "Always Take Action"</h3>
                        </div>
                        <p>
                            Na ATA, ensinar artes marciais é ensinar uma postura diante da vida. O lema <strong>"Always Take Action"</strong> (Sempre Tome Atitude) reflete a convicção de que o sucesso escolar, profissional e pessoal exige proatividade, coragem para dar o primeiro passo e resiliência para persistir.
                        </p>
                        <ul class="meaning-checklist">
                            <li>
                                <span class="check-icon">✓</span>
                                <div>
                                    <strong>Atitude diante dos estudos:</strong> Concentração voluntária e postura atenta.
                                </div>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <div>
                                    <strong>Atitude diante do bullying:</strong> Postura corporal firme, calma e segurança verbal.
                                </div>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <div>
                                    <strong>Atitude na liderança:</strong> Influência positiva e respeito aos pais e mestres.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Organizações Globais: ATA, WTTU & STF -->
    <section class="federacao-global-branches">
        <div class="container">
            <div class="section-title text-center">
                <span class="badge-gold">ESTRUTURA INTERNACIONAL</span>
                <h2>Uma Rede Mundial Integrada</h2>
                <p>A federação opera globalmente através de três grandes divisões integradas pelo mesmo código moral e técnico:</p>
            </div>

            <div class="branches-grid">
                <div class="branch-card">
                    <div class="branch-badge">Américas</div>
                    <h3>ATA Martial Arts</h3>
                    <span class="branch-sub">American Taekwondo Association</span>
                    <p>Sede mundial em Little Rock, Arkansas (EUA). A maior federação marcial da América do Norte, regulando torneios mundiais, seminários internacionais e certificações de liderança.</p>
                </div>

                <div class="branch-card">
                    <div class="branch-badge">Global</div>
                    <h3>WTTU</h3>
                    <span class="branch-sub">World Traditional Taekwondo Union</span>
                    <p>Divisão internacional responsável pela expansão e padronização da metodologia Songahm em países da Europa, Ásia, Oceania e África.</p>
                </div>

                <div class="branch-card highlight-gold">
                    <div class="branch-badge">América do Sul</div>
                    <h3>STF</h3>
                    <span class="branch-sub">Songahm Taekwondo Federation</span>
                    <p>Federação oficial para o Brasil e América do Sul. Garante a formação rigorosa e contínua dos instrutores certificados que atuam nas unidades de Florianópolis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Conexão com Florianópolis: A ATA Premium -->
    <section class="federacao-local-bridge">
        <div class="container">
            <div class="local-bridge-card">
                <div class="bridge-content">
                    <span class="badge-gold">PADRÃO INTERNACIONAL EM FLORIANÓPOLIS</span>
                    <h2>A Mesma Metodologia Global nos Dojos de Floripa</h2>
                    <p>
                        A <strong>ATA Premium Florianópolis</strong> é a extensão oficial dessa tradição. Nossos professores passam por recertificações internacionais anuais e utilizam a exata mesma didática pedagógica aplicada nos melhores dojos dos Estados Unidos e do mundo.
                    </p>
                    <div class="bridge-actions">
                        <a href="<?php echo esc_url( home_url( '/sobre-a-ata-premium/' ) ); ?>" class="btn btn-outline-gold">Conhecer ATA Premium Floripa →</a>
                        <a href="<?php echo esc_url( home_url( '/metodologia/' ) ); ?>" class="btn btn-outline-gold">Explorar Metodologia Songahm →</a>
                        <a href="<?php echo esc_url( home_url( '/equipe/' ) ); ?>" class="btn btn-outline-gold">Nossa Equipe de Instrutores →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Banner de Agendamento -->
    <section class="federacao-cta-section">
        <div class="container text-center">
            <span class="badge-gold">VAGAS ABERTAS</span>
            <h2>Dê o Primeiro Passo na Maior Escola Marcial do Mundo</h2>
            <p>Agende uma aula experimental gratuita em uma das nossas 3 unidades em Florianópolis e conheça o Método Songahm na prática.</p>
            <div class="fed-final-btns">
                <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-lg">Agendar Aula Gratuita</a>
                <a href="https://wa.me/5548999313558" target="_blank" rel="noopener" class="btn btn-outline btn-lg">WhatsApp Central</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
