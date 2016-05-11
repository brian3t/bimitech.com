<?php 
	
	/**
	 *
	 * Template part loading the responsive CSS code
	 *
	 **/
	
	// create an access to the template main object

	// disable direct access to the file	
	defined('ESENSE_WP') or die('Access denied');
	
?>

<style type="text/css">
	<?php $boxed_template_width = (int)get_option($esense_tpl->name . '_template_width', 1230) ;
		 $vc_esense_page_width = (int)get_option($esense_tpl->name . '_template_width', 1230)+10;
		 $boxed_body_width = (int)get_option($esense_tpl->name . '_template_width', 1230)+40;
	 ?>
	.esense-page{max-width: <?php echo esc_attr($boxed_template_width); ?>px;}
	.esense-page.vc {max-width: <?php echo esc_attr($vc_esense_page_width); ?>px;}
	.boxed #esense-page-box {max-width: <?php echo esc_attr($boxed_body_width); ?>px;}
	<?php if(
		get_option($esense_tpl->name . '_sidebar_position', 'right') != 'none' && 
		(is_active_sidebar('sidebar') || is_active_sidebar('woosidebar')) && 
		($fullwidth != true)
	) : ?>
	#esense-mainbody-columns > aside { width: <?php echo esc_attr(get_option($esense_tpl->name . '_sidebar_width', '30')); ?>%;}
	#esense-mainbody-columns > section { width: <?php echo 100 - esc_attr(get_option($esense_tpl->name . '_sidebar_width', '30')); ?>%; }
	#esense-mainbody-columns { background-position: <?php echo (get_option($esense_tpl->name . '_sidebar_position', 'right') == 'right') ? 100 - get_option($esense_tpl->name . '_sidebar_width', '30') : get_option($esense_tpl->name . '_sidebar_width', '30'); ?>% 0; }
	<?php else : ?>
	#esense-mainbody-columns > section { width: 100%; }
	<?php endif; ?>
	</style>