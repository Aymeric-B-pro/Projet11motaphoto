php
Copier le code
<?php
/**
 * Template Name: Catalogue
 * Description: Un modèle personnalisé pour afficher le catalogue de photos.
 */

get_header();
?>

<main class="photo-catalogue">
    <!-- Section pour le catalogue photo -->
    <section class="catalogue-photos">
        <div class="photo-grid">
            <?php
            // Définir la query pour obtenir les 8 premières photos du CPT "photos"
            $args = array(
                'post_type' => 'photos', // Le type de contenu personnalisé
                'posts_per_page' => 8, // Afficher 8 photos
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // Gérer la pagination
            );
            
            $photo_query = new WP_Query($args);

            if ($photo_query->have_posts()) :
                while ($photo_query->have_posts()) : $photo_query->the_post();
                    // Réutiliser le bloc d'affichage d'une photo
                    get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
                endwhile;
            else :
                echo '<p>Aucune photo trouvée.</p>';
            endif;

            // Réinitialiser les données de la query après la loop personnalisée
            wp_reset_postdata();
            ?>
        </div>

        <!-- Ajouter le bouton "Charger plus" ici plus tard pour la pagination Ajax -->
    </section>
</main>

<?php get_footer(); ?>