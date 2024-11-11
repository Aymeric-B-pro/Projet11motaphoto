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

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function enqueue_lightbox_script() {
    wp_enqueue_script('lightbox', get_stylesheet_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_script');

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
        'post_type'      => 'photo', 
        'posts_per_page' => 1,        
        'orderby'        => 'rand'    
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
        'posts_per_page' => -1,
    ));
    $total_photos = $total_photos_query->found_posts;

    // Requête principale avec pagination
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',    // Du plus récent au plus ancien
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
            'total_photos' => $total_photos,
            'photos_loaded' => $paged * 8    // Calculer le nombre de photos chargées
        ));
    } else {
        wp_send_json_error('Aucune photo supplémentaire.');
    }

    wp_reset_postdata();
    wp_die();
}


function filter_photos() {
    // Récupérer les paramètres des filtres transmis via AJAX
    $category = isset($_POST['category']) ? intval($_POST['category']) : '';
    $format = isset($_POST['format']) ? intval($_POST['format']) : '';
    $date_order = isset($_POST['date_order']) ? sanitize_text_field($_POST['date_order']) : 'DESC';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Arguments de la requête principale
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8, // Nombre de photos à charger par page
        'paged' => $page,
        'orderby' => 'date',
        'order' => $date_order,
    );

    // Ajout des filtres de catégorie et de format si sélectionnés
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'term_id',
            'terms'    => $category,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'term_id',
            'terms'    => $format,
        );
    }

    // Exécuter la requête WP_Query avec les arguments filtrés
    $photo_query = new WP_Query($args);

    // Compter le nombre total de photos pour gérer le bouton "Load More"
    $total_photos_query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Récupère tous les posts pour compter le total
        'tax_query' => $args['tax_query'] ?? [], // Applique les filtres
    ));
    $total_photos = $total_photos_query->found_posts;

    // Récupération des résultats pour les photos
    if ($photo_query->have_posts()) {
        ob_start();
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            // Chargement du template pour chaque photo (ajuste selon ton thème)
            get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
        }
        $content = ob_get_clean();
        wp_send_json_success(array(
            'content' => $content,
            'total_photos' => $total_photos,
            'photos_loaded' => $page * 8 // Nombre de photos chargées jusqu'à présent
        ));
    } else {
        wp_send_json_error('Aucune photo trouvée.');
    }

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');