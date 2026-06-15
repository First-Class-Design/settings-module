<?php
/**
 * Plugin Name: Allow ACF Google Maps field
 * Description: ⚠️Notice: Alow the legacy Places API (Google Cloud > 'Websites' Project) to replace ALL Google Maps API scripts on the site, so it should only be enabled if this is the only Maps integration present.
 * Version: 1.0.2
 * Text Domain: fcd-acf-map
 * Author: FCD
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Register the Google Maps API Key with ACF (Modern Method)
add_action( 'acf/init', 'fcd_sm_acf_google_map_init' );

function fcd_sm_acf_google_map_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94' );
}

// 2. Filter the Map API array (Fallback for older ACF implementations)
add_filter( 'acf/fields/google_map/api', 'fcd_sm_acf_google_map_api' );

function fcd_sm_acf_google_map_api( $api ) {
	$api['key'] = 'AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94';
	return $api;
}

// 3. Force all Google Maps scripts to use our approved API key
add_filter( 'script_loader_src', 'fcd_sm_force_google_maps_api_key', 99, 2 );

function fcd_sm_force_google_maps_api_key( $src, $handle ) {
	// Check if the script URL belongs to the Google Maps API
	if ( strpos( $src, 'maps.googleapis.com/maps/api/js' ) !== false ) {
		
		$url_parts = parse_url( $src );
		$query_params = array();

		// Extract existing query parameters if they exist (like libraries=places)
		if ( isset( $url_parts['query'] ) ) {
			parse_str( $url_parts['query'], $query_params );
		}

		// Force our approved key into the array, regardless of whether a key previously existed
		$query_params['key'] = 'AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94';

		// Rebuild the URL string
		$new_query = http_build_query( $query_params );
		$src = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'] . '?' . $new_query;
	}
	
	return $src;
}