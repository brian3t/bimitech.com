<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

/**
 *
 * Layout functions
 *
 * Group of functions used in the layout - help to create the page structure
 *
 **/
/**
 *
 * Function used to check if given sidebar is active
 *
 * @param index - index of the sidebar
 *
 * @return bool/int
 * 
 **/
function esense_is_active_sidebar( $index ) {
	// get access to the template object
	global $esense_tpl;
	// get access to registered widgets
	global $wp_registered_widgets;
	// sidebar flag
	$sidebar_flag = false;
	//
	if($GLOBALS['pagenow'] !== 'wp-signup.php' && $GLOBALS['pagenow'] !== 'wp-activate.php') {
		// generate sidebar index
		$index = ( is_int($index) ) ? "sidebar-$index" : sanitize_title($index);
		// getting the widgets
		$sidebars_widgets = wp_get_sidebars_widgets();
		// get the widget showing rules
		$options_type = get_option($esense_tpl->name . '_widget_rules_type');
		$options = get_option($esense_tpl->name . '_widget_rules');
		$users = get_option($esense_tpl->name . '_widget_users');
		// if some widget exists
		if ( !empty($sidebars_widgets[$index]) ) {
			$widget_counter = 0;
			foreach ( (array) $sidebars_widgets[$index] as $id ) {
				// if widget doesn't exists - skip this iteration
				if ( !isset($wp_registered_widgets[$id]) ) continue;
				// if the widget rules are enabled
				if(get_option($esense_tpl->name . '_widget_rules_state') == 'Y') {
					// check the widget rules
					$conditional_result = false;
					// create conditional function based on rules
					if( isset($options[$id]) && $options[$id] != '' ) {
						// create function
						$conditional_function = create_function('', 'return '.esense_condition($options_type[$id], $options[$id], $users[$id]).';');
						// generate the result of function
						$conditional_result = $conditional_function();
					}
					// if condition for widget isn't set or is TRUE
					if( !isset($options[$id]) || $options[$id] == '' || $conditional_result === TRUE ) {
						// return TRUE, because at lease one widget exists in the specific sidebar
						$sidebar_flag = true;
						$widget_counter++;
					}
					// set the state of the widget
					$wp_registered_widgets[$id]['dpstate'] = $conditional_result;
				} else {
					$widget_counter++;
					$sidebar_flag = true;
					$wp_registered_widgets[$id]['dpstate'] = true;
				}
			}
			// change num 
			foreach ( (array) $sidebars_widgets[$index] as $id ) {
				// if widget doesn't exists - skip this iteration
				if ( !isset($wp_registered_widgets[$id]) ) continue;
				// save the class
				$wp_registered_widgets[$id]['dpcount'] = $widget_counter;
			}
		}
	}
	// if there is no widgets in the sidebar
	return $sidebar_flag;
}

/**
 *
 * Function used to generate the template sidebars
 *
 * @param index - index of the sidebar
 *
 * @return bool
 *
 **/
