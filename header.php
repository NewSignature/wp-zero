<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns#">
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php if(function_exists('zero_wp_title')) {
    zero_wp_title();
  } else {
    wp_title( '|' );
    bloginfo('name');
  }?></title>

  <?php // TODO: Add SEO tags? ?>

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" />

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <div id="wrapper">

  <header id="header" role="banner">
    <hgroup>
      <h1 id="header-title">
        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      <h1>
      <h2 id="header-subtitle">
      </h2>
    </hgroup>
  </header><!-- #header -->

  <nav id="navigation" role="navigation">
    <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
    <a class="skip" href="#main" title="Skip to content">Skip to content</a>
    <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
    <?php wp_nav_menu( array( 'container_class' => 'nav', 'theme_location' => 'primary' ) ); ?>
  </nav><!-- #access -->