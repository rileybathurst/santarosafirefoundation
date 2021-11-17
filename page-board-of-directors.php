<?php
/*
Template Name: Board of Directors
*/

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content-page' );
endwhile; // End of the loop.

wp_reset_postdata();

$args = array(
    'post_type'      => 'board',
    'order'          => 'ASC',
    'meta_key'       => 'board_order',
    'orderby'        => 'meta_key',
    'meta_query' => array(
        array(
            'key'      => 'board_department',
            'value'    => 'director',
            'compare'  => '='
        )
    )
);

$meta_query = new WP_Query( $args );

// The Loop
if ( $meta_query->have_posts() ) {
    while ( $meta_query->have_posts() ) {
        $meta_query->the_post(); ?>
        <!-- php esc_attr( get_post_meta( $post->ID, 'board_order', true ) ); incase we need to see the numbers -->
        <!-- php echo esc_attr( get_post_meta( $post->ID, 'board_department', true ) ); ?> test the department -->
        <?php get_template_part( 'template-parts/content/content-page' );
    }
}
/* Restore original Post Data */
wp_reset_postdata(); ?>

Liasons

<?php $args2 = array(
    'post_type'      => 'board',
    'order'          => 'ASC',
    'meta_key'       => 'board_order',
    'orderby'        => 'meta_key',
    'meta_query' => array(
        array(
            'key'      => 'board_department',
            'value'    => 'liason',
            'compare'  => '='
        )
    )
);

$meta_query = new WP_Query( $args2 );

// The Loop
if ( $meta_query->have_posts() ) {
    while ( $meta_query->have_posts() ) {
        $meta_query->the_post(); ?>
        <!-- php esc_attr( get_post_meta( $post->ID, 'board_order', true ) ); incase we need to see the numbers -->
        <!-- php echo esc_attr( get_post_meta( $post->ID, 'board_department', true ) ); ?> test the department -->
        <?php get_template_part( 'template-parts/content/content-page' );
    }
}
/* Restore original Post Data */
wp_reset_postdata();

get_footer();