function esense_dynamic_sidebar($index) {
	// get access to the template object
	global $esense_tpl;
	// get access to registered sidebars and widgets
	global $wp_registered_sidebars;
	global $wp_registered_widgets;
	// prepare index of the sidebar
	$index = sanitize_title($index);
	// get the widget showing rules
	$options_type = get_option($esense_tpl->name . '_widget_rules_type');
	$options = get_option($esense_tpl->name . '_widget_rules');
	$styles = get_option($esense_tpl->name . '_widget_style');
	$styles_css = get_option($esense_tpl->name . '_widget_style_css');
	$responsive = get_option($esense_tpl->name . '_widget_responsive');
	// find sidebar with specific name
	foreach ( (array) $wp_registered_sidebars as $key => $value ) {
		if ( sanitize_title($value['name']) == $index ) {
			$index = $key;
			break;
		}
	}
	// get sidebars widgets list
	$sidebars_widgets = wp_get_sidebars_widgets();
	// if the list is empty - finish the function
	if ( empty( $sidebars_widgets ) ) {
		return false;
	}
	// if specified sidebar doesn't exist - finish the function
	if ( empty($wp_registered_sidebars[$index]) || 
		!array_key_exists($index, $sidebars_widgets) || 
		!is_array($sidebars_widgets[$index]) || 
		empty($sidebars_widgets[$index]) ) {
		return false;
	}
	// if the sidebar exists - get it
	$sidebar = $wp_registered_sidebars[$index];
	// widget counter
	$counter = 0;
	// run hook
	do_action('esense_wp_before_sidebar');
	// iterate through specified sidebar widget
	foreach ( (array) $sidebars_widgets[$index] as $id ) {
		// if widget doesn't exists - skip this iteration
		if ( !isset($wp_registered_widgets[$id]) ) continue;
		// if condition for widget isn't set or is TRUE
		if( !isset($options[$id]) || $options[$id] == '' || $wp_registered_widgets[$id]['dpstate'] == TRUE ) {
			$counter++;
			// get the widget params and merge with sidebar data, widget ID and name
			$params = array_merge(
				array( 
					array_merge( 
						$sidebar, 
						array(
							'widget_id' => $id, 
							'widget_name' => $wp_registered_widgets[$id]['name']
						) 
					) 
				),
				
				(array) $wp_registered_widgets[$id]['params']
			);
			// Substitute HTML id and class attributes into before_widget
			$classname_ = '';
			foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
				if ( is_string($cn) ) $classname_ .= '_' . $cn;
				elseif ( is_object($cn) ) $classname_ .= '_' . get_class($cn);
			}
			// only for the widget areas where the amount of widgets is bigger than 1			
			if(isset($esense_tpl->widgets[$index]) && $esense_tpl->widgets[$index] > 1) {
				$widget_class = '';
				$widget_amount = $wp_registered_widgets[$id]['dpcount'];
				// set the col* classes
				$widget_class = ' col' . $esense_tpl->widgets[$index];
				// set the nth* classes
				if($counter % $esense_tpl->widgets[$index] == 0) {
					$widget_class .= ' nth' . $esense_tpl->widgets[$index];
				} else {
					$widget_class .= ' nth' . $counter % $esense_tpl->widgets[$index];
				}
				// set the last classes
				$last_amount = $widget_amount % $esense_tpl->widgets[$index];
				if(
					$last_amount > 0 && 
					$counter > $widget_amount - $last_amount
				) {
					$widget_class .= ' last' . $last_amount; 
				}
				//
				$classname_ .= $widget_class;
			}
			// trim the class name
			$classname_ = ltrim($classname_, '_');
			// define the code before widget
			if( (isset($styles[$id]) && $styles[$id] != '') || (isset($responsive[$id]) && $responsive[$id] != '' && $responsive[$id] != 'all')) {
				$css_class = '';
				
				if($styles[$id] == 'dpcustom') {
					$css_class = $styles_css[$id];
				} else {
					$css_class = $styles[$id];
				}
				$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, ' ' . $css_class . ' ' . $responsive[$id] . ' ' . $classname_);
			} else {
				$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, ' ' . $classname_);
			}
			// apply params
			$params = apply_filters( 'esense_dynamic_sidebar_params', $params );
			// get the widget callback function
			$callback = $wp_registered_widgets[$id]['callback'];
			// generate the widget
			do_action( 'esense_dynamic_sidebar', $wp_registered_widgets[$id] );
			// use the widget callback function if exists
			if ( is_callable($callback) ) {
				call_user_func_array($callback, $params);
			}
		}
	}
	// run hook
	do_action('esense_wp_after_sidebar');
}
/**
 *
 * Functions used to load specific layout parts
 *
 * @return null
 *
 **/
function esense_load($part_name,$args = null) {	
	global $esense_tpl,$post,$more,$woocommerce,$fullwidth;
	include(get_template_directory() . '/layouts/' . $part_name . '.php');
}
function esense_get_template_part( $slug, $name = null ) {
 	global $esense_tpl, $post, $more, $woocommerce;
	$template = $slug;
	if($name !='') $template = $slug.'-'.$name;
	include(get_template_directory() . '/'.$template . '.php');
}

/**
 *
 * Function used to generate a Logo image based on the branding options
 *
 * @return null
 *
 **/
function esense_blog_logo() {
	// access to the template object
	global $esense_tpl;
	// variable for the logo text
	$logo_text = '';
	// check the logo image type:
	if(get_option($esense_tpl->name . "_branding_logo_type", 'css') == 'image') {
		// check the logo text type
			$logo_text = get_option($esense_tpl->name . "_branding_logo_alt_text", '');
		// return the logo output
		echo '<img class="logo-default" src="'.esc_url(get_option($esense_tpl->name . "_branding_logo_image", '')).'" alt="' . $logo_text . '" />';
		if(get_option($esense_tpl->name . '_sticky_logo_image','') != '') {
		echo '<img class="logo-sticky" src="'.esc_url(get_option($esense_tpl->name . "_sticky_logo_image", '')).'" alt="' . $logo_text . '" style="width:'.get_option($esense_tpl->name . '_sticky_logo_image_width','105').'px!important'.'; height:'.get_option($esense_tpl->name . '_sticky_logo_image_height','40').'px!important'.'"/>';
		} else {
		echo '<img class="logo-sticky" src="'.esc_url(get_option($esense_tpl->name . "_branding_logo_image", '')).'" alt="' . $logo_text . '" />';
		}
		if(get_option($esense_tpl->name . '_overlapping_logo_image_light','') != '') {
		echo '<img class="logo-light" src="'.esc_url(get_option($esense_tpl->name . "_overlapping_logo_image_light", '')).'" alt="' . $logo_text . '" />';
		} else {
		echo '<img class="logo-light" src="'.esc_url(get_option($esense_tpl->name . "_branding_logo_image", '')).'" alt="' . $logo_text . '" />';
		}
		if(get_option($esense_tpl->name . '_overlapping_logo_image_dark','') != '') {
		echo '<img class="logo-dark" src="'.esc_url(get_option($esense_tpl->name . "_overlapping_logo_image_dark", '')).'" alt="' . $logo_text . '" />';
		} else {
		echo '<img class="logo-dark" src="'.esc_url(get_option($esense_tpl->name . "_branding_logo_image", '')).'" alt="' . $logo_text . '" />';
		}
	}
}
/**
 *
* Function used to generate a aside menu logo image based on the branding options
 *
 * @return null
 *
 **/
function esense_aside_menu_logo() {
	// access to the template object
	global $esense_tpl;
		// check the logo text type
		// return the logo output
			$logo_text = get_option($esense_tpl->name . "_branding_logo_alt_text", '');
		echo '<img class="aside-logo" src="'.esc_url(get_option($esense_tpl->name . "_aside_logo_image", '')).'" alt="' . $logo_text . '" />';
	}

/**
 *
 * Function used to generate the template Open Graph tags
 *
 * @return null
 *
 **/
function esense_opengraph_metatags() {
	// access to the template object
	global $esense_tpl;
	// check if the Open Graph is enabled
	if(get_option($esense_tpl->name . '_opengraph_use_opengraph') == 'Y') {
		if(is_single() || is_page()) {
			global $wp_query;
			//
			$postID = $wp_query->post->ID;
			//
			$title = get_post_meta($postID, 'esense_opengraph_title', true);
			$type = get_post_meta($postID, 'esense_opengraph_type', true);
			$image = wp_get_attachment_url(get_post_meta($postID, 'esense_opengraph_image', true));


			if($image == '') {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' );
				$image = $image[0];
			}


			$desc = get_post_meta($postID, 'esense_opengraph_desc', true);
			$other = get_post_meta($postID, 'esense_opengraph_other', true);
			//
			echo apply_filters('esense_og_title', '<meta name="og:title" content="'.(($title == '') ? esc_html($wp_query->post->post_title) : $title).'" />' . "\n");
			//
			if($image != '') {
				echo apply_filters('esense_og_image', '<meta name="og:image" content="'.$image.'" />' . "\n");
			} elseif(get_option($esense_tpl->name . '_og_default_image', '') != '') {
				echo apply_filters('esense_og_image', '<meta name="og:image" content="'.get_option($esense_tpl->name . '_og_default_image', '').'" />' . "\n");
			}
			//
			echo apply_filters('esense_og_type', '<meta name="og:type" content="'.(($type == '') ? 'article' : $type).'" />' . "\n");
			//
			echo apply_filters('esense_og_description', '<meta name="og:description" content="'.(($desc == '') ? substr(str_replace("\"", '', strip_tags($wp_query->post->post_content)), 0, 200) : $desc).'" />' . "\n");
			//
			echo apply_filters('esense_og_url', '<meta name="og:url" content="'.get_permalink($postID).'" />' . "\n");
			//
			if($other != '') {
				$other = preg_split('/\r\n|\r|\n/', $other);
				//
				foreach($other as $item) {
					//
					$item = explode('=', $item);
					//	
					if(count($item) >= 2) {
						echo apply_filters('esense_og_custom', '<meta name="'.$item[0].'" content="'.$item[1].'" />' . "\n");
					}
				}
			}
		}
	}
}
/**
 *
 * Function used to generate the TwitterCards tags
 *
 * @return null
 *
 **/
