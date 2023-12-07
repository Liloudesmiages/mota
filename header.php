<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); // Code nécessaire dans le header au fonctionnement de WordPress ?>
</head>
<!--  pratique standard pour les thèmes WordPress, permet d'ajouter des classes spécifiques à la page -->
<body <?php body_class(); ?>>

<header id="masthead" class="site-header">
    <div class="logo">
        <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php endif; ?>
    </div>

    <nav class="main-navigation">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-principal', 
                'menu_id'        => 'primary-menu',
                'container'      => 'div', 
                'container_class'=> 'menu-{menu slug}-container',
                'menu_class'     => 'menu', 
                ) );
                ?>
            </nav>
        </header> 






   
