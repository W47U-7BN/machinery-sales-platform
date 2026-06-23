(function() {
  'use strict';

  const header = document.querySelector('.lp-header');
  const scrollTopBtn = document.getElementById('scroll-to-top');
  const progressBar = document.getElementById('scroll-progress');
  const hamburger = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  let ticking = false;

  function updateHeader() {
    if (!header) return;
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }

  function updateScrollTop() {
    if (!scrollTopBtn) return;
    if (window.scrollY > 400) {
      scrollTopBtn.classList.add('visible');
    } else {
      scrollTopBtn.classList.remove('visible');
    }
  }

  function updateProgress() {
    if (!progressBar) return;
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = progress + '%';
  }

  function onScroll() {
    if (!ticking) {
      window.requestAnimationFrame(function() {
        updateHeader();
        updateScrollTop();
        updateProgress();
        ticking = false;
      });
      ticking = true;
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  updateHeader();
  updateScrollTop();
  updateProgress();

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function() {
      const isOpen = mobileMenu.classList.toggle('open');
      hamburger.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
      hamburger.setAttribute('aria-expanded', isOpen);
    });
  }

  const fadeElements = document.querySelectorAll('.lp-fade-in, .lp-fade-in-left, .lp-fade-in-right, .lp-scale-in, .lp-stagger');

  if (fadeElements.length > 0) {
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains('lp-stagger')) {
            const children = entry.target.children;
            for (let i = 0; i < children.length; i++) {
              setTimeout(function() {
                children[i].classList.add('visible-stagger');
              }, i * 80);
            }
          }
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(function(el) {
      observer.observe(el);
    });
  }

  const statValues = document.querySelectorAll('.lp-stat-value');
  if (statValues.length > 0) {
    const statObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const el = entry.target;
          const text = el.textContent.trim();
          const match = text.match(/(\d+)([+\-%k]*)/);
          if (match) {
            const target = parseInt(match[1]);
            const suffix = match[2] || '';
            let current = 0;
            const increment = Math.max(1, Math.floor(target / 40));
            const timer = setInterval(function() {
              current += increment;
              if (current >= target) {
                current = target;
                clearInterval(timer);
              }
              el.textContent = current + suffix;
            }, 40);
          }
          statObserver.unobserve(el);
        }
      });
    }, { threshold: 0.5 });

    statValues.forEach(function(el) {
      statObserver.observe(el);
    });
  }

  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      const href = anchor.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        if (mobileMenu && mobileMenu.classList.contains('open')) {
          mobileMenu.classList.remove('open');
          if (hamburger) {
            hamburger.innerHTML = '<i class="fas fa-bars"></i>';
            hamburger.setAttribute('aria-expanded', false);
          }
        }
      }
    });
  });

  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
  const storedTheme = localStorage.getItem('theme');

  function applyTheme(theme) {
    if (theme === 'dark' || (!theme && prefersDark.matches)) {
      document.documentElement.setAttribute('data-theme', 'dark');
      document.documentElement.setAttribute('data-color-scheme', 'dark');
    } else {
      document.documentElement.setAttribute('data-theme', 'light');
      document.documentElement.removeAttribute('data-color-scheme');
    }
  }

  applyTheme(storedTheme);

  prefersDark.addEventListener('change', function() {
    if (!localStorage.getItem('theme')) {
      applyTheme(null);
    }
  });

  window.toggleTheme = function() {
    const current = document.documentElement.getAttribute('data-theme');
    const newTheme = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', newTheme);
    applyTheme(newTheme);
  };

  document.querySelectorAll('[data-count]').forEach(function(el) {
    const target = parseInt(el.getAttribute('data-count'));
    if (isNaN(target)) return;
    let current = 0;
    const increment = Math.max(1, Math.floor(target / 40));
    const timer = setInterval(function() {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      el.textContent = current;
    }, 40);
  });

  const darkSectionImages = document.querySelectorAll('.lp-dark-section .lp-parallax-bg img');
  darkSectionImages.forEach(function(img) {
    img.style.transform = 'translateY(0)';
  });

  window.addEventListener('scroll', function() {
    darkSectionImages.forEach(function(img) {
      const rect = img.closest('.lp-parallax-bg').getBoundingClientRect();
      const speed = 0.3;
      const yPos = -(rect.top * speed);
      img.style.transform = 'translate3d(0, ' + yPos + 'px, 0)';
    });
  }, { passive: true });
})();
