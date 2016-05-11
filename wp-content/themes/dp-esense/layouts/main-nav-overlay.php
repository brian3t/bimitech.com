<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

        <!--   Begin Navigation area -->
		<div id="esense-navigation-wrapper">
        <div class="esense-head-wrap semi-transparent">
            <div class="esense-page">
                <header id="esense-head" class="top-navigation">
                    <?php if(get_option($esense_tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
                    <h2><a href="<?php echo esc_url( home_url('/')); ?>" class="<?php echo get_option($esense_tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php esense_blog_logo(); ?></a></h2>
                    <?php endif; ?>                        
                    <a href="#" class="esense-overlay-menu-toggle"><i class="icon-menu"></i></a>                   
                </header>
            </div>
        </div>
        </div>
        <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <div class="esense-overlay-menu">
		<div class="esense-overlay-menu-close"><i class="icon-close"></i></div>
            <div class="overlay-nav">
							<?php 
							if(has_nav_menu('mainmenu')) {
							esense_menu('mainmenu', 'esense-main-menu', array('walker' => new Esense_MenuWalker()),'overlay-menu');							
							} else {
								echo 'No menu assigned!';
							}
							?>
            </div>
		</div>
        </div>
        </div>
        </div>
        

		<!--   End Navigation area -->
