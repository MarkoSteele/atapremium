<?php
/**
 * Template Name: Sobre a ATA Premium
 * Template Post Type: page
 * Descrição: Página institucional completa sobre a história, metodologia Songahm, filosofia e presença da ATA Premium em Florianópolis.
 */

get_header(); ?>

<!-- 1. Hero Institucional -->
<section class="about-hero-section">
    <div class="about-hero-glow"></div>
    <div class="container about-hero-container">
        <div class="about-hero-content text-center">
            <span class="badge-gold">★ ATA MARTIAL ARTS • TRADIÇÃO INTERNACIONAL ★</span>
            <h1 class="about-hero-title">
                Mais de 50 Anos Formando Atitudes e <span class="gold-gradient">Líderes Dentro e Fora do Tatame</span>
            </h1>
            <p class="about-hero-subtitle">
                Fundada pelo Grão-Mestre H.U. Lee em 1969, a ATA (American Taekwondo Association) é uma das maiores organizações de artes marciais do planeta, com mais de 1,5 milhão de praticantes formados sob a metodologia Songahm.
            </p>
            <div class="about-hero-ctas">
                <a href="#agendamento" class="btn btn-gold btn-lg">Agendar Aula Experimental Grátis</a>
                <a href="#apresentacao" class="btn btn-outline btn-lg">Conhecer Nossa História ↓</a>
            </div>
        </div>
    </div>
</section>

<!-- 2. Seção de Apresentação com Imagem Oficial em Destaque -->
<section id="apresentacao" class="about-showcase-section">
    <div class="container">
        <div class="about-showcase-grid">
            <!-- Imagem de Apresentação em Destaque -->
            <div class="about-image-col">
                <div class="about-image-card">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/apresentacao.png' ); ?>" alt="Apresentação ATA Premium Martial Arts Florianópolis" class="about-showcase-img" loading="lazy">
                    <div class="about-image-badge">
                        <span>★ ATA Premium Florianópolis ★</span>
                    </div>
                </div>
            </div>

            <!-- Texto Institucional e Filosofia -->
            <div class="about-text-col">
                <span class="badge-gold">QUEM SOMOS & NOSSA MISSÃO</span>
                <h2>"Aqui, o objetivo não é formar lutadores. <span class="gold-gradient">É formar atitudes!"</span></h2>
                
                <div class="about-text-body">
                    <p>
                        A <strong>ATA Premium Martial Arts</strong> é a referência oficial do <strong>Método Songahm</strong> em Florianópolis. Muito além de ensinar chutes e técnicas de defesa pessoal, nossa missão é proporcionar um ambiente seguro, estimulante e acolhedor onde crianças, adolescentes e adultos constroem caráter, disciplina voluntária e confiança inabalável.
                    </p>
                    <p>
                        Criada em 1969 pelo <em>Eternal Grand Master H.U. Lee</em>, a ATA revolucionou o ensino das artes marciais no mundo ao introduzir um sistema pedagógico progressivo, que respeita a anatomia e o ritmo de cada faixa etária — desde os primeiros passos na infância até a formação de faixas pretas e líderes na vida adulta.
                    </p>
                </div>

                <div class="about-metrics-pills">
                    <div class="metric-pill-item">
                        <span class="pill-number">+1.5M</span>
                        <span class="pill-label">Alunos no Mundo</span>
                    </div>
                    <div class="metric-pill-item">
                        <span class="pill-number">50+ Anos</span>
                        <span class="pill-label">De Tradição Global</span>
                    </div>
                    <div class="metric-pill-item">
                        <span class="pill-number">3 Unidades</span>
                        <span class="pill-label">Em Florianópolis</span>
                    </div>
                    <div class="metric-pill-item">
                        <span class="pill-number">100%</span>
                        <span class="pill-label">Instrutores Certificados</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Os 4 Pilares do Método Songahm -->
