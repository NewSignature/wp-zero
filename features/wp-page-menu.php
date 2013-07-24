<?php
/**
 * Make the wp_page_menu function better follow the args passed from wp_nav_menu
 */
add_filter( 'wp_page_menu', 'zero_wp_page_menu', 10, 2 );
function zero_wp_page_menu( $menu, $args ) {
  if ($args['container'] !== false) {
    $start ='<'.$args['container'].(!empty($args['container_id'])? ' id="'.esc_attr($args['container_id']).'"': '' ).(!empty($args['container_class'])? ' class="'.esc_attr(str_replace( '{menu slug}', 'page', $args['container_class'])).'"': '' ).'>';
    $end = '</'.$args['container'].'>';
  }
  else $start = $end = '';
  
  return preg_replace( '/^<div[^>]*>(.*)<\/div>$/', $start.'\1'.$end, $menu );
}
