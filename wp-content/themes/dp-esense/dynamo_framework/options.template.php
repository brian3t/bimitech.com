<?php

/**
 *
 * Function used to load template options page JS code
 *
 * @return null
 * 
 **/
 
function esense_template_options_js() {
	// variable used for the page detection
	global $pagenow,$esense_tpl;
	if($pagenow == 'admin.php' && isset($_GET['page']) && ($_GET['page'] == 'template_options' || $_GET['page'] == 'esense-menu')) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('esense-tips-js', get_template_directory_uri() . '/js/back-end/libraries/miniTip/miniTip.min.js', array('jquery'));
		wp_enqueue_script('esense-upload', get_template_directory_uri() . '/js/back-end/template.options.js', array('jquery','media-upload','thickbox', 'esense-tips-js'));
		wp_enqueue_script('esense-tips-js', get_template_directory_uri() . '/js/back-end/libraries/miniTip/miniTip.min.js', array('jquery'));
        wp_enqueue_script('esense-upload', get_template_directory_uri() . '/js/back-end/template.options.js', array('jquery','media-upload','thickbox', 'gk-tips-js'));
		wp_enqueue_script('esense-jquery-ui-js', get_template_directory_uri() . '/js/back-end/libraries/jQueryUI/jquery-ui.js', array('jquery'));
		wp_enqueue_style('esense-jquery-ui-css', get_template_directory_uri() . '/js/back-end/libraries/jQueryUI/jquery-ui.css');

		// register and load external components scripts
		$tabs = $esense_tpl->esense_get_json('options','tabs');
		// iterate through tabs
		foreach($tabs as $tab) {
			if($tab[2] == 'enabled') {
				// load file
				$loaded_data = $esense_tpl->esense_get_json('options', $tab[1]);	
				// check the loaded JSON data
				if($loaded_data != null && count($loaded_data != 0)) {
					$standard_fields = array('Text', 'Select', 'RawText', 'Switcher', 'Textarea', 'Media', 'WidthHeight', 'Menu', 'TextBlock', 'Color', 'Background', 'Taxonomy', 'HTML', 'Slider', 'Save');
					// iterate through groups
					foreach($loaded_data as $group) {
						// 
						foreach($group->fields as $field) {
							if(!in_array($field->type, $standard_fields)) {
								// load field config
								$file_config = $esense_tpl->esense_get_json('form_elements/'.$field->type, 'config', false);
								// check if the file is correct
								if((is_array($file_config) && count($file_config) > 0) || is_object($file_config)) {
									// load the JS file
									if($file_config->js != '') {
										wp_enqueue_script('esense_'.strtolower($file_config->name).'.js', get_template_directory_uri() . '/dynamo_framework/form_elements/'.($field->type).'/'.($file_config->js));
									}
								}
							}
						}
					}
				}
			}
		}	
	}
}

/**
 *
 * Function used to load template options CSS code
 *
 * @return null
 * 
 **/
 
function esense_template_options_css() {
	// variable used for the page detection
	global $pagenow;
	// template object
	global $esense_tpl;
	// check the page
	if($pagenow == 'admin.php' && isset($_GET['page']) && ($_GET['page'] == 'template_options' || $_GET['page'] == 'esense-menu')) {
		wp_enqueue_style('esense-thickbox');
		wp_enqueue_style('esense-tips-css', get_template_directory_uri() . '/js/back-end/libraries/miniTip/miniTip.css');
        wp_enqueue_style('esense-template-css', get_template_directory_uri() . '/css/back-end/template.css');
		// register and load external components scripts
		$tabs = $esense_tpl->esense_get_json('options','tabs');
		// iterate through tabs
		foreach($tabs as $tab) {
			if($tab[2] == 'enabled') {
				// load file
				$loaded_data = $esense_tpl->esense_get_json('options', $tab[1]);	
				// check the loaded JSON data
				if($loaded_data != null && count($loaded_data != 0)) {
					$standard_fields = array('Text', 'Select', 'RawText', 'Switcher', 'Textarea', 'Media', 'WidthHeight','Menu', 'TextBlock', 'Color', 'Background', 'Taxonomy', 'HTML', 'Slider', 'Save');
					// iterate through groups
					foreach($loaded_data as $group) {
						// 
						foreach($group->fields as $field) {
							if(!in_array($field->type, $standard_fields)) {
								// load field config
								$file_config = $esense_tpl->esense_get_json('form_elements/'.$field->type, 'config', false);
								// check if the file is correct
								if((is_array($file_config) && count($file_config) > 0) || is_object($file_config)) {
									// load the CSS file
									if($file_config->css != '') {
										wp_enqueue_style('esense_'.strtolower($file_config->name).'.css', get_template_directory_uri() . '/dynamo_framework/form_elements/'.($field->type).'/'.($file_config->css));
									}
								}
							}
						}
					}
				}
			}
		}	
	}
}

/**
 *
 * Function used define template JS callback for saving options
 *
 * @return null
 * 
 **/

function esense_template_save_js() {
	$ajax_nonce = wp_create_nonce('Esense_WPNonce');
	echo '<script type="text/javascript">$esense_ajax_nonce = "'.$ajax_nonce.'";</script>';
}

/**
 *
 * Function to create callback for template save ajax request
 *
 * @return null
 *
 **/

function esense_template_save_callback() {
	// getting access to the template global object. 
	global $esense_tpl;
	
	// check user capability to made operation
	if ( current_user_can( 'manage_options' ) ) {
	 	// check security with nonce.
 		//if ( function_exists( 'check_ajax_referer' ) ) { 
 			//check_ajax_referer( 'Esense_WPNonce', 'security' ); 
 		//}
 		// save the settings - iterate throught all $_POST variables
 		foreach($_POST as $key => $value) {
 			if(strpos($key, $esense_tpl->name . '_') !== false) {
 				update_option($key, esc_attr($value)); 
 			}
			}
		CompileOptionsLess('options.less');
			// return the results
			esc_attr__('Settings saved', 'dp-esense');
 		// this is required to return a proper result 
 		die();   
	} else {
		wp_die(esc_attr__('You don\'t have sufficient permissions to access this page!', 'dp-esense')); 
	}
}
	
// adding template save callback
add_action( 'wp_ajax_template_save', 'esense_template_save_callback' );

// EOF