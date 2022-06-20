<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<meta
		http-equiv="Content-Security-Policy"
		content="default-src 'self';
			style-src 'self' *.wp.com 'unsafe-inline';
			script-src 'self' *.wp.com 'unsafe-inline' https://www.google.com https://www.gstatic.com;
			img-src 'self' *.wp.com secure.gravatar.com https://www.paypalobjects.com https://www.paypalobjects.com;
			font-src 'self' *.wp.com data:;
			child-src https://www.youtube.com https://player.vimeo.com;
			frame-src https://www.youtube.com https://player.vimeo.com;"
		/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?></a>
		
		<?php get_template_part( 'template-parts/header/site-header' ); ?>
		<?php get_template_part( 'events' ) ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
