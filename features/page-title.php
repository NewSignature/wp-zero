<?php
/**
 * 
 */
function zero_wp_title($separator = '|', $echo=true) {
	global $page, $paged;
	
	$title  = trim(wp_title( '', false));
	$site_name = get_bloginfo('name');
	$page_num = max( $paged, $page );
	$site_description = get_bloginfo( 'description', 'display' );
	
	$formatted_parts = array();
	
	// Display the site name with description on the homepage
	if(is_home() || is_front_page()){ 
		$formatted_parts['site_name'] = $site_name;
	  if(!empty($site_description)) {
	  	$formatted_parts['site_description'] = $site_description;
	  }
	
	// Display the title followed by the site name
	} else {
		$formatted_parts['title'] = $title;
		$formatted_parts['site_name'] = $site_name;
	}
	
  // Add the page number
	if($page_num > 1) {
		$formatted_parts['page_num'] = sprintf( __( 'Page %s', 'zero' ), $page_num );
	}
	
	// Call filter zero_wp_title for others to modify
	$formatted = implode( ' '.$separator. ' ', $formatted_parts);
	$formatted = apply_filters('zero_wp_title', $formatted, $formatted_parts, $separator, $title, $page_num, $site_name, $site_description);
		
	if($echo) {
		echo $formatted;
	}
	
	return $formatted;
}