/**
 * Uprise Travel — Animation Engine
 * Scroll reveal + hero entrance + shimmer micro-interactions
 */

/* ------------------------------------------------------------------
   1. SCROLL REVEAL — Intersection Observer
   Elements: [data-reveal], optional [data-reveal-delay="ms"]
   ------------------------------------------------------------------ */
function initScrollReveal() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const delay = parseInt(entry.target.dataset.revealDelay || 0, 10);
                setTimeout(() => {
                    entry.target.classList.add('is-visible');
                }, delay);
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -48px 0px' }
    );

    document.querySelectorAll('[data-reveal]').forEach((el) => observer.observe(el));
}

/* ------------------------------------------------------------------
   2. STAGGERED CHILDREN — auto-delay children of [data-stagger]
   Usage: <div data-stagger data-stagger-delay="80"> ... children ...
   ------------------------------------------------------------------ */
function initStagger() {
    document.querySelectorAll('[data-stagger]').forEach((parent) => {
        const step = parseInt(parent.dataset.staggerDelay || 80, 10);
        Array.from(parent.children).forEach((child, i) => {
            if (!child.hasAttribute('data-reveal')) {
                child.setAttribute('data-reveal', 'fade-up');
            }
            child.dataset.revealDelay = i * step;
        });
    });
}

/* ------------------------------------------------------------------
   3. HERO PANEL ENTRANCE — staggered on page load
   Targets: .hero-panel-enter elements
   ------------------------------------------------------------------ */
function initHeroEntrance() {
    document.querySelectorAll('.hero-panel-enter').forEach((panel, i) => {
        panel.style.animationDelay = `${i * 120}ms`;
    });
}

/* ------------------------------------------------------------------
   4. ACTIVE NAV LINK HIGHLIGHT
   ------------------------------------------------------------------ */
function initActiveNav() {
    const current = window.location.pathname;
    document.querySelectorAll('nav a[href]').forEach((link) => {
        const href = link.getAttribute('href');
        if (href && href !== '/' && current.startsWith(href)) {
            link.classList.add('nav-active');
        }
    });
}

/* ------------------------------------------------------------------
   5. SMOOTH SCROLL for anchor links
   ------------------------------------------------------------------ */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
}

/* ------------------------------------------------------------------
   BOOT
   ------------------------------------------------------------------ */
document.addEventListener('DOMContentLoaded', () => {
    initStagger();      // must run before initScrollReveal
    initScrollReveal();
    initHeroEntrance();
    initActiveNav();
    initSmoothScroll();
});
