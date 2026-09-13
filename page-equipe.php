<?php
/**
 * Template Name: Nossa Equipe e Instrutores
 * Template Post Type: page
 * Descrição: Página institucional dedicada aos mestres, instrutores certificados e corpo docente da ATA Premium Martial Arts em Florianópolis.
 */

get_header(); ?>

<main id="primary" class="site-main page-equipe-main">
    <!-- 1. Hero Equipe -->
    <section class="equipe-hero-section">
        <div class="equipe-hero-glow"></div>
        <div class="container equipe-hero-container">
            <div class="equipe-hero-content text-center">
                <span class="badge-gold">★ CORPO DOCENTE CERTIFICADO INTERNACIONALMENTE ★</span>
                <h1 class="equipe-hero-title">
                    Mestres e Instrutores Dedicados à <span class="gold-gradient">Formação de Atitudes</span>
                </h1>
                <p class="equipe-hero-subtitle">
                    Na ATA Premium Florianópolis, seu filho é guiado por profissionais que passam por recertificações internacionais contínuas, aliando rigor técnico marcial a uma pedagogia acolhedora, humana e segura.
                </p>
                <div class="equipe-hero-ctas">
                    <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-lg" data-track="cta_equipe_agendar">
                        <span>Conhecer Nossos Professores no Tatame</span>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#corpo-docente" class="btn btn-outline-gold btn-lg">Ver Corpo Docente ↓</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Foto Oficial em Destaque da Liderança ATA -->
    <section class="equipe-showcase-section">
        <div class="container">
            <div class="equipe-banner-wrapper">
                <div class="equipe-banner-img-box">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/autorizado-davi-master-barth-faraco.jpg' ); ?>" alt="Equipe de Mestres e Instrutores ATA Premium Florianópolis" class="equipe-highlight-img" loading="lazy">
                    <div class="equipe-banner-badge">
                        <span class="badge-icon">🥋</span>
                        <div class="badge-text">
                            <strong>Certificação Internacional ATA / STF</strong>
                            <span>Tradição marcial, pedagogia progressiva e liderança</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Pilares da Nossa Instrução -->
    <section class="equipe-pillars-section">
        <div class="container">
            <div class="section-title text-center">
                <span class="badge-gold">PADRÃO DE ENSINO</span>
                <h2>O Que Torna Nossos Instrutores Diferentes?</h2>
                <p>Nenhum professor entra em sala de aula sem passar pelo rigoroso programa de formação pedagógica internacional da ATA.</p>
            </div>

            <div class="equipe-pillars-grid">
                <div class="equipe-pillar-card">
                    <div class="pillar-icon-box">🛡️</div>
                    <h3>1. Formação Pedagógica e Não-Violência</h3>
                    <p>Nossos professores são treinados em psicologia do desenvolvimento infantil e mediação de conflitos. O objetivo é desenvolver respeito e autocontrole, sem qualquer estímulo à agressividade.</p>
                </div>

                <div class="equipe-pillar-card">
                    <div class="pillar-icon-box">📜</div>
                    <h3>2. Recertificação Internacional Contínua</h3>
                    <p>Anualmente, os instrutores da ATA passam por seminários técnicos e avaliações rigorosas de primeiros socorros, biomecânica e didática com mestres de renome global.</p>
                </div>

                <div class="equipe-pillar-card">
                    <div class="pillar-icon-box">🤝</div>
                    <h3>3. Acolhimento Individualizado</h3>
                    <p>Cada aluno é único. Nossos professores entendem os limites anatômicos e emocionais de cada criança e adulto, incentivando o progresso no próprio ritmo e comemorando cada conquista.</p>
                </div>

                <div class="equipe-pillar-card">
                    <div class="pillar-icon-box">🌟</div>
                    <h3>4. Liderança pelo Exemplo</h3>
                    <p>Dentro e fora do tatame, nossos instrutores vivem os valores que ensinam: pontualidade, escuta ativa, postura firme, humildade e ética irretocável.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Corpo Docente e Especialidades -->
    <section id="corpo-docente" class="equipe-members-section">
        <div class="container">
            <div class="section-title text-center">
                <span class="badge-gold">NOSSOS INSTRUTORES</span>
                <h2>Conheça a Liderança Técnica</h2>
                <p>Profissionais apaixonados por transformar vidas através do Taekwondo Songahm em Florianópolis.</p>
            </div>

            <div class="members-grid">
                <!-- Membro 1 -->
                <div class="member-card">
                    <div class="member-avatar-box">
                        <div class="member-initials avatar-gold">MB</div>
                    </div>
                    <div class="member-info">
                        <span class="member-belt-pill">Faixa Preta • Master Instructor</span>
                        <h3>Master Barth</h3>
                        <span class="member-role">Direção Técnica & Alta Liderança</span>
                        <p>Décadas de dedicação ao Taekwondo Songahm, referência nacional na formação de faixas pretas e no desenvolvimento de liderança para jovens e adultos.</p>
                        <div class="member-tags">
                            <span>Metodologia Songahm</span>
                            <span>Liderança Executiva</span>
                            <span>Adultos & Masters</span>
                        </div>
                    </div>
                </div>

                <!-- Membro 2 -->
                <div class="member-card">
                    <div class="member-avatar-box">
                        <div class="member-initials avatar-purple">DC</div>
                    </div>
                    <div class="member-info">
                        <span class="member-belt-pill">Faixa Preta Certificado ATA</span>
                        <h3>Instrutor Davi</h3>
                        <span class="member-role">Coordenação Pedagógica Infantojuvenil</span>
                        <p>Especialista em didática para a primeira infância (Tigers) e foco escolar para Kids. Paixão por transformar alunos tímidos em jovens confiantes e respeitosos.</p>
                        <div class="member-tags">
                            <span>Programa Tigers (3-6)</span>
                            <span>Programa Kids (7-13)</span>
                            <span>Anti-Bullying</span>
                        </div>
                    </div>
                </div>

                <!-- Membro 3 -->
                <div class="member-card">
                    <div class="member-avatar-box">
                        <div class="member-initials avatar-blue">PF</div>
                    </div>
                    <div class="member-info">
                        <span class="member-belt-pill">Faixa Preta Certificado ATA</span>
                        <h3>Instrutor Faraco</h3>
                        <span class="member-role">Defesa Pessoal & Treinamento Teens</span>
                        <p>Focado em condicionamento funcional, biomecânica e fortalecimento da autoestima para adolescentes, criando um ambiente de pertencimento saudável.</p>
                        <div class="member-tags">
                            <span>Adolescentes (Teens)</span>
                            <span>Defesa Pessoal</span>
                            <span>Condicionamento Físico</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Chamada para Aula com Nossos Mestres -->
    <section class="equipe-cta-section">
        <div class="container text-center">
            <div class="equipe-cta-card">
                <span class="badge-gold">VIVÊNCIA NO TATAME</span>
                <h2>Venha Fazer Uma Aula Com a Nossa Equipe</h2>
                <p>Experimente uma aula introdutória gratuita em qualquer uma de nossas 3 unidades em Florianópolis e sinta a diferença da didática ATA.</p>
                <div class="equipe-cta-actions">
                    <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-lg">Agendar Aula Gratuita</a>
                    <a href="https://wa.me/5548999313558" target="_blank" rel="noopener" class="btn btn-outline-gold btn-lg">Falar no WhatsApp</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
