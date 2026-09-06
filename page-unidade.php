<?php
/**
 * Template Name: Página da Unidade - ATA Premium
 * Descrição: Template sob medida com endereço, história da unidade, vídeo em destaque, carrossel de fotos, diferenciais e agendamento.
 */

get_header();

// Identifica qual unidade está sendo exibida pelo slug da página ou parâmetro GET
$slug = get_post_field( 'post_name', get_post() );
$unidade_id = isset($_GET['unidade']) ? sanitize_text_field($_GET['unidade']) : $slug;

// Dados completos e enriquecidos das 3 unidades em Florianópolis
$unidades_data = [
    'alves-de-brito' => [
        'id'          => 'alves-de-brito',
        'nome'        => 'Unidade 1 - Centro (Alves de Brito)',
        'titulo'      => 'Unidade Alves de Brito',
        'badge'       => 'CENTRO • BEIRA-MAR NORTE',
        'tagline'     => 'A poucos passos da Beira-Mar Norte, no coração nobre de Florianópolis.',
        'subtitulo'   => 'Tradição, estrutura completa e excelência marcial no centro de Florianópolis.',
        'endereco'    => 'Rua Alves de Brito, nº 33 – Centro, Florianópolis - SC',
        'bairro'      => 'Centro / Região da Beira-Mar',
        'telefone'    => '(48) 3039-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => get_template_directory_uri() . '/Unidade1-card.mp4',
        'imagem_hero' => get_template_directory_uri() . '/assets/images/unidade-alves-de-brito-fachada.jpg',
        'sobre_titulo'=> 'Localização Nobre e Estratégica Próxima à Beira-Mar Norte',
        'sobre_texto' => 'A <strong>Unidade Alves de Brito</strong> é uma das sedes mais tradicionais da ATA em Florianópolis. Situada a poucos metros da Avenida Beira-Mar Norte, oferece acesso rápido e descomplicado para famílias que moram ou trabalham no Centro e bairros adjacentes (Agronômica, Trindade e Itacorubi). Com tatames de alta tecnologia de absorção de impacto, vestiários climatizados e ambiente planejado para a formação de líderes, é o espaço ideal para quem busca conveniência, segurança e uma rotina de desenvolvimento físico e mental.',
        'pontos_fortes'=> [
            ['icon' => '🌊', 'title' => 'Ao lado da Beira-Mar', 'desc' => 'A poucos passos da Beira-Mar Norte e principais vias do Centro.'],
            ['icon' => '🚗', 'title' => 'Fácil Acesso & Estacionamento', 'desc' => 'Convênio de estacionamento e paradas fáceis para os pais.'],
            ['icon' => '🥋', 'title' => 'Tatame Oficial de Alto Padrão', 'desc' => 'Amortecimento biomecânico para máxima segurança articular.'],
            ['icon' => '❄️', 'title' => 'Ambiente 100% Climatizado', 'desc' => 'Conforto térmico absoluto em todas as estações do ano.']
        ],
        'destaques'   => [
            'Tatame Oficial de Alto Impacto e Proteção Biomecânica',
            'Vestiários Completos, Limpos e Climatizados',
            'Localização Central Privilegiada a Poucos Passos da Beira-Mar',
            'Instrutores 100% Certificados Internacionalmente pela ATA'
        ],
        'maps_query'  => 'Rua+Alves+de+Brito+33+Centro+Florianopolis',
        'maps_embed'  => 'https://maps.google.com/maps?q=Rua+Alves+de+Brito+33+Centro+Florianopolis&t=&z=16&ie=UTF8&iwloc=&output=embed',
        'fotos'       => [
            [
                'url' => get_template_directory_uri() . '/assets/images/unidade-alves-de-brito-fachada.jpg',
                'caption' => 'Fachada Oficial da Unidade Alves de Brito (Rua Alves de Brito, 33)',
                'tag' => 'Fachada & Recepção'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Treinos Lúdicos de Foco e Autocontrole para Tigers e Kids',
                'tag' => 'Tigers & Kids'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Aulas Dinâmicas de Condicionamento e Autodefesa para Adolescentes e Adultos',
                'tag' => 'Teens & Masters'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Cerimônia de Troca de Faixas e Superação de Metas',
                'tag' => 'Graduação de Faixas'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1508215885820-4523e431397b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Ambiente Familiar, Seguro e Supervisionado por Especialistas',
                'tag' => 'Comunidade ATA'
            ]
        ]
    ],
    'colegio-catarinense' => [
        'id'          => 'colegio-catarinense',
        'nome'        => 'Unidade 2 - Centro (Ao lado do Col. Catarinense)',
        'titulo'      => 'Unidade Colégio Catarinense',
        'badge'       => 'POLO ESCOLAR • VIBE RESIDENCIAL & FAMILIAR',
        'tagline'     => 'No coração escolar de Florianópolis, ao lado dos colégios mais tradicionais da cidade.',
        'subtitulo'   => 'Fácil acesso, segurança e a logística perfeita para a rotina escolar e familiar.',
        'endereco'    => 'Ao lado do Colégio Catarinense – Centro, Florianópolis - SC',
        'bairro'      => 'Centro / Região Escolar Nobre',
        'telefone'    => '(48) 3028-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => get_template_directory_uri() . '/Unidade2-card.mp4',
        'imagem_hero' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1600&auto=format&fit=crop',
        'sobre_titulo'=> 'A Logística Perfeita para a Família e a Rotina Escolar',
        'sobre_texto' => 'Localizada estrategicamente no polo educacional e residencial nobre do Centro de Florianópolis — imediatamente ao lado do <strong>Colégio Catarinense</strong> e próxima a colégios como Bom Jesus e Menino Jesus —, esta unidade foi desenhada para facilitar a vida dos pais. O aluno pode treinar no contra-turno escolar com total segurança, evitando deslocamentos e trânsito. O espaço conta com uma atmosfera residencial, acolhedora e com suporte pedagógico integral.',
        'pontos_fortes'=> [
            ['icon' => '🏫', 'title' => 'Ao Lado dos Colégios', 'desc' => 'Praticidade de encaixar o treino logo após ou antes das aulas.'],
            ['icon' => '🏡', 'title' => 'Atmosfera Aconchegante', 'desc' => 'Área de espera confortável com Wi-Fi para os pais aguardarem.'],
            ['icon' => '🛡️', 'title' => 'Anti-Bullying & Autoestima', 'desc' => 'Didática personalizada para fortalecer a postura e segurança da criança.'],
            ['icon' => '⏱️', 'title' => 'Turmas no Contra-Turno', 'desc' => 'Horários sob medida para coincidir com a saída dos colégios.']
        ],
        'destaques'   => [
            'Área de Espera Confortável para os Pais com Wi-Fi',
            'Estrutura Especializada para o Desenvolvimento de Tigers (3-6) e Kids (7-13)',
            'Localização Imediata ao lado do Colégio Catarinense',
            'Metodologia Pedagógica Focada em Foco Escolar e Autocontrole'
        ],
        'maps_query'  => 'Colegio+Catarinense+Centro+Florianopolis',
        'maps_embed'  => 'https://maps.google.com/maps?q=Colegio+Catarinense+Centro+Florianopolis&t=&z=16&ie=UTF8&iwloc=&output=embed',
        'fotos'       => [
            [
                'url' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Treinos Estruturados para Foco Escolar e Disciplina',
                'tag' => 'Kids & Teens'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Primeiros Limites e Socialização Saudável para Pequenos',
                'tag' => 'Programa Tigers'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1508215885820-4523e431397b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Treinamento Conjunto de Pais e Filhos no Tatame',
                'tag' => 'Treino Familiar'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Reconhecimento e Conquista de Faixas',
                'tag' => 'Graduações ATA'
            ]
        ]
    ],
    'spotmarkt' => [
        'id'          => 'spotmarkt',
        'nome'        => 'Unidade 3 - Spotmarkt (Córrego Grande)',
        'titulo'      => 'Unidade Spotmarkt Córrego Grande',
        'badge'       => 'MALL SPOTMARKT • ESTILO DE VIDA & CONVENIÊNCIA',
        'tagline'     => 'Inserida no melhor mall gastronômico e de convivência do Córrego Grande.',
        'subtitulo'   => 'Conveniência total: cafés, gastronomia e estacionamento seguro enquanto seu filho treina.',
        'endereco'    => 'Mall Spotmarkt – Córrego Grande, Florianópolis - SC',
        'bairro'      => 'Córrego Grande / Spotmarkt Mall',
        'telefone'    => '(48) 99951-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => get_template_directory_uri() . '/Spotmarket-card.mp4',
        'imagem_hero' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1600&auto=format&fit=crop',
        'sobre_titulo'=> 'Treinamento de Liderança no Principal Mall do Córrego Grande',
        'sobre_texto' => 'A <strong>Unidade Spotmarkt</strong> traz uma experiência única ao estar integrada ao Spotmarkt Mall — o polo gastronômico e de convivência mais moderno do Córrego Grande, próximo ao Parque Linear e à UFSC. Os pais desfrutam de cafés especiais, restaurantes renomados, lojas e estacionamento coberto com segurança 24h enquanto seus filhos desenvolvem foco e autoconfiança no tatame. Um estilo de vida moderno, seguro e extremamente prático para toda a família.',
        'pontos_fortes'=> [
            ['icon' => '🛍️', 'title' => 'Dentro do Mall Spotmarkt', 'desc' => 'Segurança de mall, cafés, serviços e alta gastronomia.'],
            ['icon' => '🅿️', 'title' => 'Estacionamento Coberto', 'desc' => 'Vagas amplas, cobertas e monitoramento 24 horas.'],
            ['icon' => '🌳', 'title' => 'Junto ao Parque Linear', 'desc' => 'Localização verde, vibrante e arborizada no Córrego Grande.'],
            ['icon' => '⚡', 'title' => 'Dojo Tecnológico', 'desc' => 'Estrutura contemporânea com equipamentos oficiais de ponta.']
        ],
        'destaques'   => [
            'Conveniência Integrada no Mall Spotmarkt (Córrego Grande)',
            'Estacionamento Coberto, Amplo e com Segurança 24h',
            'Opções Gastronômicas e Cafeterias enquanto o Aluno Treina',
            'Tatame Tecnológico de Alta Performance e Amortecimento'
        ],
        'maps_query'  => 'Spotmarkt+Mall+Corrego+Grande+Florianopolis',
        'maps_embed'  => 'https://maps.google.com/maps?q=Spotmarkt+Mall+Corrego+Grande+Florianopolis&t=&z=16&ie=UTF8&iwloc=&output=embed',
        'fotos'       => [
            [
                'url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Tatame Moderno no Complexo Spotmarkt',
                'tag' => 'Dojo Spotmarkt'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Metodologia Divertida e Formadora de Caráter para Crianças',
                'tag' => 'Tigers & Kids'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Adolescentes e Adultos em Treino de Condicionamento e Liderança',
                'tag' => 'Teens & Adultos'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1508215885820-4523e431397b?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Comunidade Vibrante e Convivência Positiva',
                'tag' => 'Família ATA'
            ]
        ]
    ]
];

