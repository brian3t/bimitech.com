<?php

/*
Template Name: Tag cloud
*/

esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody" class="tagcloud">
	<?php while ( have_posts() ) : the_post(); ?>
		<header>
			<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
		</header>
		
		<section class="content">
			<?php the_content(); ?>
			
			<div class="tag-cloud">
				<?php wp_tag_cloud('number=0'); ?>
			</div>
		</section>
		
	<?php endwhile; ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF