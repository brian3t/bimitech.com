<?php

/**
 *
 * The template fragment to show post footer
 *
 **/

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

<?php do_action('esense_wp_after_post_content'); ?>

<?php if(is_singular()) : ?>
	<?php 
		// variable for the social API HTML output
		$social_api_output = esense_social_api(get_the_title(), get_the_ID()); 
	?>
		
	<?php if($social_api_output != '' || esense_author(false, true)): ?>
	<footer>
		<?php echo wp_kses_post($social_api_output); ?>
	</footer>
	<?php endif; ?>
<?php endif; ?>