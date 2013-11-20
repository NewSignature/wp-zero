<?php

/*
 * Enqueue styles here
 */
function zero_styles()
{

  // only load stylesheets for theme if user is not in admin panel

  if ( ! is_admin() ) {

    global $wp_styles;

    // the main theme stylesheet
    wp_register_style( 'dawn-main-styles', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), ASSETS_VERSION, 'all' );

    // enqueue the main stylesheet
    wp_enqueue_style( 'dawn-main-styles' );


    // load comments stylesheet where needed
    if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }


  }

}

add_action( 'wp_head', 'zero_styles', 1 );
