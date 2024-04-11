<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package u3a-theme
 */

if ( ! function_exists( 'u3a_theme_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function u3a_theme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'u3a-theme' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'u3a_theme_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function u3a_theme_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'u3a-theme' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'u3a_theme_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function u3a_theme_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'u3a-theme' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'u3a-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'u3a-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'u3a-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'u3a_theme_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function u3a_theme_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail();
				if ( is_front_page() ) {
                    $user = wp_get_current_user();

                    if ( is_user_logged_in() && in_array( 'non-member', (array)$user->roles ) ) {
                        $headingThemeMod = 'u3a_cta_non_member_heading';
                        $textThemeMod = 'u3a_cta_non_member_text';
                        $buttonTextThemeMod = 'u3a_cta_non_member_button_text';
                        $buttonLinkThemeMod = 'u3a_cta_non_member_button_link';
                    }
                    elseif ( is_user_logged_in() && ( in_array( 'member', (array)$user->roles ) ) || current_user_can( 'edit_pages')  ) {
                        $headingThemeMod = 'u3a_cta_member_heading';
                        $textThemeMod = 'u3a_cta_member_text';
                        $buttonTextThemeMod = 'u3a_cta_member_button_text';
                        $buttonLinkThemeMod = 'u3a_cta_member_button_link';
                    }
                    else {
                        $headingThemeMod = 'u3a_cta_visitor_heading';
                        $textThemeMod = 'u3a_cta_visitor_text';
                        $buttonTextThemeMod = 'u3a_cta_visitor_button_text';
                        $buttonLinkThemeMod = 'u3a_cta_visitor_button_link';
                    }

                    $callToActionHeading = get_theme_mod( $headingThemeMod );
                    $callToActionText = get_theme_mod( $textThemeMod );
                    $callToActionButtonText = get_theme_mod( $buttonTextThemeMod );
                    $callToActionButtonLink = get_theme_mod( $buttonLinkThemeMod );

				?>
                        <div class="hero-section-content">
                            <h2 class="call-to-action-heading"><?php echo $callToActionHeading ?></h2>
                            <p class="call-to-action-text"><?php echo $callToActionText ?></p>
                            <a class="wp-block-button wp-block-button__link wp-element-button call-to-action-button" href="<?php echo esc_html($callToActionButtonLink) ?>"><?php echo $callToActionButtonText ?></a>
                        </div>
                </div><!-- .post-thumbnail -->
                            <?php
                            $categoryName = 'announcements';
                            $query = new WP_Query(array('category_name' => $categoryName, 'posts_per_page' => '1'));

                            if ($query->have_posts()) : ?>
                                <!-- the loop -->
                                <div class="announcements-section">
                                    <h2 class="announcements-section-header">Announcements</h2>
                                <?php
                                    while ($query->have_posts()) :
                                        $query->the_post();
                                        the_title('<h3>', '</h3>');
                                        the_content('View Announcement');
                                        $categoryID = get_cat_ID( $categoryName )?>

                                        <a class="wp-block-button wp-block-button__link wp-element-button announcement-button" href="<?php echo get_category_link( $categoryID ); ?>" title="Announcements">View All Announcements</a>

                                    <?php endwhile; ?>
                                <!-- end of the loop -->

                                <?php wp_reset_postdata(); ?>
                                </div>
                            <?php endif; }?>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
