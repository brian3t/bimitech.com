<?php

/**
 *
 * Woocommerce functions:
 *
 **/
 


	 // Add woocommerce related JS
	function esense_add_womommerce_js(){
	wp_enqueue_script('esense-woocommerce-js', get_template_directory_uri() . '/js/woocommerce-custom.js', array('jquery'),false,true);
	}
	add_action('wp_enqueue_scripts', 'esense_add_womommerce_js');
	
// Number of products per page
$productsperpage = get_option($esense_tpl->name . '_woocommerce_list_perpage','9');
if(isset($_GET['listing_perpage'])) $productsperpage = $_GET['listing_perpage'];
   add_filter( 'loop_shop_per_page', create_function( '$cols', "return $productsperpage;" ), 20 );


// Number of products per row
add_filter('loop_shop_columns', 'esense_loop_columns');
	if (!function_exists('esense_loop_columns')) {
		function esense_loop_columns() {
		global $esense_tpl;
		return get_option($esense_tpl->name . '_woocommerce_list_columns','3');
		}
	}

// Redefine woocommerce_output_related_products()
function esense_woo_related_products_limit() {
  global $product, $esense_tpl;
	
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> get_option($esense_tpl->name . '_woocommerce_related_perpage','8'),
		'ignore_sticky_posts' 	=> 1,
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'esense_woo_related_products_limit' );
 
// Redefine the breadcrumb
function esense_woocommerce_breadcrumb() {
	woocommerce_breadcrumb(array(
		'delimiter'   => '',
		'wrap_before' => '<div class="esense-woocommerce-breadcrumbs">',
		'wrap_after'  => '</div>',
		'before' => '<span>',
		'after' => '</span>'
	));
}

// remove old breadcrumb callback
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
// add our own breadcrumb callback


add_action( 'woocommerce_after_shop_loop_item_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_rating', 'woocommerce_template_loop_rating', 5 );

// Display short description on catalog pages.
function esense_wc_short_description($count) {
	global $product;
	global $woocommerce;
	
	$input = $product->get_post_data()->post_excerpt;
	$output = '';
	$input = strip_tags($input);
	
	if (function_exists('mb_substr')) {
		$output = mb_substr($input, 0, $count);
		if (mb_strlen($input) > $count){
			$output .= '&hellip;';
		}
	}
	else {
		$output = substr($input, 0, $count);
		if (strlen($input) > $count){
			$output .= '&hellip;';
		}
	}	
	
	return '<p class="short-desc">'.$output.'</p>';
}

function esense_wc_long_description() {
	global $product;
	global $woocommerce;
	
	$input = $product->get_post_data()->post_excerpt;
	$input = strip_tags($input);
	return '<p class="long-desc">'.$input.'</p>';
}

//remove add to cart, select options buttons on catalog pages
function esense_remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

add_action('init','esense_remove_loop_button');



// Handle dropdown cart in header fragment for ajax add to cart
add_filter( 'add_to_cart_fragments', 'esense_add_to_cart_fragment' );

if ( !function_exists( 'esense_add_to_cart_fragment' ) ) {

    function esense_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>

                <div class="esense_shopping_cart">
			<a class="esense_shopping_cart_btn" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icon-bag"></i><span class="esense_shopping_cart_btn_count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span></a>
			<div class="shopping_cart_dropdown">
			<div class="shopping_cart_dropdown_inner">
				<?php
					$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
					$list_class = array( 'cart_list', 'product_list_widget' );
				?>
					<ul class="<?php echo implode(' ', $list_class); ?>">

						<?php if ( !$cart_is_empty ) : ?>

							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
								?>

								<li>
									<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

										<?php echo wp_kses_post($_product->get_image()); ?>

										

									</a>
									<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?><br/>
									<?php echo esc_html($woocommerce->cart->get_item_data( $cart_item )); ?>

									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								</li>

							<?php endforeach; ?>

						<?php else : ?>

							<li><?php esc_html_e( 'No products in the cart.', 'dp-esense' ); ?></li>

						<?php endif; ?>

					</ul>
				</div>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>
			
			<?php endif; ?>
                <a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" target="_self" class="button_sc small color dropdowncartbtn"><span><?php esc_html_e( 'VIEW CART', 'dp-esense' ); ?></span></a>
                    <span class="total"><?php esc_html_e( 'Total', 'dp-esense' ); ?>: <span><?php echo wp_kses_post($woocommerce->cart->get_cart_subtotal()); ?></span></span>


			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>
			
			<?php endif; ?>
		</div>
	</div>

        <?php
        $fragments['.esense_shopping_cart'] = ob_get_clean();

        return $fragments;
    }

}

