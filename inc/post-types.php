<?php

function zero_create_post_types()
{
  $types = array(
    array(
      'slug'        => 'events',
      'single'      => 'Event',
      'plural'      => 'Events',
      'has_archive' => false,
      'supports'    => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
    )
  );

  $default_options = array(
    'public'             => true,
    'show_in_admin_bar'  => true,
    'publicly_queryable' => true
  );

  foreach ( $types as $type ) {
    $options = array(
      'supports'    => $type['supports'],
      'has_archive' => $type['has_archive'],
      'labels'      => zero_build_labels( $type )
    );

    register_post_type( $type['slug'], array_merge( $default_options, $options ) );
  }

  zero_create_taxonomies();

}

function zero_create_taxonomies()
{

  $taxonomies = array(
    array(
      'slug'   => 'areas-of-expertise',
      'single' => 'Area of Expertise',
      'plural' => 'Areas of Expertise'
    )
  );

  foreach ( $taxonomies as $t ) {

    $args = array(
      'hierarchical'      => true,
      'show_ui'           => true,
      'show_in_nav_menus' => true,
      'show_admin_column' => true,
      'labels'            => zero_build_labels( $t ),
      'rewrite'           => array(
        'hierarchical' => true
      )
    );

    switch ( $t['slug'] ) {
      case 'areas-of-expertise':
        register_taxonomy( $t['slug'], array( 'post' ), $args );
        break;
    }

  }
}

// make the post types
add_action( 'init', 'zero_create_post_types' );

// include all the post types in the RSS feed
function zero_include_post_types_in_main_feed( $qv )
{
  if ( isset($qv['feed']) )
    $qv['post_type'] = get_post_types();
  return $qv;
}

add_filter( 'request', 'zero_include_post_types_in_main_feed' );


// function to build labels
function zero_build_labels( $type )
{
  $labels = array(
    'name'          => $type['plural'],
    'singular_name' => $type['single'],
    'menu_name'     => $type['plural'],
    'add_new'       => "Add New " . $type['single'],
    'edit_item'     => "Edit " . $type['single'],
    'all_items'     => "All " . $type['plural'],
    'new_item'      => "New " . $type['single'],
    'view_item'     => "View " . $type['single'],
    'search_items'  => "Search " . $type['plural']
  );
  return $labels;
}

function zero_remove_all_meta_boxes()
{
  // remove_meta_box( 'areas-of-expertisediv', 'post', 'side' );

}

add_action( 'admin_menu', 'zero_remove_all_meta_boxes' );