function esense_twitter_metatags() {
        // access to the template object
        global $esense_tpl;
        // check if the Twitter Cards option is enabled
        if(get_option($esense_tpl->name . '_twitter_cards') == 'Y') {
                if(is_single() || is_page()) {
                        global $wp_query;
                        //
                        $postID = $wp_query->post->ID;
                        //
                        $title = get_post_meta($postID, 'esense_twitter_title', true);
                        $image = wp_get_attachment_url(get_post_meta($postID, 'esense_twitter_image', true));
                        
                        if($image == '') {
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'single-post-thumbnail' );
                                $image = $image[0];
                        }
                        
                        $desc = get_post_meta($postID, 'esense_twitter_desc', true);
                        
                        $site_default = get_option($esense_tpl->name . '_twitter_site');
                        $creator_default = get_option($esense_tpl->name . '_twitter_creator');
                        $site = get_post_meta($postID, 'esense_twitter_site', true);
                        $creator = get_post_meta($postID, 'esense_twitter_creator', true);
                        
                        if($site_default != '') {
                                $site = $site_default;
                        }
                        
                        if($creator_default != '') {
                                $creator = $creator_default;
                        }
                        
                        echo apply_filters('esense_twitter_card', '<meta name="twitter:card" content="summary" />' . "\n");        
                        //
                        echo apply_filters('esense_twitter_url', '<meta name="twitter:url" content="'.get_permalink($postID).'" />' . "\n");
                        //                
                        echo apply_filters('esense_twitter_title', '<meta name="twitter:title" content="'.(($title == '') ? $wp_query->post->post_title : $title).'" />' . "\n");
                        //
                        if($image != '') {
                                echo apply_filters('esense_twitter_image', '<meta name="twitter:image" content="'.$image.'" />' . "\n");
                        }
                        echo apply_filters('esense_twitter_description', '<meta name="twitter:description" content="'.(($desc == '') ? substr(str_replace("\"", '', strip_tags($wp_query->post->post_content)), 0, 200) : $desc).'" />' . "\n");
                        //
                        echo apply_filters('esense_twitter_site', '<meta name="twitter:site" content="' . $site . '" />' . "\n");
                        //
                        echo apply_filters('esense_twitter_creator', '<meta name="twitter:creator" content="' . $creator . '" />' . "\n");
                }
        }
}
/**
 *
 * Function used to check if menu should be displayed
 *
 * @param name - name of the menu to check
 *
 * @return bool
 *
 **/
function esense_show_menu($name) {
	global $esense_tpl;
	
	// check if specific theme_location has assigned menu
	if (has_nav_menu($name)) {
		// if yes - please check menu confition function
		$conditional_function = false;
		
		if($esense_tpl->menu[$name]['state_rule'] != '') {
			$conditional_function = create_function('', 'return '.$esense_tpl->menu[$name]['state_rule'].';');
		}
		
		if(
			$esense_tpl->menu[$name]['state'] == 'Y' ||
			(
				$esense_tpl->menu[$name]['state'] == 'rule' && $conditional_function()
			)
		) {
			return true;
		} else {
			return false;
		}
	} else {
		// if there is no assigned menu for specific theme_location
		return false;
	}
}

