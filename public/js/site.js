document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.primary-navigation');

    if (toggle && nav) {
        const setNavOpen = (open) => {
            nav.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute('aria-label', open ? 'Close navigation' : 'Open navigation');
        };

        toggle.addEventListener('click', () => setNavOpen(!nav.classList.contains('is-open')));
        nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setNavOpen(false)));
        window.addEventListener('resize', () => {
            if (window.matchMedia('(min-width: 851px)').matches) {
                setNavOpen(false);
            }
        });
    }

    const revealItems = document.querySelectorAll('.reveal-on-scroll');
    if ('IntersectionObserver' in window && revealItems.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12 }
        );
        revealItems.forEach((item) => observer.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    const heroSlider = document.querySelector('[data-hero-slider]');
    let pauseHeroSlider = () => {};
    let resumeHeroSlider = () => {};

    if (heroSlider) {
        const slides = Array.from(heroSlider.querySelectorAll('.hero-slide'));
        const dotsWrap = heroSlider.querySelector('.hero-slider-dots');
        let index = 0;
        let timerId = null;
        let paused = false;

        if (slides.length > 1) {
            const showSlide = (nextIndex) => {
                slides[index].classList.remove('is-active');
                if (dotsWrap) {
                    const dots = dotsWrap.querySelectorAll('.hero-slider-dot');
                    dots[index]?.classList.remove('is-active');
                    dots[nextIndex]?.classList.add('is-active');
                }
                index = nextIndex;
                slides[index].classList.add('is-active');
                scheduleNext();
            };

            const scheduleNext = () => {
                window.clearTimeout(timerId);
                if (paused) {
                    return;
                }
                const duration = Number(slides[index].dataset.duration || 5000);
                timerId = window.setTimeout(() => {
                    showSlide((index + 1) % slides.length);
                }, duration);
            };

            pauseHeroSlider = () => {
                paused = true;
                window.clearTimeout(timerId);
            };

            resumeHeroSlider = () => {
                paused = false;
                scheduleNext();
            };

            if (dotsWrap) {
                slides.forEach((slide, slideIndex) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'hero-slider-dot' + (slideIndex === 0 ? ' is-active' : '');
                    button.setAttribute('aria-label', `Go to slide ${slideIndex + 1}`);
                    button.addEventListener('click', () => showSlide(slideIndex));
                    dotsWrap.appendChild(button);
                });
            }

            scheduleNext();
        }
    }

    const eventModal = document.querySelector('[data-event-enquiry-modal]');
    if (eventModal) {
        const titleEl = eventModal.querySelector('[data-event-modal-title]');
        const metaEl = eventModal.querySelector('[data-event-modal-meta]');
        const descriptionEl = eventModal.querySelector('[data-event-modal-description]');
        const idInput = eventModal.querySelector('[data-event-modal-id]');

        const fillEventModal = (source) => {
            const root = source.closest('[data-event-id]') || source;
            if (!root?.dataset?.eventId || !idInput) {
                return false;
            }

            idInput.value = root.dataset.eventId;
            if (titleEl) {
                titleEl.textContent = root.dataset.eventTitle || 'Event enquiry';
            }
            if (metaEl) {
                metaEl.textContent = root.dataset.eventMeta || '';
                metaEl.hidden = !root.dataset.eventMeta;
            }
            if (descriptionEl) {
                descriptionEl.textContent = root.dataset.eventDescription || '';
                descriptionEl.hidden = !root.dataset.eventDescription;
            }

            return true;
        };

        const openEventModal = (source) => {
            if (!fillEventModal(source)) {
                return;
            }

            eventModal.hidden = false;
            eventModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('event-modal-open');
            pauseHeroSlider();
            eventModal.querySelector('input[name="name"]')?.focus();
        };

        const closeEventModal = () => {
            eventModal.hidden = true;
            eventModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('event-modal-open');
            resumeHeroSlider();
        };

        document.querySelectorAll('[data-event-open]').forEach((trigger) => {
            trigger.addEventListener('click', (event) => {
                event.preventDefault();
                openEventModal(trigger);
            });
        });

        eventModal.querySelectorAll('[data-event-modal-close]').forEach((closer) => {
            closer.addEventListener('click', closeEventModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !eventModal.hidden) {
                closeEventModal();
            }
        });

        const oldEventId = idInput?.value || eventModal.dataset.oldEventId;
        if (oldEventId) {
            const source = document.querySelector(`[data-event-id="${oldEventId}"]`);
            if (source) {
                openEventModal(source);
            }
        }
    }

    document.querySelectorAll('[data-topic-select]').forEach((select) => {
        const form = select.closest('form');
        if (!form) {
            return;
        }

        const fieldsWrap = form.querySelector('[data-book-order-fields]');
        if (!fieldsWrap) {
            return;
        }

        const syncBookOrderFields = () => {
            const isBookOrder = select.value === 'Book Order';
            fieldsWrap.hidden = !isBookOrder;
            fieldsWrap.querySelectorAll('[data-book-order-input]').forEach((input) => {
                input.required = isBookOrder;
                if (!isBookOrder) {
                    input.value = '';
                }
            });
        };

        select.addEventListener('change', syncBookOrderFields);
        syncBookOrderFields();
    });
});
