<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;



add_action('carbon_fields_register_fields', 'site_carbon');
function site_carbon()
{
    Container::make('theme_options', 'Контакты')

        ->set_page_menu_position(2)
        ->set_icon('dashicons-megaphone')
        ->add_tab(__('Контакты'), [

            Field::make('image', 'crb_address_icon', 'Иконка')
                ->set_width(50),
            Field::make('rich_text', 'crb_address', 'Адреса')
                ->set_width(50),


            Field::make('complex', 'crb_links', 'Инфо-ссылки')
                ->help_text('Ссылки для отображения информации в header и footer')
                ->add_fields(array(
                    Field::make('image', 'crb_link_icon', 'Иконка')
                        ->set_width(33),
                    Field::make('text', 'crb_link_text', 'Текст ссылки')
                        ->set_width(33),
                    Field::make('text', 'crb_link', 'Ссылка')
                        ->set_width(33)
                )),

            Field::make('complex', 'crb_contacts', 'Мессенджеры')
                ->add_fields(array(
                    Field::make('image', 'crb_contact_image', 'Иконка')
                        ->set_width(33),
                    Field::make('text', 'crb_contact_name', 'Название')
                        ->set_width(33),
                    Field::make('text', 'crb_contact_link', 'Ссылка')
                        ->set_width(33),
                )),

            Field::make('text', 'crb_button_text', 'Кнопка')
                ->set_width(50),
            Field::make('text', 'crb_button_link', 'Ссылка кнопки')
                ->set_width(50)
                ->set_default_value('#main-form'),
        ])

        ->add_tab(__('Код карты'), [
            Field::make('text', 'crb_map_code', 'Код карты'),
            Field::make('rich_text', 'crb_map_text', 'Текстовая область блока карты')
        ])

        ->add_tab(__('Формы обратной связи'), [

            Field::make('text', 'crb_mainform_shortcode', 'Шорткод для главной формы обратной связи'),

            Field::make('rich_text', 'crb_main_form_head', 'Заголовок формы')
                ->set_width(50),
            Field::make('image', 'crb_main_form_img', 'Изображение')
                ->set_width(50),
            Field::make('text', 'crb_main_form_link', 'Ссылка')
                ->set_default_value('#main-form')
                ->set_width(50),
            Field::make('text', 'crb_main_form_text', 'Текст ссылки')
                ->set_default_value('Оставить заявку')
                ->set_width(50),
        ]);

    Container::make('post_meta', 'Контент главной страницы')
        ->where('post_id', '=', get_option('page_on_front')) // условие

        ->add_tab('Первый экран', array(

            Field::make('image', 'crb_dest_hero_pic', 'Фоновое изображение (desktop)')
                ->set_width(50),
            Field::make('image', 'crb_dest_hero_pic_mob', 'Фоновое изображение (mobile)')
                ->set_width(50)
                ->help_text('Изображение применится при ширине экрана <576px'),

            Field::make('text', 'crb_dest_h1', 'Заголовок H1')
                ->set_width(50),
            Field::make('rich_text', 'crb_dest_description', 'Подзаголовок')
                ->set_width(50),

            Field::make('text', 'crb_dest_hero_button', 'Текст кнопки')
                ->set_width(50),

            Field::make('text', 'crb_dest_hero_button_link', 'Ссылка кнопки')
                ->set_width(50),
        ));

    Container::make('post_meta', 'Настройки шаблона')
        ->where('post_type', '=', 'page')   // старая строка
        // меняем на условие для нескольких типов
        ->where('post_type', 'IN', ['page', 'events'])
        ->add_fields([
            Field::make('association', 'template_page', 'Выберите шаблон')
                ->set_types([
                    [
                        'type'      => 'post',
                        'post_type' => 'custom_template',
                    ]
                ]),

            Field::make('rich_text', 'seo_text', 'SEO текст')
        ]);
}
