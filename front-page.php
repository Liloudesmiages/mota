<?php get_header(); ?>

<body>
    <main id="primary" class="site-main">
        <div class="hero">
            <?php
            $args = array('post_type' => 'photo', 'posts_per_page' => 1, 'orderby' => 'rand');
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                the_post_thumbnail();
            endwhile;
            wp_reset_postdata(); ?>
            <h1><img class="title" src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/title.png'; ?>" alt="photographe event"></h1> --> -->
        </div>
        <div class="catalogue">
            <div class="selection"></div>
        <div id="photos-catalogues">
        <!-- Afficher photos fichier functions-->
        </div>
        </div>
        <button id="charger-plus">Charger plus</button>
    </main>
</body>
<?php get_footer(); ?>