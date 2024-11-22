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
    <section class="catalogue-photos">
        <div class="photo-grid">
            <?php
            $args = array(
                'post_type' => 'photos', 
                'posts_per_page' => 8, 
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            );
            $photo_query = new WP_Query($args);
            if ($photo_query->have_posts()) :
                while ($photo_query->have_posts()) : $photo_query->the_post();
                    get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
                endwhile;
            else :
                echo '<p>Aucune photo trouvée.</p>';
            endif;
            // Réinitialiser les données de la query après la loop personnalisée
            wp_reset_postdata();
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>