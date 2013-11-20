<?php if ( is_active_sidebar( 'sidebar_primary' ) ) : ?>
  <article class="sidebar <?php echo zero_sidebar_class(); ?>" role="complementary">
    <?php dynamic_sidebar( 'sidebar_primary' ); ?>
  </article>
<?php else : ?>
  <article class="sidebar <?php echo zero_sidebar_class(); ?>" role="complementary">
    <div class="alert alert-help">
      <p><?php _e( "Please activate some Widgets.", "dawn" ); ?></p>
    </div>
  </article>
<?php endif; ?>
