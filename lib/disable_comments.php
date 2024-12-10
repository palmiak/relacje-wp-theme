<?php
namespace DisableComments;

// Removes from sidebar
function remove_sidebar_link()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', __NAMESPACE__ . '\remove_sidebar_link', 9999);

// Removes from admin bar
function remove_admin_bar_link($wp_admin_bar)
{
	remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
}
add_action('admin_init', __NAMESPACE__ . '\remove_admin_bar_link', 9999);

// Removes from settings
function remove_discussion_settings()
{
	remove_submenu_page('options-general.php', 'options-discussion.php');
}
add_action('admin_menu', __NAMESPACE__ . '\remove_discussion_settings', 9999);

// Removes dashboard box
function remove_dashboard_entry()
{
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', __NAMESPACE__ . '\remove_dashboard_entry');

// Remove from widgets list
function remove_widget()
{
	unregister_widget('WP_Widget_Recent_Comments');
	add_filter('show_recent_comments_widget_style', '__return_false');
}
add_action('widgets_init', __NAMESPACE__ . '\remove_widget');

// Remove from editor blocks
function remove_editor_block()
{
	unregister_block_type('core/latest-comments');
}
add_action('init', __NAMESPACE__ . '\remove_editor_block');

// Remove pingbacks from headers
function remove_pingback_http_header($headers)
{
	unset($headers['X-Pingback']);
	return $headers;
}
add_action('wp_headers', __NAMESPACE__ . '\remove_pingback_http_header');

// Remove comment RSS feeds from <head>
function remove_comment_rss()
{
	add_filter('feed_links_show_comments_feed', '__return_false');
}
add_action('init', __NAMESPACE__ . '\remove_comment_rss', 100);

// Remove support from post types
function remove_comment_support()
{
	$args = [
		'public' => true,
		'_builtin' => true,
	];

	$output = 'names'; // 'names' or 'objects' (default: 'names')
	$operator = 'and'; // 'and' or 'or' (default: 'and')

	$post_types = get_post_types($args, $output, $operator);

	foreach ($post_types as $post_type) {
		remove_post_type_support($post_type, 'comments');
		remove_post_type_support($post_type, 'trackbacks');
	}
}
add_action('init', __NAMESPACE__ . '\remove_comment_support', 100);

// Removes REST API endpoints
function disable_rest_api_comments($prepared_comment, $request)
{
	return;
}
function disable_rest_api_comment_endpoint($endpoints)
{
	unset($endpoints['comments']);
	return $endpoints;
}
add_filter('rest_pre_insert_comment', __NAMESPACE__ . '\disable_rest_api_comments');
add_filter('rest_endpoints', __NAMESPACE__ . '\disable_rest_api_comment_endpoint');

// Remove xmlrpc comments
function disable_xmlrpc_comments($methods)
{
	unset($methods['wp.newComment']);
	return $methods;
}
add_filter('xmlrpc_methods', __NAMESPACE__ . 'disable_xmlrc_comments');