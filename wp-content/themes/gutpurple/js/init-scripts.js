// ================= RELOAD STYLES =================
function reloadGutenbergStyles() {
    const styles = [
        '/wp-includes/css/dist/block-library/style.min.css',
        '/wp-includes/css/dist/block-library/theme.min.css'
    ];

    styles.forEach(href => {
        if (!document.querySelector(`link[href*="${href}"]`)) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            document.head.appendChild(link);
        }
    });
}

// ================= INIT =================
function initFrontend() {

    initTabs();
    initCptSlider();
    //initFancybox();
    //initSmoothScroll();
    //initArrowUp();
    //initMenu();
    //initDropdowns();
    //initNumbers();
    //initSwiper();
    //initFaq();

}

// ================= TABS =================
function initTabs(root = document) {

    const sections = root.querySelectorAll('.tabs-section'); // обёртка для каждого блока

    sections.forEach(section => {

        const tabsWrapper = section.querySelector('.tabs');
        const tabsContainer = section.querySelector('.tabs-content');

        if (!tabsWrapper || !tabsContainer) return;

        const tabs = tabsWrapper.querySelectorAll('.tab');
        const blocks = tabsContainer.querySelectorAll('.content-block');

        tabs.forEach(tab => {

            if (tab.dataset.init) return;
            tab.dataset.init = "1";

            tab.addEventListener('click', () => {

                const targetId = tab.dataset.tab;

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                blocks.forEach(b => {
                    b.classList.toggle('active', b.id === targetId);
                });

            });
        });

    });
}

function initCptSlider() {
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
}

// ================= START =================
document.addEventListener('DOMContentLoaded', initFrontend);

// важно для AJAX
window.initFrontend = initFrontend;

// ================= DEBUG =================
window.debugStyles = function () {

    const styles = [...document.styleSheets];

    const result = styles.map((sheet, index) => {
        let href = sheet.href || 'INLINE STYLE';

        let rulesCount = null;

        try {
            rulesCount = sheet.cssRules ? sheet.cssRules.length : 0;
        } catch (e) {
            rulesCount = 'NO ACCESS (CORS)';
        }

        return {
            index,
            href,
            rules: rulesCount
        };
    });

    console.table(result);
    return result;
};