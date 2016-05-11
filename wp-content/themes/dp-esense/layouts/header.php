<?php 
	
	/**
	 *
	 * Template header
	 *
	 **/
	
	// create an access to the template main object

?>
<?php do_action('esense_wp_doctype'); ?>
<html <?php do_action('esense_wp_html_attributes'); ?>>
<head>
	<?php do_action('esense_wp_metatags'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php do_action('esense_wp_fonts'); ?>
	<?php esense_head_config(); ?>
	
	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php do_action('esense_wp_ie_scripts'); ?>
	<?php esense_head_style_pages(); ?>	
	<?php esense_thickbox_load(); ?>	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($esense_tpl->name . '_head_code', ''))
			)
		); 
	?>    
	<?php esense_load('responsive_css'); ?> 	
    <?php wp_head(); ?>
</head>