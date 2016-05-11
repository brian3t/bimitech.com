<?php
if(!class_exists('Esense_WP')) {
	// include the framework base class
	require(get_template_directory() . '/dynamo_framework/base.php');
}
define('ESENSE_TPLNAME', 'esense');
// create the framework object
$esense_tpl = new Esense_WP();
// Including file with helper functions
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.base.php');
// Including file with template hooks
require_once(get_template_directory() . '/dynamo_framework/hooks.php');
// Including file with template functions
require_once(get_template_directory() . '/dynamo_framework/functions.php');
require_once(get_template_directory() . '/dynamo_framework/user.functions.php');
// Including file with woocommerce functions
if (isset($woocommerce)) : 
	require_once(get_template_directory() . '/woocommerce/woocommerce-functions.php');
endif;
// Including file with template filters
require_once(get_template_directory() . '/dynamo_framework/filters.php');

// Including file with template admin features
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.features.php');
// Including file with template layout functions
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.layout.php');
// Including file with template layout functions - connected with template fragments
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.layout.fragments.php');
// Including file with template branding functions
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.branding.php');
// Including file with template customize functions
require_once(get_template_directory() . '/dynamo_framework/helpers/helpers.customizer.php');
// initialize the framework
$esense_tpl->init();
// add theme setup function
add_action('after_setup_theme', 'esense_theme_setup');
// Theme setup function
function esense_theme_setup(){
	// access to the global template object
	global $esense_tpl;
	// if the normal page was requested do following operations:
	
    // load and parse template JSON file.
    $json_data = $esense_tpl->esense_get_json('config','template');
    // read the configuration
    $template_config = $json_data->template;
    // save the lowercase non-special characters template name				
    $template_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $template_config->name));
    // load the template text_domain
	load_theme_textdomain( 'dp-esense', get_template_directory() . '/languages' );
}
if (isset($woocommerce)) {
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'ESENSE_WOOCOMMERCE_USE_CSS', false );
}
}
// style enqueue function
    function esense_enqueue_css() {
	global $esense_tpl;
	wp_enqueue_style('esense-css', get_template_directory_uri() . '/css/basic.css');
	if(get_option($esense_tpl->name . "_overridecss_state", 'Y') == 'Y') {
	wp_enqueue_style('esense-override-css', get_template_directory_uri() . '/css/override.css');
	}
    if(is_rtl()) {
	wp_enqueue_style('esense-rtl-css', get_template_directory_uri() . '/css/rtl.css');
 	}
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'esense-ie', get_template_directory_uri() . '/css/ie9.css');
	wp_style_add_data( 'esense-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'esense-ie8', get_template_directory_uri() . '/css/ie8.css');
	wp_style_add_data( 'esense-ie8', 'conditional', 'lt IE 9' );
	}
	add_action('wp_enqueue_scripts', 'esense_enqueue_css');
	
	
// scripts enqueue function



    function esense_enqueue_js() {
	global $esense_tpl;
	// Common scripts
	wp_enqueue_script('esense-common-js', get_template_directory_uri() . '/js/common_scipts.js', array('jquery'),false,true);
	// jQuery isotope JS
	wp_enqueue_script( 'isotope-js',get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'),false,true);
	// Flex slider JS
	wp_enqueue_script( 'flexslider-js',get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), false,false);
	// jQuery tipsy JS
	wp_enqueue_script( 'jQuery-tipsy-js',get_template_directory_uri() . '/js/jquery.tipsy.js', array('jquery'),false,true);
	// Owl carousel 
	wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'),false,true);
	// jQuery selectfix
	wp_enqueue_script('selectfix-js',  get_template_directory_uri() . '/js/selectFix.js', array('jquery'),false,true);
	wp_enqueue_script('esense-menu-js', get_template_directory_uri() . '/js/menu.js', array('jquery'),  false,true);
	if(get_option($esense_tpl->name . '_prefixfree_state', 'N') == 'Y') { 
	wp_enqueue_script('prefixfree', get_template_directory_uri() . '/js/prefixfree.js');
	}
	if ( ! is_admin() ) {
	wp_enqueue_script('esense-frontend-js', get_template_directory_uri() . '/js/frontend.js', array('jquery'), false,true);

	}
	// Load the Internet Explorer specific JS.
	wp_enqueue_script( 'html5shiv-js', get_template_directory_uri() . '/js/html5shiv.js');
	wp_script_add_data( 'html5shiv-js', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_script( 'respond-js', get_template_directory_uri() . '/js/respond.js');
	wp_script_add_data( 'respond-js', 'conditional', 'lt IE 9' );
	
	}


add_action('wp_enqueue_scripts', 'esense_enqueue_js');

// scripts enqueue function
function esense_enqueue_admin_js_and_css() {
	// metaboxes scripts 
	wp_enqueue_script('esense-metabox-js', get_template_directory_uri() . '/js/back-end/dynamo_metabox.js', array('jquery'),'',true);
	wp_enqueue_media();
	// metaboxes CSS 
	wp_enqueue_style('esense-metabox-css', get_template_directory_uri() . '/css/back-end/metabox.css');  
	//Color picker
	wp_enqueue_script('spectrum-js', get_template_directory_uri() . '/js/back-end/libraries/spectrum/spectrum.js', array('jquery'));
	wp_enqueue_style('spectrum-css', get_template_directory_uri() . '/js/back-end/libraries/spectrum/spectrum.css');
	// shortcodes database
	if(
		get_locale() != '' && 
		is_dir(get_template_directory() . '/dynamo_framework/config/'. get_locale()) && 
		is_dir(get_template_directory() . '/dynamo_framework/options/'. get_locale())
	) {
		$language = get_locale();	
	} else {
		$language = 'en_US';
	}
	
}
// this action enqueues scripts and styles: 
add_action('admin_enqueue_scripts', 'esense_enqueue_admin_js_and_css');
wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
wp_oembed_add_provider( '#http://(www\.)?youtube\.com/watch.*#i', 'http://www.youtube.com/oembed', true );
wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );


