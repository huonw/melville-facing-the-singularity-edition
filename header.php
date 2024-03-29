<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */

?><!DOCTYPE html>
<!--[if IE ]>    <html <?php language_attributes(); ?> class="ie"> <![endif]-->
 <!--[if !(IE)]><!-->  <html <?php language_attributes(); ?>>  <!--<![endif]-->


<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<style type='text/css'>
#lang-select ul li { display: none; }
<?php
 global $q_config;

$langs = array();
  foreach ($q_config['enabled_languages'] as $lang) {
  if (qtrans_isAvailableIn($post->ID, $lang))
    $langs[] = "#lang-select li.lang-$lang";
}
echo implode(", ",$langs);
if ($langs)
  echo '{ display: inline-block;}';
?>
</style>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/OFL-Sorts-Mill-Goudy/ofl-normal.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/OFL-Sorts-Mill-Goudy/ofl-italic.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<noscript><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/noscript.css" /></noscript>
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
	  echo ' | ' . __($site_description);

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<meta name="viewport" content="width=device-width; initial-scale=1.0">
<?php wp_head();?>
</head>

<body <?php body_class(); ?>>
<?php get_sidebar();
?>

<div id="lang-select"><?php qtrans_generateLanguageSelectCode("text","lang-select"); ?></div>

<div id="wrapper">
	<div id="header">
	    <div>
	       <a href="<?php echo bloginfo('url');?>">
	          <img id="header-image" src="<?php bloginfo('stylesheet_directory') ?>/images/header.png" width="800" height="314"/>
               </a>
            </div>
		<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
						<a id="site-title-a" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>

		<img id="header-dinkus" src="<?php bloginfo('stylesheet_directory') ?>/images/dinkus.png" width="805" height="106" />
	</div><!--#header-->
<div id="content">
