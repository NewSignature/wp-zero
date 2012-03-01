<?php
/**
 * Adds the links for the Apple Touch Icon.
 */
add_action( 'wp_head', 'zero_apple_touch_icon_wp_head' );
function zero_apple_touch_icon_wp_head( ) {
	// the path to the images
  $path = get_stylesheet_directory().'/images/';
  
  // try the cache first
  $icons = wp_cache_get( 'apple-touch-icons', 'zero' );
  
  // If not cached or in debug mode, then go ahead of load them up
  if($icons == false || (defined('WP_DEBUG') && WP_DEBUG)) {
  	$icons = array();
  	// check if the image directory exists
	  if( is_dir($path) ) {
			
			if( $handle = opendir($path) ) {
				
				// Loop through all the images that match apple-touch-icon[-<X>x<Y>][-precomposed].png in name
				while( ($file = readdir($handle)) !== false ) {
					if( is_file($path.$file) && preg_match('#^apple-touch-icon(-(?P<x>\d+)x(?P<y>\d+))?(?P<precomposed>-precomposed)?\.png$#', $file, $matches) !== 0 ) {
						
						$attrs = array(
						  'href' => get_bloginfo( 'stylesheet_directory' ).'/images/'.$file,
						  'rel' => 'apple-touch-icon',
						);
						
					  if(!empty($matches['precomposed'])) {
	            $attrs['rel'] = 'apple-touch-icon-precomposed';
	          }
	          
	
						if(!empty($matches['x'])) {
							$attrs['sizes'] = $matches['x'].'x'.$matches['y'];
						}
	          
						$icons[] = $attrs;
					}
				}
			}
		  closedir( $handle );
	  }
	  
	  // Save to cache
	  wp_cache_set( 'apple-touch-icons', $attrs, 'zero' );
  }
  
  // output the icons
  foreach($icons as $attrs) {
    echo '<link '.zero_get_formatted_attributes($attrs)."/>\n";
  }
}