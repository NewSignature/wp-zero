<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<?php get_template_part( 'templates/head' ); ?>

<body <?php body_class(); ?>>

<!--[if lt IE 10]>
<div class="alert alert-warning"><?php _e( 'You are using an <strong>outdated</strong> browser. Please <a
    href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'dawn' ); ?>
</div><![endif]-->

<?php get_template_part( 'templates/document', 'header' ); ?>


<div class="main <?php echo zero_main_class(); ?>" role="main">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
      <?php include zero_template_path(); ?>
    <?php endwhile; ?>

    <?php echo Template::paginate(); ?>

  <?php else: ?>
    <?php get_template_part( 'templates/content/content', 'notfound' ); ?>
  <?php endif; ?>

</div>

<?php if ( zero_display_sidebar() ): ?>
  <?php include zero_sidebar_path(); ?>
<?php endif; ?>

<?php get_template_part( 'templates/document', 'footer' ); ?>

</body>
</html>
