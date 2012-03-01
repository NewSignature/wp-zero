<?php

class Zero_Active_Trail {
  
  /**
   * Returns a the active menu trail which is similar to a breadcrumb except 
   * each level also has its submenu.
   *
   * The arguments are:
   *   source => 'post' (default) | 'menu'
   *     What is the source for the menu.
   *
   *   post_id => 0 (default)
   *     For use when source is 'post'. If 0, then it uses the current post.
   *
   *
   */
  function get_active_trail_menu( $args=array() ) {
    $defaults = array(
      'source' => 'post', 
      'post_id' => 0,
    );
    $args = wp_parse_args( $args, $defaults );
    
    // get the items trail from the current to the start
    switch( $args['source'] ) {
      case 'post':
        $trail = $this->_build_trail_from_post( $args['post_id'] );
        break;
      
      case 'menu':
        return null;
        break;
      
      default:
        return null;
    }
    
    
    if( count($trail) == 0 ) {
      return null;
    }
    
    // build the root
    $menu = call_user_func_array( array($this, '_build_menu_item_from_'.$args['source']), array( $trail[0] ) );
    
    
    // build the sub menus
    $cur = $menu;
    reset( $trail );
    while( $cur ) {
      $cur->children = call_user_func_array( array($this, '_build_children_menu_items_from_'.$args['source']), array( $cur->id ) );
      $cur = $cur->get_child(next($trail));
    }
    
    
    // Add attribute sugar to the items
    reset( $trail );
    $up_rel = count($trail) == 1 ? array() : array_fill(0, count($trail)-1, 'up');
    $cur = $menu;
    while( $cur ) {
      
      // setup some nice attributes for the item in the trail
      $cur->attributes['class'][] = 'in-trail';
      if( count($up_rel) ) {
        $cur->attributes['rel'] = array_merge( $cur->attributes['rel'], $up_rel );
        array_pop($up_rel);
      }
      
      $next = $cur->get_child(next($trail));
      
      // For the last item
      if( !$next ) {
        $cur->attributes['class'][] = 'active';
      }

      $cur = $next;
    }
    
    
    
    return $menu;
  }
  
  
  /**
   * Returns an array of post_ids for the trail
   */
  function _build_trail_from_post( $post_id ) {
    $post = get_post( $post_id );
    $trail = array();
    
    do {
      $trail[] = $post->ID;
    } while( $post->post_parent && ($post = get_post( $post->post_parent )) );
    
    return array_reverse( $trail );
  }
  
  
  /**
   * Returns a Zero_Active_Trail_Item for a post
   */
  function _build_menu_item_from_post( $post_id ) {
    $post = get_post( $post_id );
    return new Zero_Active_Trail_Item(
      apply_filters('single_post_title', $post->post_title, $post),
      get_permalink( $post->ID ),
      $post->ID
    );
  }
  
  
  
  /**
   * Returns an array of Zero_Active_Trail_Items for the children
   */
  function _build_children_menu_items_from_post( $post_id ) {
    $posts = get_posts( array(
      'orderby' => 'menu_order title',
      'order' => 'ASC',
      'post_type' => 'any',
      'post_parent' => $post_id,
      'posts_per_page' => -1,
      'nopaging' => true,
    ) );
    
    $children = array();
    
    foreach( $posts as $post ) {
      $children[] = $this->_build_menu_item_from_post( $post );
    }
    
    
    return $children;
  }
}





/**
 * Active Trail Item
 *
 * An item in the active trail menu
 * 
 */
class Zero_Active_Trail_Item {
  
  private $_title;
  private $_url;
  private $_id;
  private $_children;
  private $_children_ids;
  public $attributes;
  
  /**
   * @param $title string - the title of the menu item
   * @param $url string - the URL for the item
   * @param $id - the menu ID
   * @param $attributes array (optional) - key value pair for attributes
   */
  function __construct( $title, $url, $id, $attributes=array() ) {
    $this->_title = $title;
    $this->_url = $url;
    $this->_id = $id;
    $this->attributes = array_merge( array( 'class' => array(), 'rel' => array(), ), $attributes );
    $this->_children = array();
    $this->_children_ids = array();
    
  }
  
  
  /**
   * Get a child by menu ID
   *
   * @param $id - menu ID
   *
   * @return Zero_Active_Trail_Item
   */
  function get_child( $id ) {
    if( ( is_string($id) || is_int($id) ) && array_key_exists( $id, $this->_children_ids ) ) {
      return $this->_children[ $this->_children_ids[$id] ];
    }
    return null;
  }
  
  
  /**
   * Set all the children
   *
   * @param $children array - an array of Zero_Active_Trail_Item
   */
  function set_children( $children ) {
    $this->_children = array();
    $this->_children_ids = array();
    
    foreach( $children as $child ) {
      $this->append_child( $child );
    }
  }
  
  
  /**
   * Get an array of the children
   *
   * @return array of Zero_Active_Trail_Item
   */
  function get_children( ) {
    return $this->_children;
  }
  
  
  /**
   * Append a Zero_Active_Trail_Item to the end of the children
   *
   * @param $child Zero_Active_Trail_Item
   */
  function append_child( $child ) {
    $this->_children[] = $child;
    $this->_children_ids[ $child->id ] = count($this->_children)-1;
  }
  
  
  function __get( $name ) {
    if( in_array( $name, array( 'title', 'url', 'id' ) ) ) {
      $name = '_'.$name;
      return $this->$name;
    }
    
    if( $name == 'children' ) {
      return $this->get_children();
    }
    
    return null;
  }
  
  
  
  function __set( $name, $value ) {
    if( in_array( $name, array( 'title', 'url', 'id' ) ) ) {
      $name = '_'.$name;
      $this->$name = $value;
    }
    
    if( $name == 'children' ) {
      return $this->set_children( $value );
    }
  }
  
  
  
  function as_link() {
    $o = '<a href="'.$this->url.'"';
    $o .= zero_get_formatted_attributes( $this->attributes );
    $o .= '>'.$this->title.'</a>';
    return $o;
  }
}








global $zero_active_trail;
$zero_active_trail = new Zero_Active_Trail();


function zero_get_active_trail_menu( $args=array() ) {
  global $zero_active_trail;
  return $zero_active_trail->get_active_trail_menu( $args );
}