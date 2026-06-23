/**
 * SAAS DESIGN SYSTEM v2.0
 * Core JavaScript Behaviors
 */

(function() {
  'use strict';

  const SaaS = {
    version: '2.0.0',
    
    init() {
      this.initTheme();
      this.initSidebar();
      this.initCommandPalette();
      this.initDropdowns();
      this.initTooltips();
      this.initToasts();
      this.initSearch();
      this.initAnimations();
      this.initFormEnhancements();
      this.initSkeletons();
      this.initKeyboardShortcuts();
    },

    /* ============================================
       THEME (Dark/Light/Auto)
       ============================================ */
    initTheme() {
      const saved = localStorage.getItem('saas-theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      
      let theme = saved || 'light';
      if (theme === 'auto') {
        theme = prefersDark ? 'dark' : 'light';
      }
      
      this.setTheme(theme);
      
      // Listen for system changes
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const current = localStorage.getItem('saas-theme');
        if (current === 'auto') {
          this.setTheme(e.matches ? 'dark' : 'light');
        }
      });
    },

    setTheme(theme) {
      document.documentElement.setAttribute('data-theme', theme);
      document.documentElement.setAttribute('data-bs-theme', theme);
      
      const icon = document.getElementById('theme-toggle-icon');
      
      // Update all theme toggle buttons
      document.querySelectorAll('[data-theme-toggle]').forEach(el => {
        const sunIcon = el.querySelector('.theme-icon-sun');
        const moonIcon = el.querySelector('.theme-icon-moon');
        if (sunIcon && moonIcon) {
          if (theme === 'dark') {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
          } else {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
          }
        }
      });
    },

    toggleTheme() {
      const current = document.documentElement.getAttribute('data-theme') || 'light';
      const next = current === 'dark' ? 'light' : 'dark';
      this.setTheme(next);
      localStorage.setItem('saas-theme', next);
    },

    /* ============================================
       SIDEBAR
       ============================================ */
    initSidebar() {
      const wrapper = document.getElementById('saas-wrapper');
      if (!wrapper) return;

      // Restore state
      const collapsed = localStorage.getItem('saas-sidebar-collapsed') === 'true';
      if (collapsed && window.innerWidth > 991.98) {
        wrapper.classList.add('saas-sidebar-collapsed');
      }

      // Toggle buttons
      document.querySelectorAll('[data-sidebar-toggle]').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.stopPropagation();
          this.toggleSidebar();
        });
      });

      // Submenu toggles
      document.querySelectorAll('[data-submenu-toggle]').forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const target = document.querySelector(link.getAttribute('data-submenu-toggle'));
          if (!target) return;
          
          const arrow = link.querySelector('.nav-arrow');
          const isOpen = target.classList.contains('open');
          
          if (!isOpen) {
            target.style.maxHeight = target.scrollHeight + 'px';
            target.classList.add('open');
            if (arrow) arrow.classList.add('open');
          } else {
            target.style.maxHeight = '0';
            target.classList.remove('open');
            if (arrow) arrow.classList.remove('open');
          }
        });
      });

      // Mobile overlay
      document.querySelectorAll('[data-sidebar-overlay]').forEach(overlay => {
        overlay.addEventListener('click', () => {
          this.hideMobileSidebar();
        });
      });

      // Close on outside click (mobile)
      document.addEventListener('click', (e) => {
        if (window.innerWidth <= 991.98) {
          const sidebar = document.getElementById('saas-sidebar');
          const toggle = e.target.closest('[data-sidebar-toggle]');
          if (sidebar && sidebar.classList.contains('show') && 
              !sidebar.contains(e.target) && !toggle) {
            this.hideMobileSidebar();
          }
        }
      });

      // Set initial submenu states from data attributes
      document.querySelectorAll('[data-submenu-toggle]').forEach(link => {
        const target = document.querySelector(link.getAttribute('data-submenu-toggle'));
        if (!target) return;
        const expanded = link.getAttribute('data-expanded') === 'true';
        if (expanded) {
          target.style.maxHeight = target.scrollHeight + 'px';
          target.classList.add('open');
        }
      });
    },

    toggleSidebar() {
      const wrapper = document.getElementById('saas-wrapper');
      if (!wrapper) return;
      
      if (window.innerWidth <= 991.98) {
        // Mobile: toggle show/hide
        const sidebar = document.getElementById('saas-sidebar');
        const overlay = document.querySelector('[data-sidebar-overlay]');
        if (sidebar) sidebar.classList.toggle('show');
        if (overlay) overlay.classList.toggle('show');
      } else {
        // Desktop: toggle collapsed
        const isCollapsed = wrapper.classList.toggle('saas-sidebar-collapsed');
        localStorage.setItem('saas-sidebar-collapsed', isCollapsed);
      }
    },

    hideMobileSidebar() {
      document.querySelectorAll('#saas-sidebar.show, [data-sidebar-overlay].show').forEach(el => {
        el.classList.remove('show');
      });
    },

    /* ============================================
       COMMAND PALETTE (CTRL+K)
       ============================================ */
    initCommandPalette() {
      const overlay = document.getElementById('command-palette');
      if (!overlay) return;

      const input = overlay.querySelector('input');
      const results = overlay.querySelector('.saas-command-results');
      
      if (!input || !results) return;

      // Open triggers
      document.querySelectorAll('[data-command-palette]').forEach(trigger => {
        trigger.addEventListener('click', () => this.openCommandPalette());
      });

      // Keyboard shortcut
      document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
          e.preventDefault();
          if (overlay.classList.contains('show')) {
            this.closeCommandPalette();
          } else {
            this.openCommandPalette();
          }
        }
        // Close on Escape
        if (e.key === 'Escape' && overlay.classList.contains('show')) {
          this.closeCommandPalette();
        }
      });

      // Search/filter
      input.addEventListener('input', () => {
        this.filterCommands(input.value);
      });

      // Keyboard navigation
      input.addEventListener('keydown', (e) => {
        const items = results.querySelectorAll('.saas-command-item');
        const active = results.querySelector('.saas-command-item.active');
        let index = Array.from(items).indexOf(active);

        switch (e.key) {
          case 'ArrowDown':
            e.preventDefault();
            if (active) active.classList.remove('active');
            index = Math.min(index + 1, items.length - 1);
            if (items[index]) {
              items[index].classList.add('active');
              items[index].scrollIntoView({ block: 'nearest' });
            }
            break;
          case 'ArrowUp':
            e.preventDefault();
            if (active) active.classList.remove('active');
            index = Math.max(index - 1, 0);
            if (items[index]) {
              items[index].classList.add('active');
              items[index].scrollIntoView({ block: 'nearest' });
            }
            break;
          case 'Enter':
            e.preventDefault();
            if (active) active.click();
            break;
        }
      });

      // Click item
      results.addEventListener('click', (e) => {
        const item = e.target.closest('.saas-command-item');
        if (item) {
          this.closeCommandPalette();
        }
      });

      // Click overlay background to close
      overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
          this.closeCommandPalette();
        }
      });
    },

    openCommandPalette() {
      const overlay = document.getElementById('command-palette');
      if (!overlay) return;
      overlay.classList.add('show');
      const input = overlay.querySelector('input');
      if (input) {
        setTimeout(() => input.focus(), 100);
        input.value = '';
      }
      this.filterCommands('');
    },

    closeCommandPalette() {
      const overlay = document.getElementById('command-palette');
      if (!overlay) return;
      overlay.classList.remove('show');
    },

    filterCommands(query) {
      const results = document.querySelector('#command-palette .saas-command-results');
      if (!results) return;
      
      const items = results.querySelectorAll('.saas-command-item');
      const groups = results.querySelectorAll('.saas-command-group-label');
      
      query = query.toLowerCase().trim();
      
      let hasVisible = false;
      
      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        const match = !query || text.includes(query);
        item.style.display = match ? 'flex' : 'none';
        if (match) hasVisible = true;
      });
      
      groups.forEach(g => {
        const groupItems = [];
        let next = g.nextElementSibling;
        while (next && !next.classList.contains('saas-command-group-label')) {
          if (next.classList.contains('saas-command-item')) {
            groupItems.push(next);
          }
          next = next.nextElementSibling;
        }
        const hasVisibleGroup = groupItems.some(item => item.style.display !== 'none');
        g.style.display = hasVisibleGroup ? 'block' : 'none';
      });
      
      // Empty state
      let empty = results.querySelector('.saas-command-empty');
      if (!hasVisible) {
        if (!empty) {
          empty = document.createElement('div');
          empty.className = 'saas-command-empty';
          empty.innerHTML = '<div class="empty-icon">🔍</div><div>No results found</div>';
          results.appendChild(empty);
        }
        empty.style.display = 'block';
      } else {
        if (empty) empty.style.display = 'none';
      }
    },

    /* ============================================
       DROPDOWNS (manual enhancement)
       ============================================ */
    initDropdowns() {
      // Enhance all Bootstrap dropdowns to use saas styling
      document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (!menu.classList.contains('saas-dropdown-menu')) {
          menu.classList.add('saas-dropdown-menu');
        }
      });

      // Close dropdowns on escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          document.querySelectorAll('.dropdown-menu.show').forEach(m => {
            m.classList.remove('show');
          });
        }
      });
    },

    /* ============================================
       TOOLTIPS (native)
       ============================================ */
    initTooltips() {
      // Simple title-based tooltips via CSS
    },

    /* ============================================
       TOAST NOTIFICATIONS
       ============================================ */
    initToasts() {
      // Auto-show any toast in the container
      document.querySelectorAll('.saas-toast[data-auto-show]').forEach(toast => {
        setTimeout(() => {
          toast.classList.add('show');
        }, 100);
      });

      // Close buttons
      document.addEventListener('click', (e) => {
        const close = e.target.closest('.toast-close, .alert-close');
        if (close) {
          const toast = close.closest('.saas-toast');
          if (toast) {
            toast.classList.add('hiding');
            setTimeout(() => toast.remove(), 300);
          }
          const alert = close.closest('.saas-alert');
          if (alert) {
            alert.style.transition = 'all 0.2s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 200);
          }
        }
      });
    },

    showToast(options) {
      const container = document.querySelector('.saas-toast-container');
      if (!container) return;

      const types = {
        success: { icon: '✓', title: 'Success' },
        error: { icon: '✕', title: 'Error' },
        warning: { icon: '⚠', title: 'Warning' },
        info: { icon: 'ℹ', title: 'Info' }
      };

      const type = options.type || 'info';
      const cfg = types[type] || types.info;

      const toast = document.createElement('div');
      toast.className = `saas-toast ${type}`;
      toast.innerHTML = `
        <div class="toast-icon">${cfg.icon}</div>
        <div class="toast-content">
          <div class="toast-title">${options.title || cfg.title}</div>
          ${options.message ? `<div class="toast-message">${options.message}</div>` : ''}
        </div>
        <button class="toast-close">✕</button>
      `;

      container.appendChild(toast);

      // Trigger animation
      requestAnimationFrame(() => {
        toast.classList.add('show');
      });

      // Auto remove
      const duration = options.duration || 4000;
      setTimeout(() => {
        toast.classList.add('hiding');
        setTimeout(() => toast.remove(), 300);
      }, duration);
    },

    /* ============================================
       GLOBAL SEARCH
       ============================================ */
    initSearch() {
      // Click on search trigger opens command palette
      document.querySelectorAll('[data-search-trigger]').forEach(el => {
        el.addEventListener('click', () => this.openCommandPalette());
      });
    },

    /* ============================================
       ANIMATIONS
       ============================================ */
    initAnimations() {
      // Stagger children animation
      document.querySelectorAll('.saas-stagger').forEach(el => {
        if (!el.classList.contains('saas-stagger-done')) {
          el.classList.add('saas-stagger-done');
        }
      });

      // Count-up animation for stat cards
      this.initCountUp();
    },

    initCountUp() {
      document.querySelectorAll('[data-count-up]').forEach(el => {
        const target = parseFloat(el.getAttribute('data-count-up'));
        const suffix = el.getAttribute('data-count-suffix') || '';
        const prefix = el.getAttribute('data-count-prefix') || '';
        const duration = parseInt(el.getAttribute('data-count-duration')) || 1000;
        
        if (isNaN(target)) return;
        
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              this.animateCount(el, target, prefix, suffix, duration);
              observer.unobserve(el);
            }
          });
        }, { threshold: 0.1 });
        
        observer.observe(el);
      });
    },

    animateCount(el, target, prefix, suffix, duration) {
      const start = performance.now();
      const isFloat = target % 1 !== 0;
      
      const update = (currentTime) => {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = target * eased;
        
        if (isFloat) {
          el.textContent = prefix + current.toFixed(1) + suffix;
        } else {
          el.textContent = prefix + Math.round(current).toLocaleString() + suffix;
        }
        
        if (progress < 1) {
          requestAnimationFrame(update);
        } else {
          el.textContent = prefix + (isFloat ? target.toFixed(1) : target.toLocaleString()) + suffix;
        }
      };
      
      requestAnimationFrame(update);
    },

    /* ============================================
       FORM ENHANCEMENTS
       ============================================ */
    initFormEnhancements() {
      // Auto-style form controls
      document.querySelectorAll('input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]):not(.saas-form-control):not(.form-control)').forEach(input => {
        if (input.closest('.saas-form-control') || input.closest('.form-control')) return;
        if (!input.closest('.saas-command-input-wrap') && !input.closest('[data-no-enhance]')) {
          // Add class based on context
        }
      });

      // File upload drag & drop
      this.initFileUploads();
    },

    initFileUploads() {
      document.querySelectorAll('.saas-upload-zone').forEach(zone => {
        const input = zone.querySelector('input[type="file"]');
        if (!input) return;

        // Click to upload
        zone.addEventListener('click', () => input.click());

        // Drag events
        ['dragenter', 'dragover'].forEach(event => {
          zone.addEventListener(event, (e) => {
            e.preventDefault();
            e.stopPropagation();
            zone.classList.add('dragover');
          });
        });

        ['dragleave', 'drop'].forEach(event => {
          zone.addEventListener(event, (e) => {
            e.preventDefault();
            e.stopPropagation();
            zone.classList.remove('dragover');
          });
        });

        zone.addEventListener('drop', (e) => {
          const files = e.dataTransfer.files;
          if (files.length) {
            input.files = files;
            this.handleFiles(files, zone);
          }
        });

        input.addEventListener('change', () => {
          if (input.files.length) {
            this.handleFiles(input.files, zone);
          }
        });
      });
    },

    handleFiles(files, zone) {
      const previewContainer = zone.nextElementSibling?.classList.contains('saas-upload-preview') 
        ? zone.nextElementSibling 
        : null;

      Array.from(files).forEach(file => {
        // Show preview for images
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = (e) => {
            const preview = document.createElement('div');
            preview.className = 'saas-upload-preview';
            preview.innerHTML = `
              <img src="${e.target.result}" class="preview-img" alt="Preview">
              <div class="preview-info">
                <div class="preview-name">${file.name}</div>
                <div class="preview-size">${this.formatFileSize(file.size)}</div>
              </div>
              <button class="preview-remove">✕</button>
            `;
            zone.after(preview);
            
            preview.querySelector('.preview-remove').addEventListener('click', () => {
              preview.remove();
              zone.querySelector('input[type="file"]').value = '';
            });
          };
          reader.readAsDataURL(file);
        }
      });
    },

    formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    },

    /* ============================================
       SKELETON LOADERS
       ============================================ */
    initSkeletons() {
      // Auto-hide skeletons after content loads
      document.querySelectorAll('[data-skeleton]').forEach(el => {
        const content = document.querySelector(el.getAttribute('data-skeleton'));
        if (content) {
          const timer = setTimeout(() => {
            el.style.display = 'none';
            if (content) content.style.display = 'block';
          }, parseInt(el.getAttribute('data-delay')) || 600);
        }
      });

      // Simple skeleton show/hide utility
      window.saasShowSkeleton = function(id) {
        document.querySelectorAll(`[data-skeleton-id="${id}"]`).forEach(el => {
          el.classList.remove('saas-skeleton-hidden');
        });
      };

      window.saasHideSkeleton = function(id) {
        document.querySelectorAll(`[data-skeleton-id="${id}"]`).forEach(el => {
          el.classList.add('saas-skeleton-hidden');
        });
      };
    },

    /* ============================================
       KEYBOARD SHORTCUTS
       ============================================ */
    initKeyboardShortcuts() {
      document.addEventListener('keydown', (e) => {
        // Escape general
        if (e.key === 'Escape') {
          // Close modals
          const modal = document.querySelector('.saas-modal-overlay.show');
          if (modal) {
            modal.classList.remove('show');
          }
          // Close command palette
          this.closeCommandPalette();
        }
      });
    },

    /* ============================================
       UTILITY FUNCTIONS
       ============================================ */
    debounce(func, wait) {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    }
  };

  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => SaaS.init());
  } else {
    SaaS.init();
  }

  // Expose to global
  window.SaaS = SaaS;
})();
