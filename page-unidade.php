<?php
/**
 * Template Name: Página da Unidade - ATA Premium
 * Descrição: Template sob medida para as páginas das unidades de Florianópolis
 */

get_header();

// Identifica qual unidade está sendo exibida pelo slug da página ou parâmetro
$slug = get_post_field( 'post_name', get_post() );
$unidade_id = isset($_GET['unidade']) ? sanitize_text_field($_GET['unidade']) : $slug;

// Dados das 3 unidades
$unidades_data = [
    'alves-de-brito' => [
        'nome'        => 'Unidade 1 - Centro (Alves de Brito)',
        'titulo'      => 'Unidade Alves de Brito',
        'subtitulo'   => 'Centro de Florianópolis • Tradição e Excelência Marcial',
        'endereco'    => 'Rua Alves de Brito, nº 33 – Centro, Florianópolis - SC',
        'telefone'    => '(48) 3039-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => null, // Usando a foto real da fachada oficial
        'imagem_hero' => get_template_directory_uri() . '/assets/images/unidade-alves-de-brito-fachada.jpg',
        'destaques'   => ['Tatame Oficial de Alto Impacto', 'Vestiários Completos & Climatizados', 'Localização Central Privilegiada', 'Estacionamento Próximo Convencionado'],
        'maps_query'  => 'Rua+Alves+de+Brito+33+Centro+Florianopolis'
    ],
    'colegio-catarinense' => [
        'nome'        => 'Unidade 2 - Centro (Ao lado do Col. Catarinense)',
        'titulo'      => 'Unidade Colégio Catarinense',
        'subtitulo'   => 'Centro de Florianópolis • Fácil Acesso e Segurança para Toda a Família',
        'endereco'    => 'Ao lado do Colégio Catarinense – Centro, Florianópolis - SC',
        'telefone'    => '(48) 3028-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => get_template_directory_uri() . '/catarinense.mp4',
        'imagem_hero' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=1600&auto=format&fit=crop',
        'destaques'   => ['Área de Espera Aconchegante para os Pais', 'Estrutura Completa para Tigers e Kids', 'Próximo às Principais Escolas do Centro', 'Instrutores 100% Certificados'],
        'maps_query'  => 'Colegio+Catarinense+Centro+Florianopolis'
    ],
    'spotmarkt' => [
        'nome'        => 'Unidade 3 - Spotmarkt (Córrego Grande)',
        'titulo'      => 'Unidade Spotmarkt Córrego Grande',
        'subtitulo'   => 'Mall Spotmarkt • Conveniência, Gastronomia e Segurança Integrada',
        'endereco'    => 'Mall Spotmarkt – Córrego Grande, Florianópolis - SC',
        'telefone'    => '(48) 99951-0446',
        'whatsapp'    => '5548999313558',
        'horario'     => 'Segunda a Sexta: 09h às 12h | 15h às 21h',
        'video'       => get_template_directory_uri() . '/spotmarket.mp4',
        'imagem_hero' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1600&auto=format&fit=crop',
        'destaques'   => ['Dentro do Mall Spotmarkt', 'Estacionamento Coberto e Seguro', 'Opções Gastronômicas enquanto seu Filho Treina', 'Tatame Tecnológico de Alta Performance'],
        'maps_query'  => 'Spotmarkt+Mall+Corrego+Grande+Florianopolis'
    ]
];

// Fallback padrão se não bater o slug
$unidade_atual = $unidades_data['alves-de-brito'];
foreach ($unidades_data as $key => $data) {
    if (strpos($slug, $key) !== false || $unidade_id === $key) {
        $unidade_atual = $data;
        break;
    }
}
?>

