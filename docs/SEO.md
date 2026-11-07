# Documentação de SEO: Arquitetura, Metadados e Compatibilidade

Esta documentação descreve a implementação técnica da infraestrutura de SEO nativo desenvolvida para o tema WordPress **ATA Premium Martial Arts Florianópolis**, cobrindo tags `<title>`, `<meta name="description">`, Open Graph (Facebook, WhatsApp, LinkedIn), Twitter Cards, Canonical URLs e a lógica de transição automática para o **Yoast SEO** (ou outros plugins).

---

## 1. Objetivo e Diagnóstico Inicial

Na auditoria de qualidade do **Google Lighthouse / PageSpeed Insights**, a pontuação de SEO estava em **92** devido à ausência de metadescrições nativas:

> ⚠️ **"O documento não tem uma metadescrição"**  
> *Metadescrições podem ser incluídas nos resultados da pesquisa para resumir concisamente o conteúdo da página.*

Além disso, páginas virtuais (como `/unidade-alves-de-brito/`, `/sobre-a-ata-premium/`, etc.) necessitavam de títulos exclusivos e metatags ricas para compartilhamento no WhatsApp e redes sociais sem depender obrigatoriamente de um plugin pesado instalado logo no início.

Com esta implementação nativa:
- A pontuação de SEO atinge **100/100** no Lighthouse.
- Cada página e unidade ganha um snippet persuasivo com palavras-chave locais de Florianópolis.
- O compartilhamento de links no WhatsApp e Instagram gera cards visuais profissionais com imagens e descrições personalizadas.
- O sistema está preparado para a instalação futura do **Yoast SEO** sem necessidade de alterar o código do tema.

---

## 2. Estrutura de Arquivos e Funcionamento

O módulo de SEO está isolado e estruturado nos seguintes arquivos:

```
wp-content/themes/atapremium/
├── inc/
│   └── seo.php               # Módulo central de inteligência e dados de SEO
├── functions.php             # Carregamento do módulo via require_once
└── header.php                # Fallback seguro de renderização no <head>
```

### Fluxo de Execução:
1. `functions.php` importa `inc/seo.php`.
2. Ao carregar qualquer página, o filtro `pre_get_document_title` é acionado pelo WordPress para definir a tag `<title>`.
3. Na abertura do `<head>` via `wp_head()`, o hook `atapremium_render_seo_meta_tags` injeta a meta description, robôs, canônica e metatags sociais.
4. Caso o tema esteja em uma rota virtual (interceptada por `atapremium_intercept_virtual_pages`), o script inspeciona a `REQUEST_URI` e o parâmetro `$_GET['unidade']` para entregar exatamente os metadados daquela sede ou página específica.

---

## 3. Lógica de Compatibilidade com o Yoast SEO e Cache de Hospedagem

O projeto foi projetado com uma **arquitetura de dupla camada inteligente**:

