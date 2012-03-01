<?php
/**
 * This adds support for LESS throught the WP-LESS plugin which is included with Zero.
 * You can over-ride the WP-LESS plugin by installing and activating the plugin yourself.
 * This is done so that you can upgrade WP-LESS yourself.
 * 
 * If you set WP_DEBUG to true, then it will recompile the LESS files everytime you reload
 * the page.
 */

// Include WP-LESS that is included with Zero if plugin is not currently here
if( !class_exists('WPLessPlugin') ) {
  require_once( dirname(dirname(__FILE__)).'/libraries/wp-less/bootstrap-for-theme.php' );
  $WPLessPlugin->dispatch();
}

// Force all the LESS stylesheets to be compiled just in time - meaning everytime you reload, LESS runs
if( defined('WP_DEBUG') && WP_DEBUG && isset($GLOBALS['WPLessPlugin']) ) {
  global $WPLessPlugin;
  $WPLessPlugin->processStylesheets( true );
}