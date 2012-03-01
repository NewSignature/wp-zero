<?php
/**
 * Sets up the WYSIWYG editor to use the prose.less stylesheet so you 
 * don't have to duplicate work.
 */

add_editor_style( array( 'css/reset.less', 'css/editor.less', 'css/prose.less' ) );


/**
 * Add the prose class name to the editor area
 */
add_filter( 'tiny_mce_before_init', 'zero_css_editor_mce_settings' );
function zero_css_editor_mce_settings( $initArray ) {
  $initArray['body_class'] = 'prose';
  return $initArray;
};


/**
 * Compile the LESS files to CSS
 */
add_filter( 'mce_css', 'zero_css_editor_mce_css' );
function zero_css_editor_mce_css( $mce_css ){
  if( !empty( $mce_css ) && class_exists('WPLessStylesheet') ){
    try {
      $stylesheets = explode( ',', $mce_css );
      $stylesheets_translated = array();
      $deps = new WP_Dependencies();
      $handles = array();
      
      foreach( $stylesheets as $stylesheet ) {
        if( preg_match( '#\.less$#', $stylesheet ) ) {
          $handle = preg_replace( '#^.*/([^./]+)\.[^\.]+$#', '\1', $stylesheet );
          $handles[] = $handle;
          $stylesheet = str_replace( get_bloginfo( 'template_directory' ), '', $stylesheet );
          $stylesheet = str_replace( get_bloginfo( 'stylesheet_directory' ), '', $stylesheet );
          $deps->remove( $handle );
          $deps->add( $handle, zero_get_overridden_file( $stylesheet) );
        } else {
          $stylesheets_translated[] = $stylesheet;
        }
      }
      
      
      $WPLessPlugin = WPLessPlugin::getInstance();
      $WPLessPlugin->processStylesheets(); // needed to set the upload dir
      
      $handles = array_unique( $handles );
      foreach( $handles as $handle ) { 
        $stylesheet = new WPLessStylesheet( $deps->registered[$handle] );

        if ( $stylesheet->hasToCompile()) {
          $stylesheet->save();
        }
        
        $stylesheets_translated[] = $stylesheet->getTargetUri();
      }
      return implode( ',', $stylesheets_translated );
      
     
    } catch( Exception $e ){  }
  }
  return $mce_css;
}


