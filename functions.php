<?php

// style sheet this should probably de further down
// https://developer.wordpress.org/themes/advanced-topics/child-themes/#enqueueing-styles-and-scripts
function my_plugin_add_stylesheet() {
    wp_enqueue_style( 'my-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0', 'all' );
    wp_enqueue_style( 'app-style', get_stylesheet_directory_uri() . '/app.css', false, '1.1', 'all' );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_add_stylesheet' );

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
    // I also dont know what I wrote here

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
    
    $wp_customize->add_setting('hero_one', array(
        'default'		=> 'image.jpg',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'custom_hero_one', array(
                'label'		=> __( 'Hero One', 'twenttwentyone_child' ),
                'section'	=> 'header_img_options',
                'settings'	=> 'hero_one',
                'context'	=> 'your_setting_context'
            )
        )
    );
    $wp_customize->add_setting('hero_two', array(
        'default'		=> 'image.jpg',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'custom_hero_two', array(
                'label'		=> __( 'Hero Two', 'twenttwentyone_child' ),
                'section'	=> 'header_img_options',
                'settings'	=> 'hero_two',
                'context'	=> 'your_setting_context'
            )
        )
    );
    $wp_customize->add_setting('hero_three', array(
        'default'		=> 'image.jpg',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'custom_hero_three', array(
                'label'		=> __( 'Hero Three', 'twenttwentyone_child' ),
                'section'	=> 'header_img_options',
                'settings'	=> 'hero_three',
                'context'	=> 'your_setting_context'
            )
        )
    );

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

    $wp_customize->add_setting('paypal_donate', array(
        'default'		=> 'Paypal Donate Button link',
        'capability'	=> 'edit_theme_options',
        'type'			=> 'option',
    ));

    $wp_customize->add_control('paypal_donate', array(
        'label'		=> __('Paypal', 'twenttwentyone_child'),
        'section'	=> 'title_tagline',
        'settings'	=> 'paypal_donate',
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

function board_setup_post_type() {
	register_post_type( 'board',
	array(
		'labels'			=> array(
			'name'			=> __('Board'),
			'singular_name'	=> __('Board'),
		),
		'public'			=> true,
		'has_archive'		=> true,
		'show_in_rest' 		=> true,
		'rewrite'			=> array( 'slug' => 'board' ),
		'supports'			=> array( 
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			)
	) ); 
} 
add_action( 'init', 'board_setup_post_type' );

// use the stylesheet as the theme goes to the parent
include( get_stylesheet_directory() . '/functions/board-order.php' );
include( get_stylesheet_directory() . '/functions/board-department.php' );

function faqs_setup_post_type() {
	register_post_type( 'faqs',
	array(
		'labels'			=> array(
			'name'			=> __('FAQs'),
			'singular_name'	=> __('FAQs'),
		),
		'public'			=> true,
		'has_archive'		=> true,
		'show_in_rest' 		=> true,
		'rewrite'			=> array( 'slug' => 'faqs' ),
		'supports'			=> array( 
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			)
	) ); 
} 
add_action( 'init', 'faqs_setup_post_type' );
