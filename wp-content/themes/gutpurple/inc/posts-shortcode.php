<?php
add_shortcode('list_posts', function ($atts) {

    $atts = shortcode_atts([
        'post_type'       => 'post',
        'tag'             => '',
        'posts_per_page'  => 6,
        'slider'          => 'false', // true / false
    ], $atts, 'list_posts');

    $is_slider = filter_var($atts['slider'], FILTER_VALIDATE_BOOLEAN);

    $args = [
        'post_type'      => $atts['post_type'],
        'posts_per_page' => (int) $atts['posts_per_page'],
        'post_status'    => 'publish',
    ];

    // Фильтр по тегу (если указан)
    if (!empty($atts['tag'])) {
        if ($atts['post_type'] === 'post') {
            $args['tag'] = sanitize_text_field($atts['tag']);
        } else {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($atts['tag']),
                ]
            ];
        }
    }

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '';
    }

    ob_start();

    // ---------- ОБЁРТКА ----------
    if ($is_slider) {
        echo '<div class="swiper list-posts-slider">';
        echo '<div class="swiper-wrapper">';
    } else {
        echo '<div class="list-posts">';
    }

    // ---------- ЦИКЛ ----------
    while ($query->have_posts()) {
        $query->the_post();

        if ($is_slider) {
            echo '<div class="swiper-slide">';
        }

        if ($atts['post_type'] === 'events') {
            get_template_part('template-parts/event-item');
        } else {
            get_template_part('template-parts/post-item');
        }

        if ($is_slider) {
            echo '</div>';
        }
    }

    // ---------- ЗАКРЫТИЕ ----------
    if ($is_slider) {
        echo '</div>'; // swiper-wrapper
        echo '<div class="swiper-pagination"></div>';
        echo '</div>'; // swiper
    } else {
        echo '</div>';
    }

    wp_reset_postdata();

    // ---------- ИНИЦИАЛИЗАЦИЯ SWIPER ----------
    if ($is_slider) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.list-posts-slider', {
                    slidesPerView: 1.4,
                    spaceBetween: 16,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2.4,
                        },
                        1024: {
                            slidesPerView: 3,
                        }
                    }
                });
            });
        </script>
<?php
    endif;

    return ob_get_clean();
});
