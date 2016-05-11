<?php 	
	
// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Class of the menu field
 *
 **/
	
class Esense_FormInputMenu extends Esense_FormInput {
	/**
	 *
	 * Function used to override the getValue function
	 *
	 * @param default - default value - not used here
	 *
	 * @return null
	 *
	 **/
	
	public function getValue($default) {
		$this->value = '';
	}
	
	/**
	 *
	 * Function used to generate output of the field
	 *
	 * @return HTML output of the field
	 *
	 **/
	
	public function output() {
		// load and parse XML file.
		$json_data = $this->tpl->esense_get_json('config', 'menus');
		//
		$output = '';
		// prepare parser object
		$parser = new Esense_WPFormParser($this->tpl);
		// iterate through all menus in the file
		foreach ($json_data as $menu) {			
			$temp_json = '[
				{
					"groupname": "'.($menu->name).'",
					"groupdesc": "'.($menu->description).'",
					"fields": [
						{
							"name": "navigation_menu_state_'.($menu->location).'",
							"type": "Select",
							"label": "'.esc_attr__('Enable', 'dp-esense').' '.($menu->name).'",
							"tooltip": "'.esc_attr__('You can enable or disable showing the menu in the template.', 'dp-esense').'",
							"default": "Y",
							"other": {
								"options": {
									"Y": "'.esc_attr__('Enabled', 'dp-esense').'",
									"N": "'.esc_attr__('Disabled', 'dp-esense').'",
									"rule": "'.esc_attr__('Conditional rule', 'dp-esense').'"
								}
							}
						},
						{
							"name": "navigation_menu_staterule_'.($menu->location).'",
							"type": "Text",
							"label": "'.esc_attr__('Conditional rule', 'dp-esense').'",
							"tooltip": "'.esc_attr__('You can enable showing the menu in the specific pages.', 'dp-esense').'",
							"default": "",
							"class": "",
							"visibility": "navigation_menu_state_'.($menu->location).'=rule"
						},
						{
							"name": "navigation_menu_depth_'.($menu->location).'",
							"type": "Select",
							"label": "'.esc_attr__('Depth of ', 'dp-esense').' '.($menu->name).'",
							"tooltip": "'.esc_attr__('You can specify the menu depth.', 'dp-esense').'",
							"default": "0",
							"other": {
								"options": {
									"0": "'.esc_attr__('All levels', 'dp-esense').'",
									"1": "1",
									"2": "2",
									"3": "3",
									"4": "4",
									"5": "5"
								}
							}
						}
					]
				}
			]';	
			// parse the generated JSON
			$output .= $parser->esense_generateForm($temp_json, true);
		}
		
		return $output;
	}
}

// EOF