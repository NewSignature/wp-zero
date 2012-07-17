<?php
/**
 * Use the Modernizr built-in yepnope loader to load scripts in the head
 */
function zero_modernizr_loader_print_scripts() {
  global $wp_scripts;
  
  $pos = array_search('modernizr', $wp_scripts->queue);
  if($pos !== false) {
    //die('We have modernizr');
	$wp_scripts = new Zero_WP_Modernizr_Scripts($wp_scripts);
  }

  //var_dump($wp_scripts->queue);
}
 
add_action('wp_print_scripts', 'zero_modernizr_loader_print_scripts', 9999);


/**
 * Our Version of the WP_Scripts class
 */
 class Zero_WP_Modernizr_Scripts extends WP_Scripts {
   var $is_modernizr_load = false;
   var $modernizr_settings_buffer = '';
   var $modernizr_scripts_buffer = '';
   
   public function __construct(WP_Scripts $object) {
     foreach($object as $property => $value) {
       $this->$property = $value;
     }
   }
	
  function do_head_items() {
    $pos = array_search('modernizr', $this->queue);
	
	if( $pos === false ) {
      // There is no modernizr
	  return parent::do_head_items();
	} else {
	  // Flag that we are running
	  $this->is_modernizr_load = true;
	  
	  // print Modernizr
	  parent::do_item('modernizr', 0);
	  
	  // setup buffers
	  $this->modernizr_settings_buffer = '';
	  $this->modernizr_scripts_buffer = '';
	  
	  $this->do_items(false, 0);
	  
	  print $this->modernizr_settings_buffer . "\n" . $this->modernizr_scripts_buffer;
	  
	  // Kill flag
	  $this->is_modernizr_load = false;
	  
	  return $this->done;
	}
  }
 }