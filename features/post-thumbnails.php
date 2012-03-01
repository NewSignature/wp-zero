<?php
/**
 * Sets up the dimensions of the thumbnails.
 * The default is 200x150 with cropping. The defaults can be changes with the zero_thumbnail_setting filter
 */
$thumbnail_settings = apply_filters( 'zero_thumbnail_setting', array( 'width' => 200, 'height' => 150, 'crop' => true ) );
set_post_thumbnail_size( $thumbnail_settings['width'], $thumbnail_settings['height'], $thumbnail_settings['crop'] );
