<?php
/**
 * Module Name: Site Notice
 * Description: A dismissible site-wide notice with configurable positioning, colors, and cookies.
 * Version: 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module_Site_Notice {

	private $module_version = '1.0.1';
	private $option_group   = 'sm_notice_group';
	private $page_slug      = 'custom-settings-notice';
	private $tab_id         = 'site_notice';

	public function init() {
		add_filter( 'sm_register_tabs', array( $this, 'register_tab' ) );
		add_action( 'sm_render_tab_' . $this->tab_id, array( $this, 'render_settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'wp_footer', array( $this, 'output_frontend_notice' ), 99 );
	}

	public function register_tab( $tabs ) {
		$tabs[ $this->tab_id ] = 'Site Notice';
		return $tabs;
	}

	public function register_settings() {
		// Register all settings
		register_setting( $this->option_group, 'sm_notice_enable', 'rest_sanitize_boolean' );
		register_setting( $this->option_group, 'sm_notice_variant', 'sanitize_text_field' );
		register_setting( $this->option_group, 'sm_notice_content', 'wp_kses_post' );
		register_setting( $this->option_group, 'sm_notice_color', 'sanitize_text_field' );
		register_setting( $this->option_group, 'sm_notice_custom_bg', 'sanitize_hex_color' );
		register_setting( $this->option_group, 'sm_notice_custom_text', 'sanitize_hex_color' );
		register_setting( $this->option_group, 'sm_notice_position', 'sanitize_text_field' );
		register_setting( $this->option_group, 'sm_notice_align', 'sanitize_text_field' );
		register_setting( $this->option_group, 'sm_notice_icon', 'sanitize_text_field' );
		register_setting( $this->option_group, 'sm_notice_delay', 'absint' );
		register_setting( $this->option_group, 'sm_notice_remember', 'absint' );

		// Sections
		add_settings_section( 'sm_notice_main_section', 'Notice Configuration', array( $this, 'section_info' ), $this->page_slug );
		add_settings_section( 'sm_notice_style_section', 'Appearance & Positioning', null, $this->page_slug );
		add_settings_section( 'sm_notice_behavior_section', 'Timing & Behavior', null, $this->page_slug );

		// Fields - Main
		add_settings_field( 'sm_notice_enable', 'Enable Notice', array( $this, 'cb_checkbox' ), $this->page_slug, 'sm_notice_main_section', array( 'id' => 'sm_notice_enable', 'desc' => 'Turn the site-wide notice on or off.' ) );
		add_settings_field( 'sm_notice_variant', 'Variant', array( $this, 'cb_select' ), $this->page_slug, 'sm_notice_main_section', array( 'id' => 'sm_notice_variant', 'options' => array( 'simple' => 'Simple Notice', 'enriched' => 'Enriched Popup (Future)' ) ) );
		add_settings_field( 'sm_notice_content', 'Notice Text', array( $this, 'cb_textarea' ), $this->page_slug, 'sm_notice_main_section', array( 'id' => 'sm_notice_content', 'desc' => 'HTML allowed (e.g. &lt;strong&gt;, &lt;a href="..."&gt;).' ) );

		// Fields - Style
		add_settings_field( 'sm_notice_color', 'Color Theme', array( $this, 'cb_select' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_color', 'options' => array( 'black' => 'Black', 'white' => 'White', 'red' => 'Red (Error)', 'yellow' => 'Yellow (Warning)', 'custom' => 'Custom Colors' ) ) );
		add_settings_field( 'sm_notice_custom_bg', 'Custom Background', array( $this, 'cb_color' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_custom_bg', 'default' => '#2c3178' ) );
		add_settings_field( 'sm_notice_custom_text', 'Custom Text Color', array( $this, 'cb_color' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_custom_text', 'default' => '#ffffff' ) );
		add_settings_field( 'sm_notice_icon', 'Icon', array( $this, 'cb_select' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_icon', 'options' => array( 'none' => 'None', 'info' => 'Info Circle', 'warning' => 'Warning Triangle', 'bell' => 'Bell Notification', 'star' => 'Star' ) ) );
		add_settings_field( 'sm_notice_position', 'Position', array( $this, 'cb_select' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_position', 'options' => array( 'bottom-left' => 'Bottom Left (Floating)', 'bottom-right' => 'Bottom Right (Floating)', 'top-left' => 'Top Left (Floating)', 'top-right' => 'Top Right (Floating)', 'center' => 'Center (Floating)', 'top' => 'Top (Full Width)', 'bottom' => 'Bottom (Full Width)' ) ) );
		add_settings_field( 'sm_notice_align', 'Text Alignment', array( $this, 'cb_select' ), $this->page_slug, 'sm_notice_style_section', array( 'id' => 'sm_notice_align', 'options' => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ) ) );
		
		// Fields - Behavior
		add_settings_field( 'sm_notice_delay', 'Appearance Delay', array( $this, 'cb_number' ), $this->page_slug, 'sm_notice_behavior_section', array( 'id' => 'sm_notice_delay', 'default' => 1, 'suffix' => 'seconds' ) );
		add_settings_field( 'sm_notice_remember', 'Remember Dismissal', array( $this, 'cb_number' ), $this->page_slug, 'sm_notice_behavior_section', array( 'id' => 'sm_notice_remember', 'default' => 48, 'suffix' => 'hours', 'desc' => 'How long to hide the notice after the user clicks close. Note: Updating the Notice Text will automatically reset this for all users.' ) );
	}

	public function render_settings_page() {
		settings_errors();
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields( $this->option_group );
			do_settings_sections( $this->page_slug );
			submit_button();
			?>
		</form>
		<hr style="margin-top: 30px; border-color: #f0f0f1;">
		<p class="description" style="text-align: right; font-size: 10px; opacity: 0.6;">Module Version: <?php echo esc_html( $this->module_version ); ?></p>
		<?php
	}

	// --- Form Callbacks ---

	public function section_info() { echo '<p>Configure the global dismissible notice.</p>'; }

	public function cb_checkbox( $args ) {
		$value = get_option( $args['id'], false );
		echo '<label><input type="checkbox" name="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( 1, $value, false ) . ' /> ' . esc_html( $args['desc'] ) . '</label>';
	}

	public function cb_select( $args ) {
		$value = get_option( $args['id'], key( $args['options'] ) );
		echo '<select name="' . esc_attr( $args['id'] ) . '">';
		foreach ( $args['options'] as $key => $label ) {
			echo '<option value="' . esc_attr( $key ) . '" ' . selected( $key, $value, false ) . '>' . esc_html( $label ) . '</option>';
		}
		echo '</select>';
	}

	public function cb_textarea( $args ) {
		$value = get_option( $args['id'], '' );
		echo '<textarea name="' . esc_attr( $args['id'] ) . '" rows="4" style="width: 100%; max-width: 600px;">' . esc_textarea( $value ) . '</textarea>';
		if ( isset( $args['desc'] ) ) echo '<p class="description">' . esc_html( $args['desc'] ) . '</p>';
	}

	public function cb_color( $args ) {
		$value = get_option( $args['id'], $args['default'] );
		echo '<input type="color" name="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" style="height: 30px; width: 50px; padding: 0; border: 1px solid #ccc;">';
	}

	public function cb_number( $args ) {
		$value = get_option( $args['id'], $args['default'] );
		echo '<input type="number" name="' . esc_attr( $args['id'] ) . '" value="' . esc_attr( $value ) . '" class="small-text" min="0" step="1"> ' . esc_html( $args['suffix'] );
		if ( isset( $args['desc'] ) ) echo '<p class="description">' . esc_html( $args['desc'] ) . '</p>';
	}

	// --- Frontend Output ---

	public function output_frontend_notice() {
		if ( ! get_option( 'sm_notice_enable', false ) || is_admin() ) return;
		
		$content = get_option( 'sm_notice_content', '' );
		if ( empty( trim( $content ) ) ) return;

		// Options
		$color_theme = get_option( 'sm_notice_color', 'black' );
		$position    = get_option( 'sm_notice_position', 'bottom-left' );
		$align       = get_option( 'sm_notice_align', 'left' );
		$icon        = get_option( 'sm_notice_icon', 'none' );
		$delay_sec   = get_option( 'sm_notice_delay', 1 );
		$remember_hr = get_option( 'sm_notice_remember', 48 );

		// Generate Hash for LocalStorage (Changing text forces notice to reappear)
		$notice_hash = md5( $content );

		// Map Colors
		$bg_col = '#000000'; $txt_col = '#ffffff';
		switch ( $color_theme ) {
			case 'white':  $bg_col = '#ffffff'; $txt_col = '#000000'; break;
			case 'red':    $bg_col = '#dc3232'; $txt_col = '#ffffff'; break;
			case 'yellow': $bg_col = '#ffb900'; $txt_col = '#000000'; break;
			case 'custom': 
				$bg_col = get_option( 'sm_notice_custom_bg', '#2c3178' ); 
				$txt_col = get_option( 'sm_notice_custom_text', '#ffffff' ); 
				break;
		}

		// Map SVGs
		$svg_markup = '';
		if ( $icon === 'info' ) {
			$svg_markup = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
		} elseif ( $icon === 'warning' ) {
			$svg_markup = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
		} elseif ( $icon === 'bell' ) {
			$svg_markup = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>';
		} elseif ( $icon === 'star' ) {
			$svg_markup = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>';
		}

		?>
		<style>
			#fcd-site-notice {
				position: fixed;
				z-index: 999999;
				background-color: <?php echo esc_attr( $bg_col ); ?>;
				color: <?php echo esc_attr( $txt_col ); ?>;
				box-shadow: 0 4px 15px rgba(0,0,0,0.15);
				display: flex;
				align-items: center;
				gap: 12px;
				opacity: 0;
				visibility: hidden;
				transition: opacity 0.4s ease, visibility 0.4s ease, transform 0.4s ease;
				font-family: inherit;
				font-size: 15px;
				line-height: 1.4;
			}
			#fcd-site-notice.fcd-show {
				opacity: 1;
				visibility: visible;
				transform: translate(0, 0) !important;
			}
			
			/* Positional Logic */
			#fcd-site-notice.pos-top-left { top: 20px; left: 20px; border-radius: 8px; max-width: 400px; padding: 15px 20px; transform: translateY(-15px); }
			#fcd-site-notice.pos-top-right { top: 20px; right: 20px; border-radius: 8px; max-width: 400px; padding: 15px 20px; transform: translateY(-15px); }
			#fcd-site-notice.pos-bottom-left { bottom: 20px; left: 20px; border-radius: 8px; max-width: 400px; padding: 15px 20px; transform: translateY(15px); }
			#fcd-site-notice.pos-bottom-right { bottom: 20px; right: 20px; border-radius: 8px; max-width: 400px; padding: 15px 20px; transform: translateY(15px); }
			
			/* Center Position - Included the 100vmax backdrop shadow */
			#fcd-site-notice.pos-center { top: 50%; left: 50%; transform: translate(-50%, -45%); border-radius: 8px; max-width: 400px; padding: 15px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.15), 0 0 0 100vmax rgba(0, 0, 0, 0.8); }
			#fcd-site-notice.pos-center.fcd-show { transform: translate(-50%, -50%) !important; }
			
			#fcd-site-notice.pos-top { top: 0; left: 0; right: 0; width: 100%; border-radius: 0; padding: 12px 20px; justify-content: center; transform: translateY(-100%); }
			#fcd-site-notice.pos-bottom { bottom: 0; left: 0; right: 0; width: 100%; border-radius: 0; padding: 12px 20px; justify-content: center; transform: translateY(100%); }

			/* Typography & Elements */
			#fcd-site-notice a { color: inherit; text-decoration: underline; font-weight: 600; }
			#fcd-site-notice .fcd-notice-icon { flex-shrink: 0; width: 24px; height: 24px; display: flex; align-items: center; }
			#fcd-site-notice .fcd-notice-icon svg { width: 100%; height: 100%; }
			
			/* Alignment applies here */
			#fcd-site-notice .fcd-notice-content { flex-grow: 1; text-align: <?php echo esc_attr( $align ); ?>; }
			#fcd-site-notice .fcd-notice-content p:last-child { margin-bottom: 0; }
			
			#fcd-site-notice .fcd-notice-close {
				flex-shrink: 0;
				background: none; border: none; cursor: pointer; padding: 5px;
				color: <?php echo esc_attr( $txt_col ); ?>;
				opacity: 0.7; transition: opacity 0.2s;
				display: flex; align-items: center; justify-content: center;
			}
			#fcd-site-notice .fcd-notice-close:hover { opacity: 1; }
			#fcd-site-notice .fcd-notice-close svg { width: 18px; height: 18px; }
		</style>

		<div id="fcd-site-notice" class="pos-<?php echo esc_attr( $position ); ?>">
			<?php if ( ! empty( $svg_markup ) ) : ?>
				<div class="fcd-notice-icon"><?php echo $svg_markup; ?></div>
			<?php endif; ?>
			
			<div class="fcd-notice-content">
				<?php echo wp_kses_post( wpautop( $content ) ); ?>
			</div>

			<button id="fcd-notice-close" class="fcd-notice-close" aria-label="Close Notice">
				<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
			</button>
		</div>

		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const notice = document.getElementById('fcd-site-notice');
				const closeBtn = document.getElementById('fcd-notice-close');
				
				if (!notice || !closeBtn) return;

				// Hash based identifier. Changing text automatically reshows the notice to users.
				const storageKey = 'fcd_notice_<?php echo esc_js( $notice_hash ); ?>';
				const hideUntil = localStorage.getItem(storageKey);
				const now = new Date().getTime();

				// If not dismissed, or expiration time has passed
				if (!hideUntil || now > hideUntil) {
					setTimeout(function() {
						notice.classList.add('fcd-show');
					}, <?php echo absint( $delay_sec ) * 1000; ?>);
				}

				// Handle Dismissal
				closeBtn.addEventListener('click', function(e) {
					e.preventDefault();
					notice.classList.remove('fcd-show');
					
					// Calculate expiration (hours to milliseconds)
					const expiryTime = now + (<?php echo absint( $remember_hr ); ?> * 60 * 60 * 1000);
					localStorage.setItem(storageKey, expiryTime);
				});
			});
		</script>
		<?php
	}
}

$module_site_notice = new Module_Site_Notice();
$module_site_notice->init();