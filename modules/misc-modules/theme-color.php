<?php
/**
 * Plugin Name: Theme Color Meta
 * Description: Adds a customizable <meta name="theme-color"> tag to your site's <head> to style mobile browser UI.
 * Version: 1.0.0
 * Text Domain: fcd-theme-color
 * Author: FCD
 **/

// 1. Register the Settings Field (Only runs when this micro-module is enabled)
add_action( 'admin_init', 'fcd_sm_theme_color_register_settings' );

function fcd_sm_theme_color_register_settings() {
	// Register the option to store the hex color (using WP's native hex sanitizer)
	register_setting( 'sm_misc_settings_group', 'fcd_sm_theme_color_hex', 'sanitize_hex_color' );

	// Inject the color picker field into the Misc Settings page
	add_settings_field(
		'fcd_sm_theme_color_hex',
		'Theme Color Hex',
		'fcd_sm_theme_color_field_callback',
		'custom-settings-misc', // The page slug of the Misc tab
		'sm_misc_main_section'  // The section inside the Misc tab
	);
}

// 2. The Callback to render the color input field
function fcd_sm_theme_color_field_callback() {
	$value = get_option( 'fcd_sm_theme_color_hex', '#ffffff' );
	?>
	<input type="color" name="fcd_sm_theme_color_hex" value="<?php echo esc_attr( $value ); ?>" style="height: 30px; width: 50px; padding: 0; border: 1px solid #ccc;" />
	<span class="description" style="vertical-align: super; margin-left: 10px;">Select the brand color for mobile browser UI elements (like the address bar).</span>
	<?php
}

// 3. Output the Meta Tag to the Frontend <head>
add_action( 'wp_head', 'fcd_sm_theme_color_output_meta', 5 );

function fcd_sm_theme_color_output_meta() {
	// Don't output in the admin dashboard
	if ( is_admin() ) {
		return;
	}

	// Get the selected color
	$color = get_option( 'fcd_sm_theme_color_hex', '' );
	
	// Bail early if the color is blank
	if ( empty( $color ) ) {
		return;
	}
	?>

<!-- FCD Theme Color -->
<meta name="theme-color" content="<?php echo esc_attr( $color ); ?>">
	<?php
}