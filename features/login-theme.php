<?php
/**
 * Adds custom CSS and changes the WordPress logo and link to the current site
 */

/**
 * Add CSS to customize the login page
 */
add_action( 'login_head', 'zero_login_theme_login_head' );
function zero_login_theme_login_head() {
  $styles = new WP_Styles();
  
  // TODO: create a search order for file extensions for stylesheets
  if( file_exists( get_stylesheet_directory().'/css/login.less' ) ) {
    $styles->add( 'custom-login', get_bloginfo( 'stylesheet_directory' ).'/css/login.less' );
    $styles->enqueue( 'custom-login' );
  } else if( file_exists( get_stylesheet_directory().'/css/login.css' ) ) {
    $styles->add( 'custom-login', get_bloginfo( 'stylesheet_directory' ).'/css/login.css' );
    $styles->enqueue( 'custom-login' );
  }

  
  $styles = apply_filters( 'zero_write_login_styles', $styles );
  
  $styles->do_items();
}



/**
 * Change the logo to link to the site's homepage instead of WordPress.org
 */
add_filter( 'login_headerurl', 'zero_login_theme_login_headerurl' );
function zero_login_theme_login_headerurl( $url ) {
  return home_url( '/' );
}



/**
 * Change the text of the logo to be the site's name instead of WordPress
 */
add_filter( 'login_headertitle', 'zero_login_theme_login_headertitle' );
function zero_login_theme_login_headertitle( $url ) {
  return esc_attr( get_bloginfo( 'name' ) );
}