<section class="about-pillars-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">METODOLOGIA EXCLUSIVA</span>
            <h2>Os 4 Pilares da Formação ATA</h2>
            <p>Uma didática desenvolvida para gerar impacto real no dia a dia, na escola, no trabalho e na família.</p>
        </div>

        <div class="about-pillars-grid">
            <div class="pillar-card">
                <div class="pillar-icon">🎯</div>
                <h3>1. Disciplina Voluntária</h3>
                <p>Ensinamos a criança a entender o valor das regras e dos limites por respeito mútuo, e não por imposição ou medo. Esse autocontrole reflete diretamente no foco escolar e no convívio familiar.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon">🧠</div>
                <h3>2. Inteligência Emocional</h3>
                <p>Canalização positiva de energia, controle de ansiedade diante de desafios e resiliência para transformar frustrações e erros em aprendizado contínuo.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon">🥋</div>
                <h3>3. Atitude de Faixa Preta</h3>
                <p>A graduação de faixa preta não é um destino final, mas um padrão de vida guiado por integridade, cortesia, honra, lealdade e liderança pelo exemplo.</p>
            </div>

            <div class="pillar-card">
                <div class="pillar-icon">🛡️</div>
                <h3>4. Autoproteção Inteligente</h3>
                <p>Técnicas modernas e biomecanicamente refinadas que ensinam postura firme contra o bullying e princípios reais de autoproteção física e psicológica.</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. Programas por Idade -->
<section class="about-programs-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">DOJO PARA TODA A FAMÍLIA</span>
            <h2>Programas Estruturados por Faixa Etária</h2>
            <p>Cada estágio do desenvolvimento conta com didática, linguagem e estímulos adequados.</p>
        </div>

        <div class="about-programs-grid">
            <div class="about-prog-card">
                <span class="prog-age-tag">3 a 6 anos</span>
                <h3>Tigers</h3>
                <p>Aulas lúdicas focadas em coordenação motora, equilíbrio, capacidade de escuta e primeiros limites com muita diversão.</p>
            </div>

            <div class="about-prog-card">
                <span class="prog-age-tag">7 a 13 anos</span>
                <h3>Kids</h3>
                <p>Construção de hábitos duradouros, disciplina voluntária, postura anti-bullying e foco que se reflete nas notas escolares.</p>
            </div>

            <div class="about-prog-card">
                <span class="prog-age-tag">11 a 15 anos</span>
                <h3>Adolescentes (Teens)</h3>
                <p>Refúgio positivo de convivência saudável, descompressão digital das telas, fortalecimento da autoimagem e inteligência emocional.</p>
            </div>

            <div class="about-prog-card">
                <span class="prog-age-tag">Adultos & Família</span>
                <h3>Masters & Família</h3>
                <p>Queima calórica, alívio do estresse, defesa pessoal prática e a oportunidade única de pais e filhos treinarem juntos.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. Nossas 3 Unidades em Florianópolis -->
