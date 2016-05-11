<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Esense_WP admin panel & page features
 *
 * Functions used to create EsenseWP-specific functions 
 *
 **/



/**
 *
 * Code to create custom metaboxes with post additional features (description, keywords, title params)
 *
 **/



// Add the Meta Box
function esense_add_og_meta_box() {
    add_meta_box(
		'esense_og_meta_box',
		'Open Graph metatags',
		'esense_show_og_meta_box',
		'post',
		'normal',
		'high'
	);
	
	add_meta_box(
		'esense_og_meta_box',
		'Open Graph metatags',
		'esense_show_og_meta_box',
		'page',
		'normal',
		'high'
	);
}
// check if the Open Graph is enabled
if(get_option($esense_tpl->name . '_opengraph_use_opengraph') == 'Y') {
    add_action('add_meta_boxes', 'esense_add_og_meta_box');
}


// The Callback
function esense_show_og_meta_box() {
	global $esense_tpl, $post;
	// load custom meta fields
	$custom_meta_fields = $esense_tpl->esense_get_json('config', 'opengraph');
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field->id, true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field->id.'">'.$field->label.'</label></th>
				<td>';
				switch($field->type) {
					// case items will go here
					// text
					case 'text':
						echo '<input type="text" name="'.$field->id.'" id="'.$field->id.'" value="'.$meta.'" size="30" />
							<br /><span class="description">'.$field->desc.'</span>';
					break;
					
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field->id.'" id="'.$field->id.'" cols="60" rows="4">'.$meta.'</textarea>
							<br /><span class="description">'.$field->desc.'</span>';
					break;
					
					// image
					case 'image':
						$image = 'none';   
    			            if (get_option($esense_tpl->name . '_og_default_image', '') != '')  {  
    			              $image = get_option($esense_tpl->name . '_og_default_image');   
    			            }  
						echo '<span class="esense_opengraph_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { 
							$image = wp_get_attachment_image_src($meta, 'medium');	
							$image = $image[0];
						}
						echo	'<input name="'.$field->id.'" type="hidden" class="esense_opengraph_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" class="esense_opengraph_preview_image" alt="" /><br />
										<input class="esense_opengraph_upload_image_button button" type="button" value="Choose Image" />
										<small><a href="#" class="esense_opengraph_clear_image">Remove Image</a></small>
										<br clear="all" /><span class="description">'.$field->desc.'';
					break;
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}
 
// Save the Data
function esense_save_custom_meta($post_id) {
    global $esense_tpl;
    
    if(isset($post_id)) {
		// load custom meta fields
		$custom_meta_fields = $esense_tpl->esense_get_json('config', 'opengraph');
		// verify nonce
		if (isset($_POST['custom_meta_box_nonce']) && !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
			return $post_id;
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}
	
		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			$old = get_post_meta($post_id, $field->id, true);
			
			if(isset($_POST[$field->id])) {
				$new = $_POST[$field->id];
				if ($new && $new != $old) {
					update_post_meta($post_id, $field->id, $new);
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $field->id, $old);
				}
			}
		} // end foreach
	}
}

add_action('save_post', 'esense_save_custom_meta');  

// Add the Meta Box for Twitter cards
function esense_add_twitter_meta_box() {
    add_meta_box(
                'esense_twitter_meta_box',
                'Twitter Cards metatags',
                'esense_show_twitter_meta_box',
                'post',
                'normal',
                'high'
        );
        
        add_meta_box(
                'esense_twitter_meta_box',
                'Twitter Cards metatags',
                'esense_show_twitter_meta_box',
                'page',
                'normal',
                'high'
        );
}


if(get_option($esense_tpl->name . '_twitter_cards') == 'Y') {
        add_action('add_meta_boxes', 'esense_add_twitter_meta_box');
}


