<?php
/*
Template Name: Latest Posts (Big Thumbs)
*/
esense_load('header');
esense_load('before');

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$params = get_post_custom();
$params_perpage = isset($params['esense-post-params-perpage']) ? esc_attr( $params['esense-post-params-perpage'][0] ) : '';
	if ($params_perpage != "") {$item_per_page = $params_perpage;} else 
	{$item_per_page = get_option('posts_per_page');}
$params_category = isset($params['esense-post-params-category']) ? esc_attr( $params['esense-post-params-category'][0] ) : '';
$args = array(
				'paged' => $paged,
				'posts_per_page' =>  $item_per_page,
				'orderby' => 'date&order=ASC',
				'category_name' => $params_category
			);
$newsquery = new WP_Query($args);
?>
<?php if ( have_posts() ) : ?>
	<section id="esense-mainbody">
    <?php while($newsquery->have_posts()): $newsquery->the_post(); ?>
	<?php esense_get_template_part( 'article-blog-large'); ?>
    <?php endwhile; ?>
    <?php esense_content_nav($newsquery->max_num_pages, $range = 2); ?>
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

<?php

esense_load('after');
esense_load('footer');

// EOF