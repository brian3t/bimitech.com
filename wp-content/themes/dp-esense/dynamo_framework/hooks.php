<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Full hooks reference:
 * 
 * Hooks connected with the document:
 *
 * esense_wp_doctype
 * esense_wp_html_attributes
 * esense_wp_metatags
 * esense_wp_fonts
 * esense_wp_ie_scripts
 * esense_wp_head
 * esense_wp_body_attributes
 * esense_wp_footer
 * esense_wp_ga_code
 *
 * Hooks connected with the content:
 *
 * esense_wp_before_mainbody
 * esense_wp_after_mainbody
 * esense_wp_before_loop
 * esense_wp_after_loop
 * esense_wp_before_nav
 * esense_wp_after_nav
 * esense_wp_before_post_content
 * esense_wp_after_post_content
 * esense_wp_before_column
 * esense_wp_after_column
 *
 * Hooks connected with comments:
 * 
 * esense_wp_before_comments_count
 * esense_wp_after_comments_count
 * esense_wp_before_comments_list
 * esense_wp_after_comments_list
 * esense_wp_before_comment
 * esense_wp_after_comment
 * esense_wp_before_comments_form
 * esense_wp_after_comments_form
 *
 **/

/**
 *
 * Function used to generate the DOCTYPE of the document
 *
 **/

function esense_wp_doctype_hook() {
	// generate the HTML5 doctype
	echo '<!DOCTYPE html>' . "\n";
	
 	// YOUR HOOK CODE HERE
}

add_action('esense_wp_doctype', 'esense_wp_doctype_hook');

/**
 *
 * Function used to generate the DOCTYPE of the document
 *
 **/

function esense_wp_html_attributes_hook() {
	// generate the <html> language attributes
	global $esense_tpl;
	language_attributes();
	// generate the prefix attribute
	if(get_option($esense_tpl->name . '_opengraph_use_opengraph') == 'Y') {
                echo ' prefix="og: http://ogp.me/ns#"';
        }

	// generate the cache manifest attribute
	if(trim(get_option($esense_tpl->name . '_cache_manifest', '')) != '') {
		echo ' manifest="'.trim(get_option($esense_tpl->name . '_cache_manifest', '')).'"';
	}

 	// YOUR HOOK CODE HERE
}

add_action('esense_wp_html_attributes', 'esense_wp_html_attributes_hook');

/**
 *
 * Function used to generate the metatags in the <head> section
 *
 **/

function esense_wp_metatags_hook() {
	global $esense_tpl; 
	
	// only for IE
	if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge" />' . "\n"; 
	}
	echo '<meta charset="'.get_bloginfo('charset').'" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />' . "\n";
	
	// generates Dynamo Open Graph metatags
	esense_opengraph_metatags();
	// generates Twitter Cards metatags
    esense_twitter_metatags();
 	// YOUR HOOK CODE HERE
}

add_action('esense_wp_metatags', 'esense_wp_metatags_hook');


/**
 *
 * Function used to generate the code at the end of the <head> section
 * By default wp_head() should be called at the end od header section.
 * Sometimes, however, it is necessary to perform some action after the call wp_head (). 
 * For example, add custom css  overriding plugins css that have been not enqueued
 * Use this hook only when necessary 
 *
 **/
 
function esense_wp_plugin_css_override() {
		wp_enqueue_style('esense-plugins-css-override', get_template_directory_uri() . '/css/override-plugins.css'); 
}
add_action('wp_head', 'esense_wp_plugin_css_override', 6);

function esense_wp_responsive_css() { 
	global $esense_tpl;
	wp_enqueue_style('esense-desktop-small-css', get_template_directory_uri() . '/css/desktop.small.css','','','(max-width:'.get_option($esense_tpl->name . '_theme_width', '1230').'px)');
	wp_enqueue_style('esense-tablet-css', get_template_directory_uri() . '/css/tablet.css','','','(max-width:'.get_option($esense_tpl->name . '_tablet_width', '1030').'px)');
	wp_enqueue_style('esense-tablet-small-css', get_template_directory_uri() . '/css/tablet.small.css','','','(max-width:'.get_option($esense_tpl->name . '_small_tablet_width', '820').'px)');
	wp_enqueue_style('esense-mobile-css', get_template_directory_uri() . '/css/mobile.css','','','(max-width:'.get_option($esense_tpl->name . '_mobile_width', '580').'px)');
	}

