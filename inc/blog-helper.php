<?php
/**
 * Módulo de Blog & Conteúdo Editorial - ATA Premium Martial Arts
 * Inclui geração automática de Sumário (TOC) por H2/H3, tempo de leitura,
 * busca de artigos similares (mesma categoria) e seed inicial de artigos.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Calcula o tempo estimado de leitura em minutos
 */
function atapremium_reading_time( $content = '' ) {
    if ( empty( $content ) ) {
        $content = get_post_field( 'post_content', get_the_ID() );
    }
    $clean_text = wp_strip_all_tags( strip_shortcodes( (string) $content ) );
    $word_count = str_word_count( $clean_text );
    $minutes    = max( 1, (int) ceil( $word_count / 190 ) );
    return $minutes . ' min de leitura';
}

/**
 * Processa o conteúdo do post adicionando IDs semânticos nos H2 e H3
 * e retorna tanto o HTML modificado quanto o array de itens do Sumário (TOC).
 */
function atapremium_parse_content_and_toc( $content ) {
    $toc = array();
    $used_ids = array();

    $pattern = '/<h([23])([^>]*)>(.*?)<\/h\1>/is';

    $modified_content = preg_replace_callback( $pattern, function( $matches ) use ( &$toc, &$used_ids ) {
        $level      = (int) $matches[1];
        $attrs      = $matches[2];
        $inner_html = $matches[3];
        $plain_text = trim( wp_strip_all_tags( $inner_html ) );

        if ( empty( $plain_text ) ) {
            return $matches[0];
        }

        // Verifica se já possui atributo id="..."
        if ( preg_match( '/\bid=["\']([^"\']+)["\']/i', $attrs, $id_match ) ) {
            $slug = $id_match[1];
        } else {
            $base_slug = sanitize_title( $plain_text );
            if ( empty( $base_slug ) ) {
                $base_slug = 'topico-' . ( count( $toc ) + 1 );
            }
            $slug = $base_slug;
            $counter = 2;
            while ( in_array( $slug, $used_ids, true ) ) {
                $slug = $base_slug . '-' . $counter;
                $counter++;
            }
            $attrs .= ' id="' . esc_attr( $slug ) . '"';
        }

        $used_ids[] = $slug;
        $toc[] = array(
            'id'    => $slug,
            'title' => $plain_text,
            'level' => $level,
        );

        return '<h' . $level . $attrs . '>' . $inner_html . '</h' . $level . '>';
    }, (string) $content );

    return array(
        'content' => $modified_content,
        'toc'     => $toc,
    );
}

/**
 * Busca artigos similares da mesma categoria (com fallback para recentes caso necessário)
 */
function atapremium_get_related_posts( $post_id, $limit = 3 ) {
    $categories = wp_get_post_categories( $post_id );
    $related_posts = array();

    if ( ! empty( $categories ) ) {
        $query = new WP_Query( array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $limit,
            'post__not_in'        => array( $post_id ),
            'category__in'        => $categories,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        ) );

        if ( $query->have_posts() ) {
            $related_posts = $query->posts;
        }
        wp_reset_postdata();
    }

    // Complementa com outros posts recentes caso a categoria ainda tenha poucos artigos
    if ( count( $related_posts ) < $limit ) {
        $exclude_ids = array( $post_id );
        foreach ( $related_posts as $rp ) {
            $exclude_ids[] = $rp->ID;
        }

        $fallback_query = new WP_Query( array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $limit - count( $related_posts ),
            'post__not_in'        => $exclude_ids,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        ) );

        if ( $fallback_query->have_posts() ) {
            $related_posts = array_merge( $related_posts, $fallback_query->posts );
        }
        wp_reset_postdata();
    }

    return $related_posts;
}

/**
 * Retorna a imagem de capa do post (ou fallback elegante do tema de acordo com a categoria/índice)
 */
function atapremium_get_post_cover_url( $post_id = 0 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    if ( has_post_thumbnail( $post_id ) ) {
        $thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
        if ( $thumb_url ) {
            return $thumb_url;
        }
    }

    $custom_cover = get_post_meta( $post_id, '_atapremium_cover_image', true );
    if ( ! empty( $custom_cover ) ) {
        return get_template_directory_uri() . '/' . ltrim( $custom_cover, '/' );
    }

    $fallbacks = array(
        'assets/images/aula1-unidade1.webp',
        'assets/images/aula1-unidade3.webp',
        'assets/images/aula3-unidade1.webp',
        'assets/images/aula1-unidade2.webp',
    );
    $idx = absint( $post_id ) % count( $fallbacks );
    return get_template_directory_uri() . '/' . $fallbacks[ $idx ];
}

