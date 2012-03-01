<?php


class Zero_Walker_Comment extends Walker_Comment {

	/**
	 * @see Walker::start_lvl()
	 * @since unknown
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of comment.
	 * @param array $args Uses 'style' argument for type of HTML list.
	 */
	function start_lvl(&$output, $depth, $args) {
		$GLOBALS['comment_depth'] = $depth + 1;
    
    if( !empty( $args['level_element'] ) ) {
      echo '<'.$args['level_element'].' '.zero_get_formatted_attributes($args['level_element_attributes']).'>';
    }
	}

	/**
	 * @see Walker::end_lvl()
	 * @since unknown
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of comment.
	 * @param array $args Will only append content if style argument value is 'ol' or 'ul'.
	 */
	function end_lvl(&$output, $depth, $args) {
		$GLOBALS['comment_depth'] = $depth + 1;
    
    if( !empty( $args['level_element'] ) ) {
      echo '</'.$args['level_element'].'>';
    }
	}



	/**
	 * @see Walker::start_el()
	 * @since unknown
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $comment Comment data object.
	 * @param int $depth Depth of comment in reference to parents.
	 * @param array $args
	 */
	function start_el(&$output, $comment, $depth, $args) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
    
		echo '<'.$args['element'].' ';
		comment_class(empty( $has_children ) ? '' : 'parent');
		echo ' id="comment-';
		comment_ID();
		echo '">';
		

		if ( !empty($args['callback']) ) {
			call_user_func($args['callback'], $comment, $args, $depth);
			return;
		}
		
		$args['args'] = $args;
		if( $template = locate_template( array( 'comment-'.$comment->comment_type.'.php', 'comment.php'), false ) ){
		  zero_load_template( $template, array_merge( $args, array( 'comment_depth' => $args['depth'] ) ), false );
		}
		
	}

	/**
	 * @see Walker::end_el()
	 * @since unknown
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $comment
	 * @param int $depth Depth of comment.
	 * @param array $args
	 */
	function end_el(&$output, $comment, $depth, $args) {
		if ( !empty($args['end-callback']) ) {
			call_user_func($args['end-callback'], $comment, $args, $depth);
			return;
		}

		echo '</'.$args['element'].'>';

	}
	
	
	
	function paged_walk( $elements, $max_depth, $page_num, $per_page, $args ) {
	  
	  $extra_args = func_get_args();
	  $extra_args[4] = array_merge( array( 'level_element' => '', 'element' => 'article' ), $extra_args[4] );
	  
	  return call_user_func_array( array(parent, 'paged_walk'), $extra_args );
	}
	
	
	function walk( $elements, $max_depth, $page_num, $per_page, $args ) {
	  
	  $extra_args = func_get_args();
	  $extra_args[4] = array_merge( array( 'level_element' => '', 'element' => 'article' ), $extra_args[4] );
	  
	  return call_user_func_array( array(parent, 'walk'), $extra_args );
	}

}