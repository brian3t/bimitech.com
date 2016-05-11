<?php

/**
 *
 * The template used for displaying page content in page.php
 *
 **/
 


$show_title = true;

if ((is_page_template('template.fullwidth.php') && ('post' == get_post_type() || 'page' == get_post_type())) || get_the_title() == '') {
	$show_title = false;
}

$classname = '';

if(!$show_title) {
	$classname = 'no-title';
}

if(is_page() && get_option($esense_tpl->name . '_template_show_details_on_pages', 'Y') == 'N') {
	$classname .= ' page-fullwidth';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classname); ?>>
	<header>
		<?php esense_load( 'content.post.header' ); ?>
	</header>

	<?php esense_load( 'content.post.featured' ); ?>

	<section class="content">
		<?php the_content(); ?>
		
		<?php esense_post_links(); ?>
	</section>
	
	<?php esense_load( 'content.post.footer' ); ?>
</article>