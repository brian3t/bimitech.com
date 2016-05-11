<?php

// run the code only on the dashboard
if(is_admin() && !class_exists('DP_Widget_Rules_Back_End')) {
	
	// define an additional operation when save the widget
	add_filter('widget_update_callback', array('DP_Widget_Rules_Back_End', 'update'), 10, 4);
	add_action('admin_enqueue_scripts', array('DP_Widget_Rules_Back_End', 'load_scripts'));
	add_action('in_widget_form', array('DP_Widget_Rules_Back_End', 'control'), 10, 3);
	
	class DP_Widget_Rules_Back_End {		
		static function load_scripts($hook) {
			if($hook != 'widgets.php') {
				return;
			}
	wp_enqueue_script('widget-rules-js', DPFUNCTIONS_URI.'/inc/widgets/widget_rules/widget.rules.js', array('jquery'));
	wp_enqueue_style('widget-rules-css', DPFUNCTIONS_URI.'/inc/widgets/widget_rules/widget.rules.css');
	
		}
	
		// definition of the additional operation
		static function update($instance, $new_instance, $old_instance, $widget) {
			// get the POST data
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {	
				$widget_rules = array(
					'type' => '',
					'value' => '',
					'style' => '',
					'css' => '',
					'responsive' => '',
					'users' => ''
				);

				// save widget rules type
				if (isset($_POST['dp_widget_rules_type'])) {
					$widget_rules['type'] = preg_replace('@[^a-z\-]@', '', $_POST['dp_widget_rules_type']);
				}
				// save widget rules
				if (isset($_POST['dp_widget_rules_output'])) {
					$widget_rules['value'] = preg_replace('@[^A-Za-z0-9\-\(\)\!\_\+\:\,]@', '', $_POST['dp_widget_rules_output']);
				}
				// save widget style
				if (isset($_POST['dp_widget_rules_style'])) {
					$widget_rules['style'] = preg_replace('@[^A-Za-z0-9\-\_\s]@', '', $_POST['dp_widget_rules_style']);
				}
				// save widget custom CSS class
				if (isset($_POST['dp_widget_rules_css'])) {
					$widget_rules['css'] = preg_replace('@[^A-Za-z0-9\-\_\s]@', '', $_POST['dp_widget_rules_css']);
				}
				// save widget responsive
				if (isset($_POST['dp_widget_rules_responsive'])) {
					$widget_rules['responsive'] = preg_replace('@[^a-z\-]@', '', $_POST['dp_widget_rules_responsive']);
				}
				// save widget users
				if (isset($_POST['dp_widget_rules_users'])) {
					$widget_rules['users'] = preg_replace('@[^a-z\-]@', '', $_POST['dp_widget_rules_users']);
				}
				// store the data in the widget
				$instance['dp_widget_rules'] = serialize($widget_rules);
			}

			// return the widget instance
			return $instance;
		}
		
		// function to add the widget control 
		static function control($widget, $return, $instance) {	
			// get the access to the registered widget controls
			global $wp_registered_widget_controls, $esense_tpl;

				$widget_rules = array(
				'type' => '',
				'value' => '',
				'style' => '',
				'css' => '',
				'responsive' => '',
				'users' => ''
			);
		
			if(isset($instance['dp_widget_rules'])) {
				$widget_rules = unserialize($instance['dp_widget_rules']);
			}
		
			// value of the option
			$value_type = $widget_rules['type'];
			$value = $widget_rules['value'];
			$style = $widget_rules['style'];
			$css = $widget_rules['css'];
			$responsive_mode = $widget_rules['responsive'];
			$users_mode = $widget_rules['users'];
			// random ID for the widget form
			$unique_id = rand(100000000, 999999999);
			
			$json_data = $esense_tpl->esense_get_json('config','widgets.styles');
	// prepare an array of style options
	$items = array('<option value="" selected="selected">'.esc_attr__('None', 'esense-functions').'</option>');
	$for_only_array = array();
	$exclude_array = array();
	// iterate through all styles in the file
	$widget_name ='';
	foreach ($json_data as $style) {
		// flag
		$add_the_item = true;
		// check the for_only tag
		if(isset($style->for_only)) {
			$for_only_array = explode(',', $style->for_only);
			if(array_search($widget_name, $for_only_array) === FALSE) {
				$add_the_item = false;
			}
		// check the exclude tag
		} else if(isset($style->exclude)) {
			$exclude_array = explode(',', $style->exclude);
			
			if(array_search($widget_name, $exclude_array) !== FALSE) {
				$add_the_item = false;
			}
		} 
		// check the flag state
		if($add_the_item) {
			// add the item if the module isn't excluded
			array_push($items, '<option value="'.$style->css_class.'"'.(($style->css_class == $widget_rules['style']) ? ' selected="selected"' : '').'>'.$style->name.'</option>');
		}
	}
	// check if the items array is blank - the prepare a basic field
	if(count($items) == 1) {
		$items = array('<option value="" selected="selected">'.esc_attr__('No styles available', 'esense-functions').'</option>');
	}
			?>
				<a class="dp_widget_rules_btn button"><?php _e('Widget rules', 'esense-functions'); ?></a>
				<div class="dp_widget_rules_wrapper<?php if (isset($_POST['esense-widget-rules-visibility']) && $_POST['esense-widget-rules-visibility'] == '1') { ?> active<?php } ?>" id="dp_widget_rules_form_<?php echo esc_attr($unique_id); ?>">
					<p>
						<label for="dp_widget_rules_type">
							<?php _e('Visible at: ', 'esense-functions'); ?>
						</label>
						<select name="dp_widget_rules_type" id="dp_widget_rules_type" class="dp_widget_rules_select">
							<option value="all"<?php echo (($value_type != "include" && $value_type != 'exclude') ? " selected=\"selected\"":""); ?>><?php _e('All pages', 'esense-functions'); ?></option>
							<option value="exclude"<?php selected($value_type, "exclude"); ?>><?php _e('All pages except:', 'esense-functions'); ?></option>
							<option value="include"<?php selected($value_type, "include"); ?>><?php _e('No pages except:', 'esense-functions'); ?></option>
						</select>
					</p>
					<fieldset class="dp_widget_rules_form" id="dp_widget_rules_form_<?php echo esc_attr($unique_id); ?>" data-id="dp_widget_rules_form_<?php echo esc_attr($unique_id); ?>">
						<legend><?php _e('Select page to add', 'esense-functions'); ?></legend>
						
						 <select class="dp_widget_rules_form_select">
						 	<option value="homepage"><?php _e('Homepage', 'esense-functions'); ?></option>
						 	<option value="page:"><?php _e('Page', 'esense-functions'); ?></option>
						 	<option value="post:"><?php _e('Post', 'esense-functions'); ?></option>
						 	<option value="category:"><?php _e('Category', 'esense-functions'); ?></option>
						 	<option value="category_descendant:"><?php _e('Category with descendants', 'esense-functions'); ?></option>
						 	<option value="tag:"><?php _e('Tag', 'esense-functions'); ?></option>
						 	<option value="archive"><?php _e('Archive', 'esense-functions'); ?></option>
						 	<option value="author:"><?php _e('Author', 'esense-functions'); ?></option>
						 	<option value="template:"><?php _e('Page Template', 'esense-functions'); ?></option>
						 	<option value="taxonomy:"><?php _e('Taxonomy', 'esense-functions'); ?></option>
						 	<option value="posttype:"><?php _e('Post type', 'esense-functions'); ?></option>
						 	<option value="search"><?php _e('Search page', 'esense-functions'); ?></option>
						 	<option value="page404"><?php _e('404 page', 'esense-functions'); ?></option>
						 </select>
						 <p>
						 	<label>
						 		<?php _e('Page ID/Title/slug:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_page" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Post ID/Title/slug:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_post" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Category ID/Name/slug:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_category" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Category ID:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_category_descendant" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Tag ID/Name:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_tag" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Author:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_author" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Template:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_template" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Taxonomy:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_taxonomy" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Taxonomy term:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_taxonomy_term" />
						 	</label>
						 </p>
						 <p>
						 	<label>
						 		<?php _e('Post type:', 'esense-functions'); ?>
						 		<input type="text" class="dp_widget_rules_form_input_posttype" />
						 	</label>
						 </p>
						 <p>
						 	<button class="dp_widget_rules_btn button-secondary"><?php _e('Add page', 'esense-functions'); ?></button>
						 </p>
						 <input type="text" name="dp_widget_rules_output" id="dp_widget_rules_output" value="<?php echo esc_attr($value); ?>" class="dp_widget_rules_output" />
						 
						 <fieldset class="dp_widget_rules_pages">
						 	<legend><?php _e('Selected pages', 'esense-functions'); ?></legend>
						 	<span class="dp_widget_rules_nopages"><?php _e('No pages', 'esense-functions'); ?></span>
						 	<div></div>
						 </fieldset>
					</fieldset>
				<div>
                <p><?php echo $widget_rules['style'] ?> </p>
				<p>
					<label for="dp_widget_rules_style">
						<?php _e('Widget style: ', 'esense-functions'); ?>
					<select name="dp_widget_rules_style" id="dp_widget_rules_style">
                    <?php
					foreach($items as $item) echo $item;
					?>
                    </select>
					</label>
				</p>
				<p>
					<label for="dp_widget_rules_css">
						<?php _e('Custom CSS class: ', 'esense-functions'); ?>
						<input type="text" name="dp_widget_rules_css" value="<?php echo $css; ?>" />
					</label>
				</p>

					<p>
						<label for="dp_widget_rules_responsive"><?php _e('Visible on: ', 'esense-functions'); ?>
							<select name="dp_widget_rules_responsive">
								<option value="all-devices"<?php echo ((!$responsive_mode || $responsive_mode == 'all-devices') ? ' selected="selected"' : ''); ?>><?php _e('All devices', 'esense-functions'); ?></option>
								<option value="only-desktop"<?php selected($responsive_mode, 'only-desktop'); ?>><?php _e('Desktop', 'esense-functions'); ?></option>
								<option value="only-tablets"<?php selected($responsive_mode, 'only-tablets'); ?>><?php _e('Tablets', 'esense-functions'); ?></option>
								<option value="only-smartphones"<?php selected($responsive_mode, 'only-smartphones'); ?>><?php _e('Smartphones', 'esense-functions'); ?></option>
								<option value="only-tablets-and-smartphones"<?php selected($responsive_mode, 'only-tablets-and-smartphones'); ?>><?php _e('Tablets/Smartphones', 'esense-functions'); ?></option>
								<option value="only-desktop-and-tablets"<?php selected($responsive_mode, 'only-desktop-and-tablets'); ?>><?php _e('Desktop/Tablets', 'esense-functions'); ?></option>
							</select>
						</label>
					</p>
					<p>
						<label for="dp_widget_rules_users">
							<?php _e('Visible for: ', 'esense-functions'); ?>
							<select name="dp_widget_rules_users">
								<option value="all"<?php echo ($users_mode == null || !$users_mode || $users_mode == 'all') ? ' selected="selected"' : ''; ?>><?php _e('All users', 'esense-functions'); ?></option>
								<option value="guests"<?php selected($users_mode, 'guests'); ?>><?php _e('Only guests', 'esense-functions'); ?></option>
								<option value="registered"<?php selected($users_mode, 'registered'); ?>><?php _e('Only registered users', 'esense-functions'); ?></option>
								<option value="administrator"<?php selected($users_mode, 'administrator'); ?>><?php _e('Only administrator', 'esense-functions'); ?></option>
							</select>
						</label>
					</p>
				</div>

				<input type="hidden" name="esense-widget-rules-visibility" class="esense-widget-rules-visibility" value="<?php if ( isset( $_POST['esense-widget-rules-visibility'] ) ) { echo esc_attr( $_POST['esense-widget-rules-visibility'] ); } else { ?>0<?php } ?>" />

				<?php if(isset($_POST['esense-widget-rules-visibility']) && $_POST['esense-widget-rules-visibility'] == '1') : ?>
				<script type="text/javascript">dp_widget_control_init('#dp_widget_rules_form_<?php echo esc_attr($unique_id); ?>');</script>
				<?php endif; ?>
			</div>
			<hr />
			<?php
		}
	}
}


if(!is_admin() && !class_exists('DP_Widget_Rules_Front_End')) {
	class DP_Widget_Rules_Front_End {
		
		static $conditions = array();
		static $widget_settings = array();

		/**
		 *
		 * Function used to create conditional string
		 *
		 * @param mode - mode of the condition - exclude, all, include
		 * @param input - input data separated by commas, look into example inside the function
		 * @param users - the value of the user access
		 *
		 * @return HTML output
		 *
		 **/
		static function condition($mode, $input, $users) {
			// Example input:
			// homepage,page:12,post:10,category:test,tag:test
		
			$output = ' (';
			if($mode == 'all') {
				$output = '';
			} else if($mode == 'exclude') {
				$output = ' !(';
			}
		
			if($mode != 'all') {
				$input = preg_replace('@[^a-zA-Z0-9\-_,;\:\.\s]@mis', '', $input); 
				$input = substr($input, 1);
				$input = explode(',', $input);
		
				for($i = 0; $i < count($input); $i++) {
					if($i > 0) {
						$output .= '||'; 
					}
		
					if(stripos($input[$i], 'homepage') !== FALSE) {
					    $output .= ' is_home() ';
					} else if(stripos($input[$i], 'page:') !== FALSE) {
					    $output .= ' is_page(\'' . substr($input[$i], 5) . '\') ';
					} else if(stripos($input[$i], 'post:') !== FALSE) {
					    $output .= ' is_single(\'' . substr($input[$i], 5) . '\') ';
					} else if(stripos($input[$i], 'category:') !== FALSE) {
					    $output .= ' (is_category(\'' . substr($input[$i], 9) . '\') || (in_category(\'' . substr($input[$i], 9) . '\') && is_single())) ';
					} else if(stripos($input[$i], 'category_descendant:') !== FALSE) {
						$output .= ' (is_category(\'' . substr($input[$i], 20) . '\') || (in_category(\'' . substr($input[$i], 20) . '\') || esense_post_is_in_descendant_category( \'' . substr($input[$i], 20) . '\' ) && !is_home())) ';
					} else if(stripos($input[$i], 'tag:') !== FALSE) {
					    $output .= ' (is_tag(\'' . substr($input[$i], 4) . '\') || (has_tag(\'' . substr($input[$i], 4) . '\') && is_single())) ';
					} else if(stripos($input[$i], 'archive') !== FALSE) {
					    $output .= ' is_archive() ';
					} else if(stripos($input[$i], 'author:') !== FALSE) {
					    $output .= ' (is_author(\'' . substr($input[$i], 7) . '\')) ';
				    } else if(stripos($input[$i], 'template:') !== FALSE) {
				        if(substr($input[$i], 9) != '') {
				       		$output .= ' (is_page_template(\'' . substr($input[$i], 9) . '.php\') && is_singular()) ';
				       	} else {
				       		$output .= ' (is_page_template() && is_singular()) ';
				       	}
			        } else if(stripos($input[$i], 'format:') !== FALSE) {
			        	if(substr($input[$i], 7 != '')) {
			            	$output .= ' (has_term( \'post_format\', \'post-format-' . substr($input[$i], 7) . '\') && is_single()) ';
			            } else {
			            	$output .= ' (has_term( \'post_format\') && is_single()) ';
			            }
					} else if(stripos($input[$i], 'taxonomy:') !== FALSE) {
					    if(substr($input[$i], 9) != '') {
					    	$taxonomy = substr($input[$i], 9);
					    	$taxonomy = explode(';', $taxonomy);
					    	// check amount of taxonomies
					    	if(count($taxonomy) == 1) {
					    	     $output .= ' (is_tax(\'' . $taxonomy[0] . '\'))';
					    	} else if(count($taxonomy) == 2) {
					    	     $output .= ' (has_term(\'' . $taxonomy[1] . '\', \'' . $taxonomy[0] . '\')) ';
					    	}
					   	}
					} else if(stripos($input[$i], 'posttype:') !== FALSE) {
					    if(substr($input[$i], 9) != '') {
					    	$type = substr($input[$i], 9);
					    	// check for post types
					    	if($type != '') {
					   			$output .= ' (get_post_type() == \'' . $type . '\' && is_single()) ';
					   		}
					   	}
					} else if(stripos($input[$i], 'search') !== FALSE) {
					    $output .= ' is_search() ';
					} else if(stripos($input[$i], 'page404') !== FALSE) {
					    $output .= ' is_404() ';
					}
				}
		
				$output .= ')';
			}
		
			if($users != 'all') {
				if($users == 'guests') {
					$output .= (($output == '') ? '' : ' && ') . ' !is_user_logged_in()';
				} else if($users == 'registered') {
					$output .= (($output == '') ? '' : ' && ') . ' is_user_logged_in()';
				} else if($users == 'administrator') {
					$output .= (($output == '') ? '' : ' && ') . ' current_user_can(\'manage_options\')';
				}
			}
		
			if($output == '' || trim($output) == '()' || trim($output) == '!()') {
				$output = ' TRUE';
			}
			
			return $output;
		}
		
		static function filter_widgets($instance) {	
			// get settings
			$config = array();
			// check for the widget rules option existence
			if(isset($instance['dp_widget_rules'])) {
				$config = unserialize($instance['dp_widget_rules']);
			}
			// create function
			$type = '';
			if(isset($config['type'])) {
				$type = $config['type'];
			}
			
			$rules = '';
			if(isset($config['value'])) {
				$rules = $config['value'];
			}
			
			$users = '';
			if(isset($config['users'])) {
				$users = $config['users'];
			}
			// cache for conditions
			if(isset($instance['dp_widget_rules']) && !isset(self::$conditions[md5($instance['dp_widget_rules'])])) {
				self::$conditions[md5($instance['dp_widget_rules'])] = self::condition($type, $rules, $users);
			}
			
			if(isset($instance['dp_widget_rules'])) {
				$conditional_function = create_function('', 'return '. self::$conditions[md5($instance['dp_widget_rules'])] .';');	
			} else {
				$conditional_function = create_function('', 'return TRUE;');
			}
			
			// generate the result of function
			$conditional_result = $conditional_function();
			// eval condition function
			if(!$conditional_result) {
				return false;
			}
			
			return $instance;
		}

		static function filter_sidebars($sidebars) {	
			foreach ($sidebars as $sidebar => $widgets) {
				if (empty($widgets) || $sidebar == 'wp_inactive_widgets') {
					continue;
				}

				foreach ($widgets as $pos => $id) {
					$num = -1;

					if(preg_match( '@^(.+?)-([0-9]+)$@', $id, $matches)) {
						$id = 'widget_' . $matches[1];
						$num = intval($matches[2]);
					}

					if(!isset(self::$widget_settings[$id])) {
						self::$widget_settings[$id] = get_option($id);
					}

					if(
						(
							$num >= 0 &&
							(
								isset(self::$widget_settings[$id][$num]) && 
								!self::filter_widgets(self::$widget_settings[$id][$num])
							)
						) ||
						(
							!empty(self::$widget_settings[$id]) && 
							!self::filter_widgets(self::$widget_settings[$id])
						)
					) {
						unset($sidebars[$sidebar][$pos]);
					}
				}
			}

			return $sidebars;
		}
		
		// function used to add new CSS classes to widgets
		static function add_classes($params) {
			global $wp_registered_widgets;
			// get the widget settings
			$id = $params[0]['widget_id'];
			$num = -1;

			if(preg_match( '@^(.+?)-([0-9]+)$@', $id, $matches)) {
				$id = 'widget_' . $matches[1];
				$num = intval($matches[2]);
			}

			if(!isset(self::$widget_settings[$id])) {
				self::$widget_settings[$id] = get_option($id);
			}

			if($num >= 0) {
				// get the configuration
				$config = self::$widget_settings[$id][$num];
				if(isset($config['dp_widget_rules'])) {
					$config = unserialize($config['dp_widget_rules']);	
				} else {
					$config = array();
				}
				// style CSS classes
				if(isset($config['style'])) {
					$widget_css_style = $config['style'];
					$params[0]['before_widget'] = str_replace('class="', 'class="' . $widget_css_style . ' ', $params[0]['before_widget']);
				}
				// additional CSS classes
				if(isset($config['css'])) {
					$widget_css_class = $config['css'];
					$params[0]['before_widget'] = str_replace('class="', 'class="' . $widget_css_class . ' ', $params[0]['before_widget']);
				}
				// responsive CSS classes
				if(isset($config['responsive'])) {
					$widget_rwd_css_class = $config['responsive'];
					$params[0]['before_widget'] = str_replace('class="', 'class="' . $widget_rwd_css_class . ' ', $params[0]['before_widget']);
				}
			}
			
			return $params;
		}
	}
	
	add_filter('widget_display_callback', array('DP_Widget_Rules_Front_End', 'filter_widgets'));
	add_filter('sidebars_widgets', array('DP_Widget_Rules_Front_End', 'filter_sidebars'));
	add_filter('dynamic_sidebar_params', array('DP_Widget_Rules_Front_End', 'add_classes'), 10);
}

// EOF