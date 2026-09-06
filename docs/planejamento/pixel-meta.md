# 🎯 Planejamento de Implementação do Meta Pixel (Facebook & Instagram Ads)

Este documento detalha o planejamento para a inserção e configuração do **Meta Pixel** (Pixel do Facebook) no site da **ATA Premium**, permitindo a mensuração de conversões, otimização de campanhas de anúncios e criação de públicos de remarketing.

---

## 📌 ID do Meta Pixel: `XXXXXXXXXXXXXXXX` *(Substituir pelo ID real)*

---

## ⚙️ Métodos de Implementação

### Método A: Inserção via Google Tag Manager (Recomendado)
A utilização do GTM garante que o código permaneça limpo e centralizado:

1. Acesse o **Google Tag Manager**.
2. Crie uma nova Tag do tipo **Custom HTML** (HTML Personalizado).
3. Cole o código base do Meta Pixel:
```html
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', 'SEU_PIXEL_ID_AQUI');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=SEU_PIXEL_ID_AQUI&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
```
4. Configure o acionador para **All Pages**.

---

### Método B: Inserção Direta no `functions.php`
Caso prefira injetar diretamente no tema WordPress, insira a função abaixo no arquivo [`functions.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/functions.php):

```php
function atapremium_meta_pixel_head() {
    ?>
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 'SEU_PIXEL_ID_AQUI');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=SEU_PIXEL_ID_AQUI&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    <?php
}
add_action( 'wp_head', 'atapremium_meta_pixel_head', 5 );
```

---

## 🛒 Mapeamento de Eventos de Conversão

| Evento Meta | Ação no Site | Onde Disparar |
| :--- | :--- | :--- |
| **`PageView`** | Carregamento de qualquer página | Todas as páginas (código base) |
| **`Lead`** | Envio do formulário "Aula Experimental Grátis" | Sucesso do formulário no JS (`form-lead.js`) ou via GTM |
| **`Contact`** | Clique no botão do WhatsApp | Evento de clique no botão do WhatsApp |

### Disparo do Evento `Lead` no JavaScript do Formulário:
No arquivo [`assets/js/form-lead.js`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/assets/js/form-lead.js), quando a API responder com sucesso:

```javascript
if (typeof fbq === 'function') {
    fbq('track', 'Lead', {
        content_name: 'Aula Experimental Grátis',
        status: true
    });
}
```

---

## ✅ Validação da Instalação
- Instalar a extensão para navegador **Meta Pixel Helper** (disponível no Chrome Web Store).
- Acessar o site e verificar se o ícone da extensão fica azul exibindo o evento `PageView`.
- Realizar um teste de envio do formulário e verificar o disparo do evento `Lead`.
