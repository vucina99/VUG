/* VUG — studio agency animations */
(function () {
    'use strict';

    const isCoarse = window.matchMedia('(hover: none)').matches || window.innerWidth < 992;
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ===== NAV scroll state + back to top =====
    const nav = document.getElementById('nav');
    const toTop = document.querySelector('.to-top');
    const onScroll = () => {
        if (nav) nav.classList.toggle('is-scrolled', window.scrollY > 20);
        if (toTop) toTop.classList.toggle('is-visible', window.scrollY > 700);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // ===== Mobile menu =====
    const navToggle = document.getElementById('navToggle');
    const navMobile = document.getElementById('navMobile');
    if (navToggle && navMobile && nav) {
        const closeMenu = () => {
            navToggle.classList.remove('is-open');
            navMobile.classList.remove('is-open');
            nav.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
            navMobile.setAttribute('aria-hidden', 'true');
        };
        navToggle.addEventListener('click', () => {
            const isOpen = navToggle.classList.toggle('is-open');
            navMobile.classList.toggle('is-open', isOpen);
            nav.classList.toggle('is-open', isOpen);
            navToggle.setAttribute('aria-expanded', String(isOpen));
            navMobile.setAttribute('aria-hidden', String(!isOpen));
        });
        navMobile.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));
    }

    // ===== Reveal on scroll =====
    if ('IntersectionObserver' in window) {
        const revealIO = new IntersectionObserver((entries) => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    en.target.classList.add('in-view');
                    revealIO.unobserve(en.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.reveal, .stagger').forEach(el => revealIO.observe(el));

        // Split text — animate when in view (kasnije pokrene)
        const splitIO = new IntersectionObserver((entries) => {
            entries.forEach(en => {
                if (en.isIntersecting) {
                    en.target.classList.add('is-in');
                    splitIO.unobserve(en.target);
                }
            });
        }, { threshold: 0.1 });
        // Hero split vec ima is-in u markup-u za odmah-pri-load animaciju
        document.querySelectorAll('.split:not(.is-in)').forEach(el => splitIO.observe(el));
    } else {
        document.querySelectorAll('.reveal, .stagger').forEach(el => el.classList.add('in-view'));
        document.querySelectorAll('.split').forEach(el => el.classList.add('is-in'));
    }

    // ===== Counter animation =====
    const counters = document.querySelectorAll('.counter');
    if (counters.length && 'IntersectionObserver' in window) {
        const animate = (el) => {
            const target = parseInt(el.dataset.target, 10) || 0;
            const suffix = el.dataset.suffix || '';
            const duration = 1800;
            const start = performance.now();
            const tick = (now) => {
                const p = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - p, 4);
                el.textContent = Math.floor(target * eased) + suffix;
                if (p < 1) requestAnimationFrame(tick);
                else el.textContent = target + suffix;
            };
            requestAnimationFrame(tick);
        };
        const cIO = new IntersectionObserver((entries) => {
            entries.forEach(en => {
                if (en.isIntersecting) { animate(en.target); cIO.unobserve(en.target); }
            });
        }, { threshold: 0.4 });
        counters.forEach(c => cIO.observe(c));
    }

    // ===== Smooth scroll =====
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', (e) => {
            const href = a.getAttribute('href');
            if (href.length > 1) {
                const tgt = document.querySelector(href);
                if (tgt) {
                    e.preventDefault();
                    tgt.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    // ===== Active section in nav =====
    const sections = document.querySelectorAll('section[id], header[id]');
    const navLinks = document.querySelectorAll('.nav-link, .nav-mobile a');
    if (sections.length && navLinks.length && 'IntersectionObserver' in window) {
        const setActive = (id) => {
            navLinks.forEach(l => l.classList.toggle('active', l.getAttribute('href') === '#' + id));
        };
        const sIO = new IntersectionObserver((entries) => {
            entries.forEach(en => { if (en.isIntersecting) setActive(en.target.id); });
        }, { rootMargin: '-40% 0px -55% 0px' });
        sections.forEach(s => sIO.observe(s));
    }

    // ===== Custom cursor (desktop only) =====
    if (!isCoarse && !reduced) {
        const cursor = document.getElementById('cursor');
        const ring = document.getElementById('cursorRing');
        if (cursor && ring) {
            let mx = window.innerWidth / 2, my = window.innerHeight / 2;
            let rx = mx, ry = my;
            window.addEventListener('mousemove', (e) => {
                mx = e.clientX; my = e.clientY;
                cursor.style.left = mx + 'px';
                cursor.style.top = my + 'px';
            });
            // Ring sa lerp pratnjom (smoothing)
            const tick = () => {
                rx += (mx - rx) * 0.18;
                ry += (my - ry) * 0.18;
                ring.style.left = rx + 'px';
                ring.style.top = ry + 'px';
                requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);

            // Hover-stanje za interaktivne elemente
            const hoverables = 'a, button, .svc, .t-card, .faq-summary, .feat, .ref, [data-cursor="hover"]';
            document.querySelectorAll(hoverables).forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursor.classList.add('is-hover');
                    ring.classList.add('is-hover');
                });
                el.addEventListener('mouseleave', () => {
                    cursor.classList.remove('is-hover');
                    ring.classList.remove('is-hover');
                });
            });

            // Sakrij kad mis izadje iz prozora
            document.addEventListener('mouseleave', () => {
                cursor.style.opacity = '0';
                ring.style.opacity = '0';
            });
            document.addEventListener('mouseenter', () => {
                cursor.style.opacity = '1';
                ring.style.opacity = '1';
            });
        }
    }

    // ===== Magnetic buttons =====
    if (!isCoarse && !reduced) {
        document.querySelectorAll('.is-magnetic').forEach(btn => {
            const strength = 0.35;
            btn.addEventListener('mousemove', (e) => {
                const r = btn.getBoundingClientRect();
                const x = (e.clientX - (r.left + r.width / 2)) * strength;
                const y = (e.clientY - (r.top + r.height / 2)) * strength;
                btn.style.transform = `translate(${x}px, ${y}px)`;
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = '';
            });
        });
    }

    // ===== Hero glow follows mouse =====
    const heroGlow = document.getElementById('heroGlow');
    const hero = document.querySelector('.hero');
    if (heroGlow && hero && !reduced) {
        const updateGlow = (e) => {
            const r = hero.getBoundingClientRect();
            const x = (e.touches ? e.touches[0].clientX : e.clientX) - r.left;
            const y = (e.touches ? e.touches[0].clientY : e.clientY) - r.top;
            heroGlow.style.transform = `translate(${x - 250}px, ${y - 250}px)`;
        };
        hero.addEventListener('mousemove', updateGlow);
        // Inicijalno centrirano
        heroGlow.style.transform = `translate(${hero.offsetWidth / 2 - 250}px, ${hero.offsetHeight / 2 - 250}px)`;
    }

    // ===== Testimonials interactive slider (auto-scroll + drag + pause) =====
    const tMarquee = document.querySelector('.t-marquee');
    const tTrack = tMarquee ? tMarquee.querySelector('.t-marquee-track') : null;
    if (tMarquee && tTrack && !reduced) {
        const SPEED = 50;          // px / sec auto-scroll
        const RESUME_AFTER = 4500; // ms pauze posle korisnicke interakcije
        let paused = false;
        let resumeTimer = null;
        let isDragging = false;
        let dragStartX = 0;
        let scrollStart = 0;
        let dragMoved = false;
        let lastT = performance.now();

        const pauseScroll = () => {
            paused = true;
            clearTimeout(resumeTimer);
            resumeTimer = setTimeout(() => { paused = false; }, RESUME_AFTER);
        };

        const tick = (now) => {
            const dt = (now - lastT) / 1000;
            lastT = now;
            if (!paused && !isDragging && tTrack.scrollWidth > 0) {
                tMarquee.scrollLeft += SPEED * dt;
            }
            // Seamless loop — 2x renderovane kartice, vracamo se na pola kad predjemo
            const half = tTrack.scrollWidth / 2;
            if (half > 0 && tMarquee.scrollLeft >= half) {
                tMarquee.scrollLeft -= half;
            } else if (tMarquee.scrollLeft < 0) {
                tMarquee.scrollLeft += half;
            }
            requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);

        // Pauziraj na bilo koju interakciju
        tMarquee.addEventListener('touchstart', pauseScroll, { passive: true });
        tMarquee.addEventListener('wheel', pauseScroll, { passive: true });

        // Desktop drag-to-scroll
        tMarquee.addEventListener('mousedown', (e) => {
            isDragging = true;
            dragStartX = e.clientX;
            scrollStart = tMarquee.scrollLeft;
            dragMoved = false;
            tMarquee.classList.add('is-dragging');
            pauseScroll();
            e.preventDefault();
        });
        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const dx = e.clientX - dragStartX;
            if (Math.abs(dx) > 4) dragMoved = true;
            tMarquee.scrollLeft = scrollStart - dx;
        });
        const endDrag = () => {
            if (!isDragging) return;
            isDragging = false;
            tMarquee.classList.remove('is-dragging');
            // Posle drag-a ostani pauziran
            pauseScroll();
        };
        window.addEventListener('mouseup', endDrag);
        window.addEventListener('mouseleave', endDrag);

        // Klik na karticu (samo ako nije bilo drag-a) — pauziraj
        tMarquee.addEventListener('click', (e) => {
            if (dragMoved) {
                e.preventDefault();
                e.stopPropagation();
                dragMoved = false;
                return;
            }
            pauseScroll();
        }, true);
    }

    // ===== Service card spotlight (radial gradient prati mis) =====
    if (!isCoarse && !reduced) {
        document.querySelectorAll('.js-svc').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const r = card.getBoundingClientRect();
                const x = ((e.clientX - r.left) / r.width) * 100;
                const y = ((e.clientY - r.top) / r.height) * 100;
                card.style.setProperty('--mx', x + '%');
                card.style.setProperty('--my', y + '%');
            });
        });
    }

    // ===== Contact form validation =====
    const form = document.getElementById('contactForm');
    if (!form) return;

    const messagesNode = document.getElementById('formMessages');
    const messages = messagesNode ? JSON.parse(messagesNode.textContent) : {};
    const feedback = document.getElementById('formFeedback');
    const submitBtn = document.getElementById('submitBtn');

    // reCAPTCHA v3 — key i akcija dolaze iz data-atributa forme (index.php).
    // Ako key nije podešen, preskačemo (forma radi bez captche, npr. na lokalu).
    const recaptchaKey = form.dataset.recaptchaKey || '';
    const recaptchaAction = form.dataset.recaptchaAction || 'contact';

    // Vrati svež token ili '' ako captcha nije aktivna / grecaptcha nije stigla.
    const getRecaptchaToken = () => new Promise((resolve) => {
        if (!recaptchaKey || typeof grecaptcha === 'undefined' || !grecaptcha.execute) {
            resolve('');
            return;
        }
        grecaptcha.ready(() => {
            grecaptcha.execute(recaptchaKey, { action: recaptchaAction })
                .then(resolve)
                .catch(() => resolve(''));
        });
    });

    const fields = {
        name: form.querySelector('[name="name"]'),
        email: form.querySelector('[name="email"]'),
        subject: form.querySelector('[name="subject"]'),
        message: form.querySelector('[name="message"]')
    };
    const emailRe = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const MSG_MAX = 3000;

    const setError = (name, errKey) => {
        const input = fields[name];
        const row = input.closest('.form-row');
        const err = row.querySelector('.form-error');
        if (errKey) {
            row.classList.add('has-error');
            if (err) err.textContent = messages[errKey] || '';
        } else {
            row.classList.remove('has-error');
            if (err) err.textContent = '';
        }
    };

    const validateField = (name) => {
        const v = (fields[name].value || '').trim();
        if (name === 'name' && v.length < 2) { setError('name', 'err_name'); return false; }
        if (name === 'email' && (!emailRe.test(v) || v.length > 120)) { setError('email', 'err_email'); return false; }
        if (name === 'subject' && v.length < 3) { setError('subject', 'err_subject'); return false; }
        if (name === 'message') {
            if (fields.message.value.length > MSG_MAX) { setError('message', 'err_message_max'); return false; }
            if (v.length < 3) { setError('message', 'err_message'); return false; }
        }
        setError(name, null);
        return true;
    };

    Object.keys(fields).forEach(name => {
        fields[name].addEventListener('blur', () => validateField(name));
        fields[name].addEventListener('input', () => {
            if (fields[name].closest('.form-row').classList.contains('has-error')) validateField(name);
        });
    });

    // Živi brojač karaktera za poruku — pocrveni čim se pređe maksimum (bez čekanja na slanje)
    const msgCounter = form.querySelector('.form-counter[data-for="message"]');
    const updateMsgCounter = () => {
        if (!msgCounter) return;
        const len = fields.message.value.length;
        msgCounter.textContent = len + ' / ' + MSG_MAX;
        msgCounter.classList.toggle('over', len > MSG_MAX);
        if (len > MSG_MAX || fields.message.closest('.form-row').classList.contains('has-error')) {
            validateField('message');
        }
    };
    if (msgCounter) {
        fields.message.addEventListener('input', updateMsgCounter);
        updateMsgCounter();
    }

    const showFeedback = (kind, text) => {
        feedback.className = 'form-feedback ' + kind;
        feedback.textContent = text;
        if (kind === 'success') feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        feedback.className = 'form-feedback';
        feedback.textContent = '';

        if (form.elements['website'] && form.elements['website'].value) {
            showFeedback('success', messages.success);
            form.reset();
            return;
        }

        const results = Object.keys(fields).map(validateField);
        if (results.some(r => !r)) {
            const firstErr = form.querySelector('.has-error input, .has-error textarea');
            if (firstErr) firstErr.focus();
            return;
        }

        submitBtn.classList.add('btn--loading');
        submitBtn.disabled = true;

        try {
            const fd = new FormData(form);
            const token = await getRecaptchaToken();
            if (token) fd.append('recaptcha_token', token);
            const resp = await fetch(form.action, {
                method: 'POST', body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            let data;
            try { data = await resp.json(); } catch (_) { data = null; }

            if (resp.ok && data && data.ok) {
                showFeedback('success', data.message || messages.success);
                form.reset();
                Object.keys(fields).forEach(n => setError(n, null));
                updateMsgCounter();
            } else if (data && data.errors) {
                Object.entries(data.errors).forEach(([name, errKey]) => {
                    if (fields[name]) setError(name, errKey);
                });
                showFeedback('error', data.message || messages.error);
            } else {
                showFeedback('error', (data && data.message) || messages.error);
            }
        } catch (err) {
            showFeedback('error', messages.error);
        } finally {
            submitBtn.classList.remove('btn--loading');
            submitBtn.disabled = false;
        }
    });
})();