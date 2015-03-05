<?php

/*** Definitions ***/

/* Supported products */
define('INPUT_PRODUCT', 'product'); //INPUT_PRODUCT=FIREFOX
	define('FIREFOX', 'firefox');
	define('MOBILE', 'mobile');
	define('THUNDERBIRD', 'thunderbird');
	define('SEAMONKEY', 'seamonkey');
define('INPUT_CHANNEL', 'channel'); //INPUT_CHANNEL=RELEASE
	define('RELEASE', 'release');
define('JSON_DIR_URL', 'json_dir_url');
define('JSON_FILENAME', 'json_filename');
$products = array( //will be replaced by objects
	FIREFOX => array(
		RELEASE => 'LATEST_FIREFOX_VERSION',
		JSON_DIR_URL => 'https://www.mozilla.org/includes/product-details/json/',
		JSON_FILENAME => 'firefox_versions.json'
	),
	MOBILE => array(
		RELEASE => 'version',
		JSON_DIR_URL => 'https://www.mozilla.org/includes/product-details/json/',
		JSON_FILENAME => 'mobile_details.json'
	),
	THUNDERBIRD => array(
		RELEASE => 'LATEST_THUNDERBIRD_VERSION',
		JSON_DIR_URL => 'https://www.mozilla.org/includes/product-details/json/',
		JSON_FILENAME => 'thunderbird_versions.json'
	),
	SEAMONKEY => array(
		RELEASE => 'LATEST_SEAMONKEY_VERSION',
		JSON_DIR_URL => 'http://www.seamonkey-project.org/',
		JSON_FILENAME => 'seamonkey_versions.json'
	)
);

/* Cache settings */
define('CACHE_DIR', './cache/');
define('CACHE_EXPIRE', 60*60);

/*** START SCRIPT EXECUTION ***/

/* Check the product is supported */
$product = filter_input(INPUT_GET, INPUT_PRODUCT);
if(!isset($products[$product])) {
	http_response_code(403);
	die('No supported product specified.');
}

/* Check the channel is supported */
$channel = filter_input(INPUT_GET, INPUT_CHANNEL);
if(!isset($products[$product][$channel])) {
	http_response_code(403);
	die('No supported channel for "'.$product.'" specified.');
}

/* Use the cache */
$file_in_cache = CACHE_DIR.$products[$product][JSON_FILENAME];
if(is_file($file_in_cache) && time()-filemtime($file_in_cache)<CACHE_EXPIRE) {
	$json = file_get_contents($file_in_cache);
} else {
	$json = file_get_contents($products[$product][JSON_DIR_URL].$products[$product][JSON_FILENAME]);
	if(!in_array('HTTP/1.1 200 OK', $http_response_header)) { //check the file format (e.g. if it's parsable or includes desired channel)
		if(is_file($file_in_cache)) {
			$json = file_get_contents($file_in_cache);
		} else {
			http_response_code(503);
			die('Cannot load data.');
		}
	} else {
		file_put_contents($file_in_cache, $json);
	}
}

/* Output */
echo json_decode($json, true)[$products[$product][$channel]];

?>
