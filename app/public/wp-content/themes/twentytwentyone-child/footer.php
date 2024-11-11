<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
?>

</main><!-- #main -->
</div><!-- #primary -->
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
        <nav aria-label="<?php esc_attr_e( 'Footer menu', 'twentytwentyone' ); ?>" class="footer-navigation">
            <ul class="footer-navigation-wrapper">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'items_wrap'     => '%3$s',
                        'container'      => false,
                        'depth'          => 1,
                        'link_before'    => '<span>',
                        'link_after'     => '</span>',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </ul><!-- .footer-navigation-wrapper -->
        </nav><!-- .footer-navigation -->
    <?php else : ?>
        <p style="color: red;">No footer menu assigned</p>
    <?php endif; ?>
        <!-- Lightbox structure -->
        <div id="lightbox" class="lightbox" style="display: none;">
            <div class="lightbox-content">
                <!-- Bouton de fermeture -->
                <span class="closelightbox">&times;</span>
                <!-- Navigation pour les photos précédentes et suivantes -->
                <div class="lightbox-navigation">
                    <a href="#" class="nav-linklight prev-linklight" id="prev-link">&larr;</a>
                    <a href="#" class="nav-linklight next-linklight" id="next-link">&rarr;</a>
                </div>
                <!-- Image et informations de la lightbox -->
                <img src="" id="lightbox-image" alt="Lightbox Image">
                <div class="lightbox-info">
                    <span class="photo-ref" id="lightbox-ref">Référence non disponible</span>
                    <span class="photo-category" id="lightbox-category">Catégorie non disponible</span>
                </div>
            </div>
        </div>

<?php wp_footer(); ?>
<?php get_template_part('template_parts/modal-contact'); ?>
</footer><!-- #colophon -->
</div><!-- #page -->
</body>
</html>

