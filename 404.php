<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


<div id="main" role="main">
  <h1><?php _e( 'No Page Was Found' ); ?></h1>
  <div class="prose">
    <p><?php _e( 'Sorry, the page you are looking for cannot be found.' ); ?></p>
    <?php get_search_form(); ?>
  </div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>