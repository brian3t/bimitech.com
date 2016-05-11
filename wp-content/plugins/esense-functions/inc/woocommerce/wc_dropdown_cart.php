<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');
function esense_dropdown_cart() {
global $esense_tpl;
global $woocommerce;

       $esense_dropdown_cart_output = '<div class="esense_shopping_cart">';
	   
		$esense_dropdown_cart_output .= '<a class="esense_shopping_cart_btn" href="'.$woocommerce->cart->get_cart_url().'"><i class="icon-bag"></i><span class="esense_shopping_cart_btn_count">'.$woocommerce->cart->cart_contents_count.'</span></a>';
		$esense_dropdown_cart_output .= '<div class="shopping_cart_dropdown">';
		$esense_dropdown_cart_output .= '<div class="shopping_cart_dropdown_inner">';
		$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
		$list_class = array( 'cart_list', 'product_list_widget' );
		$esense_dropdown_cart_output .= '<ul class="'.implode(' ', $list_class).'">';

						if ( !$cart_is_empty ) : 

							foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
								

		$esense_dropdown_cart_output .= '<li>';
		$esense_dropdown_cart_output .= '<a href="'.esc_url(get_permalink( $cart_item['product_id'] )).'">';

		$esense_dropdown_cart_output .= $_product->get_image(); 

										
		$esense_dropdown_cart_output .= '</a>';
		$esense_dropdown_cart_output .=	apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product );
		$esense_dropdown_cart_output .='<br/>';
		$esense_dropdown_cart_output .= $woocommerce->cart->get_item_data( $cart_item );
		$esense_dropdown_cart_output .= apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); 
		$esense_dropdown_cart_output .= '</li>';
		endforeach; 

						else : 

							$esense_dropdown_cart_output .= '<li>'. esc_html_e( 'No products in the cart.', 'esense-functions' ).'</li>';
						endif;
				$esense_dropdown_cart_output .= '</ul>';
				$esense_dropdown_cart_output .= '</div>';
			if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : 
			
			 endif; 
                $esense_dropdown_cart_output .= '<a href="'.$woocommerce->cart->get_cart_url().'" target="_self" class="button_dp small color dropdowncartbtn"><span>'.esc_html_e( 'VIEW CART', 'esense-functions' ).'</span></a>';
                $esense_dropdown_cart_output .= '<span class="total">'. esc_html_e( 'Total', 'esense-functions' ).'<span>'.$woocommerce->cart->get_cart_subtotal().'</span></span>';


			if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : 
			
			endif;
		$esense_dropdown_cart_output .= '</div>';
	$esense_dropdown_cart_output .= '</div>';
	echo $esense_dropdown_cart_output ;
}






