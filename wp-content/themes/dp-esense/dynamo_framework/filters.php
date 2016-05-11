<?php
// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Function used to add the Google Profile URL in the user profile
 *
 * @param methods - array of the contact methods
 *
 * @return the updated arra of the contact methods
 *
 **/

function esense_google_profile( $methods ) {
  // Add the Google Profile URL field
  $methods['google_profile'] = esc_attr__('Google Profile URL', 'dp-esense');
  // return the updated contact methods
  return $methods;
}

add_filter( 'user_contactmethods', 'esense_google_profile', 10, 1);

/**
 *
 * Function used for disable widget titles if the first character is "#"
 *
 *
 **/
add_filter( 'widget_title', 'esense_remove_widget_title' );
function esense_remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '#' )
		return;
	else 
		return ( $widget_title );
}



/**
 *
 * Function used in the attachment page image links
 *
 * @return the additional class in the links
 *
 **/


function esense_img_link_class( $link )
{
    $class = 'next_image_link' === current_filter() ? 'next' : 'prev';


    return str_replace( '<a ', '<a class="btn-nav nav-'.$class.'"', $link );
}


add_filter( 'previous_image_link', 'esense_img_link_class' );
add_filter( 'next_image_link',     'esense_img_link_class' );

/**
 *
 * Function used to add target="_blank" in the comments links
 *
 * @return comment code
 *
 **/


if(get_option($esense_tpl->name . '_comments_autoblank', 'Y') == 'Y') {
	function esense_comments_autoblank($text) {
		$return = str_replace('<a', '<a target="_blank"', $text);
		return $return;
	}


	add_filter('comment_text', 'esense_comments_autoblank');
}


/**
 *
 * Code used to disable autolinking in comments
 *
 **/
 
if(get_option($esense_tpl->name . '_comments_autolinking', 'Y') == 'N') {
	remove_filter('comment_text', 'make_clickable', 9);
}

// EOF