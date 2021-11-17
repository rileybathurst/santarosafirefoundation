<?php
/*
Template Name: FAQs
*/

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content-page' );
endwhile; // End of the loop.

wp_reset_postdata(); ?>

<?php $args = array(
    'post_type'      => 'faqs',
    // 'order'          => 'ASC',
    // 'meta_key'       => 'board_order',
    // 'orderby'        => 'meta_key',
);

$meta_query = new WP_Query( $args );

// The Loop
if ( $meta_query->have_posts() ) {
    while ( $meta_query->have_posts() ) {
        $meta_query->the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-content"><h3>Question: <?php the_title(); ?></h3></div>
	<div class="entry-content">
		<p>Answer: <?php the_content(); ?></p>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					esc_html__( 'Edit %s', 'twentytwentyone' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID();

    }
}
/* Restore original Post Data */
wp_reset_postdata();

get_footer();
