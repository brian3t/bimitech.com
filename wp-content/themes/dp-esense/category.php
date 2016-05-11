<?php

/**
 *
 * Category page
 *
 **/
esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody" class="category-page">
	<?php if ( have_posts() ) : ?>
    <?php if(get_option($esense_tpl->name . '_archive_slideshow','N') == 'Y') { 
	$cat_id = get_query_var('cat');
	$cat_meta = get_option("category_$cat_id");
	echo '<section>';
	if ($cat_meta['slideshow']!='No') esense_category_slideshow($cat);
	echo '</section>';
		 }?>
		<?php
			$category_description = category_description();
			if ( ! empty( $category_description ) )
				echo apply_filters( 'category_archive_meta', '<section class="intro">' . $category_description . '</section>' );
		?>
	
		<?php while ( have_posts() ) : the_post(); ?>
        <?php if (get_option($esense_tpl->name . '_archive_style','big') == 'big') { 
		esense_get_template_part( 'article-blog-large');
		} else { 
		esense_get_template_part( 'article-blog-medium');
		} ?>
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