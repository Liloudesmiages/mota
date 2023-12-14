<?php get_header(); // include 'header.php'; ?>
<body>
<main id="primary" class="site-main">
<div id="hero" class="hero">
        <h1><img class="title" src="<?php echo get_stylesheet_directory_uri(); ?>'/assets/title.png'; ?>" alt="photographe event"></h1>
</div>
<h2><?php the_title()?></h2>
<div><?php the_content()?></div>
    </main>
</body>
<?php get_footer(); // include 'footer.php'; ?>
