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
})();
