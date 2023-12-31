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
/*function filter_photos_callback() {
    $categorie = $_POST['CATÉGORIE'];
    $format = $_POST['FORMAT'];

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

// Bouton Toutes les photos
function mota_assets() {
add_action( 'wp_ajax_mota_load_photos', 'mota_load_photos' );
add_action( 'wp_ajax_nopriv_mota_load_photos', 'mota_load_photos' );

function mota_load_photos() {
  
    // Vérification de sécurité
      if( 
        ! isset( $_REQUEST['nonce'] ) or 
           ! wp_verify_nonce( $_REQUEST['nonce'], 'mota_load_photos' ) 
    ) {
        wp_send_json_error( "Vous n’avez pas l’autorisation d’effectuer cette action.", 403 );
      }
    
    // On vérifie que l'identifiant a bien été envoyé
    if( ! isset( $_POST['postid'] ) ) {
        wp_send_json_error( "L'identifiant du post est manquant.", 400 );
      }

      // Récupération des données du formulaire
      $post_id = intval( $_POST['postid'] );
    
    // Vérifier que l'article est publié, et public
    if( get_post_status( $post_id ) !== 'publish' ) {
        wp_send_json_error( "Vous n'avez pas accès aux photos de ce post.", 403 );
    }

    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12,
      'tax_query' => array(
          'relation' => 'AND',
          array(
              'taxonomy' => 'CATÉGORIE',
              'field'    => 'slug',
              'terms'    => $categorie
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

      // Envoyer les données au navigateur
    wp_send_json_success( $html );
}
// Charger notre script
wp_enqueue_script( 
    'mota', 
    get_template_directory_uri() . '/js/script.js', [ 'jquery' ], 
  '1.0', 
  true 
);
}
}
add_action( 'wp_enqueue_scripts', 'mota_assets' );
*/