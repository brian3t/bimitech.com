<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $esense_tpl;
global $woocmmerce;
global $product;
global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * woocommerce_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			//do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			//do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
<div class ="esense-product-desc">
		<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
        
                <?php 
				if (get_option($esense_tpl->name . '_woocommerce_list_categories','Y') == 'Y') {
				$product_cats = $product->get_categories( ', ', '', '' ); ?>
                    <div class="category"><?php echo  $product_cats;?></div>
                <?php } ?>
        <?php if(get_option($esense_tpl->name . '_woocommerce_hide_prices','N') != 'Y'){ ?>
		<div class="esense-wc-price"><?php do_action( 'woocommerce_after_shop_loop_item_price' ); ?></div>
        <?php } ?>
		<?php if (get_option($esense_tpl->name . '_woocommerce_list_rating','Y') == 'Y') { ?>
		<div class="esense-wc-rating clearfix"><?php do_action( 'woocommerce_after_shop_loop_item_rating' );?></div>
        <?php } ?>
        <div class="clearboth"></div>
		<?php
		// Short description on catalog pages
		if(get_option($esense_tpl->name . '_woocommerce_short_description', 'Y') == 'Y') : 
			$count = get_option($esense_tpl->name . '_woocommerce_short_desc_count', '');
			if(trim($count) == '') {
				$count = 50;
			}
			echo esense_wc_short_description($count);
		endif;
		echo esense_wc_long_description();	
		?>
		<?php if (get_option($esense_tpl->name . '_woocommerce_list_cart_button','Y') == 'Y' && get_option($esense_tpl->name . '_woocommerce_catalog','N') != 'Y') { ?>
		<div class="esense-wc-add-button"><?php echo woocommerce_template_loop_add_to_cart(); ?></div>
		<?php } ?>

</div>			
        
	
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>