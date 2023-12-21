<?php get_header(); 
?>

<body>
    <div class="marge"></div>
    <section id="fiche">
        <div class="fiche1">
            <div class="infos">
                <h2><?php the_title(); ?></h2>
                <div><?php the_content(); ?></div>
                <div class="custom-taxonomy">RÉFÉRENCE : <?php the_field('RÉFÉRENCE'); ?></div>
                <!-- Récupérer et afficher les termes de la taxonomie 'categorie' -->
                <?php
                $categories = get_the_term_list(get_the_ID(), 'categorie');
                echo '<div class="custom-taxonomy">CATÉGORIE : ' . $categories . '</div>';
                ?>
                <!-- Récupérer et afficher les termes de la taxonomie 'format' -->
                <?php
                $formats = get_the_term_list(get_the_ID(), 'format');
                echo '<div class="format">FORMAT : ' . $formats . '</div>';
                ?>
                <div class="type">TYPE : <?php the_field('typephoto'); ?></div>
                <div class="annee">ANNÉE : <?php the_field('ANNÉE'); ?></div>
            </div>
            <div class="photo">
                <img class="event" src="<?php echo get_the_post_thumbnail_url(); ?>" />
            </div>
        </div>
        <div class="fiche2">
            <div class="formulaire">
                <h3>Cette photo vous interesse?</h3>
                <!-- formulaire contact -->
                <button id="myBtn">Contact</button>
            </div>
            <div class="photos">
                <h3>VOUS AIMEREZ AUSSI</h3>
                <?php
    // Obtenir l'ID de l'image à la une pour l'exclure
    $exclude_ids = get_the_ID();
    $my_query = new WP_Query( array( 'post_type' => 'photo', 'post__not_in' => array($exclude_ids), 'posts_per_page' => 2 ) );
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : 
        $my_query->the_post(); 
        if ( get_field('photo1') ) : ?>
            <img class="photo1" src="<?php the_field('photo1'); ?>" />     
        <?php endif; endwhile; 
    wp_reset_postdata();
    ?>
            </div>
        </div>
    </section>
</body>
<?php get_footer(); 
?>