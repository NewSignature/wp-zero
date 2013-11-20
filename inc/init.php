<?php

/**
 * Initial setup and constants
 */
function zero_setup()
{

  // Make theme available for translation
  // load_theme_textdomain('dawn', get_template_directory() . '/library/translation');

  $get_theme_name = explode( '/themes/', get_template_directory() );

  define('RELATIVE_PLUGIN_PATH', str_replace( home_url() . '/', '', plugins_url() ));
  define('RELATIVE_CONTENT_PATH', str_replace( home_url() . '/', '', content_url() ));
  define('THEME_NAME', next( $get_theme_name ));
  define('THEME_PATH', RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
  define('GOOGLE_ANALYTICS_ID', '');
  define('POST_EXCERPT_LENGTH', 200);
  define('ASSETS_VERSION', '0.0.1');

  // enable livereload on the following domain
  define('DEV_DOMAIN_CONTAINS', 'dev');

}

add_action( 'after_setup_theme', 'zero_setup' );

// Backwards compatibility for older than PHP 5.3.0
if ( ! defined( '__DIR__' ) ) {
  define('__DIR__', dirname( __FILE__ ));
}
