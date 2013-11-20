<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>

  <title><?php wp_title(); ?></title>

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">

  <meta name="msapplication-TileColor" content="#f01d4f">
  <meta name="msapplication-TileImage"
        content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>

  <?php if ( false !== strpos( $_SERVER['HTTP_HOST'], DEV_DOMAIN_CONTAINS ) ): ?>
    <script src="http://localhost:35729/livereload.js"></script>
  <?php endif; ?>

</head>