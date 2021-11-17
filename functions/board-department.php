<?php
/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'board_department_meta_boxes_setup' );
add_action( 'load-post-new.php', 'board_department_meta_boxes_setup' );

/* Meta box setup function. */
function board_department_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'board_department_add_post_meta_boxes' );	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'board_department_save_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function board_department_add_post_meta_boxes() {

	add_meta_box(
		'board-department', // Unique ID
		esc_html__( 'Board Department', 'example' ), // Title
		'board_department_meta_box', // Callback function
		'board', // Admin page (or post type)
		'side', // Context
		'default' // Priority
	);
}

// take below here into sperate files
/* Display the post meta box. */
function board_department_meta_box( $post ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'board_department_nonce' ); ?>

	<p>
		<!-- <label for="board-department-post"> php _e( "Board Department.", 'example' ); ?></label> -->
		<br />
		<!-- <input class="widefat" type="text" name="board-department" id="board-department" value="<-- php echo esc_attr( get_post_meta( $post->ID, 'board_department', true ) ); ?>" size="30" /> -->
	
    <input type="radio" id="directors" name="<?php get_post_meta( $post->ID, 'board_department', true ) ?>" value="directors" checked class="widefat" size="30">
    <label for="directors">Directors</label>
    <br />
    <input type="radio" id="liasons" name="<?php get_post_meta( $post->ID, 'board_department', true ) ?>" value="liasons" class="widefat" size="30" >
    <label for="liasons">Liasons</label>

    <br/>
    show the department test<br />
    <?php echo esc_attr( get_post_meta( $post->ID, 'board_department', true ) ); ?>
    <br />after
  </p>
<?php }

/* Save the meta box's post metadata. */
function board_department_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['board_department_nonce'] ) || !wp_verify_nonce( $_POST['board_department_nonce'], basename( __FILE__ ) ) )
	return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( $_POST['board-department'] );

	/* Get the meta key. */
	$meta_key = 'board_department';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}