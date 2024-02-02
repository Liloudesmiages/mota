<?php

function theme_enqueue_styles()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style-css', get_stylesheet_directory_uri() . '/css/style.css');
    wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:wght@400&display=swap');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap', false);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Space+Mono&display=swap');
    wp_enqueue_script('my-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function theme_enqueue_fancybox_styles()
{
    wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_fancybox_styles');

//hook
function custom_theme_setup()
{
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
function register_theme_menus()
{
    register_nav_menus(
        array(
            'footer-menu' => __('Footer Menu', 'mota'),
        )
    );
}
add_action('after_setup_theme', 'register_theme_menus');

add_theme_support('post-thumbnails');

//Page d'accueil
function filter_photos()
{
    //Vérifie si le nonce est défini et valide pour s'assurer que la requête provient d'une source autorisée.
    if (!isset($_POST['ajax_nonce']) || !wp_verify_nonce($_POST['ajax_nonce'], 'filter_photos_nonce')) {
        die('Security check failed');
    }
    $pagenumber = $_POST['pagenumber'];
    $postnumbers = 12;
    $posttotal = $pagenumber * $postnumbers;

    $argsphotos = array(
        'post_type' => 'photo',
        'posts_per_page' => $posttotal
    );

    if (isset($_POST['categorie']) and $_POST['categorie'] != "") {
        $categ = $_POST['categorie'];
        $argsphotos['tax_query'][] =
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categ,
            );
    }

    if (isset($_POST['format']) and $_POST['format'] != "") {
        $format = $_POST['format'];
        $argsphotos['tax_query'][] =
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
            );
    }

    if (isset($_POST['tri']) and $_POST['tri'] != "") {
        $tri = $_POST['tri'];
        $argsphotos['order'] = $tri;
    }

    $my_query = new WP_Query($argsphotos);

    $numberpages = $my_query->max_num_pages; ?>
    <input type="hidden" id="maxpages" value="<?php echo $numberpages; ?>">
    <?php
    ob_start();
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
            $images = get_field('photo'); // nom champ galerie ACF
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $reference = get_field('RÉFÉRENCE', $image_id); // nom de champ
            $categoriesf = get_the_terms(get_the_ID(), 'categorie');

    ?>
            <div class="photobook">
                <img class="event" src="<?php echo get_the_post_thumbnail_url(); ?>" />
                <div class="overlay">
                    <div class="content">
                        <div class="l1">
                            <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="fsb" data-fancybox="photo" data-caption="<div class='fancygroup'><span class='refph'>REFERENCE DE LA PHOTO: <?php echo esc_html($reference); ?></span><span class='catg'>CATEGORIE: <?php echo $categoriesf[0]->name;  ?></span></div>">
                                <img class="full-screen" src="<?php echo get_template_directory_uri() ?>/assets/full-screen.svg" alt="full-screen" />
                            </a>
                        </div>
                        <div class="l2">
                            <!-- pour renvoyer sur le post -->
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img class="oeil" src="<?php echo get_template_directory_uri() ?>/assets/oeil.svg" alt="Icône d'œil" />
                            </a>
                        </div>
                        <div class="l3">
                            <?php $categories = get_the_term_list(get_the_ID(), 'categorie'); ?>
                            <div class="text"><?php echo get_the_title(); ?></div>
                            <div class="text"><?php echo $categories; ?></div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        endwhile;
    endif;
    $output = ob_get_clean();
    echo $output;
    //pour terminer la fo ajax
    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');


// Bouton Toutes les photos
add_action('wp_ajax_mota_load_photos', 'mota_load_photos');
add_action('wp_ajax_nopriv_mota_load_photos', 'mota_load_photos');

function mota_load_photos()
{
    // Vérification de sécurité
    if (
        !isset($_REQUEST['nonce']) or
        !wp_verify_nonce($_REQUEST['nonce'], 'mota_load_photos')
    ) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // On vérifie que l'identifiant a bien été envoyé
    if (!isset($_POST['postid'])) {
        wp_send_json_error("L'identifiant du post est manquant.", 400);
    }

    // Récupération des données du formulaire
    $post_id = intval($_POST['postid']);

    // Vérifier que l'article est publié, et public
    if (get_post_status($post_id) !== 'publish') {
        wp_send_json_error("Vous n'avez pas accès aux photos de ce post.", 403);
    }

    function filter_photos_callback()
    {
        $categorie = $_POST['CATÉGORIE'];
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
        }
    }
}

function mota_assets()
{
    wp_enqueue_script(
        'mota',
        get_template_directory_uri() . '/js/scripts.js',
        ['jquery'],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'mota_assets');

/*Mettre sélecteurs en rouge
function my_theme_enqueue_styles() {
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

function my_theme_add_footer_scripts() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#select1, #select2').select2();
        });
    </script>
    <?php
}
add_action('wp_footer', 'my_theme_add_footer_scripts');*/

// Hook pour filtrer le tag du formulaire
add_filter('wpcf7_form_tag', function ($tag) {
    if ('ref-photo' === $tag['name']) {
        // Récupére la valeur du champ personnalisé ACF pour le post actuel
        $ref_photo_value = get_field('RÉFÉRENCE'); // nom du champ ACF
        // Vérifie si la valeur du champ personnalisé est récupérée et non vide
        if (!empty($ref_photo_value)) {
            // Définit cette valeur comme valeur par défaut du champ
            $tag['values'] = (array) $ref_photo_value;
        }
    }
    return $tag;
}, 10, 2);

//Miniature avec fleches
function my_enqueue_scripts() {
    wp_enqueue_script('my-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), null, true);

    wp_localize_script('my-custom-script', 'myScriptVars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_nonce')
    ));
}

add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

// Fonction pour traiter la requête AJAX de la miniature
function handle_adjacent_post() {
    check_ajax_referer('my_nonce', 'nonce');

    $direction = $_POST['direction'];
    $post_id = $_POST['id'];

    $in_same_term = false;
    $excluded_terms = '';
    $previous = $direction === 'prev';

    $adjacent_post = get_adjacent_post($in_same_term, $excluded_terms, $previous);

    if (!empty($adjacent_post)) {
        $thumbnail_url = get_the_post_thumbnail_url($adjacent_post->ID, 'thumbnail');
        wp_send_json_success($thumbnail_url);
    } else {
        wp_send_json_error('

Pas de miniature disponible');
}

wp_die(); // Cette fonction doit être appelée à la fin pour terminer correctement l'exécution du script dans une fonction AJAX

}

add_action('wp_ajax_handle_adjacent_post', 'handle_adjacent_post');
add_action('wp_ajax_nopriv_handle_adjacent_post', 'handle_adjacent_post');