// Identifica a unidade ativa
$unidade_atual = $unidades_data['alves-de-brito'];
foreach ($unidades_data as $key => $data) {
    if (strpos($slug, $key) !== false || $unidade_id === $key) {
        $unidade_atual = $data;
        break;
    }
}
?>

<!-- 1. Hero da Unidade com Foto Oficial de Fundo -->
<section class="unit-hero-section">
    <div class="hero-bg-media">
        <img src="<?php echo esc_url( $unidade_atual['imagem_hero'] ); ?>" alt="<?php echo esc_attr( $unidade_atual['titulo'] ); ?>" class="hero-img-bg">
        <div class="hero-overlay"></div>
    </div>
    <div class="container unit-hero-container">
        <div class="unit-hero-content">
            <span class="badge-gold">★ <?php echo esc_html($unidade_atual['badge']); ?> ★</span>
            <h1 class="unit-hero-title"><?php echo esc_html($unidade_atual['titulo']); ?></h1>
            <p class="unit-hero-tagline"><?php echo esc_html($unidade_atual['tagline']); ?></p>
            
            <!-- Card Resumo de Informações -->
            <div class="unit-hero-info-card">
                <div class="info-row">
                    <span class="info-icon">📍</span>
                    <div>
                        <strong>Endereço:</strong>
                        <p><?php echo esc_html($unidade_atual['endereco']); ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <span class="info-icon">🕒</span>
                    <div>
                        <strong>Horário de Treinos:</strong>
                        <p><?php echo esc_html($unidade_atual['horario']); ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <span class="info-icon">📞</span>
                    <div>
                        <strong>Contato / WhatsApp:</strong>
                        <p><?php echo esc_html($unidade_atual['telefone']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação Imediata -->
            <div class="unit-hero-ctas">
                <a href="#agendamento" class="btn btn-gold btn-lg" data-track="cta_unit_agendar">
                    Agendar Aula Gratuita Nesta Unidade
                </a>
                <a href="https://wa.me/<?php echo esc_attr($unidade_atual['whatsapp']); ?>?text=<?php echo urlencode('Olá! Gostaria de informações e agendar aula na ' . $unidade_atual['nome']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg" data-track="whatsapp_unidade">
                    Falar no WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. Sobre a Unidade & Proposta de Localização -->
<section class="unit-about-section">
    <div class="container">
        <div class="unit-about-grid">
            <div class="unit-about-text-col">
                <span class="badge-gold">CONHEÇA NOSSO ESPAÇO</span>
                <h2><?php echo esc_html($unidade_atual['sobre_titulo']); ?></h2>
                <div class="unit-about-description">
                    <p><?php echo wp_kses_post($unidade_atual['sobre_texto']); ?></p>
                </div>

                <div class="unit-perks-grid">
                    <?php foreach ($unidade_atual['pontos_fortes'] as $ponto) : ?>
                        <div class="unit-perk-item">
                            <div class="perk-icon-wrap"><?php echo esc_html($ponto['icon']); ?></div>
                            <div class="perk-text">
                                <strong><?php echo esc_html($ponto['title']); ?></strong>
                                <p><?php echo esc_html($ponto['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Coluna de Destaque com Vídeo Oficial da Unidade -->
            <div class="unit-about-media-col">
                <div class="unit-video-showcase-card">
                    <div class="video-card-header">
                        <span class="video-pill">▶ VÍDEO OFICIAL DA UNIDADE</span>
                        <p class="video-card-title"><?php echo esc_html($unidade_atual['titulo']); ?> em Ação</p>
                    </div>
                    
                    <div class="unit-video-player-wrapper">
                        <video playsinline loop muted autoplay webkit-playsinline preload="metadata" class="unit-embedded-video">
                            <source src="<?php echo esc_url($unidade_atual['video']); ?>" type="video/mp4">
                        </video>
                        <div class="video-floating-badge">
                            <span>🥋 Treinos Reais em Floripa</span>
                        </div>
                    </div>

                    <div class="video-card-footer">
                        <p>Veja a energia, a disciplina e o ambiente de desenvolvimento de nossos alunos.</p>
                        <a href="#agendamento" class="btn btn-gold btn-block btn-sm">Quero Experimentar uma Aula</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Carrossel de Fotos de Alunos & Treinos -->
<section class="unit-gallery-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">GALERIA DE MOMENTOS</span>
            <h2>Nossos Alunos no Tatame</h2>
            <p>Confira a vivência, o respeito e a evolução dos nossos praticantes na <?php echo esc_html($unidade_atual['titulo']); ?>.</p>
        </div>

        <div class="unit-carousel-container" id="unitPhotoCarousel">
            <div class="carousel-track-wrapper">
                <div class="carousel-track">
                    <?php foreach ($unidade_atual['fotos'] as $idx => $foto) : ?>
                        <div class="carousel-slide <?php echo $idx === 0 ? 'is-active' : ''; ?>">
                            <div class="carousel-image-card">
                                <img src="<?php echo esc_url($foto['url']); ?>" alt="<?php echo esc_attr($foto['caption']); ?>" loading="lazy">
                                <div class="slide-overlay">
                                    <span class="slide-tag"><?php echo esc_html($foto['tag']); ?></span>
                                    <p class="slide-caption"><?php echo esc_html($foto['caption']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Controles do Carrossel -->
            <div class="carousel-controls">
                <button type="button" class="carousel-nav-btn prev" aria-label="Foto Anterior">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                
                <div class="carousel-dots">
                    <?php foreach ($unidade_atual['fotos'] as $idx => $foto) : ?>
                        <button type="button" class="carousel-dot <?php echo $idx === 0 ? 'is-active' : ''; ?>" data-slide-index="<?php echo esc_attr($idx); ?>" aria-label="Ir para foto <?php echo esc_attr($idx + 1); ?>"></button>
                    <?php endforeach; ?>
                </div>

                <button type="button" class="carousel-nav-btn next" aria-label="Próxima Foto">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- 4. Diferenciais da Infraestrutura -->
<section class="unit-features-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">ESTRUTURA DE ALTO PADRÃO</span>
            <h2>O Que Torna Esta Unidade Única</h2>
            <p>Ambiente estruturado para proporcionar máxima segurança, conforto e rendimento.</p>
        </div>

        <div class="unit-features-grid">
            <?php foreach ($unidade_atual['destaques'] as $destaque) : ?>
                <div class="unit-feature-card">
                    <div class="feature-icon">✓</div>
                    <h3><?php echo esc_html($destaque); ?></h3>
                    <p>Metodologia Songahm com ambiente rigorosamente preparado para você e sua família.</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 5. Localização, Google Maps & Como Chegar -->
<section class="unit-map-section">
    <div class="container">
        <div class="unit-map-card">
            <div class="map-info-col">
                <span class="badge-gold">LOCALIZAÇÃO & ACESSO</span>
                <h2>Como Chegar na <?php echo esc_html($unidade_atual['titulo']); ?></h2>
                <p class="map-bairro-tag">📍 <?php echo esc_html($unidade_atual['bairro']); ?></p>
                <p class="map-address-full"><?php echo esc_html($unidade_atual['endereco']); ?></p>
                
                <div class="map-action-buttons">
                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr($unidade_atual['maps_query']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-gold btn-sm">
                        Abrir no Google Maps ↗
                    </a>
                    <a href="https://waze.com/ul?q=<?php echo esc_attr($unidade_atual['maps_query']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                        Abrir no Waze ↗
                    </a>
                    <a href="https://wa.me/<?php echo esc_attr($unidade_atual['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-sm">
                        Dúvidas de Acesso (WhatsApp)
                    </a>
                </div>
            </div>

            <div class="map-embed-col">
                <div class="map-embed-frame">
                    <iframe src="<?php echo esc_url($unidade_atual['maps_embed']); ?>" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Formulário de Agendamento da Unidade -->
<section id="agendamento" class="unit-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header text-center">
                <span class="badge-gold">VAGAS LIMITADAS POR TURMA</span>
                <h2>Agende Sua Aula Experimental Grátis na <?php echo esc_html($unidade_atual['titulo']); ?></h2>
                <p>Preencha os dados abaixo e nossa equipe entrará em contato via WhatsApp para confirmar o seu melhor horário.</p>
            </div>

            <form id="form-lead-home" class="lead-form-premium">
                <input type="hidden" name="unidade" value="<?php echo esc_attr($unidade_atual['nome']); ?>">

                <div class="form-group">
                    <label for="nome">Nome Completo (do aluno ou responsável) *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="telefone">WhatsApp (com DDD) *</label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(48) 99999-9999" required>
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

<!-- 7. Conheça as Outras Unidades da ATA Premium em Florianópolis -->
<section class="unit-other-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="badge-gold">NOSSAS OUTRAS UNIDADES</span>
            <h2>Conheça Nossas Outras Sedes em Florianópolis</h2>
            <p>Treine na unidade mais conveniente para a rotina da sua família.</p>
        </div>

        <div class="other-units-grid">
            <?php foreach ($unidades_data as $key => $other) : ?>
                <?php if ($key !== $unidade_atual['id']) : ?>
                    <div class="other-unit-card">
                        <div class="other-unit-media">
                            <img src="<?php echo esc_url($other['imagem_hero']); ?>" alt="<?php echo esc_attr($other['titulo']); ?>" loading="lazy">
                            <span class="other-unit-badge"><?php echo esc_html($other['bairro']); ?></span>
                        </div>
                        <div class="other-unit-body">
                            <h3><?php echo esc_html($other['titulo']); ?></h3>
                            <p class="other-unit-addr">📍 <?php echo esc_html($other['endereco']); ?></p>
                            <p class="other-unit-tagline"><?php echo esc_html($other['tagline']); ?></p>
                            <a href="<?php echo esc_url( home_url( '/unidade-' . $other['id'] . '/' ) ); ?>" class="btn btn-gold btn-block btn-sm">
                                Conhecer Esta Unidade →
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Script do Carrossel Interativo da Unidade -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('unitPhotoCarousel');
    if (!carousel) return;

    const track = carousel.querySelector('.carousel-track');
    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    const prevBtn = carousel.querySelector('.carousel-nav-btn.prev');
    const nextBtn = carousel.querySelector('.carousel-nav-btn.next');

    let currentIndex = 0;
    const totalSlides = slides.length;
    if (totalSlides <= 1) return;

    const updateCarousel = (index) => {
        currentIndex = (index + totalSlides) % totalSlides;
        track.style.transform = `translateX(-${currentIndex * 100}%)`;

        slides.forEach((s, idx) => s.classList.toggle('is-active', idx === currentIndex));
        dots.forEach((d, idx) => d.classList.toggle('is-active', idx === currentIndex));
    };

    if (prevBtn) {
        prevBtn.addEventListener('click', () => updateCarousel(currentIndex - 1));
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => updateCarousel(currentIndex + 1));
    }

    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => updateCarousel(idx));
    });

    // Suporte a Touch Swipe
    let startX = 0;
    let endX = 0;

    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    }, { passive: true });

    track.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        const diff = startX - endX;
        if (Math.abs(diff) > 40) {
            if (diff > 0) updateCarousel(currentIndex + 1);
            else updateCarousel(currentIndex - 1);
        }
    }, { passive: true });
});
</script>

<?php get_footer(); ?>
