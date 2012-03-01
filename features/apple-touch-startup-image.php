<?php
/**
 * Adds the links for the Apple Touch Icon.
 */
add_action( 'wp_head', 'zero_apple_touch_startup_image_wp_head' );
function zero_apple_touch_startup_image_wp_head( ) {
  // the path to the image
  $path = get_stylesheet_directory().'/images/';
  
  // try the cache first
  $image = wp_cache_get( 'apple-touch-startup-image', 'zero' );
  
  // If not cached or in debug mode, then go ahead of load them up
  if($icons == false || (defined('WP_DEBUG') && WP_DEBUG)) {
  	$image = file_exists($path.'apple-touch-startup-image.png')? 'yes' : 'no';
  	
    // Save to cache
    wp_cache_set( 'apple-touch-startup-image', $image, 'zero' );
  }
  
  // output the startup image
  if($image == 'yes') {
  	echo '<link rel="apple-touch-startup-image" href="'.get_bloginfo( 'stylesheet_directory' ).'/images/apple-touch-startup-image.png" />';
  }
  
  ?><meta name="apple-mobile-web-app-capable" content="yes" /><?php 
}