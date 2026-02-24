// ─────────────────────────────────────────────────────────────────
//  DADDOO PRASAD — main.js  (clean rewrite, no conflicts)
// ─────────────────────────────────────────────────────────────────

(function () {
    'use strict';

    // Wait until everything is loaded (including CDN scripts in footer)
    window.addEventListener('load', function () {

        /* ══════════════════════════════════════
           1.  HERO SWIPER
           Uses class .heroSwiper set in index.php
           ══════════════════════════════════════ */
        var heroEl = document.querySelector('.heroSwiper');
        if (heroEl && typeof Swiper !== 'undefined') {
            // Force height via JS before init — bulletproof against CSS conflicts
            var h = Math.max(Math.round(window.innerHeight * 0.88), 540);
            heroEl.style.height = h + 'px';
            heroEl.style.minHeight = '540px';
            heroEl.style.display = 'block';
            heroEl.style.overflow = 'hidden';

            // Force all swiper-slides to same height
            heroEl.querySelectorAll('.swiper-slide').forEach(function (sl) {
                sl.style.height = h + 'px';
            });

            new Swiper('.heroSwiper', {
                loop: true,
                speed: 900,
                autoHeight: false,
                autoplay: {
                    delay: 5500,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.heroSwiper .swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.heroSwiper .swiper-button-next',
                    prevEl: '.heroSwiper .swiper-button-prev'
                },
                on: {
                    init: function () {
                        // Re-apply height after init (Swiper sometimes resets)
                        this.el.style.height = h + 'px';
                        this.wrapperEl.style.height = h + 'px';
                    }
                }
            });
        }

        /* ══════════════════════════════════════
           2.  MOBILE HAMBURGER MENU
           ══════════════════════════════════════ */
        var navBtn = document.getElementById('navToggle');
        var navList = document.getElementById('mainNavList');
        if (navBtn && navList) {
            navBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                navList.classList.toggle('open');
                var icon = navBtn.querySelector('i');
                if (icon) icon.className = navList.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
            });
            document.addEventListener('click', function (e) {
                if (!navBtn.contains(e.target) && !navList.contains(e.target)) {
                    navList.classList.remove('open');
                    var icon = navBtn.querySelector('i');
                    if (icon) icon.className = 'fas fa-bars';
                }
            });
        }

        /* ══════════════════════════════════════
           3.  LANGUAGE TOGGLE (Hi / En)
           ══════════════════════════════════════ */
        var langBtn = document.getElementById('langToggle');
        var lang = 'hi';
        if (langBtn) {
            langBtn.addEventListener('click', function () {
                lang = lang === 'hi' ? 'en' : 'hi';
                langBtn.innerHTML = lang === 'hi'
                    ? '<i class="fas fa-language me-1"></i>EN'
                    : '<i class="fas fa-language me-1"></i>हि';

                document.querySelectorAll('[data-hi][data-en]').forEach(function (el) {
                    var val = el.getAttribute('data-' + lang);
                    if (!val) return;
                    if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                        el.setAttribute('placeholder', val);
                    } else {
                        el.textContent = val;
                    }
                });
            });
        }

        /* ══════════════════════════════════════
           4.  SCROLL FADE-IN ANIMATIONS
           ══════════════════════════════════════ */
        if ('IntersectionObserver' in window) {
            var targets = document.querySelectorAll(
                '.ss-ach-card, .ss-tl-card, .ss-press-item, .ss-news-item'
            );
            targets.forEach(function (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateY(24px)';
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            var obs = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            targets.forEach(function (el) { obs.observe(el); });
        }

        /* ══════════════════════════════════════
           5.  STICKY HEADER SHADOW
           ══════════════════════════════════════ */
        var header = document.querySelector('.ss-header');
        if (header) {
            window.addEventListener('scroll', function () {
                header.style.boxShadow = window.scrollY > 10
                    ? '0 4px 16px rgba(0,0,0,0.12)'
                    : '0 2px 8px rgba(0,0,0,0.07)';
            }, { passive: true });
        }

        /* ══════════════════════════════════════
           6.  CONTACT FORM AJAX
           ══════════════════════════════════════ */
        var form = document.getElementById('contactForm');
        var response = document.getElementById('formResponse');
        if (form && response) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                var btn = form.querySelector('button[type=submit]');
                var orig = btn ? btn.textContent : '';
                if (btn) { btn.disabled = true; btn.textContent = 'भेज रहे हैं...'; }

                fetch('process_contact.php', {
                    method: 'POST',
                    body: new FormData(form)
                })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        response.className = 'form-response ' + (data.success ? 'success' : 'error');
                        response.textContent = data.message || (data.success ? 'संदेश भेजा गया!' : 'कुछ गलत हुआ।');
                        if (data.success) form.reset();
                    })
                    .catch(function () {
                        response.className = 'form-response error';
                        response.textContent = 'नेटवर्क त्रुटि। कृपया पुनः प्रयास करें।';
                    })
                    .finally(function () {
                        if (btn) { btn.disabled = false; btn.textContent = orig; }
                    });
            });
        }

        /* ══════════════════════════════════════
           7.  GALLERY FILTER (gallery.php)
           ══════════════════════════════════════ */
        document.querySelectorAll('.filter-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-btn').forEach(function (b) {
                    b.classList.remove('active');
                });
                btn.classList.add('active');
                var cat = btn.getAttribute('data-cat');
                document.querySelectorAll('.gallery-item').forEach(function (item) {
                    if (cat === 'all' || item.getAttribute('data-cat') === cat) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

    }); // end window.load

})();
