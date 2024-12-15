<?php
/*
Template Name: Publikacje Single
*/
$context = Timber::get_context();
$context['post'] = Timber::get_posts()[0];

Timber::render( 'views/templates/tpl-publikacje-single.twig', $context );
