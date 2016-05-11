<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $esense_tpl;
$listing_columns = get_option($esense_tpl->name . '_woocommerce_list_columns','3');
if(isset($_GET['listing_columns'])) $listing_columns = $_GET['listing_columns'];
$addclass='';
$classes = get_body_class();
if (in_array('archive',$classes)) {
$addclass = 'product-columns-'.$listing_columns.' '.get_option($esense_tpl->name . '_woocommerce_list_prefered_view','grid').'-layout';
}
if (is_product()) $addclass = 'product-columns-'.get_option($esense_tpl->name . '_woocommerce_related_columns','4');
?>
<ul class="products <?php echo $addclass; ?>">