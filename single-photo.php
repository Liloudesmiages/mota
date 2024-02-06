<?php

/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mota
 */
get_header();
?>

<body class="single">
    <section id="fiche">
        <div class="fiche1">
            <div class="infos">
                <div class="container-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div><?php the_content(); ?></div>
                <div class="reference">RÉFÉRENCE : <?php the_field('RÉFÉRENCE'); ?></div>
                <!-- Récupérer et afficher les termes de la taxonomie 'categorie' -->
                <?php
                $categories = get_the_term_list(get_the_ID(), 'categorie');
                echo '<div id="categorie">CATÉGORIE : ' . $categories . '</div>';
                ?>
                <!-- Récupérer et afficher les termes de la taxonomie 'format' -->
                <?php
                $formats = get_the_term_list(get_the_ID(), 'format');
                echo '<div id="format">FORMAT : ' . $formats . '</div>';
                ?>
                <div class="type">TYPE : <?php the_field('typephoto'); ?></div>
                <div class="annee">ANNÉE : <?php the_field('ANNÉE'); ?></div>
            </div>
            <div class="photo">
                <img class="event" src="<?php echo get_the_post_thumbnail_url(); ?>" />
            </div>
        </div>
        <div class="bloc-central">
            <div class="formulaire">
                <p>Cette photo vous intéresse?</p>
                <!-- formulaire contact -->
                <button id="myBtn">Contact</button>
            </div>
            <?php

            $prev_post = get_adjacent_post(false, '', false);
            $next_post = get_adjacent_post(false, '', false);

            $prev_post_thumbnail = '';
            $next_post_thumbnail = '';
            if ($prev_post) {
                $prev_post_thumbnail = get_the_post_thumbnail_url($prev_post->ID, 'thumbnail');
            }

            if ($next_post) {
                $next_post_thumbnail = get_the_post_thumbnail_url($next_post->ID, 'thumbnail');
            }
            ?>

            <div class="miniature">
                    <div id="conteneur-miniature">
                        <img class="previmg" src="<?php echo esc_url($prev_post_thumbnail); ?>" alt="">
                        <img class="nextimg" src="<?php echo esc_url($next_post_thumbnail); ?>" alt="">
                    </div>
                    <div class="flèches">
                        <div id="fleche-precedente" class="fleche-navigation"><?php previous_post_link('%link', '&#x2190;'); ?></div>
                        <div id="fleche-suivante" class="fleche-navigation"><?php next_post_link('%link', '&#x2192;'); ?></div>
                    </div>
                </div>


            </div>
        </div>
        </div>

        </div>
        </div>
        <div class="fiche2">
            <div id="photos">
                <h3>VOUS AIMEREZ AUSSI</h3>
                <div class="photoslist">
                    <?php
                    // Obtenir l'ID de l'image à la une pour l'exclure
                    $exclude_ids = get_the_ID();
                    $my_query = new WP_Query(array('post_type' => 'photo', 'post__not_in' => array($exclude_ids), 'posts_per_page' => 2));
                    if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                            $my_query->the_post(); ?>
                            <div class="photobook">
                                <img class="event" src="<?php echo get_the_post_thumbnail_url(); ?>" />
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <button class="toutes-les-photos"><a href="mota.html#select1">Toutes les photos</a>
        </button>

    </section>
</body>
<?php get_footer(); ?>