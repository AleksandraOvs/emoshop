<?php

/**
 * Plugin Name: Admin Notes
 * Description: Быстрые текстовые заметки прямо в админке WordPress.
 * Version: 1.0
 * Author: ChatGPT
 */

if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    add_menu_page(
        'Заметки',
        'Заметки',
        'manage_options',
        'admin-notes',
        'render_admin_notes_page',
        'dashicons-welcome-write-blog',
        25
    );
});

function render_admin_notes_page()
{
    $notes = get_option('admin_notes', []);
?>
    <div class="wrap">
        <h1>Заметки</h1>

        <textarea id="admin-note-text" rows="4" style="width:100%;" placeholder="Новая заметка..."></textarea>
        <p>
            <button class="button button-primary" id="add-admin-note">Добавить</button>
        </p>

        <div id="admin-notes-list" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;">
            <?php foreach ($notes as $id => $note): ?>
                <div class="admin-note-card" data-id="<?php echo esc_attr($id); ?>" style="background:#F7F3B6;padding:14px;border-radius:4px;box-shadow:0 2px 6px rgba(0,0,0,.08)">
                    <div style="font-size:12px;color:#777;margin-bottom:8px;">
                        <?php echo esc_html($note['date']); ?>
                    </div>
                    <textarea class="admin-note-content" style="width:100%;border:none;resize:none;height: 150px;background:transparent;"><?php echo esc_textarea($note['content']); ?></textarea>
                    <div style="margin-top:10px;display:flex;gap:8px;">
                        <button class="button save-note">Сохранить</button>
                        <button class="button button-link-delete delete-note">Удалить</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        jQuery(function($) {
            $('#add-admin-note').on('click', function() {
                let text = $('#admin-note-text').val().trim();
                if (!text) return;

                $.post(ajaxurl, {
                    action: 'admin_notes_add',
                    content: text
                }, function() {
                    location.reload();
                });
            });

            $('.save-note').on('click', function() {
                let card = $(this).closest('.admin-note-card');
                $.post(ajaxurl, {
                    action: 'admin_notes_update',
                    id: card.data('id'),
                    content: card.find('.admin-note-content').val()
                });
            });

            $('.delete-note').on('click', function() {
                if (!confirm('Удалить заметку?')) return;

                let card = $(this).closest('.admin-note-card');
                $.post(ajaxurl, {
                    action: 'admin_notes_delete',
                    id: card.data('id')
                }, function() {
                    card.remove();
                });
            });
        });
    </script>
<?php
}

add_action('wp_ajax_admin_notes_add', function () {
    if (!current_user_can('manage_options')) wp_die();

    $notes = get_option('admin_notes', []);
    if (count($notes) >= 50) wp_send_json_error();

    $id = uniqid();
    $notes[$id] = [
        'content' => sanitize_textarea_field($_POST['content']),
        'date' => current_time('d.m.Y H:i')
    ];

    update_option('admin_notes', $notes);
    wp_send_json_success();
});

add_action('wp_ajax_admin_notes_update', function () {
    if (!current_user_can('manage_options')) wp_die();

    $notes = get_option('admin_notes', []);
    $id = $_POST['id'];

    if (isset($notes[$id])) {
        $notes[$id]['content'] = sanitize_textarea_field($_POST['content']);
        update_option('admin_notes', $notes);
    }

    wp_send_json_success();
});

add_action('wp_ajax_admin_notes_delete', function () {
    if (!current_user_can('manage_options')) wp_die();

    $notes = get_option('admin_notes', []);
    unset($notes[$_POST['id']]);

    update_option('admin_notes', $notes);
    wp_send_json_success();
});
