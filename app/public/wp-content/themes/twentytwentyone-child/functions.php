<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('child-theme-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
    wp_localize_script('child-theme-scripts', 'child_style_js', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

function register_my_menus() {
    register_nav_menus( array(
        'main-menu'   => __( 'Menu en tete', 'text-domain' ),
        'footer-menu' => __( 'Menu pied de page', 'text-domain' )
    ));
}
add_action( 'after_setup_theme', 'register_my_menus' );
function motaphoto_request_photos() {
    $args = array(
        'post_type'      => 'photo', // Le nom du Custom Post Type
        'posts_per_page' => 8        // Nombre de posts à récupérer
    );
    
    $query = new WP_Query($args);

    if($query->have_posts()) {
        $response = $query->posts; // On récupère les posts dans la réponse
    } else {
        $response = false; // Si aucun post trouvé, retourner false
    }

    wp_send_json($response); // Retourne la réponse en JSON
    wp_die(); // Terminer proprement l'exécution
}

add_action( 'wp_ajax_request_photos', 'motaphoto_request_photos' ); 
add_action( 'wp_ajax_nopriv_request_photos', 'motaphoto_request_photos' );

function get_random_photo_background() {
    // Requête pour obtenir les photos de votre CPT "photos"
    $args = array(
        'post_type'      => 'photo', // Nom du Custom Post Type
        'posts_per_page' => 1,        // On veut une seule photo aléatoire
        'orderby'        => 'rand'    // Trier aléatoirement
    );
    
    $random_photo = new WP_Query($args);

    if ($random_photo->have_posts()) {
        while ($random_photo->have_posts()) : $random_photo->the_post();
            // Obtenir l'URL de l'image à la une
            $photo_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            return $photo_url;
        endwhile;
    }
}

