<?php
/**
 * Loads up the default set of stylesheets that the sub-theme can then over-ride by
 * creating a file of the same name in the sub-theme's css directory.
 */


wp_register_style( 'reset', zero_get_overridden_file('/css/reset.less'), array(), '2.0', 'all' );
wp_register_style( 'formalize', zero_get_overridden_file('/css/reset.less'), array(), '1.0', 'all' );
wp_register_style( 'print', zero_get_overridden_file('/css/print.less'), array(), ZERO_VERSION_NUMBER, 'print' );
wp_register_style( 'screen', zero_get_overridden_file('/css/screen.less'), array(), ZERO_VERSION_NUMBER, 'screen' );
wp_register_style( 'prose', zero_get_overridden_file('/css/prose.less'), array(), ZERO_VERSION_NUMBER, 'all' );
 
// Do not included them in the admin since this can cause side effects
if( !is_admin() ) {
  wp_enqueue_style( 'reset' );
  wp_enqueue_style( 'formalize' );
  wp_enqueue_style( 'print' );
  wp_enqueue_style( 'screen' );
  wp_enqueue_style( 'prose' );
}
