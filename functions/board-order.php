<?php
/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'board_order_meta_boxes_setup' );
add_action( 'load-post-new.php', 'board_order_meta_boxes_setup' );

/* Meta box setup function. */
function board_order_meta_boxes_setup() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'board_order_add_post_meta_boxes' );	
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'board_order_save_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function board_order_add_post_meta_boxes() {

	add_meta_box(
		'board-order', // Unique ID
		esc_html__( 'Board Order', 'example' ), // Title
		'board_order_meta_box', // Callback function
		'board', // Admin page (or post type)
		'side', // Context
		'default' // Priority
	);
}

// take below here into sperate files
/* Display the post meta box. */
function board_order_meta_box( $post ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'board_order_nonce' ); ?>

	<p>
		<label for="board-order-post"><?php _e( "Customize the order the board are shown in.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="board-order" id="board-order" value="<?php echo esc_attr( get_post_meta( $post->ID, 'board_order', true ) ); ?>" size="30" />
	</p>
<?php }

/* Save the meta box's post metadata. */
function board_order_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['board_order_nonce'] ) || !wp_verify_nonce( $_POST['board_order_nonce'], basename( __FILE__ ) ) )
	return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( $_POST['board-order'] );

	/* Get the meta key. */
	$meta_key = 'board_order';

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