<?php
/**
 * Plugin Name: ACF Google Maps
 * Description: Enables the ACF Google Map integration using a pre-configured API key.
 * Version: 1.0.0
 * Text Domain: fcd-acf-map
 * Author: FCD
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Display a prominent warning in the settings panel when active
add_action( 'admin_init', 'fcd_sm_acf_map_register_warning' );

function fcd_sm_acf_map_register_warning() {
	add_settings_field(
		'fcd_sm_acf_map_warning',
		'API Key Status',
		'fcd_sm_acf_map_warning_callback',
		'custom-settings-misc', // The page slug of the Misc tab
		'sm_misc_main_section'  // The section inside the Misc tab
	);
}

function fcd_sm_acf_map_warning_callback() {
	?>
	<div style="border-left: 4px solid #dba617; padding-left: 12px; margin-top: 5px;">
		<p class="description" style="color: #8a6d3b; font-weight: 500; margin: 0;">
			⚠️ <strong>Notice:</strong> This is for the legacy Places API (not v2) and uses the 'Websites' Google Cloud project with a restricted API key (requires domain to be added to the API key's restrictions).
		</p>
		<p class="description" style="margin-top: 4px;">
			<em>Key: <code>AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94</code></em>
		</p>
	</div>
	<?php
}

// 2. Register the Google Maps API Key with ACF (Modern Method)
add_action( 'acf/init', 'fcd_sm_acf_google_map_init' );

function fcd_sm_acf_google_map_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94' );
}

// 3. Filter the Map API array (Fallback for older ACF implementations)
add_filter( 'acf/fields/google_map/api', 'fcd_sm_acf_google_map_api' );

function fcd_sm_acf_google_map_api( $api ) {
	$api['key'] = 'AIzaSyAciNTajbu3KyLuQQ_ea7uohU3OR_4Sy94';
	return $api;
}