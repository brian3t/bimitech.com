<?php

/*
Template Name: WooCommerce
*/ 

$fullwidth = true;

if(get_option($esense_tpl->name . '_woocommerce_show_sidebar', 'N') == 'Y') :
	$fullwidth = false;
endif;
if(isset($_GET['listing_sidebar'])) {
if($_GET['listing_sidebar'] == "yes") $fullwidth = false;
if($_GET['listing_sidebar'] == "no") $fullwidth = true;
}
esense_load('header');
if($fullwidth == false) :
	esense_load('before-woocommerce');
else :
	esense_load('before-woocommerce',array('sidebar' => false));
endif;


?>

<div id="esense-mainbody">
	<?php do_action('woocommerce_before_main_content'); ?>

	<?php woocommerce_content(); ?>
	
	<?php do_action('woocommerce_after_main_content'); ?>
</div>
<?php

if($fullwidth == false) :
	esense_load('after');
else :
	esense_load('after', array('sidebar' => false));
endif;

esense_load('footer');

// EOF