<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gutpurple
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- <div class="page-inner"> -->
	<?php
	$template_id = carbon_get_the_post_meta('template_page')[0]['id'] ?? null;

	if ($template_id) {

		// выводим контент шаблона
		$template_post = get_post($template_id);

		if ($template_post) {

			echo apply_filters('the_content', $template_post->post_content);
		}

		// выводим контент страницы ПОД шаблоном
		while (have_posts()) :
			the_post();
			echo '<div class="container">';
			get_template_part('template-parts/content', 'page');
			echo '</div>';

			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile;
	} else {

		// стандартный режим — только контент страницы
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content', 'page');

			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile;
	}
	?>

	<?php
	$seo_text = carbon_get_post_meta(get_the_ID(), 'seo_text');

	if (!empty($seo_text)) {
		echo '<div class="fixed-container">';
		echo $seo_text;
		echo '</div>';
	}
	?>



	<!-- </div> -->



</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
