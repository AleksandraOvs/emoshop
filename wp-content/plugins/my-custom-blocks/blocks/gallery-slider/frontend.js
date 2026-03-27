document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.gallery-slider');

    sliders.forEach(slider => {
        new Swiper(slider, {
            slidesPerView: 1,
            spaceBetween: 7,
            loop: false,

            pagination: {
                el: slider.querySelector('.swiper-pagination'),
                clickable: true
            },

            navigation: {
                nextEl: slider.querySelector('.slider__button-next'),
                prevEl: slider.querySelector('.slider__button-prev'),
            },
        });
    });
});