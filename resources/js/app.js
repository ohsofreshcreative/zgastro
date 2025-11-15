// --- IMPORTY (WSZYSTKO OPRÓCZ GSAP) ---
import.meta.glob(['../images/**', '../fonts/**']);

import './menubar.js';
import './footer-accordion.js';
import './swiper.js';

/*--- BLOCKS ---*/
Object.values(
  import.meta.glob('./blocks/*.js', {
    eager: true
  }));

/*--- ALPINE ---*/
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


// --- GŁÓWNA LOGIKA APLIKACJI (W TYM GSAP Z CDN) ---
// Używamy 'load', aby mieć pewność, że skrypty GSAP z CDN zostały w pełni załadowane.
window.addEventListener('load', () => {

  // Sprawdzamy, czy GSAP z CDN jest dostępny, zanim cokolwiek zrobimy
  if (!window.gsap) {
    console.error("GSAP nie został załadowany z CDN. Sprawdź, czy skrypty są w app.blade.php.");
    return;
  }

  // Przypisujemy globalny gsap do stałej dla wygody i rejestrujemy wtyczkę
  const gsap = window.gsap;
  gsap.registerPlugin(ScrollTrigger);

  console.log("GSAP z CDN załadowany poprawnie. Inicjalizuję animacje...");

  /*--- GSAP - Kompletny skrypt animacji ---*/
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {

    // 1. ANIMACJA ODKRYWANIA OBRAZKA (REVEAL EFFECT Z MASKĄ CSS)
    const revealImages = section.querySelectorAll("[data-gsap-element='img-left'], [data-gsap-element='img-right']");
    revealImages.forEach((wrapper) => {
      const img = wrapper.querySelector('img');
      const direction = wrapper.dataset.gsapElement;
      gsap.set(img, {
        opacity: 0,
        scale: 1.5,
        autoAlpha: 1
      });
      let mask = (direction === 'img-left') ? 'inset(0% 100% 0% 0%)' : 'inset(0% 0% 0% 100%)';
      gsap.set(wrapper, {
        clipPath: mask
      });

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: wrapper,
          start: 'top 85%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
      tl.to(wrapper, {
          clipPath: 'inset(0% 0% 0% 0%)',
          duration: 0.8,
          ease: 'power3.inOut'
        })
        .to(img, {
          scale: 1,
          opacity: 1,
          duration: 0.8,
          ease: 'power3.inOut'
        }, "<");
    });

    // 2. STANDARDOWA ANIMACJA OBRAZKÓW (FADE IN UP)
  const standardImages = section.querySelectorAll("[data-gsap-element='img']");
standardImages.forEach((img) => {

  // Tworzymy oś czasu dla tej jednej animacji
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: img,
      start: 'top 70%',
      toggleActions: 'play none none none',
      once: true,
    }
  });

  // Dodajemy animację do osi czasu z opóźnieniem
  tl.from(img, {
    scale: 1.03,
    duration: 0.85,
    ease: 'power2.out',
    opacity: 0,
  }, "+=0.5"); // To oznacza "uruchom 1 sekundę PO tym, jak oś czasu się zacznie"

});

    // 3. ANIMACJA DLA POZOSTAŁYCH ELEMENTÓW
    const otherElements = section.querySelectorAll("[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])");
    otherElements.forEach((element, index) => {

      gsap.from(element, {
        opacity: 0,
        scale: 1.05,
        duration: 0.8,
        ease: 'power2.out',
        delay: index * 0.3,
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    // 4. ANIMACJA Z OPÓŹNIENIEM (STAGGER)
    const staggerElements = section.querySelectorAll("[data-gsap-element='stagger']");
    if (staggerElements.length > 0) {
      const sorted = [...staggerElements].sort((a, b) => {
        const getDelay = (el) => (el.getAttribute('data-gsap-edit') || '').startsWith('delay-') ? parseFloat(el.getAttribute('data-gsap-edit').replace('delay-', '')) || 0 : 0;
        return getDelay(a) - getDelay(b);
      });
      gsap.set(sorted, {
        opacity: 0,
        y: 50
      });
      gsap.to(sorted, {
        opacity: 0,
        scale: 1.05,
        duration: 0.8,
        ease: 'power2.out',
        delay: index * 0.3,
        scrollTrigger: {
          trigger: element,
          start: 'top 85%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    }
  });

  /*--- Skrypt do przewijania ---*/
  const scrollArrows = document.querySelectorAll('.js-scroll-to-next');
  scrollArrows.forEach(arrow => {
    arrow.addEventListener('click', function (event) {
      event.preventDefault();
      const currentSection = this.closest('section');
      if (currentSection && currentSection.nextElementSibling) {
        const offset = 104;
        const sectionTopPosition = currentSection.nextElementSibling.getBoundingClientRect().top + window.scrollY;
        const targetPosition = sectionTopPosition - offset;
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

}); // Koniec window.addEventListener('load', ...)


