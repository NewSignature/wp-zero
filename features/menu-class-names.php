<?php

/**
 * Add better classes to the nav menu items
 */
add_filter( 'nav_menu_css_class', 'zero_nav_menu_css_class', 10, 2);
add_filter( 'page_css_class', 'zero_nav_menu_css_class', 10, 2);
function zero_nav_menu_css_class( $classes, $item ){
  $title = '';
  // Figure out which field has the title
  if( isset($item->title) ){
    $title = $item->title;
  } elseif( !empty($item->post_title) ) {
    $title = apply_filters( 'the_title', $item->post_title, $item->ID );
  }
    
  if( !empty($title) ) {
    $classes[] = zero_slugify($title);
  }
  
  return $classes;
}
