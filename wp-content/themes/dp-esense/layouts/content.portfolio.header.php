<?php

/**
 *
 * The template fragment to show portfolio header
 *
 **/

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');


$params = get_post_custom();
$params_title = isset($params['esense-post-params-title']) ? esc_attr( $params['esense-post-params-title'][0] ) : 'Y';
$params_subheader_use =  isset( $params['esense-post-params-subheader_use'] ) ? esc_attr( $params['esense-post-params-subheader_use'][0] ) : 'Y';
?>

<?php if(((!is_home() and !is_front_page() and !is_page_template('template.frontpage.php')) || (get_option($esense_tpl->name . "_template_homepage_title")=='Y')) and $params_subheader_use =='N' ) : ?>
<?php if(get_the_title() != '') : ?>
<hgroup>
	<h3><?php the_title(); ?>
		
		<?php if(is_sticky()) : ?>
		<sup>
			<?php esc_html_e( 'Featured', 'dp-esense' ); ?>
		</sup>
		<?php endif; ?>
	</h3>
</hgroup>
<?php endif; ?>
<?php endif; ?>