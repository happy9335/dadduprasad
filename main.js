document.addEventListener('DOMContentLoaded', () => {

    // ── 1. Language Toggle ──
    const langToggleBtn = document.getElementById('langToggle');
    let currentLang = 'hi';

    if (langToggleBtn) {
        langToggleBtn.addEventListener('click', () => {
            currentLang = currentLang === 'hi' ? 'en' : 'hi';
            langToggleBtn.innerHTML = currentLang === 'hi'
                ? '<span class="lang-text">A/अ</span> English'
                : '<span class="lang-text">A/अ</span> हिंदी';

            document.querySelectorAll('[data-hi][data-en]').forEach(el => {
                const val = el.getAttribute('data-' + currentLang);
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                    if (el.hasAttribute('placeholder')) el.setAttribute('placeholder', val);
                } else {
                    el.textContent = val;
                }
            });

            const titleEl = document.querySelector('title');
            if (titleEl && titleEl.hasAttribute('data-' + currentLang)) {
                document.title = titleEl.getAttribute('data-' + currentLang);
            }
        });
    }

    // ── 2. Hero Swiper ──
    if (typeof Swiper !== 'undefined') {
        const heroEl = document.querySelector('.ss-swiper');
        if (heroEl) {
            new Swiper('.ss-swiper', {
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 5500,
                    disableOnInteraction: false,
                },
                effect: 'fade',
                fadeEffect: { crossFade: true },
                pagination: {
                    el: '.ss-dots',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.ss-next',
                    prevEl: '.ss-prev',
                },
            });
        }

        // Legacy / fallback for old heroSwiper class
        if (document.querySelector('.heroSwiper')) {
            new Swiper('.heroSwiper', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            });
        }

        // Generic dpswiper
        if (document.querySelector('.dpswiper')) {
            new Swiper('.dpswiper', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: '.dp-pagination', clickable: true },
                navigation: { nextEl: '.dp-arrow-next', prevEl: '.dp-arrow-prev' },
            });
        }
    }

    // ── 3. Gallery Filter ──
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const val = btn.getAttribute('data-filter');
            galleryItems.forEach(item => {
                item.classList.toggle('hidden', !(val === 'all' || item.classList.contains('filter-' + val)));
            });
        });
    });

    // ── 4. Contact Form AJAX ──
    const contactForm = document.getElementById('contactForm');
    const formResponse = document.getElementById('formResponse');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = contactForm.querySelector('button[type="submit"]');
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
            btn.disabled = true;
            fetch(this.getAttribute('action'), { method: 'POST', body: new FormData(this) })
                .then(r => r.json())
                .then(data => {
                    formResponse.textContent = data.message;
                    formResponse.className = 'form-response mt-2 ' + (data.status === 'success' ? 'success' : 'error');
                    if (data.status === 'success') contactForm.reset();
                })
                .catch(() => {
                    formResponse.textContent = 'त्रुटि हुई। कृपया पुनः प्रयास करें।';
                    formResponse.className = 'form-response mt-2 error';
                })
                .finally(() => {
                    btn.innerHTML = orig; btn.disabled = false;
                    setTimeout(() => { formResponse.className = 'form-response mt-2'; formResponse.textContent = ''; }, 5000);
                });
        });
    }

    // ── 5. Scroll-based nav shadow ──
    const siteNav = document.querySelector('.site-nav');
    if (siteNav) {
        window.addEventListener('scroll', () => {
            siteNav.style.boxShadow = window.scrollY > 50
                ? '0 4px 20px rgba(0,56,147,0.15)'
                : '0 2px 10px rgba(0,0,0,0.08)';
        }, { passive: true });
    }

    // ── 6. Smooth scroll for anchor links ──
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ── 7. Animation on scroll (fade-in) ──
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('anim-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.ss-tl-item, .ss-press-card, .ss-ach-card').forEach(el => {
        el.classList.add('anim-hidden');
        observer.observe(el);
    });
});
