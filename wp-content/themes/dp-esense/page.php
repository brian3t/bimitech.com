<?php

/**
 *
 * Page
 *
 **/


esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody">
	<?php while ( have_posts() ) : the_post(); ?>
	
	<?php esense_get_template_part( 'content', 'page' ); ?>
	<?php if(get_option($esense_tpl->name . '_pages_show_comments_on_pages', 'Y') == 'Y') : ?>
	<?php comments_template( '', true ); ?>
	<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF