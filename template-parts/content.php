<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glutton
 */

?>

<article id="post-<?php the_ID(); ?>" <?php  if ( !is_single() ) {post_class('blogroll');}else{post_class('single row');} ?>>
	<header class="entry-header">	
		<?php if ( !is_single() ) {
				the_post_thumbnail('blogroll-post-thumb');
			} ?>
			
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php glutton_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>	
		
		<?php if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			} ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'glutton' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glutton' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( is_single() ) {
				glutton_entry_footer();
			} ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
