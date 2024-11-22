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
        <div class="filter-container">
            <div class="filter-group">
                <select id="category-filter">
                    <option value="">Catégories</option>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => true,
                    ));

                    foreach ($categories as $category) {
                        echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                    }
                    ?>
                </select>
                <select id="format-filter">
                    <option value="">Formats</option>
                    <?php
                    $formats = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => true,
                    ));

                    foreach ($formats as $format) {
                        echo '<option value="' . esc_attr($format->term_id) . '">' . esc_html($format->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filter-group">
                <select id="date-order">
                    <option value="">Trier par</option>
                    <option value="DESC">à partir des plus récentes</option>
                    <option value="ASC">à partir des plus anciennes</option>
                </select>
            </div>
        </div>
        <div class="photo-grid">
            <?php
            $args = array(
                'post_type'      => 'photo',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );
            $photo_query = new WP_Query($args);
            if ($photo_query->have_posts()) :
                while ($photo_query->have_posts()) : $photo_query->the_post();
                    get_template_part('template_parts/photo_block', null, array('photo_id' => get_the_ID()));
                endwhile;
            else :
                echo '<p>Aucune photo trouvée.</p>';
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="load-more-container">
            <button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
        </div>
    </section>
</main>

<?php get_footer(); ?>
