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

    <!-- Ajouter d'autres sections de contenu ici -->

</main>

<?php get_footer(); ?>
