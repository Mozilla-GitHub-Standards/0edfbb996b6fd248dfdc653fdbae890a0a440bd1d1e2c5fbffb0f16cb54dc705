<?php

/**
 * Firefox product class.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Product_Firefox extends Mozlv_Product_Class {

	protected $json_URL = 'https://www.mozilla.org/includes/product-details/json/firefox_versions.json';
	protected $channel_to_JSON_index = array (
										'release' => 'LATEST_FIREFOX_VERSION',
										'beta' => 'LATEST_FIREFOX_RELEASED_DEVEL_VERSION',
										'aurora' => 'FIREFOX_AURORA',
										'esr' => 'FIREFOX_ESR',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://download.mozilla.org/?product=firefox-%1$s&os=%3$s&lang=%2$s';
	protected $langpack_URL = 'http://download.cdn.mozilla.net/pub/mozilla.org/firefox/releases/%1$s/win32/xpi/%2$s.xpi';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/firefox/%1$s/releasenotes/';
	protected $requirements_URL = 'https://www.mozilla.org/%2$s/firefox/%1$s/system-requirements/';

}