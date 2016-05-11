<?php
vc_set_as_theme($disable_updater = true);
// Removing shortcodes
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_message");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
//vc_remove_element("vc_gallery");
//vc_remove_element("vc_tta_accordion");
//vc_remove_element("vc_tta_tour");
//vc_remove_element("vc_tta_tab");
//vc_remove_element("vc_tabs");
//vc_remove_element("vc_accordion");
//vc_remove_element("vc_tta_tabs");
$remove_depreciate = array (
  'deprecated' => ''
);
vc_map_update( 'vc_tab', $remove_depreciate );
//vc_map_update( 'vc_tour', $remove_depreciate );
vc_map_update( 'vc_accordion_tab', $remove_depreciate );

// Add VC admin CSS styles
function dp_load_custom_vc_admin_style() {
        wp_enqueue_style( 'custom_vc_admin_css', DPFUNCTIONS_URI . '/inc/vc_extend/dp_vc_admin.css', false, '' );
}
add_action( 'admin_enqueue_scripts', 'dp_load_custom_vc_admin_style' );
//Add VC frontend styles
function dp_load_custom_vc_frontend_style() {
		 wp_enqueue_style( 'custom_vc_frontend_css', DPFUNCTIONS_URI.'/inc/vc_extend/dp_vc_frontend.css', array('js_composer_front'), '', 'screen' );
    }
add_action('wp_head', 'dp_load_custom_vc_frontend_style', 6);

// Add custom functions and arrays

if (class_exists('DP_Post_Types')) {
if (!function_exists('dp_getSliderArray')){
	function dp_getSliderArray() {
    $terms = get_terms('slideshows');	
	$output = array("" => "");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'dp_getSliderArray',3);

if (!function_exists('dp_getPortfoliosArray')){
	function dp_getPortfoliosArray() {
    $terms = get_terms('portfolios');	
	$output = array("All" => "all");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'dp_getPortfoliosArray',3);
}
if (!function_exists('dp_getPatternsArray')){
	function dp_getPatternsArray() {
    $dirPath = dir( get_template_directory().'/images/overlay_patterns');
    $output = array("No pattern" => "none.png");	
	while (($file = $dirPath->read()) !== false)
					{if (trim($file)!='.' && trim($file)!='..')	{
					$value = current(explode(".", $file));
					if ($value != "none" && $value != "Thumbs") {
					$output[$value] = $file;
					}}
					}
	$dirPath->close();
    return $output;
}	
	
	}
add_action('init', 'dp_getPatternsArray',3);

if (!function_exists('dp_getCategoriesArray')){
	function dp_getCategoriesArray() {
    $terms = get_terms('category');	
	$output = array("All" => "all");	
    $count = count($terms);
	    if ( $count > 0 ):
        foreach ( $terms as $term ):
            $output[$term->name] = $term->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'dp_getCategoriesArray',3);

if (!function_exists('dp_getMenusArray')){
	function dp_getMenusArray() {
	$menus = wp_get_nav_menus();
	$output = array("-- Select --" => "");	
    $count = count($menus);
	    if ( $count > 0 ):
        foreach ( $menus as $menu ):
            $output[$menu->name] = $menu->slug;
        endforeach;
    endif;
	
    return $output;
	}
}
add_action('init', 'dp_getMenusArray',3);

$slideshows = $portfolios = '';
if (class_exists('DP_Post_Types')) {
$slideshows = dp_getSliderArray();
$portfolios = dp_getPortfoliosArray();
}
$patterns = dp_getPatternsArray();
$categories = dp_getCategoriesArray();
$menus = dp_getMenusArray();

$add_dp_animation = array(
  "type" => "dropdown",
  "heading" => esc_attr__("CSS Animation", 'esense-functions'),
  "param_name" => "dp_animation",
  "admin_label" => true,
  'save_always' => true,
  "value" => array ("No" => "",
  		"fadeIn " => "fadeIn",
		"fadeInUp" => "fadeInUp",
		"fadeInDown" => "fadeInDown",
		"fadeInLeft" => "fadeInLeft",
		"fadeInRight" => "fadeInRight",
		"fadeInUpBig" => "fadeInUpBig",
		"fadeInDownBig" => "fadeInDownBig",
		"fadeInLeftBig" => "fadeInLeftBig",
		"fadeInRightBig" => "fadeInRightBig",
		"lightSpeedRight" => "lightSpeedRight",
		"lightSpeedLeft" => "lightSpeedLeft",
		"bounceIn" => "bounceIn",
		"bounceInUp" => "bounceInUp",
		"bounceInDown" => "bounceInDown",
		"bounceInLeft" => "bounceInLeft",
		"bounceInRight" => "bounceInRight",
		"rotateInUpLeft" => "rotateInUpLeft",
		"rotateInDownLeft" => "rotateInDownLeft",
		"rotateInUpRight" => "rotateInUpRight",
		"rotateInDownRight" => "rotateInDownRight",
		"rollIn" => "rollIn",
		"pulse" => "pulse",
		"flipInX" => "flipInX",
)
);

$target_arr = array(
	esc_attr__( 'Same window', 'esense-functions' ) => '_self',
	esc_attr__( 'New window', 'esense-functions' ) => "_blank"
);
$add_dp_slideshow = array(
  "type" => "dropdown",
  "heading" => esc_attr__("Slideshow", 'esense-functions'),
  "param_name" => "slideshow",
  "admin_label" => true,
  'save_always' => true,
  "value" => $slideshows,
  "description" => "Select slideshow from available slideshows list"
);

$add_dp_category = array(
  "type" => "dropdown",
  "heading" => esc_attr__("Category", 'esense-functions'),
  "param_name" => "category",
  "admin_label" => true,
  'save_always' => true,
  "value" => $categories,
  "description" => "Select category from available categories list"

);
$add_dp_portfolios = array(
  "type" => "dropdown",
  "heading" => esc_attr__("Portfolio category", 'esense-functions'),
  "param_name" => "portfolios",
  "admin_label" => true,
  'save_always' => true,
  "value" => $portfolios,
  "description" => "Select portfolio category from available portfolio categories list"
);

$add_dp_menu = array(
  "type" => "dropdown",
  "heading" => esc_attr__("Menu", 'esense-functions'),
  "param_name" => "menu",
  "admin_label" => true,
  'save_always' => true,
  "value" => $menus,
  "description" => "Select menu from available menus list"
);

function dp_getImageBySize( $params = array( 'post_id' => NULL, 'attach_id' => NULL, 'thumb_size' => 'thumbnail', 'class' => '' ) ) {
	if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == NULL ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == NULL ) ) return;
	$post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

	if ( $post_id ) $attach_id = get_post_thumbnail_id( $post_id );
	else $attach_id = $params['attach_id'];

	$thumb_size = $params['thumb_size'];
	$thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

	global $_wp_additional_image_sizes;
	$thumbnail = '';

	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[$thumb_size] ) && is_array( $_wp_additional_image_sizes[$thumb_size] ) ) || in_array( $thumb_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) ) {
		$thumb = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
		$url = $thumb['0'];
		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, array( 'class' => $thumb_class . 'attachment-' . $thumb_size, 'data-thumb' => $url ) );
	} elseif ( $attach_id ) {
		if ( is_string( $thumb_size ) ) {
			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
			if ( isset( $thumb_matches[0] ) ) {
				$thumb_size = array();
				if ( count( $thumb_matches[0] ) > 1 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][1]; // height
				} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][0]; // height
				} else {
					$thumb_size = false;
				}
			}
		}
		if ( is_array( $thumb_size ) ) {
			// Resize image to custom size
			$p_img = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
			$alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );

			if ( empty( $alt ) ) {
				$attachment = get_post( $attach_id );
				$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
			}
			if ( empty( $alt ) )
				$alt = trim( strip_tags( $attachment->post_title ) ); // Finally, use the title
			if ( $p_img ) {
				$img_class = '';
				$thumbnail = '<img class="' . $thumb_class . '" src="' . $p_img['url'] . '" width="' . $p_img['width'] . '" height="' . $p_img['height'] . '" alt="' . $alt . '"/>';
			}
		}
	}

	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );
	return array( 'thumbnail' => $thumbnail, 'p_img_large' => $p_img_large );
}

if (!function_exists('dp_getAnimation')){
	function dp_getAnimation($animation) {
	$output = '';
	if ($animation != '') $output .= ' data-animated ="'.$animation.'"';
    return $output;
	}
}

function dp_datetimepicker($settings, $value)
		{
			$dependency = (function_exists('vc_generate_dependencies_attributes')) ? vc_generate_dependencies_attributes($settings) : '';
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid('datetimepicker-'.rand());
			$output = '<div id="esense-date-time'.$uni.'" class="esense-datetime"><input data-format="yyyy/MM/dd hh:mm:ss" readonly class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" style="width:258px;" value="'.$value.'" '.$dependency.'/><div class="add-on" >  <i class="icon-calendar" data-date-icon="icon-calendar"></i></div></div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#esense-date-time'.$uni.'").datetimepicker({
						language: "en-US"
					});
				})
    jQuery("#esense-date-time'.$uni.'").on("show", function(e){     
          e.preventDefault();
          return false;     
    }).datetimepicker();
				</script>';
			return $output;
		}

if ( function_exists('vc_add_shortcode_param'))
			{
				vc_add_shortcode_param('esense-datetimepicker' , 'dp_datetimepicker' ) ;
			}
			
function dp_vc_include_post_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => 'post' );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}

function vc_include_portfolio_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => 'portfolio' );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}
function dp_vc_include_postorportfolio_search( $search_string ) {
	$query = $search_string;
	$data = array();
	$args = array( 's' => $query, 'post_type' => array('portfolio','post') );
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( strlen( $args['s'] ) == 0 ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			);
		}
	}

	return $data;
}

//Add custom parameters to existing VC elements

//Animations
vc_remove_param("vc_single_image", "css_animation"); 				
vc_add_param("vc_single_image", $add_dp_animation);

vc_remove_param("vc_column_text", "css_animation"); 				
vc_add_param("vc_column_text", $add_dp_animation);

vc_remove_param("vc_cta_button2", "css_animation"); 				
vc_add_param("vc_cta_button2", $add_dp_animation);

vc_add_param("vc_column", $add_dp_animation);

//VC Row
vc_remove_param("vc_row", "el_class"); 				
vc_remove_param("vc_row", "full_width"); 				
vc_remove_param("vc_row", "video_bg"); 				
vc_remove_param("vc_row", "video_bg_url"); 				
vc_remove_param("vc_row", "video_bg_parallax"); 				
vc_remove_param("vc_row", "parallax"); 				
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "parallax_speed_video");
vc_remove_param("vc_row", "parallax_speed_bg"); 				
//vc_remove_param("vc_row", "el_id");

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_attr__("Content Type", 'esense-functions'),
	"param_name" => "type",
  'save_always' => true,
	"value" => array(
		"In Grid" => "grid",	
		"Full Width" => "full_width"
		
	),
	"std" => "grid",
    "description" => esc_attr__('This settings affected only when "Full width" page template is used. Here you can decide if row content should be boxed in page grid or 100% screen width.  ', 'esense-functions')
));
vc_add_param("vc_row", array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'No columns padding?', 'esense-functions' ),
			'param_name' => 'no_paddings',
			'description' => esc_attr__( 'If checked columns in row will be displayed with no paddings.', 'esense-functions' ),
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' )
		));


vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Parallax Background",
	"value" => array("Enable Parallax Background?" => "true" ),
	"param_name" => "parallax_bg",
    "description" => esc_attr__("Enable / Disable paralax effect for background image", 'esense-functions')
	));
	
vc_add_param("vc_row",array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_attr__( "Parallax Speed", 'esense-functions' ),
						"param_name" => "parallax_speed",
						"value" => "0.3",
						"description" => esc_attr__( "The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Be mindful of the <strong>background size</strong> and the <strong>dimensions</strong> of your background image when setting this value. Faster scrolling means that the image will move faster, make sure that your background image has enough width or height for the offset.", 'esense-functions' ),
	"group" => 'DP Background&Overlay Options',
	));
	
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"group" => 'DP Background&Overlay Options',
    "heading" => esc_attr__('Video background', 'esense-functions'),
    "param_name" => "video_bg",
  	'save_always' => true,
    "value" => array(
                        esc_attr__("None", 'esense-functions') => '',
                        esc_attr__("HTML5 video background", 'esense-functions') => 'html5videobg',
                        esc_attr__('Youtube video background', 'esense-functions') => 'ytvideobg'
                      ),
      "description" => esc_attr__("Select a background video type for your row", 'esense-functions'),
    ));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "WebM File URL",
	"value" => "",
	"param_name" => "video_webm",
	"description" => "You must include this format & the mp4 format to render your video with cross browser compatibility. OGV is optional.
Video must be in a 16:9 aspect ratio.",
	"dependency" => array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "MP4 File URL",
	"value" => "",
	"param_name" => "video_mp4",
	"description" => "Enter the URL for your mp4 video file here",
	"dependency" => array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "OGV File URL",
	"value" => "",
	"param_name" => "video_ogv",
	"description" => "Enter the URL for your ogv video file here",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "YouTube video URL",
	"value" => "",
	"param_name" => "video_yt",
	"description" => "Enter the URL for your YouTube video file here",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Start at",
	"value" => "",
	"param_name" => "start_at",
	"description" => "Enter a Youtube video start time in seconds. If you leave blank video will be start from begining.",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Video raster",
	"value" => array("Use raster?" => "use_raster" ),
	"param_name" => "use_raster",
	"description" => "",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('ytvideobg'))
	));
vc_add_param("vc_row", array(
    "type" => "dropdown",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Audio",
	"param_name" => "mute",
    'save_always' => true,
    "value" => array(
                        esc_attr__("Muted", 'esense-functions') => 'muted',
                        esc_attr__("Unmuted", 'esense-functions') => 'unmuted'
                      ),
	"std" => "muted",
    "description" => esc_attr__("Select a video audio default stand", 'esense-functions'),
	"dependency" => Array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Mute Button",
	"value" => array("Enable Mute / Unmute Button?" => "true" ),
	"param_name" => "mute_btn",
	"dependency" => Array('element' => "video_bg", 'value' =>  array('html5videobg'))
	));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"group" => 'DP Background&Overlay Options',
	"heading" => "Overlay Setting",
	"value" => array("Enable row overlay?" => "true" ),
	"param_name" => "useoverlay",
    "description" => esc_attr__("Enable color and pattern overlay for this row", 'esense-functions')
	));
