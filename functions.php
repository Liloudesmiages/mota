<?php
// Ajouter des styles
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style-css', get_stylesheet_directory_uri().'/assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


// declaration de menus dans wordpress
function monmenu() {
    register_nav_menu('header',__( 'Header' ));
    register_nav_menu('footer',__( 'Footer' ));
}

add_action( 'init', 'monmenu' );
