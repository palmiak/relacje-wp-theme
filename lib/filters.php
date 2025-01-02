<?php
add_filter( 'timber/twig', 'add_to_twig' );

function add_to_twig( $twig ) {
	$twig->addFilter( new Timber\Twig_Filter( 'leading_zero', 'leading_zero' ) );
	$twig->addFilter( new Timber\Twig_Filter( 'fb_share', 'fb_share' ) );
	$twig->addFilter( new Timber\Twig_Filter( 'x_share', 'x_share' ) );
	$twig->addFilter( new Timber\Twig_Filter( 'li_share', 'li_share' ) );

	return $twig;
}

function leading_zero( $number ) {
    if ($number < 10) {
		$number = '0' . $number;
	} 
	return $number;
}

function fb_share( $url ) {
	$url = urlencode( $url );
	return 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
}

function x_share( $url ) {
	$url = urlencode( $url );
	return 'https://x.com/intent/tweet?url=' . $url;
}

function li_share( $url ) {
	$url = urlencode( $url );
	return 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url;
}

// Display the links to the general feeds: Post and Comment Feed.
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
