<?php

/**
 *
 * The default template for displaying content column in medium blog
 *
 **/



do {
if(get_post_meta(get_the_ID(), "_esense-featured-video", true) != '') { ?>
	<p>
	<?php echo wp_oembed_get( get_post_meta(get_the_ID(), "_esense-featured-video", true) ); ?>
	</p>
<?php break; }

if(has_post_thumbnail() && get_post_format() != 'gallery') { ?>
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
<?php break; }

if(get_post_format() == 'gallery') { 
	if ( get_post_gallery() ) $gallery = get_post_gallery( $post->ID, false );
       if($gallery){ 
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
		  	<?php } else {
			the_post_thumbnail();
			};
			 break; }


} while (0);
?>	