/**
 *
 * Function used to generate some template settings
 *
 * @return null
 *
 **/
function esense_head_config() {
	// access the main template object
	global $esense_tpl;
	// output the start script tag
	echo "<script type=\"text/javascript\">\n";
	echo "           \$Esense_PAGE_URL = '".esc_url(home_url('/'))."';\n";
	echo "           \$Esense_TMPL_URL = '".get_template_directory_uri()."';\n";
	echo "           \$Esense_TMPL_NAME = '".$esense_tpl->name."';\n";
	echo "           \$Esense_TEMPLATE_WIDTH = '". get_option($esense_tpl->name . '_template_width', 1230)."';\n";
	echo "           \$Esense_TABLET_WIDTH = '". get_option($esense_tpl->name . '_tablet_width', 1030)."';\n";
	echo "           \$Esense_SMALL_TABLET_WIDTH = '". get_option($esense_tpl->name . '_small_tablet_width', 820)."';\n";
	echo "           \$Esense_MOBILE_WIDTH = '". get_option($esense_tpl->name . '_mobile_width', 580)."';\n";
	echo "           \$Esense_LAYOUT = '". get_option($esense_tpl->name . '_page_wrap_state','streched')."';\n";
	echo "           \$Esense_STICKY_HEADER = '". get_option($esense_tpl->name . '_sticky_header_state','N')."';\n";
	// output the finish script tag
	echo "        </script>\n";
}

/**
 *
 * Function used to generate the breadcrumbs output
 *
 * @return null
 *
 **/
function esense_breadcrumbs_output() {
	global $post;
	// open the breadcrumbs tag
	$output = '<div class="esense-breadcrumbs">';
	// check if we are on the post or normal page
	if (!is_home()) {
		// return the Home link
		$output .= '<a href="' . esc_url( home_url('/')) . '" class="esense-home">' . apply_filters('esense_breadcrumb_home', get_bloginfo('name')) . "</a>";
		// if page is category or post
		if (is_category() || is_singular()) {
			// return the category link
			$output .= get_the_category_list(' ');
			// if it is a subpage
            if (is_page() && $post->post_parent ) {
            $output .= '<a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a>';        
            }
			// if it is a post page
			if (is_singular()) {
				// return link the name of current post
				$output .= '<span class="esense-current">' . get_the_title() . '</span>';
			}			
		// if it is a normal page
		} elseif (is_page()) { 
			// output the page name
			$output .= get_the_title('<span class="esense-current">', '</span>');
		} elseif (is_tag() && isset($_GET['tag'])) {
			// output the tag name
			$output .= '<span class="esense-current">' . esc_attr__('Tag: ', 'dp-esense') . strip_tags($_GET['tag']) . '</span>';
		} elseif (is_author() && isset($_GET['author'])) {
			// get the author name
			$id = strip_tags($_GET['author']);
			if(is_numeric($id)) {
				// output the author name
				$output .= '<span class="esense-current">' . esc_attr__('Published by: ', 'dp-esense') . get_the_author_meta('display_name', $id) . '</span>';
			}
		} elseif(is_404()) {
			$output .= '<span class="esense-current">' . esc_attr__('Page not found', 'dp-esense') . '</span>';
		} elseif(is_archive()) {
			$output .= '<span class="esense-current">' . esc_attr__('Archives', 'dp-esense') . '</span>';
		} elseif(is_search() && isset($_GET['s'])) {
			// output the author name
			$output .= '<span class="esense-current">' . esc_attr__('Searching for: ', 'dp-esense') . strip_tags($_GET['s']) . '</span>';
		}
	// if the page is a home
	} else {
		// output the home link only
		$output .= '<a href="' . esc_url( home_url('/')) . '" class="esense-home">' . get_bloginfo('name') . "</a>";
	}
	// close the breadcrumbs container
	$output .= '</div>';


	echo apply_filters('esense_breadcrumb', $output);
}

