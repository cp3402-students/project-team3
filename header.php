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
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'u3a-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="head-info">
			<p class="info-text">(07)466 777 777 | admin@u3aonline.org.au</p>
			<a class="login" href="/login">Members Login</a>
		</div>
		<div class="site-branding">
			<?php the_custom_logo(); ?>
            <div class="site-branding-text">
                <?php
                    $u3a_theme_description = get_bloginfo( 'description', 'display' );
                    if ( $u3a_theme_description || is_customize_preview() ) :
                        ?>
                        <p class="site-description"><?php echo $u3a_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'u3a-theme' ); ?></button>
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
		</div><!-- .site-branding -->

	</header><!-- #masthead -->
