<?php
get_header();
?>

    <main id="primary" class="site-main">

        <?php
        // Display the Courses Page content
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type(), array(
                'display-author' => 'false'
        ) );
        endwhile;

        // Courses sections start
        $coursesID = get_cat_ID( 'courses' );
        $courseSubCategories = get_term_children( $coursesID, 'category' );

        // For each sub-category of courses, display its posts
        foreach ($courseSubCategories as $subCategory) {
            $query = new WP_Query( array (
                'cat' => $subCategory
            ));
            if ( $query->have_posts() ) {
                ?>
                <h2 class="course-category-heading"><?php echo ucfirst(get_cat_name($subCategory)) ?> Courses</h2>
                <div class="course-subcategory">
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();

                    $user = wp_get_current_user();
                    if ( ( is_user_logged_in() & ( in_array( 'member', (array)$user->roles ) ) ) || current_user_can( 'edit_pages')) {
                        $buttonText = 'View Course';
                        $buttonLink = get_post_permalink();
                    } else {
                        $buttonText = 'Become a Member';
                        $buttonLink = '/register/';
                    }
                    ?>
                    <div class="course-card">
                        <h3 class="course-title"><?php echo get_the_title()?></h3>
                        <a class="course-button wp-element-button wp-block-button__link" href="<?php echo $buttonLink ?>"><?php echo $buttonText ?></a>
                    </div>
                <?php
                endwhile; // End of the loop.
            }
            ?>
            </div>
            <?php
            wp_reset_postdata();
        }
        ?>

    </main><!-- #main -->

<?php
get_sidebar();
get_footer();