<?php

function theme_enqueue_styles() {
   
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style-css', get_stylesheet_directory_uri() . '/css/style.css');
    wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400&display=swap');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap', false );
    
    wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

//hook
function custom_theme_setup() {
    // Enregistrement du menu principal
    register_nav_menus(array(
        'menu-principal' => 'Menu Principal',
    ));

    // Support pour le logo personnalisé
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

//footer
function register_theme_menus() {
    register_nav_menus(
        array(
            'footer-menu' => __('Footer Menu', 'mota'), 
        )
    );
}
add_action('after_setup_theme', 'register_theme_menus');
