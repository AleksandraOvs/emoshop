<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gutpurple
 */

?>

<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package untheme
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-columns">

			<div class="footer-columns__first">
				<?php
				$footer_logo = get_theme_mod('footer_logo');
				$img = wp_get_attachment_image_src($footer_logo, 'full');
				if ($img) : echo '<a class="custom-logo-link" href="' . site_url() . '"><img src="' . $img[0] . '" alt=""></a>';
				endif;
				?><p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>

			</div>


			<?php if (is_active_sidebar('footer-sidebar-1')) : ?>
				<div class="footer-col">
					<?php dynamic_sidebar('footer-sidebar-1'); ?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('footer-sidebar-2')) : ?>
				<div class="footer-col">
					<?php dynamic_sidebar('footer-sidebar-2'); ?>
				</div>
			<?php endif; ?>


			<div class="footer-col contacts-col">
				<?php get_template_part('template-parts/contacts-block') ?>
			</div>
		</div>


		<?php if (is_active_sidebar('footer-sidebar-3')) : ?>
			<div class="footer-col-bottom">
				<?php dynamic_sidebar('footer-sidebar-3'); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php
	if (current_user_can('administrator')) {
	?>
		<div class="show-temp"><?php echo get_current_template(); ?> </div>
	<?php
	}
	?>


</footer><!-- #colophon -->
<?php //get_template_part('template-parts/floating-buttons') 
?>


</div><!-- #page -->
<div class="arrow-up">
	<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M1.06 7.13395L1.64189e-06 6.07295L5.777 0.293951C5.86957 0.200796 5.97965 0.126867 6.1009 0.0764194C6.22215 0.0259715 6.35218 1.87563e-07 6.4835 1.93303e-07C6.61483 1.99044e-07 6.74486 0.0259715 6.86611 0.0764195C6.98736 0.126867 7.09743 0.200796 7.19 0.293951L12.97 6.07295L11.91 7.13295L6.485 1.70895L1.06 7.13395Z" fill="white" />
	</svg>

</div>
<?php wp_footer(); ?>

<div class="mobile-menu">
	<nav id="mobile-navigation" class="mobile-navigation">
		<?php wp_nav_menu([
			'container' => false,
			'theme_location' => 'menu-main',
			'walker' => new My_Custom_Walker_Nav_Menu,
			'depth' => 2,
		]); ?>

	</nav><!-- #site-navigation -->
</div>
</body>

</html>