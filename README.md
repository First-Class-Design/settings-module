![Settings Module - GitHub Banner](assets/WordPress_Setings_module-banner.png)

# **\[FCD\] Settings Modules ⚙️**

* **Contributors:** fcd, mattwatson
* **Tags:** settings, admin, modules, excerpt, limits, editor styles, admin color
* **Requires at least:** 6.4
* **Tested up to:** 7.0.0
* **Requires PHP:** 8.0
* **License:** GPLv2 or later

A core framework to load additional settings modules into a single admin page. Handcrafted by First Class Design Ltd using Gemini AI.

## **Description**

\[FCD\] Settings Modules is a lightweight, extensible framework designed to consolidate various custom WordPress tweaks into a single, clean "Custom Settings" admin interface. Instead of installing a dozen individual micro-plugins, this framework allows you to easily drop in modular PHP files to enable only the features you need.

### **Included Modules:**

* **Site Notice:** A dismissible site-wide notice with configurable positioning, colours, SVG icons, and smart local-storage cookies that auto-reset when content changes.
* **Excerpt Settings:** Control the global excerpt length and custom suffix (e.g., ... or \[Read More\]) per post type. 
* **Archive Limits:** Define a custom number of posts to display per page on specific post-type archives, overriding the default WordPress reading settings.  
* **Editor Styles:** Inject custom CSS directly into the Gutenberg Block Editor to perfectly match your frontend typography and layout.  
* **Admin Colours:** Override the default WordPress "Fresh" admin color scheme with your own brand's primary color, menu background, hover states, and text colours.  
* **Misc Settings (Micro-Modules):** A dedicated tab for taggable site scripts and features. Includes toggles for:  
  * **Winter Snow Overlay ❄️:** A CSS-only snow animation overlay for the frontend.  
  * **Basic Google Analytics:** Easily inject a GA4 Measurement ID into your site's \<head\>.

### **Built for Agencies**

Includes the Plugin Update Checker library, allowing seamless, automated over-the-air updates directly from your GitHub repository to all client sites.

## **Installation**

1. Upload the fcd-settings-modules folder to the /wp-content/plugins/ directory of your WordPress installation.  
2. Activate the plugin through the **Plugins** menu in WordPress.  
3. Navigate to **Dashboard \> Custom Settings** in the WordPress admin menu.  
4. Browse the tabs to configure your activated modules.

## **Frequently Asked Questions**

### **How do I add a new main module?**

Simply upload a properly formatted PHP class file into the /wp-content/plugins/fcd-settings-modules/modules/ directory. The core framework will automatically detect it, run its hooks, and load it as a new tab in the settings interface.

### **How do I add a new toggle to the Misc tab?**

Drop a standalone PHP file into the nested /modules/misc-modules/ folder. The Misc Settings module will automatically read the plugin header (Name and Description) and generate a toggle switch for it on the frontend. The code within the micro-module will only execute if the toggle is enabled in the settings.

## **Changelog**

### **1.1.18**

* Added a quick settings link next 'Deactivate' link on the plugin list. 

### **1.1.17**

* Added a new main module for a site-wide notice. Features include:  
  * **Flexible Positioning:** 7 distinct layout options (floating corners, center, full-width top/bottom).  
  * **Customizable Appearance:** Pre-built color themes (Error, Warning, Light, Dark) plus custom hex support.  
  * **Built-in Icons:** Selectable SVG icons (Info, Warning, Bell, Star).  
  * **Smart Dismissal Memory:** Remembers closed state via local storage for a customizable number of hours.  
  * **Auto-Reset on Update:** Automatically detects when the notice content changes and resets the dismissal state for all users.  
  * **Appearance Delay:** Configurable timer to delay the popup animation after page load.

### **1.1.16**

* Fixed the ACF Google Map script micro module (issue previously caused by functions.php already having an API key present) so the additional forces were removed.

### **1.1.15**

* Added a force check to use only the API key within the ACF option.

### **1.1.14**

* Added Google Cloud API key for legacy Places API with ACF.

### **1.1.13**

* Added enable/disable toggle for the admin colour module.

### **1.1.12**

* Added a check for WordPress 7.0 new 'modern' default theme (previously 'fresh').
* New icon.
* New banner.

### **1.1.11**

* Bumped tested WordPress version to 7.0.0.
* Revised helper text for editor styles to include `.editor-styles-wrapper` class.
* Added instructions to natively embed editor styles inside a WordPress theme.

### **1.1.10**

* Bumped minimum WordPress version to 6.4.
* Bumped tested WordPress version to 6.9.4.
* Expanded info.json and removed readme.txt.
* Added icon and banner to info.json.

### **1.1.9**

* Added <meta> theme support to misc-modules.
* Added self-hosted updater via info.json.

### **1.1.8**

* Removal of GH PAT.

### **1.1.7**

* Replaces GitHub PAT.

### **1.1.6**

* Reverted 1.1.5 change.
* Added GitHub PAT for increased rate limits.

### **1.1.5**

* Changed `\YahnisElsts\PluginUpdateChecker\v5\PucFactory` to `\YahnisElsts\PluginUpdateChecker\v5p6\PucFactory`

### **1.1.4**

* Stable tag bump. 

### **1.1.3**

* Repo migration.  

### **1.1.2**

* Fixed readme.txt content and versions.  
* Also acts as a test release to verify plugin-update-checker-5.6.

### **1.1.1**

* Fixed incorrect upload of plugin-update-checker-5.6.

### **1.1.01**

* Test release.

### **1.1.0**

* Integrated Plugin Update Checker for automated GitHub releases.

### **1.0.2**

* Added fcd-snow.php and google-analytics.php micro-modules.  
* Refactored Misc Settings to dynamically load micro-modules based on folder contents.

### **1.0.1**

* Added Admin Colours module with sub-menu support.  
* Added Editor Styles module to map frontend CSS to Gutenberg.  
* Updated Excerpt Settings to support global custom suffixes.

### **1.0.0**

* Initial release. Core framework and custom FCD header established.  
* Added Excerpt Lengths module.  
* Added Archive Limits module.