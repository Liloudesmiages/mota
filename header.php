<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); // Code nécessaire dans le header au fonctionnement de WordPress 
    ?>
</head>
<!--  pratique standard pour les thèmes WordPress, permet d'ajouter des classes spécifiques à la page -->

<body <?php body_class(); ?>>

    <header id="masthead" class="site-header">
        <nav id="site-navigation" class="main-navigation">
            <div class="logo">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'primary-menu',
                'container'      => 'div',
            ));
            ?>

            <!-- Menu hamburger -->
              <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div id="menu-content" class="menu-content">
                <div class="menu-liens">
                    <?php
                     wp_nav_menu(array(
                        'theme_location' => 'menu-principal',
                        'menu_id'        => 'primary-menu2',
                        'container'      => 'div',
                        'container_class' => 'pm2',
                    ));
                    ?>
                </div>
        </div>
        </nav>
    </header>
    