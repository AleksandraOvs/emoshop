<?php
defined('ABSPATH') || exit;

$items = $attributes['items'] ?? [];
if (!$items) return '';
?>

<div class="gallery-slider swiper">
    <div class="swiper-wrapper">

        <?php
        $chunks = array_chunk($items, 4); // делим по 4 картинки на слайд
        foreach ($chunks as $group) :
        ?>
            <div class="swiper-slide gallery-slider__slide">
                <?php foreach ($group as $item) : ?>
                    <?php if (!empty($item['url'])) : ?>
                        <a href="<?php echo esc_url($item['link'] ?: $item['url']); ?>" data-fancybox="gallery-slider" data-caption="<?php echo esc_attr($item['title'] ?? ''); ?>">
                            <img src="<?php echo esc_url($item['url']); ?>" alt="<?php echo esc_attr($item['alt'] ?? ''); ?>">
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="swiper-controls">

        <div class="slider__button-prev">
            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.16 7L1.91 7L7.16 12.25L6.5 13L7.75117e-08 6.5L6.5 7.75117e-08L7.16 0.75L1.91 6L14.16 6L14.16 7Z" fill="black" />
            </svg>
        </div>
        <div class="swiper-pagination"></div>
        <div class="slider__button-next">
            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.00015614 6L12.2502 6L7.00016 0.75L7.66016 -2.84124e-07L14.1602 6.5L7.66016 13L7.00016 12.25L12.2502 7L0.000156097 7L0.00015614 6Z" fill="black" />
            </svg>

        </div>


    </div>

</div>