/* Compare Yith */
if ( class_exists( 'YITH_Woocompare' ) ) { 
    if (get_theme_mod('store_add_to_compare', 1 ) == 1) {
        remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
        remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
        update_option( 'yith_woocompare_is_button', 'link' );
    }
}


/* Wishlist Yith */
if ( class_exists( 'YITH_WCWL_Init' ) ) { 
    if (get_theme_mod('store_add_to_wishlist', 1 ) == 1) { 

        function yit_change_wishlist_label() {
            return esc_attr__( 'Add to Wishlist', 'dp-esense' );
        }    

        function yit_change_browse_wishlist_label() {
            return esc_attr__( 'View Wishlist', 'dp-esense' );
        }

        add_filter( 'yith_wcwl_button_label', 'yit_change_wishlist_label' );
        add_filter( 'yith-wcwl-browse-wishlist-label', 'yit_change_browse_wishlist_label' );

        update_option( 'yith_wcwl_use_button', 'no' );
        update_option( 'yith_wcwl_button_position', 'shortcode' );
        update_option ('yith_wcwl_wishlist_title', '');

        update_option ('yith_wcwl_share_fb', '0');
        update_option ('yith_wcwl_share_twitter', '0');
        update_option ('yith_wcwl_share_pinterest', '0');
        update_option ('yith_wcwl_share_googleplus', '0');
        update_option ('yith_wcwl_share_email', '0');

        /* Extend Wishlist class to remove some things*/
        class Esense_YITH extends YITH_WCWL_UI {

            public static function add_to_wishlist_button( $url, $product_type, $exists ) {
                global $yith_wcwl, $product;

                $label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
                $localize_label = function_exists( 'icl_translate' ) ? icl_translate( 'Plugins', 'plugin_yit_wishlist_button', $label_option ) : $label_option;

                $label = apply_filters( 'yith_wcwl_button_label', $localize_label );
                $icon = get_option( 'yith_wcwl_add_to_wishlist_icon' ) != 'none' ? '<i class="' . get_option( 'yith_wcwl_add_to_wishlist_icon' ) . '"></i>' : '';

                $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';

                $html  = '<div class="yith-wcwl-add-to-wishlist">';
                $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

                $html .= $exists ? ' hide" style="display:none;"' : ' show"';

                $html .= '><a href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' >' . $icon . $label . '</a>';
                $html .= '</div>';

                $html .= '<div class="yith-wcwl-wishlistaddedbrowse" style="display:none;"><span class="feedback">' . esc_attr__( 'Product added!','dp-esense' ) . '</span> <a href="' . esc_url( $url ) . '"></a></div>';
                $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><span class="feedback">' . esc_attr__( 'The product is already in the wishlist!', 'dp-esense' ) . '</span> <a href="' . esc_url( $url ) . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', esc_attr__( 'Browse Wishlist', 'dp-esense' ) ) . '</a></div>';
                $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

                $html .= '</div>';
                $html .= '<div class="clear"></div>';

                return $html;
            }
        }
        /* End extend Wishlist class */

    }
}

 /* Add Compare and wishlist buttons in single product view */
 
add_action( 'woocommerce_after_add_to_cart_button', 'esense_add_compare_to_product', 35 );

function esense_add_compare_to_product() { 
 if ( class_exists( 'YITH_Woocompare' ) ) { 
            if (get_theme_mod('store_add_to_compare', 1 ) == 1) { ?>
            <div class="product-compare">
				<?php echo do_shortcode('[yith_compare_button container="no"]'); ?>
            </div>
    <?php } } 
	 } 
add_action( 'woocommerce_after_add_to_cart_button', 'esense_add_wishlist_button_to_product', 36 );

