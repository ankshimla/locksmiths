/**
 * Locksmiths.ie - Main JavaScript
 * Vanilla JS, no frameworks or dependencies required.
 */

(function () {
  'use strict';

  // ============================================================================
  // Utility helpers
  // ============================================================================

  /**
   * Shorthand querySelector
   * @param {string} selector
   * @param {Element} [context=document]
   * @returns {Element|null}
   */
  const $ = (selector, context = document) => context.querySelector(selector);

  /**
   * Shorthand querySelectorAll returning an array
   * @param {string} selector
   * @param {Element} [context=document]
   * @returns {Element[]}
   */
  const $$ = (selector, context = document) =>
    Array.from(context.querySelectorAll(selector));

  /**
   * Add an event listener with optional cleanup
   * @param {EventTarget} el
   * @param {string} event
   * @param {Function} handler
   * @param {object} [options]
   */
  const on = (el, event, handler, options) =>
    el && el.addEventListener(event, handler, options);

  // ============================================================================
  // 1. Mobile Menu Toggle
  // ============================================================================

  function initMobileMenu() {
    const toggle = $('.nav-toggle');
    const menu = $('.mobile-menu');
    const body = document.body;

    if (!toggle || !menu) return;

    function openMenu() {
      toggle.classList.add('is-open');
      menu.classList.add('is-open');
      body.style.overflow = 'hidden';
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', 'Close navigation');
    }

    function closeMenu() {
      toggle.classList.remove('is-open');
      menu.classList.remove('is-open');
      body.style.overflow = '';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Open navigation');
    }

    on(toggle, 'click', () => {
      const isOpen = toggle.classList.contains('is-open');
      isOpen ? closeMenu() : openMenu();
    });

    // Close on mobile menu link click
    $$('a', menu).forEach((link) => {
      on(link, 'click', closeMenu);
    });

    // Close on Escape key
    on(document, 'keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });

    // Set initial aria attributes
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Open navigation');
    toggle.setAttribute('aria-controls', 'mobile-menu');
  }

  // ============================================================================
  // 2. Sticky Header
  // ============================================================================

  function initStickyHeader() {
    const header = $('.site-header');
    if (!header) return;

    const SCROLL_THRESHOLD = 80;

    function onScroll() {
      if (window.scrollY > SCROLL_THRESHOLD) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }

    on(window, 'scroll', onScroll, { passive: true });
    // Run once on init in case page loads mid-scroll
    onScroll();
  }

  // ============================================================================
  // 3. Smooth Scroll for Anchor Links
  // ============================================================================

  function initSmoothScroll() {
    const headerHeight = parseInt(
      getComputedStyle(document.documentElement).getPropertyValue(
        '--header-height'
      ),
      10
    ) || 70;

    on(document, 'click', (e) => {
      const link = e.target.closest('a[href^="#"]');
      if (!link) return;

      const href = link.getAttribute('href');
      if (!href || href === '#') return;

      const target = document.getElementById(href.slice(1));
      if (!target) return;

      e.preventDefault();

      const targetTop =
        target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;

      window.scrollTo({ top: targetTop, behavior: 'smooth' });
    });
  }

  // ============================================================================
  // 4. FAQ Accordion
  // ============================================================================

  function initFAQAccordion() {
    const faqItems = $$('.faq-item');
    if (!faqItems.length) return;

    faqItems.forEach((item) => {
      const question = $('.faq-question', item);
      const answer = $('.faq-answer', item);
      if (!question || !answer) return;

      // Accessibility
      const answerId = 'faq-answer-' + Math.random().toString(36).slice(2, 7);
      answer.id = answerId;
      question.setAttribute('aria-expanded', 'false');
      question.setAttribute('aria-controls', answerId);

      on(question, 'click', () => {
        const isOpen = item.classList.contains('is-open');

        // Optional: close others (comment out for multi-open behaviour)
        faqItems.forEach((other) => {
          if (other !== item) {
            other.classList.remove('is-open');
            const otherQ = $('.faq-question', other);
            if (otherQ) otherQ.setAttribute('aria-expanded', 'false');
          }
        });

        item.classList.toggle('is-open', !isOpen);
        question.setAttribute('aria-expanded', String(!isOpen));
      });
    });
  }

  // ============================================================================
  // 5 & 6. Form AJAX Submission (shared logic)
  // ============================================================================

  /**
   * Generic form submission handler.
   * @param {HTMLFormElement} form
   * @param {string} endpoint  - API endpoint URL
   */
  function handleFormSubmit(form, endpoint) {
    const submitBtn = form.querySelector('[type="submit"]');
    const parent = form.parentElement;
    const successMsg = parent.querySelector('.form-success') || form.querySelector('.form-success');
    const errorMsg = parent.querySelector('.form-error') || form.querySelector('.form-error');

    on(form, 'submit', async (e) => {
      e.preventDefault();

      // Basic HTML5 validation
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }

      // Disable button and show loading state
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.dataset.originalText = submitBtn.textContent;
        submitBtn.textContent = 'Sending…';
      }

      // Hide previous messages
      if (successMsg) successMsg.classList.remove('show');
      if (errorMsg) errorMsg.classList.remove('show');

      try {
        const data = Object.fromEntries(new FormData(form).entries());

        const response = await fetch(endpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
          },
          body: JSON.stringify(data),
        });

        if (response.ok) {
          form.reset();
          if (successMsg) {
            successMsg.textContent =
              successMsg.dataset.message ||
              'Thank you! We will be in touch shortly.';
            successMsg.classList.add('show');
          }
        } else {
          const json = await response.json().catch(() => ({}));
          if (errorMsg) {
            errorMsg.textContent =
              json.message ||
              'Something went wrong. Please call us directly or try again.';
            errorMsg.classList.add('show');
          }
        }
      } catch (err) {
        console.error('Form submission error:', err);
        if (errorMsg) {
          errorMsg.textContent =
            'Network error. Please call us or try again later.';
          errorMsg.classList.add('show');
        }
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent =
            submitBtn.dataset.originalText || 'Submit';
        }
      }
    });
  }

  function initForms() {
    // Quote form (hero or standalone) - select the form inside the card
    const quoteFormCard = $('#quote-form');
    const quoteForm = quoteFormCard ? $('form', quoteFormCard) : null;
    if (quoteForm) handleFormSubmit(quoteForm, '/api/quote');

    // Contact form
    const contactForm = $('#contact-form');
    if (contactForm) handleFormSubmit(contactForm, '/api/contact');

    // Any other forms with data-endpoint attribute
    $$('form[data-endpoint]').forEach((form) => {
      if (form.id !== 'quote-form' && form.id !== 'contact-form') {
        handleFormSubmit(form, form.dataset.endpoint);
      }
    });
  }

  // ============================================================================
  // 7. Scroll Animations (IntersectionObserver)
  // ============================================================================

  function initScrollAnimations() {
    if (!('IntersectionObserver' in window)) {
      // Fallback: show everything immediately
      $$('.animate-on-scroll, .animate-fade').forEach((el) => {
        el.classList.add('animate-in');
        el.classList.add('is-visible');
      });
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target); // Animate once only
          }
        });
      },
      {
        threshold: 0.12,
        rootMargin: '0px 0px -50px 0px',
      }
    );

    $$('.animate-on-scroll, .animate-fade').forEach((el) =>
      observer.observe(el)
    );
  }

  // ============================================================================
  // 8. Star Rating Display
  // ============================================================================

  /**
   * Render star HTML for a numeric rating (0–5).
   * @param {number} rating
   * @param {number} [max=5]
   * @returns {string} HTML string of stars
   */
  function renderStars(rating, max = 5) {
    const full = Math.floor(rating);
    const half = rating % 1 >= 0.5 ? 1 : 0;
    const empty = max - full - half;

    const filled = '<span class="star-filled" aria-hidden="true">★</span>';
    const halfStar = '<span class="star-half" aria-hidden="true">½</span>';
    const emptyStar = '<span class="star-empty" aria-hidden="true">☆</span>';

    return (
      filled.repeat(full) +
      halfStar.repeat(half) +
      emptyStar.repeat(empty)
    );
  }

  function initStarRatings() {
    $$('[data-rating]').forEach((el) => {
      const rating = parseFloat(el.dataset.rating);
      if (isNaN(rating)) return;

      const max = parseInt(el.dataset.ratingMax, 10) || 5;
      el.innerHTML = renderStars(rating, max);
      el.setAttribute(
        'aria-label',
        `Rating: ${rating} out of ${max} stars`
      );
    });
  }

  // ============================================================================
  // 9. Lazy Loading Images
  // ============================================================================

  function initLazyImages() {
    const images = $$('img.lazy, img[loading="lazy"][data-src]');
    if (!images.length) return;

    if ('IntersectionObserver' in window) {
      const imgObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            const img = entry.target;
            const src = img.dataset.src || img.src;

            if (img.dataset.src) {
              img.src = img.dataset.src;
              img.removeAttribute('data-src');
            }

            if (img.dataset.srcset) {
              img.srcset = img.dataset.srcset;
              img.removeAttribute('data-srcset');
            }

            img.addEventListener('load', () => img.classList.add('loaded'));
            imgObserver.unobserve(img);
          });
        },
        { rootMargin: '200px 0px' }
      );

      images.forEach((img) => imgObserver.observe(img));
    } else {
      // Fallback for older browsers
      images.forEach((img) => {
        if (img.dataset.src) {
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
        }
        img.classList.add('loaded');
      });
    }
  }

  // ============================================================================
  // 10. Click-to-Call Tracking
  // ============================================================================

  function initClickToCallTracking() {
    $$('a[href^="tel:"]').forEach((link) => {
      on(link, 'click', () => {
        const number = link.href.replace('tel:', '');
        console.log('[Locksmiths.ie] Call initiated:', number);

        // Google Analytics / GTM event (if available)
        if (typeof gtag === 'function') {
          gtag('event', 'click_to_call', {
            event_category: 'engagement',
            event_label: number,
          });
        }

        // Facebook Pixel (if available)
        if (typeof fbq === 'function') {
          fbq('track', 'Contact');
        }
      });
    });
  }

  // ============================================================================
  // 11. WhatsApp Float Button
  // ============================================================================

  function initWhatsAppButton() {
    // Only create dynamically if not already present in markup
    if ($('.whatsapp-float')) return;

    const WHATSAPP_NUMBER = document.body.dataset.whatsappNumber || '353861234567';
    const WHATSAPP_MESSAGE = encodeURIComponent(
      'Hi, I need a locksmith. Can you help?'
    );

    const a = document.createElement('a');
    a.className = 'whatsapp-float';
    a.href = `https://wa.me/${WHATSAPP_NUMBER}?text=${WHATSAPP_MESSAGE}`;
    a.target = '_blank';
    a.rel = 'noopener noreferrer';
    a.setAttribute('aria-label', 'Chat on WhatsApp');
    a.innerHTML = '💬'; // Replace with SVG icon if available

    document.body.appendChild(a);
  }

  // ============================================================================
  // 12. Back to Top Button
  // ============================================================================

  function initBackToTop() {
    // Create button if not in markup
    let btn = $('.back-to-top');

    if (!btn) {
      btn = document.createElement('button');
      btn.className = 'back-to-top';
      btn.setAttribute('aria-label', 'Back to top');
      btn.innerHTML = '↑';
      document.body.appendChild(btn);
    }

    const SHOW_AFTER = 400;

    function onScroll() {
      if (window.scrollY > SHOW_AFTER) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    }

    on(window, 'scroll', onScroll, { passive: true });
    onScroll();

    on(btn, 'click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ============================================================================
  // Active nav link highlighting
  // ============================================================================

  function initActiveNav() {
    const currentPath = window.location.pathname;

    $$('.main-nav a, .mobile-menu nav a').forEach((link) => {
      const linkPath = link.getAttribute('href');
      if (!linkPath) return;

      // Exact match, or starts-with match for sub-paths
      if (
        linkPath === currentPath ||
        (linkPath !== '/' && currentPath.startsWith(linkPath))
      ) {
        link.classList.add('active');
        link.setAttribute('aria-current', 'page');
      }
    });
  }

  // ============================================================================
  // Sticky CTA bar padding
  // ============================================================================

  function initStickyCTABar() {
    const bar = $('.sticky-cta-bar');
    if (!bar) return;

    document.body.classList.add('has-sticky-bar');
  }

  // ============================================================================
  // Hero background pan effect on load
  // ============================================================================

  function initHero() {
    const hero = $('.hero');
    if (!hero) return;

    // Trigger the CSS scale transition
    window.addEventListener('load', () => {
      hero.classList.add('loaded');
    });
  }

  // ============================================================================
  // Keyboard accessibility: skip-to-main
  // ============================================================================

  function initSkipLink() {
    const skip = $('#skip-to-main');
    if (!skip) return;

    on(skip, 'click', (e) => {
      e.preventDefault();
      const main = $('main, #main, [role="main"]');
      if (main) {
        main.setAttribute('tabindex', '-1');
        main.focus();
        main.addEventListener('blur', () => main.removeAttribute('tabindex'), {
          once: true,
        });
      }
    });
  }

  // ============================================================================
  // Debounce helper (for resize events etc.)
  // ============================================================================

  function debounce(fn, delay = 250) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => fn(...args), delay);
    };
  }

  // ============================================================================
  // Handle resize: close mobile menu on desktop breakpoint
  // ============================================================================

  function initResizeHandler() {
    const DESKTOP_BREAKPOINT = 1024;

    on(
      window,
      'resize',
      debounce(() => {
        if (window.innerWidth >= DESKTOP_BREAKPOINT) {
          const toggle = $('.nav-toggle');
          const menu = $('.mobile-menu');

          if (toggle && menu && toggle.classList.contains('is-open')) {
            toggle.classList.remove('is-open');
            menu.classList.remove('is-open');
            document.body.style.overflow = '';
            toggle.setAttribute('aria-expanded', 'false');
          }
        }
      }, 150)
    );
  }

  // ============================================================================
  // DOMContentLoaded: boot everything
  // ============================================================================

  function init() {
    initMobileMenu();
    initStickyHeader();
    initSmoothScroll();
    initFAQAccordion();
    initForms();
    initScrollAnimations();
    initStarRatings();
    initLazyImages();
    initClickToCallTracking();
    initWhatsAppButton();
    initBackToTop();
    initActiveNav();
    initStickyCTABar();
    initHero();
    initSkipLink();
    initResizeHandler();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    // DOM already parsed (script loaded with defer/async)
    init();
  }
})();
