<?php
// Ajouter des styles
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style-css', get_stylesheet_directory_uri().'/css/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function custom_theme_setup() {
    // Enregistrement de l'emplacement du menu
    register_nav_menus( array(
        'menu-principal' => esc_html__( 'Menu Principal', 'mota' ),
    ) );

    // Gestion du logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100, 
        'width'       => 400, 
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );
