<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post;
global $product;
?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php 
		$badge = '<div class="onsale"><div class="onsale-inner">' . esc_attr__( 'Sale!', 'esense-functions' ) . '</div></div>';

	echo apply_filters( 'woocommerce_sale_flash', $badge, $post, $product ); ?>

<?php endif; ?>