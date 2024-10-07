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

    <!-- Bloc de gauche -->
    <div class="left-info-block">
        <h2><?php the_title(); ?></h2>
        <p>REFERENCE : <?php the_field('reference');?></p>
        <p>CATEGORIE : <?php the_terms($post->ID, 'categorie');?></p>
        <p>FORMAT : <?php the_terms($post->ID, 'format');?></p>
        <p>ANNÉE : <?php echo get_the_date();?></p>
    </div>

    <!-- Bloc de droite -->
    <div class="right-photo-block">
        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="photo-fullsize-link">
            <?php the_post_thumbnail('large'); ?>
        </a>
    </div>

    <!-- Bloc du milieu -->
    <div class="bottom-interactions-container">
        <div class="contact-left">
            <p>Cette photo vous intéresse ?</p>
        </div>
        <div class="contact-link">
                <a href="#openModal" class="contactlink">CONTACT</a>
        </div>
    </div>
    <div class="navigation-links">
        <a href="<?php echo get_permalink(get_previous_post()); ?>" class="nav-link prev-link">
            &larr;
            <span class="nav-preview" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_previous_post(), 'thumbnail'); ?>');"></span>
        </a>
        <a href="<?php echo get_permalink(get_next_post()); ?>" class="nav-link next-link">
            &rarr;
            <span class="nav-preview" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_next_post(), 'thumbnail'); ?>');"></span>
        </a>
    </div>

</div>

</div>

<?php
endwhile;
endif;

get_footer();
