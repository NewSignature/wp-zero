<?php
/**
 * Loads the scripts for threaded comments to move the reply form below the comment.
 */
add_action('wp_print_scripts', 'zero_thread_comments_print_styles');
function zero_thread_comments_print_styles() {
	// Add Javascript
	if ( is_singular() && get_option( 'thread_comments' ) ) {
	  wp_enqueue_script( 'comment-reply' );
	}
}