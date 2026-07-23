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

  // Services carousel — continuous marquee-style scroll (loops seamlessly),
  // with prev/next controls and swipe still available.
  document.querySelectorAll('[data-carousel]').forEach(function (root) {
    var track = root.querySelector('[data-carousel-track]');
    var prev = root.querySelector('[data-carousel-prev]');
    var next = root.querySelector('[data-carousel-next]');
    if (!track) { return; }

    function step() {
      var card = track.querySelector('.scard');
      if (!card) { return track.clientWidth; }
      var styles = window.getComputedStyle(track);
      var gap = parseFloat(styles.columnGap || styles.gap) || 0;
      return card.getBoundingClientRect().width + gap;
    }

    // Width of one full set of cards — the point where we wrap around.
    function cycle() {
      var originals = track.querySelectorAll('.scard:not([aria-hidden="true"])').length;
      return originals * step();
    }

    function wrap() {
      var c = cycle();
      if (c <= 0) { return; }
      if (track.scrollLeft >= c) { track.scrollLeft -= c; }
      else if (track.scrollLeft <= 0) { track.scrollLeft += c; }
    }

    if (prev) { prev.addEventListener('click', function () { wrap(); track.scrollBy({ left: -step(), behavior: 'smooth' }); }); }
    if (next) { next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); }); }

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) { return; }

    // --- Continuous scroll ------------------------------------------------
    var SPEED = 42;          // pixels per second — matches the trust bar's calm pace
    var RESUME_AFTER = 2000; // ms of stillness before motion picks back up
    var last = null, raf = null, paused = false, inView = true, idle = null;

    function frame(ts) {
      if (last === null) { last = ts; }
      var dt = ts - last;
      last = ts;
      if (!paused && inView && !document.hidden) {
        track.scrollLeft += SPEED * (dt / 1000);
        wrap();
      }
      raf = window.requestAnimationFrame(frame);
    }

    function play() { if (!raf) { last = null; raf = window.requestAnimationFrame(frame); } }
    function stop() { if (raf) { window.cancelAnimationFrame(raf); raf = null; } }
    function pause() { paused = true; }
    function resume() { paused = false; last = null; }

    // Pause while the visitor reads or interacts
    root.addEventListener('mouseenter', pause);
    root.addEventListener('mouseleave', resume);
    root.addEventListener('focusin', pause);
    root.addEventListener('focusout', resume);
    track.addEventListener('pointerdown', pause);
    track.addEventListener('touchstart', pause, { passive: true });

    // After a manual swipe or arrow click, resume once things settle
    track.addEventListener('scroll', function () {
      if (idle) { window.clearTimeout(idle); }
      idle = window.setTimeout(function () { if (!root.matches(':hover')) { resume(); } }, RESUME_AFTER);
    }, { passive: true });

    document.addEventListener('visibilitychange', function () { last = null; });

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        inView = entries[0].isIntersecting;
        last = null;
      }, { threshold: 0.05 }).observe(root);
    }

    play();
  });

  // "Open book" reveal — unfolds every time the section scrolls into view
  // (folds closed again when it leaves, in either direction)
  var books = document.querySelectorAll('[data-book]');
  if (books.length) {
    if ('IntersectionObserver' in window) {
      var bookObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          entry.target.classList.toggle('in-view', entry.isIntersecting);
        });
      }, { threshold: 0.25 });
      books.forEach(function (b) { bookObserver.observe(b); });
    } else {
      books.forEach(function (b) { b.classList.add('in-view'); });
    }
  }

  // Fear → answer rows and FAQ items — each reveals as it scrolls into view,
  // and resets when it leaves so the effect replays in both directions
  var fearRows = document.querySelectorAll('.fear-row, .faq-item, [data-reveal]');
  if (fearRows.length) {
    if ('IntersectionObserver' in window) {
      var rowObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          entry.target.classList.toggle('in-view', entry.isIntersecting);
        });
      }, { threshold: 0.35, rootMargin: '0px 0px -5% 0px' });
      fearRows.forEach(function (r) { rowObserver.observe(r); });
    } else {
      fearRows.forEach(function (r) { r.classList.add('in-view'); });
    }
  }

  // 3D tilt cards — subtle perspective tilt following the pointer ([data-tilt])
  var tiltReduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var tiltFine = window.matchMedia && window.matchMedia('(pointer: fine)').matches;
  if (!tiltReduce && tiltFine) {
    document.querySelectorAll('[data-tilt]').forEach(function (card) {
      var MAX = 3.5; // degrees — keep it classy
      var rafId = null;

      function onMove(e) {
        if (rafId) { return; }
        rafId = window.requestAnimationFrame(function () {
          var r = card.getBoundingClientRect();
          var px = (e.clientX - r.left) / r.width - 0.5;   // -0.5 … 0.5
          var py = (e.clientY - r.top) / r.height - 0.5;
          card.classList.add('is-tilting');
          card.style.transform =
            'rotateX(' + (-py * MAX).toFixed(2) + 'deg) ' +
            'rotateY(' + (px * MAX).toFixed(2) + 'deg) ' +
            'translateZ(6px)';
          rafId = null;
        });
      }

      function onLeave() {
        card.classList.remove('is-tilting');
        card.style.transform = '';
      }

      card.addEventListener('pointermove', onMove);
      card.addEventListener('pointerleave', onLeave);
    });
  }

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