vc_add_param("vc_row",array(
			'type' => 'colorpicker',
			"group" => 'DP Background&Overlay Options',
			'heading' => esc_attr__( 'Overlay color', 'esense-functions' ),
			'param_name' => 'overlaycolor',
			'description' => esc_attr__( 'Select color for overlay.', 'esense-functions' ),
			"dependency" => Array('element' => "useoverlay", 'value' =>  'true')
		));
		
vc_add_param("vc_row",array(
	  "type" => "dropdown",
      "group" => 'DP Background&Overlay Options',
	  "heading" => esc_attr__("Overlay pattern", 'esense-functions'),
	  "param_name" => "overlaypattern",
  'save_always' => true,
	  "value" => $patterns,
	  "description" => "Select pattern from available patterns list",
	  "dependency" => Array('element' => "useoverlay", 'value' =>  'true')
	));

vc_add_param("vc_row", array(
        "type" => "textfield",
        "heading" => esc_attr__("Extra class name", 'esense-functions'),
        "param_name" => "el_class",
        "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions'),
      ));

//VC Tab

$tab_id_1 = ''; // 'def' . time() . '-1-' . rand( 0, 100 );
$tab_id_2 = ''; // 'def' . time() . '-2-' . rand( 0, 100 );
vc_map( array(
	"name" => esc_attr__( 'DP Tabs', 'esense-functions' ),
	'base' => 'vc_tabs',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-tab-content',
    'category' =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
	'description' => esc_attr__( 'Tabbed content', 'esense-functions' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Widget title', 'esense-functions' ),
			'param_name' => 'title',
			'description' => esc_attr__( 'Enter text used as widget title (Note: located above content element).', 'esense-functions' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Auto rotate', 'esense-functions' ),
			'param_name' => 'interval',
  			'save_always' => true,
			'value' => array( esc_attr__( 'Disable', 'esense-functions' ) => 0, 3, 5, 10, 15 ),
			'std' => 0,
			'description' => esc_attr__( 'Auto rotate tabs each X seconds.', 'esense-functions' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'esense-functions' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'esense-functions' )
		)
	),
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
	'default_content' => '
[vc_tab title="' . esc_attr__( 'Tab 1', 'esense-functions' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . esc_attr__( 'Tab 2', 'esense-functions' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' =>'VcTabsView'
) );


vc_add_param("vc_tab", 
			array(
				"type" => "icon_selector",
				"admin_label" => true,
				"class" => "",
				"heading" => esc_attr__("Icon", 'esense-functions'),
				"param_name" => "icon"
				));
vc_add_param("vc_tab", array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Subtitle", 'esense-functions'),
				"value" => "",
				"param_name" => "subtitle",
			    "description" => esc_attr__("This field will be used only by custom diamond skin", 'esense-functions')
				));
vc_add_param("vc_tabs", array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Fullwidth", 'esense-functions'),
				"param_name" => "fullwidth"
				));
vc_add_param("vc_tabs", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Force fullwidth tabs in navigation?",
	"value" => array("Yes, please" => "true" ),
	"param_name" => "fullwidth",
    "description" => esc_attr__("This setting will work only by tabs count lower then 9 tabs", 'esense-functions')
	));
vc_add_param("vc_tabs", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Use diamond navigation?",
	"value" => array("Yes, please" => "true" ),
	"param_name" => "diamond_style"
	));
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Diamond navigation position",
			'value' => array(
				esc_attr__( 'Top', 'esense-functions' ) => 'top',
				esc_attr__( 'Bottom', 'esense-functions' ) => 'bottom'
			),
	"std" => "top",
	"param_name" => "diamond_navigation_position",
    'save_always' => true,
	"dependency" => Array('element' => "diamond_style", 'value' => array('true'))
	));
	  

