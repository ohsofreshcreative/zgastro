document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('section.tabs').forEach(function (root) {
    const nav = root.querySelector('.js-tabs-nav');
    const wrap = root.querySelector('.js-tabs-panels');
    if (!nav || !wrap) return;

    const tabs = Array.from(nav.querySelectorAll('.tab_btn'));
    const panels = Array.from(wrap.querySelectorAll('.__content'));

    let active = tabs.findIndex(t => t.classList.contains('active'));
    if (active < 0) active = 0;

    // Inicjalizacja stanu
    tabs.forEach((btn, i) => {
      btn.classList.toggle('active', i === active);
      panels[i].classList.toggle('active', i === active);
    });

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const animateWrap = (fromH, toH) => {
      if (prefersReduced) return;
      gsap.killTweensOf(wrap);
      gsap.fromTo(
        wrap,
        { height: fromH, opacity: 0, y: 16, scale: 0.995 },
        { height: toH, opacity: 1, y: 0, scale: 1, duration: 0.35, ease: 'power2.out', clearProps: 'height' }
      );
    };

    tabs.forEach((btn, i) => {
      btn.addEventListener('click', () => {
        if (i === active) return;

        // wysokość PRZED przełączeniem
        const fromH = wrap.offsetHeight;

        // przełącz widoczny panel
        tabs[active].classList.remove('active');
        panels[active].classList.remove('active');
        btn.classList.add('active');
        panels[i].classList.add('active');
        active = i;

        // poczekaj 1 frame aż DOM przeliczy layout, zmierz nową wysokość i animuj
        requestAnimationFrame(() => {
          const toH = wrap.offsetHeight;
          animateWrap(fromH, toH);
        });
      });
    });
  });
});
