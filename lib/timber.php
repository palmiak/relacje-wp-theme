<?php
/**
 * Conditional tags for Timber
 */
function add_to_context( $data ) {
	$data['is_home']          = is_home();
	$data['is_front_page']    = is_front_page();
	$data['is_single']        = is_single();
	$data['is_page']          = is_page();
	$data['is_page_template'] = is_page_template();
	$data['is_category']      = is_category();
	$data['is_tag']           = is_tag();
	$data['is_tax']           = is_tax();
	$data['is_author']        = is_author();
	$data['is_date']          = is_date();
	$data['is_year']          = is_year();
	$data['is_month']         = is_month();
	$data['is_day']           = is_day();
	$data['is_archive']       = is_archive();
	$data['is_404']           = is_404();
	$data['is_paged']         = is_paged();
	$data['is_singular']      = is_singular();
	$data['is_main_query']    = is_main_query();

	$data['options'] = get_fields( 'options' );

	$data['menu']['header_left']   = new Timber\Menu( 'header-lewo' );
	$data['menu']['header_right']   = new Timber\Menu( 'header-prawo' );
	$data['menu']['footer']   = new Timber\Menu( 'footer' );
	$data['menu']['header_desktop']   = new Timber\Menu( 'menu-desktop' );

	$data['browser'] = $_SERVER['HTTP_USER_AGENT'];
	$data['get_data'] = $_GET;

	if (function_exists('yoast_breadcrumb')) {
		$data['breadcrumbs'] = yoast_breadcrumb('<nav id="breadcrumb">','</nav>', false );
	}
	
	return $data;
}
add_filter( 'timber_context', 'add_to_context' );

/**
 * Config vars
 */
function add_to_config( $data ) {
	/**
	 * Example
	 * $data['config']['name'] = 'value'l
	 */
	return $data;
}

add_filter( 'timber_context', 'add_to_config' );

if ( class_exists( 'Timber' ) ) {
	add_filter(
		'timber/twig/environment/options',
		function( $options ) {
			$options['cache'] = true;
			return $options;
		}
	);
}

function asset_path( $filename ) {

	$dir = '/dist/';
	$dist_path = get_template_directory_uri() . $dir;
	$directory = dirname($filename) . '/';
	$file = basename($filename);

	return $dist_path . $directory . $file;
}

