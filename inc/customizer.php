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

    // Visitor heading
    $wp_customize->add_setting('u3a_cta_visitor_heading', array(
        'default'           => __( 'Join Today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_visitor_heading', array(
        'type'        => 'text',
        'priority'    => 30,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Visitor Call to Action Heading'),
        'description' => __('The call to action heading text for non-logged in users.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-heading',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_visitor_heading');
        },
    ));

    // Visitor paragraph
    $wp_customize->add_setting('u3a_cta_visitor_text', array(
        'default'           => __( 'Become a member today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_visitor_text', array(
        'type'        => 'text',
        'priority'    => 30,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Visitor Call to Action Paragraph'),
        'description' => __('The call to action text below the heading for non-logged in users.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-text',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_visitor_text');
        },
    ));

    // Visitor button text
    $wp_customize->add_setting('u3a_cta_visitor_button_text', array(
        'default'           => __( 'Become a member today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_visitor_button_text', array(
        'type'        => 'text',
        'priority'    => 30,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Visitor Call to Action Button Text'),
        'description' => __('The call to action text on the button.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-btn',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_visitor_button_text');
        },
    ));

    // Visitor button link
    $wp_customize->add_setting('u3a_cta_visitor_button_link', array(
        'default'           => __( ''),
        'sanitize_callback' => 'sanitize_url',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_visitor_button_link', array(
        'type'        => 'url',
        'priority'    => 30,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Visitor Call to Action Button Link'),
        'description' => __('Where the user should go when they click the button.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-link',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_visitor_button_link');
        },
    ));

    // Non-member heading
    $wp_customize->add_setting('u3a_cta_non_member_heading', array(
        'default'           => __( 'Join Today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_non_member_heading', array(
        'type'        => 'text',
        'priority'    => 20,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Non-member Call to Action Heading'),
        'description' => __('The call to action heading text for accounts that are not members.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-heading',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_non_member_heading');
        },
    ));

    // Non-member paragraph
    $wp_customize->add_setting('u3a_cta_non_member_text', array(
        'default'           => __( 'Become a member today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_non_member_text', array(
        'type'        => 'text',
        'priority'    => 20,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Non-member Call to Action Paragraph'),
        'description' => __('The call to action text below the heading for logged-in non-members.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-text',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_non_member_text');
        },
    ));

    // Non-member button text
    $wp_customize->add_setting('u3a_cta_non_member_button_text', array(
        'default'           => __( 'Become a member today'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_non_member_button_text', array(
        'type'        => 'text',
        'priority'    => 20,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Non-member Call to Action Button Text'),
        'description' => __('The call to action text on the button for non-members.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-btn',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_non_member_button_text');
        },
    ));

    // Non-member button link
    $wp_customize->add_setting('u3a_cta_non_member_button_link', array(
        'default'           => __(''),
        'sanitize_callback' => 'sanitize_url',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_cta_non_member_button_link', array(
        'type'        => 'url',
        'priority'    => 20,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Non-member Call to Action Button Link'),
        'description' => __('Where the user should go when they click the button.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-link',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_cta_non_member_button_link');
        },
    ));

    // Member & Admin heading
    $wp_customize->add_setting('u3a_member_heading', array(
        'default'           => __( 'Welcome back'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('u3a_member_heading', array(
        'type'        => 'text',
        'priority'    => 10,
        'section'     => 'u3a_theme_homepage_settings',
        'label'       => __('Member Call to Action Heading'),
        'description' => __('The call to action heading text for members.')
    ));

    $wp_customize->selective_refresh->add_partial('u3a_theme_homepage_settings', array(
        'selector'            => '.call-to-action-heading',
        'container_inclusive' => false,
        'render_callback'     => function() {
            echo get_theme_mod('u3a_member_heading');
        },
    ));

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
