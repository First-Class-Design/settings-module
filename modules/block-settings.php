<?php
/**
 * Module Name: Block Settings
 * Description: Manage custom Gutenberg blocks and global block configurations.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module_Block_Settings {

	private $module_version = '1.0.1'; // Updated version for subdirectory support
	private $option_group   = 'sm_block_settings_group';
	private $page_slug      = 'custom-settings-blocks'; 
	private $tab_id         = 'blocks';

	public function init() {
		// 1. Register the tab
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the settings page
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register settings dynamically
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. Automatically load enabled blocks
		if ( defined( 'SM_PLUGIN_PATH' ) ) {
			$blocks_dir = SM_PLUGIN_PATH . 'modules/blocks/';
			if ( is_dir( $blocks_dir ) ) {
				// Scan both the root directory and one level deep into subdirectories
				$files = array_merge( glob( $blocks_dir . '*.php' ), glob( $blocks_dir . '*/*.php' ) );
				
				foreach ( $files as $filename ) {
					$slug = 'sm_block_enable_' . sanitize_key( basename( $filename, '.php' ) );
					
					// If the block is enabled in settings, include its file
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
		$tabs[ $this->tab_id ] = 'Blocks';
		return $tabs;
	}

	/**
	 * Dynamically register the settings fields.
	 */
	public function register_settings() {
		
		// --- Section 1: Global Block Options ---
		add_settings_section(
			'sm_blocks_global_section',
			'Global Block Options',
			array( $this, 'global_section_info' ),
			$this->page_slug
		);

		// --- Section 2: Available Blocks ---
		add_settings_section(
			'sm_blocks_main_section',
			'Available Custom Blocks',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		if ( ! defined( 'SM_PLUGIN_PATH' ) ) {
			return;
		}

		$blocks_dir = SM_PLUGIN_PATH . 'modules/blocks/';
		if ( ! is_dir( $blocks_dir ) ) {
			return;
		}

		if ( ! function_exists( 'get_file_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Scan both the root directory and one level deep into subdirectories
		$files = array_merge( glob( $blocks_dir . '*.php' ), glob( $blocks_dir . '*/*.php' ) );

		foreach ( $files as $filename ) {
			// Extract custom plugin headers from the block files
			$headers = get_file_data( $filename, array(
				'BlockName'   => 'Block Name',
				'Description' => 'Description'
			) );

			// STRICT CHECK: Skip this file if it doesn't have a "Block Name:" header. 
			// This prevents template files (like gallery-section.php) from showing up as toggles.
			if ( empty( $headers['BlockName'] ) ) {
				continue;
			}

			$name = $headers['BlockName'];
			$desc = ! empty( $headers['Description'] ) ? $headers['Description'] : 'No description provided.';
			$slug = 'sm_block_enable_' . sanitize_key( basename( $filename, '.php' ) );

			// Register the setting
			register_setting( $this->option_group, $slug, 'rest_sanitize_boolean' );

			// Render the checkbox
			add_settings_field(
				$slug,
				$name,
				array( $this, 'checkbox_field_callback' ),
				$this->page_slug,
				'sm_blocks_main_section',
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
			submit_button( 'Save Block Settings' );
			?>
		</form>

		<hr style="margin-top: 30px; border-color: #f0f0f1;">
		<p class="description" style="text-align: right; font-size: 10px; opacity: 0.6;">
			Module Version: <?php echo esc_html( $this->module_version ); ?>
		</p>
		<?php
	}

	// --- Callbacks ---

	public function global_section_info() {
		echo '<p>Configure global settings and API keys that apply across multiple custom blocks.</p>';
	}

	public function section_info() {
		echo '<p>Enable or disable specific custom Gutenberg blocks. Drop your block files into the <code>/modules/blocks/</code> folder (or within a subfolder) to register them here.</p>';
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

$module_block_settings = new Module_Block_Settings();
$module_block_settings->init();