<?php
get_header();
?>

<main id="primary" class="site-main">

	<!-- AJAX контейнер -->
	<div id="ajax-content"
		data-page-id="<?php echo get_the_ID(); ?>">

		<div class="loading">
			<span></span><span></span><span></span>
		</div>

	</div>

	<?php
	// ==============================
	// GUTENBERG КОНТЕНТ СТРАНИЦЫ
	// ==============================

	while (have_posts()) :
		the_post();

		$content = apply_filters('the_content', get_the_content());

		if (!empty(trim($content))) {
			echo '<div class="editor-page-content container">';
			echo $content;
			echo '</div>';
		}

	endwhile;
	?>

</main>

<?php
get_footer();