// Accordion
vc_map( array(
	'name' => esc_attr__( 'DP Accordion', 'esense-functions' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
    'category' =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
	'description' => esc_attr__( 'Collapsible content panels', 'esense-functions' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Widget title', 'esense-functions' ),
			'param_name' => 'title',
			'description' => esc_attr__( 'Enter text used as widget title (Note: located above content element).', 'esense-functions' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Active section', 'esense-functions' ),
			'param_name' => 'active_tab',
			'value' => 1,
			'description' => esc_attr__( 'Enter section number to be active on load or enter "false" to collapse all sections.', 'esense-functions' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Allow collapse all sections?', 'esense-functions' ),
			'param_name' => 'collapsible',
			'description' => esc_attr__( 'If checked, it is allowed to collapse all sections.', 'esense-functions' ),
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Disable keyboard interactions?', 'esense-functions' ),
			'param_name' => 'disable_keyboard',
			'description' => esc_attr__( 'If checked, disables keyboard arrow interactions (Keys: Left, Up, Right, Down, Space).', 'esense-functions' ),
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'esense-functions' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'esense-functions' )
		)
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . esc_attr__( 'Add section', 'esense-functions' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . esc_attr__( 'Add section', 'esense-functions' ) . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . esc_attr__( 'Section 1', 'esense-functions' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . esc_attr__( 'Section 2', 'esense-functions' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView'
) );

vc_add_param("vc_accordion_tab", array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	"description" => ""
));



// Vertical tabs

$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
  "name" => esc_attr__("DP Vertical Tabs", 'esense-functions'),
  "base" => "vc_tour",
  "show_settings_on_create" => false,
  "is_container" => true,
  "container_not_allowed" => true,
  "icon" => "icon-wpb-ui-tab-content-vertical",
  'category' =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "wrapper_class" => "clearfix",
  "description" => esc_attr__('Vertical tabbed content', 'esense-functions'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Widget title", 'esense-functions'),
      "param_name" => "title",
      "description" => esc_attr__("Enter text which will be used as widget title. Leave blank if no title is needed.", 'esense-functions')
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_attr__("Auto rotate slides", 'esense-functions'),
      "param_name" => "interval",
      'save_always' => true,
      "value" => array(esc_attr__("Disable", 'esense-functions') => 0, 3, 5, 10, 15),
      "std" => 0,
      "description" => esc_attr__("Auto rotate slides each X seconds.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  ),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.esc_attr__('Slide 1','esense-functions').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.esc_attr__('Slide 2','esense-functions').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ('VcTabsView' )
) );

/* VC Gallery */
vc_map( array(
	'name' => esc_attr__( 'Image Gallery', 'esense-functions' ),
	'base' => 'vc_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => esc_attr__( 'Content', 'esense-functions' ),
	'description' => esc_attr__( 'Responsive image gallery', 'esense-functions' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Widget title', 'esense-functions' ),
			'param_name' => 'title',
			'description' => esc_attr__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'esense-functions' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Gallery type', 'esense-functions' ),
			'param_name' => 'type',
  			'save_always' => true,
			'value' => array(
				esc_attr__( 'Flex slider fade', 'esense-functions' ) => 'flexslider_fade',
				esc_attr__( 'Flex slider slide', 'esense-functions' ) => 'flexslider_slide',
				esc_attr__( 'Nivo slider', 'esense-functions' ) => 'nivo',
				esc_attr__( 'Nivo slider with thumb nav', 'esense-functions' ) => 'nivo_thumb',
				esc_attr__( 'Image grid', 'esense-functions' ) => 'image_grid',
			),
		"std" => "flexslider_fade",
		'description' => esc_attr__( 'Select gallery type.', 'esense-functions' )
		),
		array(
					"type" => "dropdown",
					"heading" => esc_attr__("Slideshow navigation type", 'esense-functions'),
					"param_name" => "navigation",
  					'save_always' => true,
					"value" => array(
						"Both" => "",
						"Only direction nav" => "nav-dir",	
						"Only pagination" => "nav-pag",
						"No navigation" => "nav-none"
					),
			'description' => esc_attr__( 'Select navigation type for slideshow.', 'esense-functions' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide', 'nivo', 'nivo_thumb' )
			)
				),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Auto rotate slides', 'esense-functions' ),
			'param_name' => 'interval',
  			'save_always' => true,
			'value' => array( 3, 5, 10, 15, esc_attr__( 'Disable', 'esense-functions' ) => 0 ),
		    "std" => 3,
			'description' => esc_attr__( 'Auto rotate slides each X seconds.', 'esense-functions' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide', 'nivo' )
			)
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_attr__( 'Images', 'esense-functions' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_attr__( 'Select images from media library.', 'esense-functions' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Image size', 'esense-functions' ),
			'param_name' => 'img_size',
			'description' => esc_attr__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'esense-functions' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'On click', 'esense-functions' ),
			'param_name' => 'onclick',
  			'save_always' => true,
			'value' => array(
				esc_attr__( 'Open prettyPhoto', 'esense-functions' ) => 'link_image',
				esc_attr__( 'Do nothing', 'esense-functions' ) => 'link_no',
				esc_attr__( 'Open custom link', 'esense-functions' ) => 'custom_link'
			),
			"std" => "link_image",
			'description' => esc_attr__( 'Define action for onclick event if needed.', 'esense-functions' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_attr__( 'Custom links', 'esense-functions' ),
			'param_name' => 'custom_links',
			'description' => esc_attr__( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'esense-functions' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Custom link target', 'esense-functions' ),
			'param_name' => 'custom_links_target',
			'description' => esc_attr__( 'Select where to open  custom links.', 'esense-functions' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'esense-functions' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'esense-functions' )
		)
	)
) );

/* Dynamicpress elements
---------------------------------------------------------- */
// DP Space
		vc_map( array(
			'name' => esc_attr__('Spacer', 'esense-functions'),
			'base' => 'space',
			'class' => '',
		  	'icon' => 'icon-wpb-spacer',
		    'category' =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
		    'description' => esc_attr__('Blank space at a certain height ', 'esense-functions'),
			'params' => array(
				array(
				  "type" => "number",
				  "class" => "",
				  "heading" => esc_attr__("Size in px", 'esense-functions'),
				  "param_name" => "size",
				  "value" => "5",
				  "admin_label" => true,
				  "min"=>"1",
				  "suffix"=>"px"
				)

			)
		) );

// DP Headline
		vc_map( array(
			'name' => esc_attr__('DP Headline', 'esense-functions'),
			'base' => 'headline',
			'class' => '',
		  	'icon' => 'icon-wpb-heading',
		    'category' =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
      		'description' => esc_attr__("Headline block", 'esense-functions'),
			'params' => array(
				array(
					"type" => "dropdown",
					"heading" => esc_attr__("Style", 'esense-functions'),
					"param_name" => "style",
  			'save_always' => true,
					"value" => array(
						"Default" => "",
						"Small underlined" => "heading-line",	
						"Big with subtitle" => "big",
						"Medium underlined" => "medium"
					),
					"description" => "",
				),
			array(
				"type" => "textfield",
				"heading" => esc_attr__("Headline title", 'esense-functions'),
				"param_name" => "content",
				"holder" => "div",
				"value" => "Heading",
				"value" => esc_attr__("This is header", 'esense-functions')
			),
			array(
				"type" => "textfield",
				"heading" => esc_attr__("Headline subtitle", 'esense-functions'),
				"param_name" => "subtitle",
				"admin_label" => true,
				"value" => "",
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Headline alignment", 'esense-functions'),
				"param_name" => "hedaline_alignment",
				"admin_label" => true,
  				'save_always' => true,
				"value" => array(
						"Left" => "headline-align-left",
						"Center" => "headline-align-center",	
						"Right" => "headline-align-right"
					),
				"std" => "headline-align-left",
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Subtitle size", 'esense-functions'),
				"param_name" => "hedaline_subtitle_size",
				"admin_label" => true,
  				'save_always' => true,
				"value" => array(
						"Small" => "subtitle-size-small",
						"Big" => "subtitle-size-big"
					),
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Subtitle position", 'esense-functions'),
				"param_name" => "hedaline_subtitle_position",
  				'save_always' => true,
				"value" => array(
						"Bellow title" => "bellow",
						"Above title" => "above"
					),
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Underline style", 'esense-functions'),
				"param_name" => "underline_style",
  				'save_always' => true,
				"value" => array(
						"Default" => "default",
						"Brush 1" => "brush1",	
						"Brush 2" => "brush2",
						"Brush 3" => "brush3",
						"Brush 4" => "brush4",
						"Brush 5" => "brush5",
						"Wave line" => "line1",
						"Stripped line" => "line2",
						"Dotted line subtle" => "line3",
						"Dotted line bolder" => "line4",
						"None" => "none"
					),
				"dependency" => Array('element' => "style", 'value' => array('big'))
			),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Force custom text color', 'esense-functions' ),
			'param_name' => 'customcolor',
			'description' => esc_attr__( 'Select custom color for header.', 'esense-functions' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Force custom underline/separator color', 'esense-functions' ),
			'param_name' => 'customcolor_u',
			'description' => esc_attr__( 'Select custom color for underline/separator.', 'esense-functions' )
		),
			array(
			  "type" => "textfield",
			  "holder" => "div",
			  "heading" => esc_attr__("Custom CSS class", 'esense-functions'),
			  "param_name" => "cssclass",
			  "description" => ""
    )
			)
		) );

// DP Toggle (FAQ)
vc_map( array(
  "name" => esc_attr__("FAQ", 'esense-functions'),
  "base" => "faq",
  "icon" => "icon-wpb-faq",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Toggle element with icon', 'esense-functions'),
  "params" => array(
    array(
      "type" => "textfield",
      "class" => "toggle_title",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => esc_attr__("FAQ title", 'esense-functions'),
  	  'save_always' => true,
      "description" => esc_attr__("FAQ block title.", 'esense-functions')
    ),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	"value" => "icon-help-circled-1",
	"description" => ""
	),
    array(
      "type" => "textarea_html",
      "class" => "toggle_content",
      "heading" => esc_attr__("FAQ content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("<p>FAQ content goes here, click edit button to change this text.</p>", 'esense-functions'),
      "description" => esc_attr__("FAQ block content.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );
// Progress bar shortcode

vc_map( array(
	'name' => esc_attr__( 'Progress Bar', 'esense-functions' ),
	'base' => 'vc_progress_bar',
	'icon' => 'icon-wpb-graph',
	'category' => esc_attr__( 'Content', 'esense-functions' ),
	'description' => esc_attr__( 'Animated progress bar', 'esense-functions' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Widget title', 'esense-functions' ),
			'param_name' => 'title',
			'description' => esc_attr__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'esense-functions' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_attr__( 'Graphic values', 'esense-functions' ),
			'param_name' => 'values',
			'description' => esc_attr__( 'Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'esense-functions' ),
			'value' => "90|Development,80|Design,70|Marketing"
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Units', 'esense-functions' ),
			'param_name' => 'units',
			'description' => esc_attr__( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'esense-functions' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Bar color', 'esense-functions' ),
			'param_name' => 'bgcolor',
  			'save_always' => true,
			'value' => array(
				esc_attr__( 'Grey', 'esense-functions' ) => 'bar_grey',
				esc_attr__( 'Blue', 'esense-functions' ) => 'bar_blue',
				esc_attr__( 'Turquoise', 'esense-functions' ) => 'bar_turquoise',
				esc_attr__( 'Green', 'esense-functions' ) => 'bar_green',
				esc_attr__( 'Orange', 'esense-functions' ) => 'bar_orange',
				esc_attr__( 'Red', 'esense-functions' ) => 'bar_red',
				esc_attr__( 'Black', 'esense-functions' ) => 'bar_black',
				esc_attr__( 'Custom Color', 'esense-functions' ) => 'custom'
			),
			"std" => "bar_grey",
			'description' => esc_attr__( 'Select bar background color.', 'esense-functions' ),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Bar custom color', 'esense-functions' ),
			'param_name' => 'custombgcolor',
			'description' => esc_attr__( 'Select custom background color for bars.', 'esense-functions' ),
			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_attr__( 'Text custom color', 'esense-functions' ),
			'param_name' => 'customtxtcolor',
			'description' => esc_attr__( 'Select custom text color for bars.', 'esense-functions' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Options', 'esense-functions' ),
			'param_name' => 'options',
			'value' => array(
				esc_attr__( 'Add Stripes?', 'esense-functions' ) => 'striped'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'esense-functions' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'esense-functions' )
		)
	)
) );

// DP Progress bar shortcode
vc_map( array(
		"name" => esc_attr__("DP Progress Bar", 'esense-functions'),
		"base" => "progress_bar",
		"icon" => "icon-wpb-progress_bar",
		"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  		"description" => esc_attr__('Animated progress bar', 'esense-functions'),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Title", 'esense-functions'),
				"admin_label" => true,
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Title Color", 'esense-functions'),
				"param_name" => "titlecolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Percentage", 'esense-functions'),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_attr__("Bar color", 'esense-functions'),
				"param_name" => "barcolor",
				"description" => ""
			)
		)
) );
// Piechart shortcode
vc_map( array(
		"name" => esc_attr__("DP Pie Chart", 'esense-functions'),
		"base" => "piechart",
		"icon" => "icon-wpb-pie-chart",
		"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => esc_attr__("Size", 'esense-functions'),
				 "description" => "Size of chart in px",
				 "param_name" => "size",
				 "value" => "200",
				 "min"=>"50",
				 "suffix"=>"px"
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => esc_attr__("Bar line width", 'esense-functions'),
				"param_name" => "linewidth",
				 "value" => "5",
				 "min"=>"1",
				 "suffix"=>"px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Percentage", 'esense-functions'),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Percent color", 'esense-functions'),
				"param_name" => "percentcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Bar color", 'esense-functions'),
				"param_name" => "barcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Track color", 'esense-functions'),
				"param_name" => "trackcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Text color", 'esense-functions'),
				"param_name" => "textcolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Title", 'esense-functions'),
				"param_name" => "title",
				"admin_label" => true,
			  	"value" => esc_attr__("Pie Chart title", 'esense-functions'),
				"description" => ""
			),
			array(
			  "type" => "textarea_html",
			  "heading" => esc_attr__("Description", 'esense-functions'),
			  "param_name" => "content",
			  "value" => esc_attr__("<p>I am Pie Chart description.</p>", 'esense-functions')
			  
    ),
			$add_dp_animation,
	)
) );

// Piechart 2 shortcode
vc_map( array(
		"name" => esc_attr__("DP Pie Chart 2", 'esense-functions'),
		"base" => "piechart2",
		"icon" => "icon-wpb-pie-chart",
		"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
		"allowed_container_element" => 'vc_row',
      	"description" => esc_attr__("Chart with background", 'esense-functions'),
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => esc_attr__("Size", 'esense-functions'),
				 "description" => "Size of chart in px",
				 "param_name" => "size",
				 "value" => "200",
				 "min"=>"50",
				 "suffix"=>"px"
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => esc_attr__("Bar line width", 'esense-functions'),
				"param_name" => "linewidth",
				 "value" => "5",
				 "min"=>"1",
				 "suffix"=>"px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Percentage", 'esense-functions'),
				"admin_label" => true,
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Percent color", 'esense-functions'),
				"param_name" => "percentcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Bar color", 'esense-functions'),
				"param_name" => "barcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Track color", 'esense-functions'),
				"param_name" => "trackcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Background color", 'esense-functions'),
				"param_name" => "bgcolor",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Text color", 'esense-functions'),
				"param_name" => "textcolor",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Title", 'esense-functions'),
				"admin_label" => true,
				"param_name" => "title",
			  	"value" => esc_attr__("Pie Chart title", 'esense-functions'),
				"description" => ""
			),
			array(
			  "type" => "textarea_html",
			  "heading" => esc_attr__("Description", 'esense-functions'),
			  "param_name" => "content",
			  "value" => esc_attr__("<p>I am Pie Chart description.</p>", 'esense-functions'),
    ),
			$add_dp_animation,
	)
) );
/* Dp Pricing column
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("Pricing Column", 'esense-functions'),
  "base" => "pricing_column",
  "icon" => "icon-wpb-price-table",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Pricing column for Pricing Table ', 'esense-functions'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
	  "admin_label" => true,
      "param_name" => "title"
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Subitle", 'esense-functions'),
	  "admin_label" => true,
      "param_name" => "subtitle"
    ),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Column style", 'esense-functions'),
	  "param_name" => "column_style",
  	  'save_always' => true,
	  "value" => array(
		  "Default" => "",	
		  "Highlighted" => "premium",
		  "Highlighted on hover" => "highlighted",
		  "Custom" => "custom"
		  ),
	 "description" => ""
			),
	array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Highlight initialy?', 'esense-functions' ),
			'param_name' => 'inistate',
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' ),
			"description" => esc_attr__('Check this box if you will highlight this column on page load.','esense-functions'),
		    "dependency" => Array('element' => "column_style", 'value' => array('highlighted'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Price background color", 'esense-functions'),
	  "param_name" => "price_bgcolor",
	  "value" => "",
	  "description" => esc_attr__("Select price area background color", 'esense-functions'),
	  "dependency" => Array('element' => "column_style", 'value' => array('custom'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Price text color", 'esense-functions'),
	  "param_name" => "price_txtcolor",
	  "value" => "#fff",
	  "description" => esc_attr__("Select price area text color", 'esense-functions'),
	  "dependency" => Array('element' => "column_style", 'value' => array('custom'))
	),
	array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Use image or icon?', 'esense-functions' ),
			'param_name' => 'useimage',
			'group' => 'Additional Icon/Image Settings',
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' ),
			"description" => esc_attr__('Check this box if you will use additional icon or image in this column','esense-functions')
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Image type", 'esense-functions'),
	  "param_name" => "image_type",
	  'group' => 'Additional Icon/Image Settings',
 	  'save_always' => true,
	  "value" => array(
		  "Icon" => "selector",	
		  "Full width image" => "image"
		  ),
      "std" => "selector",
	  "description" => esc_attr__("Use an existing font icon or upload a custom image.", 'esense-functions'),
	  "dependency" => Array("element" => "useimage","value" => array("true")),
			),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	'group' => 'Additional Icon/Image Settings',
	"description" => "",
	"dependency" => Array("element" => "image_type","value" => array("selector")),
	),
	array(
								"type" => "number",
								"class" => "",
								"heading" => esc_attr__("Icon size", 'esense-functions'),
								"param_name" => "icon_size",
								'group' => 'Additional Icon/Image Settings',
								"value" => 48,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"dependency" => Array("element" => "image_type","value" => array("selector")),
		),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Icon Color", 'esense-functions'),
								"param_name" => "icon_color",
	  							'group' => 'Additional Icon/Image Settings',
								"value" => "#2e2a27",
								"description" => esc_attr__("Select background color for icon.", 'esense-functions'),	
								"dependency" => Array("element" => "image_type","value" => array("selector")),
			),
	array(
								"type" => "dropdown",
								"class" => "",
								"heading" => esc_attr__("Icon Badge Style", 'esense-functions'),
								"param_name" => "icon_style",
  								'save_always' => true,
								'group' => 'Additional Icon/Image Settings',
								"value" => array(
									"No badge" => "",
									"Circle" => "circle",
									"Square" => "square"
								),
								"dependency" => Array("element" => "image_type","value" => array("selector")),
	  ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Badge Background Color", 'esense-functions'),
								"param_name" => "icon_badge_color",
								'group' => 'Additional Icon/Image Settings',
								"value" => "#ffffff",
								"description" => esc_attr__("Select background color for icon.", 'esense-functions'),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square")),
			),
	array(
								"type" => "attach_image",
								"class" => "",
								"heading" => esc_attr__("Upload Image:", 'esense-functions'),
								"param_name" => "image",
	  							'group' => 'Additional Icon/Image Settings',
								"value" => "",
								"description" => esc_attr__("Upload the custom image icon.", 'esense-functions'),
								"dependency" => Array("element" => "image_type","value" => array("image")),
		),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Price", 'esense-functions'),
      "param_name" => "price",
	  "admin_label" => true,
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Currency", 'esense-functions'),
      "param_name" => "currency"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Currency position", 'esense-functions'),
				"param_name" => "currencypos",
  				'save_always' => true,
				"value" => array(
					"After price" => "after",
					"Before price" => "before",	
				),
				"std" => "after",
				"description" => ""
	),
	
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Price subtitle", 'esense-functions'),
      "param_name" => "price_sub"
    ),
	array(
				"type" => "textarea_html",
				"class" => "",
				"holder" => "div",
				"heading" => esc_attr__("Column contentt", 'esense-functions'),
				"param_name" => "content",
				"description" => "",
				"value" => esc_attr__("Enter column content here", 'esense-functions')
	),
	array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Use arrowed style?', 'esense-functions' ),
			'param_name' => 'arrowed',
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' ),
			"description" => "Check this box if you will use down arrow bellow price block",
	),
	array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Use ribbon?', 'esense-functions' ),
			'param_name' => 'ribbon',
			'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' ),
			"description" => "Check this box if you will use additional ribbon in right top corner",
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Ribbon text", 'esense-functions'),
      "param_name" => "ribbon_text",
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
    ),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Ribbon background color", 'esense-functions'),
	  "param_name" => "ribbon_bgcolor",
	  "value" => "#88B700",
	  "description" => esc_attr__("Select ribbon background color", 'esense-functions'),
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Ribbon text color", 'esense-functions'),
	  "param_name" => "ribbon_txtcolor",
	  "value" => "#fff",
	  "description" => esc_attr__("Select ribbon text color", 'esense-functions'),
	  "dependency" => Array('element' => "ribbon", 'value' => array('true'))
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Link", 'esense-functions'),
      "param_name" => "link",
	  "description" => "Link for button. If you leave this field blank button will be not displayed.",
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Button text", 'esense-functions'),
      "param_name" => "button_txt",
	  "value" => esc_attr__("Buy Now", 'esense-functions')
    ),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_attr__("Button style ",'esense-functions'),
				"param_name" => "button_style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => esc_attr__("Select button style.",'esense-functions')
			),

	
  )
) );

/* DP Button */
vc_map( array(
		"name" => esc_attr__("DP Button", 'esense-functions'),
		"base" => "button",
		"category" => esc_attr__('by Dynamicpress', 'esense-functions'),
		"icon" => "icon-wpb-esense-button",
		"description" => esc_attr__('Custom button with icon ', 'esense-functions'),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Size", 'esense-functions'),
				"param_name" => "size",
  				'save_always' => true,
				"value" => array(
					"Small" => "small",	
					"Large" => "large",	
					"Extra Large" => "extralarge",
					"Extra Large Bold with Subtitle" => "extralargebold",
					
				),
				"std" => "small",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Title", 'esense-functions'),
				"param_name" => "content",
				"description" => "",
	  			"admin_label" => true,
				"value" => esc_attr__("Button title", 'esense-functions')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Subtitle", 'esense-functions'),
				"param_name" => "subtitle",
				"description" => "",
	  			"admin_label" => true,
				"value" => esc_attr__("Button subtitle", 'esense-functions'),
				"dependency" => Array('element' => "size", 'value' => array('extralargebold'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Style", 'esense-functions'),
				"param_name" => "style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"-------------------------------------" => "",
					"Custom" => "custom"
				),
				"description" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button background color", 'esense-functions'),
				"param_name" => "bgcolor",
				"value" => "",
				"description" => esc_attr__("Select button background color", 'esense-functions'),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button text color", 'esense-functions'),
				"param_name" => "textcolor",
				"value" => "",
				"description" => esc_attr__("Select button text color", 'esense-functions'),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button hover state background color", 'esense-functions'),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => esc_attr__("Select hover state background color", 'esense-functions'),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Hover state text color", 'esense-functions'),
				"param_name" => "htextcolor",
				"value" => "",
				"description" => esc_attr__("Select hover state text color", 'esense-functions'),
				"dependency" => Array('element' => "style", 'value' => array('custom'))
			),			
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => esc_attr__("Icon", 'esense-functions'),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Button alignment", 'esense-functions'),
				"param_name" => "align",
  				'save_always' => true,
				"value" => array(
					"None" => "",
					"Center" => "center",	
					"Right" => "right"
				),
				"description" => "",
			),
			$add_dp_animation,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Link", 'esense-functions'),
				"param_name" => "link",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Open in", 'esense-functions'),
				"param_name" => "linktarget",
  				'save_always' => true,
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent",
					"Lightbox" => "lightbox"
				),
				"description" => "",
			)
		)
) );

/* Button Group */

vc_map( array(
    "name" => esc_attr__("DP Button Group", 'esense-functions'),
    "base" => "buttongroup",
	"icon" => "icon-wpb-buttongroup",
    "as_parent" => array('only' => 'buttongroup_item,buttongroup_sep,buttongroup_dropdown'),
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  esc_attr__('Bootsrap style button group container', 'esense-functions'),
    "params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Size", 'esense-functions'),
				"param_name" => "size",
  				'save_always' => true,
				"value" => array(
					"Small" => "",	
					"Large" => "large",	
					"Extra Large" => "extralarge"
				),
				"description" => ""
			),
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => esc_attr__("Border radius", 'esense-functions'),
				"description" => esc_attr__("Border radius in px ", 'esense-functions'),
				"param_name" => "radius",
				 "value" => "4",
				 "min"=>"0",
				 "suffix"=>"px"
			),
			array(
				"type" => "dropdown",
				"heading" => esc_attr__("Group Alignment", 'esense-functions'),
				"param_name" => "align",
  				'save_always' => true,
				"value" => array(
					"Center" => "center",
					"Left" => "left",
					"Right" => "right"
				),
				"std" => "center",
				"description" => "",
			),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Force equal width of the buttons in group?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "equal_width"
		),
    ),
    "js_view" => 'VcColumnView'
) );

