<?php
/**
 * Based on the load_template but it allows extra variables to be set.
 */
function zero_load_template( $_template_file,  $_vars = array(), $require_once = true ) {
  global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
  
  if ( is_array( $wp_query->query_vars ) )
    extract( $wp_query->query_vars, EXTR_SKIP );
  
  extract( $_vars );
  
  if ( $require_once )
    require_once( $_template_file );
  else
    require( $_template_file );
}


/**
 * This checks if a file in the theme has been overridden in a sub-theme. 
 * If so, then it returns the path to the overridden, else the file in the zero theme.
 *
 * @param $path string 
 *
 * @return string
 */
function zero_get_overridden_file( $path ) {
  $subtheme = get_stylesheet_directory();
  $parenttheme = get_template_directory();
  
  
  if( file_exists( $subtheme.$path ) ) {
  
    return get_bloginfo( 'stylesheet_directory' ).$path;
  }
  
  if( file_exists( $parenttheme.$path ) ) {
    return get_bloginfo( 'template_directory' ).$path;
  }
  
  return false;
}


/**
 * Similar to the WordPress get_template_part but $name can accept an array
 * 
 * @param unknown_type $slug
 * @param unknown_type $name
 */
function zero_get_template_part( $slug, $name=null) {
	do_action( "get_template_part_{$slug}", $slug, $name );
	
	$templates = array();
	
	$names = (array) $name;
	foreach($names as $name) {
		$templates[] = $slug . '-' . $name . '.php';
	}
	
	$templates[] = $slug . '.php';
	
	locate_template($templates, true, false);
}