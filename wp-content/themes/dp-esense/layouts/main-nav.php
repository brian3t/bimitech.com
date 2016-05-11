<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

        <!--   Begin Navigation area -->
        <?php $headerclass = get_option($esense_tpl->name . "_top_main_menu_alignment", 'default'); 
		if (get_option($esense_tpl->name . "_top_main_menu_alignment", 'default') == 'menu_metro') $headerclass .= ' '.get_option($esense_tpl->name . "_menutabs_allignment", 'metromenucenter');  
		?>
		<div id="esense-navigation-wrapper" class="clearfix">
        <div class="esense-head-wrap semi-transparent <?php echo esc_attr($headerclass); ?>">
            <div class="esense-page">
                <header id="esense-head" class="top-navigation">
                <?php if ($headerclass == 'menu_splited') { ?>
                <div class="left_menu_container">
                <?php 
				if(has_nav_menu('mainmenu-left')) {
							esense_menu('mainmenu-left', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'sf-menu main-top-menu');
						} else {echo 'No menu assigned!';}
				?>
                </div>
                <div class= "logo_center_container">
                    <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2><a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a></h2>
                    <?php endif; ?>
               </div>
                <div class="right_menu_container">
                <?php 
				if(has_nav_menu('mainmenu-right')) {
							esense_menu('mainmenu-right', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'sf-menu main-top-menu');
						} else {echo esc_html_e('No menu assigned!','dp-esense');}
				?>
                    <?php if((get_option($esense_tpl->name . '_search_link', 'Y') == 'Y') || is_active_sidebar('aside')) : ?>
                    <div class="esense-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="esense-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($esense_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="esense-header-search"></a>
						<?php endif; ?>
                        <?php if(function_exists("is_woocommerce") && get_option($esense_tpl->name . "_menu_cart_link", 'css') == 'Y'){
						esense_load('wc_dropdown_cart');
                        } ?>                    

                    </div>                        
                    <?php endif; ?>
                </div>
                <?php } elseif ($headerclass == 'menu_magazine') { ?>
                 	<?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
                    <?php if(is_active_sidebar('topmenuadd')) : ?>
                    <div class="magazine-menu-advertisment">
                       <?php esense_dynamic_sidebar('topmenuadd'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="magazine-menu-separator"></div>
                    <?php if((get_option($esense_tpl->name . '_search_link', 'Y') == 'Y') || is_active_sidebar('aside') || (get_option($esense_tpl->name . '_menu_cart_link', 'N') == 'Y')) : ?>
                    <div class="esense-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="esense-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($esense_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="esense-header-search"></a>
						<?php endif; ?>
						<?php if ( function_exists('icl_object_id') && (get_option($esense_tpl->name . "_menu_language_switcher") == 'Y')) {
                        esense_load('wpml_lang_switcher');
                        } ?>
                        <?php if(function_exists("is_woocommerce") && get_option($esense_tpl->name . "_menu_cart_link", 'N') == 'Y'){
						esense_load('wc_dropdown_cart');
                        } ?>                    
                    </div>                        
                    <?php endif; ?>
							<?php 
							if(has_nav_menu('mainmenu')) {
							esense_menu('mainmenu', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'sf-menu main-top-menu');							}
							else {
								echo esc_html_e('No menu assigned!','dp-esense');;
							}
							?>
                <?php } else { ?>
                    <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
                    <?php if ($headerclass == 'menu_centered') { ?>
                    <div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                    <?php } ?>
                    <?php if((get_option($esense_tpl->name . '_search_link', 'N') == 'Y') || is_active_sidebar('aside') || (get_option($esense_tpl->name . '_menu_cart_link', 'N') == 'Y')) : ?>
                    <div class="esense-button-area"> 
                        <?php if(is_active_sidebar('aside')) : ?>
                        <a href="" class="esense-sidebar-button"></a>
                        <?php endif; ?>
						<?php if(get_option($esense_tpl->name . '_search_link', 'Y') == 'Y') : ?>
                        <a href="#" class="esense-header-search"></a>
						<?php endif; ?>
						<?php if ( function_exists('icl_object_id') && (get_option($esense_tpl->name . "_menu_language_switcher") == 'Y')) {
                        esense_load('wpml_lang_switcher');
                        } ?>
                        <?php if(function_exists("is_woocommerce") && get_option($esense_tpl->name . "_menu_cart_link", 'N') == 'Y'){
						esense_load('wc_dropdown_cart');
                        } ?>                    
                    </div>                        
                    <?php endif; ?>
							<?php 
							if(has_nav_menu('mainmenu')) {
							esense_menu('mainmenu', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'sf-menu main-top-menu');							}
							else {
								echo esc_html_e('No menu assigned!','dp-esense');
							}
							?>
                    <?php if ($headerclass == 'menu_centered') { ?>
		        			</div>
        				</div>
        			</div>
                    <?php } } ?>

                </header>
            </div>
        </div>
        </div>
		<!--   End Navigation area -->
