<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object

	$addpageclass1 = '';
	$addpageclass = " esense-page";
	if (is_page_template('template.fullwidth.vc.php') || is_page_template('template.portfolio-fullwidth.php')) $addpageclass="";
	if (!is_search() && !is_404()) $params = get_post_custom();
	if (is_page_template('template.portfolio-fullwidth.php') || is_page_template('template.portfolio.php') || is_page_template('template.portfolio-nosidebar.php')) {
	$params_ppagestyle = isset( $params['esense-portfolio-params-pagestyle'] ) ? esc_attr( $params['esense-portfolio-params-pagestyle'][0] ) : 'white';
	$addpageclass1 .= ' class=" portfoliobg-'.esc_attr($params_ppagestyle).'"';
	}
	$params_title = isset($params['esense-post-params-title']) ? esc_attr( $params['esense-post-params-title'][0] ) : 'Y';
	$params_sidebarposition = isset($params['esense-post-params-sidebarposition']) ? esc_attr( $params['esense-post-params-sidebarposition'][0] ) : 'default';
	$params_menutype = isset($params['esense-post-params-menutype']) ? esc_attr( $params['esense-post-params-menutype'][0] ) : 'default';
	$params_headertype = isset($params['esense-post-params-headertype']) ? esc_attr( $params['esense-post-params-headertype'][0] ) : 'default';
	$params_subheader_use =  isset( $params['esense-post-params-subheader_use'] ) ? esc_attr( $params['esense-post-params-subheader_use'][0] ) : 'Y';
	$params_breadcrumb_use =  isset( $params['esense-post-params-breadcrumbuse'] ) ? esc_attr( $params['esense-post-params-breadcrumbuse'][0] ) : 'Y';
	$params_custom_subheaderbg_img =  isset( $params['esense-post-params-subheader_img'] ) ? esc_attr( $params['esense-post-params-subheader_img'][0] ) : '';
	$params_custom_title =  isset( $params['esense-post-params-custom_title'] ) ? esc_attr( $params['esense-post-params-custom_title'][0] ) : '';
	$params_custom_subtitle =  isset( $params['esense-post-params-custom_subtitle'] ) ? esc_attr( $params['esense-post-params-custom_subtitle'][0] ) : '';
	$params_subheader_txtcolor =  isset( $params['esense-post-params-subheader_txtcolor'] ) ? esc_attr( $params['esense-post-params-subheader_txtcolor'][0] ) : '';
	$params_paspartusetting =  isset( $params['esense-post-params-paspartusetting'] ) ? esc_attr( $params['esense-post-params-paspartusetting'][0] ) : 'default';
	$params_paspartu_use =  isset( $params['esense-post-params-paspartu-use'] ) ? esc_attr( $params['esense-post-params-paspartu-use'][0] ) : 'N';
	$params_paspartu_bg =  isset( $params['esense-post-params-paspartu-bgcolor'] ) ? esc_attr( $params['esense-post-params-paspartu-bgcolor'][0] ) : '#ffffff';
    $classes = get_body_class();
	$usebreadcrumb = false;
	if(get_option($esense_tpl->name . '_breadcrumbs_state', 'Y') == 'Y' || $params_breadcrumb_use == 'Y') $usebreadcrumb = true;
	if($params_breadcrumb_use == 'N' || is_404() || esense_is_event_page() ) $usebreadcrumb = false;
	$usepaspartu = false;
	if (get_option($esense_tpl->name . "_paspartu_state",'N') == 'Y' || ($params_paspartusetting == 'custom' && $params_paspartu_use == 'Y')) $usepaspartu = true;
	if ($params_paspartusetting == 'custom' && $params_paspartu_use == 'N') $usepaspartu = false;
	// disable direct access to the file	
	defined('ESENSE_WP') or die('Access denied');
	
	// check if the sidebar is set to be a left column
	$args_val = $args == null || ($args != null && $args['sidebar'] == true);
	
	$esense_mainbody_class = '';
	$sidebarposition = '';
	if(get_option($esense_tpl->name . '_sidebar_position', 'right') == 'left' && is_active_sidebar('sidebar') && $args_val) {
		$esense_mainbody_class = 'esense-sidebar-left';
	}
	if ($params_sidebarposition == 'left') {$esense_mainbody_class = 'esense-sidebar-left';}
	if ($params_sidebarposition == 'right') {$esense_mainbody_class = '';}
	if (is_page_template('template.latest_big_thumb_full.php') || is_page_template('template.latest_small_thumb_full.php')) {
	$esense_mainbody_class = 'nosidebar';
	}
		if($esense_mainbody_class !='') $esense_mainbody_class = ' class="'.esc_attr($esense_mainbody_class).'" ';
