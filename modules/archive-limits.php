<?php
/**
 * Module Name: Archive Limits
 * Description: Control the number of posts displayed per page for different post type archives.
 */

class Module_Archive_Limits {

	private $module_version = '1.0.1'; // Version independent of main plugin
	private $option_name    = 'sm_archive_limits'; 
	private $page_slug      = 'custom-settings-archive'; // Fixed: Unique slug to prevent conflicts with other tabs
	private $tab_id         = 'archive_limits';

	public function init() {
		// 1. Register the tab with the Core plugin
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the content when this tab is active
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register standard WordPress settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. The actual functionality (Frontend Query Modifier)
		add_action( 'pre_get_posts', array( $this, 'modify_archive_query' ) );
	}

	/**
	 * Add 'Archive Limits' to the tabs array.
	 */
	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Archive Limits';
		return $tabs;
	}

	/**
	 * Register the settings in the WordPress database.
	 */
	public function register_settings() {
		register_setting(
			'sm_archive_limits_group',
			$this->option_name,
			array( 'sanitize_callback' => array( $this, 'sanitize' ) )
		);

		add_settings_section(
			'sm_archive_limits_section',
			'Archive Configuration',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		// Get all public post types automatically
		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		foreach ( $post_types as $post_type ) {
			// Skip attachments and nav menus
			if ( 'attachment' === $post_type->name || 'nav_menu_item' === $post_type->name ) {
				continue;
			}

			add_settings_field(
				'limit_' . $post_type->name,
				$post_type->label . ' (' . $post_type->name . ')',
				array( $this, 'field_callback' ),
				$this->page_slug,
				'sm_archive_limits_section',
				array( 'post_type' => $post_type->name )
			);
		}
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'sm_archive_limits_group' );
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

	// --- Helper Functions ---

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

	public function section_info() {
		echo 'Define how many posts should show per page on archives. Leave blank to use the WordPress default (Settings > Reading).';
	}

	public function field_callback( $args ) {
		$post_type = $args['post_type'];
		$options   = get_option( $this->option_name );
		$value     = isset( $options[ $post_type ] ) ? $options[ $post_type ] : '';

		printf(
			'<input type="number" name="%s[%s]" value="%s" class="small-text" min="1" step="1" /> posts per page',
			esc_attr( $this->option_name ),
			esc_attr( $post_type ),
			esc_attr( $value )
		);
	}

	/**
	 * Modify the main query to change posts_per_page
	 */
	public function modify_archive_query( $query ) {
		// Only run on frontend, main query
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		$target_post_type = '';

		// Detect context
		if ( $query->is_home() ) {
			// Blog index
			$target_post_type = 'post';
		} elseif ( $query->is_post_type_archive() ) {
			// Standard Post Type Archive (e.g. /reviews/)
			$target_post_type = $query->get( 'post_type' );
		} elseif ( $query->is_category() || $query->is_tag() ) {
			// Categories and Tags usually display Posts
			$target_post_type = 'post';
		}

		// If we found a valid post type context
		if ( ! empty( $target_post_type ) && ! is_array( $target_post_type ) ) {
			$options = get_option( $this->option_name );
			
			if ( ! empty( $options ) && isset( $options[ $target_post_type ] ) && ! empty( $options[ $target_post_type ] ) ) {
				$query->set( 'posts_per_page', intval( $options[ $target_post_type ] ) );
			}
		}
	}
}

$module_archive_limits = new Module_Archive_Limits();
$module_archive_limits->init();