<!-- Hero da Unidade com Foto ou Vídeo de Fundo -->
<section class="unit-hero-section">
    <div class="hero-bg-media">
        <?php if ( ! empty( $unidade_atual['video'] ) ) : ?>
            <video autoplay muted loop playsinline webkit-playsinline preload="auto" class="hero-video-bg" poster="<?php echo esc_url( $unidade_atual['imagem_hero'] ); ?>">
                <source src="<?php echo esc_url( $unidade_atual['video'] ); ?>" type="video/mp4">
            </video>
        <?php else : ?>
            <img src="<?php echo esc_url( $unidade_atual['imagem_hero'] ); ?>" alt="<?php echo esc_attr( $unidade_atual['titulo'] ); ?>" class="hero-img-bg">
        <?php endif; ?>
        <div class="hero-overlay"></div>
    </div>
    <div class="container unit-hero-container">
        <div class="unit-hero-content">
            <span class="badge-gold">UNIDADE OFICIAL ATA PREMIUM</span>
            <h1><?php echo esc_html($unidade_atual['titulo']); ?></h1>
            <p class="unit-sub"><?php echo esc_html($unidade_atual['subtitulo']); ?></p>
            
            <div class="unit-hero-info-card">
                <div class="info-row">
                    <span class="info-icon">📍</span>
                    <div>
                        <strong>Endereço:</strong>
                        <p><?php echo esc_html($unidade_atual['endereco']); ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <span class="info-icon">📞</span>
                    <div>
                        <strong>Telefone / Atendimento:</strong>
                        <p><?php echo esc_html($unidade_atual['telefone']); ?></p>
                    </div>
                </div>
                <div class="info-row">
                    <span class="info-icon">🕒</span>
                    <div>
                        <strong>Horário de Funcionamento:</strong>
                        <p><?php echo esc_html($unidade_atual['horario']); ?></p>
                    </div>
                </div>
            </div>

            <div class="unit-hero-ctas">
                <a href="#agendamento" class="btn btn-gold" data-track="cta_unit_agendar">Agendar Aula nesta Unidade</a>
                <a href="https://wa.me/<?php echo esc_attr($unidade_atual['whatsapp']); ?>?text=<?php echo urlencode('Olá! Gostaria de agendar uma aula experimental na ' . $unidade_atual['nome']); ?>" target="_blank" rel="noopener" class="btn btn-whatsapp" data-track="whatsapp_unidade">
                    Falar no WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Diferenciais e Estrutura da Unidade -->
<section class="unit-details-section">
    <div class="container">
        <div class="section-title">
            <span class="badge-gold">ESTRUTURA COMPLETA</span>
            <h2>O Que Você Encontra Nesta Unidade</h2>
            <p>Espaço projetado para o máximo conforto, segurança e rendimento marcial.</p>
        </div>

        <div class="unit-features-grid">
            <?php foreach ($unidade_atual['destaques'] as $destaque) : ?>
                <div class="unit-feature-card">
                    <div class="feature-icon">✓</div>
                    <h3><?php echo esc_html($destaque); ?></h3>
                    <p>Ambiente seguro e estruturado para proporcionar uma experiência marcial de padrão internacional para você e sua família.</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Formulário de Agendamento da Unidade -->
<section id="agendamento" class="unit-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header text-center">
                <span class="badge-gold">VAGAS LIMITADAS POR TURMA</span>
                <h2>Garanta Sua Aula Experimental na <?php echo esc_html($unidade_atual['titulo']); ?></h2>
                <p>Preencha os dados e entraremos em contato via WhatsApp para confirmar o seu horário.</p>
            </div>

            <form id="form-lead-home" class="lead-form-premium">
                <input type="hidden" name="unidade" value="<?php echo esc_attr($unidade_atual['nome']); ?>">

                <div class="form-group">
                    <label for="nome">Nome Completo (do aluno ou responsável)</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="telefone">WhatsApp (com DDD)</label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="(48) 99999-9999" required>
                </div>

                <div class="form-group">
                    <label for="faixa_etaria">Programa de Interesse</label>
                    <select id="faixa_etaria" name="faixa_etaria" class="form-control" required>
                        <option value="" disabled selected>Selecione a faixa etária / programa</option>
                        <option value="Tigers (3 a 6 anos)">Tigers (3 a 6 anos)</option>
                        <option value="Kids (7 a 13 anos)">Kids (7 a 13 anos)</option>
                        <option value="Teens (11 a 15 anos)">Adolescentes / Teens (11 a 15 anos)</option>
                        <option value="Adultos e Família">Adultos e Família (Masters)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-gold btn-block">Confirmar Agendamento Gratuito</button>
                <p class="form-privacy-note">🔒 Seus dados estão protegidos. Não enviamos spam.</p>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