/* DP Group Button */
vc_map( array(
		"name" => esc_attr__("Button", 'esense-functions'),
		"base" => "buttongroup_item",
		"category" => esc_attr__('by Dynamicpress', 'esense-functions'),
		"icon" => "icon-wpb-buttongroup-item",
		"description" => esc_attr__('Button in button group', 'esense-functions'),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Text", 'esense-functions'),
				"param_name" => "text",
				"description" => "",
	  			"admin_label" => true,
				"value" => esc_attr__("Button Text", 'esense-functions')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Subtext", 'esense-functions'),
				"param_name" => "subtext",
				"description" => "",
				"value" => ""
			),
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => esc_attr__("Icon", 'esense-functions'),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Icon position", 'esense-functions'),
				"param_name" => "icon_position",
  				'save_always' => true,
				"value" => array(
					"Left" => "left",	
					"Right" => "right"
				),
				"std" => "left",
				"description" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button background color", 'esense-functions'),
				"param_name" => "bgcolor",
				"value" => "#E57D04",
				"description" => esc_attr__("Select button background color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Text Color", 'esense-functions'),
				"param_name" => "textcolor",
				"value" => "#fff",
				"description" => esc_attr__("Select button text color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Border Color", 'esense-functions'),
				"param_name" => "bordercolor",
				"value" => "#E57D04",
				"description" => esc_attr__("Select button border color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "#2e2a27",
				"heading" => esc_attr__("Button hover background color", 'esense-functions'),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => esc_attr__("Select button hover background color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button hover text Color", 'esense-functions'),
				"param_name" => "htextcolor",
				"value" => "#fff",
				"description" => esc_attr__("Select button hover text color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Hover Border Color", 'esense-functions'),
				"param_name" => "hbordercolor",
				"value" => "#2e2a27",
				"description" => esc_attr__("Select button hover border color", 'esense-functions')
			),			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Link", 'esense-functions'),
				"param_name" => "link",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Open in", 'esense-functions'),
				"param_name" => "linktarget",
  				'save_always' => true,
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent"
				),
				"std" => "_self",
				"description" => "",
			),
		)
) );

/* DP Group Dropdown Button */
vc_map( array(
		"name" => esc_attr__("Dropdown Button", 'esense-functions'),
		"base" => "buttongroup_dropdown",
		"category" => esc_attr__('by Dynamicpress', 'esense-functions'),
		"icon" => "icon-wpb-buttongroup-item",
		"description" => esc_attr__('Dropdown Button in button group', 'esense-functions'),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Text", 'esense-functions'),
				"param_name" => "text",
				"description" => "",
	  			"admin_label" => true,
				"value" => esc_attr__("Button Text", 'esense-functions')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Button Subtext", 'esense-functions'),
				"param_name" => "subtext",
				"description" => "",
				"value" => ""
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button background color", 'esense-functions'),
				"param_name" => "bgcolor",
				"value" => "#E57D04",
				"description" => esc_attr__("Select button background color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Text Color", 'esense-functions'),
				"param_name" => "textcolor",
				"value" => "#fff",
				"description" => esc_attr__("Select button text color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Border Color", 'esense-functions'),
				"param_name" => "bordercolor",
				"value" => "#E57D04",
				"description" => esc_attr__("Select button border color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "#2e2a27",
				"heading" => esc_attr__("Button hover background color", 'esense-functions'),
				"param_name" => "hbgcolor",
				"value" => "",
				"description" => esc_attr__("Select button hover background color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button hover text Color", 'esense-functions'),
				"param_name" => "htextcolor",
				"value" => "#fff",
				"description" => esc_attr__("Select button hover text color", 'esense-functions')
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Button Hover Border Color", 'esense-functions'),
				"param_name" => "hbordercolor",
				"value" => "#2e2a27",
				"description" => esc_attr__("Select button hover border color", 'esense-functions')
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_attr__("Dropdown Mode", 'esense-functions'),
			  "param_name" => "mode",
			  "group" => "Dropdown Content",
  			  'save_always' => true,
			  "value" => array(
					"On click" => "onclick",	
					"On hover" => "onhover"
				),
				"std" => "onclick",
				"description" => "Select dropdown expand event"
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_attr__("Dropdown Source", 'esense-functions'),
			  "param_name" => "source_type",
			  "group" => "Dropdown Content",
  			  'save_always' => true,
			  "value" => array(
					"Menu" => "menu",	
					"HTML content" => "html"
				),
				"std" => "menu",
				"description" => "Select dropdown content type"
			),
			array(
			  "type" => "dropdown",
			  "heading" => esc_attr__("Menu", 'esense-functions'),
			  "param_name" => "menu",
			  "group" => "Dropdown Content",
  			  'save_always' => true,
			  "value" => $menus,
			  "description" => "Select menu from available menus list",
			  'dependency' => array( 'element' => 'source_type', 'value' => array('menu'))	  
			),
			array(
			  "type" => "textarea_html",
			  "heading" => esc_attr__("HTML content", 'esense-functions'),
			  "param_name" => "content",
			  "group" => "Dropdown Content",
			  "value" => esc_attr__("This is sample dropdown HTML", 'esense-functions'),
			  'dependency' => array( 'element' => 'source_type', 'value' => array('html'))	  
			),
		
		)
) );

/* DP Group Button Separator */
vc_map( array(
		"name" => esc_attr__("Button Separator", 'esense-functions'),
		"base" => "buttongroup_sep",
		"category" => esc_attr__('by Dynamicpress', 'esense-functions'),
		"icon" => "icon-wpb-buttongroup-sep",
		"description" => esc_attr__('Button separator', 'esense-functions'),
    	"as_child" => array('only' => 'buttongroup'), 
		"params" => array(
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => esc_attr__("Separator width", 'esense-functions'),
				"description" => esc_attr__("Widt of separator in px ", 'esense-functions'),
				"param_name" => "s_width",
				 "value" => "2",
				 "min"=>"0",
				 "suffix"=>"px"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Separator background color", 'esense-functions'),
				"param_name" => "s_bgcolor1",
				"value" => "#fff",
				"description" => esc_attr__("Select separator background color", 'esense-functions')
			),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use round badge in separator?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "use_badge"
		),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Separator badge text Text", 'esense-functions'),
				"param_name" => "s_text",
				"description" => "",
	  			"admin_label" => true,
				"value" => esc_attr__("or", 'esense-functions'),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Separator background color", 'esense-functions'),
				"param_name" => "s_bgcolor",
				"value" => "#fff",
				"description" => esc_attr__("Select separator background color", 'esense-functions'),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Separator Text Color", 'esense-functions'),
				"param_name" => "s_textcolor",
				"value" => "#2e2a27",
				"description" => esc_attr__("Select separator text color", 'esense-functions'),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Separator Border Color", 'esense-functions'),
				"param_name" => "s_bordercolor",
				"value" => "#fff",
				"description" => esc_attr__("Select separator border color", 'esense-functions'),
				'dependency' => array( 'element' => 'use_badge', 'not_empty' => true)
			),
		)
) );

class WPBakeryShortCode_buttongroup extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_buttongroup_item extends WPBakeryShortCode {
}
class WPBakeryShortCode_buttongroup_sep extends WPBakeryShortCode {
}
class WPBakeryShortCode_buttongroup_dropdown extends WPBakeryShortCode {
}


/* Team box
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("Team box", 'esense-functions'),
  "base" => "teambox",
  "icon" => "icon-wpb-teambox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Team member presentation box', 'esense-functions'),
  "params" => array(
   array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Style", 'esense-functions'),
  	  'save_always' => true,
	  "param_name" => "type",
			"value" => array(
				"Default" => "",
				"VCard" => "vcard",
				"Animated Flipbox" => "animated"
			),
	  "description" => ""
	),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Highlited teambox?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "highligth",
				"dependency" => Array('element' => "type", 'value' => array('vcard'))		),
	array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Back side background color", 'esense-functions'),
				"param_name" => "back_bgcolor",
				"value" => "#2e2a27",
				"description" => esc_attr__("Select back side background color", 'esense-functions'),
				"dependency" => Array('element' => "type", 'value' => array('animated'))
		),			
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Name", 'esense-functions'),
      "param_name" => "name",
	  "admin_label" => true,
      "value" => esc_attr__("John Smith", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Position", 'esense-functions'),
	  "admin_label" => true,
      "param_name" => "position",
      "value" => esc_attr__("Chief Executive Officer / CEO", 'esense-functions')
    ),
	 array(
      "type" => "attach_image",
      "heading" => esc_attr__("Image", 'esense-functions'),
      "param_name" => "imgurl",
      "value" => "",
      "description" => esc_attr__("Select image from media library.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Twitter link", 'esense-functions'),
      "param_name" => "twitter",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Facebook link", 'esense-functions'),
      "param_name" => "facebook",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Google+ link", 'esense-functions'),
      "param_name" => "gplus",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Linkedin link", 'esense-functions'),
      "param_name" => "linkedin",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("RSS link", 'esense-functions'),
      "param_name" => "rss",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Flickr", 'esense-functions'),
      "param_name" => "flickr",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Dribble link", 'esense-functions'),
      "param_name" => "dribble",
	  "description" => esc_attr__("If you leave this field blank link will be not displayed", 'esense-functions')
    ),
    array(
      "type" => "textarea_html",
      "heading" => esc_attr__("Description", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("<p>Team member activity description</p>", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

// Counter shortcode
vc_map( array(
		"name" => esc_attr__("DP Counter", 'esense-functions'),
		"base" => "counter",
		"icon" => "icon-wpb-counter",
		"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
		"allowed_container_element" => 'vc_row',
      	"description" => esc_attr__("Animated counter", 'esense-functions'),
		"params" => array(
			 array(
			  "type" => "dropdown",
			  "class" => "",
			  "heading" => esc_attr__("General style", 'esense-functions'),
			  "param_name" => "counter_style",
  		'save_always' => true,
					"value" => array(
						"Vertical (default)" => "",
						"Horizontal" => "horizontal"
					),
			  "description" => "",
			  'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Counter title", 'esense-functions'),
				"param_name" => "content",
	  			"admin_label" => true,
				"value" => esc_attr__("Counter title", 'esense-functions')
			),
			array(
				"type" => "icon_selector",
				"class" => "",
				"heading" => esc_attr__("Icon", 'esense-functions'),
				"param_name" => "icon",
	  			"admin_label" => true
				),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Icon color", 'esense-functions'),
				"param_name" => "iconcolor",
				"description" => "",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Icon badge color", 'esense-functions'),
				"param_name" => "badgecolor",
				"description" => "",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			 array(
			  "type" => "dropdown",
			  "class" => "",
			  "heading" => esc_attr__("Icon badge style", 'esense-functions'),
			  "param_name" => "badge_style",
			   'save_always' => true,
					"value" => array(
						"No badge" => "",
						"Rounded" => "rounded",	
						"Rounded bordered" => "rounded bordered",	
						"Diamond" => "diamond",
						"Diamond bordered" => "diamond bordered"
					),
			  "description" => "",
			  'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				 "type" => "number",
				 "class" => "",
				 "heading" => esc_attr__("Icon fontsize", 'esense-functions'),
				"description" => esc_attr__("Icon fontsize in px ", 'esense-functions'),
				"param_name" => "iconfontsize",
				 "value" => "60",
				 "min"=>"10",
				 "suffix"=>"px",
				'dependency' => array( 'element' => 'icon', 'not_empty' => true)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Counter number value", 'esense-functions'),
				"param_name" => "number"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Number value by witch animation will be stopped", 'esense-functions'),
				"param_name" => "animate_stop",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_attr__("Number sufix", 'esense-functions'),
				"param_name" => "number_sufix",
				"description" => "Text after animated number (eg K)"
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Number color", 'esense-functions'),
				"param_name" => "numbercolor",
				"description" => ""
			),
			array(
				"type" => "number",
				"class" => "",
				"heading" => esc_attr__("Number fontsize", 'esense-functions'),
				"param_name" => "fontsize",
				 "value" => "70",
				 "min"=>"10",
				 "suffix"=>"px",
				"description" => esc_attr__("Number fontsize in px", 'esense-functions')
			),

			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_attr__("Title color color", 'esense-functions'),
				"param_name" => "titlecolor",
				"description" => ""
			),
			array(
			  "type" => "textfield",
			  "holder" => "div",
			  "heading" => esc_attr__("Custom CSS class", 'esense-functions'),
			  "param_name" => "cssclass",
			  "description" => ""
    )
	)
) );

/* Testimonial
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("Testimonial", 'esense-functions'),
  "base" => "testimonial",
  "icon" => "icon-wpb-testimonial",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Testimonial with client image', 'esense-functions'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Name", 'esense-functions'),
      "param_name" => "name",
  	  'save_always' => true,
	  "admin_label" => true,
      "value" => esc_attr__("John Smith", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Position", 'esense-functions'),
  	  'save_always' => true,
      "param_name" => "position",
      "value" => esc_attr__("CEO", 'esense-functions')
    ),
	 array(
      "type" => "attach_image",
      "heading" => esc_attr__("Image", 'esense-functions'),
      "param_name" => "img",
      "value" => "",
      "description" => esc_attr__("Select image from media library.", 'esense-functions')
    ),
    array(
      "type" => "textarea_html",
      "heading" => esc_attr__("Testimonial content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Client testimonial content.", 'esense-functions')
    ),
	$add_dp_animation,	
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* Alert box
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("Notification Box", 'esense-functions'),
  "base" => "box",
  "icon" => "icon-wpb-alertbox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Box with notifications', 'esense-functions'),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Type", 'esense-functions'),
	  "param_name" => "type",
	   'save_always' => true,
			"value" => array(
				"Success" => "success",	
				"Warning" => "warning",
				"Error" => "error",
				"Notice" => "notice"
			),
	  "std" => "success",
	  "description" =>  esc_attr__('Select box style', 'esense-functions')
	),

    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
      "value" => esc_attr__("Success!", 'esense-functions')
    ),
	array(
	"type" => "icon_selector",
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	"admin_label" => true,
	"description" =>  esc_attr__('Select icon to display before message', 'esense-functions')
	),	 
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => esc_attr__("Content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Your message comes here.", 'esense-functions')
    ),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Sticky?", 'esense-functions'),
	  "param_name" => "sticky",
      'save_always' => true,
	  "value" => array(
				"No" => "no",	
				"Yes" => "yes"
			),
	  "std" => "no",
	  "description" =>  esc_attr__('If selected yes box will be closeable', 'esense-functions')
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* DP Gallery */
vc_map( array(
    "name" => esc_attr__("DP Gallery", 'esense-functions'),
    "base" => "dp_gallery",
	"icon" => "icon-wpb-esense-gallery",
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
	"description" =>  esc_attr__('Simple image grid gallery with lightbox', 'esense-functions'),
    "params" => array(
		array(
			'type' => 'attach_images',
			'heading' => esc_attr__( 'Images', 'esense-functions' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_attr__( 'Select images from media library.', 'esense-functions' )
		),
	   array(
			"type" => "dropdown",
			"heading" => esc_attr__("Columns count", 'esense-functions'),
			"param_name" => "columns",
			"admin_label" => true,
  			'save_always' => true,
			"value" => array(
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5",
						"6" => "6",
						"8" => "8"		
				),
		   "std" => "2",
		  ),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use nomargin style?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "nomargin"
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use Grayscale images?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "grayscale"
		),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'esense-functions'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
        )
    )
) );

