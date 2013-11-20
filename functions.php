<?php

/* include necessary site functions */
require_once locate_template( '/inc/helpers.php' );
require_once locate_template( '/inc/init.php' );
require_once locate_template( '/inc/cleanup.php' );
require_once locate_template( '/inc/wrapper.php' );
require_once locate_template( '/inc/sidebar.php' );

/* include theme related configuration functions */
require_once locate_template( '/inc/config.php' );
require_once locate_template( '/inc/post-types.php' );
require_once locate_template( '/inc/styles.php' );
require_once locate_template( '/inc/scripts.php' );
require_once locate_template( '/inc/sidebars.php' );
require_once locate_template( '/inc/menus.php' );
// require_once locate_template( '/inc/thumbnails.php' );

/* include theme reformaters */
require_once locate_template( '/inc/template.php' );
require_once locate_template( '/inc/rewrites.php' );
require_once locate_template( '/inc/relative-urls.php' );
require_once locate_template( '/inc/headers.php' );
