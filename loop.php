<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
    <header>
      <h2 itemprop="name headline"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h2>

      <?php the_post_thumbnail(array(100,100), array('itemprop' => 'image')); ?>

      <time pubdate datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?> - <?php the_time(); ?></time>
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
      <?php get_the_category_list( ', ' ); ?>
      <?php the_tags( ); ?>
    </header>

    <section itemprop="articleBody"><?php the_excerpt(); ?></section>
    
    <footer class="meta">
      <?php if ( comments_open() || have_comments() ) {
        comments_popup_link( __( 'Leave a comment'), __( '1 Comment' ), __( '% Comments' ) ); 
        } ?>
		</footer>
    <meta itemprop="interactionCount" content="UserComments:<?php echo get_comments_number(); ?>"/>
  </article>
<?php endwhile; // End the loop. Whew. ?>

<?php echo zero_paginate_index_links(); ?>