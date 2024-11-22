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
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php
		/* translators: Hidden accessibility text. */
		esc_html_e( 'Skip to content', 'twentytwentyone' );
		?>
	</a>

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

    <header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>">

        <?php get_template_part( 'template-parts/header/site-branding' ); ?>
        <?php get_template_part( 'template-parts/header/site-nav' ); ?>

    </header><!-- #masthead -->

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">