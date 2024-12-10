<?php
/**
 * Gutenberg related functions
 *
 * @package theme
 */

/**
 * ACF Blocks editor style
 *
 * @return void
 */
function acf_block_editor_style() {
	wp_enqueue_style(
		'url_css',
		get_template_directory_uri() . '/dist/css/editor.css',
		array(),
		'1'
	);

	wp_enqueue_script(
		'url_js',
		get_template_directory_uri() . '/dist/js/editor.js',
		array(),
		'1',
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'acf_block_editor_style' );

//add_filter( 'allowed_block_types_all', 'allowed_block_types', 25, 2 );
 
function allowed_block_types( $allowed_blocks, $editor_context ) {
 
	return array(
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/pullquote',
		'core/more',
		'core/shortcode',
		'core/embed',
	);
}