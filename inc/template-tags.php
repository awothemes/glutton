<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Glutton
 */

if ( ! function_exists( 'glutton_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function glutton_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'glutton' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	
	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'glutton' ) );
		if ( $categories_list && glutton_categorized_blog() ) {
			printf( ' ~ <span class="cat-links">' . esc_html__( '%1$s', 'glutton' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

}
endif;

if ( ! function_exists( 'glutton_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function glutton_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'glutton' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links row">' . esc_html__( 'Tagged %1$s', 'glutton' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'glutton' ), esc_html__( '1 Comment', 'glutton' ), esc_html__( '% Comments', 'glutton' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'glutton' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link row">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function glutton_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'glutton_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'glutton_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so glutton_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so glutton_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in glutton_categorized_blog.
 */
function glutton_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'glutton_categories' );
}
add_action( 'edit_category', 'glutton_category_transient_flusher' );
add_action( 'save_post',     'glutton_category_transient_flusher' );


function glutton_footer(){?> 
	
	</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info row">
				<div class="six columns">
					<div class="copyright">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'glutton' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'glutton' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'glutton' ), 'Glutton', '<a href="http://awothemes.pro" rel="designer">Awothemes</a>' ); ?>
					</div>
				</div>
				<div class="footer-widget six columns">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>	
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php }


/**
 * Output custom logo.
 */
function glutton_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}