<?php

/**
 *
 * The default template for displaying content
 *
 **/

$postclasses = array(
		'medium'
	);

if (get_option($esense_tpl->name . '_postmeta_date_state','Y') == 'Y' && get_option($esense_tpl->name . '_postmeta_date_style','default') == 'big') {
array_push($postclasses, 'bigdate');
}
?>	
    <article id="post-<?php the_ID(); ?>" <?php post_class($postclasses); ?>>
    <?php if (get_option($esense_tpl->name . '_postmeta_date_state','Y') == 'Y' && get_option($esense_tpl->name . '_postmeta_date_style','default') == 'big') {  ?>
    <div class="bigdate-container">
    <div class="day">
    <?php echo mysql2date('j',get_post()->post_date); ?>
    </div>
    <div class="month">
    <?php echo mysql2date('M',get_post()->post_date); ?>
    </div>
    <div class="year">
    <?php echo mysql2date('Y',get_post()->post_date); ?>
    </div>
    <?php if(get_post_format() != '') : ?>
	 		<div class="format esense-format-<?php echo esc_html(get_post_format()); ?>"></div>
	<?php endif; ?>	
    </div>
    <?php
    }
	$aremedia = false;
	if(get_post_meta(get_the_ID(), "_esense-featured-video", true) != '' || has_post_thumbnail() || get_post_format() == 'gallery' ) $aremedia = true; 
	?>
    <?php if ($aremedia) { ?>
    <div class="one_half">
    <?php esense_get_template_part( 'article-blog-medium-column-1'); ?>
    </div>
    <div class="one_half_last">
    <?php esense_get_template_part( 'article-blog-medium-column-2'); ?>
	</div>
    <div class="clearboth"></div>
	<?php } else { ?>
    <?php esense_get_template_part( 'article-blog-medium-column-2'); ?>
    <div class="clearboth"></div>
	<?php } ?>
	</article>