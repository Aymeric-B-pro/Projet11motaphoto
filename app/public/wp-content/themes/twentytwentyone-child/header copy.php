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

    <!-- Conteneur pour le logo et le menu -->
    <header class="site-header">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <?php the_custom_logo(); ?>
            </a>
        </div>
        
        <!-- Menu principal ajouté ici -->
        <div class="main-navigation">
            <nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'main-menu', 'twentytwentyone' ); ?>">  <!--se renseigner sur la fonction et la comprendre -->
            <div class="menu-button-container">
                <button id="primary-mobile-menu" class="button" aria-controls="main-menu-list" aria-expanded="false">
                    <span class="dropdown-icon open">
                        <?php echo twenty_twenty_one_get_icon_svg( 'ui', 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </span>
                    <span class="dropdown-icon close">
                        <?php echo twenty_twenty_one_get_icon_svg( 'ui', 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </span>
                </button><!-- #primary-mobile-menu -->
            </div><!-- .menu-button-container -->
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-menu', // Affiche le menu enregistré sous 'main-menu'
                    'menu_class'     => 'main-menu-class', // Classe CSS pour styliser le menu
                    'container'      => false, // Désactiver le conteneur par défaut
                ) );
                ?>
            </nav>
        </div>
    </header>



ANCIEN :
 <!-- Conteneur pour le logo et le menu -->
 <header class="site-header">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <?php the_custom_logo(); ?>
            </a>
        </div>
        
        <!-- Menu principal ajouté ici -->
        <nav class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu', // Affiche le menu enregistré sous 'main-menu'
                'menu_class'     => 'main-menu-class', // Classe CSS pour styliser le menu
                'container'      => false, // Désactiver le conteneur par défaut
            ) );
            ?>
        </nav>
    </header>


    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
