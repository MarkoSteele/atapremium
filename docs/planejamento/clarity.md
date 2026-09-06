# 🔍 Planejamento de Implementação do Microsoft Clarity

Este documento apresenta o planejamento detalhado para a integração da ferramenta de análise de experiência do usuário **Microsoft Clarity** no site **ATA Premium**.

---

## 🎯 Por que implementar o Microsoft Clarity?
* **Gravação de Sessões (Session Replays):** Visualizar exatamente como os visitantes navegam pelo site em desktop e mobile.
* **Mapas de Calor (Heatmaps):** Identificar áreas mais clicadas, rolagem de página (scroll depth) e pontos de maior atenção.
* **Métricas de Frustração:** Detectar "rage clicks" (cliques repetidos com frustração), "dead clicks" (cliques em elementos não clicáveis) e rolagem excessiva.
* **100% Gratuito:** Sem limite de tráfego e totalmente em conformidade com as diretrizes de privacidade (LGPD).

---

## 📌 ID do Projeto no Clarity: `XXXXXXXXXX` *(Substituir pelo ID real)*

---

## ⚙️ Métodos de Implementação

### Método A: Inserção via Google Tag Manager (Recomendado)

O GTM possui integração nativa ou suporte simples para a tag do Microsoft Clarity:

1. Acesse o **Google Tag Manager**.
2. Crie uma nova Tag.
3. Pesquise por **Microsoft Clarity** na Galeria de Modelos de Tag da Comunidade ou escolha a tag **Custom HTML**.
4. Cole o código oficial do Clarity:
```html
<!-- Microsoft Clarity Code -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "SEU_CLARITY_ID_AQUI");
</script>
<!-- End Microsoft Clarity Code -->
```
5. Defina o acionador para **All Pages**.
6. Salve e publique o container.

---

### Método B: Inserção Direta via `functions.php`

Adicione a função abaixo no arquivo [`functions.php`](file:///Users/marcuspauloteixeiracardoso/Local%20Sites/atapremium/app/public/wp-content/themes/atapremium/functions.php):

```php
function atapremium_clarity_head() {
    ?>
    <!-- Microsoft Clarity Code -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "SEU_CLARITY_ID_AQUI");
    </script>
    <!-- End Microsoft Clarity Code -->
    <?php
}
add_action( 'wp_head', 'atapremium_clarity_head', 10 );
```

---

## 🛡️ Privacidade e LGPD

O Microsoft Clarity já vem pré-configurado com mascaramento de dados por padrão:
* **Dados Pessoais (PII):** Campos de entrada como nome, e-mail e telefone são automaticamente ocultados/mascarados nas gravações de tela.
* **Conformidade:** Totalmente ajustado para LGPD e GDPR sem armazenar informações sensíveis dos usuários que preencherem o formulário de Aula Experimental.

---

## ✅ Checklist de Validação
- [ ] Inserir o script do Clarity (via GTM ou `functions.php`).
- [ ] Acessar o painel do [Microsoft Clarity Dashboard](https://clarity.microsoft.com/).
- [ ] Confirmar o recebimento dos primeiros dados e gravações de sessão após alguns minutos de navegação no site.
