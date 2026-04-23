<?php
/**
 * Module Name: Excerpt Settings
 * Description: Hooks into Settings Modules to provide excerpt control (length and suffix).
 */

class Module_Excerpt_Lengths {

	private $module_version = '1.0.2'; // Updated version
	private $option_name    = 'cel_post_type_lengths';
	private $option_more    = 'cel_excerpt_more'; // New option for the suffix
	private $page_slug      = 'custom-settings-excerpts'; 
	private $tab_id         = 'excerpts';

	public function init() {
		// 1. Register the tab with the Core plugin
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the content when this tab is active
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register standard WordPress settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. Frontend Filters
		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 );
		add_filter( 'excerpt_more', array( $this, 'custom_excerpt_more' ), 999 );
	}

	/**
	 * Register Tab - Renamed to "Excerpt Settings"
	 */
	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Excerpt Settings';
		return $tabs;
	}

	/**
	 * Register the settings in the WordPress database.
	 */
	public function register_settings() {
		// 1. Excerpt Lengths (Array)
		register_setting(
			'cel_option_group',
			$this->option_name,
			array( 'sanitize_callback' => array( $this, 'sanitize' ) )
		);

		// 2. Excerpt More Suffix (String)
		register_setting(
			'cel_option_group',
			$this->option_more,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);

		// --- Section 1: General Settings (Suffix) ---
		add_settings_section(
			'cel_general_section',
			'General Settings',
			array( $this, 'general_section_info' ),
			$this->page_slug
		);

		add_settings_field(
			'cel_excerpt_more',
			'Excerpt Suffix',
			array( $this, 'field_more_callback' ),
			$this->page_slug,
			'cel_general_section'
		);

		// --- Section 2: Post Type Lengths ---
		add_settings_section(
			'cel_setting_section',
			'Post Type Lengths',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		foreach ( $post_types as $post_type ) {
			if ( 'attachment' === $post_type->name || 'nav_menu_item' === $post_type->name ) {
				continue;
			}

			add_settings_field(
				'cel_' . $post_type->name,
				$post_type->label . ' (' . $post_type->name . ')',
				array( $this, 'field_callback' ),
				$this->page_slug,
				'cel_setting_section',
				array( 'post_type' => $post_type->name )
			);
		}
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'cel_option_group' );
			do_settings_sections( $this->page_slug );
			submit_button();
			?>
		</form>
		
		<hr style="margin-top: 30px; border-color: #f0f0f1;">
		<p class="description" style="text-align: right; opacity: 0.6;">
			Module Version: <?php echo esc_html( $this->module_version ); ?>
		</p>
		<?php
	}

	// --- Callbacks ---

	public function general_section_info() {
		echo 'Control the global appearance of excerpts.';
	}

	public function section_info() {
		echo 'Define word counts below. Leave blank for default.';
	}

	public function field_more_callback() {
		$value = get_option( $this->option_more );
		?>
		<input type="text" name="<?php echo esc_attr( $this->option_more ); ?>" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="e.g. ..." />
		<p class="description">The text to display at the end of a truncated excerpt (e.g. <code>...</code> or <code>[Read More]</code>).</p>
		<?php
	}

	public function field_callback( $args ) {
		$post_type = $args['post_type'];
		$options   = get_option( $this->option_name );
		$value     = isset( $options[ $post_type ] ) ? $options[ $post_type ] : '';

		printf(
			'<input type="number" name="%s[%s]" value="%s" class="small-text" min="0" /> words',
			esc_attr( $this->option_name ),
			esc_attr( $post_type ),
			esc_attr( $value )
		);
	}

	public function sanitize( $input ) {
		$new_input = array();
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				if ( ! empty( $value ) ) {
					$new_input[ $key ] = absint( $value );
				}
			}
		}
		return $new_input;
	}

	// --- Filter Logic ---

	public function custom_excerpt_length( $length ) {
		if ( is_admin() ) return $length;
		global $post;
		if ( ! isset( $post->post_type ) ) return $length;

		$options = get_option( $this->option_name );
		if ( ! empty( $options ) && ! empty( $options[ $post->post_type ] ) ) {
			return intval( $options[ $post->post_type ] );
		}
		return $length;
	}

	public function custom_excerpt_more( $more ) {
		if ( is_admin() ) return $more;
		
		$custom_more = get_option( $this->option_more );
		
		// If user saved a value (even empty string), use it. 
		// get_option returns false if not set, string if set.
		if ( false !== $custom_more ) {
			return $custom_more;
		}
		
		return $more;
	}
}

$module_excerpts = new Module_Excerpt_Lengths();
$module_excerpts->init();