// The Callback for Twiter metabox
function esense_show_twitter_meta_box() {
        global $esense_tpl, $post;
        // load custom meta fields
        $custom_meta_fields = $esense_tpl->esense_get_json('config', 'twitter');
        // Use nonce for verification
        echo '<input type="hidden" name="custom_meta_box_nonce2" value="'.wp_create_nonce(basename(__FILE__)).'" />';
        // Begin the field table and loop
        echo '<table class="form-table">';
        foreach ($custom_meta_fields as $field) {
                // get value of this field if it exists for this post
                $meta = get_post_meta($post->ID, $field->id, true);
                
                // begin a table row with
                echo '<tr>
                                <th><label for="'.$field->id.'">'.$field->label.'</label></th>
                                <td>';
                                switch($field->type) {
                                        // case items will go here
                                        // text
                                        case 'text':
                                                echo '<input type="text" name="'.$field->id.'" id="'.$field->id.'" value="'.$meta.'" size="30" />
                                                        <br /><span class="description">'.$field->desc.'</span>';
                                        break;
                                        
                                        // textarea
                                        case 'textarea':
                                                echo '<textarea name="'.$field->id.'" id="'.$field->id.'" cols="60" rows="4">'.$meta.'</textarea>
                                                        <br /><span class="description">'.$field->desc.'</span>';
                                        break;
                                        
                                        // image
                                        case 'image':
                                                $image = 'none';
                                                if (get_option($esense_tpl->name . '_og_default_image', '') != '')  {
                                                        $image = get_option($esense_tpl->name . '_og_default_image'); 
                                                
                                                echo '<span class="esense_opengraph_default_image" style="display:none">'.$image.'</span>';
												}
                                                if ($meta) { 
                                                        $image = wp_get_attachment_image_src($meta, 'medium');        
                                                        $image = $image[0];
                                                }
                                                echo        '<input name="'.$field->id.'" type="hidden" class="esense_opengraph_upload_image" value="'.$meta.'" />
                                                                        <img src="'.$image.'" class="esense_opengraph_preview_image" alt="" /><br />
                                                                                <input class="esense_opengraph_upload_image_button button" type="button" value="Choose Image" />
                                                                                <small><a href="#" class="esense_opengraph_clear_image">Remove Image</a></small>
                                                                                <br clear="all" /><span class="description">'.$field->desc.'';
                                        break;
                                } //end switch
                echo '</td></tr>';
        } // end foreach
        echo '</table>'; // end table
}


function esense_save_custom__twitter_meta($post_id) {
    global $esense_tpl;
    
    if(isset($post_id)) {
                // load custom meta fields
                $custom_meta_fields = $esense_tpl->esense_get_json('config', 'twitter');
                // verify nonce
                if (isset($_POST['custom_meta_box_nonce']) && !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
                        return $post_id;
                // check autosave
                if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                        return $post_id;
                // check permissions
                if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
                        if (!current_user_can('edit_page', $post_id))
                                return $post_id;
                        } elseif (!current_user_can('edit_post', $post_id)) {
                                return $post_id;
                }
        
                // loop through fields and save the data
                foreach ($custom_meta_fields as $field) {
                        $old = get_post_meta($post_id, $field->id, true);
                        
                        if(isset($_POST[$field->id])) {
                                $new = $_POST[$field->id];
                                if ($new && $new != $old) {
                                        update_post_meta($post_id, $field->id, $new);
                                } elseif ('' == $new && $old) {
                                        delete_post_meta($post_id, $field->id, $old);
                                }
                        }
                } // end foreach
        }
}


add_action('save_post', 'esense_save_custom__twitter_meta');


/**
 *
 * Code used to implement the OpenSearch
 *
 **/

// function used to put in the page header the link to the opensearch XML description file
function esense_opensearch_head() {
	echo '<link href="'. esc_url( home_url('/')) .'/?opensearch_description=1" title="'.get_bloginfo('name').'" rel="search" type="application/opensearchdescription+xml" />';
}

// function used to add the opensearch_description variable
function esense_opensearch_query_vars($vars) {
	$vars[] = 'opensearch_description';
	return $vars;
}

// function used to generate the openserch XML description output 
function esense_opensearch() {
	// access to the wp_query variable
	global $wp_query,$esense_tpl;
	// check if there was an variable opensearch_description in the query vars
	if (!empty($wp_query->query_vars['opensearch_description']) ) {
		// if yes - return the XML with OpenSearch description
		header('Content-Type: text/xml');
		// the XML content
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		echo "<OpenSearchDescription xmlns=\"http://a9.com/-/spec/opensearch/1.1/\">\n";
		echo "\t<ShortName>".get_bloginfo('name')."</ShortName>\n";
		echo "\t<LongName>".get_bloginfo('name')."</LongName>\n";
		echo "\t<Description>".get_bloginfo('name')."</Description>\n";
		echo "\t<Contact>".get_bloginfo('admin_email')."</Contact>\n";
		echo "\t<Url type=\"text/html\" template=\"". esc_url( home_url('/')) ."/?s={searchTerms}\"/>\n";
		echo "\t<Url type=\"application/atom+xml\" template=\"". esc_url( home_url('/')) ."/?feed=atom&amp;s={searchTerms}\"/>\n";
		echo "\t<Url type=\"application/rss+xml\" template=\"". esc_url( home_url('/')) ."/?feed=rss2&amp;s={searchTerms}\"/>\n";
		echo "\t<Language>".get_bloginfo('language')."</Language>\n";
		echo "\t<OutputEncoding>".get_bloginfo('charset')."</OutputEncoding>\n";
		echo "\t<InputEncoding>".get_bloginfo('charset')."</InputEncoding>\n";
		echo "</OpenSearchDescription>";
		exit;
	}
	// if not just end the function
	return;
}

