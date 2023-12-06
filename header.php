
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head()  // Code nécessaire dans le header au fonctionnement de wordpress ?>
</head>
<header>
  <div class="logo">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg" alt="Logo">
  </div>
  <nav>
    <?php wp_nav_menu( array('theme_location' => 'header', 'container_class' => 'menu-header') ); ?>
  </nav>
</header>
<section class="imageaccueil">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/nathalie-11.jpeg" alt="">
</section>




   
