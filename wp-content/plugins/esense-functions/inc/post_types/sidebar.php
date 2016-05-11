<?php


global $shortname;


# Register custom post type

function register_sidebar_post_type() {
$labels = array(
	'name' => _x('Custom Sidebars', 'post type general name', 'esense-functions'),
    'singular_name' => _x('Sidebar', 'post type singular name', 'esense-functions'),
    'add_new' => _x('Add New', 'sidebar', 'esense-functions'),
    'add_new_item' => __('Add New Sidebar', 'esense-functions'),
    'edit_item' => __('Edit Sidebar', 'esense-functions'),
    'new_item' => __('New Sidebar', 'esense-functions'),
    'view_item' => __('Preview Sidebar', 'esense-functions'),
    'search_items' => __('Search Sidebars', 'esense-functions'),
    'not_found' => __('No sidebars found.', 'esense-functions'),
    'not_found_in_trash' => __('No sidebars found in Trash.', 'esense-functions'),
	'parent_item_colon' => '',
    'menu_name' => 'Custom Sidebars'
);

register_post_type('sidebar', array(
    'label' => __('Custom Sidebars', 'esense-functions'),
    'labels' => $labels,
    'singular_label' => __('Sidebar', 'esense-functions'),
    'public' => true,
    'show_ui' => true, 
	'show_in_menu' => 'themes.php',
	'menu_position' => null, 
    '_builtin' => false, 
    'exclude_from_search' => true, 
    'capability_type' => 'page',
	'rewrite' => array("slug" => ""), 
    'query_var' => "sidebar", 
     'supports' => array('title'),
    'menu_icon' => ''
));
}
add_action( "init" , "register_sidebar_post_type" ,1 );


##############################################################
# Customize Manage Posts interface
##############################################################

function edit_columns_sidebar($columns) {
    
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __("Sidebar name", 'esense-functions'),
    );

    return $columns;
}


add_filter("manage_edit-sidebar_columns", "edit_columns_sidebar");

//register sidebars
function dp_register_custom_sidebars() {
$sidebars = get_posts( array( 'post_type' => 'sidebar', 'posts_per_page' => '-1', 'suppress_filters' => 'false' ) );

		if ( count( $sidebars ) > 0 ) {
			foreach ( $sidebars as $k => $v ) {
				$sidebar_id = $v->post_name;
				$sidebar_description = get_post_meta($v->ID,'sidebar_description',TRUE);
				register_sidebar( array( 'name' => $v->post_title, 'id' => $sidebar_id, 'description' => $sidebar_description ) );
			}
		}
}
add_action( 'widgets_init', 'dp_register_custom_sidebars',11 );



?>