<?php
add_filter( 'timber/twig', 'add_to_twig' );

function add_to_twig( $twig ) {
	return $twig;
}

// Display the links to the general feeds: Post and Comment Feed.
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