function esense_excerpt_length($length) {
	global $esense_tpl;
 	return get_option($esense_tpl->name . "_excerpt_len"); }
add_filter('excerpt_length', 'esense_excerpt_length');

function esense_enqueue_icomoon_styles() {
        global $wp_styles;
        wp_enqueue_style( 'esense-icomoon', get_template_directory_uri() . '/css/dynamo_icomoon.css' );
    }
add_action('init', 'esense_enqueue_icomoon_styles');


function esense_enqueue_woocommerce_css(){
	if ( class_exists( 'woocommerce' ) ) {
	wp_enqueue_style( 'esense-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'esense_enqueue_woocommerce_css' );

/* Events Calendar custom stuff */

function esense_enqueue_eventcalendar_css(){
	if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
		wp_enqueue_style( 'esense-eventcalendar', get_template_directory_uri() . '/css/eventcalendar.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'esense_enqueue_eventcalendar_css' );
if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
if ( is_plugin_active('the-events-calendar/the-events-calendar.php') ) {
		require_once(get_template_directory() . '/tribe-events/functions.php');
	}


function esense_change_mce_options( $init ) {
 $init['theme_advanced_blockformats'] = 'p,address,pre,code,h3,h4,h5,h6';
 $init['theme_advanced_disable'] = 'forecolor';
 return $init;
}
add_filter('tiny_mce_before_init', 'esense_change_mce_options');

/**
Woocmerce page check
*/
function esense_is_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once(get_template_directory() . '/dynamo_framework/classes/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'esense_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function esense_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'DP Esense Functions', 
			'slug'     				=> 'esense-functions', 
			'source'   				=> get_template_directory() . '/plugins/esense-functions.zip', 
			'required' 				=> true,
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
		),
		array(
			'name'     				=> 'Visual Composer', 
			'slug'     				=> 'js_composer', 
			'source'   				=> 'http://www.dynamicpress.eu/downloads/plugins/visual_composer/4_11_2_1/js_composer.zip', 
			'required' 				=> true,
			'version' 				=> '', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> 'http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431', 
		),
		array(
			'name'     				=> 'Revolution Slider', 
			'slug'     				=> 'revslider', 
			'source'   				=> 'http://www.dynamicpress.eu/downloads/plugins/revslider/5_2_5_1/revslider.zip',  
			'required' 				=> true,
			'version' 				=> '', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> 'http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380', 
		),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false
		),
		array(
			'name' => 'Newsletter Sign-Up',
			'slug' => 'newsletter-sign-up',
			'required' => false
		),
		array(
			'name' => 'Events Calendar',
			'slug' => 'the-events-calendar',
			'required' => false
		),
		array(
			'name' => 'WooCommerce',
			'slug' => 'woocommerce',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Compare',
			'slug' => 'yith-woocommerce-compare',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Wishlist',
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false
		),
		array(
			'name' => 'YITH WooCommerce Zoom Magnifier',
			'slug' => 'yith-woocommerce-zoom-magnifier',
			'required' => false
		)
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'dp-esense';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
	);

	tgmpa( $plugins, $config );

}
