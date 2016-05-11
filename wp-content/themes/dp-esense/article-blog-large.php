<?php

/**
 *
 * The default template for displaying content
 *
 **/

$postclasses = array(
		'bigimages'
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
		// if there is a Featured Video
		if(get_post_meta(get_the_ID(), "_esense-featured-video", true) != '') : 
	?>
	<p>
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_esense-featured-video", true) ); ?>
	</p>
	<?php elseif(has_post_thumbnail() && get_post_format() != 'gallery') : ?>
	<figure class="featured-image">
		<a href="<?php the_permalink(); ?>">
        <div class="text-overlay"> 
		<div class="info">
        <span class="rdbutton"></span>
    	</div>
        </div>
		<?php the_post_thumbnail(); ?>
            
		</a>
	</figure>
    <div class="space40"></div>
	<?php endif; ?>
    <?php if (get_post_format() == 'gallery')  {  
				// Load images
	if ( get_post_gallery() ) :
	$gallery = get_post_gallery( $post->ID, false );
	endif

			?>
        <?php if($gallery): 
		esense_add_flex();
		?>
        <div class="clearboth"></div>
			<div id="gallery" class="flexgallery">
                    			<?php 
					$gallery_id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$gallery_id."').flexslider({"."\n";
					$output .=  '    animation: "slide",'."\n";
					$output .=  '    slideshowSpeed:"5000",'."\n";
					$output .=  '    controlNav: false,'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true'."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					print ($output); 
				?>

            <div class="flexslider" id="<?php echo esc_attr($gallery_id); ?>"><ul class="slides">
				<?php 
				foreach( $gallery['src'] as $src ) : 
				?>
				<li><figure class="noscale">
				<img src="<?php echo esc_url($src); ?>" />
				</figure></li>
				<?php 
					endforeach;
				?>
			</ul></div>
			</div>
		  	<?php endif;
				}
			?>
	
        <?php if (get_post_format() != 'link' && get_post_format() != 'quote' && get_post_format() != 'status' ){?>
		<header>
        <h2>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dp-esense' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
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
		<?php esense_post_meta(); ?>
		<section class="summary <?php echo esc_html(get_post_format()); ?>">
        <?php
		$post_format = get_post_format();
		switch ($post_format) {
		   case 'link':
				$more = 0;
				echo '<i class="icon-link"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'status':
				echo '<i class="icon-chat"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'audio':
				$more = 0;
				the_content('');
				$more =1;
				 break;		   
case 'video':
				$more = 0;
				esense_excerpt();
				$more =1;
				 break;
		   case 'quote':
				echo '<i class="icon-quote-right"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'gallery':
		   		esense_excerpt(); 
				break;
		  default: if(get_option( 'rss_use_excerpt ' )) {		
		   esense_excerpt();
		   } else {
			   the_content();
		   }
		  }
		?>
		</section>
		<?php esense_get_template_part( 'layouts/content.post.footer' ); ?>
	</article>