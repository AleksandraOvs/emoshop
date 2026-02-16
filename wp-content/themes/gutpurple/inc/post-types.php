<?php

//add_action('init', 'register_post_types');

function register_event_types()
{

    // CPT: Виды мероприятий
    register_post_type('events', [
        'label'  => null,
        'labels' => [
            'name'               => 'Виды мероприятий',
            'singular_name'      => 'Вид мероприятия',
            'add_new'            => 'Добавить мероприятие',
            'add_new_item'       => 'Добавление мероприятия',
            'edit_item'          => 'Редактировать мероприятие',
            'new_item'           => 'Новое мероприятие',
            'view_item'          => 'Перейти',
            'search_items'       => 'Искать мероприятие',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Виды мероприятий',
        ],
        'description'            => '',
        'public'                 => true,
        'show_in_nav_menus'      => true,
        'show_in_menu'           => true,
        'show_in_rest'           => true,
        'menu_position'          => 2,
        'menu_icon'              => 'dashicons-calendar', // можно заменить на свой svg
        'hierarchical'           => false,
        'supports'               => ['title', 'editor', 'excerpt', 'thumbnail'],
        'taxonomies'             => ['post_tag'], // поддержка тегов
        'has_archive'            => true,
        'rewrite'                => [
            'slug' => 'events',
            'with_front' => false,
        ],
        'query_var'              => 'events',
    ]);

    // Таксономия: Категории мероприятий
    register_taxonomy('event_category', ['events'], [
        'labels' => [
            'name'              => 'Категории мероприятий',
            'singular_name'     => 'Категория мероприятия',
            'search_items'      => 'Найти категорию',
            'all_items'         => 'Все категории',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Обновить категорию',
            'add_new_item'      => 'Добавить категорию',
            'new_item_name'     => 'Название категории',
            'menu_name'         => 'Категории мероприятий',
        ],
        'hierarchical'      => true, // как рубрики
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => [
            'slug' => 'event-category',
            'with_front' => false,
        ],
    ]);
}

// Хук для регистрации CPT и таксономий
add_action('init', 'register_event_types');


function register_template_post_type()
{
    register_post_type('custom_template', [
        'labels' => [
            'name' => 'Шаблоны',
            'singular_name' => 'Шаблон',
            'add_new' => 'Добавить шаблон',
            'add_new_item' => 'Добавить новый шаблон',
            'edit_item' => 'Редактировать шаблон',
            'new_item' => 'Новый шаблон',
            'view_item' => 'Просмотреть шаблон',
            'search_items' => 'Поиск шаблонов',
            'not_found' => 'Шаблоны не найдены',
            'menu_name' => 'Шаблоны',
        ],
        'public' => true, // ✅ обязательно true, чтобы включился Gutenberg
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // ✅ без этого Gutenberg не заработает
        'supports' => ['title', 'editor'], // ✅ поддержка редактора
        'menu_icon' => 'dashicons-layout',
        'has_archive' => false,
        'rewrite' => false,
        'publicly_queryable' => false, // можно отключить вывод на фронте
    ]);
}
add_action('init', 'register_template_post_type');

add_action('pre_get_posts', function ($query) {
    if (
        !is_admin() &&
        $query->is_main_query() &&
        $query->is_tag()
    ) {
        $query->set('post_type', ['post', 'events']);
    }
});
