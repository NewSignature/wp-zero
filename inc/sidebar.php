<?php
/**
 * Determines whether or not to display the sidebar based on an array of conditional tags or page templates.
 *
 * If any of the is_* conditional tags or is_page_template(template_file) checks return true, the sidebar will NOT be displayed.
 *
 * @param array   list of conditional tags (http://codex.wordpress.org/Conditional_Tags)
 * @param array   list of page templates. These will be checked via is_page_template()
 *
 * @return boolean True will display the sidebar, False will not
 *
 */
class Dawn_Sidebar
{

  private $conditionals;

  private $templates;

  private $singulars;

  public $display = true;

  function __construct( $conditionals = array(), $templates = array(), $singulars = array() )
  {
    $this->conditionals = $conditionals;
    $this->templates    = $templates;
    $this->singulars    = $singulars;

    $conditionals = array_map( array( $this, 'check_conditional_tag' ), $this->conditionals );
    $templates    = array_map( array( $this, 'check_page_template' ), $this->templates );
    $singles      = array_map( array( $this, 'check_singulars' ), $this->singulars );

    if ( in_array( true, $conditionals ) || in_array( true, $templates ) || in_array( true, $singles ) ) {
      $this->display = false;
    }
  }

  private function check_conditional_tag( $conditional_tag )
  {
    if ( is_array( $conditional_tag ) ) {
      return $conditional_tag[0]( $conditional_tag[1] );
    } else {
      return $conditional_tag();
    }
  }

  private function check_page_template( $page_template )
  {
    return is_page_template( $page_template );
  }

  private function check_singulars( $single_post )
  {
    return is_singular( $single_post );
  }
}
