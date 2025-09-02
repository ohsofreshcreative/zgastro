/*--- SWIPER ---*/

import Swiper from 'swiper';
import 'swiper/css';

// Dodatkowe moduły (opcjonalnie)
import { Navigation, Pagination } from 'swiper/modules';

Swiper.use([Navigation, Pagination]);
/*--- SWIPER ---*/

const swiperOptionsAnchorsSlider = {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 32,
	freeMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
};

document.addEventListener('DOMContentLoaded', function () {
const swiperContainer = document.querySelector('.mySwiper');
const swiper = new Swiper(swiperContainer, swiperOptionsAnchorsSlider);
});

const swiperReviews = {
	loop: false,
	slidesPerView: 4,
	spaceBetween: 0,
	freeMode: true,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
};

document.addEventListener('DOMContentLoaded', function () {
const swiperContainer = document.querySelector('.sliders');
const swiper = new Swiper(swiperContainer, swiperReviews);
});


/*--- SWIPER ---*/

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.swiper');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 2.5,
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