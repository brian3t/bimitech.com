<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>
        <!--   Begin logo area -->
		<div id="esense-navigation-wrapper" class="clearfix">
        <div class="esense-head-wrap semi-transparent">
            <div class="esense-page">
                <header id="esense-head" class="top-navigation">
                    <div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                    <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2>
                        <a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a>
                    </h2>
                    <?php endif; ?>
		        			</div>
        				</div>
        			</div>

                </header>
            </div>
        </div>
        </div>
		<!--   End logo area -->
        <!--   Begin Navigation area -->
        <?php
		$addclass = ' fixedaside';
		if (get_option($esense_tpl->name . "_aside_menu_sliding", 'N') == 'Y')  $addclass = ' slidingaside';
		$addstyle= '';
		if(get_option($esense_tpl->name . "_aside_mainmenu_bg_color", '') != '') $addstyle= 'style="background-color:'.esc_attr(get_option($esense_tpl->name . "_aside_mainmenu_bg_color", '')).'"';?>
		<div class="esense-aside-navigation-wrapper <?php echo esc_attr($addclass); ?>" <?php echo wp_kses_post($addstyle); ?> >
        <a href="#" class="esense-aside-menu-toggle"><i class="icon-menu "></i></a>
             <div class="esense-aside-navigation-wrapper-inner">
                <div class="esense-aside-navigation-wrapper-inner-content">                
                <header id="esense-head-aside">
                <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2><a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo esc_attr(get_option($esense_tpl->name . "_branding_logo_type", 'css')); ?>Logo"><?php esense_aside_menu_logo(); ?></a></h2>
				<?php endif; ?>
                </header>
                   
							<?php 
							if(has_nav_menu('mainmenu')) {
							esense_menu('mainmenu', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'sf-menu sf-vertical main-aside-menu');							}
							else {
								echo esc_html_e('No menu assigned!','dp-esense');
							}
							?>
   <div class="clearboth"></div>
   <div class="aside-button-bar">
       <?php if(function_exists("is_woocommerce") && (get_option($esense_tpl->name . "_cart_aside_state") == 'Y')){
		esense_load('wc_dropdown_cart');
        } ?> 

        <?php if ( function_exists('icl_object_id') && (get_option($esense_tpl->name . "_language_switcher_aside_state") == 'Y')) {
     	esense_language_switcher();
		} ?>
   </div>  
        
        </div>
        <?php if(get_option($esense_tpl->name . "_social_links_aside_state") == 'Y') { ?>
<div class="social-bar-container"><div class="centered-block-outer">
 						<div class="centered-block-middle">
  							<div class="centered-block-inner">
                             
                    		<ul class="social-bar rounded">
                    		<?php esense_social_bar_content(); ?>
        					</ul>
        					</div>           
                    		</div>
        				</div>
        			</div>        
        <?php } ?>

                
            </div>
        </div>
		<!--   End Navigation area -->
