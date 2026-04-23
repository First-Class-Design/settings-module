=== [FCD] Settings Modules ⚙️ ===
Contributors: fcd, mattwatson
Tags: settings, admin, modules, excerpt, limits, editor styles, admin color
Requires at least: 5.8
Tested up to: 6.5
Stable tag: 1.1.7
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A core framework to load additional settings modules into a single admin page. Handcrafted by First Class Design Ltd using Gemini AI.

== Description ==

[FCD] Settings Modules is a lightweight, extensible framework designed to consolidate various custom WordPress tweaks into a single, clean "Custom Settings" admin interface. Instead of installing a dozen individual micro-plugins, this framework allows you to easily drop in modular PHP files to enable only the features you need.

Included Modules:

Excerpt Settings: Control the global excerpt length and custom suffix (e.g., ... or [Read More]) per post type.

Archive Limits: Define a custom number of posts to display per page on specific post-type archives, overriding the default WordPress reading settings.

Editor Styles: Inject custom CSS directly into the Gutenberg Block Editor to perfectly match your frontend typography and layout.

Admin Colours: Override the default WordPress "Fresh" admin color scheme with your own brand's primary color, menu background, hover states, and text colors.

Misc Settings (Micro-Modules): A dedicated tab for toggleable site scripts and features. Includes toggles for:

Winter Snow Overlay ❄️: A CSS-only snow animation overlay for the frontend.

Basic Google Analytics: Easily inject a GA4 Measurement ID into your site's <head>.

Built for Agencies

Includes the Plugin Update Checker library, allowing seamless, automated over-the-air updates directly from your GitHub repository to all client sites.

== Installation ==

Upload the settings-modules folder to the /wp-content/plugins/ directory of your WordPress installation.

Activate the plugin through the 'Plugins' menu in WordPress.

Navigate to Site Settings > Custom Settings in the WordPress admin menu.

Browse the tabs to configure your activated modules.

== Frequently Asked Questions ==

= How do I add a new main module? =
Simply upload a properly formatted PHP class file into the /wp-content/plugins/settings-modules/modules/ directory. The core framework will automatically detect it, run its hooks, and load it as a new tab in the settings interface.

= How do I add a new toggle to the Misc tab? =
Drop a standalone PHP file into the nested /modules/misc-modules/ folder. The Misc Settings module will automatically read the plugin header (Name and Description) and generate a toggle switch for it on the frontend. The code within the micro-module will only execute if the toggle is enabled in the settings.

== Changelog ==

= 1.1.7 =

Replaces GitHub PAT.

= 1.1.6 =

Reverted 1.1.5 change.

Added GitHub PAT for increased rate limits.

= 1.1.5 =

Changed \YahnisElsts\PluginUpdateChecker\v5\PucFactory to \YahnisElsts\PluginUpdateChecker\v5p6\PucFactory

= 1.1.4 =

Stable tag bump.

= 1.1.3 =

Repo migration.

= 1.1.2 =

Fixed readme.txt content and versions.

Also acts as a test release to verify plugin-update-checker-5.6.

= 1.1.1 =

Fixed incorrect upload of plugin-update-checker-5.6.

= 1.1.01 =

Test release

= 1.1.0 =

Integrated Plugin Update Checker for automated GitHub releases.

= 1.0.2 =

Added fcd-snow.php and google-analytics.php micro-modules.

Refactored Misc Settings to dynamically load micro-modules based on folder contents.

= 1.0.1 =

Added Admin Colours module with sub-menu support.

Added Editor Styles module to map frontend CSS to Gutenberg.

Updated Excerpt Settings to support global custom suffixes.

= 1.0.0 =

Initial release. Core framework and custom FCD header established.

Added Excerpt Lengths module.

Added Archive Limits module.