<?php

function zero_scripts()
{

  if ( ! is_admin() ) {

    if ( current_theme_supports( 'jquery-cdn' ) ) {
      wp_deregister_script( 'jquery' );
      wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', false, '2.0.3', false );
      add_filter( 'script_loader_src', 'zero_jquery_local_fallback', 10, 2 );
    }

  }

}

add_action( 'wp_enqueue_scripts', 'zero_scripts', 100 );

/*
 * Provide a local jQuery fallback if CDN fails
 */
function zero_jquery_local_fallback( $src, $handle = null )
{
  static $add_jquery_fallback = false;

  if ( $add_jquery_fallback ) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/build/jquery.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ( $handle === 'jquery' ) {
    $add_jquery_fallback = true;
  }

  return $src;
}

add_action( 'wp_head', 'zero_jquery_local_fallback' );
