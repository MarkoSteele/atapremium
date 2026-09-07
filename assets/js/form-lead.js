document.addEventListener('DOMContentLoaded', () => {
    // 1. Controle de Scroll no Header Flutuante
    const siteHeaderWrapper = document.querySelector('.site-header-wrapper');
    if (siteHeaderWrapper) {
        const handleScroll = () => {
            if (window.scrollY > 40) {
                siteHeaderWrapper.classList.add('header-scrolled');
            } else {
                siteHeaderWrapper.classList.remove('header-scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // 2. Mobile Menu Toggle
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileDrawer = document.querySelector('.mobile-nav-drawer');
    if (menuToggle && mobileDrawer) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            mobileDrawer.classList.toggle('active');
        });

        // Fecha ao clicar em um link do menu
        mobileDrawer.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileDrawer.classList.remove('active');
            });
        });

        // Fecha ao clicar fora
        document.addEventListener('click', (e) => {
            if (!mobileDrawer.contains(e.target) && !menuToggle.contains(e.target)) {
                mobileDrawer.classList.remove('active');
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

    // 4. Efeito Parallax Suave nas Logos d'Água (Jornada e FAQ) e no Background da Jornada
    const faqSection = document.querySelector('#faq');
    const faqLogo = document.querySelector('.faq-parallax-watermark');
    const journeySection = document.querySelector('#jornada');
    const journeyLogo = document.querySelector('.journey-parallax-watermark');
    const journeyBgImage = document.querySelector('.journey-bg-image');

    const handleParallaxScroll = () => {
        const windowHeight = window.innerHeight;

        // Parallax Logo na Seção Jornada
        if (journeySection && journeyLogo) {
            const rect = journeySection.getBoundingClientRect();
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 160;
                journeyLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
            }
        }

        // Parallax Foto Blur da Jornada
        if (journeySection && journeyBgImage) {
            const rect = journeySection.getBoundingClientRect();
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 60; // Deslocamento sutil com escala
                journeyBgImage.style.transform = `scale(1.08) translateY(${translateY.toFixed(1)}px)`;
            }
        }

        // Parallax FAQ Logo
        if (faqSection && faqLogo) {
            const rect = faqSection.getBoundingClientRect();
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const translateY = (scrollProgress - 0.5) * 160; // Deslocamento suave vertical
                faqLogo.style.transform = `translate(-50%, calc(-50% + ${translateY.toFixed(1)}px))`;
            }
        }
    };

    if (faqSection || journeySection) {
        window.addEventListener('scroll', handleParallaxScroll, { passive: true });
        window.addEventListener('resize', handleParallaxScroll, { passive: true });
        handleParallaxScroll();
    }

    // 5. Gerenciamento Avançado de Autoplay de Vídeos (Hero, Reels, Unidades)
    const initVideoAutoplay = () => {
        const videos = document.querySelectorAll('video');
        
        videos.forEach(video => {
            // Garante conformidade total com políticas de autoplay dos navegadores modernos (Chrome, Safari, iOS, Android)
            video.muted = true;
            video.defaultMuted = true;
            video.playsInline = true;
            video.setAttribute('playsinline', '');
            video.setAttribute('webkit-playsinline', '');
            video.setAttribute('muted', '');
            video.setAttribute('autoplay', '');
            video.setAttribute('loop', '');

            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(err => {
                    // Silencia mensagem caso o navegador exija interação prévia
                    console.log('Autoplay aguardando interação:', err.message);
                });
            }
        });

        // IntersectionObserver para reproduzir automaticamente vídeos ao entrarem na área visível
        if ('IntersectionObserver' in window) {
            const videoObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const video = entry.target;
                    const reelCard = video.closest('.reel-card');
                    if (entry.isIntersecting) {
                        video.muted = true;
                        video.play().then(() => {
                            if (reelCard) reelCard.classList.add('is-playing');
                        }).catch(() => {});
                    }
                });
            }, { threshold: 0.15 });

            videos.forEach(video => videoObserver.observe(video));
        }

        // Fallback global de desbloqueio no primeiro gesto do usuário
        const unlockAutoplay = () => {
            videos.forEach(video => {
                if (video.paused) {
                    video.muted = true;
                    video.play().catch(() => {});
                }
            });
            window.removeEventListener('click', unlockAutoplay);
            window.removeEventListener('touchstart', unlockAutoplay);
            window.removeEventListener('scroll', unlockAutoplay);
        };

        window.addEventListener('click', unlockAutoplay, { once: true, passive: true });
        window.addEventListener('touchstart', unlockAutoplay, { once: true, passive: true });
        window.addEventListener('scroll', unlockAutoplay, { once: true, passive: true });

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
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            });

            revealElements.forEach(el => revealObserver.observe(el));
        } else {
            // Fallback imediato caso o navegador não suporte IntersectionObserver
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
            // Regex para capturar prefixo (ex: "+"), valor numérico (ex: "1.5", "30", "100"), e sufixo (ex: " Milhão", "+ Anos", "%", " Unidades")
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
                    element.textContent = rawText; // Restaura a string exata original
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
                }, index * 120); // Delays escalonados entre os 4 cards
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

        // Exporta globalmente para acionar ao trocar de idioma
        window.triggerMetricsAnimation = () => {
            startCounting();
        };
    };

    initBigNumbersCounter();

    // 8. Timeline Interativa Dinâmica ao Scroll (#jornada)
    const initTimelineProgress = () => {
        const journeySection = document.querySelector('#jornada');
        const progressBar = document.querySelector('.timeline-progress-bar');
        const timelineItems = document.querySelectorAll('.timeline-item');

        if (!journeySection || !progressBar || !timelineItems.length) return;

        const updateTimeline = () => {
            const rect = journeySection.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Inicia quando o topo da seção entra em 70% da viewport e finaliza ao percorrer a seção
            const startThreshold = windowHeight * 0.70;
            const totalTravelDistance = rect.height;
            const currentTravel = startThreshold - rect.top;
            const progress = currentTravel / totalTravelDistance;
            const clampedProgress = Math.max(0, Math.min(1, progress));

            progressBar.style.height = `${clampedProgress * 100}%`;

            // Ativa individualmente cada marco da timeline conforme o scroll alcança sua posição
            timelineItems.forEach(item => {
                const itemRect = item.getBoundingClientRect();
                if (itemRect.top < windowHeight * 0.72) {
                    item.classList.add('is-active');
                } else {
                    item.classList.remove('is-active');
                }
            });
        };

        window.addEventListener('scroll', updateTimeline, { passive: true });
        window.addEventListener('resize', updateTimeline, { passive: true });
        updateTimeline();

        // Clique em um card para destaque suave
        timelineItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.add('is-active');
            });
        });
    };

    initTimelineProgress();
});