/**
 * Artigos iniciais de Novembro baseados em neurociência (Harvard), SBP e método Songahm
 */
function atapremium_get_initial_blog_articles_data() {
    return array(
        array(
            'slug'        => 'ferias-escolares-sem-excesso-de-telas-artes-marciais',
            'title'       => 'Férias de Verão Chegando: Como Proteger Seu Filho do "Sequestro Digital" das Telas',
            'category'    => 'Família & Rotina',
            'cat_slug'    => 'familia-e-rotina',
            'cover'       => 'assets/images/aula1-unidade1.webp',
            'excerpt'     => 'Com o fim das aulas em novembro e dezembro, o tempo de tela das crianças costuma triplicar. Veja o que diz a Sociedade Brasileira de Pediatria e como o tatame mantém o cérebro ativo e focado.',
            'content'     => '
<p>Novembro marca a reta final do calendário escolar em Florianópolis e o início de uma das maiores preocupações dos pais modernos: <strong>o que fazer quando a rotina da escola pausa e o tempo livre é engolido pelo celular, tablet e videogame?</strong></p>
<p>Segundo diretrizes da <strong>Sociedade Brasileira de Pediatria (SBP)</strong>, a perda da rotina estruturada no fim do ano eleva drasticamente a exposição a telas, gerando alterações no sono, irritabilidade, ansiedade e queda na capacidade de atenção sustentada.</p>

<h2>Por que o excesso de telas nas férias afeta o comportamento?</h2>
<p>Jogos rápidos e vídeos curtos liberam picos constantes e artificiais de dopamina no cérebro em desenvolvimento. Quando a criança passa horas nesse estímulo passivo, o mundo real parece "lento" demais — e qualquer frustração gera impaciência ou explosões emocionais.</p>

<h3>Os sinais de sobrecarga digital na infância e adolescência</h3>
<ul>
    <li>Irritabilidade imediata ao pedir para desligar o aparelho;</li>
    <li>Dificuldade para ouvir instruções até o fim sem interromper;</li>
    <li>Queda na energia física e postura curvada;</li>
    <li>Alteração no ciclo de sono e cansaço matinal.</li>
</ul>

<h2>O Tatame como "Descompressão Digital" em Florianópolis</h2>
<p>Na <strong>ATA Premium Martial Arts</strong>, cada aula funciona como um antídoto neurofisiológico contra a hiperestimulação das telas. Diferente de exercícios repetitivos comuns, o <strong>Método Songahm</strong> combina movimento corporal complexo com presença mental absoluta.</p>

<h3>Como a prática marcial reconstrói o foco</h3>
<p>Para executar uma fórmula (sequência técnica) ou um chute com precisão, o aluno precisa coordenar respiração, equilíbrio, olhar e audição ativa. Não há espaço para distração: o corpo e a mente voltam a operar em sintonia real.</p>

<h2>Como preparar a rotina de novembro e dezembro</h2>
<p>Manter de 2 a 3 treinos semanais durante a transição entre o fim das aulas e o verão garante que seu filho preserve o senso de horários, convivência social saudável com amigos reais e gasto energético positivo.</p>
',
        ),
        array(
            'slug'        => 'reta-final-ano-letivo-foco-ansiedade-provas-taekwondo',
            'title'       => 'Reta Final na Escola: Como o Taekwondo Blindou o Foco e o Controle Emocional nas Provas',
            'category'    => 'Foco & Escola',
            'cat_slug'    => 'foco-e-escola',
            'cover'       => 'assets/images/aula3-unidade1.webp',
            'excerpt'     => 'Pesquisas de Harvard sobre funções executivas explicam por que artes marciais tradicionais superam esportes convencionais no desenvolvimento de concentração, memória de trabalho e autocontrole.',
            'content'     => '
<p>Em novembro, o cansaço acumulado do ano letivo encontra a semana de provas finais e trabalhos decisivos. Para muitas crianças e adolescentes, esse período vem acompanhado de <strong>dispersão, esquecimento e ansiedade de desempenho</strong>.</p>
<p>Estudos do <strong>Center on the Developing Child da Universidade de Harvard</strong> destacam que o sucesso escolar depende diretamente das chamadas <em>Funções Executivas</em>: memória de trabalho, flexibilidade cognitiva e controle inibitório (a capacidade de parar e pensar antes de agir).</p>

<h2>O que a ciência de Harvard diz sobre Artes Marciais e Atenção</h2>
<p>Em pesquisas conduzidas por especialistas como a Dra. Adele Diamond, as artes marciais tradicionais destacaram-se acima de exercícios aeróbicos isolados porque treinam simultaneamente o córtex pré-frontal e a coordenação motora fina e ampla.</p>

<h3>Os 3 pilares cognitivos estimulados em cada aula da ATA</h3>
<ul>
    <li><strong>Controle Inibitório:</strong> Aprender a aguardar o comando do instrutor antes de iniciar o movimento;</li>
    <li><strong>Memória de Trabalho:</strong> Memorizar sequências progressivas de defesas e ataques conforme a graduação de faixa;</li>
    <li><strong>Regulação da Respiração:</strong> Usar a postura marcial e o controle respiratório para baixar a frequência cardíaca sob pressão.</li>
</ul>

<h2>Da Faixa no Tatame para a Nota no Boletim</h2>
<p>Quando a criança compreende no tatame que um chute perfeito não nasce da pressa, mas da repetição consciente, ela leva exatamente essa mentalidade para a sala de aula.</p>

<h3>A diferença entre obediência por medo e disciplina voluntária</h3>
<p>No Método Songahm, não formamos alunos submissos pelo medo, mas líderes que escolhem fazer o certo por respeito próprio e admiração aos pais e mestres.</p>
',
        ),
        array(
            'slug'        => 'licao-das-faixas-metas-resiliencia-frustracao-infantil',
            'title'       => 'A Lição das Faixas: Como Ensinar Seu Filho a Não Desistir no Primeiro Obstáculo',
            'category'    => 'Desenvolvimento Infantil',
            'cat_slug'    => 'desenvolvimento-infantil',
            'cover'       => 'assets/images/aula1-unidade3.webp',
            'excerpt'     => 'Vivemos na geração do imediatismo. Descubra como o sistema de graduação progressiva da ATA ensina crianças de 3 a 15 anos a transformar erros em degraus de conquista.',
            'content'     => '
<p>Em um mundo onde qualquer vídeo, comida ou resposta chega em segundos pelo celular, muitas crianças desenvolveram baixa tolerância à frustração: <strong>se algo exige esforço ou demora para dar certo, a primeira reação é desistir</strong>.</p>
<p>A psicologia do desenvolvimento (incluindo os estudos da Dra. Carol Dweck, de Stanford, sobre <em>Growth Mindset</em> — Mentalidade de Crescimento) mostra que a autoconfiança real não vem de elogios vazios, mas de superar desafios concretos passo a passo.</p>

<h2>Por que o sistema de faixas do Método Songahm funciona tão bem?</h2>
<p>Para uma criança de 4, 8 ou 12 anos, pensar em "daqui a 5 anos" é abstrato demais. O sistema de graduação da ATA divide grandes objetivos em metas tangíveis e visíveis na cintura do aluno.</p>

<h3>Da Semente ao Pinheiro: A metáfora que a criança entende</h3>
<ul>
    <li><strong>Faixa Branca (A Semente):</strong> A humildade de começar do zero e aprender a ouvir;</li>
    <li><strong>Faixas Coloridas (As Raízes e o Crescimento):</strong> A descoberta de que a prática constante vence a dificuldade inicial;</li>
    <li><strong>Faixa Preta (O Pinheiro Eterno):</strong> O padrão de excelência, ética e liderança que acompanha o jovem pela vida inteira.</li>
</ul>

<h2>O Poder da Cerimônia de Graduação no Fim do Ano</h2>
<p>Os exames de faixa e espetáculos de encerramento de ano na ATA Premium mostram para a família que o esforço de cada semana valeu a pena. A criança percebe, na prática, que ela é capaz de conquistar objetivos difíceis.</p>

<h3>Como os pais podem reforçar essa atitude em casa</h3>
<p>Elogie o processo e a constância ("Vi como você treinou firme esta semana"), e não apenas o talento natural. Isso blinda a autoestima do seu filho contra o medo de errar.</p>
',
        ),
        array(
            'slug'        => 'treino-em-familia-pais-e-filhos-no-tatame-florianopolis',
            'title'       => 'Pais e Filhos no Mesmo Tatame: O Segredo para Criar Conexão Real na Rotina Corrida',
            'category'    => 'Método Songahm',
            'cat_slug'    => 'metodo-songahm',
            'cover'       => 'assets/images/aula1-unidade2.webp',
            'excerpt'     => 'Mais do que levar seu filho ao treino, já imaginou dividir o tatame com ele? Veja como famílias de Florianópolis estão trocando o estresse do trânsito por saúde e tempo de qualidade juntos.',
            'content'     => '
<p>Na correria de final de ano em Florianópolis, muitos pais sentem que passam o dia inteiro resolvendo pendências e sobra pouquíssimo <strong>tempo de qualidade real e olho no olho</strong> com os filhos.</p>
<p>Ao mesmo tempo, os próprios adultos acabam deixando sua saúde física, mobilidade e alívio do estresse em último plano por falta de tempo.</p>

<h2>O Exemplo Vale Mais que Mil Sermões</h2>
<p>Quando uma criança vê o pai ou a mãe vestindo o dobok, fazendo a saudação ao entrar no tatame e se desafiando a aprender uma técnica nova, o impacto pedagógico é imediato.</p>

<h3>Benefícios comprovados do treino em família na ATA Premium</h3>
<ul>
    <li><strong>Vínculo Emocional Profundo:</strong> Compartilhar metas, exames de faixa e conquistas cria memórias afetivas para a vida toda;</li>
    <li><strong>Saúde Física para os Pais:</strong> Alto gasto calórico, ganho de mobilidade articular, força funcional e redução do cortisol (hormônio do estresse);</li>
    <li><strong>Liderança pelo Exemplo:</strong> Seu filho aprende perseverança observando você evoluir faixa a faixa.</li>
</ul>

<h2>Preciso ter preparo físico ou experiência prévia para começar?</h2>
<p>Absolutamente não. Mais de 80% dos adultos que iniciam no programa <strong>Adultos & Masters</strong> da ATA Premium nunca haviam praticado artes marciais antes.</p>

<h3>3 Unidades Estratégicas em Florianópolis</h3>
<p>Com dojos climatizados e seguros na <strong>Alves de Brito (Centro)</strong>, ao lado do <strong>Colégio Catarinense (Centro)</strong> e no <strong>Mall Spotmarkt (Córrego Grande)</strong>, fica simples encaixar o treino na rotina da família.</p>
',
        ),
    );
}