class WPBakeryShortCode_dp_gallery extends WPBakeryShortCode {

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		// Compatibility fixes
		$old_names = array( 'yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange' );
		$new_names = array( 'alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning' );
		$value = str_ireplace( $old_names, $new_names, $value );
		$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
		$type = isset( $param['type'] ) ? $param['type'] : '';
		$class = isset( $param['class'] ) ? $param['class'] : '';

		if ( isset( $param['holder'] ) == true && $param['holder'] !== 'hidden' ) {
			$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}
		if ( $param_name == 'images' ) {
			$images_ids = empty( $value ) ? array() : explode( ',', trim( $value ) );
			$output .= '<ul class="attachment-thumbnails' . ( empty( $images_ids ) ? ' image-exists' : '' ) . '" data-name="' . $param_name . '">';
			foreach ( $images_ids as $image ) {
				$img = wpb_getImageBySize( array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ) );
				$output .= ( $img ? '<li>' . $img['thumbnail'] . '</li>' : '<li><img width="150" height="150" test="' . $image . '" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail" alt="" title="" /></li>' );
			}
			$output .= '</ul>';
			$output .= '<a href="#" class="column_edit_trigger' . ( ! empty( $images_ids ) ? ' image-exists' : '' ) . '">' . esc_attr__( 'Add images', 'esense-functions' ) . '</a>';

		}
		return $output;
	}
}

/* DP Social Links */
vc_map( array(
    "name" => esc_attr__("DP Social Links", 'esense-functions'),
    "base" => "social_links",
	"icon" => "icon-wpb-social-icons",
    "as_parent" => array('only' => 'social_link'),
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  esc_attr__('Social icons block', 'esense-functions'),
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Badge type", 'esense-functions'),
			"param_name" => "type",
  			'save_always' => true,
			"value" => array(
					"Square" => "",
					"Rounded" => "rounded",
					"Diamond" => "diamond"	
				)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_attr__("Custom icon color", 'esense-functions'),
			"param_name" => "icon_color",
			"value" => "",
			"description" => esc_attr__("If you leave it blank icons will be by default #333", 'esense-functions'),
		),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'esense-functions'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
        )
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => esc_attr__("DP Social Icon", 'esense-functions'),
    "base" => "social_link",
	"icon" => "icon-wpb-icon",
    "content_element" => true,
	"description" =>  esc_attr__('Single social icon', 'esense-functions'),
    "as_child" => array('only' => 'social_links'), 
    "params" => array(		
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Icon type", 'esense-functions'),
			"param_name" => "type",
			"admin_label" => true,
			"std" => "facebook",
			'save_always' => true,
			"value" => array(
					"Facebook" => "facebook",
					"Twitter" => "twitter",
					"Linkedin" => "linkedin",		
					"Google Plus" => "gplus",		
					"Spotify" => "spotify",		
					"Yahoo" => "yahoo",		
					"Amazon" => "amazon",		
					"Appstore" => "appstore",		
					"Paypal" => "paypal",		
					"Blogger" => "blogger",		
					"Evernote" => "evernote",		
					"Instagram" => "instagram",		
					"Pinterest" => "pinterest",		
					"Dribbble" => "dribbble",		
					"Flickr" => "flickr",		
					"Youtube" => "youtube",		
					"Vimeo" => "vimeo",		
					"RSS" => "rss",		
					"Steam" => "steam",		
					"Tumblr" => "tumblr",		
					"Github" => "github",		
					"Delicious" => "delicious",		
					"Reddit" => "reddit",		
					"Lastfm" => "lastfm",		
					"Digg" => "digg",		
					"Forrst" => "forrst",		
					"Stumbleupon" => "stumbleupon",		
					"Wordpress" => "wordpress",		
					"Xing" => "xing",		
					"Dropbox" => "dropbox",		
					"Fivehundredpx" => "fivehundredpx",
					"Vkontakte" => "vkontakte",
					"Viadeo" => "viadeo"
							
				)
		),
        array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Title", 'esense-functions'),
		  "param_name" => "title",
		  "description" =>  esc_attr__("If you wish add title of link displayed in tooltip type it here", 'esense-functions')
		),
        array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Icon link", 'esense-functions'),
		  "param_name" => "link"
		)
    )
) );

class WPBakeryShortCode_social_links extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_social_link extends WPBakeryShortCode {
}

/* DP Google map */
vc_map( array(
    "name" => esc_attr__("DP Google Map", 'esense-functions'),
    "base" => "dp_googlemap",
	"icon" => "icon-wpb-gmap",
    "as_parent" => array('only' => 'dp_googlemap_marker'),
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  esc_attr__('Google map with multiple markers', 'esense-functions'),
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Map center determined by", 'esense-functions'),
			"param_name" => "centertype",
			"std" => "address",
		    'save_always' => true,
			"value" => array(
					"Address" => "address",
					"Latitude and Longtitude" => "coordinates"	
				)
		),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Map center address", 'esense-functions'),
            "param_name" => "address",
            "description" => esc_attr__("Enter address of map center point.", 'esense-functions'),
			"dependency" => Array("element" => "centertype","value" => array("address")),			
        ),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Map center latitude", 'esense-functions'),
            "param_name" => "lat",
            "description" => esc_attr__("Enter latitude of map center point. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", 'esense-functions'),
			"dependency" => Array("element" => "centertype","value" => array("coordinates"))			
        ),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Map center longtitude", 'esense-functions'),
            "param_name" => "long",
            "description" => esc_attr__("Enter longtitude of map center point. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", 'esense-functions'),
			"dependency" => Array("element" => "centertype","value" => array("coordinates"))
        ),
		array(
				"type" => "number",
				"class" => "",
				"heading" => esc_attr__("Map height", 'esense-functions'),
				"param_name" => "height",
				"value" => 300,
				"suffix" => "px",
				"min" => 0,
				"description" => esc_attr__("Map width is allways 100% of parent container but width must be determined.", 'esense-functions'),
		),
		array(
				"type" => "number",
				"class" => "",
				"heading" => esc_attr__("Zoom Level", 'esense-functions'),
				"param_name" => "zoom",
				"value" => 14,
				"min" => 0,
				"max" => 19,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Use Map Control?", 'esense-functions'),
			"param_name" => "mapcontrol",
			"std" => "Y",
  			'save_always' => true,
			"value" => array(
					"Yes" => "Y",
					"No" => "N"	
				)
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable map type control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "maptypecontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable Pan Control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "pancontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable zoom control?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "zoomcontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Disable streetview button?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "streetviewcontrol",
				'dependency' => array( 'element' => 'mapcontrol', 'value' => 'Y')
		),
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Custom map style", 'esense-functions'),
			"param_name" => "mapstyle",
			"std" => "no",
  			'save_always' => true,
			"value" => array(
					"Default Google style" => "no",
					"Light Gray" => "lightgray",
					"Dark Gray" => "darkgray",
					"Night Blue" => "nightblue",
					"Fresh" => "fresh",
					"Pastel" => "pastel",
					"Vintage" => "vintage",	
					"Apple Maps style" => "aple",
					"Custom" => "custom"
				)
		),
		array(
                    "heading"            => "Custom Map Theme",
                    "type"               => "textarea_raw_html",
                    "param_name"         => "customtheme",
                    "value"              => "",
                    "description"        => "Custom map theme in jason format. For more themes see <a href=\"http://snazzymaps.com/\" target=\"_blank\">http://snazzymaps.com</a>",
					'dependency' => array( 'element' => 'mapstyle', 'value' => 'custom')
                ),

    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => esc_attr__("DP Google Map Location", 'esense-functions'),
    "base" => "dp_googlemap_marker",
	"icon" => "icon-wpb-marker",
    "content_element" => true,
	"description" =>  esc_attr__('Google map location', 'esense-functions'),
    "as_child" => array('only' => 'dp_googlemap'), 
    "params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Location determined by", 'esense-functions'),
			"param_name" => "locationtype",
			"std" => "address",
  			'save_always' => true,
			"value" => array(
					"Address" => "address",
					"Latitude and Longtitude" => "coordinates"	
				)
		),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Location address", 'esense-functions'),
            "param_name" => "address",
            "description" => esc_attr__("Enter address of location.", 'esense-functions'),
			"dependency" => Array("element" => "locationtype","value" => array("address")),			
        ),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Location latitude", 'esense-functions'),
            "param_name" => "lat",
            "description" => esc_attr__("Enter latitude of location. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", 'esense-functions'),
			"dependency" => Array("element" => "locationtype","value" => array("coordinates"))			
        ),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Location longtitude", 'esense-functions'),
            "param_name" => "long",
            "description" => esc_attr__("Enter longtitude of location. You can use this <a href='http://www.latlong.net/' target='_blank'>link</a>", 'esense-functions'),
			"dependency" => Array("element" => "locationtype","value" => array("coordinates"))
        ),
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Marker type", 'esense-functions'),
			"param_name" => "markertype",
			"std" => "simple",
  			'save_always' => true,
			"value" => array(
					"Simple marker" => "simple",
					"Marker with icon" => "icon",
					"Custom image" => "custom"	
				)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_attr__("Marker color", 'esense-functions'),
			"param_name" => "markercolor",
			"value" => "",
			"description" => esc_attr__("Select color for marker", 'esense-functions'),
			"dependency" => Array("element" => "markertype","value" => array("simple","icon"))
		),
		array(
			"type" => "icon_selector",
			"class" => "",
			"heading" => esc_attr__("Marker Icon", 'esense-functions'),
			"admin_label" => true,
			"param_name" => "icon",
			"description" => "Select icon for marker",
			"dependency" => Array("element" => "markertype","value" => array("icon"))
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => esc_attr__("Icon color", 'esense-functions'),
			"param_name" => "iconcolor",
			"value" => "",
			"description" => esc_attr__("Select color for icon", 'esense-functions'),
			"dependency" => Array("element" => "markertype","value" => array("icon"))
		),
		array(
		  "type" => "attach_image",
		  "heading" => esc_attr__("Custom marker image", 'esense-functions'),
		  "param_name" => "markerimage",
		  "value" => "",
		  "description" => esc_attr__("Select image from media library.", 'esense-functions'),
		  "dependency" => Array("element" => "markertype","value" => array("custom"))
		),
		array(
			"type" => "dropdown",
			"heading" => esc_attr__("Use infobox for marker", 'esense-functions'),
			"group" => "Infobox Setting",
			"param_name" => "infobox",
  			'save_always' => true,
			"std" => "N",
			"value" => array(
					"No" => "N",
					"Yes" => "Y"	
				)
		),
        array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Info Box Title", 'esense-functions'),
		  "group" => "Infobox Setting",
		  "param_name" => "title",
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		),
        array(
		  "type" => "textarea_html",
		  "heading" => esc_attr__("Info Box Content", 'esense-functions'),
		  "group" => "Infobox Setting",
		  "param_name" => "content",
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		),
		array(
		  "type" => "attach_image",
		  "heading" => esc_attr__("Infobox image", 'esense-functions'),
		  "param_name" => "infoboximage",
		  "value" => "",
		  "group" => "Infobox Setting",
		  "description" => esc_attr__("Select image from media library.", 'esense-functions'),
		  "dependency" => Array("element" => "infobox","value" => array("Y"))
		)
	)
) );

class WPBakeryShortCode_dp_googlemap extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_dp_googlemap_marker extends WPBakeryShortCode {
}




