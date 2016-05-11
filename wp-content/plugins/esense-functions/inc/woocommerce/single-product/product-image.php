<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post ;
global $woocommerce;

?>
<div class="images wc-image-zoom" data-zoomtext="<?php echo esc_attr__('zoom', 'esense-functions'); ?>">
<figure class="single-product-img">

	<?php
		if ( has_post_thumbnail() ) {

			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );

			if ( $attachment_count != 1 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
			$output = $image.'<div class="text-overlay"><div class="info"><span><a href="'.$image_link.'" itemprop="image" class="woocommerce-main-image zoom" title=""  rel="prettyPhoto' . $gallery . '"><i class="icon-search"></i></a></span></div></div>';
			

		} else {

			$output = '<a href="'.$image_link.'" itemprop="image" class="woocommerce-main-image zoom" title=""  rel="prettyPhoto">'.$image.'<div class="text-overlay"><div class="info"><span class="button_sc small line-white"><span>'. esc_attr__( 'ZOOM', 'esense-functions' ).'</span></span></div></div></a>';

		}
		echo $output;
	?>
</figure>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>