<section class="about-units-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">ESTRUTURA & CONVENIÊNCIA</span>
            <h2>Conheça Nossas 3 Unidades em Florianópolis</h2>
            <p>Estruturas de padrão internacional pensadas para a melhor experiência da sua família.</p>
        </div>

        <div class="about-units-grid">
            <!-- Unidade 1 -->
            <div class="about-unit-box">
                <div class="unit-box-media">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/unidade-alves-de-brito-fachada.jpg' ); ?>" alt="Unidade Alves de Brito" loading="lazy">
                    <span class="unit-badge">Centro • Beira-Mar</span>
                </div>
                <div class="unit-box-content">
                    <h3>Unidade Alves de Brito</h3>
                    <p class="unit-addr">📍 Rua Alves de Brito, nº 33 – Centro</p>
                    <p class="unit-desc">A poucos passos da Beira-Mar Norte, com fácil acesso e estacionamento conveniado.</p>
                    <a href="<?php echo esc_url( home_url( '/unidade-alves-de-brito/' ) ); ?>" class="btn btn-gold btn-block btn-sm">Ver Detalhes da Unidade →</a>
                </div>
            </div>

            <!-- Unidade 2 -->
            <div class="about-unit-box">
                <div class="unit-box-media">
                    <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=800&auto=format&fit=crop" alt="Unidade Colégio Catarinense" loading="lazy">
                    <span class="unit-badge">Polo Escolar • Centro</span>
                </div>
                <div class="unit-box-content">
                    <h3>Unidade Colégio Catarinense</h3>
                    <p class="unit-addr">📍 Ao lado do Colégio Catarinense – Centro</p>
                    <p class="unit-desc">Logística perfeita para o contra-turno escolar e atmosfera acolhedora para os pais.</p>
                    <a href="<?php echo esc_url( home_url( '/unidade-colegio-catarinense/' ) ); ?>" class="btn btn-gold btn-block btn-sm">Ver Detalhes da Unidade →</a>
                </div>
            </div>

            <!-- Unidade 3 -->
            <div class="about-unit-box">
                <div class="unit-box-media">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=800&auto=format&fit=crop" alt="Unidade Spotmarkt" loading="lazy">
                    <span class="unit-badge">Córrego Grande • Spotmarkt</span>
                </div>
                <div class="unit-box-content">
                    <h3>Unidade Spotmarkt</h3>
                    <p class="unit-addr">📍 Mall Spotmarkt – Córrego Grande</p>
                    <p class="unit-desc">Conveniência total: cafés, gastronomia e estacionamento coberto com segurança 24h.</p>
                    <a href="<?php echo esc_url( home_url( '/unidade-spotmarkt/' ) ); ?>" class="btn btn-gold btn-block btn-sm">Ver Detalhes da Unidade →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Formulário de Agendamento da Aula Gratuita -->
<section id="agendamento" class="about-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header text-center">
                <span class="badge-gold">VAGAS LIMITADAS POR TURMA</span>
                <h2>Dê o Primeiro Passo: Agende Sua Aula Gratuita</h2>
                <p>Preencha os dados e nossa equipe entrará em contato via WhatsApp para confirmar o melhor horário na unidade de sua preferência.</p>
            </div>

            <form id="form-lead-home" class="lead-form-premium">
                <div class="form-group">
                    <label for="nome">Nome Completo (do aluno ou responsável) *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="telefone">WhatsApp (com DDD) *</label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(48) 99999-9999" required>
                </div>

                <div class="form-group">
                    <label for="unidade">Unidade de Preferência em Florianópolis *</label>
                    <select id="unidade" name="unidade" class="form-control" required>
                        <option value="" disabled selected>Selecione a unidade mais próxima...</option>
                        <option value="Unidade 1 - Alves de Brito (Centro)">Unidade 1 - Alves de Brito (Centro / Beira-Mar)</option>
                        <option value="Unidade 2 - Colégio Catarinense (Centro)">Unidade 2 - Ao lado do Col. Catarinense (Centro)</option>
                        <option value="Unidade 3 - Spotmarkt (Córrego Grande)">Unidade 3 - Spotmarkt Mall (Córrego Grande)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="faixa_etaria">Faixa Etária / Programa de Interesse *</label>
                    <select id="faixa_etaria" name="faixa_etaria" class="form-control" required>
                        <option value="" disabled selected>Selecione a faixa etária / programa...</option>
                        <option value="Tigers (3 a 6 anos)">Tigers (3 a 6 anos)</option>
                        <option value="Kids (7 a 13 anos)">Kids (7 a 13 anos)</option>
                        <option value="Adolescentes / Teens (11 a 15 anos)">Adolescentes / Teens (11 a 15 anos)</option>
                        <option value="Adultos e Família">Adultos e Família (Masters)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">E-mail (opcional)</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="seu@email.com">
                </div>

                <button type="submit" class="btn btn-gold btn-block btn-lg">Confirmar Agendamento Gratuito</button>
                <p class="form-privacy-note">🔒 Seus dados estão 100% seguros. Não enviamos spam. Contato exclusivo para confirmação da aula.</p>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
