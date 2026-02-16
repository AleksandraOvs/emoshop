<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gutpurple
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">

		<header class="page-header">
			<ul class="breadcrumbs__list">
				<?php site_breadcrumbs(); ?>
			</ul>
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</header><!-- .page-header -->
		<div class="archive-inner">
			<?php get_sidebar(); ?>


			<div class="archive-inner <?php echo is_active_sidebar('sidebar-1') ? 'has-sidebar' : 'no-sidebar'; ?>">

				<?php if (have_posts()) : ?>
				<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
						get_template_part('template-parts/event-item');

					endwhile;

					the_posts_navigation();

				else :

					get_template_part('template-parts/content', 'none');

				endif;
				?>
			</div>

		</div>
	</div>



</main><!-- #main -->

<?php

get_footer();