/* Lightbox image link */
vc_map( array(
  "name" => esc_attr__("Lightbox thumb", 'esense-functions'),
  "base" => "lightbox",
  "icon" => "icon-wpb-single-image",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Simple image as lightbox link', 'esense-functions'),
  "params" => array(
    array(
      "type" => "attach_image",
      "heading" => esc_attr__("Thumb image", 'esense-functions'),
      "param_name" => "thumb",
      "value" => "",
      "description" => esc_attr__("Select image from media library.", 'esense-functions')
    ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Overlay icon type", 'esense-functions'),
        "param_name" => "hover_icon",
        "admin_label" => true,
		"std" => "zoom",
  		'save_always' => true,
		"value" => array(
					"Zoom" => "zoom",
					"Play" => "play",
					"File" => "file"		
	),
        "description" => esc_attr__("Select icon to display in thumb fancy overlay.", 'esense-functions')
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Lightbox content type", 'esense-functions'),
        "param_name" => "lcontent_type",
        "admin_label" => true,
		"std" => "",
  		'save_always' => true,
		"value" => array(
					"Images" => "images",
					"Video" => "video",
					"Iframe content" => "iframe"		
	),
        "description" => esc_attr__("Select content type to display in lightbox.", 'esense-functions')
      ),
	array(
	  'type' => 'attach_images',
	  'heading' => esc_attr__( 'Images', 'esense-functions' ),
	  'param_name' => 'images',
	  'value' => '',
	  'description' => esc_attr__( 'Select images from media library.', 'esense-functions' ),
	  "dependency" => Array('element' => "lcontent_type", 'value' => array('images'))		
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Video URL (Link to video lightbox video content)", 'esense-functions'),
      "param_name" => "videolink",
      "description" => esc_attr__("Link to video content to display in lightbox.", 'esense-functions'),
	  "dependency" => Array('element' => "lcontent_type", 'value' => array('video'))		
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Iframe content URL", 'esense-functions'),
      "param_name" => "iframelink",
      "description" => esc_attr__("Link to external content to display in lightbox.", 'esense-functions'),
	  "dependency" => Array('element' => "lcontent_type", 'value' => array('iframe'))		
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
      "description" => esc_attr__("Title of image to display in lightbox window", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Description", 'esense-functions'),
      "param_name" => "desc",
      "description" => esc_attr__("Description of image to display in lightbox window", 'esense-functions')
    ),
	$add_dp_animation
  )
));
/* Featured box
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("Featured Box", 'esense-functions'),
  "base" => "featuredbox",
  "icon" => "icon-wpb-servicebox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Box with animated icons', 'esense-functions'),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Type", 'esense-functions'),
	  "param_name" => "type",
 	  'save_always' => true,
			"value" => array(
				"Icon centered" => "centered",	
				"Icon left" => "left-big",				
				"Icon small left" => "left-small",
				"Icon right" => "right-big",
				"Icon small right" => "right-small"
			),
     "std" => "centered",
	  "description" => ""
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Icon badge style", 'esense-functions'),
	  "param_name" => "style",
  	  'save_always' => true,
			"value" => array(
				"Rounded" => "rounded",	
				"Rounded bordered" => "rounded-border",	
				"No badge" => "no-border"
			),
	  "std" => "rounded",
	  "description" => ""
	),
	array(
	"type" => "icon_selector",
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"admin_label" => true,
	"param_name" => "icon",
	"description" => ""
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Custom icon color", 'esense-functions'),
	"param_name" => "icon_color",
	"value" => "",
	"description" => esc_attr__("Select custom color color for this box", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Custom hover state icon color", 'esense-functions'),
	"param_name" => "icon_hcolor",
	"value" => "",
	"description" => esc_attr__("Select custom hover state icon color for this box", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Custom text color", 'esense-functions'),
	"param_name" => "textcolor",
	"value" => "",
	"description" => esc_attr__("Select custom text color for this box", 'esense-functions')
	),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => esc_attr__("Faetured Box", 'esense-functions')
    ),
	 
    array(
      "type" => "textarea_html",
      "heading" => esc_attr__("Content", 'esense-functions'),
	  "holder"      => "div",
      "param_name" => "content",
      "value" => ""
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button link", 'esense-functions'),
      "param_name" => "button_link",
      "description" => esc_attr__("If you leave this foeld blank 'Read more' button will be not dispaled", 'esense-functions')
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button text", 'esense-functions'),
      "param_name" => "button_text"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Button Style", 'esense-functions'),
				"param_name" => "button_style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* Number boxes */

vc_map( array(
  "name" => esc_attr__("Number Box", 'esense-functions'),
  "base" => "numberbox",
  "icon" => "icon-wpb-numberbox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Box with animated number', 'esense-functions'),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Type", 'esense-functions'),
	  "param_name" => "type",
  	  'save_always' => true,
			"value" => array(
				"Centerd box" => "centered",	
				"Number left" => "left",
				"Number right" => "right"
			),
	 "std" => "centered",
	  "description" => ""
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Border style", 'esense-functions'),
	  "param_name" => "style",
  	  'save_always' => true,
			"value" => array(
				"Round" => "round",	
				"Diamond" => "diamond"
			),
	  "std" => "round",
	  "description" => ""
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
  	  'save_always' => true,
	  "admin_label" => true,
      "value" => esc_attr__("Faeture Box", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Number", 'esense-functions'),
      "param_name" => "number",
  	  'save_always' => true,
      "value" => "01"
    ),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Custom number color", 'esense-functions'),
	"param_name" => "number_color",
	"value" => "",
	"description" => esc_attr__("Select custom number color for this box", 'esense-functions')
	),
    array(
      "type" => "textarea_html",
      "heading" => esc_attr__("Content", 'esense-functions'),
	  "holder" => 'div',
      "param_name" => "content",
      "value" => esc_attr__("Number box content.", 'esense-functions')
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button link", 'esense-functions'),
      "param_name" => "button_link",
      "description" => esc_attr__("If you leave this foeld blank 'Read more' button will be not dispaled", 'esense-functions')
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button text", 'esense-functions'),
      "param_name" => "button_text"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Button Style", 'esense-functions'),
				"param_name" => "button_style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* Flip Box */

vc_map( array(
  "name" => esc_attr__("Flip Box", 'esense-functions'),
  "base" => "esense-flipbox",
  "icon" => "icon-wpb-flipbox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Flipping box', 'esense-functions'),
  "params" => array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => esc_attr__("Icon type:", 'esense-functions'),
		"param_name" => "icon_type",
		"group" => "Front Side Settings",
  		'save_always' => true,
		"value" => array(
		"Font Icon Manager" => "selector",
		"Custom Image" => "custom",
		),
		"std" => "selector",
		"description" => esc_attr__("Use an existing font icon or upload a custom image.", 'esense-functions')
		),
	array(
	"type" => "icon_selector",
	"group" => "Front Side Settings",
	"class" => "",
	"admin_label" => true,
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	"description" => "",
	"dependency" => Array("element" => "icon_type","value" => array("selector")),
	),
	array(
								"type" => "number",
								"class" => "",
								"heading" => esc_attr__("Icon size", 'esense-functions'),
								"param_name" => "icon_size",
								"group" => "Front Side Settings",
								"value" => 48,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
		),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Icon Color", 'esense-functions'),
								"param_name" => "icon_color",
								"group" => "Front Side Settings",
								"value" => "#2e2a27",
								"description" => esc_attr__("Select background color for icon.", 'esense-functions'),	
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
			),
	array(
								"type" => "dropdown",
								"class" => "",
								"heading" => esc_attr__("Icon Badge Style", 'esense-functions'),
								"param_name" => "icon_style",
								"group" => "Front Side Settings",
  								'save_always' => true,
								"value" => array(
									"No badge" => "none",
									"Circle" => "circle",
									"Square" => "square"
								),
								"std" => "none",
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
	  ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Badge Background Color", 'esense-functions'),
								"param_name" => "icon_badge_color",
								"group" => "Front Side Settings",
								"value" => "#ffffff",
								"description" => esc_attr__("Select background color for icon.", 'esense-functions'),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square")),
			),
	array(
								"type" => "attach_image",
								"class" => "",
								"heading" => esc_attr__("Upload Image Icon:", 'esense-functions'),
								"param_name" => "icon_img",
								"group" => "Front Side Settings",
								"value" => "",
								"description" => esc_attr__("Upload the custom image icon.", 'esense-functions'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
		),
		
	array(
								"type" => "number",
								"class" => "",
								"heading" => esc_attr__("Image Width", 'esense-functions'),
								"param_name" => "img_width",
								"group" => "Front Side Settings",
								"value" => 48,
								"min" => 16,
								"max" => 512,
								"suffix" => "px",
								"description" => esc_attr__("Set image width", 'esense-functions'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
			),
	array(
      							"type" => "textfield",
      							"heading" => esc_attr__("Front title", 'esense-functions'),
      							"param_name" => "front_title",
								"admin_label" => true,
								"value" => "",
								"group" => "Front Side Settings",
    ),
    array(
							  "type" => "textarea",
							  "heading" => esc_attr__("Content", 'esense-functions'),
							  "param_name" => "front_content",
							  "group" => "Front Side Settings",
							  "value" => esc_attr__("Front side content of this FlipBox.", 'esense-functions')
    ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Front text color", 'esense-functions'),
								"param_name" => "front_txt_color",
								"group" => "Front Side Settings",
								"value" => "#2e2a27",
								"description" => esc_attr__("Select text color for front side.", 'esense-functions')
			),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Front background color", 'esense-functions'),
								"param_name" => "front_bg_color",
								"group" => "Front Side Settings",
								"value" => "#e6e6e6",
								"description" => esc_attr__("Select background color for front side.", 'esense-functions')
			),
	array(
      							"type" => "textfield",
      							"heading" => esc_attr__("Front title", 'esense-functions'),
      							"param_name" => "back_title",
								"value" => "",
								"group" => "Back Side Settings",
    ),
    array(
							  "type" => "textarea_html",
							  "heading" => esc_attr__("Back Side Content", 'esense-functions'),
							  "holder" => "div",
							  "param_name" => "content",
							  "group" => "Back Side Settings",
							  "value" => esc_attr__("Back side content of this FlipBox.", 'esense-functions')
    ),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Back text color", 'esense-functions'),
								"param_name" => "back_txt_color",
								"group" => "Back Side Settings",
								"value" => "#2e2a27",
								"description" => esc_attr__("Select text color for back side.", 'esense-functions')
			),
	array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Back background color", 'esense-functions'),
								"param_name" => "back_bg_color",
								"group" => "Back Side Settings",
								"value" => "#e6e6e6",
								"description" => esc_attr__("Select background color for back side.", 'esense-functions')
			),
	array(
							    "type" => "textfield",
							    "heading" => esc_attr__("Button link", 'esense-functions'),
							    "param_name" => "link",
								"group" => "Back Side Settings",
							    "description" => esc_attr__("If you leave this field blank 'Read more' button will be not dispaled", 'esense-functions')
			),
	array(
							    "type" => "textfield",
							    "heading" => esc_attr__("Button text", 'esense-functions'),
							    "param_name" => "button_text",
								"group" => "Back Side Settings",
								'dependency' => array( 'element' => 'link', 'not_empty' => true)

    		),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_attr__("Button style ",'esense-functions'),
				"param_name" => "button_style",
				"group" => "Back Side Settings",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => esc_attr__("Select button style.",'esense-functions'),
							'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Button Size", 'esense-functions'),
				"group" => "Back Side Settings",
				"param_name" => "button_size",
  				'save_always' => true,
				"value" => array(
					"Small" => "small",	
					"Large" => "large",	
					"Extra Large" => "extralarge",
				),
				"std" => "small",
				"description" => "",
				'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Open in", 'esense-functions'),
				"param_name" => "link_target",
				"group" => "Back Side Settings",
  				'save_always' => true,
				"value" => array(
					"The same window" => "_self",
					"New window" => "_blank",	
					"Parent" => "_parent"
					
				),
				"description" => "",
				'dependency' => array( 'element' => 'link', 'not_empty' => true)
			),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_attr__("Flip Animation Type ",'esense-functions'),
							"param_name" => "flip_type",
							"group" => "Additional Settings",
  							'save_always' => true,
							"value" => array(
								"Flip Horizontally" => "",
								"Flip Vertically" => "vertical",
							),
							"description" => esc_attr__("Select Flip type for this flip box.",'esense-functions')
			),
	array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_attr__("Set Box Height",'esense-functions'),
							"param_name" => "height_type",
							"group" => "Additional Settings",
  							'save_always' => true,
							"value" => array(
								"Display full the content and adjust height of the box accordingly"=>"auto",
								"Give a custom height of your choice to the box" => "custom",								
							),
							"std" => "auto",
							"description" => esc_attr__("Select height option for this box.",'esense-functions')
			),
	array(
							"type" => "number",
							"class" => "",
							"heading" => esc_attr__("Box Height", 'esense-functions'),
							"param_name" => "box_height",
							"group" => "Additional Settings",
							"value" => 300,
							"min" => 200,
							"max" => 1200,
							"suffix" => "px",
							"description" => esc_attr__("Provide box height", 'esense-functions'),
							"dependency" => Array("element" => "height_type","value" => array("custom")),
			),
    array(
						  "type" => "textfield",
						  "heading" => esc_attr__("Extra class name", 'esense-functions'),
						  "param_name" => "el_class",
						  "group" => "Additional Settings",
						  "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );



/* Text box
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("DP Text Box", 'esense-functions'),
  "base" => "textbox",
  "holder"      => "div",
  "icon" => "icon-wpb-textbox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Text box with background, border etc', 'esense-functions'),
  "params" => array(
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
	  "admin_label" => true,
      "param_name" => "title",
  	  'save_always' => true,
      "value" => esc_attr__("Text Box", 'esense-functions')
    ),
	array(
	"type" => "icon_selector",
	"admin_label" => true,
	"class" => "",
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	"description" => ""
	),	 
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => esc_attr__("Content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Text box content.", 'esense-functions')
    ),
	
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Background color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "bgcolor",
	"value" => "",
	"description" => esc_attr__("Select custom background color for text box", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Text color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "txtcolor",
	"value" => "",
	"description" => esc_attr__("Select custom background color for text box", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Border color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "border_color",
	"value" => "",
	"description" => esc_attr__("Select custom border color for text box", 'esense-functions')
	),
	array(
      "type" => "number",
      "heading" => esc_attr__("Border width", 'esense-functions'),
	  "group" => "Style Options",
      "param_name" => "border_width",
	  "suffix"=>"px",
      "value" => "1",
	  "description" => esc_attr__("Border width in px", 'esense-functions')
    ),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Border style", 'esense-functions'),
	  "group" => "Style Options",
	  "std" => "solid",
  	  'save_always' => true,
	  "param_name" => "border_style",
			"value" => array(
				"Solid" => "solid",
				"No border" => "none",	
				"Dotted" => "dotted",
				"Dashed" => "dashed",
				"Double" => "double",
				"Groove" => "groove",
				"Ridge" => "ridge",
				"Inset" => "inset",
				"Outset" => "outset"
			)
	),
	array(
      "type" => "number",
      "heading" => esc_attr__("Border radius", 'esense-functions'),
	  "group" => "Style Options",
      "param_name" => "border_radius",
	  "suffix"=>"px",
      "value" => "2",
	  "description" => esc_attr__("Border radius in px", 'esense-functions')
    ),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Header background color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "header_bgcolor",
	"value" => "",
	"description" => esc_attr__("Select custom background color for front of service box", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Header text color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "header_txtcolor",
	"value" => "",
	"description" => esc_attr__("Select custom color for header text", 'esense-functions')
	),
	array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_attr__("Icon custom color", 'esense-functions'),
	"group" => "Style Options",
	"param_name" => "icon_color",
	"value" => "",
	"description" => esc_attr__("Select custom color for header text", 'esense-functions')
	),

    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* Teaser
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("DP Teaser", 'esense-functions'),
  "base" => "teaser",
  "icon" => "icon-wpb-teaser",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Text box with image and link', 'esense-functions'),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Source", 'esense-functions'),
	  "param_name" => "source",
  	  'save_always' => true,
			"value" => array(
				"Post or portfolio item" => "post",	
				"Custom content" => "custom",
			),
	  "std" => "post",
	  "description" => "Select source type for teaser"
	),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Icons in overlay", 'esense-functions'),
	  "param_name" => "overlay_icons",
  			'save_always' => true,
			"value" => array(
				"Only zoom icon" => "zoom",	
				"Only link icon" => "link",
				"Both" => "both",
				"No icons" => "no",
			),
	  "std" => "zoom",
	  "description" => ""
	),
				array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use Read More button?",
				"value" => array("Yes, please" => "true" ),
				"param_name" => "usebutton",
		),
			array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Button text', 'esense-functions' ),
			'param_name' => 'button_text',
			'dependency' => array( 'element' => 'usebutton', 'not_empty' => true)
		),
			array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_attr__("Button style ",'esense-functions'),
				"param_name" => "button_style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
							"description" => esc_attr__("Select button style.",'esense-functions'),
							'dependency' => array( 'element' => 'usebutton', 'not_empty' => true)
		),
	$add_dp_animation,	
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
	  "admin_label" => true,
      "value" => esc_attr__("Teaser title", 'esense-functions'),
	  'dependency' => array(
	  'element' => 'source',
  	  'save_always' => true,
	  'value' => array( 'custom' ),
		),
	  'group' => esc_attr__("Custom content setting", 'esense-functions'),

    ),
	array(
      "type" => "attach_image",
      "heading" => esc_attr__("Image", 'esense-functions'),
      "param_name" => "img",
      "value" => "",
      "description" => esc_attr__("Select image from media library.", 'esense-functions'),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => esc_attr__("Custom content setting", 'esense-functions'),
    ),
	array(
      "type" => "attach_image",
      "heading" => esc_attr__("Big Image", 'esense-functions'),
      "param_name" => "bigimg",
      "value" => "",
      "description" => esc_attr__("Select image from media library.This image will be displayed in lightbox. If you leave it blank lightbox link will be not displayed.", 'esense-functions'),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => esc_attr__("Custom content setting", 'esense-functions'),
    ),
	array(
      "type" => "textarea_html",
      "heading" => esc_attr__("Content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Teaser content.", 'esense-functions'),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
	  'group' => esc_attr__("Custom content setting", 'esense-functions'),
    	),
			array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Teaser link', 'esense-functions' ),
			'param_name' => 'link',
			'description' => esc_attr__( 'Enter URL if you want display read more button on bottom.', 'esense-functions' ),
	  'dependency' => array(
	  'element' => 'source',
	  'value' => array( 'custom' ),
		),
			'group' => esc_attr__("Custom content setting", 'esense-functions'),
		),
	array(
		'type' => 'autocomplete',
		'heading' => esc_attr__( 'Post or portfolio item', 'esense-functions' ),
		'param_name' => 'post_id',
		'description' => esc_attr__( 'Add post by title. Start typing post title to find right post', 'esense-functions' ),
		'settings' => array(
			'multiple' => false,
			'sortable' => true,
			'groups' => true,
		),
	   'dependency' => array(
	   'element' => 'source',
	   'value' => array( 'post' ),
		),
		'group' => esc_attr__("Post content setting", 'esense-functions'),
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Excerpt characters limit", 'esense-functions'),
      "param_name" => "charlimit",
      "description" => esc_attr__("How many characters should be displayed in post excerpt (default is 100)", 'esense-functions'),
	  "value" => "100",
	   'dependency' => array(
	   'element' => 'source',
	   'value' => array( 'post' ),
		),
		'group' => esc_attr__("Post content setting", 'esense-functions'),
    ),

	)
) );

add_filter( 'vc_autocomplete_teaser_post_id_callback',
	'dp_vc_include_postorportfolio_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_teaser_post_id_render',
	'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)


/* Horizontal Teaser
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("DP Teaser Horizontal", 'esense-functions'),
  "base" => "post_teaser",
  "icon" => "icon-wpb-teaser2",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Display fancy post based teaser block', 'esense-functions'),
  "params" => array(
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Type", 'esense-functions'),
	  "param_name" => "type",
  			'save_always' => true,
			"value" => array(
				"Featured image left" => "left",	
				"Featured image right" => "right"
			),
	  "std" => "left",
	  "description" => ""
	),
	array(
		'type' => 'autocomplete',
		'heading' => esc_attr__( 'Post', 'esense-functions' ),
		'param_name' => 'post_id',
		'description' => esc_attr__( 'Add post by title. Start typing post title to find right post', 'esense-functions' ),
		'settings' => array(
			'multiple' => false,
			'sortable' => true,
			'groups' => true,
		)
	),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

add_filter( 'vc_autocomplete_post_teaser_post_id_callback',
	'dp_vc_include_postorportfolio_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_post_teaser_post_id_render',
	'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

/* Countdown timer
---------------------------------------------------------- */
vc_map( array(
  "name" => esc_attr__("DP Countdown", 'esense-functions'),
  "base" => "esense-countdown",
  "icon" => "icon-wpb-countdown",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  'admin_enqueue_js' => array(DPFUNCTIONS_URI.'/inc/vc_extend/bootstrap-datetimepicker.min.js'),
  'admin_enqueue_css' => array(DPFUNCTIONS_URI.'/inc/vc_extend/bootstrap-datetimepicker.min.css'),
  "description" => esc_attr__('Countdown timer', 'esense-functions'),
  "params" => array(
					   		array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => esc_attr__("Countdown Timer Style", 'esense-functions'),
								"param_name" => "style",
  								'save_always' => true,
								"value" => array(
										esc_attr__("Digit and Unit Up and Down",'esense-functions') => "updown",
										esc_attr__("Digit and Unit Side by Side",'esense-functions') => "byside",
									),
								"std" => "updown",
								"description" => esc_attr__("Select style for countdown timer.", 'esense-functions'),
							),
  
							array(
							"type" => "esense-datetimepicker",
							"class" => "",
							"heading" => esc_attr__("Target Time For Countdown", 'esense-functions'),
							"param_name" => "datetime",
							"admin_label" => true,
							"value" => "", 
							"description" => esc_attr__("Date and time format (yyyy/mm/dd hh:mm:ss).", 'esense-functions'),
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Timer Digit Text Color", 'esense-functions'),
								"param_name" => "digit_col",
								"value" => ""
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => esc_attr__("Timer Digit Text Size", 'esense-functions'),
								"param_name" => "digit_size",
								"suffix"=>"px",
								"min"=>"0",
								"value" => "60"
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => esc_attr__("Timer Digit Text Style", 'esense-functions'),
								"param_name" => "digit_style",
  								'save_always' => true,
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"bolditalic",
											)
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => esc_attr__("Timer Unit Text Color", 'esense-functions'),
								"param_name" => "unit_col",
								"value" => "",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => esc_attr__("Timer Unit Text Size", 'esense-functions'),
								"param_name" => "unit_size",
								"value" => "15",
								"suffix"=>"px",
								"min"=>"0"
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => esc_attr__("Timer Unit Text Style", 'esense-functions'),
								"param_name" => "unit_style",
  								'save_always' => true,
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"bolditalic",
											)
							),
							array(
							  "type" => "textfield",
							  "heading" => esc_attr__("Extra class name", 'esense-functions'),
							  "param_name" => "el_class",
							  "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
							),
  )
) );

