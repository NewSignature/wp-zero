<?php
/**
 * Includes the Modernizr Library
 *
 * http://www.modernizr.com
 */
wp_register_script('modernizr', zero_get_overridden_file('/js/modernizr.js'), array(), '2.5.3');

function zero_modernizr_print_scripts() {
  wp_enqueue_script('modernizr');
}

add_action('wp_print_scripts', 'zero_modernizr_print_scripts');