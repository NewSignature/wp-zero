<?php
/**
 * Handles the registration of widgetized areas. By defaults, it adds a primary sidebar and a footer.
 * 
 * The areas can be changed and added to with the zero_widget_areas filter
 */
add_action( 'widgets_init', 'zero_widgets_init' );
function zero_widgets_init() {
  $widget_areas = array(
    'primary-sidebar' => array(
      'name' => __('Primary Sidebar', 'zero'),
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
      'after_widget' => '</li>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ),
    'footer-area' => array(
      'name' => __('Footer Area', 'zero'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>',
    ),
  );
  
  $widget_areas = apply_filters( 'zero_widget_areas', $widget_areas );
  
  foreach( $widget_areas as $id => $args ) {
    if( !isset($args['id']) ) {
      $args['id'] = $id;
    }
    
    register_sidebar( $args );
  }
}

