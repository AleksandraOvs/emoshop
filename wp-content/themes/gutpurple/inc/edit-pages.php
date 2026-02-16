<?php

/**
 * ======================================================
 * КОЛОНКА "Шаблон" в списке страниц и CPT 'events' (ТОЛЬКО ОТОБРАЖЕНИЕ)
 * ======================================================
 */

// Список пост тайпов, где будет колонка
$post_types = ['page', 'events'];

// добавляем колонку для каждого типа
foreach ($post_types as $type) {
    add_filter("manage_{$type}_posts_columns", function ($columns) {
        $columns['template_page'] = 'Шаблон';
        return $columns;
    });

    add_action("manage_{$type}_posts_custom_column", function ($column, $post_id) {
        if ($column !== 'template_page') {
            return;
        }

        $template = carbon_get_post_meta($post_id, 'template_page');

        if (empty($template) || empty($template[0]['id'])) {
            echo '<span style="color:#999;">— не выбран —</span>';
            return;
        }

        $template_id = (int) $template[0]['id'];
        $template_post = get_post($template_id);

        if (!$template_post) {
            echo '<span style="color:#c00;">(шаблон не найден)</span>';
            return;
        }

        $slug = urldecode($template_post->post_name);

        echo '<span>Установлен шаблон:</span>';
        echo '<br><strong style="color:#666;font-size:12px;">';
        echo esc_html($slug);
        echo '</strong>';
    }, 10, 2);
}
