<?php

/* Supported products */
define('FIREFOX', 'firefox');
define('THUNDERBIRD', 'thunderbird');
define('SEAMONKEY', 'seamonkey');

switch(filter_input(INPUT_GET, 'product')) {
	case FIREFOX:
		$json = file_get_contents('https://www.mozilla.org/includes/product-details/json/firefox_versions.json');
		$release = 'LATEST_FIREFOX_VERSION';
		break;
	case THUNDERBIRD:
		$json = file_get_contents('https://www.mozilla.org/includes/product-details/json/thunderbird_versions.json');
		$release = 'LATEST_THUNDERBIRD_VERSION';
		break;
	case SEAMONKEY:
		$json = file_get_contents('http://www.seamonkey-project.org/seamonkey_versions.json');
		$release = 'LATEST_SEAMONKEY_VERSION';
		break;
	default:
		http_response_code(403);
		die('No supported product specified.');
}

/* Supported channels */
define('RELEASE', 'release');

switch(filter_input(INPUT_GET, 'channel')) {
	case RELEASE:
		$channel = $release;
		break;
	default:
		http_response_code(403);
		die('No supported channel specified.');
}

/* Output */
echo json_decode($json, true)[$channel];

?>
