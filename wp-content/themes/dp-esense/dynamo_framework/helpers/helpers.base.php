<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Helper functions
 *
 * Group of additional helper functions used in the framework
 *
 **/
 
if(!function_exists('esense_str_replace_once')) { 
 	/**
 	 *
 	 * Function used to replace one occurence
 	 *
 	 * @param needle - string to replace
 	 * @param replace - string used to replacement
 	 * @param haystack - string where all will be replaced
 	 *
 	 * @return result of the replacement
 	 *
 	 **/
	function esense_str_replace_once($needle , $replace , $haystack){
	    // Looks for the first occurence of $needle in $haystack
	    // and replaces it with $replace.
	    $pos = strpos($haystack, $needle);
	    if ($pos === false) {
	        // Nothing found
	    	return $haystack;
	    }
	    //
	    return substr_replace($haystack, $replace, $pos, strlen($needle));
	}  
	
}

if(!function_exists('esense_get_current_page_url')) {
	/**
	 *
	 * Function used to get the current page URL
	 *
	 * @return current page URL
	 *
	 **/
	function esense_get_current_page_url() {
		// start with the HTTP
		$pageURL = 'http';
		// check for the HTTPS
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		// add rest of the protocol string 
		$pageURL .= "://";
		// check the server port to specify the URL structure - with the port or without
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		// return the result URL
		return preg_replace('@%[0-9A-Fa-f]{1,2}@mi', '', htmlspecialchars($pageURL, ENT_QUOTES, 'UTF-8'));
	}

}

//Adding custom CSS classes based on options setting
function esense_body_classes($classes) {
    global $esense_tpl, $post;
	if (!is_404() && isset($post->ID)) {
  	$params = get_post_custom($post->ID);
	}
	$params_customcssclass = isset($params['esense-post-params-customcssclass']) ? esc_attr( $params['esense-post-params-customcssclass'][0] ) : 'Y';
    $classes[] = get_option($esense_tpl->name . '_page_wrap_state').' '.$params_customcssclass;
    
    return array_unique($classes);
};
add_filter('body_class','esense_body_classes');

// Word limits function
function esense_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// Color manipalytion functions
function esense_hexToRGB($hex)
{   if ($hex =='transparent' || !$hex) 
	{$rgb ='';} else
	{$hex = str_replace("#", "", $hex);
        $color = array();

	if(strlen($hex) == 3)
	{
		$color['r'] = hexdec(str_repeat(substr($hex, 0, 1), 2));
		$color['g'] = hexdec(str_repeat(substr($hex, 1, 1), 2));
		$color['b'] = hexdec(str_repeat(substr($hex, 2, 1), 2));
	}
	else if(strlen($hex) == 6)
	{
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	$rgb='rgb('.$color['r'].','.$color['g'].','.$color['b'].')';
	}
	return $rgb;
	
}
function esense_hexToRGBA($hex,$opacity)
{   if ($hex =='transparent' || !$hex) 
	{$rgba ='';} else
	{$hex = str_replace("#", "", $hex);
        $color = array();

	if(strlen($hex) == 3)
	{
		$color['r'] = hexdec(str_repeat(substr($hex, 0, 1), 2));
		$color['g'] = hexdec(str_repeat(substr($hex, 1, 1), 2));
		$color['b'] = hexdec(str_repeat(substr($hex, 2, 1), 2));
	}
	else if(strlen($hex) == 6)
	{
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	$rgba='rgba('.$color['r'].','.$color['g'].','.$color['b'].','.$opacity.')';
	}
	return $rgba;
	
}

function esense_hexToARGB($hex,$opacity)
{   if ($hex =='transparent' || !$hex) 
	{$argb ='#00000000';} else
	{$hex = str_replace("#", "", $hex);
	$opacity = $opacity*255;
	if ($opacity==0) {$opacity ='00';}  else
	{$opacity = dechex($opacity);}
	$argb='#'.$opacity.$hex;
	}
	return $argb;
	
}

function esense_get_related_projects($post_id, $num) {
    global $post;
	$query = new WP_Query();
    $args = '';
	$item_array = '';
    $item_cats = get_the_terms($post->ID, 'portfolios');
    if($item_cats):
    foreach($item_cats as $item_cat) {
        $item_array[] = $item_cat->term_id;
    }
    endif;
    $args = wp_parse_args($args, array(
        'showposts' => $num,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolios',
                'field' => 'id',
                'terms' => $item_array
            )
        )
    ));
    
    $query = new WP_Query($args);
    
    return $query;
}

function esense_have_related_projects($post_id) {
    global $post;
	$query = new WP_Query();
    $args = '';
	$item_array = '';
    $item_cats = get_the_terms($post->ID, 'portfolios');
    if($item_cats):
    foreach($item_cats as $item_cat) {
        $item_array[] = $item_cat->term_id;
    }
    endif;
    $args = wp_parse_args($args, array(
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolios',
                'field' => 'id',
                'terms' => $item_array
            )
        )
    ));
    
    $query = new WP_Query($args);
    if($query->have_posts()) { 
	return true;} else {  
	return false;
	}
}

function esense_get_popular_posts($num) {
    global $post;
	$query = new WP_Query();
    $args = '';

    $args = wp_parse_args($args, array(
        'showposts' => $num,
        'ignore_sticky_posts' => 0,
        'post_type' => 'post',
		'orderby' => 'comment_count',
		'order' => 'DESC'
    ));
    
    $query = new WP_Query($args);
    
    return $query;
}
function esense_get_recent_projects($num) {
    global $post;
	$query = new WP_Query();
    $args = '';

    $args = wp_parse_args($args, array(
        'showposts' => $num,
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
    ));
    
    $query = new WP_Query($args);
    
    return $query;
}
// EOF