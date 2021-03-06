<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

if ( ! function_exists( 'fira_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function fira_posted_on() {
		// Finally, let's write all of this to the page.
		echo '<span class="posted-on"><i class="fas fa-calendar"></i>' . fira_time_link() . '</span>';
	}
endif;

if ( ! function_exists( 'fira_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function fira_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
//		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
//			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
//		}
		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: Post date. */
			__( '<span class="screen-reader-text"> </span> %s', 'fira' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;


if ( ! function_exists( 'fira_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function fira_entry_footer() {

		/* translators: Used between list items, there is a space after the comma. */
		$separate_meta = __( ', ', 'fira' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( ( ( fira_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

			echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && fira_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
					if ( $categories_list && fira_categorized_blog() ) {
						echo '<span class="cat-links">' . fira_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'fira' ) . '</span>' . $categories_list . '</span>';
					}

					if ( $tags_list && ! is_wp_error( $tags_list ) ) {
						echo '<span class="tags-links">' . fira_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'fira' ) . '</span>' . $tags_list . '</span>';
					}

					echo '</span>';
				}
			}

			fira_edit_link();

			echo '</footer> <!-- .entry-footer -->';
		}
	}
endif;


if ( ! function_exists( 'fira_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function fira_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Post title. */
				__( '<i class="fas fa-pencil-alt"> </i>  Edit post', 'fira' ),
				get_the_title()
			),
			'<span class="edit-link">','</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fira_categorized_blog() {
	$category_count = get_transient( 'fira_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'fira_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in fira_categorized_blog.
 */
function fira_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fira_categories' );
}
add_action( 'edit_category', 'fira_category_transient_flusher' );
add_action( 'save_post', 'fira_category_transient_flusher' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Twenty Seventeen 2.2
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Twenty Seventeen 2.2
		 */
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'fira_show_tags' ) ) :

    function fira_show_tags()  {
        $posttags = get_the_tags();
        $count = 0;
        $sep = '';
        if ($posttags) {
            foreach ($posttags as $tag) {
                $count++;
                echo $sep . '<a href="' . get_tag_link($tag->term_id) . '" class="button green">' . $tag->name . '</a>';
                $sep = ' ';
                if ($count > 3) break; //change the number to adjust the count
            }
        }
    }

endif;

if ( ! function_exists( 'fira_related_posts' ) ) :
 function fira_related_posts()
 {
//for use in the loop, list 5 post titles related to first tag on current post
     $tags = wp_get_post_tags($post->ID);
     if ($tags) {
         echo 'Related Posts';
         $first_tag = $tags[0]->term_id;
         $args = array(
             'tag__in' => array($first_tag),
             'post__not_in' => array($post->ID),
             'posts_per_page' => 5,
             'caller_get_posts' => 1
         );
         $my_query = new WP_Query($args);
         if ($my_query->have_posts()) {
             while ($my_query->have_posts()) : $my_query->the_post(); ?>
                 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                     <?php the_title(); ?>
                 </a>
             <?php
             endwhile;
         }
         wp_reset_query();
     }

 }
endif;