document.addEventListener('DOMContentLoaded', function () {

  new Swiper('.hero-slider', {
    slidesPerView: 1,
    //effect: 'fade',
    // loop: true,
    pagination: {
      el: '.slider-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.slider-button-next',
      prevEl: '.slider-button-prev',
      lockClass: 'hide'
    },
  });

  new Swiper(".slider-four", {
    slidesPerView: 1,
    spaceBetween: 20,
    //loop: true,
    navigation: {
      nextEl: ".slider__button-next",
      prevEl: ".slider__button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1200: {
        slidesPerView: 4,
      },
      992: {
        slidesPerView: 2,
      },
    }
  });

  const sliders = document.querySelectorAll('.descriptions-slider');

  sliders.forEach((slider, index) => {
    const column = slider.closest('.swiper');

    // Находим кнопки и пагинацию внутри текущего блока
    const nextEl = column.querySelector('.slider__button-next');
    const prevEl = column.querySelector('.slider__button-prev');
    const paginationEl = column.querySelector('.swiper-pagination');

    // Добавляем уникальные классы
    const uniqueClassNext = `slider-next-${index}`;
    const uniqueClassPrev = `slider-prev-${index}`;
    const uniqueClassPag = `slider-pag-${index}`;

    nextEl.classList.add(uniqueClassNext);
    prevEl.classList.add(uniqueClassPrev);
    paginationEl.classList.add(uniqueClassPag);

    // Инициализация Swiper
    new Swiper(slider, {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 30,
      navigation: {
        nextEl: `.${uniqueClassNext}`,
        prevEl: `.${uniqueClassPrev}`,
      },
      pagination: {
        el: `.${uniqueClassPag}`,
        clickable: true,
      },
      // autoplay: {
      //   delay: 5000,
      //   disableOnInteraction: false,
      // },
    });
  });

});