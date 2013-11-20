<?php

class Template
{

  /*
   * Get the excerpt of shorten the content
   */
  public static function excerpt( $post = null )
  {
    if ( $post === null ) {
      global $post;
    }

    $content = (! empty($post->post_excerpt)) ? self::shorten( $post->post_excerpt ) : self::shorten( $post->post_content );

    return $content . '<a href="' . get_permalink() . '">Read More &rarr;</a>';
  }

  /*
   * Smartly truncate text
   */
  public static function shorten( $input, $ellipses = true, $strip_html = true, $length = 300 )
  {

    // strip tags, if desired
    if ( $strip_html ) {
      $input = strip_tags( $input );
    }

    // no need to trim, already shorter than trim length
    if ( strlen( $input ) <= $length ) {
      return $input;
    }

    // find last space within length
    $last_space   = strrpos( substr( $input, 0, $length ), ' ' );
    $trimmed_text = substr( $input, 0, $last_space );

    // add ellipses (...)
    if ( $ellipses ) {
      $trimmed_text .= '&#8230;';
    }

    return $trimmed_text;
  }

  /*
   * Pagination (older posts / newer posts links)
   */
  public static function paginate()
  {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ): ?>
      <nav id="pagination">
        <?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?>
        <?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?>
      </nav>
    <?php endif;
  }

  /*
   *  Use the Co-Authors plugin if installed
   */
  public static function co_authors( $links = true )
  {
    if ( function_exists( 'coauthors' ) && function_exists( 'coauthors_posts_links' ) ) {
      if ( ! $links ) {
        coauthors();
      } else {
        coauthors_posts_links();
      }
    } else {
      if ( ! $links ) {
        get_the_author();
      } else {
        the_author_posts_link();
      }
    }
  }

}