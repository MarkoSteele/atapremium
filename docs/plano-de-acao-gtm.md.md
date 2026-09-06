# Plano de Ação (PA): Implementação GTM, GA4, Ads e Clarity
**Projeto:** Rastreamento & Mensuração de Conversões  
**Etapa 3:** Matriz de Tags e Disparos no Google Tag Manager  

---

## 1. Matriz de Tags e Disparos

| Tag GTM | Tipo de Tag | Acionador / Regra de Disparo | Parâmetros Enviados / Configuração |
| :--- | :--- | :--- | :--- |
| **GA4 - Configuração** | Google Tag / GA4 Configuration | Inicialização - Todas as páginas (`Initialization - All Pages`) | `page_location`, `page_title` |
| **GA4 - WhatsApp Click** | Evento do GA4 (`click_whatsapp`) | Clique em links contendo `wa.me` ou `api.whatsapp` | `unidade_clicada`, `posicao_elemento`, `link_url` |
| **GA4 - Generate Lead** | Evento do GA4 (`generate_lead`) | Evento personalizado: `form_lead_sucesso` | `unidade`, `faixa_etaria`, `form_id` |
| **Google Ads - Conversão Lead** | Google Ads Conversion Tracking | Evento personalizado: `form_lead_sucesso` | `Conversion ID`, `Conversion Label` |
| **Google Ads - Conversão Wpp** | Google Ads Conversion Tracking | Clique nos botões de WhatsApp | `Conversion ID`, `Conversion Label` |
| **Microsoft Clarity** | HTML Personalizado | Todas as páginas (`All Pages`) | Script base Clarity (gravação, mapas de calor, dead/rage clicks) |

---

## 2. Dicionário de Variáveis Necessárias no GTM

Para que os parâmetros sejam preenchidos de forma dinâmica, configure as seguintes variáveis no GTM:

### Variáveis Nativas (Habilitar em Variáveis > Configurar):
* `Click URL`
* `Click Text`
* `Click Classes`
* `Click Element`

### Variáveis da Camada de Dados (Data Layer Variables):
* `dlv - unidade`: Nome da variável na camada: `leadData.unidade`
* `dlv - faixa_etaria`: Nome da variável na camada: `leadData.faixa_etaria`
* `dlv - form_id`: Nome da variável na camada: `leadData.form_id`

### Variáveis Constantes:
* `const - GA4 Measurement ID`: `G-XXXXXXXXXX`
* `const - Google Ads ID`: `AW-XXXXXXXXXX`
* `const - Google Ads Label Lead`: `XXXXXXXXXXXXXXXX`
* `const - Google Ads Label Wpp`: `XXXXXXXXXXXXXXXX`

---

## 3. Especificação dos Acionadores (Triggers)

### Acionador 1: `Trig - Clique WhatsApp`
* **Tipo:** Apenas Links (`Just Links`) ou Todos os Elementos (`All Elements`)
* **Disparar em:** Alguns Cliques
* **Condição:** `Click URL` contém `wa.me` OU `Click URL` contém `api.whatsapp.com`

### Acionador 2: `Trig - Custom Event - form_lead_sucesso`
* **Tipo:** Evento Personalizado (`Custom Event`)
* **Nome do Evento:** `form_lead_sucesso`
* **Disparar em:** Todos os eventos personalizados

---

## 4. Snippet da Camada de Dados para o Desenvolvedor

Insira o script abaixo no callback de sucesso do formulário do site:

```javascript
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
  event: 'form_lead_sucesso',
  leadData: {
    form_id: 'form_aula_experimental',
    unidade: 'Spotmarkt', // Dinâmico de acordo com a seleção
    faixa_etaria: 'Kids (7 a 13 anos)' // Dinâmico de acordo com a seleção
  }
});