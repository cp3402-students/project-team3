<?php
/**
 * u3a-theme Theme Customizer
 *
 * @package u3a-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function u3a_theme_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'u3a_theme_site_text', [
		'title' => __('Site Text'),
		'description' => __( 'Change site text here' ),
		'priority' => 160,
		'capability' => 'edit_theme_options',
	]);

    // New Section for u3a homepage settings
    $wp_customize->add_section( 'u3a_theme_homepage_settings', array(
        'title'       => __( 'U3A Homepage Control', 'u3a-theme' ),
        'priority'    => 30,
        'description' => __( 'Customize the layout of your site homepage', 'u3a-theme' )
    ) );


    // Header info text
	$wp_customize->add_setting('u3a_theme_info_text', [
		'default'           => __( '(07)466 777 777 | admin@u3aonline.org.au'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	]);
	$wp_customize->add_control('u3a_theme_info_text', [
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'u3a_theme_site_text',
		'label'       => __('Header Info'),
		'description' => __('Text that appears on the top right-hand corner')
	]);
	$wp_customize->selective_refresh->add_partial('u3a_theme_info_text', [
		'selector'            => '.info-text',
		'container_inclusive' => false,
		'render_callback'     => function() {
			echo get_theme_mod('u3a_theme_info_text');
		},
	]);

	// Footer copyright text
	$wp_customize->add_setting('u3a_theme_footer_copyright', [
		'default'           => __( 'Copyright © 2024, All Rights Reserved'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	]);

	$wp_customize->add_control('u3a_theme_footer_copyright', [
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'u3a_theme_site_text',
		'label'       => __('Header Info'),
		'description' => __('Text that appears on the bottom of the page')
	]);

	$wp_customize->selective_refresh->add_partial('u3a_theme_footer_copyright', [
		'selector'            => '.site-info',
		'container_inclusive' => false,
		'render_callback'     => function() {
			echo get_theme_mod('u3a_theme_footer_copyright');
		},
	]);

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'u3a_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'u3a_theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'u3a_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function u3a_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function u3a_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function u3a_theme_customize_preview_js() {
	wp_enqueue_script( 'u3a-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'u3a_theme_customize_preview_js' );
