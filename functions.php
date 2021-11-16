<?php

// https://developer.wordpress.org/reference/hooks/customize_register/
function twenttwentyone_child_customize_register($wp_customize){
    $wp_customize->add_section('header_img_options', array(
        'title'			=> __('Header Image Options', 'twenttwentyone_child'),
        'description'	=> '',
        'priority'		=> 160, // guess and check
    ));

    $wp_customize->add_section('cmsf_options', array(
        'title'			=> __('CMSF Options', 'twenttwentyone_child'),
        'description'	=> '',
        'priority'		=> 160, // guess and check
    ));

    //  =============================
    //  = Image Upload              =
    //  =============================

    // the reason I dont use the custom background is that pukks from the body_class();

    $wp_customize->add_setting('header_image', array(
        'default'		=> 'image.jpg',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'custom_header_image', array(
                'label'		=> __( 'Header Image', 'twenttwentyone_child' ),
                'section'	=> 'header_img_options',
                'settings'	=> 'header_image',
                'context'	=> 'your_setting_context'
            )
        )
    );
    // <img src="<?php echo get_option( 'header_image' ); " alt="" />

    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('header_alt', array(
        'default'		=> 'a header background image',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control('header_alt', array(
        'label'		=> __('Header Image alt text', 'twenttwentyone_child'),
        'section'	=> 'header_img_options',
        'settings'	=> 'header_alt',
    ));
    // <h1> php echo get_option( 'text_test' ); </h1>

    //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting(
        // 'twenttwentyone_child_theme_options[link_color]', array(
        'sides_of_header_image', array(
            'default'				=> '#000',
            'sanitize_callback'		=> 'sanitize_hex_color',
            'capability'			=> 'edit_theme_options',
            'type'					=> 'option',
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize, 'sides_of_header_image', array(
            'label'		=> __('Side of the header image', 'twenttwentyone_child'),
            'section'	=> 'header_img_options',
            'settings'	=> 'sides_of_header_image',
        )
    ));
    // <h1> php echo get_option( 'twenttwentyone_child_theme_options' ); </h1>

    //  =============================
    //  = Checkbox                  =
    //  =============================
    $wp_customize->add_setting('single_event', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('single_event', array(
        'settings'	=> 'single_event',
        'label'		=> __('Show Single Event'),
        'section'	=> 'cmsf_options',
        'type'		=> 'checkbox',
    ));
}
add_action('customize_register', 'twenttwentyone_child_customize_register');

// REMOVE WP EMOJI
// https://www.denisbouquet.com/remove-wordpress-emoji-code/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
