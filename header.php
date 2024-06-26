<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package u3a-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();
if (is_user_logged_in()) {
    $loginText = "Logout";
    $loginLink = "/logout/?redirect_to=/login/";
} else {
    $loginText = "Member Login";
    $loginLink = "/login/";
}?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'u3a-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="head-info">
			<div class="head-wrapper">
				<p class="info-text"><?php echo esc_html(get_theme_mod('u3a_theme_info_text')); ?></p>
				<a class="login" href="<?php echo esc_url($loginLink) ?>"><?php echo $loginText ?></a>
			</div>
		</div>
		<div class="site-branding">
			<div class="head-wrapper">
				<?php the_custom_logo(); ?>
				<div class="site-branding-text">
					<?php
						$u3a_theme_description = get_bloginfo( 'description', 'display' );
						if ( $u3a_theme_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $u3a_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="hamburger-icon">&#9776</span></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div><!-- .site-branding-text -->
			</div>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->
