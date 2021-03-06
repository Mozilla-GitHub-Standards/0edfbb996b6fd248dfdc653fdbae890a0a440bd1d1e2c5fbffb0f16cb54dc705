<?php

/**
 * Firefox product class.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Product_Firefox extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/firefox_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'LATEST_FIREFOX_VERSION',
										'beta' => 'LATEST_FIREFOX_RELEASED_DEVEL_VERSION',
										'aurora' => 'FIREFOX_DEVEDITION',
										'devedition' => 'FIREFOX_DEVEDITION',
										'nightly' => 'FIREFOX_NIGHTLY',
										'esr' => 'FIREFOX_ESR',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://download.mozilla.org/?product=firefox-%1$s-ssl&os=%3$s&lang=%2$s';
	protected $langpack_URL = 'https://ftp.mozilla.org/pub/mozilla.org/firefox/releases/%1$s/win32/xpi/%2$s.xpi';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/firefox/%1$s/releasenotes/';
	protected $requirements_URL = 'https://www.mozilla.org/%2$s/firefox/%1$s/system-requirements/';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			if ( $channel == 'aurora' || $channel == 'devedition' ) {
				return parent::get_latest_url( 'https://download.mozilla.org/?product=firefox-devedition-latest-ssl&os=%3$s&lang=%2$s', $channel, $platform );
			} else if ( $channel == 'nightly' ) {
				return parent::get_latest_url( 'https://download.mozilla.org/?product=firefox-nightly-latest-l10n-ssl&os=%3$s&lang=%2$s', $channel, $platform );
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
