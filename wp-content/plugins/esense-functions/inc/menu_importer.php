<?php
if (!function_exists("dp_get_wp_path")) {
	function dp_get_wp_path($filename) {
		$url = explode("wp-content", dirname( __FILE__ ));
		if (count($url) <= 1) {
			$url = explode("wp-admin", dirname( __FILE__ ));
			if (count($url) <= 1) {
				$url[0] = dirname( __FILE__ )."/";
			}
		}	
		return $url[0].$filename;
	}
}

if(isset($external)) {
	require_once(dp_get_wp_path('wp-load.php'));
}
require_once(dp_get_wp_path('wp-includes/pluggable.php'));
require_once(dp_get_wp_path('wp-admin/includes/upgrade.php'));
if(isset($external)) {
	require_once(dp_get_wp_path('wp-admin/includes/image.php'));
}
global $wpdb;

function dp_filter_results($content) {
	
	$content = str_replace('src="', 'src=\"', $content);
	$content = str_replace('"</img', '\"</img', $content);
	
	return $content;
	
}

function dp_import_menu($file='') {
	global $wpdb;
	
	if (isset($_POST['import']) && $_POST['import'] == 1 && !isset($file)) {
		if ($_FILES['dp_menu_file']['error'] == UPLOAD_ERR_OK               
		      && is_uploaded_file($_FILES['dp_menu_file']['tmp_name'])) { 

		  ini_set('max_execution_time', '240');
		  set_time_limit(240);
		  
		  eval(dp_filter_results(str_replace("#wpurl#", get_bloginfo("wpurl"), file_get_contents($_FILES['dp_menu_file']['tmp_name'])))); 
		}		
	}
	if(isset($file)) {
		
		ini_set('max_execution_time', '240');
		set_time_limit(240);
		eval(str_replace("wp_redirect", "//wp_redirect", str_replace("#wpurl#", get_bloginfo("wpurl"), file_get_contents($file))));
		
	}
	
}

?>