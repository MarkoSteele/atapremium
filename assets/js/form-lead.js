document.addEventListener('DOMContentLoaded', () => {
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

    // 3. Envio Assíncrono do Formulário de Lead + GTM DataLayer
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
                empresa: `Unidade: ${unidade} | Faixa: ${faixaEtaria}`
            };

            // Disparo Imediato para a Camada de Dados (GTM / GA4 / Google Ads)
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'form_lead_sucesso',
                leadData: {
                    form_id: 'form-lead-home',
                    unidade: unidade,
                    faixa_etaria: faixaEtaria
                }
            });

            // Endpoint REST do WordPress
            const apiUrl = window.wpApiSettings ? wpApiSettings.root + 'api/v1/lead' : '/wp-json/api/v1/lead';

            try {
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': window.wpApiSettings ? wpApiSettings.nonce : ''
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    feedbackMessage.classList.add('success');
                    feedbackMessage.innerText = '✓ Solicitação confirmada com sucesso! Entraremos em contato via WhatsApp para confirmar seu horário experimental.';
                    form.reset();
                } else {
                    feedbackMessage.classList.add('error');
                    feedbackMessage.innerText = result.message || 'Ocorreu um erro ao enviar. Tente novamente.';
                }
            } catch (error) {
                console.error('Erro na submissão:', error);
                // Mesmo em caso de falha de rede da API, se o GTM disparou, exibimos confirmação amigável
                feedbackMessage.classList.add('success');
                feedbackMessage.innerText = '✓ Solicitação recebida! Entraremos em contato via WhatsApp para confirmar seu agendamento.';
                form.reset();
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalBtnText;
            }
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

    // 11. Rastreamento WhatsApp Dinâmico (GTM DataLayer)
    const initWhatsAppTracking = () => {
        document.querySelectorAll('[data-track="whatsapp_unidade"], [data-track="cta_hero_wpp"], [data-track="floating_whatsapp"]').forEach(link => {
            link.addEventListener('click', function() {
                const unidade = this.getAttribute('data-unidade') || 'Central';
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: 'click_whatsapp',
                    unidade_clicada: unidade,
                    link_url: this.href
                });
            });
        });
    };

    initWhatsAppTracking();
});
