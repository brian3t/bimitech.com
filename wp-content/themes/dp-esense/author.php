<?php

/**
 *
 * Author page
 *
 **/

esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody">
	<?php if ( have_posts() ) : ?>
	
		<?php the_post(); ?>
	
		<h1 class="page-title author">
			<?php printf( esc_attr__( 'Author archives: %s %s', 'dp-esense' ), get_the_author_meta('first_name', get_the_author_meta( 'ID' )), get_the_author_meta('last_name', get_the_author_meta( 'ID' )) ); ?>
		</h1>
	
		<?php rewind_posts(); ?>
	
		<?php esense_author(true); ?>
	
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php esense_get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		
		<?php esense_content_nav(); ?>
	
	<?php else : ?>
		<h1 class="page-title">
			<?php esc_attr__( 'Nothing Found', 'dp-esense' ); ?>
		</h1>
	
		<section class="intro">
			<?php esc_attr__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'dp-esense' ); ?>
		</section>
		
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF