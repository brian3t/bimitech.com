<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Main functions
 *

/**
 *
 * Function to add widgets areas
 *
 * This function loads widgets areas based on widgets.json file
 *
 **/

if(!function_exists('esense_widgets_init')) {
	
	function esense_widgets_init() {
		// getting access to the template global object. 
		global $esense_tpl;
		// load and parse template JSON file.
		$json_data = $esense_tpl->esense_get_json('config','widgets');
		// init the widgets array
		$esense_tpl->widgets = array();
		// iterate through all widget areas in the file
		foreach ($json_data as $widget_area) {
			// set the widgets amount
			if(isset($widget_area->amount)) {
				$esense_tpl->widgets[(string) $widget_area->id] = (int) $widget_area->amount;
			}
			// register sidebar
			register_sidebar(
				array(
					'name' 			=> (string) $widget_area->name,
					'id' 			=> (string) $widget_area->id,
					'description'   => (string) $widget_area->description,
					'before_widget' => $widget_area->before_widget,
					'after_widget' 	=> $widget_area->after_widget,
					'before_title' 	=> $widget_area->before_title,
					'after_title' 	=> $widget_area->after_title
				)
			);
		}
	}
	
}

if(!function_exists('esense_PostContent')) {
	function esense_PostContent() {
		$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', get_the_content()));
		return $content;
	}
}
if(!function_exists('esense_PostExcerpt')) {
	function esense_PostExcerpt() {
		$content = apply_filters( 'the_excerpt', get_the_excerpt() );
		return $content;
	}
}
if(!function_exists('esense_PostExcerptbyID')) {
function esense_PostExcerptbyID($post_id, $excerpt_length = 35, $line_breaks = TRUE){
$the_post = get_post($post_id); //Gets post ID
$the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content; //Gets post_excerpt or post_content to be used as a basis for the excerpt
$the_excerpt = apply_filters('the_excerpt', $the_excerpt);
$the_excerpt = $line_breaks ? strip_tags(strip_shortcodes($the_excerpt), '<p><br>') : strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
$words = explode(' ', $the_excerpt, $excerpt_length + 1);
if(count($words) > $excerpt_length) :
  array_pop($words);
  array_push($words, '&hellip;');
  $the_excerpt = implode(' ', $words);
  $the_excerpt = $line_breaks ? $the_excerpt . '</p>' : $the_excerpt;
endif;
$the_excerpt = trim($the_excerpt);
return $the_excerpt;
}
}

if(!function_exists('esense_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in qode_set_blog_word_count function
	 */
	function esense_excerpt() {
		global $esense_tpl, $post;
		$word_count = get_option($esense_tpl->name . '_excerpt_len','55');
		if($word_count != '0') {
			$post_excerpt = strip_shortcodes($post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content));
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
			
			$excerpt_word_array = explode (' ', $clean_excerpt);
			$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
			$excerpt = implode (' ', $excerpt_word_array).'...';
			
			//is excerpt different than empty string?
			if($excerpt !== '') {
				echo '<p class="post_excerpt">'.wp_kses_post($excerpt).'</p><p><a class="readon" href="'.esc_url(get_permalink()).'"><span>'.__( 'read more', 'dp-esense' ).'</span></a></p>';
			}
		}
	}
}
if(!function_exists('esense_excerpt_without_readmore')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in qode_set_blog_word_count function
	 */
	function esense_excerpt_without_readmore() {
		global $esense_tpl, $post;
		$word_count = get_option($esense_tpl->name . '_excerpt_len','55');
		if($word_count != '0') {
			$post_excerpt = strip_shortcodes($post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content));
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
			
			$excerpt_word_array = explode (' ', $clean_excerpt);
			$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
			$excerpt = implode (' ', $excerpt_word_array).'...';
			echo esc_html($excerpt);
		}
	}
}

if(!function_exists('esense_is_event_page')) {
	/**
	 * Function that detect if curent page is Event Calendar page
	 * variable $word_count, which is defined in qode_set_blog_word_count function
	 */
	function esense_is_event_page() {
	$body_classes = get_body_class();
	if(in_array('post-type-archive-tribe_events', $body_classes) || in_array('single-tribe_events', $body_classes))
		{
    		 return true;
		} else {
		     return false;
		}
	}
}
// EOF