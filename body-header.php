<div id="wrapper">
	<header id="header" class="site-header">

  <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
	<<?php echo $heading_tag; ?> class="site-title">
	  <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
  </<?php echo $heading_tag; ?>>

  <div role="navigation">
      <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
      <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'zero' ); ?></a></div>
      <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
      <?php wp_nav_menu( array( 'container_class' => 'nav primary-nav', 'theme_location' => 'primary' ) ); ?>
    </div><!-- #access -->
	</header><!-- #header -->
	
	<div id="main">

