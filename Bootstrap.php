<?php

define('ZERO_ROOT_DIR', dirname(__FILE__));
define('ZERO_FUNCTIONS_DIR', ZERO_ROOT_DIR . '/core/');

// Load Classes
//
// The classes will load if the class name is the same as the filename
// as a simple insurance that class names are not reused
//
foreach (glob(ZERO_FUNCTIONS_DIR . '*.php') as $filename) {

  $file_code = file_get_contents($filename);
  $file_classes = get_classes($file_code);
  $file_parts = pathinfo($filename);

  foreach ($file_classes as $file_class => $class_name) {
    if ($class_name == $file_parts['filename'] && !class_exists($class_name)) {
      include $filename;
    }
  }
}

function get_classes($file_code) {
  $classes = array();
  $tokens = token_get_all($file_code);
  $count = count($tokens);
  for ($i = 2; $i < $count; $i++) {
    if ($tokens[$i - 2][0] == T_CLASS
      && $tokens[$i - 1][0] == T_WHITESPACE
      && $tokens[$i][0] == T_STRING) {

      $class_name = $tokens[$i][1];
      $classes[] = $class_name;
    }
  }
  return $classes;
}