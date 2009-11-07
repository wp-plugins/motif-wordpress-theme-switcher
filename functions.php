<?php
/**
 * Motif WP Theme Switcher Plugin functions.
 * 
 */

function get_theme_baseuri(){
	global $wp_version;
	if((double) $wp_version <= 2.5){
		$theme_base_uri = get_option('siteurl');
	}
	else{
		$theme_base_uri = WP_CONTENT_URL ;
	}
	return $theme_base_uri;
}