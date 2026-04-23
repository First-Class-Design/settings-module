<?php
/**
 * Plugin Name: Basic Google Analytics
 * Description: A very basic addition designed for simple integration of GA4 without the need to embed directly in the theme.
 * Version: 1.0.0
 * Text Domain: fcd-ga
 * Author: FCD
 **/

// 1. Register the Settings Field (Only runs when this micro-module is enabled)
add_action( 'admin_init', 'fcd_sm_ga_register_settings' );

function fcd_sm_ga_register_settings() {
	// Register the option to store the ID
	register_setting( 'sm_misc_settings_group', 'fcd_sm_ga_measurement_id', 'sanitize_text_field' );

	// Inject the input field into the Misc Settings page
	add_settings_field(
		'fcd_sm_ga_measurement_id',
		'GA4 Measurement ID',
		'fcd_sm_ga_field_callback',
		'custom-settings-misc', // The page slug of the Misc tab
		'sm_misc_main_section'  // The section inside the Misc tab
	);
}

// 2. The Callback to render the input field and warning note
function fcd_sm_ga_field_callback() {
	$value = get_option( 'fcd_sm_ga_measurement_id', '' );
	?>
	<input type="text" name="fcd_sm_ga_measurement_id" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
	<p class="description">Enter your Measurement ID.</p>
	<p class="description" style="font-size: 12px; font-style: italic; opacity: 0.8; margin-top: 8px;">
		⚠️ <strong>Note:</strong> We recommend the use of plugins like RankMath or Google Site Kit to integrate GA4 properly for advanced tracking and e-commerce.
	</p>
	<?php
}

// 3. Output the GA4 Script to the Frontend <head>
add_action( 'wp_head', 'fcd_sm_ga_output_script', 20 );

function fcd_sm_ga_output_script() {
	// Don't output in the admin dashboard
	if ( is_admin() ) {
		return;
	}

	// Get the ID
	$ga_id = get_option( 'fcd_sm_ga_measurement_id', '' );
	
	// Bail early if the ID is blank
	if ( empty( $ga_id ) ) {
		return;
	}
	?>

<!-- Google tag (gtag.js) - FCD Settings Module -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '<?php echo esc_js( $ga_id ); ?>');
</script>
<!-- End Google tag -->

	<?php
}