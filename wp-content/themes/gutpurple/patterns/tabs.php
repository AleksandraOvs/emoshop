<?php

/**
 * Title: Табы
 * Slug: gutpurple/tabs
 * Categories: text, layout
 * Description: Блок с вкладками
 */
?>
<!-- wp:group {"className":"tabs-section"} -->
<div class="wp-block-group tabs-section">
    <!-- wp:group {"className":"tabs-section__header"} -->
    <div class="wp-block-group tabs-section__header">

        <!-- wp:heading {"level":2} -->
        <h2>Заголовок</h2>
        <!-- /wp:heading -->

        <!-- wp:html -->
        <div class='tabs'>
            <div class='tab active' data-tab='first'>Первая</div>
            <div class='tab' data-tab='second'>Вторая</div>
            <div class='tab' data-tab='three'>Третья</div>
            <div class='tab' data-tab='four'>Четвертая</div>
            <div class='tab' data-tab='five'>Пятая</div>
            <div class='tab' data-tab='six'>Шестая</div>
        </div>
        <!-- /wp:html -->

    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"className":"tabs-content"} -->
    <div class="wp-block-columns tabs-content">
        <!-- wp:column {"className":"content-block"} -->
        <div class="wp-block-column content-block">
            <!-- wp:image {"sizeSlug":"large"} -->
            <figure class="wp-block-image"><img src="../images/svg/placeholder.svg" alt="" /></figure>
            <!-- /wp:image -->

            <!-- wp:columns {"className":"content-text"} -->
            <div class="wp-block-columns content-text">
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:paragraph -->
                    <p>Это основной текст секции внутри контейнера.</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:heading {"level":3} -->
                    <h3>Заголовок блок</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p>Это основной текст секции внутри контейнера.</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->