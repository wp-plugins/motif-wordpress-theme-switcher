=== Motif WordPress Theme Switcher ===
Contributors: Penuel
Tags: themes, automatic switcher
Requires at least: 2.5
Tested up to: 2.8.5
Stable tag: trunk

Motif WordPress Theme Switcher, changes the themes of your WordPress blog automatically everyday. 

== Description ==

Motif WordPress Theme Switcher, changes the themes of your WordPress blog automatically everyday. You can control which theme to apply on which day from within the plugin. 

Some of the features:

* Displays all the themes you have installed in your blog in preview image
* Assign themes to each day in a week using a matrix
* Ability to add Google Analytics tracking code from the plugin, so that it automatically embeds the Google Analytics code in your switched theme if its missing.
* Turn off the plugin without deactivating the plugin or loosing your settings.

*Issues*

There can be few issues while using this plugin depending on your setup, that you might want to consider.

1. The plugin simply switches the theme files when it switches the theme on a given day. Possibilities are there that you have some code embedded right in one of your current theme files (for example; the Google AdSense code, or Google Analytics Tracking code). When the switcher switches to the new theme, that code might not be present in the switched theme file causing your code or ads stopped on your blog. To continue using this plugin, without stopping anything on your website, please make sure you have necessary codes in all of theme files or use a plugin that embeds for example Ad code dynamically instead of embeding in the template file

1. The plugin tries to embed your Google Analytics code in the footer of each page, but again it depends if 'get_footer' action is called in your theme file. If the necessary hooks and fucntions are not used in your Theme file, the plugin will fail to embed the GA code in footer. Alternatively if your theme file has already Google Analytics code embeded and you have added the GA code in the plugin as well it will just create a duplicate GA code, which should be avoided.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `motif-wp-theme-switcher` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Once the plugin is activated goto your blog's Design or Appearance section and click on Motif WP Theme Switcher to turn on and assign themes for each day.

== Frequently Asked Questions ==

= Will my Ads code removed? =

Yes, if you have embeded your Ads code directly inside your wordpress theme files. If the same code is not present in other switched themes, your Ads will disappear.
However if you have plugin that adds the your code without requiring you to embed in theme file your Ads should continue to work.

= Will my Google Analytics (GA) code removed? =

Yes, if you have embeded the Google Analytics (GA) code inside your wordpress them files and have not added GA code in the plugins options screen.  If the same code is not present in other switched themes, your GA code will disappear.

== Changelog ==
First version created