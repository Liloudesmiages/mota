<?php get_header(); // include 'header.php'; ?>
<body>
    test
<h2><?php the_title(); ?></h2>
<div><?php the_content(); ?></div>
<div><?php the_field('RÉFÉRENCE'); ?></div>
<div><?php the_field('FORMAT'); ?></div>
<div><?php the_field('ANNÉE'); ?></div>
<img class="event" src="<?php echo get_the_post_thumbnail_url(); ?>"/>
</body>
<?php get_footer(); // include 'footer.php'; ?>
