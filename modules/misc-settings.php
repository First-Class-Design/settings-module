<?php
/**
 * Module Name: Misc Settings
 * Description: A collection of miscellaneous site features and toggles (e.g., FCD Snow).
 */

class Module_Misc_Settings {

	private $module_version = '1.0.1';
	private $option_group   = 'sm_misc_settings_group';
	private $page_slug      = 'custom-settings-misc'; 
	private $tab_id         = 'misc';

	public function init() {
		// 1. Register the tab
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the settings page
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register settings dynamically from the micro-modules folder
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. Automatically load enabled micro-modules
		if ( defined( 'SM_PLUGIN_PATH' ) ) {
			$misc_dir = SM_PLUGIN_PATH . 'modules/misc-modules/';
			if ( is_dir( $misc_dir ) ) {
				foreach ( glob( $misc_dir . '*.php' ) as $filename ) {
					$slug = 'sm_misc_enable_' . sanitize_key( basename( $filename, '.php' ) );
					// If the option is checked in settings, include the micro-module file
					if ( get_option( $slug, false ) ) {
						include_once $filename;
					}
				}
			}
		}
	}

	/**
	 * Register the tab.
	 */
	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Misc';
		return $tabs;
	}

	/**
	 * Dynamically register the settings fields by scanning the 'misc-modules' folder.
	 */
	public function register_settings() {
		add_settings_section(
			'sm_misc_main_section',
			'Miscellaneous Features',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		if ( ! defined( 'SM_PLUGIN_PATH' ) ) {
			return;
		}

		$misc_dir = SM_PLUGIN_PATH . 'modules/misc-modules/';
		if ( ! is_dir( $misc_dir ) ) {
			return;
		}

		// Ensure WordPress file fetching tools are available to read plugin headers
		if ( ! function_exists( 'get_file_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		foreach ( glob( $misc_dir . '*.php' ) as $filename ) {
			// Extract the standard plugin headers from the dropped-in files
			$headers = get_file_data( $filename, array(
				'PluginName'  => 'Plugin Name',
				'ModuleName'  => 'Module Name',
				'Description' => 'Description'
			) );

			// Fallbacks for the module name
			$name = ! empty( $headers['ModuleName'] ) ? $headers['ModuleName'] : $headers['PluginName'];
			$name = ! empty( $name ) ? $name : basename( $filename, '.php' );
			
			// Description logic
			$desc = ! empty( $headers['Description'] ) ? $headers['Description'] : 'No description provided.';
			
			// Create a unique slug for this file to store in the database
			$slug = 'sm_misc_enable_' . sanitize_key( basename( $filename, '.php' ) );

			// Register the setting
			register_setting( $this->option_group, $slug, 'rest_sanitize_boolean' );

			// Render the checkbox on the page
			add_settings_field(
				$slug,
				$name,
				array( $this, 'checkbox_field_callback' ),
				$this->page_slug,
				'sm_misc_main_section',
				array( 
					'id'          => $slug,
					'description' => $desc
				)
			);
		}
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( $this->option_group );
			do_settings_sections( $this->page_slug );
			submit_button( 'Save Misc Settings' );
			?>
		</form>

		<hr style="margin-top: 30px; border-color: #f0f0f1;">
		<p class="description" style="text-align: right; font-size: 10px; opacity: 0.6;">
			Module Version: <?php echo esc_html( $this->module_version ); ?>
		</p>
		<?php
	}

	// --- Callbacks ---

	public function section_info() {
		echo '<p>Toggle various miscellaneous features and scripts for your website below. These are automatically generated from files placed in the <code>/modules/misc-modules/</code> folder.</p>';
	}

	public function checkbox_field_callback( $args ) {
		$id          = $args['id'];
		$description = $args['description'];
		$value       = get_option( $id, false );
		?>
		<label>
			<input type="checkbox" name="<?php echo esc_attr( $id ); ?>" value="1" <?php checked( 1, $value ); ?> />
			<?php echo esc_html( $description ); ?>
		</label>
		<?php
	}
}

$module_misc_settings = new Module_Misc_Settings();
$module_misc_settings->init();