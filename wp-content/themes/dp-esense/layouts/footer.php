<?php 
	
	/**
	 *
	 * Template footer
	 *
	 **/
	
	// create an access to the template main object

	// disable direct access to the file	
	defined('ESENSE_WP') or die('Access denied');
	$usepaspartu = false;
	$params_paspartusetting =  isset( $params['esense-post-params-paspartusetting'] ) ? esc_attr( $params['esense-post-params-paspartusetting'][0] ) : 'default';
	if (get_option($esense_tpl->name . "_paspartu_state",'N') == 'Y' || ($params_paspartusetting == 'custom' && $params_paspartu_use == 'Y')) $usepaspartu = true;
?>
<?php $add_footer_class = '';
if(!esense_is_active_sidebar('footer') && !esense_is_active_sidebar('footer1') && !esense_is_active_sidebar('footer2') && !esense_is_active_sidebar('footer3')) {$add_footer_class = ' class="nofooter"';
}
?>
<div id="esense-footer-wrap" <?php echo wp_kses_post($add_footer_class);?>>
<?php if(esense_is_active_sidebar('footer')) : ?>
<div id="esense-footer" class="esense-page widget-area">
	<?php esense_dynamic_sidebar('footer'); ?>
</div>
<?php endif; ?>
<?php if(esense_is_active_sidebar('footer1') || esense_is_active_sidebar('footer2') || esense_is_active_sidebar('footer3')) { ?>
<div id="esense-footer" class="esense-page widget-area">	
<div class="one_fourth no-margin-right">
<?php if(esense_is_active_sidebar('footer1')) : ?>
<div id="esense-footer1" class="esense-page widget-area">
	<?php esense_dynamic_sidebar('footer1'); ?>
</div>
<?php endif; ?>
</div>
<div class="one_half no-margin-right">
<?php if(esense_is_active_sidebar('footer2')) : ?>
<div id="esense-footer2" class="esense-page widget-area">
	<?php esense_dynamic_sidebar('footer2'); ?>
</div>
<?php endif; ?>
</div>
<div class="one_fourth  no-margin-right">
<?php if(esense_is_active_sidebar('footer3')) : ?>
<div id="esense-footer3" class="esense-page widget-area">
	<?php esense_dynamic_sidebar('footer3'); ?>
</div>
<?php endif; ?>


</div>
</div>
<?php } ?>
<div class="clearboth"></div>

<?php if(get_option($esense_tpl->name . "_copyright_use_state") == 'Y') { 
$iscopyrightcentered = false;
if(get_option($esense_tpl->name . "_copyright_style") == 'centered') $iscopyrightcentered = true;
?>
<div id="esense-copyright-wrap">
<div id="esense-copyright"  class="esense-page padding10">
	<?php if($iscopyrightcentered) { ?>
    <div id="esense-copyright-inner" class="centered-copyright">
    
    <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner"><div class="space30"></div>
            <?php if ( has_nav_menu( 'footer-menu' ) ) {?>
			<div id="esense-footer-menu"><?php esense_menu('footer-menu', 'esense-footer-menu', array('walker' => new Esense_MenuWalker()), 'footer-menu'); ?></div>
            <?php } ?>
        </div>
       </div>
     </div>
     <div class="clearboth"></div>        
    <div class="centered-block-outer">
                <div class="centered-block-middle">
                    <div class="centered-block-inner">
            <?php if(get_option($esense_tpl->name . "_social_icons_footer_state") == 'Y') { ?>
            <ul class="social-bar rounded">
            <?php esense_social_bar_content_footer(); ?>
            </ul>
            <?php } ?>
            </div>
           </div>
         </div>
     <div class="clearboth"></div>        
     <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <div class="esense-copyrights"> 
<div class="esense-copyrights-text">Built in 2016 by <a href="http://superbappsolutions.com" target="_blank">SuperbAppSolutions</a></div>
        </div>
        </div>
       </div>
     </div>
     <div class="clearboth"></div>        
	</div>
    <?php } else { ?>
    <div id="esense-copyright-inner">        
	<?php if(get_option($esense_tpl->name . "_social_icons_footer_state") == 'Y') { ?>
        <ul class="social-bar rounded">
        <?php esense_social_bar_content_footer(); ?>
        </ul>
        <?php } ?>

        <div class="esense-copyrights"> 
        <div class="esense-copyrights-text">Built in 2016 by <a href="http://superbappsolutions.com" target="_blank">SuperbAppSolutions</a></div>
            <?php if ( has_nav_menu( 'footer-menu' ) ) {?>
			<div id="esense-footer-menu"><?php esense_menu('footer-menu', 'esense-footer-menu', array('walker' => new Esense_MenuWalker()), 'footer-menu'); ?></div>
            <?php } ?>
        </div>
        
	</div>
    <?php } ?>
    </div>
</div>
<?php } ?>
</div>
 
    <div id="back-to-top"></div>
    
    <?php esense_load('social'); 	?>
	<?php esense_load('search'); ?>
	<?php do_action('esense_wp_footer'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($esense_tpl->name . '_footer_code', ''))
			)
		); 
	?>
    
	<?php do_action('esense_wp_ga_code'); ?>
<div id="esense-mobile-menu">
<i id="close-mobile-menu" class="icon-close"></i>
<div class="mobile-menu-inner">
<?php 
		if (get_option($esense_tpl->name . "_top_main_menu_alignment", 'default') == 'menu_splited') {
			esense_menu_mobile('mainmenu-left', 'esense-main-menu', array('walker' => new Esense_MenuWalkerMobile()),'aside-menu');
			esense_menu_mobile('mainmenu-right', 'esense-main-menu', array('walker' => new Esense_MenuWalkerMobile()),'aside-menu');
		} else {
		esense_menu_mobile('mainmenu', 'esense-main-menu', array('walker' => new Esense_MenuWalkerMobile()),'aside-menu'); 
		}
		?>
</div>
</div>    
</div>	
			<?php esense_load('aside'); ?>
    <?php if ($usepaspartu) { ?>
    </div>
    </div>
    <?php } ?>
    <?php wp_footer(); ?>
</body>
</html>
