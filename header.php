<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php if(function_exists('zero_wp_title')) {
	zero_wp_title(); 
} else {
  wp_title( '|' );
  bloginfo('name');
}?></title>
	
<?php // TODO: Add SEO tags? ?>	

	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'body-header' ); ?>

