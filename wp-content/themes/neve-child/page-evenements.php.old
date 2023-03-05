<?php
/*
Template Name: Evenements
*/


    // Inclure l'en-tête de page WordPress
    get_header();

    // Début de la boucle WordPress pour afficher les événements
    while (have_posts()) : the_post();

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
            <div class="evenements">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="evenement">
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                        <p>Date de l'événement : <?php echo get_post_meta(get_the_ID(), 'evenement_metabox_date', true); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php else : ?>

            <p>Aucun événement à afficher.</p>

        <?php endif;

        // Réinitialiser les données de la boucle
        wp_reset_postdata();

    endwhile;

    // Inclure le pied de page WordPress
    get_footer();

?>