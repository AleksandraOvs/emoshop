document.querySelectorAll('.tabs-section').forEach(section => {
    const tabsWrapper = section.querySelector('.tabs');
    const tabsContainer = section.querySelector('.tabs-content');

    if (tabsWrapper && tabsContainer) {
        const tabs = tabsWrapper.querySelectorAll('.tab');
        const blocks = tabsContainer.querySelectorAll('.content-block');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetId = tab.dataset.tab;

                // Снимаем активность со всех табов
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Переключаем контент внутри этой секции
                blocks.forEach(b => {
                    b.classList.toggle('active', b.id === targetId);
                });
            });
        });
    }
});