<?php
/**
 * Template Name : single-photo
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
?>

<?php
get_header();

// Commence la boucle WordPress pour récupérer les données du CPT "photo"
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<div class="single-photo-container">

    <!-- Bloc de gauche : Informations sur la photo -->
    <div class="left-info-block">
        <h2><?php the_title(); // Titre de la photo ?></h2>
        <p>REFERENCE :<?php the_field('reference');?></p>
        <p>CATEGORIE : <?php the_terms($post->ID, 'categorie');?></p>
        <p>FORMAT : <?php the_terms($post->ID, 'format');?></p>
        <p>ANNÉE : <?php echo get_the_date();?></p>
    </div>

    <!-- Bloc de droite : Photo -->
    <div class="right-photo-block">
        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="photo-fullsize-link">
            <?php the_post_thumbnail('large'); ?>
        </a>
    </div>

    <!-- Bloc en dessous pour les interactions -->
    <div class="bottom-interactions-block">
        <b class="contact-link">
            <a href="#openModal" class="contactlink">Contactez-moi</a>
        </div>
        <div class="navigation-links">
            <a href="<?php echo get_previous_post_link(); ?>">Précédent</a>
            <a href="<?php echo get_next_post_link(); ?>">Suivant</a>
        </div>
    </div>

</div>

<?php
endwhile;
endif;

get_footer();
