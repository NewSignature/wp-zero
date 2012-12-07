<?php

include "Bootstrap.php";



define( 'ZERO_VERSION_NUMBER', '0.0.3' );

/**
 * Loads the default theme supported features. Subthemes can be removed with remove_theme_support
 *  
 */
add_action( 'after_setup_theme', 'zero_setup', 1 ); // Run as soon as possible
function zero_setup() {
  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );
  
  // Configure the post thumbnail sizes
  add_theme_support( 'zero-post-thumbnails' );
  
  // Adds the Zero base set of CSS files (LES): reset.less, editor.less, and prose.less (requires zero-less theme support)
  add_theme_support( 'zero-css-base' );
  
  // Configures the WYSIWYG editor to use the styles in prose.less along with reset.less and editor.less
  add_theme_support( 'zero-css-editor' );
  
  // Insert the IE HTML5 shiv
  add_theme_support( 'zero-html5-shiv' );
  
  // Loads the scripts in an async fashion while still running them in order
  add_theme_support( 'zero-async-script-load' );
  
  // Use the thread comments script to move the comment field below where replying
  add_theme_support( 'zero-thread-comments-script' );
  
  // Provided better class names on the menu items
  add_theme_support( 'zero-menu-class-names' );
  
  // Auto-linking images/favicon.ico as the favicon
  add_theme_support( 'zero-favicon' );
  
  // Auto-link images/apple-touch-icon[-<X>x<Y>][-precomposed].png as the Apple touch icons
  add_theme_support( 'zero-apple-touch-icon' );
  
  // Adds css/login.less to the login screen and changes the WordPress logo to link to the homepage and read your name
  add_theme_support( 'zero-login-theme' );
  
  // Make the wp_page_menu function follow the args betters passed from wp_nav_menu
  add_theme_support( 'zero-wp-page-menu' );
     
  // Adds the function zero_paginate_index_links() which wraps WP's paginate_links to work for index pages instead of just paginated posts
  add_theme_support( 'zero-pager' );

  // Handles the registration of menus
  add_theme_support( 'zero-nav-menus' );
  
  // Handles the registration of the widget areas (sidebars)
  add_theme_support( 'zero-widget-areas' );
  
  // Removes the embed style element for the gallery printed with shortcode
  add_theme_support( 'zero-remove-gallery-css' );
  
  // Clean up the comment output
  add_theme_support( 'zero-comments' );
  
  // Add options page
  add_theme_support( 'zero-options-page' );
  
  // Add customization of page title
  add_theme_support( 'zero-page-title' );
  
  // Will set images/apple-touch-startup-image.png as the web-app start up image (320x460px)
  // add_theme_support( 'zero-apple-touch-startup-image' );
  
  // Add the nav element to acceptable elements for the menu
  add_theme_support( 'zero-nav-menu-container' );

  
  // Give you helper functions to work with the nav menus 
  add_theme_support( 'zero-nav-menu-helpers' );
  
  // Give you helper functions to work with posts 
  add_theme_support( 'zero-posts-helpers' );

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  // TODO: Create locale
  //load_theme_textdomain( 'zero', TEMPLATEPATH . '/languages' );

  //$locale = get_locale();
  //$locale_file = TEMPLATEPATH . "/languages/$locale.php";
  //if ( is_readable( $locale_file ) )
  //  require_once( $locale_file );
  
}


/**
 * Start loading up features
 */
add_action( 'init', 'zero_load_features' );
function zero_load_features() {
	$path = dirname(__FILE__).'/features/';
	
	$features = array(
	  'zero-css-base',
	  'zero-less',
		'zero-css-editor',
		'zero-html5-shiv',
		'zero-async-script-load',
		'zero-thread-comments-script',
		'zero-menu-class-names',
		'zero-favicon',
		'zero-apple-touch-icon',
		'zero-login-theme',
	  'zero-pager',
	  'zero-nav-menus',
	  'zero-widget-areas',
		'zero-remove-gallery-css',
	  'zero-post-thumbnails',
	  'zero-comments',
	  'zero-options-page',
	  'zero-page-title',
	  'zero-apple-touch-startup-image',
	  'zero-nav-menu-container',
	  'zero-formalize',
	  'zero-nav-menu-helpers',
	  'zero-posts-helpers',
	);
	
	foreach( $features as $feature ) {
		require_if_theme_supports( $feature, $path.str_replace('zero-', '', $feature).'.php' );
	} 
}




require_once( dirname(__FILE__).'/includes/helpers.php' );
require_once( dirname(__FILE__).'/includes/template-loaders.php' );