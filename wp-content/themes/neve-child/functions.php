<?php 

/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}



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
	]);
}

add_action('init', 'save_the_earth_event');




?>

    
