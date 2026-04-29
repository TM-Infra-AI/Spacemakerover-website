<?php
//
// LARX Theme Functions
//
// Author: denisgriu
// URL: http://themeforest.net/user/denisgriu/
// Design: denisgriu Themes
//
//

/*-----------------------------------------------------------------------------------*/
/*	Functions and Definitions
/*-----------------------------------------------------------------------------------*/
define('TH1_JS', get_template_directory_uri()  . '/assets/js/');
define('TH1_CSS', get_template_directory_uri()  . '/assets/css/');
define('TH1_PLUGINS', get_template_directory_uri()  . '/assets/plugins/');

/*-----------------------------------------------------------------------------------*/
/*	Start Setup Theme
/*-----------------------------------------------------------------------------------*/
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/theme-options/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/theme-options/ReduxCore/framework.php' );
}
if ( file_exists( dirname( __FILE__ ) . '/framework/theme-options/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/theme-options/config.php' );
}

require_once('framework/plugins/plugins-config.php'); 			                            // Plugins Manager
require_once('framework/functions/scripts-load.php'); 			                            // Load Scripts
require_once('framework/functions/css-load.php'); 			                                // Load CSS
require_once('framework/functions/additional-functions.php'); 			                    // Additional theme functions

require_once('framework/testimonials/testimonials-functions.php');                          // Testimonial Post Type
require_once('framework/portfolio/portfolio-functions.php');                                // Portfolio Post Type
require_once('framework/shortcodes/shortcodes.php'); 			                            // Shortcodes
require_once dirname( __FILE__ ) . '/framework/plugins/Metaboxes/metabox-functions.php';    // Metaboxes




/*-----------------------------------------------------------------------------------*/
/*	Register Custom Navigation Walker
/*-----------------------------------------------------------------------------------*/

require_once('framework/wp_bootstrap_navwalker.php');

/*-----------------------------------------------------------------------------------*/
/*	Register Menus
/*-----------------------------------------------------------------------------------*/

function th_register_my_menus() {
	register_nav_menu('main-menu', __('Main Navigation', 'larx'));
}
add_action( 'init', 'th_register_my_menus' );


/*-----------------------------------------------------------------------------------*/
/*	Register theme widget areas
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('th_register_sidebar') ){
	function th_register_sidebar() {
		register_sidebar(array(
			'name' => 'Blog-Sidebar',
			'id' => 'blog_sidebar',
			'before_widget' => '<div id="%1$s" class="bar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="blog_sidebar">',
			'after_title' => '</div>',
		));

		register_sidebar(array(
			'name' => 'Page-Sidebar',
			'id' => 'page_sidebar',
			'before_widget' => '<div id="%1$s" class="bar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="page_sidebar">',
			'after_title' => '</div>',
		));
	}
}
add_action( 'widgets_init', 'th_register_sidebar' );


/*-----------------------------------------------------------------------------------*/
/*	Extend VC
/*-----------------------------------------------------------------------------------*/

if(class_exists('Vc_Manager')) {

    function th_extend_composer() {
        require_once locate_template('/wpbakery/vc-extend.php');
    }

    add_action('init', 'th_extend_composer', 20);
}
/*-----------------------------------------------------------------------------------*/
/*	Get ID of the page
/*-----------------------------------------------------------------------------------*/

function th_get_id() {

    global $post;

    $post_id = '';

    if(is_object($post)) {
        $post_id = $post->ID;
    }
    if(is_home()) {
        $post_id = get_option('page_for_posts');
    }

    return $post_id;
}

/*-----------------------------------------------------------------------------------*/
/*	Add theme support thumbnails
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );
add_image_size( 'index-thumb', 405, 207, true );
add_image_size( 'blog-thumb', 370, 247, true );

/*-----------------------------------------------------------------------------------*/
/*	Automatic feed links
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/*	Adding theme support content width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

/*-----------------------------------------------------------------------------------*/
/*	Localization
/*-----------------------------------------------------------------------------------*/
function th_theme_setup() {
	load_theme_textdomain( 'th_larx', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'th_theme_setup' );
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
//add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
//function theme_enqueue_styles() {
  //  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'child-style',
      //  get_stylesheet_directory_uri() . '/style.css',
        //array('parent-style')
    //);
//}
//
// Your code goes below
//<?php
//
// Your code goes below!
//
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
//function themify_custom_enqueue_child_theme_styles() {
//	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
//}
//add_action( 'wp_enqueue_scripts', 'themify_custom_enqueue_child_theme_styles' );

///////////////////// Services custom post type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Services', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Services', 'text_domain' ),
		'name_admin_bar'      => __( 'Post Type', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent services:', 'text_domain' ),
		'all_items'           => __( 'All services', 'text_domain' ),
		'add_new_item'        => __( 'Add New services', 'text_domain' ),
		'add_new'             => __( 'Add New Services', 'text_domain' ),
		'new_item'            => __( 'New services', 'text_domain' ),
		'edit_item'           => __( 'Edit services', 'text_domain' ),
		'update_item'         => __( 'Update services', 'text_domain' ),
		'view_item'           => __( 'View services', 'text_domain' ),
		'search_items'        => __( 'Search services', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'services', 'text_domain' ),
		'description'         => __( 'services', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'services', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );
/////////////////////////
function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
		$linl = get_the_permalink(get_the_ID());
        $excerpt = implode(" ",$excerpt).'&nbsp;&nbsp;<a href="'.$linl.'">Read More...</a>';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode( get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'&nbsp;&nbsp;<a href="'.$linl.'">Read More...</a>';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }
	
	////////wpnavmeanu/////////////////////
	
	

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );
?>