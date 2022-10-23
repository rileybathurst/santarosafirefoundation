<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

<div class="site-header__wrapper">
	<img src="<?php echo get_option( 'header_image' ); ?>" alt="<?php echo get_option( 'header_alt' ); ?>" class="header_image" />
	
	<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">

	<div class="header-grid--overlay" style="background-color: <?php echo get_option( 'sides_of_header_image' ); ?>"><!-- stay gold --></div>

		<?php get_template_part( 'template-parts/header/site-branding' ); ?>

		<a href="<?php echo get_option( 'paypal_donate' ); ?>" class="paypal-donate">Donate</a>

		<?php get_template_part( 'template-parts/header/site-nav' ); ?>

		<?php if(is_front_page() ) { ?>
			<!-- <div class="the-heros">
				<img src="<?php echo get_option( 'hero_one' ); ?> " alt="" class="hero hero_one" />
				<img src="<?php echo get_option( 'hero_two' ); ?> " alt="" class="hero hero_two" />
				<img src="<?php echo get_option( 'hero_three' ); ?> " alt="" class="hero hero_three" />
			</div> -->
		<?php } ?>
	</header>
</div>