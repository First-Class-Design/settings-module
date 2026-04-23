<?php
/**
 * Module Name: Custom Editor Styles
 * Description: Add custom CSS to the WordPress Block Editor (Gutenberg) to match your frontend.
 */

class Module_Editor_Styles {

	private $module_version = '1.0.0';
	private $option_name    = 'ces_custom_css';
	private $page_slug      = 'custom-settings-editor-styles'; // Unique slug
	private $tab_id         = 'editor_styles';

	public function init() {
		// 1. Register the tab with the Core plugin
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the content when this tab is active
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register standard WordPress settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. Functionality: Enable Editor Styles Support
		add_action( 'after_setup_theme', array( $this, 'enable_theme_support' ) );

		// 5. Functionality: Enqueue the CSS
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_styles' ) );
	}

	/**
	 * Register Tab
	 */
	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Editor Styles';
		return $tabs;
	}

	/**
	 * Register Settings
	 */
	public function register_settings() {
		register_setting(
			'ces_option_group',
			$this->option_name,
			array( 'sanitize_callback' => 'wp_strip_all_tags' ) // Basic sanitization for CSS
		);

		add_settings_section(
			'ces_main_section',
			'Editor Appearance Configuration',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		add_settings_field(
			'ces_custom_css_field',
			'Custom CSS',
			array( $this, 'field_callback' ),
			$this->page_slug,
			'ces_main_section'
		);
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'ces_option_group' );
			do_settings_sections( $this->page_slug );
			submit_button( 'Save Editor Styles' );
			?>
		</form>

		<hr style="margin-top: 30px; border-color: #f0f0f1;">
		<p class="description" style="text-align: right; opacity: 0.6;">
			Module Version: <?php echo esc_html( $this->module_version ); ?>
		</p>
		<?php
	}

	// --- Callbacks ---

	public function section_info() {
		echo '<p>Enter the CSS below that you want to apply specifically to the Gutenberg block editor.</p>';
		echo '<p><em>Tip: To match your frontend h1, simply type <code>h1 { font-family: "MyFont", sans-serif; }</code></em></p>';
	}

	public function field_callback() {
		$value = get_option( $this->option_name, '' );
		echo '<textarea id="ces_custom_css" name="' . esc_attr( $this->option_name ) . '" rows="15" cols="70" class="large-text code" spellcheck="false">' . esc_textarea( $value ) . '</textarea>';
	}

	// --- Core Functionality ---

	/**
	 * Ensure the theme supports editor styles.
	 * This is crucial for the editor to try and match the frontend structure (and often triggers the iframe mode).
	 */
	public function enable_theme_support() {
		add_theme_support( 'editor-styles' );
	}

	/**
	 * Inject the CSS into the Block Editor
	 */
	public function enqueue_editor_styles() {
		$custom_css = get_option( $this->option_name );

		if ( ! empty( $custom_css ) ) {
			// We register a dummy handle to attach our inline styles to.
			// We use 'wp-block-editor' as a dependency to ensure the editor is loaded first.
			wp_register_style( 'ces-custom-editor-style', false, array( 'wp-block-editor' ) );
			wp_enqueue_style( 'ces-custom-editor-style' );
			
			// Inject the CSS
			wp_add_inline_style( 'ces-custom-editor-style', $custom_css );
		}
	}
}

$module_editor_styles = new Module_Editor_Styles();
$module_editor_styles->init();