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
        <div class="bloc-top" >
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
        <a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="photo-fullsize-link lightbox-trigger" data-photo-id="<?php echo get_the_ID(); ?>">
            <?php the_post_thumbnail('large'); ?>
        </a>

    </div>
        </div>
        <!-- Bloc du milieu -->
        <div class=middle-box>
            <div class="bottom-interactions-container">
                <div class="contact-left">
                    <p>Cette photo vous intéresse ?</p>
                </div>
                <div class="contact-link">
                <a href="#myModal" class="contactlink" data-ref-photo="<?php the_field('reference'); ?>">CONTACT</a>
                </div>
            </div>
        <?php
        // Obtenir le précédent et le suivant
        $prev_post = get_adjacent_post(false, '', true); // True pour précédent
        $next_post = get_adjacent_post(false, '', false); // False pour suivant

        // Si pas de précédent, retourner à la dernière photo
        if (empty($prev_post)) {
            $prev_post = get_posts(array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'order' => 'DESC'
            ))[0];
        }

        // Si pas de suivant, retourner à la première photo
        if (empty($next_post)) {
            $next_post = get_posts(array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'order' => 'ASC'
            ))[0];
        }
        ?>

        <div class="navigation-links">
            <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link prev-link">
                &larr;
                <span class="nav-preview prev-preview" style="background-image: url('<?php echo get_the_post_thumbnail_url($prev_post, 'thumbnail'); ?>');"></span>
            </a>
            <a href="<?php echo get_permalink($next_post); ?>" class="nav-link next-link">
                &rarr;
                <span class="nav-preview next-preview" style="background-image: url('<?php echo get_the_post_thumbnail_url($next_post, 'thumbnail'); ?>');"></span>
            </a>
        </div>
    </div>
        <!--- Bloc du bas -->
    <div class="bottom-box">
        <h3>Vous aimerez aussi</h3>
        <div class="photo-grid">
            <?php
            $terms = wp_get_post_terms(get_the_ID(), 'categorie');
            if (!empty($terms) && !is_wp_error($terms)) {
                $term = $terms[0];

                $args = array(
                    'post_type'      => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in'   => array(get_the_ID()), // Exclure la photo courante
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'categorie',
                            'field'    => 'term_id',
                            'terms'    => $term->term_id,
                        ),
                    ),
                );
                $related_photos = new WP_Query($args);

                if ($related_photos->have_posts()) :
                    while ($related_photos->have_posts()) : $related_photos->the_post();

                        $photo_id = get_the_ID();
                        get_template_part('template_parts/photo_block', null, array('photo_id' => $photo_id));
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
        </div>
    </div>

<?php
endwhile;
endif;

get_footer();
