<?php if( is_active_sidebar( 'primary-sidebar' ) ): ?>
<section id="primary-sidebar"  role="complementary">
  <ul class="xoxo">
  <?php dynamic_sidebar( 'primary-widget-area' ); ?>
  </ul>
</section>
<?php endif; ?>
