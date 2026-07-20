/* Breeze Builders — front-end behavior (vanilla, no deps) */
(function () {
  'use strict';

  // Mobile nav toggle
  var nav = document.querySelector('.nav');
  var toggle = document.querySelector('.nav-toggle');
  if (nav && toggle) {
    toggle.addEventListener('click', function () {
      var open = nav.getAttribute('data-open') === 'true';
      nav.setAttribute('data-open', String(!open));
      toggle.setAttribute('aria-expanded', String(!open));
    });
  }

  // Footer year
  var y = document.querySelector('[data-year]');
  if (y) { y.textContent = new Date().getFullYear(); }

  // Before/after slider (progressive enhancement over a static block)
  document.querySelectorAll('[data-ba]').forEach(function (el) {
    var handle = el.querySelector('.ba__handle');
    var after = el.querySelector('.ba__after');
    if (!handle || !after) { return; }
    function set(x) {
      var r = el.getBoundingClientRect();
      var pct = Math.min(100, Math.max(0, ((x - r.left) / r.width) * 100));
      after.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
      handle.style.left = pct + '%';
    }
    el.addEventListener('pointermove', function (e) { set(e.clientX); });
  });

  // Scroll behavior: hide top utility bar on scroll down / show on scroll up,
  // and reveal the floating "Call us now" button once scrolled down the page.
  var header = document.querySelector('.site-header');
  var fab = document.querySelector('.call-fab');
  if (header || fab) {
    var lastY = 0, ticking = false;
    function onScroll() {
      var y = window.pageYOffset || document.documentElement.scrollTop || 0;

      // Floating call button: visible after scrolling down past the hero
      if (fab) {
        if (y > 300) { fab.classList.add('is-visible'); }
        else { fab.classList.remove('is-visible'); }
      }

      // Top utility bar: hide on scroll down, show on scroll up (masthead stays sticky)
      if (header) {
        if (y <= 40) {
          header.classList.remove('nav-up');           // always show near the top
        } else if (Math.abs(y - lastY) > 8) {           // ignore tiny jitters
          if (y > lastY) { header.classList.add('nav-up'); }   // scrolling down → hide topbar
          else { header.classList.remove('nav-up'); }          // scrolling up → show topbar
        }
      }

      lastY = y;
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(onScroll); ticking = true; }
    }, { passive: true });
  }
})();