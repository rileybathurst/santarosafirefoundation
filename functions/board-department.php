<?php

/**
 * Adds a box to the main column on the Post add/edit screens.
 * https://stackoverflow.com/questions/25522380/how-to-set-radio-buttons-in-custom-meta-box-checked
 */
function wdm_add_meta_box() {

	add_meta_box(
		'wdm_sectionid',
		'Director or Liason',
		'wdm_meta_box_callback',
		'board',
		'side'
	); //you can change the 4th paramter i.e. post to custom post type name, if you want it for something else

}

add_action( 'add_meta_boxes', 'wdm_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function wdm_meta_box_callback( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, 'board_department', true ); //board_department is a meta_key. Change it to whatever you want

        ?>
        <label for="wdm_new_field"><?php _e( "Choose value:", 'choose_value' ); ?></label>
        <br />  
        <input type="radio" name="the_name_of_the_radio_buttons" value="director" <?php checked( $value, 'director' ); ?> id="director"><label for="director">Director</label><br>
        <input type="radio" name="the_name_of_the_radio_buttons" value="liason" <?php checked( $value, 'liason' ); ?> id="liason"><label for="liason">Liason</label><br>

		<!-- before -->
		<!-- php echo get_post_meta( $post->ID, 'board_department', true ); ?> -->
		<!-- after -->

        <?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function wdm_save_meta_box_data( $post_id ) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( !isset( $_POST['wdm_meta_box_nonce'] ) ) {
                return;
        }

        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
                return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
        }

        // Check the user's permissions.
        if ( !current_user_can( 'edit_post', $post_id ) ) {
                return;
        }


        // Sanitize user input.
        $new_meta_value = ( isset( $_POST['the_name_of_the_radio_buttons'] ) ? sanitize_html_class( $_POST['the_name_of_the_radio_buttons'] ) : '' );

        // Update the meta field in the database.
        update_post_meta( $post_id, 'board_department', $new_meta_value );

}

add_action( 'save_post', 'wdm_save_meta_box_data' );