function esense_add_wishlist_button_to_product() { 
 if ( class_exists( 'YITH_WCWL_Init' ) ) { 
            if (get_theme_mod('store_add_to_wishlist', 1 ) == 1) { ?>
            <div class="product-wishlist">
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            </div>
    <?php } } 
	 } 

function esense_add_compare_wish_to_product() { 
 if ( class_exists( 'YITH_Woocompare' ) ) { 
            if (get_theme_mod('store_add_to_compare', 1 ) == 1) { ?>
            
            <div class="product-compare clearfix">
				<?php echo do_shortcode('[yith_compare_button container="no"]'); ?>
            </div>
    <?php } } 
	 } 



if ( !function_exists( 'esense_product_toggle' ) ) {

    function esense_product_toggle() {
        global $esense_tpl;
        $product_layout = get_option($esense_tpl->name . '_woocommerce_list_prefered_view','grid') ;
		if (get_option($esense_tpl->name . '_woocommerce_list_view_switcher','Y') == "Y") {
        if ( $product_layout == 'grid' ):
            ?>
    		<div class="view-switcher clearfix">
                <div class="toggleGrid active" data-tipcontent="Grid Layout"><i class="icon-th-large"></i></div>
                <div class="toggleList" data-tipcontent="List Layout"><i class="icon-th-list"></i></div>
            </div>
        <?php elseif ( $product_layout == 'list' ): ?> 
    		<div class="view-switcher clearfix">
                <div class="toggleGrid" data-tipcontent="Grid Layout"><i class="icon-th-large"></i></div>
                <div class="toggleList active" data-tipcontent="List Layout"><i class="icon-th-list"></i></div>
            </div>
        <?php endif; }?> 

        <?php
    }

}

// Catalog Mode
function esense_add_catalog_mode_body_class( $classes ) {
        $classes[] = 'woocommerce-catalogmode';
    	return $classes;
}

function esense_enable_catalog() {
 	global $esense_tpl;
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
    remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
    remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
	add_filter( 'body_class','esense_add_catalog_mode_body_class' );
}

// Hide prices
function esense_add_hide_prices_body_class( $classes ) {
        $classes[] = 'woocommerce-hideprices';
    	return $classes;
}

function esense_hide_prices() {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_filter( 'body_class','esense_add_hide_prices_body_class' );
}

if ( ( get_option($esense_tpl->name . '_woocommerce_catalog','N')  == 'Y' ) || ( get_option($esense_tpl->name . '_woocommerce_hide_prices','N')  == 'Y' ) ) {
    add_action( 'init', 'esense_enable_catalog' );
	if (  get_option($esense_tpl->name . '_woocommerce_hide_prices','N')  == 'Y'  ) {
			add_action( 'init', 'esense_hide_prices' );
		}
}

//Product thumbnail custom 

	function woocommerce_template_loop_product_thumbnail() {
		global $esense_tpl;
		$output = '<figure class="product-thumb">';
		$output .= '<div class="text-overlay">'; 
		$output .= '<div class="info">';
		$output .= '<div class="product-thumb-links">';
		$output .= '<div class="product-thumb-links-inner">';
		$output .= '<a class="list-view-details esense-tipsy-b" data-tipcontent="View Details" href="'.esc_url(get_permalink()).'"><i class="icon-eye"></i></a>';
		$output .= '<div class="list-compare-wishlist">';
		if ( class_exists( 'YITH_Woocompare' ) ) { 
            if (get_theme_mod('store_add_to_compare', 1 ) == 1 && get_option($esense_tpl->name . '_woocommerce_list_compare','Y') == 'Y') {
			$output .= do_shortcode('[yith_compare_button container="no"]');
    	} }
		if ( class_exists( 'YITH_WCWL_Init' ) ) { 
            if (get_theme_mod('store_add_to_wishlist', 1 ) == 1 && get_option($esense_tpl->name . '_woocommerce_list_wishlist','Y') == 'Y') {
			 global $yith_wcwl, $product;
             //$output .= Esense_YITH::add_to_wishlist_button( $yith_wcwl->get_wishlist_url(), $product->product_type, $yith_wcwl->is_product_in_wishlist( $product->id ) ); 
    	} }
		$output .= '</div>';
		$output .= '</div>';
    	$output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
		$output .= woocommerce_get_product_thumbnail();
		$output .= '</figure>';
		print ($output);
	}
