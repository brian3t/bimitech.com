<?php
/**
 *
 * Main functions
 *
 * Functions used to creacte dashboard menus.
 *
 **/

// load file with Template Options page
require_once (get_template_directory() . '/dynamo_framework/options.template.php');
/**
 *
 * Function to add menu items in the admin panel
 *
 **/

if(!function_exists('esense_admin_menu')) {
	
	function esense_admin_menu() {		
		
		// getting access to the template global object. 
		global $esense_tpl;
		// set the default icon path
		$icon_path = get_template_directory_uri().'/images/back-end/small_logo.png';
		// check if user set his own icon and then replace the default path
		if(get_option($esense_tpl->name . "_branding_admin_page_image") != '') {
			$icon_path = get_option($esense_tpl->name . "_branding_admin_page_image");
		}
		// creating main menu item for the template settings
		if (get_option($esense_tpl->name . "_branding_admin_page_template_name") !='') $templatename = get_option($esense_tpl->name . "_branding_admin_page_template_name");
		else $templatename = $esense_tpl->config['template']->name;
		add_menu_page( 'Esense_WP Framework', $templatename, 'manage_options', 'esense-menu', 'esense_template_options', $icon_path,'53'); 
		// checking if showing template options is enabled
		if($esense_tpl->config['developer_config']->visibility->template_options == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'esense-menu', 
				$esense_tpl->config['template']->name, 
				esc_attr__('Template options', 'esense-functions'), 
				'manage_options', 
				'esense-menu',
				'esense_template_options' );
			// save callback
			add_action( "admin_head-" . $plugin_page, 'esense_template_save_js' );
			// adding scripts and stylesheets
			add_action('admin_enqueue_scripts', 'esense_template_options_js');
			esense_template_options_css(); 
		}
		
		// checking if showing import/export options is enabled
		if($esense_tpl->config['developer_config']->visibility->importexport == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'esense-menu', 
				$esense_tpl->config['template']->name, 
				esc_attr__('Import/Export', 'esense-functions'), 
				'manage_options', 
				'importexport_options',
				'esense_importexport_options' );
		}
	}
}

	 	add_action( 'admin_menu', 'esense_admin_menu' );

// EOF