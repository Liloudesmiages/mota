<footer>
    <footer class="site-footer">
        <!-- Menu de navigation du pied de page -->
        <nav class="footer-navigation">
            <?php
            // Affichage du menu de pied de page
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class'     => 'footer-menu', // Classe CSS pour le style du menu
                'container'      => false // Pas de conteneur div ou ul supplémentaire autour du menu
            ));
            ?>
        </nav>

        <!-- formulaire contact voir single-page-->
        <?php get_template_part('templates_part/contact'); ?>
    </footer>
    <?php wp_footer(); ?> <!--Code nécessaire dans le footer au fonctionnement de wordpress -->
    </body>

    </html>