<?php


esense_load('header');
esense_load('before');

?>		
		
	<?php if(get_option($esense_tpl->name . '_template_homepage_mainbody', 'Y') == 'Y') : ?>
		<?php do_action('esense_wp_before_mainbody'); ?>
		<?php if ( have_posts() ) : ?>		
			<section id="esense-mainbody">
				<?php do_action('esense_wp_before_loop'); ?>
			
				
				<?php while ( have_posts() ) : the_post(); ?>
					<?php esense_get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				<?php esense_content_nav(); ?>
				
				<?php do_action('esense_wp_after_loop'); ?>
			</section>
		<?php else : ?>
			<section id="esense-mainbody">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_attr__( 'Nothing Found', 'dp-esense' ); ?></h1>
					</header>
		
					<div class="entry-content">
						<p><?php esc_attr__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'dp-esense' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</article>
			</section>
		<?php endif; ?>
		
		<?php do_action('esense_wp_after_mainbody'); ?>
	<?php else: ?>
		<?php if(is_active_sidebar('mainbody')) : ?>
		<section id="esense-mainbody">
			<?php esense_dynamic_sidebar('mainbody'); ?>
		</section>
		<?php endif; ?>
	<?php endif; ?>
<?php

esense_load('after');
esense_load('footer');

/* EOF */