/**
 * Semeia automaticamente os 4 artigos iniciais no banco de dados WordPress (uma única vez)
 * e remove o post padrão "Hello world!" / "Olá, mundo!" caso ainda exista sem edições.
 */
function atapremium_seed_initial_blog_posts() {
    if ( get_option( 'atapremium_blog_seeded_v1' ) === 'yes' ) {
        return;
    }

    // Remove o post padrão "Olá, mundo!" / "Hello world!" se for o post ID 1 padrão intocado
    $default_post = get_post( 1 );
    if ( $default_post && in_array( $default_post->post_name, array( 'ola-mundo', 'hello-world' ), true ) ) {
        wp_delete_post( 1, true );
    }

    $articles = atapremium_get_initial_blog_articles_data();

    foreach ( $articles as $idx => $item ) {
        $existing = get_page_by_path( $item['slug'], OBJECT, 'post' );
        if ( $existing ) {
            continue;
        }

        $term = term_exists( $item['category'], 'category' );
        if ( ! $term ) {
            $term = wp_insert_term( $item['category'], 'category', array( 'slug' => $item['cat_slug'] ) );
        }
        $cat_id = 0;
        if ( is_array( $term ) && isset( $term['term_id'] ) ) {
            $cat_id = (int) $term['term_id'];
        } elseif ( is_numeric( $term ) ) {
            $cat_id = (int) $term;
        }

        $post_date = date( 'Y-m-d H:i:s', strtotime( '-' . ( ( 3 - $idx ) * 2 ) . ' days' ) );

        $post_id = wp_insert_post( array(
            'post_title'   => $item['title'],
            'post_name'    => $item['slug'],
            'post_excerpt' => $item['excerpt'],
            'post_content' => trim( $item['content'] ),
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => $post_date,
            'post_category'=> $cat_id ? array( $cat_id ) : array(),
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_atapremium_cover_image', $item['cover'] );
        }
    }

    update_option( 'atapremium_blog_seeded_v1', 'yes' );
}
add_action( 'init', 'atapremium_seed_initial_blog_posts', 20 );
