<?php

$main_form_button_text = carbon_get_theme_option('crb_button_text');
$main_form_button_link = carbon_get_theme_option('crb_button_link');

if (!empty($main_form_button_link)) {
?>
    <a href="javascript:;" data-fancybox data-src="#main-form" class="button">
        <?php
        if (!empty($main_form_button_text)) {
            echo '<span>' . $main_form_button_text . '</span>';
        } else {
            echo '<span>Ссылка</span>';
        }
        ?>
    </a>
<?php
}
?>