<?php 
	
	/**
	 *
	 * Template elements after the page content
	 *
	 **/
	
	// create an access to the template main object
	// disable direct access to the file
		
	defined('ESENSE_WP') or die('Access denied');
	
?>
		
			</div><!-- end of the #esense-content-wrap -->
			
			</section><!-- end of the mainbody section -->
		
			<?php 
			if(
				get_option($esense_tpl->name . '_sidebar_position', 'right') != 'none' && 
				(esense_is_active_sidebar('sidebar') || (esense_is_active_sidebar('woosidebar'))) && 
				(
					$args == null || 
					($args != null && $args['sidebar'] == true )
				)
			) : ?>
			<?php do_action('esense_wp_before_column'); ?>
			<aside id="esense-sidebar">
            <?php 
			if (class_exists('Woocommerce') && is_woocommerce()) { esense_dynamic_sidebar('woosidebar');} else {esense_dynamic_sidebar('sidebar');} ?>
			</aside>
			<?php do_action('esense_wp_after_column'); ?>
			<?php endif; ?>
		</section><!-- end of the #esense-mainbody-columns -->
</section><!-- end of the .esense-page-wrap section -->	


<div class="clearboth"></div>