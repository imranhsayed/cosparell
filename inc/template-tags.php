<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cosparell
 */

if ( ! function_exists( 'cosparell_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function cosparell_posted_on() {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
				}

			$time_string = sprintf(
			 $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
				);

				$posted_on = sprintf(
				/* translators: %s: search term */
				_x( 'Posted on %s', 'post date', 'cosparell' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);

				$byline = sprintf(
				/* translators: %s: search term */
				_x( 'by %s', 'post author', 'cosparell' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);

				echo '<span class="posted-on">' . esc_html( $posted_on ) . '</span><span class="byline"> ' . esc_html( $byline ) . '</span>';

		}
}

if ( ! function_exists( 'cosparell_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cosparell_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			$tags_list = get_the_tag_list( '', __( ', ', 'cosparell' ) );
			if ( $tags_list ) {
				/* translators: %s: search term */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cosparell' ) . '</span>', esc_html( $tags_list ) );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'cosparell' ), __( '1 Comment', 'cosparell' ), __( '% Comments', 'cosparell' ) );
			echo '</span>';
		}

	}
}

if ( ! function_exists( 'cosparell_archive_title' ) ) {
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after Optional. Content to append to the title. Default empty.
	 */
	function cosparell_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Category: %s', 'cosparell' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Tag: %s', 'cosparell' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Author: %s', 'cosparell' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Year: %s', 'cosparell' ), get_the_date( _x( 'Y', 'yearly archives date format', 'cosparell' ) ) );
		} elseif ( is_month() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Month: %s', 'cosparell' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'cosparell' ) ) );
		} elseif ( is_day() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Day: %s', 'cosparell' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'cosparell' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'cosparell' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'cosparell' );
			}
		} elseif ( is_post_type_archive() ) {
			/* translators: %s: search term */
			$title = sprintf( __( 'Archives: %s', 'cosparell' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'cosparell' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'cosparell' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo esc_html( $before . $title . $after );
		}
	}
}

if ( ! function_exists( 'cosparell_archive_description' ) ) {
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after Optional. Content to append to the description. Default empty.
	 */
	function cosparell_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo esc_html( $before . $description . $after );
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cosparell_categorized_blog() {
	$all_the_cool_cats = get_transient( 'cosparell_categories' );
	if ( false === ( $all_the_cool_cats ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			 array(
				 'fields'     => 'ids',
				 'hide_empty' => 1,

				 // We only need to know if there is more than one category.
				 'number'     => 2,
			 )
			);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cosparell_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cosparell_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cosparell_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cosparell_categorized_blog.
 */
function cosparell_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cosparell_categories' );
}
add_action( 'edit_category', 'cosparell_category_transient_flusher' );
add_action( 'save_post', 'cosparell_category_transient_flusher' );
