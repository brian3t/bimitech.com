<?php
/*
Plugin Name: DP Esense Functions
Plugin URI: http://www.dynamicpress.eu
Description: Plugin which adds custom functions (post types , shortcodes) used in Dynamicpress themes.
Version: 1.0
Text Domain: esense-functions
Domain Path: /languages
Author: Dynamicpress
Author URI: http://www.dynamicpress.eu/
License: GPL2
*/

/*

Copyright 2013-2015 Dynamicpress

this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/
$active_theme = wp_get_theme();

if ($active_theme->get( 'Name' ) == 'DP Esense' || $active_theme->get( 'Template' ) == 'esense-functions' ) {
	

add_action( 'plugins_loaded', 'esense_functions_load_textdomain' );
/**
 * Load plugin textdomain.
 */
function esense_functions_load_textdomain() {
  load_plugin_textdomain( 'esense-functions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
define( 'DPFUNCTIONS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'DPFUNCTIONS_DIR', trailingslashit(plugin_dir_path( __FILE__ ) ) );
class DP_Post_Types {}
require ('inc/theme.welcome.php');
require_once( 'inc/post_types/portfolio.php' );
require_once( 'inc/post_types/slide.php' );
require_once( 'inc/post_types/sidebar.php' );
require_once( 'inc/metaboxes/metaboxes_functions.php' );
require_once( 'inc/shortcodes/shortcodes.php' );
require_once( 'inc/font_icon_manager/dp_icon_manager.php' );
require_once( 'inc/less/dynamic.css.php' );
require_once( 'inc/theme_options/functions.php' );
require_once( 'inc/theme_options/options.importexport.php' );
require_once( 'inc/esense-demo-import.php' );
require_once( 'inc/widgets/widgets.php' );
include('inc/menu_importer.php');
require_once( 'inc/dp_addons.php' );

function esense_template_options() {
	// getting access to the template global object. 
	global $esense_tpl;
	
	// check permissions
	if (!current_user_can('manage_options')) {  
	    wp_die(esc_attr__('You don\'t have sufficient permissions to access this page!', 'esense-functions'));  
	} 
	  
	include_once(DPFUNCTIONS_DIR.'/inc/template.php');
}
// Initialising Visual Composer

	function esense_requireVcExtend(){
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		require_once(DPFUNCTIONS_DIR.'/inc/vc_extend/esense-extend-vc.php');
		vc_set_shortcodes_templates_dir( DPFUNCTIONS_DIR.'/inc/vc_extend/vc_templates' );
	}
	
	}
add_action('init', 'esense_requireVcExtend',2);
add_filter( 'woocommerce_locate_template', 'esense_add_woocommerce_templates', 1, 3 );
   function esense_add_woocommerce_templates( $template, $template_name, $template_path ) {
     global $woocommerce;
     $_template = $template;
     if ( ! $template_path ) 
        $template_path = $woocommerce->template_url;
 
     $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/inc/woocommerce/';
 
    // Look within passed path within the theme - this is priority
    $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
   );
 
   if( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;
 
   if ( ! $template )
    $template = $_template;

   return $template;
}
}
?>
