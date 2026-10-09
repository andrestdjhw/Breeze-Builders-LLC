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

  // Services mega menu — hover (with a short close delay so the pointer can travel
  // into the panel) on desktop, click/tap everywhere, Escape and outside-click close.
  document.querySelectorAll('[data-mega]').forEach(function (item) {
    var btn = item.querySelector('.mega-toggle');
    var closeTimer = null;
    var desktop = window.matchMedia('(min-width: 901px)');
    function setOpen(open) {
      window.clearTimeout(closeTimer);
      item.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', String(open));
    }
    btn.addEventListener('click', function () { setOpen(!item.classList.contains('is-open')); });
    item.addEventListener('mouseenter', function () { if (desktop.matches) { setOpen(true); } });
    item.addEventListener('mouseleave', function () {
      if (desktop.matches) { closeTimer = window.setTimeout(function () { setOpen(false); }, 180); }
    });
    item.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && item.classList.contains('is-open')) { setOpen(false); btn.focus(); }
    });
    item.addEventListener('focusout', function (e) {
      if (desktop.matches && !item.contains(e.relatedTarget)) { setOpen(false); }
    });
    document.addEventListener('click', function (e) {
      if (desktop.matches && !item.contains(e.target)) { setOpen(false); }
    });
  });

  // Projects gallery — category filters + a lightbox (native <dialog>) with prev/next.
  document.querySelectorAll('[data-gallery]').forEach(function (grid) {
    var section = grid.closest('section');
    var buttons = section ? section.querySelectorAll('[data-filter]') : [];
    var tiles = Array.prototype.slice.call(grid.querySelectorAll('.project'));
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var f = btn.getAttribute('data-filter');
        buttons.forEach(function (b) {
          var on = b === btn;
          b.classList.toggle('is-active', on);
          b.setAttribute('aria-pressed', String(on));
        });
        tiles.forEach(function (t) { t.hidden = f !== 'all' && t.getAttribute('data-cat') !== f; });
      });
    });

    if (typeof HTMLDialogElement !== 'function') { return; } // links still open the image
    var dlg = document.createElement('dialog');
    dlg.className = 'lightbox';
    dlg.innerHTML =
      '<figure class="lightbox__figure"><img class="lightbox__img" alt=""><figcaption class="lightbox__caption"></figcaption></figure>' +
      '<button type="button" class="lightbox__btn lightbox__close" aria-label="Close">&times;</button>' +
      '<button type="button" class="lightbox__btn lightbox__prev" aria-label="Previous photo">&#8249;</button>' +
      '<button type="button" class="lightbox__btn lightbox__next" aria-label="Next photo">&#8250;</button>';
    document.body.appendChild(dlg);
    var img = dlg.querySelector('.lightbox__img');
    var cap = dlg.querySelector('.lightbox__caption');
    var current = 0, list = [];
    function show(i) {
      current = (i + list.length) % list.length;
      var a = list[current];
      img.src = a.href;
      img.alt = a.getAttribute('data-caption') || '';
      cap.textContent = img.alt;
    }
    grid.addEventListener('click', function (e) {
      var a = e.target.closest('[data-lightbox]');
      if (!a) { return; }
      e.preventDefault();
      list = tiles.filter(function (t) { return !t.hidden; }).map(function (t) { return t.querySelector('[data-lightbox]'); });
      show(list.indexOf(a));
      dlg.showModal();
    });
    dlg.querySelector('.lightbox__close').addEventListener('click', function () { dlg.close(); });
    dlg.querySelector('.lightbox__prev').addEventListener('click', function () { show(current - 1); });
    dlg.querySelector('.lightbox__next').addEventListener('click', function () { show(current + 1); });
    dlg.addEventListener('click', function (e) { if (e.target === dlg) { dlg.close(); } }); // backdrop
    dlg.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { show(current - 1); }
      if (e.key === 'ArrowRight') { show(current + 1); }
    });
  });

  // Footer year
  var y = document.querySelector('[data-year]');
  if (y) { y.textContent = new Date().getFullYear(); }

  // Before/after slider (progressive enhancement over a static block)
  // A native range input (drag, tap, or arrow keys) drives --pos; on first view the
  // divider sweeps once so visitors see it's interactive.
  document.querySelectorAll('[data-ba]').forEach(function (el) {
    var range = el.querySelector('.ba__range');
    if (!range) { return; }
    var touched = false;
    function set(v) { el.style.setProperty('--pos', v + '%'); }
    range.addEventListener('input', function () { touched = true; set(range.value); });
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) { return; }
    var io = new IntersectionObserver(function (entries) {
      if (!entries[0].isIntersecting) { return; }
      io.disconnect();
      var start = null, keys = [50, 78, 24, 50], dur = 2200;
      function step(ts) {
        if (touched) { return; } // the visitor took over
        if (start === null) { start = ts; }
        var t = Math.min(1, (ts - start) / dur), seg = Math.min(2, Math.floor(t * 3)), local = t * 3 - seg;
        var eased = 0.5 - Math.cos(local * Math.PI) / 2;
        var v = keys[seg] + (keys[seg + 1] - keys[seg]) * eased;
        set(v.toFixed(1)); range.value = v;
        if (t < 1) { window.requestAnimationFrame(step); }
      }
      window.setTimeout(function () { window.requestAnimationFrame(step); }, 500);
    }, { threshold: 0.6 });
    io.observe(el);
  });

  // Services carousel — continuous marquee-style scroll (loops seamlessly),
  // with prev/next controls and swipe still available.
  document.querySelectorAll('[data-carousel]').forEach(function (root) {
    var track = root.querySelector('[data-carousel-track]');
    var prev = root.querySelector('[data-carousel-prev]');
    var next = root.querySelector('[data-carousel-next]');
    if (!track) { return; }

    // Card step and loop width are measured once (and on resize), never per frame:
    // reading layout inside the animation loop forced a reflow every frame.
    var stepW = 0, cycleW = 0;
    function measure() {
      var card = track.querySelector('.scard');
      if (!card) { stepW = track.clientWidth; cycleW = 0; return; }
      var styles = window.getComputedStyle(track);
      var gap = parseFloat(styles.columnGap || styles.gap) || 0;
      stepW = card.getBoundingClientRect().width + gap;
      cycleW = track.querySelectorAll('.scard:not([aria-hidden="true"])').length * stepW;
    }
    measure();
    window.addEventListener('resize', measure);
    function step() { return stepW; }
    // Width of one full set of cards — the point where we wrap around.
    function cycle() { return cycleW; }

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

    // --- Continuous marquee drift (seamless loop; cards fade at screen edges) ---
    // NOTE: some browsers (Safari) truncate scrollLeft to integers, so a
    // sub-pixel per-frame increment gets lost and the drift never moves.
    // We accumulate the position in a float and assign it each frame.
    var SPEED = 42;          // pixels per second
    var RESUME_AFTER = 2000; // ms of stillness before motion picks back up
    var last = null, raf = null, paused = false, inView = true, idle = null;
    var pos = null; // float source of truth for the drift position

    function frame(ts) {
      if (last === null) { last = ts; pos = track.scrollLeft; }
      var dt = ts - last;
      last = ts;
      if (!paused && inView && !document.hidden) {
        pos += SPEED * (dt / 1000);
        var c = cycle();
        if (c > 0) {
          if (pos >= c) { pos -= c; }
          else if (pos < 0) { pos += c; }
        }
        track.scrollLeft = pos;
      }
      raf = window.requestAnimationFrame(frame);
    }

    function play() { if (!raf) { last = null; raf = window.requestAnimationFrame(frame); } }
    function stop() { if (raf) { window.cancelAnimationFrame(raf); raf = null; } }
    function pause() { paused = true; }
    function resume() { if (paused) { paused = false; last = null; } }

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

  // General scroll reveal — section headings, copy and grid items rise in once,
  // siblings staggered. Blocks with their own choreography (book, fear rows,
  // FAQ, carousel, [data-reveal]) are left alone.
  var motionOK = !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);
  if (motionOK && 'IntersectionObserver' in window) {
    var revealSel = [
      '.section .wrap > .eyebrow', '.section .wrap > h2', '.section .wrap > p',
      '.section .wrap > .btn-row', '.cards > *', '.proof-grid > *', '.split > *',
      '.finance > *', '.form-grid > *', '.footer-grid > *', '.chips-marquee', '.intro-split > *', '.lead-map > *', '.projects__head', '.project-grid > *', '.ba'
    ].join(',');
    var skip = '[data-book], [data-reveal], .fear-list, .faq, .carousel';
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-in');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -6% 0px' });
    document.querySelectorAll(revealSel).forEach(function (el) {
      if (el.matches(skip) || el.parentElement.closest(skip)) { return; }
      // Stagger by position among revealed siblings (capped so long lists don't lag)
      var i = 0, sib = el.previousElementSibling;
      while (sib) { if (sib.classList.contains('rv')) { i++; } sib = sib.previousElementSibling; }
      el.style.setProperty('--rv-i', Math.min(i, 5));
      el.classList.add('rv');
      revealObserver.observe(el);
    });
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
  var toTop = document.querySelector('.to-top');
  if (toTop) {
    toTop.addEventListener('click', function () {
      var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });
  }
  if (header) {
    var bar = header.querySelector('.utility-bar');
    var setUtil = function () { header.style.setProperty('--util-h', (bar ? bar.offsetHeight : 0) + 'px'); };
    setUtil();
    window.addEventListener('resize', setUtil);
  }
  if (header || fab || toTop) {
    var lastY = 0, ticking = false;
    function onScroll() {
      var y = window.pageYOffset || document.documentElement.scrollTop || 0;

      // Floating buttons: visible after scrolling down past the hero
      if (fab) {
        if (y > 300) { fab.classList.add('is-visible'); }
        else { fab.classList.remove('is-visible'); }
      }
      if (toTop) {
        if (y > 600) { toTop.classList.add('is-visible'); }
        else { toTop.classList.remove('is-visible'); }
      }

      // Top utility bar: hide on scroll down, show on scroll up (masthead stays sticky)
      if (header) {
        header.classList.toggle('is-scrolled', y > 10);
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
    onScroll();
  }
})();