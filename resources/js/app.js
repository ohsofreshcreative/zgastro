import.meta.glob(['../images/**', '../fonts/**']);

import './menubar.js';
import './footer-accordion.js';
import './swiper.js';

/*--- BLOCKS ---*/

Object.values(import.meta.glob('./blocks/*.js', { eager: true }));

/*--- GSAP ---*/

import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/*--- SWIPER ---*/

import Swiper from 'swiper';
import 'swiper/css';

// Dodatkowe moduły (opcjonalnie)
import { Navigation, Pagination } from 'swiper/modules';

Swiper.use([Navigation, Pagination]);

/*--- ALPINE ---*/

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/*--- GSAP ---*/

document.addEventListener('DOMContentLoaded', function () {
  gsap.registerPlugin(ScrollTrigger);

  // Pobieramy wszystkie sekcje ACF
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {
    // 1. Animacja dla obrazków
    let elements2 = section.querySelectorAll("[data-gsap-element='img']");
    elements2.forEach((img) => {
      gsap.from(img, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        delay: 0,
        scrollTrigger: {
          trigger: img,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    // 2. Animacja dla pozostałych elementów (nie obrazków)
    let elements = section.querySelectorAll(
      "[data-gsap-element]:not([data-gsap-element='img']):not([data-gsap-element='stagger'])"
    );
    elements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        delay: index * 0.1,
        scrollTrigger: {
          trigger: element,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    // 3. Nowa animacja — sekwencja z ręcznym opóźnieniem na data-gsap-element="stagger"
    const staggerElements = section.querySelectorAll(
      "[data-gsap-element='stagger']"
    );
    const sorted = [...staggerElements].sort((a, b) => {
      const getDelay = (el) => {
        const attr = el.getAttribute('data-gsap-edit');
        if (attr && attr.startsWith('delay-')) {
          return parseFloat(attr.replace('delay-', '')) || 0;
        }
        return 0;
      };
      return getDelay(a) - getDelay(b);
    });

    // Ustawiamy stan początkowy
    gsap.set(sorted, { opacity: 0, y: 50 });

    gsap.to(sorted, {
      opacity: 1,
      y: 0,
      filter: 'blur(0px)',
      duration: 1,
      ease: 'power2.out',
      stagger: {
        amount: 1.5,
        each: 0.1,
      },
      scrollTrigger: {
        trigger: section,
        start: 'top 80%',
        toggleActions: 'play none none none',
        once: true,
      },
    });
    // animacja linii (od lewej do prawej)
    const line = section.querySelector('.__line');
    if (line) {
      gsap.to(line, {
        scaleX: 1,
        duration: 5,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: section,
          start: 'top 80%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    }
  });
});

/*--- SWIPER ---*/

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.usage-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.offer-swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      const swiper = new Swiper(container, {
        slidesPerView: 3,
        spaceBetween: 32,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
        breakpoints: {
          0: { slidesPerView: 1.1, spaceBetween: 20 },
          768: { slidesPerView: 2.2, spaceBetween: 30 },
          1024: { slidesPerView: 3.2, spaceBetween: 32 },
        },
        on: {
          init: function () {
            updateFirstVisibleSlide(this, container);
          },
          slideChange: function () {
            updateFirstVisibleSlide(this, container);
          },
        },
      });

      // Helper function to update first visible slide
      function updateFirstVisibleSlide(swiperInstance, swiperContainer) {
        // First, remove the class from all slides within THIS specific swiper only
        const allSlides = swiperContainer.querySelectorAll('.swiper-slide');
        allSlides.forEach((slide) => {
          slide.classList.remove('first-visible-slide');
        });

        // Then, add the class only to the first visible slide of THIS swiper
        if (swiperInstance.slides[swiperInstance.activeIndex]) {
          swiperInstance.slides[swiperInstance.activeIndex].classList.add(
            'first-visible-slide'
          );
        }
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const svgs = gsap.utils.toArray('.animated-svg');

  svgs.forEach((svg, index) => {
    const path = svg.querySelector('path'); // Get the path inside the SVG

    gsap.set(path, {
      stroke: '#E30613',
      strokeWidth: 1,
      fill: 'transparent',
      strokeDasharray: 2500, // Adjust as needed
      strokeDashoffset: 2500, // Adjust as needed
    });

    let delay = 0;
    if (index === 1) {
      // Apply delay only to the second SVG
      delay = 0.2;
    }

    gsap.to(path, {
      scrollTrigger: {
        trigger: svg, // Element, który uruchamia animację
        start: 'top bottom-=200px', // Kiedy góra elementu dotknie dołu okna
        once: true, // Animacja uruchomi się tylko raz
      },
      delay: delay,
      duration: 1.5,
      strokeDashoffset: 0,
      ease: 'linear',
      onComplete: () => {
        gsap.to(path, {
          duration: 0.7,
          fill: '#E30613',
          ease: 'linear',
        });
      },
    });
  });
});

/*--- WHITE SVG ANIMATION ---*/

document.addEventListener('DOMContentLoaded', function () {
  const svgs = gsap.utils.toArray('.white-svg');

  svgs.forEach((svg, index) => {
    const path = svg.querySelector('path');

    gsap.set(path, {
      stroke: '#FFF',
      strokeWidth: 1,
      fill: 'transparent',
      strokeDasharray: 2500,
      strokeDashoffset: 2500,
    });

    let delay = 0;
    if (index === 1) {
      delay = 0.2;
    }

    gsap.to(path, {
      scrollTrigger: {
        trigger: svg, // Element, który uruchamia animację
        start: 'top bottom-=200px', // Kiedy góra elementu dotknie dołu okna
        once: true, // Animacja uruchomi się tylko raz
      },
      delay: delay,
      duration: 1.5,
      strokeDashoffset: 0,
      ease: 'linear',
      onComplete: () => {
        gsap.to(path, {
          duration: 0.7,
          fill: '#FFF',
          ease: 'linear',
        });
      },
    });
  });
});

/*--- STICKY CONTAINER ANIMATION ---*/

const tiles = gsap.utils.toArray('.gsap__cards'); // Zmieniamy selektor na sticky-container

tiles.forEach((tile, i) => {
  gsap.to(tile.querySelector('.gsap__card'), {
    // Animujemy overlap__card wewnątrz sticky-container
    scale: 0.8,
    filter: 'blur(5px)',
    scrollTrigger: {
      trigger: tile,
      start: 'top top', // Kiedy górna krawędź kafelka dotknie górnej krawędzi ekranu
      end: 'bottom top', // Kiedy dolna krawędź kafelka dotknie górnej krawędzi ekranu
      scrub: true, // Animacja podąża za przewijaniem
      markers: false, // Pokaż markery do debugowania
    },
  });
});
