<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


	<div id="content" role="main" class="content-area">
			<?php 
			$template_names = array();
			
			// the loop template has several extended versions that are called:
			// loop-front.php
			// loop-single-<post type>-<post slug>.php
			// loop-single-<post type>.php
			// loop-single.php
			// loop-search.php
			// loop-date.php
			// loop-home.php
			// loop-taxonomy-<taxonomy>-<term>.php
			// loop-taxonomy-<taxonomy>.php
			// loop-taxonomy.php
			// loop-<post type>.php
			// loop-archive.php
			// loop-index.php
			// loop.php
			//
			// This is not designed to be as complete as the default WordPress template selection.
			// This is designed to minimize the amount of templates you have to start with in the sub-theme.
			// Your sub-theme can still add all the templates you normally have.
			if(is_singular()) {
				if(is_front_page()) {
					$template_names[] = 'front';
				}
				
				$post_type = get_post_type();
				$template_names[] = 'single-'.$post_type.'-'.$post->post_name;
				$template_names[] = 'single-'.$post_type;
				$template_names[] = 'single';
				
			} else {
				if(is_search()) {
				  $template_names[] = 'search';	
				}
				
				if(is_date()) {
					$template_names[] = 'date';
				}
				
				if(is_home()) {
					$template_names[] = 'home';
				}
				
				if(is_tax()) {
					$term = get_queried_object();
					$template_names[] = "taxonomy-{$term->taxonomy}-{$term->slug}";
					$template_names[] = "taxonomy-{$term->taxonomy}";
					$template_names[] = "taxonomy";
				}
				
				if(get_post_type()) {
					$template_names[] = get_post_type();
				}
				
				if(is_archive()) {
					$template_names[] = 'archive';
				}
				$template_names[] = 'index';
			}
			
			// Then display the title for non-singular
			if(!is_singular()) {
				zero_get_template_part( 'title', $template_names );
			}
			
			// Then we call the right loop
			zero_get_template_part( 'loop', $template_names ); ?>
	</div><!-- #content -->
 

<?php get_footer(); ?>
