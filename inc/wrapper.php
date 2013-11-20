<?php

/*
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
function zero_template_path()
{
  return Dawn_Wrapping::$main_template;
}

function zero_sidebar_path()
{
  return new Dawn_Wrapping('templates/sidebar.php');
}

class Dawn_Wrapping
{

  // Stores the full path to the main template file
  static $main_template;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  public function __construct( $template = 'base.php' )
  {
    $this->slug      = basename( $template, '.php' );
    $this->templates = array( $template );

    if ( self::$base ) {
      $str = substr( $template, 0, - 4 );
      array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
    }
  }

  public function __toString()
  {
    $this->templates = apply_filters( 'zero_wrap_' . $this->slug, $this->templates );
    return locate_template( $this->templates );
  }

  static function wrap( $main )
  {
    self::$main_template = $main;
    self::$base          = basename( self::$main_template, '.php' );

    if ( self::$base === 'index' ) {
      self::$base = false;
    }

    return new Dawn_Wrapping();
  }
}

add_filter( 'template_include', array( 'Dawn_Wrapping', 'wrap' ), 99 );
