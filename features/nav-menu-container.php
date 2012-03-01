<?php
/**
 * Add the nav element to acceptable container element for nav menus
 */
add_filter('wp_nav_menu_container_allowedtags', 'zero_wp_nav_menu_container_allowedtags');
function zero_wp_nav_menu_container_allowedtags($allowed_tags) {
	$allowed_tags[] = 'nav';
	
	return $allowed_tags;
}