<?php
/**
 * The header template.
 *
 * Displays all of the <head> section and the header.
 *
 * @package WordPress
 * @subpackage Custom_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">

        <!-- Header principal -->
        <header id="mast" class="site-entete">
            <div class="header-container">
                <!-- Logo du site -->
                <div class="site-logo">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h1><?php bloginfo( 'name' ); ?></h1> <!-- Si pas de logo personnalisé -->
                    <?php endif; ?>
                </div>

                <!-- Navigation principale -->
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu', // Défini dans register_nav_menus
                        'menu_class'     => 'menu',
                        'container'      => false, // Pas de container autour du menu
                        'fallback_cb'    => false, // Pas de menu par défaut si non défini
                    ) );
                    ?>
                </nav>
            </div>
        </header><!-- #masthead -->

        <div id="content" class="site-content">