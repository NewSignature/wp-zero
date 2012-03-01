<?php
/**
 * Provides additional helper functions for dealing with WordPress' navigation menus.
 */

/**
 * Retrieve the bare structure of a nav menu instead of the formatted output.
 * 
 * @param $args - the same arguments you pass into wp_nav_menu (the fallback and output arguments do not apply)
 */
function zero_get_nav_menu($args=array()) {
  $args = wp_parse_args($args, array());
  $args = apply_filters( 'wp_nav_menu_args', $args );
  $args = (object) $args;
  
  // Get the nav menu based on the requested menu
  $menu = wp_get_nav_menu_object( $args->menu );
  
  // Get the nav menu based on the theme_location
  if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
  }
    
  // Bail if nothing was found
  if(!$menu) {
    return array();
  }
  
  // If the menu exists, get its items.
  if ( $menu && ! is_wp_error($menu) && !isset($menu_items) ) {
    $menu_items = wp_get_nav_menu_items( $menu->term_id );
  }
  
  // Set up the $menu_item variables
  _wp_menu_item_classes_by_context( $menu_items );
  
  // Sort the menu items
  $sorted_menu_items = array();
  foreach ( (array) $menu_items as $key => $menu_item ) {
    $sorted_menu_items[$menu_item->menu_order] = $menu_item;
  }
  $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );
  
  // Build lookup from parent to child
  $parent_to_children = array();
  foreach($sorted_menu_items as $item) {
    // Make sure an array exists to add to
    if(!isset($parent_to_children[$item->menu_item_parent])) {
      $parent_to_children[$item->menu_item_parent] = array();
    }
    
    $parent_to_children[$item->menu_item_parent][] = $item;
  }
  
  
  $menu_tree = _zero_get_nav_menu_walk($sorted_menu_items, $parent_to_children, 0);
  
  return $menu_tree;
} 


/**
 * @private
 * 
 * The recursive callback for walking the menu for zero_get_nav_menu_walk
 * 
 * @param unknown_type $menu_items
 * @param unknown_type $parent_to_children
 * @param unknown_type $current_id
 */
function _zero_get_nav_menu_walk(&$menu_items, &$parent_to_children, $current_id) {
  if(isset($parent_to_children[$current_id])) {
    $tree = $parent_to_children[$current_id];
    
    foreach($tree as $item) {
      $item->children = _zero_get_nav_menu_walk($menu_items, $parent_to_children, $item->ID);
    }
    
    return $tree;
  }
  
  return array();
}