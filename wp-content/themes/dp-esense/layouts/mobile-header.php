<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

        <!--   Begin Mobile Header area -->
		<div id="esense-mobile-header-wrapper">
			<div class="esense-head-wrap semi-transparent">
            	<div class="esense-page pad10 clearfix">
                
               
                <a href="#" class="esense-mainmenu-toggle"><i class="icon-menu"></i></a>                   
               
                
                   <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2><a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a></h2>
                    <?php endif; ?>
        		</div>
        	</div>
        </div>
		<!--   End Mobile header -->
