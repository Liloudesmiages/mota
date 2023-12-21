<?php

function theme_enqueue_styles() {
   
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style-css', get_stylesheet_directory_uri() . '/css/style.css');
    wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400&display=swap');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap', false );
    
    wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
 // Passez `ajaxurl` à votre script
 wp_localize_script('my-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
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

add_theme_support('post-thumbnails');

//fonction callback
function filter_photos_callback() {
    $categorie = $_POST['categorie'];
    $format = $_POST['format'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'CATÉGORIE',
                'field'    => 'slug',
                'terms'    => $categorie
            ),
            array(
                'taxonomy' => 'FORMAT',
                'field'    => 'slug',
                'terms'    => $format
            )
        )
    );
    // Effectuer la requête
    $query = new WP_Query($args);
    if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        echo '<div class="photo-carre">' . get_the_post_thumbnail(null, 'medium') . '</div>';
    }
} else {
    echo '<p>Aucune photo trouvée.</p>';
}
wp_reset_postdata();
die();
}
add_action('wp_ajax_filter_photos', 'filter_photos_callback');        // Pour les utilisateurs connectés
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_callback'); // Pour les utilisateurs non connectés