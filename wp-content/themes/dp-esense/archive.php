<?php

/**
 *
 * Archive page
 *
 **/

esense_load('header');
esense_load('before');

?>

<div id="esense-mainbody">

	<?php if ( have_posts() ) : ?>
		<?php do_action('esense_wp_before_loop'); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php esense_get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
	
		<?php esense_content_nav(); ?>
	<?php else : ?>
	
		<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'dp-esense' ); ?></h1>
						
		<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'dp-esense' ); ?></p>
		
		<?php get_search_form(); ?>
	
	<?php endif; ?>
</div>

<?php

esense_load('after');
esense_load('footer');

// EOF