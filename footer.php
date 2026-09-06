<footer class="site-footer">
    <div class="container footer-container">
        <!-- Coluna 1: Marca e Posicionamento -->
        <div class="footer-brand-col">
            <div class="footer-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="ATA Premium Martial Arts">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/logo.png' ); ?>" alt="ATA Premium Martial Arts" class="footer-logo-img">
                </a>
            </div>
            <p class="footer-mission">
                Formando líderes e faixas pretas para a vida em Florianópolis. Metodologia internacional Songahm focada em disciplina voluntária, respeito mútuo e excelência humana.
            </p>
            
            <!-- Caixa de Destaque Instagram -->
            <div class="footer-insta-box">
                <div class="footer-insta-text">
                    <strong>Siga no Instagram:</strong>
                    <span>@ata.premium</span>
                </div>
                <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener noreferrer" class="btn-insta-follow" title="Acessar Instagram @ata.premium">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    Seguir
                </a>
            </div>
        </div>

        <!-- Coluna 2: Nossas Unidades -->
        <div class="footer-col">
            <h4 class="footer-title">Nossas Unidades</h4>
            <ul class="footer-nav-list">
                <li>
                    <a href="<?php echo esc_url( home_url( '/unidade-alves-de-brito/' ) ); ?>">
                        <strong>Unidade Alves de Brito (Centro)</strong>
                        <span>Rua Alves de Brito, nº 33</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/unidade-colegio-catarinense/' ) ); ?>">
                        <strong>Unidade Col. Catarinense (Centro)</strong>
                        <span>Ao lado do Colégio Catarinense</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/unidade-spotmarkt/' ) ); ?>">
                        <strong>Unidade Spotmarkt (Córrego Grande)</strong>
                        <span>Mall Spotmarkt</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Coluna 3: Atendimento e Redes -->
        <div class="footer-col">
            <h4 class="footer-title">Atendimento & Redes</h4>
            <ul class="footer-contact-list">
                <li>
                    <span class="icon">📞</span>
                    <div>
                        <strong>Central WhatsApp:</strong>
                        <a href="https://wa.me/5548999313558" target="_blank" rel="noopener">(48) 99931-3558</a>
                    </div>
                </li>
                <li>
                    <span class="icon">🕒</span>
                    <div>
                        <strong>Horário Geral:</strong>
                        <span>Seg a Sex: 09h às 12h | 15h às 21h</span>
                    </div>
                </li>
                <li>
                    <span class="icon">🌐</span>
                    <div class="footer-social-links">
                        <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener" title="Instagram">Instagram</a>
                        <a href="https://www.tiktok.com/@ata.premium" target="_blank" rel="noopener" title="TikTok">TikTok</a>
                        <a href="https://www.youtube.com/@atapremium" target="_blank" rel="noopener" title="YouTube">YouTube</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Barra de Direitos e Legais -->
    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <p>© <?php echo date( 'Y' ); ?> ATA Premium Martial Arts Florianópolis. Todos os direitos reservados.</p>
            <p class="footer-affiliation">Filiada à American Taekwondo Association (ATA / WTTU / STF) • Método Songahm</p>
        </div>
    </div>
</footer>

<!-- Botão Flutuante do WhatsApp no Canto Inferior Direito -->
<a href="https://wa.me/5548999313558?text=Olá!%20Gostaria%20de%20mais%20informações%20sobre%20as%20aulas%20na%20ATA%20Premium." class="floating-wpp-btn" target="_blank" rel="noopener" aria-label="Falar no WhatsApp" data-track="floating_whatsapp">
    <svg viewBox="0 0 24 24" width="28" height="28" fill="#ffffff">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
    </svg>
</a>

<?php wp_footer(); ?>
</body>
</html>
