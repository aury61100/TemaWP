<?php
/**
 * functions.php is the file where you can control all the logics behind your website
 * You can even change how WordPress works because this file is called very early in the process of building the pages
 *
 * @since 1.0.0
 * @version 1.0.0
 * 
 * @see  https://developer.wordpress.org/reference/functions/add_action/
 * @see  https://developer.wordpress.org/reference/functions/add_theme_support/
 * @see  https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 * @see  https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @see  https://developer.wordpress.org/reference/functions/remove_action/
 */
define( 'WTD_VERSION', (WTD_IS_STAGING ? time() : '1.0.0') );

define( 'WTD_IS_ADMIN', current_user_can('edit_others_posts')); 

/**
 * whenever you see an add_action( 'moment', 'nameofthefunction' ) call it means we want to add a function with the name 'nameofthefunction' to the list of things to do in that 'moment'
 * 
 * @see  https://developer.wordpress.org/reference/functions/add_action/
 */

/**
 * This function takes care of all the setup and functionalities that should be added to your theme
 */
function wtd_setup() {
	/**
	 * add_theme_support will be used to add some functionalities
	 * 
	 * @see  https://developer.wordpress.org/reference/functions/add_theme_support/
	 * @see  https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 */
    add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
    register_nav_menus(['main_menu' => 'Menu Principale']);
    add_theme_support( 'custom-header' );
}
add_action( 'after_setup_theme', 'wtd_setup' );

function themename_custom_header_setup() {
    $defaults = array(
        // Default Header Image to display
        'default-image'         => get_template_directory_uri() . '/images/headers/default.jpg',
        // Display the header text along with the image
        'header-text'           => false,
        // Header text color default
        'default-text-color'        => '000',
        // Header image width (in pixels)
        'width'             => 1000,
        // Header image height (in pixels)
        'height'            => 198,
        // Header image random rotation default
        'random-default'        => false,
        // Enable upload of image file in admin 
        'uploads'       => false,
        // function to be called in theme head section
        'wp-head-callback'      => 'wphead_cb',
        //  function to be called in preview page head section
        'admin-head-callback'       => 'adminhead_cb',
        // function to produce preview markup in the admin screen
        'admin-preview-callback'    => 'adminpreview_cb',
        );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );

function wpthemedev_widgets_registration(){
    
    register_sidebar([
        'name' => 'Footer',
        'id' => 'footer',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
    register_sidebar([
        'name' =>'Sidebar' ,
        'id' =>'sidebar' ,
        'before_widget' =>'<div>' ,
        'after_widget' =>'</div>' ,
        'before_title' =>'<h3>' ,
        'after_title' =>'</h3>' ,
    ]
    );
    
}
function wporg_custom_post_type()
{
    register_post_type('wporg_product',
        array(
            'labels'      => array(
                'name'          => __('Products'),
                'singular_name' => __('Product'),
            ),
            'public'      => true,
            'has_archive' => true,
        )
    );
}
add_action('init', 'wporg_custom_post_type');
function wporg_register_taxonomy_course()
{
    $labels = [
         'name'              => _x('Courses', 'taxonomy general name'),
        'singular_name'     => _x('Course', 'taxonomy singular name'),
        'search_items'      => __('Search Courses'),
        'all_items'         => __('All Courses'),
        'parent_item'       => __('Parent Course'),
        'parent_item_colon' => __('Parent Course:'),
        'edit_item'         => __('Edit Course'),
        'update_item'       => __('Update Course'),
        'add_new_item'      => __('Add New Course'),
        'new_item_name'     => __('New Course Name'),
        'menu_name'         => __('Course'),
    ];
    $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'course'],
    ];
register_taxonomy('course', ['wporg_product'], $args);
}
add_action('init', 'wporg_register_taxonomy_course');

add_action( 'widgets_init', 'wpthemedev_widgets_registration' );
/**
 * enqueue scripts and styles the way WordPress wants them to be
 * 
 * @see  https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 */
function wtd_styles_scripts(){
	//change the jquery version
	wp_deregister_script ( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js' , array(), '1.0.0', false );

	// enqueue our style.css file
	wp_enqueue_style( 'wtd-reset', get_stylesheet_directory_uri().'/style.css', array(), WTD_VERSION, 'all' );
	wp_enqueue_style( 'wtd-style', WTD_INCLUDES.'css/style.css', array( 'wtd-reset' ), WTD_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'wtd_styles_scripts' );

/**
 * Remove the default emoji styles slowing down the website
 *
 * @see  https://developer.wordpress.org/reference/functions/remove_action/
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles');


add_action('acf/init', 'wtd_acf_blocks_init');
function wtd_acf_blocks_init() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'square',
            'title'             => __('Quadrato'),
            'description'       => __('Un quadratino colorato'),
            'render_template'   => 'template-parts/blocks/square/square.php',
            'category'          => 'formatting',
        ));
    }
}
add_action('acf/init', 'wtd_acf_init_block_types');

function wtd_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => 'template-parts/blocks/Testimonial/testimonial.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}