/* Process boxes */

vc_map( array(
  "name" => esc_attr__("Process Box", 'esense-functions'),
  "base" => "processbox",
  "icon" => "icon-wpb-processbox",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Box in process diagram', 'esense-functions'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Title", 'esense-functions'),
      "param_name" => "title",
  	  'save_always' => true,
	  "admin_label" => true,
      "value" => esc_attr__("Process Box", 'esense-functions')
    ),
     array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Border style", 'esense-functions'),
	  "param_name" => "style",
  	  'save_always' => true,
			"value" => array(
				"Round" => "round",	
				"Diamond" => "diamond"
			),
	  "std" => "round",
	  "description" => ""
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Symbol size", 'esense-functions'),
	  "param_name" => "symbol_size",
  		'save_always' => true,
			"value" => array(
				"Small" => "small",	
				"Medium" => "medium",	
				"Large" => "large"
			),
	  "std" => "small",
	  "description" => "Select size of displayed symbol"
	),
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Type", 'esense-functions'),
	  "param_name" => "symbol_type",
  		'save_always' => true,
			"value" => array(
				"Icon" => "icon",	
				"Number" => "number",
			),
	  "std" => "icon",
	  "description" => "Select type of displayed symbol"
	),
	array(
	"type" => "icon_selector",
	"class" => "",
	"admin_label" => true,
	"heading" => esc_attr__("Icon", 'esense-functions'),
	"param_name" => "icon",
	'save_always' => true,
	"description" => "",
	"value" => "icon-wordpress",
	"dependency" => Array('element' => "symbol_type", 'value' => array('icon'))
	),	 
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Number", 'esense-functions'),
      "param_name" => "number",
      "value" => "01",
  	  'save_always' => true,
	  "dependency" => Array('element' => "symbol_type", 'value' => array('number'))
    ),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Symbol color", 'esense-functions'),
	 "param_name" => "symbol_color",
	  "description" => ""
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Symbol hover color", 'esense-functions'),
	 "param_name" => "symbol_hcolor",
	  "description" => ""
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Process line color", 'esense-functions'),
	 "param_name" => "line_color",
	  "description" => ""
	),
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => esc_attr__("Content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Featured box content.", 'esense-functions')
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button link", 'esense-functions'),
      "param_name" => "button_link",
      "description" => esc_attr__("If you leave this foeld blank 'Read more' button will be not dispaled", 'esense-functions')
    ),
	array(
      "type" => "textfield",
      "heading" => esc_attr__("Button text", 'esense-functions'),
      "param_name" => "button_text"
    ),
	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_attr__("Button Style", 'esense-functions'),
				"param_name" => "button_style",
  				'save_always' => true,
				"value" => array(
					"Default" => "",	
					"Dark" => "dark",	
					"Light" => "light",
					"White" => "white",
					"Blue" => "blue",
					"Green" => "green",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Red" => "red",
					"Purple" => "purple",				
					"Pink" => "pink",
					"Gray" => "gray",
					"Default Bordered" => "line",
					"White Bordered" => "line-white",
					"Dark Bordered" => "line-dark",
					"Blue Bordered" => "line-blue",
					"Green Bordered" => "line-green",
					"Orange Bordered" => "line-orange",
					"Yellow Bordered" => "line-yellow",
					"Red Bordered" => "line-red",
					"Purple Bordered" => "line-purple",				
					"Pink Bordered" => "line-pink",
					"Gray Bordered" => "line-gray",
					"Readmore only" => "readmore"
				),
				"description" => ""
			),
	array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Finish process diagram?', 'esense-functions' ),
			'param_name' => 'finish',
			'description' => esc_attr__( 'If it is last process position process line will be not displayed after this position.', 'esense-functions' ),
			'value' => array( esc_attr__( 'Yes, please', 'esense-functions' ) => 'yes' )
	),
	$add_dp_animation,
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Extra class name", 'esense-functions'),
      "param_name" => "el_class",
      "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
    )
  )
) );

/* DP Time line */
vc_map( array(
    "name" => esc_attr__("DP Timeline", 'esense-functions'),
    "base" => "timeline",
	"icon" => "icon-wpb-timeline",
    "as_parent" => array('only' => 'timeline_item, timeline_sep'),
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
    "content_element" => true,
    "show_settings_on_create" => false,
	"description" =>  esc_attr__('Timeline container', 'esense-functions'),
    "params" => array(
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Line type", 'esense-functions'),
	  "param_name" => "type",
  		'save_always' => true,
			"value" => array(
				"Solid" => "solid",	
				"Dotted" => "dotted",	
				"Dashed" => "dashed"
			),
	  "std" => "solid",
	  "description" => "Select type of timeline axe"
	),
	array(
	  "type" => "colorpicker",
	  "class" => "",
	  "heading" => esc_attr__("Line color", 'esense-functions'),
	  "param_name" => "line_color",
	  "description" => "Select color of timeline axe"
	),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'esense-functions'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
        )
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => esc_attr__("DP Timeline Item", 'esense-functions'),
    "base" => "timeline_item",
	"icon" => "icon-wpb-timeline_item",
    "content_element" => true,
	"description" =>  esc_attr__('Single timeline item', 'esense-functions'),
    "as_child" => array('only' => 'timeline'), 
    "params" => array(
	array(
	  "type" => "dropdown",
	  "class" => "",
	  "heading" => esc_attr__("Item position", 'esense-functions'),
	  "param_name" => "position",
  	  'save_always' => true,
			"value" => array(
				"Right" => "right",	
				"Left" => "left",	
			),
	  "std" => "right",
	  "description" => "Select type of timeline axe"
	),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => esc_attr__("Node color", 'esense-functions'),
		  "param_name" => "node_color",
		  "description" => "Select color of timeline node"
		),
	array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Date", 'esense-functions'),
		  "param_name" => "date"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => esc_attr__("Date background color", 'esense-functions'),
		  "param_name" => "date_color",
		  "description" => "Select background color for date"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => esc_attr__("Date text color", 'esense-functions'),
		  "param_name" => "date_text_color",
		  "description" => "Select text color for date"
		),
	array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Title", 'esense-functions'),
		  "param_name" => "title",
		  "admin_label" => true,
		),
    array(
      "type" => "textarea_html",
	  "holder" => "div",
      "heading" => esc_attr__("Content", 'esense-functions'),
      "param_name" => "content",
      "value" => esc_attr__("Item content.", 'esense-functions')
    ),
	$add_dp_animation,
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'esense-functions'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
        )
    )
) );
vc_map( array(
    "name" => esc_attr__("DP Timeline Seprator", 'esense-functions'),
    "base" => "timeline_sep",
	"icon" => "icon-wpb-timeline_separator",
    "content_element" => true,
"description" =>  esc_attr__('Timeline item separator', 'esense-functions'),
    "as_child" => array('only' => 'timeline'), 
    "params" => array(
	array(
		  "type" => "textfield",
		  "heading" => esc_attr__("Separator text", 'esense-functions'),
		  "param_name" => "sep_text",
		  "admin_label" => true,
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => esc_attr__("Separator background color", 'esense-functions'),
		  "param_name" => "sep_color",
		  "description" => "Select background color for separator"
		),
	array(
		  "type" => "colorpicker",
		  "class" => "",
		  "heading" => esc_attr__("Separator text color", 'esense-functions'),
		  "param_name" => "sep_text_color",
		  "description" => "Select text color for separator"
		),
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'esense-functions'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions')
        )
    )
) );

