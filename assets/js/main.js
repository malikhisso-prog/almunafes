document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Mobile navigation
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = mainNav.classList.toggle('open');

            mainNav.classList.toggle('active', isOpen);
            menuToggle.classList.toggle('active', isOpen);
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        });

        mainNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('open', 'active');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // Header scroll effect
    const header = document.querySelector('.site-header');

    if (header) {
        const updateHeader = () => {
            header.classList.toggle('scrolled', window.scrollY > 40);
        };

        updateHeader();
        window.addEventListener('scroll', updateHeader, { passive: true });
    }

    // Product image gallery
    const mainProductImage = document.querySelector('.product-main-image');
    const galleryButtons = document.querySelectorAll('.product-gallery-thumb');

    if (mainProductImage && galleryButtons.length) {
        galleryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const imageUrl = button.dataset.image;

                if (!imageUrl) return;

                mainProductImage.src = imageUrl;

                galleryButtons.forEach(item => {
                    item.classList.remove('active');
                });

                button.classList.add('active');
            });
        });
    }

    // Image fallback (صورة بديلة مدمجة تعمل بدون إنترنت)
    const fallbackGymImage = "data:image/svg+xml;utf8,<svg xmlns='http://w3.org' width='900' height='600' viewBox='0 0 900 600'><rect width='900' height='600' fill='%231F1D19'/><circle cx='450' cy='270' r='60' fill='none' stroke='%23F2A900' stroke-width='8'/><rect x='270' y='262' width='360' height='16' rx='8' fill='%23F2A900'/><rect x='250' y='220' width='26' height='100' rx='6' fill='%23F2A900'/><rect x='624' y='220' width='26' height='100' rx='6' fill='%23F2A900'/><text x='450' y='390' fill='%23FFFFFF' font-family='sans-serif' font-size='28' font-weight='bold' text-anchor='middle'>ALMUNAFES FITNESS</text></svg>";

    document.querySelectorAll('img').forEach(image => {
        image.addEventListener('error', () => {
            if (image.dataset.fallbackApplied) return;

            image.dataset.fallbackApplied = 'true';
            image.src = fallbackGymImage;
        });
    });

    // Form validation
    document.querySelectorAll('form[data-validate]').forEach(form => {
        form.addEventListener('submit', event => {
            let valid = true;

            form.querySelectorAll('[required]').forEach(field => {
                const value = field.value?.trim() ?? '';

                if (!value) {
                    valid = false;
                    field.classList.add('field-error');
                } else {
                    field.classList.remove('field-error');
                }

                if (field.type === 'email' && value) {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!emailPattern.test(value)) {
                        valid = false;
                        field.classList.add('field-error');
                    }
                }
            });

            if (!valid) {
                event.preventDefault();

                const firstError = form.querySelector('.field-error');

                if (firstError) {
                    firstError.focus();
                }
            }
        });
    });

    // Remove field error while typing
    document.querySelectorAll('input, textarea, select').forEach(field => {
        field.addEventListener('input', () => {
            field.classList.remove('field-error');
        });

        field.addEventListener('change', () => {
            field.classList.remove('field-error');
        });
    });

    // FAQ accordion
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const item = question.closest('.faq-item');

            if (!item) return;

            const isOpen = item.classList.toggle('active');

            question.setAttribute('aria-expanded', String(isOpen));
        });
    });

    // Current year
    document.querySelectorAll('[data-current-year]').forEach(element => {
        element.textContent = new Date().getFullYear();
    });
});
