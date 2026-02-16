<?php
// ID текущего поста
$post_id = get_the_ID();

// Получаем ID изображений
$hero_pic_desktop_id = carbon_get_post_meta($post_id, 'crb_dest_hero_pic');
$hero_pic_mobile_id  = carbon_get_post_meta($post_id, 'crb_dest_hero_pic_mob');

// Преобразуем в URL через wp_get_attachment_image_url()
$hero_pic_desktop = wp_get_attachment_image_url($hero_pic_desktop_id, 'full');
$hero_pic_mobile  = wp_get_attachment_image_url($hero_pic_mobile_id, 'full');

// Остальные поля
$h1_title    = carbon_get_post_meta($post_id, 'crb_dest_h1');
$description = carbon_get_post_meta($post_id, 'crb_dest_description');

$button_text = carbon_get_post_meta($post_id, 'crb_dest_hero_button');
$button_link = carbon_get_post_meta($post_id, 'crb_dest_hero_button_link');
?>

<section class="hero">
    <div class="container">
        <picture>
            <?php if ($hero_pic_mobile): ?>
                <source media="(max-width:576px)" srcset="<?php echo esc_url($hero_pic_mobile); ?>">
            <?php endif; ?>
            <?php if ($hero_pic_desktop): ?>
                <img src="<?php echo esc_url($hero_pic_desktop); ?>" alt="<?php echo esc_attr($h1_title); ?>">
            <?php endif; ?>
        </picture>

        <div class="hero-content">

            <div class="hero-content__inner">
                <?php if ($h1_title): ?>
                    <h1><?php echo $h1_title ?></h1>
                <?php endif; ?>

                <?php if ($description): ?>
                    <div class="hero-description">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <?php if ($button_text && $button_link): ?>
                    <a class="button-link" href="<?php echo esc_url($button_link); ?>">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>



    </div>


</section>