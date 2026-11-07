document.addEventListener('DOMContentLoaded', () => {
    // 0. Gerenciamento de UTMs (Captura e Persistência na Sessão)
    const getStoredUtms = () => {
        const utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
        const urlParams = new URLSearchParams(window.location.search);
        let utms = {};

        utmKeys.forEach(key => {
            const val = urlParams.get(key);
            if (val) {
                sessionStorage.setItem('ata_' + key, val);
                utms[key] = val;
            } else {
                utms[key] = sessionStorage.getItem('ata_' + key) || '';
            }
        });
        return utms;
    };
    const currentUtms = getStoredUtms();

    // 0.1. Máscara de Telefone Brasileira Dinâmica (XX) XXXXX-XXXX
    const applyPhoneMask = (input) => {
        if (!input) return;
        input.addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 11) v = v.slice(0, 11);
            if (v.length > 10) {
                e.target.value = `(${v.slice(0, 2)}) ${v.slice(2, 7)}-${v.slice(7)}`;
            } else if (v.length > 6) {
                e.target.value = `(${v.slice(0, 2)}) ${v.slice(2, 6)}-${v.slice(6)}`;
            } else if (v.length > 2) {
                e.target.value = `(${v.slice(0, 2)}) ${v.slice(2)}`;
            } else if (v.length > 0) {
                e.target.value = `(${v}`;
            } else {
                e.target.value = '';
            }
        });
    };

    document.querySelectorAll('input[type="tel"], input[name="telefone"], input[name="wpp_telefone"]').forEach(applyPhoneMask);

    // 1. Controle de Scroll no Header Flutuante Otimizado com requestAnimationFrame (Sem Reflow Forçado)
    const siteHeaderWrapper = document.querySelector('.site-header-wrapper');
    if (siteHeaderWrapper) {
        let isScrollingHeader = false;
        const handleScroll = () => {
            if (!isScrollingHeader) {
                window.requestAnimationFrame(() => {
                    if (window.scrollY > 40) {
                        siteHeaderWrapper.classList.add('header-scrolled');
                    } else {
                        siteHeaderWrapper.classList.remove('header-scrolled');
                    }
                    isScrollingHeader = false;
                });
                isScrollingHeader = true;
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // 2. Mobile Menu Toggle com Trava de Scroll no Body
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileDrawer = document.querySelector('.mobile-nav-drawer');
    if (menuToggle && mobileDrawer) {
        const openMobileMenu = () => {
            mobileDrawer.classList.add('active');
            menuToggle.classList.add('is-active');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.classList.add('mobile-menu-open');
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        };

        const closeMobileMenu = () => {
            mobileDrawer.classList.remove('active');
            menuToggle.classList.remove('is-active');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('mobile-menu-open');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        };

        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            if (mobileDrawer.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Fecha ao clicar em um link interno do menu
        mobileDrawer.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
            });
        });

        // Fecha ao clicar fora do drawer
        document.addEventListener('click', (e) => {
            if (!mobileDrawer.contains(e.target) && !menuToggle.contains(e.target) && mobileDrawer.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Fecha com tecla ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileDrawer.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    }

    // 3. Envio Assíncrono do Formulário de Lead Home + GTM DataLayer
    const form = document.querySelector('#form-lead-home');
    
    if (form) {
        // Elementos de Feedback visual
        const btnSubmit = form.querySelector('button[type="submit"]');
        let feedbackMessage = form.querySelector('.form-feedback-message');
        if (!feedbackMessage) {
            feedbackMessage = document.createElement('div');
            feedbackMessage.className = 'form-feedback-message';
            form.appendChild(feedbackMessage);
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            btnSubmit.disabled = true;
            const originalBtnText = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<span class="spinner"></span> Enviando solicitação...';
            
            feedbackMessage.className = 'form-feedback-message';
            feedbackMessage.innerText = '';

            const nome = form.querySelector('[name="nome"]')?.value.trim() || '';
            const email = form.querySelector('[name="email"]')?.value.trim() || '';
            const telefone = form.querySelector('[name="telefone"]')?.value.trim() || '';
            const unidade = form.querySelector('[name="unidade"]')?.value || 'Central';
            const faixaEtaria = form.querySelector('[name="faixa_etaria"]')?.value || 'Não informada';

            const payload = {
                nome: nome,
                email: email,
                telefone: telefone,
                unidade: unidade,
                programa: faixaEtaria,
                origem: 'form_home',
                ...getStoredUtms()
            };

            // Disparo Imediato para a Camada de Dados (GTM / GA4 / Google Ads)
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'generate_lead',
                form_id: 'form-lead-home',
                form_location: 'form_home',
                method: 'formulario_site',
                unidade: unidade,
                programa: faixaEtaria,
                lead_data: {
                    unidade: unidade,
                    programa: faixaEtaria,
                    utm_source: payload.utm_source,
                    utm_campaign: payload.utm_campaign
                }
            });

            // Endpoints de Envio (Canal Duplo: REST API + Fallback AJAX Universal)
            const restUrl = window.wpApiSettings ? wpApiSettings.root + 'atapremium/v1/lead' : '/wp-json/atapremium/v1/lead';
            const ajaxUrl = window.wpApiSettings && wpApiSettings.ajax_url ? wpApiSettings.ajax_url : '/wp-admin/admin-ajax.php?action=atapremium_lead';

            let saved = false;
            let errorMessage = '';

            // 1ª Tentativa: REST API Principal
            try {
                const response = await fetch(restUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result && result.success) {
                        saved = true;
                    }
                }
            } catch (restError) {
                console.warn('REST API temporariamente indisponível, acionando fallback AJAX...', restError);
            }

            // 2ª Tentativa: Fallback Universal AJAX
            if (!saved) {
                try {
                    const ajaxResponse = await fetch(ajaxUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    if (ajaxResponse.ok) {
                        const ajaxResult = await ajaxResponse.json();
                        if (ajaxResult && ajaxResult.success) {
                            saved = true;
                        } else if (ajaxResult && ajaxResult.message) {
                            errorMessage = ajaxResult.message;
                        }
                    }
                } catch (ajaxError) {
                    console.error('Falha em ambos os canais de envio:', ajaxError);
                }
            }

            if (saved) {
                feedbackMessage.classList.add('success');
                feedbackMessage.innerText = '✓ Solicitação confirmada com sucesso! Entraremos em contato via WhatsApp para agendar sua aula experimental.';
                form.reset();
            } else {
                feedbackMessage.classList.add('error');
                feedbackMessage.innerText = errorMessage || 'Não foi possível registrar seu agendamento no momento. Por favor, chame nossa equipe diretamente pelo WhatsApp: (48) 99931-3558.';
            }

            btnSubmit.disabled = false;
            btnSubmit.innerHTML = originalBtnText;
        });
    }

    // 4. Efeito Parallax Suave Otimizado com requestAnimationFrame (Elimina Reflow Forçado)
    const faqSection = document.querySelector('#faq');
    const faqLogo = document.querySelector('.faq-parallax-watermark');
    const journeySection = document.querySelector('#jornada');
    const journeyLogo = document.querySelector('.journey-parallax-watermark');
    const journeyBgImage = document.querySelector('.journey-bg-image');

    if (faqSection || journeySection) {
        let isParallaxTicking = false;

        const updateParallax = () => {
            const windowHeight = window.innerHeight;

            // Parallax Logo na Seção Jornada
            if (journeySection && journeyLogo) {
                const rect = journeySection.getBoundingClientRect();
                if (rect.top < windowHeight && rect.bottom > 0) {
                    const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                    const translateY = (scrollProgress - 0.5) * 140;
                    journeyLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
                }
            }

            // Parallax Foto Blur da Jornada
            if (journeySection && journeyBgImage) {
                const rect = journeySection.getBoundingClientRect();
                if (rect.top < windowHeight && rect.bottom > 0) {
                    const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                    const translateY = (scrollProgress - 0.5) * 50;
                    journeyBgImage.style.transform = `scale(1.08) translateY(${translateY.toFixed(1)}px)`;
                }
            }

            // Parallax FAQ Logo
            if (faqSection && faqLogo) {
                const rect = faqSection.getBoundingClientRect();
                if (rect.top < windowHeight && rect.bottom > 0) {
                    const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                    const translateY = (scrollProgress - 0.5) * 140;
                    faqLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
                }
            }

            isParallaxTicking = false;
        };

        const handleParallaxScroll = () => {
            if (!isParallaxTicking) {
                window.requestAnimationFrame(updateParallax);
                isParallaxTicking = true;
            }
        };

        window.addEventListener('scroll', handleParallaxScroll, { passive: true });
        window.addEventListener('resize', handleParallaxScroll, { passive: true });
    }

    // 5. Gerenciamento de Alta Performance para Vídeos (Lazy Autoplay via IntersectionObserver)
    const initVideoAutoplay = () => {
        // Vídeo Hero: inicia imediatamente com atributos otimizados
        const heroVideo = document.querySelector('.hero-video-bg');
        if (heroVideo) {
            heroVideo.muted = true;
            heroVideo.defaultMuted = true;
            heroVideo.playsInline = true;
            heroVideo.setAttribute('playsinline', '');
            heroVideo.setAttribute('webkit-playsinline', '');
            heroVideo.setAttribute('muted', '');
            heroVideo.setAttribute('autoplay', '');
            heroVideo.setAttribute('loop', '');
            heroVideo.play().catch(() => {});
        }

        // Demais vídeos (Reels, Unidades, etc.): carregamento lazy via IntersectionObserver
        const lazyVideos = document.querySelectorAll('.reel-video-element, .unit-card-video');
        
        if ('IntersectionObserver' in window && lazyVideos.length) {
            const videoObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const video = entry.target;
                    const reelCard = video.closest('.reel-card');
                    if (entry.isIntersecting) {
                        video.muted = true;
                        video.defaultMuted = true;
                        video.playsInline = true;
                        video.setAttribute('playsinline', '');
                        video.setAttribute('webkit-playsinline', '');
                        video.play().then(() => {
                            if (reelCard) reelCard.classList.add('is-playing');
                        }).catch(() => {});
                    } else {
                        // Pausa vídeos fora da tela para poupar CPU, memória e bateria
                        if (!video.paused) {
                            video.pause();
                        }
                    }
                });
            }, { 
                threshold: 0.15,
                rootMargin: '100px 0px 100px 0px' // Começa a carregar um pouco antes de entrar na viewport
            });

            lazyVideos.forEach(video => {
                video.muted = true;
                video.defaultMuted = true;
                videoObserver.observe(video);
            });
        }

        // Interação nos cards de Reels (Play/Pause ao clicar)
        const reelCards = document.querySelectorAll('.reel-card');
        reelCards.forEach(card => {
            const video = card.querySelector('video');
            const playBtn = card.querySelector('.reel-play-btn');
            
            if (video && playBtn) {
                const toggleVideo = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    if (video.paused) {
                        video.play();
                        card.classList.add('is-playing');
                    } else {
                        video.pause();
                        card.classList.remove('is-playing');
                    }
                };

                playBtn.addEventListener('click', toggleVideo);
                card.addEventListener('click', (e) => {
                    if (!e.target.closest('a')) {
                        toggleVideo(e);
                    }
                });
            }
        });
    };

    initVideoAutoplay();

    // 6. Animação Global de Scroll Reveal (Aparecimento suave do conteúdo ao rolar a página)
    const initScrollReveal = () => {
        const revealElements = document.querySelectorAll('.reveal-on-scroll');
        if (!revealElements.length) return;

        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -30px 0px'
            });

            revealElements.forEach(el => revealObserver.observe(el));
        } else {
            revealElements.forEach(el => el.classList.add('is-visible'));
        }
    };

    initScrollReveal();

    // 7. Animação de Contagem Progressiva dos Big Numbers (#autoridade)
    const initBigNumbersCounter = () => {
        const metricsSection = document.querySelector('#autoridade');
        if (!metricsSection) return;

        const metricNumbers = metricsSection.querySelectorAll('.metric-number');
        let hasAnimated = false;

        const animateSingleNumber = (element, duration = 1800) => {
            const rawText = element.textContent.trim();
            const match = rawText.match(/^([^\d]*)([\d]+(?:[.,]\d+)?)(.*)$/);
            if (!match) return;

            const prefix = match[1] || '';
            const numStr = match[2].replace(',', '.');
            const targetValue = parseFloat(numStr);
            const isDecimal = match[2].includes('.') || match[2].includes(',');
            const decimals = isDecimal ? (match[2].split(/[.,]/)[1]?.length || 1) : 0;
            const suffix = match[3] || '';

            let startTimestamp = null;
            element.classList.add('is-counting');
            element.classList.remove('is-counted');

            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                
                // Curva de desaceleração suave: easeOutExpo
                const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const currentVal = targetValue * ease;
                
                const formattedVal = decimals > 0 ? currentVal.toFixed(decimals) : Math.floor(currentVal);
                element.textContent = `${prefix}${formattedVal}${suffix}`;

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    element.textContent = rawText;
                    element.classList.remove('is-counting');
                    element.classList.add('is-counted');
                }
            };

            window.requestAnimationFrame(step);
        };

        const startCounting = () => {
            metricNumbers.forEach((el, index) => {
                setTimeout(() => {
                    animateSingleNumber(el, 1800);
                }, index * 100);
            });
        };

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !hasAnimated) {
                        hasAnimated = true;
                        startCounting();
                    }
                });
            }, { threshold: 0.25 });

            observer.observe(metricsSection);
        } else {
            startCounting();
        }

        window.triggerMetricsAnimation = () => {
            startCounting();
        };
    };

    initBigNumbersCounter();

    // 8. Timeline Interativa Dinâmica ao Scroll (#jornada) com requestAnimationFrame
    const initTimelineProgress = () => {
        const journeySection = document.querySelector('#jornada');
        const progressBar = document.querySelector('.timeline-progress-bar');
        const timelineItems = document.querySelectorAll('.timeline-item');

        if (!journeySection || !progressBar || !timelineItems.length) return;

        let isTimelineTicking = false;

        const updateTimeline = () => {
            const rect = journeySection.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            const startThreshold = windowHeight * 0.70;
            const totalTravelDistance = rect.height;
            const currentTravel = startThreshold - rect.top;
            const progress = currentTravel / totalTravelDistance;
            const clampedProgress = Math.max(0, Math.min(1, progress));

            progressBar.style.height = `${clampedProgress * 100}%`;

            timelineItems.forEach(item => {
                const itemRect = item.getBoundingClientRect();
                if (itemRect.top < windowHeight * 0.72) {
                    item.classList.add('is-active');
                } else {
                    item.classList.remove('is-active');
                }
            });

            isTimelineTicking = false;
        };

        const handleTimelineScroll = () => {
            if (!isTimelineTicking) {
                window.requestAnimationFrame(updateTimeline);
                isTimelineTicking = true;
            }
        };

        window.addEventListener('scroll', handleTimelineScroll, { passive: true });
        window.addEventListener('resize', handleTimelineScroll, { passive: true });
    };

    initTimelineProgress();

    // 9. Controle do Modal 'Sobre a ATA' (Desktop e Mobile)
    const initAboutModal = () => {
        const modal = document.querySelector('#aboutModal');
        const openBtn = document.querySelector('#openAboutModalBtn');
        const closeBtn = document.querySelector('#closeAboutModalBtn');

        if (!modal) return;

        const openModal = () => {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            if (openBtn) openBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            if (openBtn) openBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        };

        if (openBtn) {
            openBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                openModal();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeModal();
            });
        }

        modal.addEventListener('click', (e) => {
            if (e.target === modal || e.target.classList.contains('about-modal-wrapper')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        const mobileSubnavBtn = document.querySelector('#mobileSubnavToggle');
        const mobileSubnavMenu = document.querySelector('#mobileSubnavMenu');

        if (mobileSubnavBtn && mobileSubnavMenu) {
            mobileSubnavBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                mobileSubnavBtn.classList.toggle('is-open');
                mobileSubnavMenu.classList.toggle('is-open');
            });
        }
    };

    initAboutModal();

    // 10. FAQ Acordeon Interativo
    const initFaqAccordion = () => {
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('.faq-item');
                if (!item) return;
                const isActive = item.classList.contains('active');

                document.querySelectorAll('.faq-item').forEach(other => {
                    other.classList.remove('active');
                    const ans = other.querySelector('.faq-answer');
                    if (ans) ans.style.maxHeight = null;
                });

                if (!isActive) {
                    item.classList.add('active');
                    const answer = item.querySelector('.faq-answer');
                    if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
                }
            });
        });
    };

    initFaqAccordion();

    // 11. Micro-Modal de Captura de Lead para WhatsApp & GTM DataLayer
    const initWhatsAppModal = () => {
        const modal = document.querySelector('#whatsapp-lead-modal');
        const formWpp = document.querySelector('#form-wpp-lead-modal');
        if (!modal || !formWpp) return;

        const inputNome = formWpp.querySelector('#wpp_lead_nome');
        const inputTelefone = formWpp.querySelector('#wpp_lead_telefone');
        const selectUnidade = formWpp.querySelector('#wpp_lead_unidade');
        const selectPrograma = formWpp.querySelector('#wpp_lead_programa');
        const btnSubmit = formWpp.querySelector('#btn-submit-wpp-modal');
        const feedbackBox = formWpp.querySelector('.wpp-modal-feedback');

        // Abre o modal pré-selecionando a unidade e programa se fornecidos
        const openWppModal = (unidadePref, programaPref) => {
            if (selectUnidade && unidadePref) {
                const normUnidade = unidadePref.toLowerCase();
                if (normUnidade.includes('alves') || normUnidade.includes('brito')) {
                    selectUnidade.value = 'Alves de Brito';
                } else if (normUnidade.includes('colegio') || normUnidade.includes('catarinense')) {
                    selectUnidade.value = 'Colégio Catarinense';
                } else if (normUnidade.includes('spot') || normUnidade.includes('markt') || normUnidade.includes('corrego')) {
                    selectUnidade.value = 'Spotmarkt';
                }
            }

            if (selectPrograma && programaPref) {
                Array.from(selectPrograma.options).forEach(opt => {
                    if (opt.value.toLowerCase().includes(programaPref.toLowerCase())) {
                        selectPrograma.value = opt.value;
                    }
                });
            }

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            if (feedbackBox) {
                feedbackBox.className = 'wpp-modal-feedback';
                feedbackBox.innerText = '';
            }

            setTimeout(() => {
                if (inputNome) inputNome.focus();
            }, 100);
        };

        // Fecha o modal
        const closeWppModal = () => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        };

        // Fechar ao clicar em elementos com [data-close-modal="true"]
        modal.querySelectorAll('[data-close-modal="true"]').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                closeWppModal();
            });
        });

        // Fechar com ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeWppModal();
            }
        });

        // Intercepta TODOS os cliques em botões e links de WhatsApp do site (Delegação Global em Capture Phase)
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest(
                '[data-track="whatsapp_unidade"], [data-track="cta_hero_wpp"], [data-track="floating_whatsapp"], .floating-wpp-btn, .btn-whatsapp, .btn-hero-wpp, .btn-404-wpp, a[href*="wa.me"], a[href*="api.whatsapp.com"], a[href*="whatsapp.com"]'
            );

            if (!trigger) return;

            // Ignora se for dentro do próprio modal ou explicitamente marcado como direto
            if (trigger.closest('#whatsapp-lead-modal') || trigger.getAttribute('data-direct-wpp') === 'true') {
                return;
            }

            e.preventDefault();
            e.stopPropagation();
            if (e.stopImmediatePropagation) {
                e.stopImmediatePropagation();
            }

            const unidadeAttr = trigger.getAttribute('data-unidade') || '';
            const programaAttr = trigger.getAttribute('data-programa') || '';
            
            openWppModal(unidadeAttr, programaAttr);
        }, true);


        // Submissão do Formulário de Lead do Micro-Modal
        formWpp.addEventListener('submit', async (e) => {
            e.preventDefault();

            const nome = inputNome ? inputNome.value.trim() : '';
            const telefone = inputTelefone ? inputTelefone.value.trim() : '';
            const unidade = selectUnidade ? selectUnidade.value : 'Alves de Brito';
            const programa = selectPrograma ? selectPrograma.value : 'Kids (7-13 anos)';

            const cleanDigits = telefone.replace(/\D/g, '');

            if (!nome || nome.length < 2) {
                if (feedbackBox) {
                    feedbackBox.className = 'wpp-modal-feedback error';
                    feedbackBox.innerText = 'Por favor, informe seu nome completo.';
                }
                if (inputNome) inputNome.focus();
                return;
            }

            if (!telefone || cleanDigits.length < 10) {
                if (feedbackBox) {
                    feedbackBox.className = 'wpp-modal-feedback error';
                    feedbackBox.innerText = 'Por favor, informe um WhatsApp válido com DDD.';
                }
                if (inputTelefone) inputTelefone.focus();
                return;
            }

            // Estado de carregamento
            const originalBtnContent = btnSubmit ? btnSubmit.innerHTML : '';
            if (btnSubmit) {
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<span class="spinner"></span> Conectando ao WhatsApp...';
            }
            if (feedbackBox) {
                feedbackBox.className = 'wpp-modal-feedback';
                feedbackBox.innerText = '';
            }

            const utms = getStoredUtms();
            const payload = {
                nome: nome,
                telefone: telefone,
                unidade: unidade,
                programa: programa,
                origem: 'whatsapp_modal',
                ...utms
            };

            // Disparo imediato para Google Tag Manager / GA4 / Meta
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'generate_lead',
                form_id: 'form-wpp-lead-modal',
                form_location: 'whatsapp_modal',
                method: 'whatsapp_modal',
                unidade: unidade,
                programa: programa,
                lead_data: {
                    nome: nome,
                    unidade: unidade,
                    programa: programa,
                    origem: 'whatsapp_modal',
                    utm_source: payload.utm_source,
                    utm_campaign: payload.utm_campaign
                }
            });

            window.dataLayer.push({
                event: 'click_whatsapp',
                form_location: 'whatsapp_modal',
                method: 'whatsapp',
                unidade: unidade,
                programa: programa,
                unidade_clicada: unidade,
                programa_escolhido: programa
            });

            // Endpoints de Envio (Canal Duplo: REST API + Fallback AJAX Universal)
            const restUrl = window.wpApiSettings ? wpApiSettings.root + 'atapremium/v1/lead' : '/wp-json/atapremium/v1/lead';
            const ajaxUrl = window.wpApiSettings && wpApiSettings.ajax_url ? wpApiSettings.ajax_url : '/wp-admin/admin-ajax.php?action=atapremium_lead';

            // URL Padrão de Fallback imediata caso a rede falhe
            let redirectUrl = `https://wa.me/5548999313558?text=${encodeURIComponent(
                `Olá! Meu nome é ${nome}. Gostaria de agendar uma aula experimental na Unidade ${unidade} (${programa}).`
            )}`;

            let saved = false;

            try {
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 6000); // 6s de limite seguro

                const response = await fetch(restUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload),
                    signal: controller.signal
                });
                clearTimeout(timeoutId);

                if (response.ok) {
                    const result = await response.json();
                    if (result && result.success) {
                        saved = true;
                        if (result.redirect_url) {
                            redirectUrl = result.redirect_url;
                        }
                    }
                }
            } catch (err) {
                console.warn('REST lead falhou ou timed out, tentando fallback AJAX...', err);
            }

            // Fallback imediato via admin-ajax caso o REST não confirme
            if (!saved) {
                try {
                    const ajaxRes = await fetch(ajaxUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    if (ajaxRes.ok) {
                        const ajaxResult = await ajaxRes.json();
                        if (ajaxResult && ajaxResult.redirect_url) {
                            redirectUrl = ajaxResult.redirect_url;
                        }
                        saved = true;
                    }
                } catch (ajaxErr) {
                    console.warn('Fallback AJAX erro:', ajaxErr);
                }
            }

            if (feedbackBox) {
                feedbackBox.className = 'wpp-modal-feedback success';
                feedbackBox.innerText = '✓ Tudo pronto! Abrindo WhatsApp...';
            }

            setTimeout(() => {
                window.open(redirectUrl, '_blank');
                closeWppModal();
                formWpp.reset();
                if (btnSubmit) {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = originalBtnContent;
                }
                if (feedbackBox) {
                    feedbackBox.className = 'wpp-modal-feedback';
                    feedbackBox.innerText = '';
                }
            }, 500);
        });
    };

    initWhatsAppModal();
});

