<section itemprop="comment" itemscope="" itemtype="http://schema.org/UserComments" id="section-comment-<?php comment_ID() ?>">
  <header>
    <div class="comment-author hcard" itemprop="creator" itemscope="" itemscope="http://schema.org/Person">
      <?php if ($avatar_size != 0) echo get_avatar( $comment, $avatar_size ); ?>
      <cite class="fn">
        <a itemprop="url" href="<?php comment_author_url(); ?>">
          <span itemprop="name"><?php comment_author(); ?></span>
        </a>
      </cite> <span class="says">says:</span>
    </div>

    <time itemprop="commentTime" pubdate datetime="<?php echo get_comment_date('c'); ?>"><?php
      /* translators: 1: date, 2: time */
      printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></time>

  </header>

  <div class="comment-content" itemprop="commentText"><?php
    if ($comment->comment_approved == '0') {
      echo '<p class="awaiting-moderation"><em>'.__('Your comment is awaiting moderation.').'</em><p>';
    }
    comment_text();
    ?>
  </div>

  <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth+1))) ?>
  </div>
</section>