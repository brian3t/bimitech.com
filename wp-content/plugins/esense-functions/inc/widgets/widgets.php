<?php
	
// disable direct access to the file	
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Add theme specific widgets
 *
 **/
// Including file with template widgets
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.comments.php');
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.tabs.php');
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.flickr.php');
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.recent_portfolio.php');
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.recent_posts.php');
require_once(DPFUNCTIONS_DIR.'/inc/widgets/widgets.newsflash.php');

	 	// register template built-in widgets
add_action('widgets_init', create_function('', 'return register_widget("DP_Comments_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("DP_Tabs_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("DP_Flickr_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("DP_Recent_Post_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("DP_Recent_Port_Widget");'));
add_action('widgets_init', create_function('', 'return register_widget("DP_NewsFlash_Widget");'));
// Including file with widget rules functions
function dp_widget_rules() {
	global $esense_tpl;
	if (get_option($esense_tpl->name . '_widget_rules_state') == 'Y') {
	require_once(DPFUNCTIONS_DIR.'/inc/widgets/widget_rules/widget-rules.php');
	}
}
add_action('init', 'dp_widget_rules');

/*EOF*/