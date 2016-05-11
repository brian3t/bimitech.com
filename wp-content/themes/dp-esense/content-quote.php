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
	
		<?php if ( is_search() || is_archive() || is_tag() || is_home() ) { 
				 if (get_option($esense_tpl->name . '_archive_style','big')=='big') {esense_get_template_part( 'article-blog-large');}
				 if (get_option($esense_tpl->name . '_archive_style','big')=='small') {esense_get_template_part( 'article-blog-medium'); }
		} else { 
		?>       
        <!--If is single --> 
        <article id="post-<?php the_ID(); ?>" <?php post_class('large'); ?>>
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
	?>
		<?php
		include(get_template_directory() . '/layouts/content.post.featured.php'); 
		esense_post_meta();
		if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' && $showtitle){?>
		<header>
        <h2>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr_e( 'Permalink to %s', 'dp-esense' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
			<?php if(is_sticky()) : ?>
            <sup>
                <?php esc_html_e( 'Featured', 'dp-esense' ); ?>
            </sup>
            <?php endif; ?>
        </h2>
	
		</header>
     <?php } ?>
        
		<section class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dp-esense' ) ); ?>
			
			<?php esense_post_links(); ?>
		</section>
	
		<?php esense_get_template_part( 'layouts/content.post.footer' ); ?>
	</article>
      <?php } ?>
