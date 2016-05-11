<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Menu Walker class
 *
 * Used to generate the proper menu structure
 *
 **/
	
class Esense_MenuWalkerDotnav extends Walker {
	
	// tree types for the menu
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	// database fields map
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	var $number = 1;
	/**
	 *
	 * Function used to generate the start code of the submenu
	 *
	 * @param output - reference to the variable with the output
	 * @param depth - depth of the element
	 *
	 * @return null (use reference instead of returning values)
	 * 
	 **/
	function start_lvl(&$output, $depth = 0, $args = array()) {
		// generate the indent
		$indent = str_repeat("\t", $depth);
		// generate the opening tags
		$output .= "\n$indent<ul class=\"submenu\">\n";
	}

	/**
	 *
	 * Function used to generate the end code of the submenu
	 *
	 * @param output - reference to the variable with the output
	 * @param depth - depth of the element
	 *
	 * @return null (use reference instead of returning values)
	 * 
	 **/
	function end_lvl(&$output, $depth = 0, $args = array()) {
		// generate the indent
		$indent = str_repeat("\t", $depth);
		// generate the closing tag
		$output .= "$indent</ul>\n";
	}

	/**
	 *
	 * Function used to generate the start code of the menu element
	 *
	 * @param output - reference to the variable with the output
	 * @param item - the menu item to show
	 * @param depth - depth of the element
	 * @param args - additional arguments
	 *
	 * @return null (use reference instead of returning values)
	 * 
	 **/
	function start_el(&$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {
		// access to the WordPress query
		global $wp_query;
		global $esense_tpl;
		global $number;
		if (!$number) $number =1;
		
		// generate indent
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		// variables for the value and class names
		$class_names = $value = '';
		// generate the list of classes (if the predefined classes exists)
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		// add the menu item class with ID
		$classes[] = 'menu-item-' . $item->ID;
		// filter all classes and join it with spaces
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		// generate the attribute class with all classes
		$menutype = ! empty( $item->menutype )        ? esc_attr( $item->menutype) : 'standard';
		$class_names = ' class="' . esc_attr( $class_names );	
		//check if menu item have custom content
		$iscustomcontent = '';
		$image = ! empty( $item->image )        ?  esc_attr( $item->image        ) : '';
		$widget = ! empty( $item->widget )        ?  esc_attr( $item->widget        ) : '';
		$html = ! empty( $item->html )        ?  esc_attr( $item->html        ) : '';
		
		if ($image != '' || $html != '' || $widget != 'none') {
			$class_names .=' custom-content';
			$iscustomcontent = 'yes';
		}
		if ($depth ==0) $class_names .= ' root';
		if ($depth >0) $class_names .= ' childmenu';
		$class_names .= '"';
		// prepare the menu item ID
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		// generate the ID attribute
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		// add the indent to the LI element structure
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		// check the attributes for the A element which will be put inside the create LI element 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->custom )        ? ' rel="'    . esc_attr( $item->custom        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ! empty( $item->title ) ? ' data-tipcontent="'.$item->title.'"':'';
		$attributes .= ' data-mumber="'.$number.'"';
		// Has children
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		$icon= ! empty( $item->icon )        ? esc_attr( $item->icon        ) : '';
		
		// add to the output also the before element if exists
		$item_output = $args->before;
		// create the A element
		if ($iscustomcontent == '') {
		$item_output .= '<a class="esense-tipsy-l bigtips smooth-scroll" id="side_nav_item_id_'.$number.'"'. $attributes.'>';
		$item_output .= '<div class="navdot"></div>';
		// close the A element
		$item_output .='</a>';
		}
	// add the after element for the link
		$item_output .= $args->after;
		// generate the final output
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 *
	 * Function used to generate the end code of the menu element
	 *
	 * @param output - reference to the variable with the output
	 * @param item - menu item - here not used but required by API
	 * @param depth - depth of the element
	 *
	 * @return null (use reference instead of returning values)
	 * 
	 **/
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		// close the LI tag
		global $number;
		if($depth ==0) $number=$number+1;
		$output .= "</li>\n";
	}
}

// EOF