add_action('wp_head', 'esense_wp_responsive_css', 5);

function esense_wp_dynamic_css() {
		$paths = wp_upload_dir();
		if(is_file($paths['basedir'].'/esense-dynamic.css')) {
		wp_enqueue_style('esense-dynamic-css', $paths['baseurl'].'/esense-dynamic.css');
		} else {
		wp_enqueue_style('esense-dynamic-css', get_template_directory_uri() . '/css/esense-initial-dynamic.css');
		}
}
add_action('wp_head', 'esense_wp_dynamic_css', 7);

/**
 *
 * Function used to generate the <body> element attributes
 *
 **/
 
function esense_wp_body_attributes_hook() {
 	global $esense_tpl, $post;
	if (!is_search() && !is_404()) $params = get_post_custom();
	$blogdatestyle = '';
	if ((is_page_template('template.latest_big_thumb.php') || is_page_template('template.latest_small_thumb.php') || is_page_template('template.latest_big_thumb_full.php') || is_page_template('template.latest_small_thumb_full.php') || is_singular('post') || is_tag() || is_archive() || is_category() || is_search()) && get_option($esense_tpl->name . '_postmeta_date_state','Y') == 'Y' && get_option($esense_tpl->name . '_postmeta_date_style','default') == 'big') $blogdatestyle = ' isbigdate'; 

	$params_subheadersize = isset($params['esense-post-params-subheadersize']) ? esc_attr( $params['esense-post-params-subheadersize'][0] ) : 'default';
	$params_menutype = isset($params['esense-post-params-menutype']) ? esc_attr( $params['esense-post-params-menutype'][0] ) : 'default';
	$params_headertype = isset($params['esense-post-params-headertype']) ? esc_attr( $params['esense-post-params-headertype'][0] ) : 'default';
	$params_headerstyle = isset($params['esense-post-params-headerstyle']) ? esc_attr( $params['esense-post-params-headerstyle'][0] ) : 'default';
	$params_subheader_use =  isset( $params['esense-post-params-subheader_use'] ) ? esc_attr( $params['esense-post-params-subheader_use'][0] ) : 'Y';
	$params_paspartusetting =  isset( $params['esense-post-params-paspartusetting'] ) ? esc_attr( $params['esense-post-params-paspartusetting'][0] ) : 'default';
	$params_paspartu_use =  isset( $params['esense-post-params-paspartu-use'] ) ? esc_attr( $params['esense-post-params-paspartu-use'][0] ) : 'N';
	$subheadersize = get_option($esense_tpl->name . "_subheader_size",'big');
 	$menutype = 'menu-type-'.get_option($esense_tpl->name . "_main_menu_type",'top');
	$logostate = '';
	if (get_option($esense_tpl->name . "_main_menu_type",'top') == 'aside' && get_option($esense_tpl->name . "_main_logo_aside_state",'Y') == 'N' ) $logostate = ' mainlogo-no';
	$asidemenustyle = '';
	if (get_option($esense_tpl->name . "_main_menu_type",'top') == 'aside' && get_option($esense_tpl->name . "_aside_menu_sliding",'Y') == 'N' ) $asidemenustyle = ' aside-menu-fixed';
	$headertype = get_option($esense_tpl->name . "_overlapping_header_state",'N');
	$headerstyle = get_option($esense_tpl->name . "_default_overlapping_style",'dark');
	$subheadersizestyle =' subheader-'.$subheadersize;
	if ($params_subheadersize != 'default') $subheadersizestyle =' subheader-'.$params_subheadersize;
	if ($params_subheader_use == 'N') $subheadersizestyle =' subheader-no';
	if ($params_menutype != 'default'){ $menutype = 'menu-type-'.$params_menutype;}
	$headerstyleclass = $headertypeclass = $stickyheaderclass = '';
	if (get_option($esense_tpl->name . '_sticky_header_state','N') == 'Y') {$stickyheaderclass = ' sticky_header_used';} else {$stickyheaderclass = ' sticky_header_noused';};
	if (($headertype == 'Y' || $params_headertype == 'Y') &&  $params_headertype != 'N') {
	$headertypeclass = ' header-overlapping';
	$headerstyleclass = $headerstyle;
	if ($params_headerstyle != 'default') $headerstyleclass = $params_headerstyle;
	$headerstyleclass = ' overlapping-'.$headerstyleclass; 
	}
	$paspartuclass="";
	if (get_option($esense_tpl->name . "_paspartu_state",'N') == 'Y' || ($params_paspartusetting == 'custom' && $params_paspartu_use == 'Y') ) $paspartuclass= ' paspartu-enabled';
	if ($params_paspartusetting == 'custom' && $params_paspartu_use == 'N') $paspartuclass= '';
	$addclass = $menutype.$logostate.$asidemenustyle.$stickyheaderclass.$headertypeclass.$headerstyleclass.$subheadersizestyle.$blogdatestyle.$paspartuclass;
 	// generate the standard body class
 	body_class($addclass);
 	// generate the tablet attribute
 	if($esense_tpl->browser->get("tablet") == true) {
 		echo ' data-tablet="true"';
 	}
 	// generate the mobile attribute
 	if($esense_tpl->browser->get("mobile") == true) {
 		echo ' data-mobile="true"';
 	} 
 	// generate the table-width attribute
 	echo ' data-tablet-width="'. get_option($esense_tpl->name . '_tablet_width', 800) .'"';
 	
 	// YOUR HOOK CODE HERE
}

