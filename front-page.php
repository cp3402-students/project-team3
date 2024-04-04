<?php
/**
 * The template for the custom u3a homepage. Shows home.php if the homepage is set to posts or the selected static page
 * with the u3a custom CTA section.
 *
 * @package u3a-theme
 */

get_header();
?>
    <main id="primary" class="site-main">
        <?php
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        } else {
            // Custom u3a-theme section
            $user = wp_get_current_user();
            $heroImage = get_theme_mod( 'heroImage' );

            // I am currently unclear if we can set custom roles such as 'non-member' for people that have accounts but are not members.
//            if ( is_user_logged_in() && in_array( 'non-member', (array) $user->roles )  ) {
//                $welcomeMessage = get_theme_mod( '');
//            }
        }

        ?>
        <div class="hero-section">
            <?php // Fullscreen image background html here ?>
<!--        <img class="heroImage" src="<?php echo esc_url( get_theme_mod( 'u3a_theme_hero_image' ) ); ?>" alt="Call to action background"> -->
<!--        <h2 class="welcome-header">--><?php //echo $welcomeTitle; ?><!--</h2>-->
<!--        <p class="welcome-message">--><?php //echo $welcomeMessage; ?><!--</p>-->
<!--        <button class="cta-btn">--><?php //echo $welcomeButtonText; ?><!--</button>-->
        </div>
        <?php
            get_template_part( 'template-parts/content', 'page' );
        ?>
    </main><!-- #main -->

<?php
get_sidebar();
get_footer();
