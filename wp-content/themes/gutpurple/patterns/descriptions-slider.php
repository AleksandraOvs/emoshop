<?php

/**
 * Title: Слайдер с описаниями
 * Slug: gutpurple/descriptions-slider
 * Categories: text, layout
 * Description: Слайдер с описаниями.
 */
?>

<!-- wp:group {"align":"full","className":"descriptions-section"} -->
<div class="wp-block-group alignfull descriptions-section">
    <!-- wp:columns -->
    <div class="wp-block-columns">
        <!-- wp:column {"className":"descriptions-title"} -->
        <div class="wp-block-column descriptions-title">
            <!-- wp:heading {"level":2} -->
            <h2>Заголовок 1</h2>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:columns {"className":"swiper descriptions-slider"} -->
    <div class="wp-block-columns swiper descriptions-slider">
        <!-- wp:column {"className":"swiper-wrapper"} -->
        <div class="wp-block-column swiper-wrapper">
            <!-- wp:group {"className":"swiper-slide descriptions-slider__swiper-slide"} -->
            <div class="wp-block-group swiper-slide descriptions-slider__swiper-slide">
                <!-- wp:columns {"className":"description-card"} -->
                <div class="wp-block-columns description-card">
                    <!-- wp:column {"className":"description-content"} -->
                    <div class="wp-block-column description-content"></div>
                    <!-- /wp:column -->

                    <!-- wp:column {"className":"description-img"} -->
                    <div class="wp-block-column description-img">
                        <!-- wp:image -->
                        <figure class="wp-block-image"><img src="" alt=""></figure>
                        <!-- /wp:image -->
                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:html -->
        <div class="sliders-controls">
            <div class="slider__button-prev">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="15" transform="rotate(-180 15 15)" fill="#2A2A2A" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1834 14.1834L15.8369 9.53004L17 10.6932L12.9282 14.765L17 18.8369L15.8369 20L11.1834 15.3466C11.0292 15.1923 10.9426 14.9831 10.9426 14.765C10.9426 14.5469 11.0292 14.3377 11.1834 14.1834Z" fill="white" />
                </svg>

            </div>
            <div class="slider__button-next">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="15" fill="#2A2A2A" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8166 15.8166L14.1631 20.47L13 19.3068L17.0718 15.235L13 11.1631L14.1631 10L18.8166 14.6534C18.9708 14.8077 19.0574 15.0169 19.0574 15.235C19.0574 15.4531 18.9708 15.6623 18.8166 15.8166Z" fill="white" />
                </svg>

            </div>

            <div class="slider-pagination swiper-pagination"></div>
        </div>
        <!-- /wp:html -->

    </div>
    <!-- /wp:columns -->


</div>
<!-- /wp:group -->