class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_timeline_item extends WPBakeryShortCode {
}
class WPBakeryShortCode_timeline_sep extends WPBakeryShortCode {
}

/* OWL Carousel */
vc_map( array(
  "name" => esc_attr__("OWL Carousel", 'esense-functions'),
  "base" => "owl_carousel",
  "icon" => "icon-wpb-owl",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('OWL Carousel using slide custom post type', 'esense-functions'),
  "params" => array(
  $add_dp_slideshow,
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items", 'esense-functions'),
      "param_name" => "items",
      "description" => esc_attr__("Items to display on normal screen width > 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on desktop", 'esense-functions'),
      "param_name" => "itemsdesktop",
      "description" => esc_attr__("Items to display on desktop screen width < 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on small desktop", 'esense-functions'),
      "param_name" => "itemsdesktopsmall",
      "description" => esc_attr__("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on tablet", 'esense-functions'),
      "param_name" => "itemstablet",
      "description" => esc_attr__("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on mobile devices", 'esense-functions'),
      "param_name" => "itemsmobile",
      "description" => esc_attr__("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
	array(
				  "type" => "number",
				  "class" => "",
				  "heading" => esc_attr__("Item margin", 'esense-functions'),
				  "param_name" => "item_margin",
				  "value" => "",
				  "min"=>"0",
				  "suffix"=>"px"
		),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Autoplay", 'esense-functions'),
      "param_name" => "autoplay",
      "description" => esc_attr__("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", 'esense-functions')
    ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Show navigation arrows", 'esense-functions'),
        "param_name" => "navigation",
  		'save_always' => true,
		"std" => "no",
			"value" => array(
					"No" => "no",
					"Yes" => "yes"		
	)
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Show pagination bullets", 'esense-functions'),
        "param_name" => "pagination",
  		'save_always' => true,
		"std" => "no",
			"value" => array(
					"No" => "no",
					"Yes" => "yes"		
	)
      ),

  )
));

/* Portfolio carousel */
vc_map( array(
  "name" => esc_attr__("Portfolio carousel", 'esense-functions'),
  "base" => "portfolio_carousel",
  "icon" => "icon-wpb-portfolio-carousel",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Portfolio items carousel', 'esense-functions'),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => esc_attr__("Items in carousel total", 'esense-functions'),
      "param_name" => "show_items",
      "description" => esc_attr__("How many items should be included in carousel", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Categories", 'esense-functions'),
      "param_name" => "categories",
      "description" => esc_attr__("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items", 'esense-functions'),
      "param_name" => "items",
      "description" => esc_attr__("Items to display on normal screen width > 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on desktop", 'esense-functions'),
      "param_name" => "itemsdesktop",
      "description" => esc_attr__("Items to display on desktop screen width < 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on small desktop", 'esense-functions'),
      "param_name" => "itemsdesktopsmall",
      "description" => esc_attr__("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on tablet", 'esense-functions'),
      "param_name" => "itemstablet",
      "description" => esc_attr__("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on mobile devices", 'esense-functions'),
      "param_name" => "itemsmobile",
      "description" => esc_attr__("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Autoplay", 'esense-functions'),
      "param_name" => "autoplay",
      "description" => esc_attr__("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", 'esense-functions')
    ),

  )
));


/* Portfolio grid */
vc_map( array(
  "name" => esc_attr__("Portfolio Grid", 'esense-functions'),
  "base" => "portfolio_grid",
  "icon" => "icon-wpb-portfolio-grid",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Portfolio items grid', 'esense-functions'),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => esc_attr__("Items", 'esense-functions'),
      "param_name" => "items",
      "description" => esc_attr__("How many items should be displayed", 'esense-functions')
    ),
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Columns count", 'esense-functions'),
        "param_name" => "columns",
        "admin_label" => true,
		"std" => "2",
  		'save_always' => true,
			"value" => array(
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"8" => "8"		
			),
      ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Categories", 'esense-functions'),
      "param_name" => "categories",
      "description" => esc_attr__("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", 'esense-functions')
    ),
	array(
        "type" => "dropdown",
        "heading" => esc_attr__("Thumb dimension", 'esense-functions'),
        "param_name" => "thumbsize",
        "admin_label" => true,
		"std" => "horizontal",
  		'save_always' => true,
			"value" => array(
					"Horizontal 4:3" => "horizontal",
					"Vertical 3:4" => "vertical",
					"Square" => "square",
					"Origimal dimension" => "original"	
			),
      ),

   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display category filter", 'esense-functions'),
        "param_name" => "filter",
        "admin_label" => true,
		"std" => "no",
  		'save_always' => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display lightbox icon in overlay", 'esense-functions'),
        "param_name" => "showlightbox",
        "admin_label" => true,
		"std" => "yes",
  		'save_always' => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display link icon in overlay", 'esense-functions'),
        "param_name" => "showlink",
        "admin_label" => true,
		"std" => "yes",
  		'save_always' => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display title in overlay", 'esense-functions'),
        "param_name" => "showtitle",
        "admin_label" => true,
		"std" => "yes",
  		'save_always' => true,
			"value" => array(
					"Yes" => "yes",
				    "No" => "no"
			),
      ),   
	  array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display categories in overlay", 'esense-functions'),
        "param_name" => "showcategories",
        "admin_label" => true,
		"std" => "no",
  		'save_always' => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),

   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display short description in overlay", 'esense-functions'),
        "param_name" => "showdescription",
        "admin_label" => true,
		"std" => "no",
  		'save_always' => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      ),
  )
));

/* Blog carousel */
vc_map( array(
  "name" => esc_attr__("Blog carousel", 'esense-functions'),
  "base" => "blog_carousel",
  "icon" => "icon-wpb-blog-carousel",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Portfolio items carousel', 'esense-functions'),
  "params" => array(
   array(
      "type" => "textfield",
      "heading" => esc_attr__("Items in carousel total", 'esense-functions'),
      "param_name" => "show_items",
      "description" => esc_attr__("How many items should be included in carousel", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Categories", 'esense-functions'),
      "param_name" => "categories",
      "description" => esc_attr__("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items", 'esense-functions'),
      "param_name" => "items",
      "description" => esc_attr__("Items to display on normal screen width > 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on desktop", 'esense-functions'),
      "param_name" => "itemsdesktop",
      "description" => esc_attr__("Items to display on desktop screen width < 1200px", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on small desktop", 'esense-functions'),
      "param_name" => "itemsdesktopsmall",
      "description" => esc_attr__("Items to display on desktop screen width < 980px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on tablet", 'esense-functions'),
      "param_name" => "itemstablet",
      "description" => esc_attr__("Items to display on tablet screen width < 768px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Items on mobile devices", 'esense-functions'),
      "param_name" => "itemsmobile",
      "description" => esc_attr__("Items to display on mobile devices width < 479px. If you leave this field blank will be used setting from first not empty field above.", 'esense-functions')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Autoplay", 'esense-functions'),
      "param_name" => "autoplay",
      "description" => esc_attr__("Set autoplay speed in ms. If you leave blank autoplay will be disabled.", 'esense-functions')
    ),


  )
));

/* Blog grid */
vc_map( array(
  "name" => esc_attr__("Blog Grid", 'esense-functions'),
  "base" => "blog_grid",
  "icon" => "icon-wpb-blog-grid",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Blog items grid', 'esense-functions'),
  "params" => array(
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Columns count", 'esense-functions'),
        "param_name" => "columns",
        "admin_label" => true,
		"std" => "2",
  		'save_always' => true,
			"value" => array(
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"8" => "8"		
			),
      ),
   array(
      "type" => "textfield",
      "heading" => esc_attr__("Total items count", 'esense-functions'),
      "param_name" => "items_count"
    ),
    array(
      "type" => "textfield",
      "heading" => esc_attr__("Categories", 'esense-functions'),
      "param_name" => "categories",
      "description" => esc_attr__("Coma separated list of categories to display. If you leave this field blank all items will be displayed.", 'esense-functions')
    ),
   array(
        "type" => "dropdown",
        "heading" => esc_attr__("Display category filter", 'esense-functions'),
        "param_name" => "filter",
        "admin_label" => true,
		"std" => "no",
		  'save_always' => true,
			"value" => array(
					"No" => "no",
					"Yes" => "yes"	
			),
      )
  )
));

/* Anchor */
vc_map( array(
  "name" => esc_attr__("Anchor", 'esense-functions'),
  "base" => "anchor",
  "icon" => "icon-wpb-anchor",
  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
  "description" => esc_attr__('Anchor in content', 'esense-functions'),
  "params" => array(
   array(
      "type" => "textfield",  
	  "admin_label" => true,
      "heading" => esc_attr__("Name", 'esense-functions'),
      "param_name" => "name"
    )
  )
));

		
/* Modal Box */

            vc_map( array(
              "name" => esc_attr__("Modal Box", 'esense-functions'),
              "base" => "esense-modal",
              "controls" => "full",
              "icon" => "icon-wpb-modal",
  			  "category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
              'description' => esc_attr__( 'Modal boxes displayed in overlay', 'esense-functions' ),
              "params" => array(
			     array(
                  "type" => "textarea_raw_html",
                  "class" => "",
                  "heading" => esc_attr__("Modal box trigger", 'esense-functions'),
                  "param_name" => "trigger",
                  "value" => esc_attr__("Modal box link label", 'esense-functions'),
                  "description" => esc_attr__("In this field place link for modal box content. Any HTML code and shortcodes is accepted.", 'esense-functions')
                ),
                array(
                  "type" => "textarea_raw_html",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Modal box content", 'esense-functions'),
                  "param_name" => "content",
                  "value" => esc_attr__("<p>I am test modal box text block. Click edit button to change this text.</p>", 'esense-functions'),
                  "description" => esc_attr__("", 'esense-functions')
                ),
				array(
						'type' => 'checkbox',
						'heading' => esc_attr__( 'Use popup box title?', 'esense-functions' ),
						'param_name' => 'usetitle',
						'value' => array( esc_attr__( 'Yes', 'esense-functions' ) => 'true' ),
						"description" => "Check this box if you will use modal box title",
				),
                array(
                  "type" => "textfield",
                  "holder" => "",
                  "heading" => esc_attr__("Title", 'esense-functions'),
                  "param_name" => "title",
				  "save_always" => true,
                  "value" => esc_attr__("Modal Box Title", 'esense-functions'),
	  			  "dependency" => Array('element' => "usetitle", 'value' => array('true'))
                ),
				array(
				  "type" => "number",
				  "class" => "",
				  "heading" => esc_attr__("Popup width", 'esense-functions'),
				  "param_name" => "width",
				  "value" => "640",
				  "min"=> "320",
				  "max" => "640",
				  "suffix"=>"px",
				),
                array(
                  "type" => "colorpicker",
                  "class" => "",
				  "group" => "Color Options",
                  "heading" => esc_attr__("Text color", 'esense-functions'),
                  "param_name" => "textcolor",
                  "value" => '#555',
                  "description" => esc_attr__("Set modal box text color", 'esense-functions')
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
				  "group" => "Color Options",
                  "heading" => esc_attr__("Background color", 'esense-functions'),
                  "param_name" => "bgcolor",
                  "value" => '#f7f7f7',
                  "description" => esc_attr__("Set modal box background color", 'esense-functions')
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
				  "group" => "Color Options",
                  "heading" => esc_attr__("Overlay color", 'esense-functions'),
                  "param_name" => "overlay_bgcolor",
                  "value" => 'rgba(0,0,0,.7)',
                  "description" => esc_attr__("Set overlay background color", 'esense-functions')
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
				  "group" => "Color Options",
                  "heading" => esc_attr__("Title text color", 'esense-functions'),
                  "param_name" => "title_textcolor",
                  "value" => '#fff',
                  "description" => esc_attr__("Set modal box title text color", 'esense-functions'),
	  			  "dependency" => Array('element' => "usetitle", 'value' => array('true'))
                ),
                array(
                  "type" => "colorpicker",
                  "class" => "",
				  "group" => "Color Options",
                  "heading" => esc_attr__("Title background color", 'esense-functions'),
                  "param_name" => "title_bgcolor",
                  "value" => 'rgba(0,0,0,.45)',
                  "description" => esc_attr__("Set modal box title background color", 'esense-functions'),
	  			  "dependency" => Array('element' => "usetitle", 'value' => array('true'))
                ),
                array(
                  "type" => "dropdown",
                  "holder" => "",
                  "heading" => esc_attr__("Animation type", 'esense-functions'),
                  "param_name" => "animation",
                  "value" => array ("Fade in scale" => "md-style-1",
								    "Slide in right" => "md-style-2",
								    "Slide in bottom" => "md-style-3",
								    "Rotate in" => "md-style-4",
				  					"Fall in" => "md-style-5",
				  					"Fall from side" => "md-style-6",
				  					"Sticky up" => "md-style-7",
				  					"Flip horizontal" => "md-style-8",
				  					"Flip vertical" => "md-style-9",
				  					"Sign" => "md-style-10",
				  					"Super scaled" => "md-style-11"
									),
                  "description" => esc_attr__("Select notification position on screen", 'esense-functions')
				),
				array(
				"type" => "textfield",
				"heading" => esc_attr__("Extra class name", 'esense-functions'),
				"param_name" => "el_class",
				"description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'esense-functions'),
      			)              
	  )
            ) );

/**** Vertical Dot Navigation***/

$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		$custom_menus[ $single_menu->name ] = $single_menu->slug;
	}
}
/**** Vertical Dot Navigation***/

$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		$custom_menus[ $single_menu->name ] = $single_menu->slug;
	}
}

vc_map( array(
	'name' =>  esc_attr__( "DP DotMenu", 'esense-functions'),
	'base' => 'dp_dotnav',
	'icon' => 'icon-wpb-dotnav',
  	"category" =>array( esc_attr__('by Dynamicpress', 'esense-functions'),esc_attr__('Content', 'esense-functions')),
	'class' => '',
	'description' => esc_attr__( 'Use this element to add vertical dot navigation', 'esense-functions' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Menu', 'esense-functions' ),
			'param_name' => 'nav_menu',
  			'save_always' => true,
			'value' => $custom_menus,
			'description' => empty( $custom_menus ) ? esc_attr__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'esense-functions' ) : esc_attr__( 'Select menu', 'esense-functions' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'esense-functions' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'esense-functions' )
		)
	)
) );


?>