/**
 *
 * Function used to create url to the template style CSS files
 *
 * @return null
 *
 **/
function esense_head_style_css() {
	// get access to the template object
	global $esense_tpl;
	// get access to the WP Customizer
	global $wp_customize;
	// iterate through template styles
	for($i = 0; $i < count($esense_tpl->styles); $i++) {
		// get the value for the specific style
		$stylevalue = get_option($esense_tpl->name . '_template_style_' . $esense_tpl->styles[$i], '');
		// find an url for the founded style
		if ($stylevalue!='') { 
		$url = $esense_tpl->style_colors[$esense_tpl->styles[$i]][$stylevalue];
		// if the customizer is enabled - not use the Cookies to set the styles
		// if the cookies works then the style switcher in the back-end won't work
		if(isset($wp_customize) && $wp_customize->is_preview()) {
			$url = esc_attr($url);
		} else { // when the page isn't previewed
		
			$url = esc_attr(isset($_COOKIE[$esense_tpl->name.'_style']) ? $_COOKIE[$esense_tpl->name.'_style'] : $url);
		}
		
		// output the LINK element
		wp_enqueue_style('esense-style', get_template_directory_uri() . '/css/' . $url);
		}
	}
}
add_action('wp_head', 'esense_head_style_css', 7);


/**
 *
 * Function used to create font CSS rules
 *
 * @return HTML output
 *
 **/
/**
 *
 * Function used to create links to stylesheets and script files for specific pages
 *
 * @return HTML output
 *
 **/
function esense_head_style_pages() {
	// get access to the template object
	global $esense_tpl;
	// scripts for the contact page
	if( is_page_template('contact.php') ){ 		
		wp_enqueue_script('esense-contact-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery', 'esense-scripts'), false, true);
		wp_enqueue_script('esense-contact-main', get_template_directory_uri() . '/js/contact.js', array('jquery', 'esense-scripts'), false, true);
	}
}



/**
 *
 * Code used to implement icons in the widget titles
 *
 * @return null
 * 
 **/
function esense_title_icons($title) {
	if($title == '&nbsp;' || trim($title) == '' || strlen($title) == 0) {
		return false;
	} else {
		$icons = array();	
		preg_match('(icon([\-a-zA-Z0-9]){1,})', $title, $icons);
		// icon text (if exists)
		$icon = '';
		//
		if(count($icons) > 0) {
			$icon = '<i class="'.$icons[0].'"></i>';
		}
		//
		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $title);
		//
		return $icon.' '.$title;
	}
}

add_filter('widget_title', 'esense_title_icons');

/**
 *
 * Code used to implement thickbox in the page
 *
 * @return null
 * 
 **/
function esense_thickbox_load() {
	//
	global $esense_tpl;
	//
	if(get_option($esense_tpl->name . '_thickbox_state') == 'Y') : 
	?>
	<script type="text/javascript">
		var thickboxL10n = {
			"next":"<?php esc_attr__('Next >', 'dp-esense'); ?>",
			"prev":"<?php esc_attr__('< Prev', 'dp-esense'); ?>",
			"image":"<?php esc_attr__('Image', 'dp-esense'); ?>",
			"of":"<?php esc_attr__('of', 'dp-esense'); ?>",
			"close":"<?php esc_attr__('Close', 'dp-esense'); ?>",
			"noiframes":"<?php esc_attr__('This feature requires inline frames. You have iframes disabled or your browser does not support them.', 'dp-esense'); ?>",
			"loadingAnimation":"<?php echo esc_url( home_url('/')); ?>/wp-includes/js/thickbox/loadingAnimation.gif",
			"closeImage":"<?php echo esc_url( home_url('/')); ?>/wp-includes/js/thickbox/tb-close.png"
		};
	</script>
 		<?php wp_enqueue_script('esense-thickbox', esc_url( home_url('/')) . '/wp-includes/js/thickbox/thickbox.js', array('jquery', 'esense-scripts'), false, true);	
		wp_enqueue_style('esense-thickbox', esc_url( home_url('/')) . '/wp-includes/js/thickbox/thickbox.css', array('esense-extensions'));
	endif;
}


// EOF
