<?php

/*
--------- 
Register the required plugins 
----------
*/

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_required_plugins' );

function register_required_plugins() {

	$plugins = array(

		// Plugins from external sources
		array(
			'name'         => 'Elementor Pro', 
			'slug'         => 'elementor-pro',
			'required'     => true,
			'external_url' => 'https://my.elementor.com/subscriptions/',
		),

		array(
			'name'         => 'Advanced Custom Fields PRO',
			'slug'         => 'advanced-custom-fields-pro',
			'required'     => true,
			'external_url' => 'https://www.advancedcustomfields.com/my-account/',
		),

		// Plugins from the WordPress Plugin Repository

		array(
			'name'      => 'Classic Editor',
			'slug'      => 'classic-editor',
			'required'  => true,
		),

		array(
			'name'      => 'WP Pusher',
			'slug'      => 'wppusher',
			'required'  => true,
		),

		array(
			'name'      => 'Redirection',
			'slug'      => 'redirection',
			'required'  => true,
		),

		array(
			'name'      => 'Duplicate Page',
			'slug'      => 'duplicate-page',
			'required'  => true,
		),

		array(
			'name'      => 'LiteSpeed Cache',
			'slug'      => 'litespeed-cache',
			'required'  => true,
		),

	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'install-plugins',       // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}