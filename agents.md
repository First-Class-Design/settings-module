### Plugin Meta Data
These 2 files should always remain in sync:
- info.json is our WordPress plugin description, change-log, banner and icon used within WordPress to pull latest information from our server.
- readme.md is our GitHub repo change-logo and description.

### Plugin Files
- fcd-settings-modules.php is our core logic. Any version changes in here should also be kept in sync with our meta data files above.
- /modules/ directory is where our main modules live.
- /modules/misc-modules is where our tiny micro-modules live (smaller tweaks that don't need their own module tab)

### Updates
We use the 'plugin-update-checker' code to check our 'plugins.fcd.org.uk/settings-modules' URL for any updates. This relies on info.json so the information is correct.

### Releasing new versions
- Package all files excluding 'landing-page' directory and 'info.json' file to a ZIP archive 'fcd-settings-modules-XXX.zip' with XXX referring to the version number.
- Push onto GitHub and draft a release with the change-log in the description and our title / tag matching our version number.