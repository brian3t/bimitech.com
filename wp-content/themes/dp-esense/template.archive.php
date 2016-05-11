<?php
/*
Template Name: Archive Page
*/

esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody" class="archivepage">
	<?php the_post(); ?>
		<header>
			<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
		</header>
	<article>
		<section class="intro">
			<?php the_content(); ?>
		</section>
		
		<?php
			$posts_to_show = 10; //Max number of articles to display
			$debut = 0; //The first article to be displayed
		?>
		<div class="widget box first">
			<h3><?php esc_attr__('Latest posts', 'dp-esense'); ?></h3>
			<ul>
				<?php
					$myposts = get_posts('numberposts='.$posts_to_show.'&offset='.$debut);
					foreach($myposts as $post) :
				?>
				<li><small><?php the_time('d/m/y') ?>:</small> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	
		<div class="widget box">
			<h3><?php esc_attr__('Categories', 'dp-esense'); ?></h3>
			<ul>
				<?php 
					wp_list_categories(array(
						'orderby' => 'name',
						'show_count' => 1,
						'title_li' => ''
					)); 
				?>
			</ul>
		</div>
		
		<div class="widget box last">
			<h3><?php esc_attr__('Monthly Archives', 'dp-esense'); ?></h3>
			<ul>
				<?php wp_get_archives('type=monthly&show_post_count=1') ?>
			</ul>
		</div>
		
	</article>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF