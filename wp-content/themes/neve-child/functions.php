<?php 

/**
** activation theme
**/

//J'ajoute ici un fichier functions php dans mon thème enfant, ci dessous j'ajoute mon lien avec le sytle du parent 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


//Je crée mes Custom Post type evenements 
function save_the_earth_event(){
	register_post_type('evenements',[
		'label'=>'Evènements',
		'public'=>true,
		'menu_position'=>4,
		'menu_icon'=>'dashicons-calendar',
		'supports'=> ['title', 'editor','thumbnail'],
		'show_in_rest'=>true,
		'has-archive'=>true,
		'rewrite' => array( 'slug' => 'evenements' ), 
		//Si on n'ajoute pas rewrite, cela ne fonctionne pas sur les single posts 
	]);
}

add_action('init', 'save_the_earth_event');




?>

    
