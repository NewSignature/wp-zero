<?php
/**
 * Goes ahead and handles the registration of the nav menus. By default,
 * it adds a primary navigation menu. The values can be altered with zero_nav_menus hook.
 */
// This theme uses wp_nav_menu() in one location.
$nav_menus = apply_filters( 'zero_nav_menus', array(
  'primary' => __( 'Primary Navigation', 'zero' ),
) );
register_nav_menus( $nav_menus );