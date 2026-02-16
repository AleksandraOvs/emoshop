<?php

/**
 * Template part: Event item
 */

$post_id = get_the_ID();

// миниатюра
$image = get_the_post_thumbnail_url($post_id, 'full');

// краткое описание
$excerpt = get_the_excerpt($post_id);

// проверка тега "hot"
$is_hot = has_term('hot', 'post_tag', $post_id);
?>

<article class="event-item">
    <?php if ($is_hot): ?>
        <span class="badge">Хит</span>
    <?php endif; ?>
    <a href="<?php the_permalink() ?>" class="event-item__image">
        <?php if ($image) { ?>

            <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>">



        <?php } else {
        ?>
            <img src="<?php echo get_stylesheet_directory_uri() . '/images/svg/placeholder.svg' ?>" alt="<?php the_title_attribute(); ?>">
        <?php
        } ?>
    </a>
    <div class="event-item__content">
        <h3 class="event-item__title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>

        <?php if ($excerpt): ?>
            <div class="event-item__excerpt">
                <?php echo esc_html($excerpt); ?>
            </div>
        <?php endif; ?>
    </div>

</article>