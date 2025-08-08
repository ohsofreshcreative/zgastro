
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
	slidesPerView: 'auto',
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