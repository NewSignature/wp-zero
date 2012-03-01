<?php
/**
 * Make the wp_page_menu function follow the args betters passed from wp_nav_menu
 */
add_filter( 'wp_page_menu', 'zero_wp_page_menu', 10, 2 );
function zero_wp_page_menu( $menu, $args ) {
  
  $start ='<'.$args['container'].(!empty($args['container_id'])? ' id="'.esc_attr($args['container_id']).'"': '' ).(!empty($args['container_class'])? ' class="'.esc_attr(str_replace( '{menu slug}', 'page', $args['container_class'])).'"': '' ).'>';
  $end = '</'.$args['container'].'>';
  
  return preg_replace( '/^<div[^>]*>(.*)<\/div>$/', $start.'\1'.$end, $menu );
}
