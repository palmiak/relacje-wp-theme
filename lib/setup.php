<?php
/**
 * Sober Intervention - cleaning wp-admin
 * more info on https://github.com/soberwp/intervention
 */
use function Sober\Intervention\intervention;

if ( function_exists( 'Sober\Intervention\intervention' ) ) {
	intervention( 'add-acf-page', 'Opcje strony', array( 'administrator' ) );
	intervention( 'add-dashboard-redirect' );
	intervention( 'add-svg-support' );
}

function setup() {
	load_theme_textdomain( 'sasquatch', get_template_directory() . '/lang' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'search-form' ) );
	register_nav_menus(
		array(
			'header'   => 'Menu Header',
			'overlay'  => 'Menu Overlay',
			'footer'   => 'Footer',
		)
	);

	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'setup' );

/**
 * Theme assets
 */

function assets() {
	wp_enqueue_style( 'sasquatch/css', asset_path( 'css/app.css' ) );
	wp_enqueue_script( 'sasquatch/js', asset_path( 'js/app.js' ), array('jquery'), null, true );
	//wp_deregister_style( 'wp-block-library' );
	//wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'assets', 100 );


// ACF Sync Fields
add_filter( 'acf/settings/save_json', 'acf_json_save_point' );

function acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/acf-fields';

	// return
	return $path;
}

add_filter( 'acf/settings/load_json', 'acf_json_load_point' );

function acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );

	// append path
	$paths[] = get_stylesheet_directory() . '/acf-fields';

	// return
	return $paths;
}

function deregister_embed() {
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_embed' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function clean_header() {
	remove_action( 'wp_head', 'wp_print_scripts' );
	remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
	remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
}

add_action( 'wp_enqueue_scripts', 'clean_header' );

function defer_parsing_of_js( $url ) {
	if ( is_admin() && is_user_logged_in() ) {
		return $url; // don't break WP Admin
	}
	if ( false === strpos( $url, '.js' ) ) {
		return $url;
	}

	return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );

// Remove fields from Admin profile page
if ( ! function_exists( 'remove_personal_options' ) ) {
	function remove_personal_options( $subject ) {
		$subject = preg_replace('#<h2>'.__("Personal Options").'</h2>#s', '', $subject, 1); // Remove the "Personal Options" title
		$subject = preg_replace('#<tr class="user-comment-shortcuts-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Keyboard Shortcuts" field
		$subject = preg_replace('#<h2>'.__("Contact Info").'</h2>#s', '', $subject, 1); // Remove the "Contact Info" title
		$subject = preg_replace('#<tr class="user-url-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Website" field
		$subject = preg_replace('#<h2>'.__("About Yourself").'</h2>#s', '', $subject, 1); // Remove the "About Yourself" title
		$subject = preg_replace('#<tr class="user-profile-picture(.*?)</tr>#s', '', $subject, 1); // Remove the "Profile Picture" field
		return $subject;
	}

	function profile_subject_start() {
		ob_start( 'remove_personal_options' );
	}

	function profile_subject_end() {
		ob_end_flush();
	}
}

add_action( 'admin_head', 'profile_subject_start' );
add_action( 'admin_footer', 'profile_subject_end' );

function modify_user_contact_methods( $user_contact ){
	$user_contact = []; 
	
	return $user_contact;
}

add_filter('user_contactmethods', 'modify_user_contact_methods');