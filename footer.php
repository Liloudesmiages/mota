<footer>
      <?php wp_nav_menu( array('theme_location' => 'footer', 
      'container_class' => 'menu-footer') ); ?>
      <?php  get_template_part('templates_part/contact');?>
      <footer class="site-footer">
    <nav class="footer-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'menu_class'     => 'footer-menu',
            'container'      => false // Pas de conteneur div ou ul supplémentaire autour du menu
        ));
        ?>
    </nav>
</footer>
<?php wp_footer(); ?>  <!--Code nécessaire dans le footer au fonctionnement de wordpress -->
</body>
</html>


