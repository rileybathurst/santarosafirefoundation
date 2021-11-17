<?php
/*
Template Name: Board of Directors Old
*/

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content-page' );
endwhile; // End of the loop.

//  $args = array(
$meta_query_args = array(
    'post_type'      => 'board',
    // 'order'          => 'DSC', // test this works by flipping it
    'order'          => 'ASC',
    'meta_key'       => 'board_order',
    'orderby'        => 'meta_key',
);

$the_query = new WP_Query( $meta_query_args );

// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post(); ?>
        <!-- php esc_attr( get_post_meta( $post->ID, 'board_order', true ) ); incase we need to see the numbers -->
        <!-- php echo esc_attr( get_post_meta( $post->ID, 'board_department', true ) ); ?> test the department -->
        <?php get_template_part( 'template-parts/content/content-page' );
    }
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

get_footer();
