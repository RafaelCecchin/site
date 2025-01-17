<?php
/**
 * RCCODE Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RCCODE
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_RCCODE_VERSION', '1.0.0' );


function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
        
    // Adding scripts file in the footer
    
    wp_enqueue_script( 'typewrite', get_stylesheet_directory_uri() . '/assets/scripts/typewrite.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/assets/scripts/slick.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jqueryui', get_stylesheet_directory_uri() . '/assets/scripts/jquery-ui.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'site', get_stylesheet_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery', 'jqueryui' ), false, true );

    // Register main stylesheet
    wp_enqueue_style( 'wordpress', get_stylesheet_directory_uri() . '/assets/styles/wordpress-core.css', array(), false, 'all' );
    wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/assets/styles/style.css', array(), false, 'all' );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/assets/styles/slick.css', array(), false, 'all' );
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/assets/styles/slick-theme.css', array(), false, 'all' );
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/style.css', array(), false, 'all' );

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 15);

function admin_scripts() {
  // Adding admin file in the footer
  wp_enqueue_script( 'admin-js', get_stylesheet_directory_uri() . '/assets/scripts/admin.js', array( 'jquery' ), true, true );
  wp_enqueue_media();

  // Register admin stylesheet
  wp_enqueue_style( 'admin-css', get_stylesheet_directory_uri() . '/assets/styles/admin.css', false, 'all' );
}

add_action('admin_enqueue_scripts', 'admin_scripts', 16);

register_nav_menus(
	array(
		'frontpage-nav'		=> 'Página inicial',		// Main nav in header
	)
);

function new_excerpt_more($more) {
  global $post;
  remove_filter('excerpt_more', 'new_excerpt_more'); 
  return '...';
}
add_filter('excerpt_more','new_excerpt_more',11);

function new_link_custom_logo($html) {

  if (!is_front_page()) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
            esc_url( get_permalink( get_option( 'page_for_posts' ) ) ),
            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                'class'    => 'custom-logo',
            ) )
    );
  }
  
  return $html;   
} 

add_filter( 'get_custom_logo', 'new_link_custom_logo' );

// Informações
require_once(get_stylesheet_directory().'/functions/information/information.php'); 

// Portfólio
require_once(get_stylesheet_directory().'/functions/portfolio/portfolio.php'); 


function rccode_get_custom_header() {
  require_once(get_stylesheet_directory().'/custom-header.php'); 
}

function rccode_get_custom_footer() {
  require_once(get_stylesheet_directory().'/custom-footer.php'); 
}

function rccode_get_custom_archive() {
  require_once(get_stylesheet_directory().'/custom-archive.php'); 
}

function rccode_get_custom_single() {
  require_once(get_stylesheet_directory().'/custom-single.php'); 
}
