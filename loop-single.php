<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('article'); ?>>
    <header>
      
      
      <?php // 1) Link to the parent post, this is used for Pages, attachments, and custom post-types that are hierarchical ?>
      <?php if ( !empty( $post->post_parent ) ) : ?>
        <span></span><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'zero' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
           printf( __( 'Go up to %s', 'zero' ), get_the_title( $post->post_parent ) );
          ?></a></span>
      <?php endif; ?>
      
   
      
      <?php // 3) Display the publish date of the post ?>
      
      
      <?php // 4) Display and link to the author ?>
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
      
      <?php // 5) Display the categories for the post ?>
      <?php get_the_category_list( ', ' ); ?>
      
      <?php // 6) Display the tags for the post ?>
      <?php the_tags( ); ?> 
      
      <?php // 7) Display the terms from a custom taxonomy ?>
      <?php // the_terms( $post->ID, 'TAXONOMY' );?>
      
      <?php // 8) Link to full size attachment ?>
      <?php if(wp_attachment_is_image()) {
        printf('<a href="%1$s">%2$s</a>', wp_get_attachment_url(),  __('View full-size image', 'zero'));
      } else if(wp_get_attachment_url())  {
        printf('<a href="%1$s">%2$s</a>', wp_get_attachment_url(),  __('Download', 'zero'));
      }?>
      
      <?php // 9) Display attachment meta data ?>
      <?php if ( is_attachment() && $metadata = wp_get_attachment_metadata()) {
        echo '<dl class="attachments">';
        foreach($metadata as $key => $val) {
        	echo '<dt>'.$key.'</dt>';
        	echo '<dd>';
        	switch($key) {
        		case 'image_meta':
        			echo '<dl>';
        			foreach($val as $imk => $imv) {
        				echo '<dt>'.$imk.'</dt>';
        				echo '<dd>'.$imv.'</dd>';
        			}
        			echo '</dl>';
        			break;
        		
        		case 'sizes':
        			echo '<ul>';
              foreach($val as $size) {
              	$image_url = wp_get_attachment_image_src($post->ID, array($size['width'], $size['height']));
                echo '<li><a href="'.$image_url[0].'">'.$size['width'].'x'.$size['height'].'</a></li>';
              }
              echo '</ul>';
        			break;
        			
        		default:
        			echo $val;
        	}
        	echo '</dd>';
        }
        echo '</dl>';
      } ?>
    </header>
    
    <div class="prose"><?php the_content(); ?></div>
    
    <footer>
      <?php edit_post_link( __( 'Edit', 'zero' ), ' <span class="edit-link">', '</span>' ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="pager">' . __( 'Pages:', 'zero' ), 'after' => '</div>' ) ); ?>
    </footer>
  
  <?php comments_template( '', true ); ?>
  
  </article>
<?php endwhile; // end of the loop. ?>