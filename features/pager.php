<?php


/**
 * A wrapper for the paginate_links that sets certain args for the index pager
 *
 * @param $args - the same as for paginate_list
 */
function zero_paginate_index_links( $args=array() ) {
  // Taken from http://codex.wordpress.org/Function_Reference/paginate_links
  global $wp_rewrite, $wp_query;			
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  
  $pagination = array(
    'base' => @add_query_arg('page','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'show_all' => true,
    'type' => 'plain',
    );
  $pagination = wp_parse_args( $args, $pagination );
  
  
  if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
  
  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array('s'=>get_query_var('s'));
  
  return paginate_links($pagination); 		
}


