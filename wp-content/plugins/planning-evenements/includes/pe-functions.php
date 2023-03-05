<?php 

// Enregistre la fonction evenement_metabox_register_plugin lors de l'activation du plugin
register_activation_hook(__FILE__, 'evenement_metabox_register_plugin');

// Enregistre la fonction evenement_metabox_deregister_plugin lors de la désactivation du plugin
register_deactivation_hook(__FILE__, 'evenement_metabox_deregister_plugin');

// Charger la bibliothèque Flatpickr et initialiser la metabox
add_action( 'admin_enqueue_scripts', 'evenement_metabox_enqueue_scripts' );
function evenement_metabox_enqueue_scripts() {
    wp_enqueue_script( 'flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', array(), '4.6.3', true );
    wp_enqueue_script( 'evenement-metabox', plugin_dir_url( __FILE__ ).'evenement-metabox.js', array( 'jquery', 'flatpickr' ), false, true );
    wp_enqueue_style( 'flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), '4.6.3' );
}



// Ajoute la meta box lorsque la fonction evenement_metabox_add_meta_box est appelée
function evenement_metabox_add_meta_box() {
	$post_types = array('evenements');
    foreach ($post_types as $post_type) {
    add_meta_box(
        'evenement_metabox_date', // ID de la meta box
        'Quelle est la date ?', // Titre de la meta box
        'evenement_metabox_render', // Fonction de rendu de la meta box
        'evenements', // Type de contenu sur lequel ajouter la meta box (ici les articles)
        'side', // Emplacement de la meta box
        'default' // Priorité de la meta box
    );
}
}

// Fonction de rendu de la meta box
function evenement_metabox_render($post) {
    // Récupère la valeur de la meta box enregistrée pour l'article courant
    $value = get_post_meta($post->ID, 'evenement_metabox_date', true);
    // Affiche la meta box avec une case à cocher
    ?>
	<label for="evenement_metabox_date">Choisissez la date de l'évènement </label>
    <input class="flatpickr flatpickr-input active" type="date" id="evenement_metabox_date" name="evenement_metabox_date" value="<?php echo esc_attr( $value ); ?>" />
    <input type="hidden" name="evenement_metabox_date_hidden" id="evenement_metabox_date_hidden" value="<?php echo esc_attr( $value ); ?>" />

    <?php
    
}

// Enregistre la valeur de la meta box lorsque l'article est enregistré
function evenement_metabox_save_meta_box($post_id) {
    // Vérifie que la meta box a été envoyée et que l'utilisateur actuel peut éditer l'article
    if (isset($_POST['evenement_metabox_date_hidden']) && current_user_can('edit_post', $post_id)) {
        // Enregistre la valeur de la meta box pour l'article courant
        $date_value = sanitize_text_field($_POST['evenement_metabox_date_hidden']);
        update_post_meta($post_id, 'evenement_metabox_date', $date_value);
        echo $date_value;
    } else {
        // Supprime la valeur de la meta box pour l'article courant
        delete_post_meta($post_id, 'evenement_metabox_date');
    }
}
add_action('save_post', 'evenement_metabox_save_meta_box');


// Enregistre la fonction evenement_metabox_add_meta_box lorsque les meta boxes sont initialisées
add_action('add_meta_boxes', 'evenement_metabox_add_meta_box');

function save_the_earth_event_single_template($single_template) {
    global $post;

    // Check if the post type is "evenements"
    if ( $post->post_type == 'evenements' ) {

        // Set the path to your single template file
        $single_template = plugin_dir_path( __FILE__ ) . 'single-evenements.php';
    }
    return $single_template;
}

add_filter( 'single_template', 'save_the_earth_event_single_template' );



// Supprime la meta box lorsque la fonction evenement_metabox_deregister_plugin est appelée
function evenement_metabox_deregister_plugin() {
    remove_meta_box('evenement_metabox_date', 'post', 'side');
}
?>