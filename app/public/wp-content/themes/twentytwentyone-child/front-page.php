<?php
/**
 * Template Name: template-acceuil
 * Description: Un modèle personnalisé pour la page d'accueil.
 */
get_header();
?>
<main class="home-page">
    <section class="hero" style="background-image: url('<?php echo get_random_photo_background(); ?>');">
        <div class="hero-content">
            <h1>PHOTOGRAPHE EVENT</h1>
        </div>
    </section>
    <section class="photo-catalogue">
        <h2>Catalogue de photos Test</h2>
        <div class="photo-grid">
            <?php
            // Requête pour obtenir les photos du CPT "photos"
            $args = array(
                'post_type'      => 'photo',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $photo_query = new WP_Query($args);

            if ($photo_query->have_posts()) :
                while ($photo_query->have_posts()) : $photo_query->the_post();
                    // Inclure le template part
                    get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
                endwhile;
            else :
                echo '<p>Aucune photo trouvée.</p>';
            endif;

            // Réinitialiser la requête globale après un custom WP_Query
            wp_reset_postdata();
            ?>
        </div>

        <!-- Bouton Charger plus (avec AJAX) -->
        <div class="load-more-container">
            <button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
        </div>
    </section>
</main>

<?php get_footer(); ?>
