<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>



<div class="index">
<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('article'); ?>>
    <header>
      <h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      <?php the_post_thumbnail(); ?>
      <time pubdate datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?> - <?php the_time(); ?></time>
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
      <?php get_the_category_list( ', ' ); ?>
      <?php the_tags( ); ?>
    </header>
    <div class="prose"><?php the_excerpt(); ?></div>
    
    <footer class="meta">
      <?php if ( comments_open() || have_comments() ) {
        comments_popup_link( __( 'Leave a comment'), __( '1 Comment' ), __( '% Comments' ) ); 
        } ?>
		</footer>
  </article>
<?php endwhile; // End the loop. Whew. ?>

<nav class="pager"><?php echo zero_paginate_index_links(); ?></nav>
</div>