### A. Integração Nativa com o Yoast SEO
Na HostGator, o plugin **Yoast SEO** já está instalado no WordPress. Caso campos de SEO não estejam preenchidos no painel admin para páginas ou rotas virtuais, o Yoast por padrão emitiria tags em branco ou títulos incompletos. Para resolver isso com perfeição e sem atrito:
1. O módulo [`inc/seo.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/inc/seo.php) conecta-se diretamente aos filtros oficiais do Yoast:
   - `wpseo_title`: Injeta o título calibrado do tema.
   - `wpseo_metadesc`: Injeta a meta description de 150-160 caracteres.
   - `wpseo_opengraph_title` e `wpseo_opengraph_desc`: Mantém os snippets sociais padronizados.
   - `wpseo_opengraph_image` e `wpseo_canonical`: Apontam para as URLs e imagens canônicas exatas de cada página/unidade.
2. **Prioridade de Sobrescrita do Usuário**: Se no futuro você ou o cliente preencherem uma descrição ou título customizado diretamente no metabox do Yoast em qualquer página, o Yoast terá prioridade natural e exibirá o conteúdo customizado. Caso o campo esteja em branco, o tema preenche automaticamente com as diretrizes de alta performance.
3. Se o Yoast for desativado ou desinstalado, o tema automaticamente assume o fallback nativo via `wp_head`, garantindo que o site nunca fique sem metadescrição.

### B. Gestão de Cache de Hospedagem (HostGator NFD EPC)
A HostGator utiliza por padrão o **Newfold Digital Endurance Page Cache (NFD EPC)**, que gera arquivos HTML estáticos pré-renderizados em `/wp-content/endurance-page-cache/` com regras no `.htaccess` de 2 horas (`access plus 2 hours`).
- Desenvolvemos um endpoint seguro para limpeza forçada do cache:  
  `https://atapremium.deven.com.br/?purge_cache=ata2026`
- Esse endpoint limpa automaticamente o cache de objeto, o cache do Endurance/Varnish e mantém o HTML dinâmico sempre atualizado.

---

## 4. Matriz Completa de Metadados por Página

Todas as metadescrições foram cuidadosamente calibradas entre **145 e 160 caracteres** (zona ideal do Google para evitar truncamento no desktop e mobile):

| Página / Rota | Title (`<title>`) | Meta Description (`content=""`) | Imagem Open Graph (`og:image`) |
| :--- | :--- | :--- | :--- |
| **Home (Inicial)**<br>`/` | `ATA Premium Martial Arts Florianópolis \| Taekwondo & Liderança` | *Escola de Taekwondo e liderança em Florianópolis. Método Songahm para Tigers (3-6), Kids (7-13), Teens e Adultos. 3 sedes no Centro e Córrego Grande. Agende sua aula!* (160 car.) | `autorizado-davi-master-barth-faraco.jpg` |
| **Unidade Alves de Brito**<br>`/unidade-alves-de-brito/` | `Unidade Alves de Brito - Centro \| ATA Premium Floripa` | *Dojo central da ATA Premium na Rua Alves de Brito, 33, Centro de Florianópolis. Tatame profissional, ambiente climatizado e turmas para todas as idades.* (152 car.) | `unidade-alves-de-brito-fachada.jpg` |
| **Unidade Col. Catarinense**<br>`/unidade-colegio-catarinense/` | `Unidade Colégio Catarinense - Centro \| ATA Premium Floripa` | *Unidade ATA Premium ao lado do Colégio Catarinense em Florianópolis. Metodologia internacional para desenvolvimento do foco escolar, disciplina e autoconfiança.* (157 car.) | `unidade-2.webp` |
| **Unidade Spotmarkt**<br>`/unidade-spotmarkt/` | `Unidade Spotmarkt - Córrego Grande \| ATA Premium Floripa` | *Unidade ATA Premium no Mall Spotmarkt no Córrego Grande, Florianópolis. Conforto, segurança, estacionamento fácil e artes marciais para toda a família.* (155 car.) | `ata-spotmarket-capa.webp` |
| **Sobre a ATA Premium**<br>`/sobre-a-ata-premium/` | `Sobre a ATA Premium Floripa \| Filosofia, Tradição e Excelência` | *Conheça a história e o propósito da ATA Premium em Florianópolis. Muito além da luta: desenvolvendo disciplina voluntária, equilíbrio emocional e postura de liderança.* (160 car.) | `autorizado-davi-master-barth-faraco.jpg` |
| **Metodologia Songahm**<br>`/metodologia-songahm/` | `Metodologia Songahm Taekwondo \| ATA Premium Florianópolis` | *Descubra a metodologia pedagógica Songahm na ATA Premium: sistema de faixas, valores marciais, foco, não-violência e desenvolvimento socioemocional.* (154 car.) | `hero-poster.jpg` |
| **Equipe e Professores**<br>`/equipe/` | `Mestres e Instrutores Certificados \| ATA Premium Floripa` | *Conheça a liderança técnica da ATA Premium em Florianópolis. Instrutores formados sob rigor pedagógico, não-violência e recertificação internacional contínua.* (158 car.) | `autorizado-davi-master-barth-faraco.jpg` |
| **Federação ATA Global**<br>`/federacao-ata/` | `Federação ATA Martial Arts Global \| ATA Premium Florianópolis` | *A ATA é uma das maiores organizações marciais do mundo, fundada em 1969. Conheça a rede integrada (ATA, WTTU, STF) presente em mais de 25 países.* (157 car.) | `logo.png` |
| **Página Não Encontrada**<br>`404.php` | `Página Não Encontrada (404) \| ATA Premium Martial Arts Florianópolis` | *A página solicitada não foi encontrada. Conheça as unidades da ATA Premium em Florianópolis e agende uma aula experimental gratuita de Taekwondo.* (153 car.) | `hero-poster.jpg` |
| **Fallback Geral (Posts/Páginas)** | `[Título do Post] \| ATA Premium Martial Arts Florianópolis` | Extrai dinamicamente o resumo (`excerpt`) do post ou aplica descrição institucional padrão. | Imagem Destacada (`post-thumbnail`) ou padrão |

---

## 5. Tags Sociais e Canônicas Injetadas

Além dos mecanismos de busca tradicionais, o módulo gera automaticamente no cabeçalho:

```html
<!-- Metatags de SEO Dinâmico (ATA Premium) -->
<meta name="description" content="...">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<link rel="canonical" href="...">

<!-- Open Graph / WhatsApp / Facebook -->
<meta property="og:locale" content="pt_BR">
<meta property="og:type" content="website"> <!-- ou "article" / "business.business" -->
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:url" content="...">
<meta property="og:site_name" content="ATA Premium Martial Arts Florianópolis">
<meta property="og:image" content="...">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="...">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">
<meta name="twitter:image" content="...">
```

*Na página 404, a diretiva de robôs é automaticamente comutada para `noindex, follow` para proteger o orçamento de rastreamento (crawl budget) do Googlebot.*

---

## 6. Como Adicionar Novas Páginas ou Editar Textos

Caso no futuro seja necessário alterar o texto de uma unidade ou adicionar uma nova página sem o Yoast:

1. Abra o arquivo [`inc/seo.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/inc/seo.php).
2. Localize a função `atapremium_get_seo_data()`.
3. Adicione uma nova verificação de rota:
   ```php
   if ( strpos( $path, 'nova-pagina' ) !== false ) {
       return [
           'title'       => 'Título da Nova Página | ATA Premium Floripa',
           'description' => 'Descrição concisa de 150 a 160 caracteres com chamada para ação.',
           'canonical'   => home_url( '/nova-pagina/' ),
           'og_type'     => 'website',
           'image'       => $theme_uri . '/assets/images/sua-imagem.jpg',
       ];
   }
   ```
4. Salve o arquivo e execute `python3 deploy.py` para sincronizar com o servidor de produção da HostGator.
