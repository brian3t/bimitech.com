<?php

/**
 *
 * The template for displaying content in the single.php template
 *
 **/
 

 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(is_page_template('template.fullwidth.php') ? ' page-fullwidth' : null); ?>>
	<?php esense_load( 'content.post.fetured' ); ?>
		<?php if((!is_page_template('template.fullwidth.php') && ('post' == get_post_type())) && get_the_title() != '') : ?>
	<header>
		<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
	</header>
		<?php endif; ?>
	<section class="content">
		<?php the_content(); ?>
		
		<?php esense_post_links(); ?>
	</section>

	<?php esense_load( 'content.post.footer' ); ?>
</article>
