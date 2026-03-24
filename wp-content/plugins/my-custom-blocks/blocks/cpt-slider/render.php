<?php
if (!defined('ABSPATH')) exit;

$post_type = $attributes['postType'] ?? 'post';
$taxonomy  = $attributes['taxonomy'] ?? 'category';
$terms     = $attributes['terms'] ?? [];

if (empty($terms)) return '';

ob_start();

// ОБЁРТКА ВСЕГО БЛОКА
echo '<div class="wp-block-my-custom-blocks-cpt-slider">';

// --------------------
// ТАБЫ
// --------------------
echo '<div class="cpt-slider-categories">';
foreach ($terms as $i => $term_id) {
    $term = get_term($term_id, $taxonomy);
    if (!$term) continue;

    echo '<button class="category-tab ' . ($i === 0 ? 'active' : '') . '" data-term="' . esc_attr($term_id) . '">';
    echo esc_html($term->name);
    echo '</button>';
}
echo '</div>';

// --------------------
// СЛАЙДЕРЫ
// --------------------
foreach ($terms as $i => $term_id) {

    $query = new WP_Query([
        'post_type'      => $post_type,
        'posts_per_page' => 10,
        'tax_query'      => [
            [
                'taxonomy'         => $taxonomy,
                'field'            => 'term_id',
                'terms'            => $term_id,
                'include_children' => true,
            ]
        ]
    ]);

    if (!$query->have_posts()) continue;

    // Класс "cpt-slider" совпадает с frontend.js
    echo '<div class="cpt-slider swiper" data-term="' . esc_attr($term_id) . '">';
    echo '<div class="swiper-wrapper">';

    while ($query->have_posts()) {
        $query->the_post();

        echo '<div class="swiper-slide cpt-slider__slide">';
        echo '<a href="' . get_permalink() . '">';

        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        }

        echo '<h3>' . get_the_title() . '</h3>';
        echo '</a>';
        echo '</div>';
    }

    echo '</div>'; // .swiper-wrapper

    // Навигация и пагинация
    //  echo '<div class="swiper-button-next"></div>';
    //  echo '<div class="swiper-button-prev"></div>';
    echo '<div class="swiper-pagination"></div>';

    echo '</div>'; // .cpt-slider

    wp_reset_postdata();
}

echo '</div>'; // .wp-block-my-custom-blocks-cpt-slider

error_log('CPT Slider attributes: ' . print_r($attributes, true));

return ob_get_clean();
