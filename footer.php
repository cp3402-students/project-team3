<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package u3a-theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-columns">
			<?php dynamic_sidebar('footer_area_one'); ?>
			<?php dynamic_sidebar('footer_area_two'); ?>
			<?php dynamic_sidebar('footer_area_three'); ?>
		</div>
		<div class="site-info">
			<?php get_theme_mod('u3a_theme_footer_copyright'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
