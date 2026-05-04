document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('ajax-content');
    if (!container) return;

    const pageId = container.dataset.pageId;

    const data = new FormData();
    data.append('action', 'load_template_content');
    data.append('page_id', pageId);

    // loader (по желанию)
    container.innerHTML = '<div class="loading">Загрузка...</div>';

    fetch(myAjax.url, {
        method: 'POST',
        body: data
    })
        .then(res => res.json())
        .then(res => {

            if (!res.success) {
                container.innerHTML = 'Ошибка загрузки';
                return;
            }

            // вставляем HTML
            container.innerHTML = res.data;
            reloadGutenbergStyles();

            // ❗ ГЛАВНОЕ — переинициализация фронта
            if (typeof window.initFrontend === 'function') {
                window.initFrontend();
            }

        })
        .catch(err => {
            console.error('AJAX error:', err);
            container.innerHTML = 'Ошибка загрузки';
        });

});
