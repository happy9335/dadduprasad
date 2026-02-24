document.addEventListener('DOMContentLoaded', () => {

    // 1. Mobile Menu Toggle
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            mainNav.classList.toggle('active');
        });
    }

    // Close mobile menu when a link is clicked
    const navLinksList = document.querySelectorAll('.nav-link');
    navLinksList.forEach(link => {
        link.addEventListener('click', () => {
            if (mainNav.classList.contains('active')) {
                mainNav.classList.remove('active');
            }
        });
    });

    // 2. Language Toggle
    const langToggleBtn = document.getElementById('langToggle');
    let currentLang = 'hi'; // Default language

    if (langToggleBtn) {
        langToggleBtn.addEventListener('click', () => {
            currentLang = currentLang === 'hi' ? 'en' : 'hi';

            // Update button text
            langToggleBtn.innerHTML = currentLang === 'hi' ? '<span class="lang-text">A/अ</span> English' : '<span class="lang-text">A/अ</span> हिंदी';

            // Update all elements with data-hi and data-en attributes
            const langElements = document.querySelectorAll('[data-hi][data-en]');
            langElements.forEach(el => {
                if (el.tagName.toLowerCase() === 'input' || el.tagName.toLowerCase() === 'textarea') {
                    if (el.hasAttribute('placeholder')) {
                        el.setAttribute('placeholder', el.getAttribute(`data-${currentLang}`));
                    }
                } else {
                    el.innerHTML = el.getAttribute(`data-${currentLang}`);
                }
            });

            // Update title
            const titleEl = document.querySelector('title');
            if (titleEl && titleEl.hasAttribute(`data-${currentLang}`)) {
                document.title = titleEl.getAttribute(`data-${currentLang}`);
            }
        });
    }

    // 3. Gallery Filtering
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.classList.contains(`filter-${filterValue}`)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });

    // 4. Contact Form Submission (AJAX)
    const contactForm = document.getElementById('contactForm');
    const formResponse = document.getElementById('formResponse');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ...';
            submitBtn.disabled = true;

            const formData = new FormData(this);

            fetch(this.getAttribute('action'), {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    formResponse.textContent = data.message;
                    formResponse.className = 'form-response mt-2';

                    if (data.status === 'success') {
                        formResponse.classList.add('success');
                        contactForm.reset();
                    } else {
                        formResponse.classList.add('error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    formResponse.textContent = 'An error occurred. Please try again later.';
                    formResponse.className = 'form-response mt-2 error';
                })
                .finally(() => {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;

                    // Hide response after 5 seconds
                    setTimeout(() => {
                        formResponse.className = 'form-response mt-2';
                        formResponse.textContent = '';
                    }, 5000);
                });
        });
    }

    // 5. Active link update on scroll
    const sections = document.querySelectorAll('section, footer');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });

        // Add sticky class to header if scrolled
        const header = document.querySelector('.main-header');
        if (window.scrollY > 50) {
            header.classList.remove('transparent-header');
            header.style.background = '#fff';
            header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.2)';
        } else {
            // Restore transparency if it's the home page
            if (window.location.pathname.endsWith('/') || window.location.pathname.endsWith('index.php')) {
                header.classList.add('transparent-header');
                header.style.background = 'transparent';
                header.style.boxShadow = 'none';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }
        }
    });

    // Initialize Hero Swiper
    if (typeof Swiper !== 'undefined') {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

});
