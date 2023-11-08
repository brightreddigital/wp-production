<?php

// Theme defaults and supports

function brightred_setup() {
	
	// Translation
	load_theme_textdomain( 'brightred', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Post Thumbnails on posts and pages		
	add_theme_support( 'post-thumbnails' );

	// Uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu' => esc_html__( 'Primary', 'brightred' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'brightred_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.

	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom logo

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}

add_action( 'after_setup_theme', 'brightred_setup' );

// Add mimes support 

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['ico'] = 'image/x-icon';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Add Woocommerce support 

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}