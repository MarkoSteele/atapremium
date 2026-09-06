# 📊 Planejamento de Rastreamento Google (GTM, GA4 e Search Console)

Este documento detalha o planejamento e os procedimentos passo a passo para a correta implementação dos três principais recursos de rastreamento do ecossistema Google no novo tema WordPress **ATA Premium**.

---

## 🎯 Objetivos de Rastreamento
1. **Google Tag Manager (GTM):** Centralizar a gestão de todas as tags de marketing e analytics do site em um único lugar sem necessidade de mexer constantemente no código.
2. **Google Analytics 4 (GA4):** Mensurar o tráfego, comportamento dos usuários e conversões (envio de formulário de aula experimental, cliques no WhatsApp).
3. **Google Search Console (GSC):** Garantir a indexação correta no Google, monitorar saúde técnica de SEO e termos de busca orgânica.

---

## 1. Google Tag Manager (GTM)

### 📌 ID do Container: `GTM-XXXXXXX` *(Substituir pelo ID real)*

### ⚙️ Métodos de Implementação no Tema

#### Método A: Inserção Direta via `functions.php` (Recomendado)
Adicione o código abaixo ao arquivo [`functions.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/functions.php) utilizando os hooks semânticos do WordPress:

```php
// Injeta o script do GTM no <head>
function atapremium_gtm_head() {
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
    <!-- End Google Tag Manager -->
    <?php
}
add_action( 'wp_head', 'atapremium_gtm_head', 1 );

// Injeta o noscript do GTM logo após a abertura da tag <body>
function atapremium_gtm_body() {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action( 'wp_body_open', 'atapremium_gtm_body', 1 );
```

---

## 2. Google Analytics 4 (GA4)

### 📌 ID de Medição: `G-XXXXXXXXXX` *(Substituir pelo ID real)*

### ⚙️ Configuração via Google Tag Manager (Recomendado)
Ao centralizar no GTM:
1. Acesse o **Google Tag Manager**.
2. Crie uma nova **Tag** do tipo **Google Tag** (para GA4).
3. Informe o seu **ID de Medição** (`G-XXXXXXXXXX`).
4. Defina o acionador como **Initialization - All Pages** ou **All Pages**.
5. Publique a versão do container.

### 📊 Eventos Customizados Mapeados
* **`generate_lead`**: Disparado quando o formulário de Aula Experimental é enviado com sucesso no componente REST API (`form-lead.js`).
* **`click_whatsapp`**: Disparado ao clicar no botão de contato via WhatsApp.

---

## 3. Google Search Console (GSC)

### ⚙️ Métodos de Verificação da Propriedade

#### Opção 1: Via Meta Tag no `<head>`
Insira a meta tag fornecida pelo Search Console no arquivo [`functions.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/functions.php):

```php
function atapremium_gsc_verification() {
    ?>
    <meta name="google-site-verification" content="SEU_CODIGO_DE_VERIFICACAO_AQUI" />
    <?php
}
add_action( 'wp_head', 'atapremium_gsc_verification', 2 );
```

#### Opção 2: Via Conta GA4 / GTM (Automática)
Se a tag do GTM ou GA4 já estiver instalada sob a mesma conta de e-mail do Search Console, o Google valida a propriedade automaticamente.

#### Opção 3: Registro TXT no DNS (Recomendado para domínio completo)
Adicionar um registro TXT na zona de DNS do domínio `premiumma.com` (no Provedor de Hospedagem / Cloudflare / Registro.br).

---

## ✅ Checklist de Validação
- [ ] Verificar presença do GTM usando a extensão **Google Tag Assistant**.
- [ ] Testar envio de evento no modo **Preview/Debug** do GTM.
- [ ] Verificar disparos do GA4 na aba **Network** (filtro por `collect`).
- [ ] Confirmar validação de propriedade no painel do Google Search Console.
