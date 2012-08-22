<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package solar
 * @since solar 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'solar' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrap clearfix">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<nav role="navigation" class="nav-blog">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			 <?php 
  $pages = get_pages(array('parent' => 0, 'exclude' => '84,88,80')); 
  foreach ( $pages as $page ): ?>
	<a href="<?php echo get_page_link( $page->ID ) ?>" title="<?php echo $page->post_title ?>"><?php echo $page->post_title ?></a>
<?php endforeach; ?>
			<a class="contact-us" href="mailto:work@gravityonmars.com"><i></i>Contact Us</a></li>
			
		</nav>
		
		<h1 id="logo">
<a href="<?php echo esc_url( home_url( '/notepad/' ) ); ?>" class="logo">
			<img class="screenshot " src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo-gom.png" alt="" />
		</a>
		</h1>
	</header><!-- #masthead .site-header -->

