<?php

/**
* Functions and definitions
* @link https://developer.wordpress.org/themes/basics/theme-functions/
* @package brightred
*/

if ( ! defined( '_S_VERSION' ) ) {
	// Release number
	define( '_S_VERSION', '0.0.1' );
}

// Load partials

$roots_includes = array(
	'/inc/functions/defaults.php',
	'/inc/functions/clean.php',
	'/inc/functions/theme-options.php',
	'/inc/functions/styles.php',
	'/inc/functions/shortcodes.php',
);

foreach($roots_includes as $file){
	
	if(!$filepath = locate_template($file)) {
		trigger_error("Error locating `$file` for inclusion!", E_USER_ERROR);
	}

require_once $filepath;
}

unset($file, $filepath);

function general_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'options-general.php' ) {
         echo '<div class="notice notice-warning is-dismissible">
             <p>This is an example of a notice that appears on the settings page.</p>
         </div>';
    }
}
add_action('admin_notices', 'general_admin_notice');





// function checkACFcookie() {

// // Cookiebar

	
// 	$srcOne = get_stylesheet_directory_uri() . "/inc/js/cookiebar/cookiebar-latest.min.js?theme=minimal?customize=1&always=1&hideDetailsBtn=1&showPolicyLink=1&privacyPage=%2Fprivacy-policy&refreshPage=1";
// 	$trackingACF = get_field('tracking_scripts', 'option');
// 	$thirdACF = get_field('third_party_scripts', 'option');
// 	$blockACF = get_field('blocking_mode', 'option');
// 	$srcBlock = "";
// 	$srcTracking = "";
// 	$srcThird = "";

// 	if ($blockACF) {
// 		$srcBlock = "&blocking=1";
	
// 		echo '<style>#cookie-bar { display: none !important; }</style>';

// 	}
	
// 	if ($trackingACF) {
// 		$srcTracking = "&tracking=1";
// 	}  

// 	if ($thirdACF) {
// 		$srcThird = "&thirdparty=1";
// 	}

// 	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieCustomized" && $_COOKIE['cookiebar-tracking'] == "true" ) {  
// 		echo $trackingACF;
// 	}

// 	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieCustomized" && $_COOKIE['cookiebar-third-party'] == "true" ) {  
// 		echo $thirdACF;
// 	}

// 	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieAllowed") { 
// 		echo $thirdACF;
// 		echo $trackingACF;
// 	}

// 	$srcFull = $srcOne . $srcBlock . $srcTracking . $srcThird ;


// 	echo '<script type="text/javascript" id="cookie-br" src="' . $srcFull . '"></script>';


// 	}

// 	add_action( 'acf/init', 'checkACFcookie' );