add_action('esense_wp_body_attributes', 'esense_wp_body_attributes_hook');
 
/**
 *
 * Function used to generate the code before the closing <body> tag
 *
 **/

function esense_wp_footer_hook() {
	// YOUR HOOK CODE HERE
}
  
add_action('esense_wp_footer', 'esense_wp_footer_hook');

/**
 *
 * Function used to generate the Google Analytics before the closing <body> tag
 *
 **/

function esense_wp_ga_code_hook() {
	global $esense_tpl;
	// check if the Tracking ID is specified
	if(get_option($esense_tpl->name . '_ga_ua_id', '') != '') {
		?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo get_option($esense_tpl->name . '_ga_ua_id', ''); ?>']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		<?php
	}
}
  
add_action('esense_wp_ga_code', 'esense_wp_ga_code_hook');

add_action( 'wp', 'esense_check_category' );
function esense_check_category() {
    if ( is_category() )
        add_action( 'wp_enqueue_scripts', 'esense_add_flex' );
}

function esense_add_flex() {
	wp_enqueue_script( 'esense-flexslider-js' );
}

function esense_extra_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>
<tr class="form-field">
<th scope="row" valign="top"><label for="slideshow"><?php esc_attr__('Display slideshow?', 'dp-esense'); ?></label></th>
<td>
<select id="Cat_meta[slideshow]" name="Cat_meta[slideshow]">
					<option value="yes"<?php echo ($cat_meta['slideshow']=='yes') ? ' selected="selected"' : ''; ?>>
						<?php esc_attr__('Yes', 'dp-esense'); ?>
					</option>
					<option value="no"<?php echo ($cat_meta['slideshow']=='no') ? ' selected="selected"' : ''; ?>>
						<?php esc_attr__('No', 'dp-esense'); ?>
					</option>
				</select>
            <span class="description"><?php esc_attr__('By default bellow category title is displayed featured images slideshow. Here can be disabled for this category.', 'dp-esense'); ?></span>
        </td>
</tr>
<?php
}
add_action ( 'edit_category_form_fields', 'esense_extra_category_fields');

function esense_save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
add_action ( 'edited_category', 'esense_save_extra_category_fileds'); 
/**
 * 
 * 
 * 
 * 
 * WP Core actions 
 *
 *
 *
 *
 **/


/**
 *
 * Function used to generate the custom RSS feed link
 *
 **/


function esense_wp_custom_rss_feed_url( $output, $feed ) {
    global $esense_tpl;
    // get the new RSS URL
    $feed_link = get_option($esense_tpl->name . '_custom_rss_feed', '');
    // check the URL
    if(trim($feed_link) !== '') {
	    if (strpos($output, 'comments')) {
	        return $output;
	    }


	    return esc_url($feed_link);
    } else {
    	return $output;
    }
}


add_action( 'feed_link', 'esense_wp_custom_rss_feed_url', 10, 2 ); 

// EOF