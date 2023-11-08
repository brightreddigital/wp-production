<?php

// Disable emojis

function disable_emojis() {
	
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );	
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Remove Gutenberg Block Library CSS from loading on the frontend

function remove_wp_block_library_css(){

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );

} 

add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

// Disable WooCommerce bloat

add_filter( 'woocommerce_admin_disabled', '__return_true' );
add_filter( 'jetpack_just_in_time_msgs', '__return_false', 20 );
add_filter( 'jetpack_show_promotions', '__return_false', 20 );
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false', 999 );
add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );
add_filter( 'woocommerce_marketing_menu_items', '__return_empty_array' );
add_filter( 'woocommerce_background_image_regeneration', '__return_false' );
add_filter( 'wp_lazy_loading_enabled', '__return_false' );
add_filter( 'woocommerce_menu_order_count', 'false' );
add_filter( 'woocommerce_enable_nocache_headers', '__return_false' );
add_filter( 'woocommerce_include_processing_order_count_in_menu', '__return_false' );
add_action( 'admin_menu', function() { remove_menu_page( 'skyverge' ); }, 99 );
add_action( 'admin_enqueue_scripts', function() { wp_dequeue_style( 'sv-wordpress-plugin-admin-menus' ); }, 20 );
add_action( 'wp_dashboard_setup', function () { remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal'); }, 40);
add_action( 'admin_menu', function () { remove_submenu_page( 'woocommerce', 'wc-addons'); }, 999 );

add_filter( 'woocommerce_admin_features', function ( $features ) {

	$marketing = array_search('marketing', $features);
	unset( $features[$marketing] );
	return $features;

} );

// Disable Google Fonts in Elementor

add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

