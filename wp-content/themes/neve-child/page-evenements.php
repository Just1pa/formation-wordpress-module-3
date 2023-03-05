<?php
/*
Template Name: Evenements
*/

// Inclure l'en-tête de page WordPress
get_header();

// Récupère les événements depuis le custom post type "evenements"
$args = array(
    'post_type' => 'evenements',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date'
);

$query = new WP_Query($args);
if ($query->have_posts()) : ?>

    <!-- Boucle pour afficher les événements -->
    

        <div class="wp-block-cover alignfull" style="min-height:600px">
            <span aria-hidden="true" class="wp-block-cover__background has-nv-light-bg-background-color has-background-dim-100 has-background-dim"></span>
            <div class="wp-block-cover__inner-container">
                <div class="is-layout-flow wp-block-group">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="wp-block-group__inner-container">

                        <div class="is-layout-flex wp-container-6 wp-block-columns are-vertically-aligned-center">
                            <div class="is-layout-flow wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
                                <figure class="wp-block-image size-large">
                                        <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'large', array( 'class' => 'wp-image-37' ) ); ?>
    <?php endif; ?>
</figure>

                                <h3 class="has-text-align-center has-neve-text-color-color has-text-color"><?php the_title(); ?></h3>

                                <p class="has-text-align-center has-neve-text-color-color has-text-color"><?php the_content(); ?></p>

                                <div class="is-content-justification-center is-layout-flex wp-container-2 wp-block-buttons">
                                    <div class="wp-block-button is-style-primary">
                                            <p style="color:black;">Date de l'événement :<?php echo get_post_meta(get_the_ID(), 'evenement_metabox_date', true); ?></p>
                                            <a href="<?php echo get_permalink(); ?>"><button> Voir l'évènement ! 
                                            </button></a>
                                    </div>
</div> <!-- Fermeture de la div .wp-block-cover__inner-container -->

</div> <!-- Fermeture de la div .wp-block-cover -->
</div>
</div>
<?php endwhile; ?>
</div>
</div>
</div> <!-- Fermeture de la div .site-content -->

<?php endif; ?>