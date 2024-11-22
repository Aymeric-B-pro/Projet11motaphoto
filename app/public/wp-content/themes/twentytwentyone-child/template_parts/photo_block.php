<?php
$photo_id = isset($args['photo_id']) ? $args['photo_id'] : 0;

if ($photo_id) {
    $thumbnail_url = get_the_post_thumbnail_url($photo_id, 'large');
    $photo_title = get_the_title($photo_id);
    $photo_permalink = get_permalink($photo_id);
    $terms = wp_get_post_terms($photo_id, 'categorie');
    $category_name = !empty($terms) ? esc_html($terms[0]->name) : '';

    echo '<div class="related-photo-block">';
    echo '<a href="' . esc_url($photo_permalink) . '">';

    if ($thumbnail_url) {
        echo '<div class="image-container">';
        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($photo_title) . '">';

        echo '<span class="overlay-icon view-icon"><i class="fa fa-eye"></i></span>';
        echo '<span class="overlay-icon fullscreen-icon lightbox-trigger" ';
        echo 'data-photo-url="' . esc_url($thumbnail_url) . '" ';
        echo 'data-photo-title="' . esc_attr($photo_title) . '" ';
        echo 'data-photo-category="' . esc_attr($category_name) . '">';
        echo '&#x26F6;</span>';

        echo '<div class="photo-info">';
        echo '<span class="photo-ref">' . esc_html(get_field('reference', $photo_id)) . '</span>';
        echo '<span class="photo-category">' . $category_name . '</span>';
        echo '</div>';

        echo '</div>'; // fin de .image-container
    }

    echo '</a>';
    echo '</div>';
} else {
    echo '<p>No Photo ID found.</p>';
}
?>