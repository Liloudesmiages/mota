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
            <h1><img class="title" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/title.png" alt="photographe event"></h1>
        </div>
        <div class="catalogue">
            <form action="#" method="GET">
                <div class="selection">
                    <div class="filtres1">
                        <select name="categorie" id="select1">
                            <option value="">CATÉGORIE</option>
                            <?php
                            $category = get_terms(
                                'categorie',
                                array(
                                    'hide_empty' => false,
                                )
                            );
                            foreach ($category as $cat) { ?>
                                <option value="<?php echo $cat->slug; ?>" <?php echo ($categ == $cat->slug) ? "selected" : "" ?>><?php echo $cat->name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select name="format" id="select2">
                            <option value="">FORMAT</option>
                            <?php
                            $category = get_terms(
                                'format',
                                array(
                                    'hide_empty' => false,
                                )
                            );
                            foreach ($category as $cat) { ?>
                                <option value="<?php echo $cat->slug; ?>" <?php echo ($format == $cat->slug) ? "selected" : "" ?>><?php echo $cat->name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="filtres2">
                        <select name="tri" id="select3">
                            <option value="">TRIER PAR</option>
                            <option value="DESC" <?php echo ($tri == "DESC") ? "selected" : "" ?>>PAR ORDRE DECROISSANT</option>
                            <option value="ASC" <?php echo ($tri == "ASC") ? "selected" : "" ?>>PAR ORDRE CROISSANT</option>
                        </select>
                    </div>
                </div>
            </form>

            <div id="photos-catalogues">
            </div>
        </div>
        <button id="charger-plus">Charger plus</button>
    </main>
</body>

<script>
    var ajax_object = {
        'ajax_url': '<?php echo admin_url('admin-ajax.php'); ?>',
        'ajax_nonce': '<?php echo wp_create_nonce('filter_photos_nonce'); ?>'
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<?php get_footer(); ?>