?>
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
    <div class="clearboth;"></div>
    <?php $pasp_style = '';
	if ($usepaspartu) { 
	if ($params_paspartusetting == 'custom' && $params_paspartu_use == 'Y') {
	$pasp_style = 'style=background-color:'.$params_paspartu_bg.'!important';
	}
	?>
    <div class="paspartu-outer">
    <div <?php echo esc_attr($pasp_style); ?> class="paspartu-top"></div>
    <div <?php echo esc_attr($pasp_style) ?> class="paspartu-left"></div>
    <div <?php echo esc_attr($pasp_style) ?> class="paspartu-right"></div>
    <div <?php echo esc_attr($pasp_style) ?> class="paspartu-bottom"></div>
    <div class="paspartu-inner">
    <?php } ?>
<div id="esense-page-box"<?php echo wp_kses_post($addpageclass1); ?>>
		<!--   Begin Top Panel widget area -->
        <?php if(get_option($esense_tpl->name . "_top_bar_state") == 'Y') { ?>
        <div id="esense-top-bar" >
        <div class="esense-page pad10">
        <div class="top-contact-bar">
        <?php if(get_option($esense_tpl->name . "_top_contact_adress") != '') : ?>
        <div class= "top-bar-adress"><i class="icon-marker"></i><span><?php echo esc_html(get_option($esense_tpl->name . "_top_contact_adress"))?></span></div>
        <?php endif; ?>
        <?php if(get_option($esense_tpl->name . "_top_contact_phone") != '') : ?>
        <div class= "top-bar-phone"><i class="icon-phone"></i><span><?php echo esc_html(get_option($esense_tpl->name . "_top_contact_phone"))?></span></div>
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
        </div>
        </div>
        <div class="clearboth"></div>
        <?php } ?>
		<!--   End Top Panel widget area -->
        <?php esense_load('mobile-header'); ?>
		<?php
		 if ($params_menutype == "default") {
		 if (get_option($esense_tpl->name . '_main_menu_type','top') == "top")	esense_load('main-nav');  
         if (get_option($esense_tpl->name . '_main_menu_type','top') == "aside") esense_load('main-nav-aside'); 
         if (get_option($esense_tpl->name . '_main_menu_type','top') == "overlay") esense_load('main-nav-overlay'); 
		 } else {
		 if ($params_menutype == "top")	esense_load('main-nav');  
         if ($params_menutype == "aside") esense_load('main-nav-aside'); 
         if ($params_menutype == "overlay") esense_load('main-nav-overlay'); 
		 }
		 ?>                              
        
        <!--   Begin subheader wrapper -->
		<?php if($params_title == 'Y') : ?>
        <?php if (esense_is_event_page() && get_option($esense_tpl->name . '_tribe_show_subheader') != "Y" ) $params_subheader_use ='N'; ?>
        <?php if($params_subheader_use == 'Y' && !is_front_page() && !is_404()) : ?>
        <?php $shimage = $subheaderinnerstyle = $shtitlestyle = "";
		if (get_option($esense_tpl->name . '_subheader_area_bgimage') != "") $shimage = get_option($esense_tpl->name . '_subheader_area_bgimage');
		if (esense_is_event_page() && get_option($esense_tpl->name . '_tribe_subheader_area_bgimage') != "") $shimage = get_option($esense_tpl->name . '_tribe_subheader_area_bgimage');
		if($params_custom_subheaderbg_img != '') $shimage = $params_custom_subheaderbg_img;
		if ($shimage != "") {
			$subheaderinnerstyle = 'style="background-image:url('.esc_url($shimage).'); background-size:cover;"';
		 } 
		if ($params_subheader_txtcolor != "") $shtitlestyle = ' style="color:'.$params_subheader_txtcolor.' !important;"';
		if (esense_is_event_page() && get_option($esense_tpl->name . '_tribe_subheader_text_color') != "") $shtitlestyle = ' style="color:'.get_option($esense_tpl->name . '_tribe_subheader_text_color').' !important;"';
		?>
        <?php if(is_single() || is_page() || is_archive() || is_search() || is_404()  || ( is_home() && ! is_front_page() ) ) : ?>
        <div class="esense-subheader-wraper">
        <div class="subheader-inner" <?php echo wp_kses_post($subheaderinnerstyle) ?>>
        <div class="esense-page pad10">
        <div class="esense-subheader">
        <div class="subheader-title-holder">
        <?php if($params_custom_title != '') : ?>
        <h1 class="main-title"<?php echo  $shtitlestyle; ?>><?php echo esc_html($params_custom_title) ?></h1>
        <?php else : ?>
        <?php
		if ( is_home() && ! is_front_page() ) { ?>
        <h1 class="main-title"<?php echo wp_kses_post( $shtitlestyle); ?>><?php echo get_the_title( get_option('page_for_posts', true) ); ?> </h1>
		<?php } elseif (is_category()) { ?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php	echo		'<span>' . single_cat_title( '', false ) . '</span>' ?></h1>
		<?php } elseif (is_404()) { ?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php esc_html_e( '404 Page', 'dp-esense' ); ?></h1>
		<?php } elseif (is_search()) { ?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php printf( esc_attr__( 'Search Results for: %s', 'dp-esense' ), '<em>' . get_search_query() . '</em>' ); ?>
</h1>
		<?php }  elseif (esense_is_event_page()) { 
		
		?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php echo esc_html(get_option($esense_tpl->name . '_tribe_pages_title')); ?></h1>
		<?php } elseif (is_archive()) { ?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>>		<?php if ( is_day() ) : ?>
			<?php printf( esc_attr__( 'Daily Archives: %s', 'dp-esense' ), '<span>' . get_the_date() . '</span>' ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( esc_attr__( 'Monthly Archives: %s', 'dp-esense' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( esc_attr__( 'Yearly Archives: %s', 'dp-esense' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
		<?php else : ?>
			<?php esc_attr__( 'Blog Archives', 'dp-esense' ); ?>
		<?php endif; ?>
		</h1>
		<?php } else { ?>
        <h1 class="main-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php the_title(); ?></h1>
		<?php }
		?>
        <?php endif; ?>
        <?php if($params_custom_subtitle != '') : ?>
        <p class="sub-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php echo esc_html($params_custom_subtitle) ?></p>
        <?php endif; ?>
        <?php if(esense_is_event_page() && get_option($esense_tpl->name . '_tribe_pages_subtitle') != '') : ?>
        <p class="sub-title"<?php echo  wp_kses_post($shtitlestyle); ?>><?php echo esc_html(get_option($esense_tpl->name . '_tribe_pages_subtitle')) ?></p>
        <?php endif; ?>
        <?php endif; ?>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php endif; ?>
        
        <?php endif; ?>
        <!--   Begin Slideshow area -->
		<?php if(is_active_sidebar('slideshow')) : ?>
        <section id="esense-slideshow">
                <?php esense_dynamic_sidebar('slideshow'); ?>
        </section>
        <?php endif; ?>
        <!--   End slideshow area -->
        <!--   End subheader wrapper -->
				<!-- Mainbody, breadcrumbs -->
                <?php if($usebreadcrumb) : ?>
				<div id="esense-breadcrumb-fontsize">
                <div class="esense-page pad10">
					<?php esense_breadcrumbs_output(); ?>
                </div>
				</div>
                <?php endif; ?>

<div class="clearboth"></div>
<section class="esense-page-wrap <?php echo esc_attr($addpageclass) ?>">
               

	<section id="esense-mainbody-columns" <?php echo wp_kses_post($esense_mainbody_class); ?>>			
			<section>
            <div id="esense-content-wrap">