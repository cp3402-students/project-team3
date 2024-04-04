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
            // This should still exist to handle the "announcements' seciton probably as that feels separate from the hero image call to action.
        }

        ?>
        <div class="announcements-overview">
        </div>
        <?php
            get_template_part( 'template-parts/content', 'page' );
        ?>
    </main><!-- #main -->

<?php
get_sidebar();
get_footer();
