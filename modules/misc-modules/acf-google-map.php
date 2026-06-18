<?php
/**
 * Plugin Name: Allow ACF Google Maps field
 * Description: ⚠️Notice: Alow the legacy Places API (Google Cloud > 'Websites' Project) to replace ACF Google Maps API scripts on the site. This may affect all Google Maps integrations on the site, so it should only be enabled if this is the only Google Maps integration present.
 * Version: 1.0.4
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
add_filter('acf/fields/google_map/api', 'fcd_sm_acf_google_map_api');

function fcd_sm_acf_google_map_api( $api ) {
	$api['key'] = acf_get_setting( 'google_api_key' );
	return $api;
}

// 3. Load the Google Maps API scripts for our ACF area / frontend.
function fcd_map_theme_add_scripts() {
	$api_key = acf_get_setting( 'google_api_key' );
	wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key, array(), '3', true );
	wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/library/js/google-maps.js', array('google-map', 'jquery'), '0.1', true );
}

add_action( 'wp_enqueue_scripts', 'fcd_map_theme_add_scripts' );