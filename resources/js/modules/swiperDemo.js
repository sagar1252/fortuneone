import Swiper from 'swiper';

export function initSwiper() {
    const swiperContainer = document.querySelector('.swiper-demo');
    if (swiperContainer) {
        new Swiper(swiperContainer, {
            speed: 800,
            spaceBetween: 30,
            slidesPerView: 'auto',
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            }
        });
    }
}
