<?php
/**
 * Loads up the default set of stylesheets that the sub-theme can then over-ride by
 * creating a file of the same name in the sub-theme's css directory.
 */


wp_register_style( 'reset', zero_get_overridden_file('/css/reset.css'), array(), '2.0', 'all' );
wp_register_style( 'formalize', zero_get_overridden_file('/css/formalize.css'), array(), '2.0', 'all' );
wp_register_style( 'print', zero_get_overridden_file('/css/print.css'), array(), ZERO_VERSION_NUMBER, 'print' );
wp_register_style( 'screen', zero_get_overridden_file('/css/screen.css'), array(), ZERO_VERSION_NUMBER, 'screen' );
wp_register_style( 'prose', zero_get_overridden_file('/css/prose.css'), array(), ZERO_VERSION_NUMBER, 'all' );
 
// Do not included them in the admin since this can cause side effects
if( !is_admin() ) {
  wp_enqueue_style( 'reset' );
  wp_enqueue_style( 'formalize' );
  wp_enqueue_style( 'print' );
  wp_enqueue_style( 'screen' );
  wp_enqueue_style( 'prose' );
  
  add_action('wp_print_scripts', 'zero_formalize_print_scripts', 100);
  zero_formalize_register_scripts();
}



function zero_formalize_print_scripts() {
  global $wp_styles;
  
  // If the Formalize.css is not included, then abort
  if(empty($wp_styles->registered['formalize'])) {
    return;
  }
  
  // Add Javascript
  $libraries = array('dojo', 'extjs', 'mootools', 'prototype', 'yui');
  foreach($libraries as $library) {
  	if(wp_script_is($library, 'queue')) {
  		wp_enqueue_script('formalize-'.$library);
  		return;
  	}
  }
  
  // fallback to jQuery as the default
  wp_enqueue_script( 'formalize-jquery' );
}


/**
 * Register the formalize.css scripts for different libraries
 * 
 * Each script handler named is 'formalized-<library>'
 */
function zero_formalize_register_scripts() {
	
	// build the string template for the location of the script
	$path = get_bloginfo( 'template_directory' ).'/js/formalize/';
	$format = "{$path}%s.formalize.min.js";
	// If debugging, then show full version
	if(defined('WP_DEBUG') && WP_DEBUG) {
		$format = "{$path}%s.formalize.js";
	}
	
	$libraries = array('dojo', 'extjs', 'mootools', 'prototype', 'yui', 'jquery');
	
	foreach($libraries as $library) {
		wp_register_script('formalize-'.$library, sprintf($format, $library), array($library), '1.0');
	}
}
