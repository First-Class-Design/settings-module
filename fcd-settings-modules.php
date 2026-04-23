<?php
/**
 * Plugin Name: [FCD] Settings Modules ⚙️ 
 * Description: A core framework to load additional settings modules into a single admin page. Supports GitHub updates.
 * Plugin URI: https://fcd.org.uk/
 * Version: 1.1.2
 * Author: Gemini & Matt Watson
 * Author URI: https://fcd.org.uk/
 * Text Domain: fcd-settings-modules
 * License: Copyright 2026 - First Class Design Limitd. Handcrafted with prompts using Gemini AI.
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

class Settings_Modules_Core {

	public function __construct() {
		// 1. Initialize Plugin Update Checker (GitHub Updates)
		$this->init_update_checker();

		// 2. Load all modules from the 'modules' folder
		add_action( 'plugins_loaded', array( $this, 'load_modules' ) );

		// 3. Create the Admin Menu
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	/**
	 * Initialize the Plugin Update Checker library.
	 */
	private function init_update_checker() {
		$puc_path = SM_PLUGIN_PATH . 'plugin-update-checker/plugin-update-checker.php';
		
		// Only run if the library is installed
		if ( file_exists( $puc_path ) ) {
			require_once $puc_path;
			
			$myUpdateChecker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
				'https://github.com/First-Class-Design/code-snippets',
				SM_PLUGIN_PATH . 'fcd-settings-modules.php', 
				'fcd-settings-modules'
			);

			// Set the branch that contains the stable release.
			$myUpdateChecker->setBranch('main');
		}
	}

	/**
	 * Automatically include any PHP file found in the /modules/ subdirectory.
	 */
	public function load_modules() {
		$modules_dir = SM_PLUGIN_PATH . 'modules/';
		if ( is_dir( $modules_dir ) ) {
			foreach ( glob( $modules_dir . '*.php' ) as $filename ) {
				include_once $filename;
			}
		}
	}

	/**
	 * Add the top-level menu page.
	 */
	public function add_admin_menu() {
		add_menu_page(
			'Site Settings',
			'Custom Settings', // Renamed from 'Settings Modules'
			'manage_options',
			'custom-settings', // Slug updated to match
			array( $this, 'create_admin_page' ),
			'dashicons-admin-generic'
		);
	}

	/**
	 * Render the Admin Page with Tabs.
	 */
	public function create_admin_page() {
		// Get registered tabs from modules
		$tabs = apply_filters( 'sm_register_tabs', array() );

		// Determine active tab
		$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
		if ( empty( $active_tab ) && ! empty( $tabs ) ) {
			$active_tab = key( $tabs );
		}
		?>
		<div class="wrap">
			<h1>Custom Settings</h1>
			
			<!-- FCD Custom Header Integration -->
			<style>
				/* Scoped CSS for the Header Element to prevent conflicts with WP Admin */
				.fcd-header-wrapper {
					--fcd-background: #e3f1fa;
					--colors--primary-blue: #2c3178;
					--colors--cherry: #e60067;
					--white: white;
					
					background-color: var(--fcd-background);
					color: var(--colors--primary-blue);
					font-family: 'Fixel Text', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
					padding: 20px;
					margin: 20px 0;
					border-radius: 18px;
					border: solid 1px #00000030;
					box-shadow: 0 1px 1px rgba(0,0,0,0.04);
				}

				.fcd-header-wrapper * {
					box-sizing: border-box;
				}

				.fcd-header-wrapper .footer-logo-text {
					display: flex;
					align-items: center;
				}

				.fcd-header-wrapper .footer_brand-link {
					background-color: var(--colors--primary-blue);
					flex: none;
					justify-content: center;
					align-items: center;
					width: 7em;
					height: 7em;
					padding: 0.75em;
					display: flex;
					transition: background-color 0.2s ease;
					text-decoration: none;
					border-radius: 2px;
				}

				.fcd-header-wrapper .footer_brand-link:hover {
					background-color: var(--colors--cherry);
				}

				.fcd-header-wrapper .brand_logo {
					width: 100%;
					height: auto;
					display: block;
				}

				/* Wrapper for text content to stack slogan and credits */
				.fcd-header-wrapper .fcd-text-content {
					margin-left: 1.5em;
					display: flex;
					flex-direction: column;
					justify-content: center;
				}

				.fcd-header-wrapper .footer_slogan {
					letter-spacing: -0.005em;
					font-size: 1.85em;
					font-weight: 500;
					line-height: 1.2;
					color: var(--colors--primary-blue);
				}

				.fcd-header-wrapper .footer_credits {
					font-size: 1.1em; /* Increased size */
					margin-top: 8px;
					font-weight: 500; /* Increased weight, removed opacity */
				}

				/* Mobile Responsiveness */
				@media screen and (max-width: 991px) {
					.fcd-header-wrapper .footer-logo-text {
						display: block;
					}
					
					.fcd-header-wrapper .fcd-text-content {
						margin-top: 15px;
						margin-left: 0;
					}

					.fcd-header-wrapper .footer_slogan {
						display: block;
						font-size: 1.5em;
					}
				}

				@media screen and (max-width: 767px) {
					.fcd-header-wrapper .footer_brand-link {
						width: 5em;
						height: 5em;
					}
				}
			</style>

			<div class="fcd-header-wrapper">
				<div class="footer-logo-text">
					<a href="#" class="footer_brand-link">
						<img src="https://fcd.org.uk/wp-content/themes/fcd-2024/images/FCD_logotype.svg" alt="FCD Logo" class="brand_logo">
					</a>
					<div class="fcd-text-content">
						<div class="footer_slogan">
							We create marketing ideas, outstanding brands &amp; performant websites.
						</div>
						<div class="footer_credits">
							fcd.org.uk | Plugin handcrafted with prompts by FCD using Gemini
						</div>
					</div>
				</div>
			</div>
			<!-- End FCD Custom Header -->

			<h2 class="nav-tab-wrapper">
				<?php foreach ( $tabs as $tab_id => $tab_name ) : ?>
					<a href="?page=custom-settings&tab=<?php echo esc_attr( $tab_id ); ?>" class="nav-tab <?php echo $active_tab === $tab_id ? 'nav-tab-active' : ''; ?>">
						<?php echo esc_html( $tab_name ); ?>
					</a>
				<?php endforeach; ?>
			</h2>

			<div class="sm-content-wrapper" style="margin-top: 20px;">
				<?php
				if ( ! empty( $active_tab ) ) {
					// Allow the module to render its own form and settings fields
					do_action( 'sm_render_tab_' . $active_tab );
				} else {
					echo '<p>No modules loaded. Drop a PHP file into the <code>/modules/</code> folder.</p>';
				}
				?>
			</div>
		</div>
		<?php
	}
}

new Settings_Modules_Core();