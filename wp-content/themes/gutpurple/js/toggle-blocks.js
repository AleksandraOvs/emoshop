document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-block').forEach(block => {
        const items = block.querySelectorAll('.toggle-block__item');

        if (items.length === 1) {
            // Если только один элемент — показываем его и выходим
            items[0].classList.add('is-visible');
            return;
        }

        if (items.length === 0) return; // нет элементов — ничего не делаем

        let currentIndex = 1;

        const iconMore = `<!-- SVG тут -->`;

        const btnMore = document.createElement('button');
        btnMore.className = 'toggle-block__more';
        btnMore.innerHTML = iconMore + '<span>Смотреть ещё</span>';

        const btnLess = document.createElement('button');
        btnLess.className = 'toggle-block__less';
        btnLess.textContent = 'Свернуть';
        btnLess.style.display = 'none';

        // начальное состояние
        items.forEach((item, index) => {
            if (index === 0) item.classList.add('is-visible');
        });

        // кнопка сначала после первого элемента
        items[0].after(btnMore);
        block.appendChild(btnLess);

        btnMore.addEventListener('click', () => {
            if (currentIndex < items.length) {
                const item = items[currentIndex];
                item.classList.add('is-visible');

                // перемещаем кнопку после последнего открытого блока
                item.after(btnMore);
                currentIndex++;
            }

            if (currentIndex >= items.length) {
                btnMore.style.display = 'none';
                btnLess.style.display = '';
            }
        });

        btnLess.addEventListener('click', () => {
            items.forEach((item, index) => {
                if (index !== 0) item.classList.remove('is-visible');
            });

            currentIndex = 1;

            // возвращаем кнопку на место
            items[0].after(btnMore);
            btnMore.style.display = '';
            btnLess.style.display = 'none';

            items[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
});
