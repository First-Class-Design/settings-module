<?php
/**
 * Module Name: Admin Colour Scheme
 * Description: Customise the default WordPress Admin colour scheme.
 */

class Module_Admin_Colors {

	private $module_version = '1.0.4'; // Updated version
	private $option_group   = 'sm_admin_colors_group';
	private $page_slug      = 'custom-settings-colors'; 
	private $tab_id         = 'admin_colors';

	public function init() {
		// 1. Register the tab
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );

		// 2. Render the settings page
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );

		// 3. Register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// 4. Output the CSS overrides
		add_action( 'admin_head', array( $this, 'output_admin_css' ), 100 );
	}

	/**
	 * Register the tab.
	 */
	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Admin Colours';
		return $tabs;
	}

	/**
	 * Register the settings fields.
	 */
	public function register_settings() {
		register_setting( $this->option_group, 'sm_ac_primary_color', 'sanitize_hex_color' );
		register_setting( $this->option_group, 'sm_ac_menu_bg', 'sanitize_hex_color' );
		register_setting( $this->option_group, 'sm_ac_menu_text', 'sanitize_hex_color' );
		register_setting( $this->option_group, 'sm_ac_menu_hover_bg', 'sanitize_hex_color' ); 

		add_settings_section(
			'sm_ac_main_section',
			'Default Scheme Overrides',
			array( $this, 'section_info' ),
			$this->page_slug
		);

		add_settings_field(
			'sm_ac_primary_color',
			'Primary Brand Colour',
			array( $this, 'color_field_callback' ),
			$this->page_slug,
			'sm_ac_main_section',
			array( 'id' => 'sm_ac_primary_color', 'default' => '#2271b1' ) // WP Default Blue
		);

		add_settings_field(
			'sm_ac_menu_bg',
			'Menu Background',
			array( $this, 'color_field_callback' ),
			$this->page_slug,
			'sm_ac_main_section',
			array( 'id' => 'sm_ac_menu_bg', 'default' => '#1d2327' ) // WP Default Dark Grey
		);

		add_settings_field(
			'sm_ac_menu_hover_bg',
			'Menu Item Hover', 
			array( $this, 'color_field_callback' ),
			$this->page_slug,
			'sm_ac_main_section',
			array( 'id' => 'sm_ac_menu_hover_bg', 'default' => '#191e23' ) 
		);

		add_settings_field(
			'sm_ac_menu_text',
			'Menu Text Colour',
			array( $this, 'color_field_callback' ),
			$this->page_slug,
			'sm_ac_main_section',
			array( 'id' => 'sm_ac_menu_text', 'default' => '#f0f0f1' ) // WP Default Light Grey
		);
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( $this->option_group );
			do_settings_sections( $this->page_slug );
			submit_button( 'Save Colour Scheme' );
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
		echo '<p>These settings will override the colours for any user who has the <strong>Default</strong> admin colour scheme selected.</p>';
	}

	public function color_field_callback( $args ) {
		$id      = $args['id'];
		$default = $args['default'];
		$value   = get_option( $id, $default );
		?>
		<input type="color" name="<?php echo esc_attr( $id ); ?>" value="<?php echo esc_attr( $value ); ?>" style="height: 30px; width: 50px; padding: 0; border: 1px solid #ccc;">
		<span class="description" style="vertical-align: super; margin-left: 10px;">Default: <code><?php echo esc_html( $default ); ?></code></span>
		<?php
	}

	// --- Core Functionality ---

	/**
	 * Output CSS to override variables if the user is on the 'fresh' (Default) scheme.
	 */
	public function output_admin_css() {
		// 1. Check if user is logged in
		if ( ! is_user_logged_in() ) return;

		// 2. Check user's preferred color scheme
		$user_scheme = get_user_option( 'admin_color' );

		// 'fresh' is the internal ID for the Default scheme. 
		// Empty check covers cases where it hasn't been set yet.
		if ( 'fresh' === $user_scheme || empty( $user_scheme ) ) {
			
			$primary_color = get_option( 'sm_ac_primary_color', '#2271b1' );
			$menu_bg       = get_option( 'sm_ac_menu_bg', '#1d2327' );
			$menu_text     = get_option( 'sm_ac_menu_text', '#f0f0f1' );
			$menu_hover_bg = get_option( 'sm_ac_menu_hover_bg', '#191e23' );

			?>
			<style type="text/css">
				/* Override CSS Variables (WP 5.7+) */
				:root {
					--wp-admin-theme-color: <?php echo esc_attr( $primary_color ); ?>;
				}

				/* Hard overrides for elements that don't fully use variables yet or need specific targeting */
				
				/* Admin Bar & Menu Background */
				#wpadminbar,
				#adminmenuback,
				#adminmenuwrap,
				#adminmenu {
					background-color: <?php echo esc_attr( $menu_bg ); ?> !important;
				}

				/* Menu Text */
				#adminmenu a {
					color: <?php echo esc_attr( $menu_text ); ?>;
				}

				/* Hover Styles for Sidebar Links */
				#adminmenu li.menu-top:hover,
				#adminmenu li.opensub > a.menu-top,
				#adminmenu li > a.menu-top:focus {
					background-color: <?php echo esc_attr( $menu_hover_bg ); ?>;
					color: <?php echo esc_attr( $menu_text ); ?>;
				}

				/* Active Menu Item / Hover / Primary Buttons */
				#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,
				#adminmenu .wp-menu-arrow,
				#adminmenu .wp-menu-arrow div,
				#adminmenu li.current a.menu-top,
				#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
				.folded #adminmenu li.current.menu-top,
				.folded #adminmenu li.wp-has-current-submenu {
					background: <?php echo esc_attr( $primary_color ); ?> !important;
				}
				
				/* Primary Buttons */
				.wp-core-ui .button-primary {
					background: <?php echo esc_attr( $primary_color ); ?> !important;
					border-color: <?php echo esc_attr( $primary_color ); ?> !important;
				}

				/* Links in content */
				a {
					color: <?php echo esc_attr( $primary_color ); ?>;
				}
				
				/* Form Focus States */
				input[type=text]:focus,
				input[type=search]:focus,
				input[type=radio]:focus,
				input[type=tel]:focus,
				input[type=time]:focus,
				input[type=url]:focus,
				input[type=week]:focus,
				input[type=password]:focus,
				input[type=checkbox]:focus,
				input[type=color]:focus,
				input[type=date]:focus,
				input[type=datetime]:focus,
				input[type=datetime-local]:focus,
				input[type=email]:focus,
				input[type=month]:focus,
				input[type=number]:focus,
				select:focus,
				textarea:focus {
					border-color: <?php echo esc_attr( $primary_color ); ?>;
					box-shadow: 0 0 0 1px <?php echo esc_attr( $primary_color ); ?>;
				}
			</style>
			<?php
		}
	}
}

$module_admin_colors = new Module_Admin_Colors();
$module_admin_colors->init();