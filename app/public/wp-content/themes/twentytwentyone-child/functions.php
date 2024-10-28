<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
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
        'post_type'      => 'photo',
        'posts_per_page' => 8 
    );
    
    $query = new WP_Query($args);

    if($query->have_posts()) {
        $response = $query->posts;
    } else {
        $response = false;
    }

    wp_send_json($response);
    wp_die();
}

add_action( 'wp_ajax_request_photos', 'motaphoto_request_photos' ); 
add_action( 'wp_ajax_nopriv_request_photos', 'motaphoto_request_photos' );

function get_random_photo_background() {
    $args = array(
        'post_type'      => 'photo', // Nom du Custom Post Type
        'posts_per_page' => 1,        // On veut une seule photo aléatoire
        'orderby'        => 'rand'    // Trier aléatoirement
    );
    
    $random_photo = new WP_Query($args);

    if ($random_photo->have_posts()) {
        while ($random_photo->have_posts()) : $random_photo->the_post();
            $photo_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            return $photo_url;
        endwhile;
    }
}

function load_more_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Requête pour récupérer toutes les photos disponibles
    $total_photos_query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Récupérer tous les posts pour obtenir le nombre total
    ));
    $total_photos = $total_photos_query->found_posts; // Nombre total de photos

    // Requête principale avec pagination
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        ob_start();
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
        }
        $content = ob_get_clean();
        wp_send_json_success(array(
            'content' => $content,
            'total_photos' => $total_photos, // Envoyer le nombre total de photos
            'photos_loaded' => $paged * 8    // Calculer le nombre de photos chargées
        ));
    } else {
        wp_send_json_error('Aucune photo supplémentaire.');
    }

    wp_reset_postdata();
    wp_die();
}

// Déclarations AJAX
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
