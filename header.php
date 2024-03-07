<?php
/**
 * @package brightred
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();

	// Cookiebar

	$srcOne = "/wp-content/themes/wp_development/inc/js/cookiebar/cookiebar-latest.min.js?theme=minimal?customize=1&always=1&hideDetailsBtn=1&showPolicyLink=1&privacyPage=%2Fprivacy-policy&refreshPage=1";
	$trackingACF = get_field('tracking_scripts', 'option');
	$thirdACF = get_field('third_party_scripts', 'option');
	$blockACF = get_field('blocking_mode', 'option');
	$srcBlock = "";
	$srcTracking = "";
	$srcThird = "";

	if ($blockACF) {
		$srcBlock = "&blocking=1"; ?>
	
		<style>#cookie-bar { display: none !important; }</style>

	<?php }
	
	if ($trackingACF) {
		$srcTracking = "&tracking=1";
	}  

	if ($thirdACF) {
		$srcThird = "&thirdparty=1";
	}

	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieCustomized" && $_COOKIE['cookiebar-tracking'] == "true" ) {  
		echo $trackingACF;
	}

	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieCustomized" && $_COOKIE['cookiebar-third-party'] == "true" ) {  
		echo $thirdACF;
	}

	if (isset($_COOKIE['cookiebar']) && $_COOKIE['cookiebar'] == "CookieAllowed") { 
		echo $thirdACF;
		echo $trackingACF;
	}

	$srcFull = $srcOne . $srcBlock . $srcTracking . $srcThird ;

	?>

	<script type="text/javascript" src="<?php echo $srcFull ?>"></script>

	<a href="#" onclick="document.cookie='cookiebar=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/'; setupCookieBar(); return false;">Manage Cookies</a>

</head>

<body <?php body_class(); ?>>
	
<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'brightred' ); ?></a>


