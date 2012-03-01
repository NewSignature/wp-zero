<?php get_sidebar(); ?>
</div>


<footer role="contentinfo" id="footer">


<?php
	//get_sidebar( 'footer' );
?>

			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				&copy; <?php 
				$current_year = (int) date('Y');
				$start_copyright_year = 2010;
				
				if( $start_copyright_year >= $current_year ) {
				  echo $current_year;
				} else {
				  echo $start_copyright_year.' - '.$current_year;
				}
				?>
			</div><!-- #site-info -->



	</footer>

</div><!-- #wrapper -->
