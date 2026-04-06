<?php
/*
Plugin Name: Allow HTML in Category Descriptions
Version: 1.2.5
Plugin URI: http://wordpress.org/extend/plugins/allow-html-in-category-descriptions/
Description: Allows you to add HTML code in category descriptions
Author: Arno Esterhuizen & Timmmy
Author URI: https://profiles.wordpress.org/timherinckx/
Text Domain: allow-html-in-category-descriptions
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('init','disable_kses_if_allowed');

function disable_kses_if_allowed() {
	if (current_user_can('unfiltered_html')) {
		// Disables Kses only for textarea saves
		foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
			remove_filter($filter, 'wp_filter_kses');
		}

		// Disables Kses only for textarea admin displays
		foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
		remove_filter($filter, 'wp_kses_data');
		}
	}

}

//Additional links on the plugin page
add_filter('plugin_row_meta', 'RegisterPluginLinks', 10, 2);

function RegisterPluginLinks ($links, $file) {
	if ($file == plugin_basename(__FILE__)) {
		$links[] = '<a href="http://wordpress.org/support/plugin/allow-html-in-category-descriptions">Support</a>';
	}
	return $links;
}	
