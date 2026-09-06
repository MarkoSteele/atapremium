<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- DataLayer inicial para GTM -->
    <script>
        window.dataLayer = window.dataLayer || [];
    </script>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Flutuante Premium (Estilo Pill / Frosted Glass inspirado em Print 2) -->
<header class="site-header-wrapper">
    <div class="header-floating-pill">
        <!-- Logo -->
        <div class="header-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="ATA Premium Martial Arts">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/logo.png' ); ?>" alt="ATA Premium Martial Arts" class="site-logo-img">
            </a>
        </div>

        <!-- Menu Principal Central -->
        <nav class="header-nav" aria-label="Navegação Principal">
            <ul class="nav-list">
                <li><a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" data-i18n="nav_home">Início</a></li>
                <li><a href="<?php echo esc_url( home_url( '/sobre-a-ata/' ) ); ?>" data-i18n="nav_about">Sobre a ATA</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#programas' ) ); ?>" data-i18n="nav_programs">Programas</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#instagram' ) ); ?>" data-i18n="nav_instagram">Instagram</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#unidades' ) ); ?>" data-i18n="nav_units">Unidades</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#jornada' ) ); ?>" data-i18n="nav_method">Método Songahm</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" data-i18n="nav_faq">Dúvidas</a></li>
            </ul>
        </nav>

        <!-- Redes Sociais, Idiomas & CTA à Direita -->
        <div class="header-actions">
            <!-- Seletor Moderno de Idioma (PT / EN / ES) -->
            <div class="header-lang-mount">
                <div class="lang-switcher-dropdown" id="langSwitcherDropdown">
                    <button type="button" class="lang-btn-current" aria-haspopup="true" aria-expanded="false" aria-label="Alterar Idioma">
                        <span class="lang-flag-wrap">
                            <svg class="lang-flag-svg" viewBox="0 0 32 32" width="20" height="20" aria-hidden="true"><clipPath id="circle-br-hdr"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-br-hdr)"><rect width="32" height="32" fill="#009b3a"/><polygon points="16,4 30,16 16,28 2,16" fill="#fedf00"/><circle cx="16" cy="16" r="7" fill="#002776"/><path d="M9.5,17.5 A7,7 0 0,0 22.5,14" stroke="#ffffff" stroke-width="1.3" fill="none"/></g></svg>
                        </span>
                        <span class="lang-code-current">PT</span>
                        <svg class="lang-chevron" viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="lang-dropdown-menu" role="menu">
                        <button type="button" class="lang-option is-active" data-lang="pt" role="menuitem">
                            <span class="lang-flag-wrap">
                                <svg class="lang-flag-svg" viewBox="0 0 32 32" width="20" height="20" aria-hidden="true"><clipPath id="circle-br-opt"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-br-opt)"><rect width="32" height="32" fill="#009b3a"/><polygon points="16,4 30,16 16,28 2,16" fill="#fedf00"/><circle cx="16" cy="16" r="7" fill="#002776"/><path d="M9.5,17.5 A7,7 0 0,0 22.5,14" stroke="#ffffff" stroke-width="1.3" fill="none"/></g></svg>
                            </span>
                            <span class="lang-name">Português</span>
                            <span class="lang-check">✓</span>
                        </button>
                        <button type="button" class="lang-option" data-lang="en" role="menuitem">
                            <span class="lang-flag-wrap">
                                <svg class="lang-flag-svg" viewBox="0 0 32 32" width="20" height="20" aria-hidden="true"><clipPath id="circle-en-opt"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-en-opt)"><rect width="32" height="32" fill="#bf0a30"/><rect y="4.5" width="32" height="4.5" fill="#ffffff"/><rect y="13.5" width="32" height="4.5" fill="#ffffff"/><rect y="22.5" width="32" height="4.5" fill="#ffffff"/><rect width="15" height="16" fill="#002868"/><circle cx="4" cy="4" r="1.2" fill="#fff"/><circle cx="11" cy="4" r="1.2" fill="#fff"/><circle cx="7.5" cy="8" r="1.2" fill="#fff"/><circle cx="4" cy="12" r="1.2" fill="#fff"/><circle cx="11" cy="12" r="1.2" fill="#fff"/></g></svg>
                            </span>
                            <span class="lang-name">English</span>
                            <span class="lang-check">✓</span>
                        </button>
                        <button type="button" class="lang-option" data-lang="es" role="menuitem">
                            <span class="lang-flag-wrap">
                                <svg class="lang-flag-svg" viewBox="0 0 32 32" width="20" height="20" aria-hidden="true"><clipPath id="circle-es-opt"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-es-opt)"><rect width="32" height="32" fill="#aa151b"/><rect y="7" width="32" height="18" fill="#f1bf00"/><rect x="7" y="11" width="5" height="9" rx="2" fill="#aa151b"/></g></svg>
                            </span>
                            <span class="lang-name">Español</span>
                            <span class="lang-check">✓</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="header-socials">
                <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram @ata.premium" title="Siga no Instagram @ata.premium">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="https://www.tiktok.com/@ata.premium" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="TikTok @ata.premium" title="Siga no TikTok">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="currentColor">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.5 6.3 6.3 0 0 0 1.87-4.5V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-.88-.07z"/>
                    </svg>
                </a>
                <a href="https://www.youtube.com/@atapremium" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="YouTube" title="Canal no YouTube">
                    <svg viewBox="0 0 24 24" width="19" height="19" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>

            <!-- Botão CTA Aula Experimental -->
            <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn-header-cta" data-track="cta_header_agendar">
                <span data-i18n="nav_cta">Aula Grátis</span>
            </a>

            <!-- Botão Menu Mobile -->
            <button class="mobile-menu-toggle" aria-label="Abrir Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Drawer Menu Mobile -->
    <div class="mobile-nav-drawer">
        <!-- Idiomas no Menu Mobile -->
        <div class="mobile-lang-mount">
            <div class="mobile-lang-segmented" role="radiogroup" aria-label="Seleção de Idioma">
                <button type="button" class="mobile-lang-tab is-active" data-lang="pt">
                    <span class="lang-flag-wrap">
                        <svg class="lang-flag-svg" viewBox="0 0 32 32" width="18" height="18" aria-hidden="true"><clipPath id="circle-br-mob"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-br-mob)"><rect width="32" height="32" fill="#009b3a"/><polygon points="16,4 30,16 16,28 2,16" fill="#fedf00"/><circle cx="16" cy="16" r="7" fill="#002776"/><path d="M9.5,17.5 A7,7 0 0,0 22.5,14" stroke="#ffffff" stroke-width="1.3" fill="none"/></g></svg>
                    </span>
                    <span>PT</span>
                </button>
                <button type="button" class="mobile-lang-tab" data-lang="en">
                    <span class="lang-flag-wrap">
                        <svg class="lang-flag-svg" viewBox="0 0 32 32" width="18" height="18" aria-hidden="true"><clipPath id="circle-en-mob"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-en-mob)"><rect width="32" height="32" fill="#bf0a30"/><rect y="4.5" width="32" height="4.5" fill="#ffffff"/><rect y="13.5" width="32" height="4.5" fill="#ffffff"/><rect y="22.5" width="32" height="4.5" fill="#ffffff"/><rect width="15" height="16" fill="#002868"/><circle cx="4" cy="4" r="1.2" fill="#fff"/><circle cx="11" cy="4" r="1.2" fill="#fff"/><circle cx="7.5" cy="8" r="1.2" fill="#fff"/><circle cx="4" cy="12" r="1.2" fill="#fff"/><circle cx="11" cy="12" r="1.2" fill="#fff"/></g></svg>
                    </span>
                    <span>EN</span>
                </button>
                <button type="button" class="mobile-lang-tab" data-lang="es">
                    <span class="lang-flag-wrap">
                        <svg class="lang-flag-svg" viewBox="0 0 32 32" width="18" height="18" aria-hidden="true"><clipPath id="circle-es-mob"><circle cx="16" cy="16" r="16"/></clipPath><g clip-path="url(#circle-es-mob)"><rect width="32" height="32" fill="#aa151b"/><rect y="7" width="32" height="18" fill="#f1bf00"/><rect x="7" y="11" width="5" height="9" rx="2" fill="#aa151b"/></g></svg>
                    </span>
                    <span>ES</span>
                </button>
            </div>
        </div>

        <ul class="mobile-nav-list">
            <li><a href="<?php echo esc_url( home_url( '/#hero' ) ); ?>" data-i18n="nav_home">Início</a></li>
            <li><a href="<?php echo esc_url( home_url( '/sobre-a-ata/' ) ); ?>" data-i18n="nav_about">Sobre a ATA</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#programas' ) ); ?>" data-i18n="nav_programs">Programas</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#instagram' ) ); ?>" data-i18n="nav_instagram">Instagram (@ata.premium)</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#unidades' ) ); ?>" data-i18n="nav_units">Unidades</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#jornada' ) ); ?>" data-i18n="nav_method">Método Songahm</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" data-i18n="nav_faq">Dúvidas</a></li>
            <li class="mobile-cta-item">
                <a href="<?php echo esc_url( home_url( '/#contato' ) ); ?>" class="btn btn-gold btn-block" data-i18n="nav_mobile_cta">Agendar Aula Experimental</a>
            </li>
            <li class="mobile-socials-item">
                <a href="https://www.instagram.com/ata.premium" target="_blank" rel="noopener">Instagram</a>
                <a href="https://wa.me/5548999313558" target="_blank" rel="noopener">WhatsApp</a>
            </li>
        </ul>
    </div>
</header>
