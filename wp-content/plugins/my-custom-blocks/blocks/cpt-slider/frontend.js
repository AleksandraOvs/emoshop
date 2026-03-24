document.addEventListener('DOMContentLoaded', function () {

    const blocks = document.querySelectorAll('.wp-block-my-custom-blocks-cpt-slider');

    blocks.forEach(block => {

        const tabs = block.querySelectorAll('.category-tab');
        const sliders = block.querySelectorAll('.cpt-slider');

        if (!tabs.length || !sliders.length) return;

        let swipers = [];

        // 🔹 Инициализация всех слайдеров
        sliders.forEach((slider, index) => {

            const instance = new Swiper(slider, {
                slidesPerView: 1.2,
                spaceBetween: 10,
                loop: false,

                navigation: {
                    nextEl: slider.querySelector('.swiper-button-next'),
                    prevEl: slider.querySelector('.swiper-button-prev'),
                },

                pagination: {
                    el: slider.querySelector('.swiper-pagination'),
                    clickable: true,
                },

                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 }
                }
            });

            swipers.push(instance);
        });

        // 🔹 Показываем первый слайдер и активный таб
        if (sliders.length && tabs.length) {
            sliders.forEach((slider, index) => {
                if (index === 0) {
                    slider.classList.add('active-slider');
                    slider.classList.remove('hidden-slider');
                } else {
                    slider.classList.remove('active-slider');
                    slider.classList.add('hidden-slider');
                }
            });

            tabs[0].classList.add('active');
        }

        // 🔹 Клик по табу
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {

                const term = this.dataset.term;

                // активный таб
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                sliders.forEach((slider, index) => {
                    if (slider.dataset.term == term) {
                        slider.classList.add('active-slider');
                        slider.classList.remove('hidden-slider');

                        setTimeout(() => {
                            if (swipers[index]) swipers[index].update();
                        }, 50);

                    } else {
                        slider.classList.remove('active-slider');
                        slider.classList.add('hidden-slider');
                    }
                });
            });
        });

    });

});