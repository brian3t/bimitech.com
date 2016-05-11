<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Code used to implement theme customizer
 *
 **/
function esense_init_customizer() {
	global $esense_tpl;
	global $wp_customize;
	
	// read the template styles
	$json_data = $esense_tpl->esense_get_json('config', 'styles');
	// iterate through all menus in the file
	foreach ($json_data as $styles) {
		// get option value
		$template_style = get_option($esense_tpl->name . '_template_style_'.($styles->family), '');
		// styles array
		$styles_array = array();
		// iterate through styles
		foreach($styles->styles as $style) {
			$styles_array[(string)$style->value] = (string)$style->name;
		}
		// create setting
		$wp_customize->add_setting( 
			$esense_tpl->name . '_template_style_'.($styles->family), 
			array(
		    	'default' => $template_style,
		    	'type'	=> 'option',
		    	'capability' => 'edit_theme_options',
				'priority' => 1 ,
			'sanitize_callback' => 'esc_attr'
			) 
		);
		// create control
		$wp_customize->add_control( 
			$esense_tpl->name . '_template_style_'.($styles->family), 
			array(
			    'label'   => $styles->family_desc,
			    'section' => 'colors',
			    'type'    => 'select',
			    'choices' => $styles_array,
				'priority' => 2
			) 
		);
	}	
	// creating the sections for other options
	$wp_customize->add_section( 
		$esense_tpl->name . '_responsive', 
		array(
	    	'title' => esc_attr__('Responsive Design Settings', 'dp-esense'),
		    'priority' => 37
		) 
	);
	
	$wp_customize->add_section( 
		$esense_tpl->name . '_dimensions', 
		array(
	    	'title' => esc_attr__('Dimensions', 'dp-esense'),
		    'priority' => 36
		) 
	);
	$wp_customize->add_section( 
		$esense_tpl->name . '_layout', 
		array(
	    	'title' => esc_attr__('Layout', 'dp-esense'),
		    'priority' => 35
		) 
	);
	// creating the necessary settings
	$wp_customize->add_setting( 
		$esense_tpl->name . '_sidebar_position', 
		array(
	    	'default' => 'right',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	
	$wp_customize->add_setting( 
		$esense_tpl->name . '_template_width', 
		array(
	    	'default' => '1230',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$esense_tpl->name . '_sidebar_width', 
		array(
	    	'default' => '22',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);

	$wp_customize->add_setting( 
		$esense_tpl->name . '_tablet_width', 
		array(
	    	'default' => '800',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$esense_tpl->name . '_small_tablet_width', 
		array(
	    	'default' => '820',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	
	$wp_customize->add_setting( 
		$esense_tpl->name . '_mobile_width', 
		array(
	    	'default' => '480',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr'
		) 
	);
	// adding necessary controls
	$wp_customize->add_control( 
		$esense_tpl->name . '_sidebar_position', 
		array(
		    'label'   => esc_attr__('Sidebar Position', 'dp-esense'),
		    'section' => $esense_tpl->name . '_layout',
		    'type'    => 'select',
		    'choices'    => array(
		        "left" => esc_attr__("Sidebar on the left", 'dp-esense'),
		        "right"=> esc_attr__("Sidebar on the right", 'dp-esense'),
		        "none" => esc_attr__("Sidebar disabled", 'dp-esense')
		    ),
			'priority' => 1
		) 
	);
	
	
	$wp_customize->add_control( 
		$esense_tpl->name . '_template_width', 
		array(
		    'label'   => esc_attr__('Theme width (px)', 'dp-esense'),
		    'section' => $esense_tpl->name . '_dimensions',
		    'type'    => 'text',
			'priority' => 2
		) 
	);
	
	$wp_customize->add_control( 
		$esense_tpl->name . '_sidebar_width', 
		array(
		    'label'   => esc_attr__('Sidebar % width', 'dp-esense'),
		    'section' => $esense_tpl->name . '_dimensions',
		    'type'    => 'text'
		) 
	);
	
	
	$wp_customize->add_control( 
		$esense_tpl->name . '_tablet_width', 
		array(
		    'label'   => esc_attr__('Tablet width (px)', 'dp-esense'),
		    'section' => $esense_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 3
		) 
	);
	
	$wp_customize->add_control( 
		$esense_tpl->name . '_small_tablet_width', 
		array(
		    'label'   => esc_attr__('Small Tablet width (px)', 'dp-esense'),
		    'section' => $esense_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 4
		) 
	);
	
	$wp_customize->add_control( 
		$esense_tpl->name . '_mobile_width', 
		array(
		    'label'   => esc_attr__('Mobile width (px)', 'dp-esense'),
		    'section' => $esense_tpl->name . '_responsive',
		    'type'    => 'text',
			'priority' => 5
		) 
	);
}

add_action('customize_register', 'esense_init_customizer');

// EOF