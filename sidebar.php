<?php if( is_active_sidebar( 'primary-sidebar' ) ): ?>
<div id="primary-sidebar"  role="complementary">
  <ul class="xoxo">
  <?php dynamic_sidebar( 'primary-widget-area' ); ?>
  </ul>
</div>
<?php endif; ?>
