<?php
/**
 * Adds the HTML5 Shiv to the head to make HTML5 elements work in IE8 and before
 */
add_action( 'wp_head', 'zero_html5_shiv_wp_head' );
function zero_html5_shiv_wp_head( ) {
  
  // HTML5 Shiv for IE
  $out = "<!--[if lt IE 9]>\n";
  $out .= ' <script src="'.get_bloginfo( 'template_directory' ).'/libraries/html5shiv/html5.js"></script>'."\n";
  $out .= "<![endif]-->";
  
  echo apply_filters('zero-html5-shiv', $out);
}