<?php

/*
 * Add theme features
 */

add_theme_support( 'html5' );
add_theme_support( 'nice-search' );
add_theme_support( 'rewrites' );
add_theme_support( 'dawn-relative-urls' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'menus' );
add_theme_support( 'jquery-cdn' );

// Add post formats (http://codex.wordpress.org/Post_Formats)
// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));


/**
 * .main classes
 */
function zero_main_class()
{
  if ( zero_display_sidebar() ) {
    $class = 'ninecol first';
  } else {
    $class = 'twelvecol first';
  }

  if ( is_search() || is_archive() ) {
    $class .= ' list-view';
  }

  return $class;
}

/**
 * .sidebar classes
 */
function zero_sidebar_class()
{
  return 'threecol';
}


/**
 * Define which pages shouldn't have the sidebar
 *
 * Example:
 *
 * Home page, Events page, News page, single events, single news
 * should not have sidebars:
 *
 *
 * $sidebar_config = new Dawn_Sidebar(
 *  array(
 *    'is_home',
 *    'is_front_page
 *  ),
 *  array(
 *    'page-events.php',
 *    'page-news.php'
 *  ),
 *  array(
 *    'events',
 *    'news'
 *  )
 * );
 *
 *
 *
 */
function zero_display_sidebar()
{
  $sidebar_config = new Dawn_Sidebar(

  // WP conditionals with no sidebars
    array(),

    // singular page templates with no sidebars
    array(),

    // singular post types with no sidebars
    array()

  );

  return apply_filters( 'zero_display_sidebar', $sidebar_config->display );
}
