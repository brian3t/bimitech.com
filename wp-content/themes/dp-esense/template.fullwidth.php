<?php

/*
Template Name: Page without sidebar
*/
 


$fullwidth = true;

esense_load('header');
esense_load('before', array('sidebar' => false));

?>

<div id="esense-mainbody">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php esense_get_template_part( 'content' ); ?>
	
		<?php if(get_option($esense_tpl->name . '_pages_show_comments_on_pages', 'Y') == 'Y') : ?>
		<?php comments_template( '', true ); ?>
		<?php endif; ?>
		<?php esense_content_nav(); ?>
	<?php endwhile; ?>
</div>

<?php

esense_load('after-nosidebar', array('sidebar' => false));
esense_load('footer');

// EOF