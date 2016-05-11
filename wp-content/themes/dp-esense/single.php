<?php

/**
 *
 * Single page
 *
 **/
esense_load('header');
esense_load('before');
?>

<section id="esense-mainbody">
	<?php while ( have_posts() ) : the_post(); ?>
    <?php esense_get_template_part( 'content', get_post_format() ); ?>			
		<?php comments_template( '', true ); ?>
		<?php esense_content_nav(); ?>
	<?php endwhile; // end of the loop. ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF