<?php
/*
Plugin Name: RSSJS
Plugin URI: http://wordpress.org/plugins/rssjs
Description: Create an RSSJS feed for WordPress
Version: 1.0
Author: WordPress.org
Author URI: http://wordpress.org
Text Domain: rssjs
License: GPLv2
License URI: http://www.opensource.org/licenses/GPL-2.0
*/

add_action( 'init', 'rssjs_add_feeds' );
function rssjs_add_feeds() {
	add_feed( 'rssjs', 'do_feed_rssjs' );
}

add_action( 'init', 'rssjs_add_callback_var' );
function rssjs_add_callback_var() {
	global $wp;
	$wp->add_query_var('callback');
}

function do_feed_rssjs( $for_comments ) {
	if ( $for_comments ) {
		load_template( plugin_dir_path(__FILE__) . 'feed-rssjs-comments.php' );
	} else {
		load_template( plugin_dir_path(__FILE__) . 'feed-rssjs.php' );
	}
}

add_filter( 'feed_content_type', 'rssjs_content_type', 10, 2 );
function rssjs_content_type( $content_type, $type ) {
	if ( $type == 'rssjs' )
		$content_type = 'application/json';

	return $content_type;
}
