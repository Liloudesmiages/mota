<?php
/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mota
 */

get_header();

/* Start the Loop */
while (have_posts()) :
    the_post();

    // Include the content template
    get_template_part('template-parts/content/content-single');

    // If comments are open or there is at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

    // Previous/next post navigation
    $next_label = esc_html__('Next post', 'monthemepersonnalise');
    $prev_label = esc_html__('Previous post', 'monthemepersonnalise');
    
    the_post_navigation(
        array(
            'next_text' => '<p class="meta-nav">' . $next_label . '</p><p class="post-title">%title</p>',
            'prev_text' => '<p class="meta-nav">' . $prev_label . '</p><p class="post-title">%title</p>',
        )
    );
endwhile; // End of the loop.

get_footer();
