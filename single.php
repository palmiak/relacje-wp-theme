<?php
/*
Template Name: Publikacje Single
*/
$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

$context['other_posts'] = Timber::get_posts(
    array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => array( $context['post']->ID ),
    )
);

Timber::render( 'views/templates/single.twig', $context );
