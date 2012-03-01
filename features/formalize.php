<?php
/**
 * Loads the scripts for formalize.css to add support for autofocus and placeholder for older browsers.
 */
if(!is_admin()) {
  add_action('wp_print_scripts', 'zero_formalize_print_styles', 100);
}
function zero_formalize_print_styles() {
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
	$path = get_bloginfo( 'template_directory' ).'/libraries/formalize/assets/js/';
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
if(!is_admin()) {
  zero_formalize_register_scripts();
}