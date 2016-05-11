<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object
	$addpageclass = " esense-page";
    $classes = get_body_class();
	$usebreadcrumb = false;
	if(get_option($esense_tpl->name . '_breadcrumbs_state', 'Y') == 'Y') $usebreadcrumb = true;
	$usepaspartu = false;
	if (get_option($esense_tpl->name . "_paspartu_state",'N') == 'Y') $usepaspartu = true;
	// disable direct access to the file	
	defined('ESENSE_WP') or die('Access denied');
	
	// check if the sidebar is set to be a left column
	$args_val = $args == null || ($args != null && $args['sidebar'] == true);
	
	$esense_mainbody_class = '';
	$sidebarposition = '';
	if(get_option($esense_tpl->name . '_sidebar_position', 'right') == 'left' && is_active_sidebar('woosidebar') && $args_val) {
		$esense_mainbody_class = 'esense-sidebar-left';
	}
	$esense_mainbody_class = ' class="'.esc_attr($esense_mainbody_class).'" ';?>

<body <?php do_action('esense_wp_body_attributes'); ?>>
	<?php if(get_option($esense_tpl->name . "_use_page_preloader") == 'Y') : ?>
<div id="esense_preloader">
<div class="spinner_outer">
<div class="spinner_middle">
<div class="spinner_inner">
<div class="spinner">
		  <div class="double-bounce1"></div>
		  <div class="double-bounce2"></div>
	 </div>
</div>
</div>
</div>
</div>
    <?php endif; ?>
    <?php $pasp_style = '';
	if ($usepaspartu) { 
	?>
    <div class="paspartu-outer">
    <div class="paspartu-top"></div>
    <div class="paspartu-left"></div>
    <div class="paspartu-right"></div>
    <div class="paspartu-bottom"></div>
    <div class="paspartu-inner">
    <?php } ?>
<div id="esense-page-box">
		<!--   Begin Top Panel widget area -->
        <?php if(get_option($esense_tpl->name . "_top_bar_state") == 'Y') { ?>
        <div id="esense-top-bar" >
        <section class="esense-page pad10">
        <div class="top-contact-bar">
        <?php if(get_option($esense_tpl->name . "_top_contact_adress") != '') : ?>
        <div class= "top-bar-adress"><i class="icon-marker"></i><span><?php echo wp_kses_post(get_option($esense_tpl->name . "_top_contact_adress"))?></span></div>
        <?php endif; ?>
        <?php if(get_option($esense_tpl->name . "_top_contact_phone") != '') : ?>
        <div class= "top-bar-phone"><i class="icon-phone"></i><span><?php echo wp_kses_post(get_option($esense_tpl->name . "_top_contact_phone"))?></span></div>
        <?php endif; ?>
        <?php if(get_option($esense_tpl->name . "_top_contact_email") != '') : ?>
        <div class= "top-bar-email"><i class="icon-email"></i><span>
        <?php if(get_option($esense_tpl->name . "_top_contact_email_link") == 'Y') : ?>
        <a href="mailto:<?php echo get_option($esense_tpl->name . "_top_contact_email")?>">
        <?php endif; ?>
        <?php if((get_option($esense_tpl->name . "_top_contact_email_link") == 'Y') && (get_option($esense_tpl->name . "_top_contact_email_hide") == 'Y')){ 
		echo esc_html(get_option($esense_tpl->name . "_top_contact_email_text"));
		 } else { 
		echo esc_html(get_option($esense_tpl->name . "_top_contact_email"));
		} ?>
        </span></div>
        <?php if(get_option($esense_tpl->name . "_top_contact_email_link") == 'Y') : ?>
        </a>
        <?php endif; ?>
        <?php endif; ?>
        </div>
        <?php if ( get_option($esense_tpl->name . "_top_bar_usermenu_state") == 'Y') {
		esense_user_menu(get_option($esense_tpl->name . "_top_bar_user_menu"));
		} ?>
        <?php if ( function_exists('icl_object_id') && (get_option($esense_tpl->name . "_language_switcher_top_bar_state") == 'Y')) {
     	esense_language_switcher();
		} ?>
        <?php if(function_exists("is_woocommerce") && (get_option($esense_tpl->name . "_top_bar_cart_state") == 'Y')){
		esense_load('wc_dropdown_cart');
        } ?>                    
        <?php if(get_option($esense_tpl->name . "_social_links_top_bar_state") == 'Y') { ?>
        <ul class="social-bar diamond">
        <?php esense_social_bar_content(); ?>
        </ul>
        <?php } ?>
        </section>
        </div>
        <div class="clearboth"></div>
        <?php } ?>
		<!--   End Top Panel widget area -->
        <?php esense_load('mobile-header'); ?>
        
		<?php
		 if (get_option($esense_tpl->name . '_main_menu_type','top') == "top")	esense_load('main-nav');  
         if (get_option($esense_tpl->name . '_main_menu_type','top') == "aside") esense_load('main-nav-aside'); 
         if (get_option($esense_tpl->name . '_main_menu_type','top') == "overlay") esense_load('main-nav-overlay'); 
		 ?>                              
        
        <!--   Begin subheader wrapper -->
        <?php if( !is_front_page()) : ?>
        <?php $shimage = $subheaderinnerstyle = "";
		if (get_option($esense_tpl->name . '_wc_subheader_area_bgimage') != "") $shimage = get_option($esense_tpl->name . '_wc_subheader_area_bgimage');
		if ($shimage != "") {
			$subheaderinnerstyle = 'style="background-image:url('.esc_url($shimage).'); background-size:cover;"';
		 } ?>
        <div class="esense-subheader-wraper">
        <div class="subheader-inner" <?php echo wp_kses_post($subheaderinnerstyle) ?>>
        <div class="esense-page pad10">
        <div class="esense-subheader">
        <div class="subheader-title-holder">
		<h1 class="main-title"><?php echo esc_html(get_option($esense_tpl->name . '_woocommerce_pages_title','Shop')) ?></h1>
        <p class="sub-title"><?php echo esc_html(get_option($esense_tpl->name . '_woocommerce_pages_subtitle')) ?></p>
        <?php endif; ?>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!--   End subheader wrapper -->
				<!-- Mainbody, breadcrumbs -->
                <?php if($usebreadcrumb) : ?>
				<div id="esense-breadcrumb-fontsize">
                <div class="esense-page pad10">
					<?php
                        $breadcrumbsargs = array(
                                'delimiter' => '&nbsp;&#8594;&nbsp;'
                        );
                    ?>
					<?php woocommerce_breadcrumb($breadcrumbsargs); ?>
                </div>
				</div>
                <?php endif; ?>
<div class="clearboth"></div>
<section class="esense-page-wrap <?php echo esc_attr($addpageclass) ?>">
               

	<section id="esense-mainbody-columns" <?php echo wp_kses_post($esense_mainbody_class); ?>>			
			<section>
            <div id="esense-content-wrap">