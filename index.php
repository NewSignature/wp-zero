<article <?php post_class( array( (has_post_thumbnail()) ? 'thumb' : 'no-thumb' ) ); ?>>

  <?php get_template_part( 'templates/content/content', 'excerpt' ); ?>

</article>