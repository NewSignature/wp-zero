  <?php get_sidebar(); ?>

  <footer role="contentinfo" id="footer">

      <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      &copy; <?php
      $current_year = (int) date('Y');
      $start_copyright_year = 2010;

      if( $start_copyright_year >= $current_year ) {
        echo $current_year;
      } else {
        echo $start_copyright_year.' - '.$current_year;
      }
      ?>

  </footer>

  </div><!-- #wrapper -->

  <script src="//code.jquery.com/jquery.min.js"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/core.js"></script>

  <?php wp_footer(); ?>

</body>
</html>