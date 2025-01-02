<?php
/*
Template Name: Publikacje
*/

$context = Timber::get_context();
if ( is_front_page() ) {
    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 

    $context['posts'] = new Timber\PostQuery(
        array(
            'posts_per_page' => 18,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged,
        )
    );

    if ( count( $context['posts'] ) == 0 ) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        Timber::render( 'views/templates/404.twig', $context );
        return;
    }
} else {
    $context['posts'] = new Timber\PostQuery();
}

if ( is_front_page() && $paged == 1 ) {
    Timber::render( 'views/templates/archive.twig', $context );
} else {
    Timber::render( 'views/templates/archive-others.twig', $context );

}
