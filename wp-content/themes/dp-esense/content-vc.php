<?php

/**
 *
 * The default template for displaying content
 *
 **/

$params = get_post_custom();
$showtitle = false;
$params_title = isset($params['esense-post-params-title']) ? esc_attr( $params['esense-post-params-title'][0] ) : 'Y';
$params_subheader_use =  isset( $params['esense-post-params-subheader_use'] ) ? esc_attr( $params['esense-post-params-subheader_use'][0] ) : 'Y';
if ($params_title == 'Y' && $params_subheader_use == 'N') $showtitle = true;
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
		</header>
		<?php if (is_single() || is_home()) {
		include(get_template_directory() . '/layouts/content.post.featured.php'); 
		}?>
		<?php if ( is_search() || is_archive() || is_tag() ) : ?>
		<?php if (get_option($esense_tpl->name . '_archive_style','big')=='big') {
			include(get_template_directory() . '/layouts/content.post.featured.php');
			?>
        <section class="summary">
			<?php the_excerpt(); ?>
		</section>
        <?php } ?> 
        <?php if (get_option($esense_tpl->name . '_archive_style','big')=='small') {?>
        <?php if (has_post_thumbnail()) { ?>
        <div class="one_half">
		<?php esense_load( 'content.post.fetured' ); ?>
        </div>
        <div class="two_half_last">
        <section class="summary">
			<?php the_excerpt(); ?>
		</section>
        </div>
		<?php } else {?>
        <section class="summary">
			<?php the_excerpt(); ?>
		</section>
        <?php } ?> 
        <?php } ?> 

		<?php else : ?>
		<section class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dp-esense' ) ); ?>
			
			<?php esense_post_links(); ?>
		</section>
		<?php endif; ?>
		
	</article>