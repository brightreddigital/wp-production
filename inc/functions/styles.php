<?php

// Parse style variables

function generate_options_css() {
	$ss_dir = get_stylesheet_directory();
	ob_start(); // Capture all output into buffer
	require($ss_dir . '/inc/css/style-vars.php'); // Grab the custom styles file
	$css = ob_get_clean(); // Store output in a variable, then flush the buffer
	file_put_contents($ss_dir . '/inc/css/style-vars.css', $css, LOCK_EX); // Save it as a css file
}

add_action( 'acf/save_post', 'generate_options_css', 20 ); //Parse the output and write the CSS file on save

// Enqueue scripts and styles

function brightred_scripts() {
	
	wp_enqueue_style( 'style-variables', get_template_directory_uri() . '/inc/css/style-vars.css' );
	wp_enqueue_style( 'brightred-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'brightred-style', 'rtl', 'replace' );
	wp_enqueue_script( 'brightred-theme-style', get_template_directory_uri() . '/js/theme.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'brightred_scripts' );