// add necessary actions and filters if OpenSearch is enabled
if(get_option($esense_tpl->name . "_opensearch_use_opensearch", "Y") == "Y") {
	add_action('wp_head', 'esense_opensearch_head');
	add_action('template_redirect', 'esense_opensearch');
	add_filter('query_vars', 'esense_opensearch_query_vars');
}

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'esense_post_is_in_descendant_category' ) ) {
        function esense_post_is_in_descendant_category( $cats, $_post = null ) {
                foreach ( (array) $cats as $cat ) {
                        // get_term_children() accepts integer ID only
                        $descendants = get_term_children( (int) $cat, 'category' );
                        if ( $descendants && in_category( $descendants, $_post ) )
                                return true;
                }
                return false;
        }
}


/**
 *
 * Code used to implement parsing shortcodes and emoticons in the text widgets
 *
 **/

if(get_option($esense_tpl->name . "_shortcodes_widget_state", "Y") == "Y") {
	add_filter('widget_text', 'do_shortcode');
}
	
if(get_option($esense_tpl->name . "_emoticons_widget_state", "Y") == "Y") {
	add_filter('widget_text', 'convert_smilies');
}
function esense_get_font_manager()
			{
				$fonts = get_option('dp_font_icons');
				$output = '<p><div class="preview-icon"><i class=""></i></div><input class="search-icon" type="text" placeholder="'.esc_html_e("Search for a suitable icon..",'dp-esense').'" /></p>';
				$output .= '<div id="smile_icon_search">';
				$output .= '<ul class="icons-list smile_icon">';
				foreach($fonts as $font => $info)
				{
					$icon_set = array();
					$icons = array();
					$upload_dir = wp_upload_dir();
					$path		= trailingslashit($upload_dir['basedir']);
					$file = $path.$info['include'].'/'.$info['config'];
					include($file);
					if(!empty($icons))
					{
						$icon_set = array_merge($icon_set,$icons);
					}
					$set_name = ucfirst($font);
					if(!empty($icon_set))
					{
						$output .= '<p><strong>'.$set_name.'</strong></p>';
						foreach($icon_set as $icons)
						{
							foreach($icons as $icon)
							{
								$output .= '<li title="'.$icon['class'].'" data-icon="'.$font.'-'.$icon['class'].'" data-icon-tag="'.$icon['tags'].'">';
								$output .= '<i class="icon '.$font.'-'.$icon['class'].'"></i><label class="icon">'.$icon['class'].'</label></li>';
							}
						}
					}
				}
				$output .'</ul>';
				$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
							
				jQuery(".search-icon").keyup(function(){
				
				// Retrieve the input field text and reset the count to zero
				var filter = jQuery(this).val(), count = 0;
				
				// Loop through the icon list
				jQuery(".icons-list li").each(function(){
				
				// If the list item does not contain the text phrase fade it out
				if (jQuery(this).attr("data-icon-tag").search(new RegExp(filter, "i")) < 0) {
				jQuery(this).fadeOut();
				} else {
				jQuery(this).show();
				count++;
				}
				});
				});
				});
				
				</script>';
				$output .= '</div>';
				return $output;
			}
			
function esense_add_page_custom_css()
{
global $post;
$output='';
$params = get_post_custom();
$text_color =  isset( $params['esense-post-params-subheader_txtcolor'] ) ? esc_attr( $params['esense-post-params-subheader_txtcolor'][0] ) : '';
$bg_color =  isset( $params['esense-post-params-subheader_bgcolor'] ) ? esc_attr( $params['esense-post-params-subheader_bgcolor'][0] ) : '';
if (is_page()) $prefix = '.page-id-'.get_the_ID();
if (is_single()) $prefix = '.postid-'.get_the_ID();
if ($text_color != '' || $bg_color != '') {
$output = "<style>";
if ($text_color != '') { 
$output .= $prefix." .esense-subheader .main-title, ".$prefix." .esense-subheader .sub-title, ".$prefix." .esense-subheader .esense-breadcrumbs a,.esense-subheader .esense-breadcrumbs span { color : ".$text_color." !important; }";
}
if ($bg_color != '') { 
$output .= $prefix." .esense-subheader-wraper {background-color : ".$bg_color." !important; }";
}
$output .= "</style>";
}
print ($output);}
add_action('wp_head','esense_add_page_custom_css');
// 


// Portfolio specific functions
function esense_get_first_embed_shortcode($content) {
    preg_match('/\[embed(.*)](.*)\[\/embed]/', $content, $matches);
	if ($matches)     {
		return $matches[0];} else {
	return ''; }
	
}
	
	// EOF