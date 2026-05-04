<?php
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_script(
        'ajax-page',
        get_template_directory_uri() . '/js/ajax-blocks.js',
        [],
        null,
        true
    );

    wp_localize_script('ajax-page', 'myAjax', [
        'url' => '/wp-admin/admin-ajax.php'
    ]);
});


add_action('wp_ajax_load_template_content', 'load_template_content');
add_action('wp_ajax_nopriv_load_template_content', 'load_template_content');

function load_template_content()
{

    $page_id = intval($_POST['page_id']);

    if (!$page_id) {
        wp_send_json_error('No page ID');
    }

    // 🔥 берём template_page из Carbon Fields
    $template = carbon_get_post_meta($page_id, 'template_page');

    if (empty($template)) {
        wp_send_json_error('Шаблон не назначен');
    }

    $template_id = $template[0]['id'];

    $post = get_post($template_id);

    if (!$post) {
        wp_send_json_error('Шаблон не найден');
    }

    setup_postdata($post);

    ob_start();

    echo '<div class="page-content" id="content">';

    echo apply_filters('the_content', $post->post_content);

    echo '</div>';

    wp_reset_postdata();

    wp_send_json_success(ob_get_clean());
}
