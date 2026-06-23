/**
 * SAAS LOADING SYSTEM v2.0
 * Premium Loading Experience
 */

(function() {
  'use strict';

  const SaaSLoading = {
    preloader: null,
    preloaderTexts: [
      'Loading your workspace',
      'Preparing your dashboard',
      'Almost ready',
      'Welcome back'
    ],

    init() {
      this.preloader = document.getElementById('saas-preloader');
      if (this.preloader) {
        this.initPreloader();
      }
      this.initPageTransition();
      this.initFormLoading();
      this.initImageLoading();
    },

    /* ============================================
       GLOBAL PRELOADER
       ============================================ */
    initPreloader() {
      // Rotate loading texts
      const textEl = this.preloader.querySelector('.saas-preloader-text');
      if (textEl) {
        let index = 0;
        setInterval(() => {
          index = (index + 1) % this.preloaderTexts.length;
          textEl.textContent = this.preloaderTexts[index] + '...';
        }, 2000);
      }

      // Auto-hide preloader
      window.addEventListener('load', () => {
        setTimeout(() => {
          this.hidePreloader();
        }, 600);
      });

      // Fallback: hide after 5 seconds max
      setTimeout(() => {
        if (this.preloader && !this.preloader.classList.contains('hidden')) {
          this.hidePreloader();
        }
      }, 5000);
    },

    hidePreloader() {
      if (!this.preloader) return;
      this.preloader.classList.add('hidden');
      
      // Remove from DOM after transition
      setTimeout(() => {
        if (this.preloader && this.preloader.parentNode) {
          this.preloader.parentNode.removeChild(this.preloader);
        }
      }, 600);
    },

    showPreloader() {
      if (this.preloader && this.preloader.parentNode) {
        this.preloader.classList.remove('hidden');
      } else {
        // Re-create if removed
        this.createPreloader();
      }
    },

    createPreloader() {
      const div = document.createElement('div');
      div.id = 'saas-preloader';
      div.innerHTML = `
        <div class="saas-preloader-logo">
          <div class="logo-ring"></div>
          <div class="logo-icon">M</div>
        </div>
        <div class="saas-preloader-bars">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
        <div class="saas-preloader-text">Loading your workspace...</div>
        <div class="saas-preloader-progress">
          <div class="progress-fill"></div>
        </div>
      `;
      document.body.appendChild(div);
      this.preloader = div;
      this.initPreloader();
    },

    /* ============================================
       PAGE TRANSITIONS
       ============================================ */
    initPageTransition() {
      // Intercept navigation links
      document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:') || 
            href.startsWith('http') || link.hasAttribute('download') ||
            link.getAttribute('target') === '_blank' || e.ctrlKey || e.metaKey) {
          return;
        }

        // Only handle same-origin navigations
        if (link.origin === window.location.origin || !link.origin) {
          // Don't intercept if it's a toggle/collapse/button
          if (link.getAttribute('data-bs-toggle') || link.getAttribute('data-sidebar-toggle') ||
              link.getAttribute('data-command-palette') || link.getAttribute('data-submenu-toggle')) {
            return;
          }
          
          // Don't intercept form submissions
          if (link.closest('form')) return;

          e.preventDefault();
          this.navigateTo(href);
        }
      });
    },

    navigateTo(url) {
      const transition = document.createElement('div');
      transition.className = 'saas-page-transition';
      document.body.appendChild(transition);

      // Trigger transition
      requestAnimationFrame(() => {
        transition.classList.add('active');
      });

      setTimeout(() => {
        window.location.href = url;
      }, 250);
    },

    /* ============================================
       FORM LOADING STATES
       ============================================ */
    initFormLoading() {
      document.addEventListener('submit', (e) => {
        const form = e.target;
        const submitBtn = form.querySelector('[type="submit"]');
        
        if (submitBtn && !submitBtn.disabled) {
          // Add loading state to submit button
          submitBtn.classList.add('loading');
          submitBtn.disabled = true;
          
          // Add spinner
          if (!submitBtn.querySelector('.btn-spinner')) {
            const spinner = document.createElement('span');
            spinner.className = 'btn-spinner';
            spinner.style.marginRight = '6px';
            submitBtn.prepend(spinner);
          }
        }
      });
    },

    /* ============================================
       IMAGE LOADING
       ============================================ */
    initImageLoading() {
      document.querySelectorAll('img:not([loading])').forEach(img => {
        img.setAttribute('loading', 'lazy');
      });
    },

    /* ============================================
       SHOW CONFIRMATION (SweetAlert2 replacement)
       ============================================ */
    confirm(options) {
      return new Promise((resolve) => {
        const overlay = document.createElement('div');
        overlay.className = 'saas-modal-overlay';
        overlay.style.display = 'flex';
        overlay.style.opacity = '0';
        
        overlay.innerHTML = `
          <div class="saas-modal" style="max-width: 400px; text-align: center;">
            <div class="saas-modal-body" style="padding: 32px 24px 20px;">
              <div style="font-size: 48px; margin-bottom: 16px; color: ${options.iconColor || '#f59e0b'};">${options.icon || '⚠'}</div>
              <h3 style="margin: 0 0 8px; font-size: 18px; font-weight: 700; color: var(--ds-text-primary);">${options.title || 'Confirmation'}</h3>
              <p style="margin: 0; font-size: 14px; color: var(--ds-text-secondary);">${options.message || 'Are you sure?'}</p>
            </div>
            <div class="saas-modal-footer" style="justify-content: center; gap: 8px; padding: 16px 24px 24px;">
              <button class="saas-btn saas-btn-secondary" data-confirm-cancel>${options.cancelText || 'Cancel'}</button>
              <button class="saas-btn ${options.confirmClass || 'saas-btn-danger'}" data-confirm-ok>${options.confirmText || 'Confirm'}</button>
            </div>
          </div>
        `;
        
        document.body.appendChild(overlay);
        
        requestAnimationFrame(() => {
          overlay.style.opacity = '1';
          overlay.querySelector('.saas-modal').style.transform = 'scale(1)';
        });
        
        overlay.querySelector('[data-confirm-ok]').addEventListener('click', () => {
          overlay.style.opacity = '0';
          setTimeout(() => overlay.remove(), 200);
          resolve(true);
        });
        
        overlay.querySelector('[data-confirm-cancel]').addEventListener('click', () => {
          overlay.style.opacity = '0';
          setTimeout(() => overlay.remove(), 200);
          resolve(false);
        });
        
        overlay.addEventListener('click', (e) => {
          if (e.target === overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => overlay.remove(), 200);
            resolve(false);
          }
        });
      });
    }
  };

  // Initialize
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => SaaSLoading.init());
  } else {
    SaaSLoading.init();
  }

  // Expose
  window.SaaSLoading = SaaSLoading;
  window.confirmAction = (options) => SaaSLoading.confirm(options);
})();
