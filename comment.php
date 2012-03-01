    <div class="comment-entry">
      <header class="comment-author vcard">
        <?php if ($avatar_size != 0) echo get_avatar( $comment, $avatar_size ); ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
        <time pubdate datetime="<?php echo get_comment_date('c'); ?>"><?php
            /* translators: 1: date, 2: time */
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></time>
      </header>
      
      <div class="prose"><?php 
        if ($comment->comment_approved == '0') {
          echo '<p class="awaiting-moderation"><em>'.__('Your comment is awaiting moderation.').'</em><p>';
        }
        comment_text();
        ?></div>
  
      <div class="reply">
      <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth+1))) ?>
      </div>
    </div>