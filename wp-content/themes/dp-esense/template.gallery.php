<?php
/*
Template Name: Gallery Page
*/

wp_enqueue_style('esense-gallery-css', get_template_directory_uri() . '/css/templates/gallery.css');
esense_load('before');
?>

<section id="esense-mainbody">
	<?php the_post(); ?>
		<header>
			<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
		</header>
	<article>
		<section class="content">
			<?php
				// Load images
				$images = get_children(
					array(
						'numberposts' => -1, // Load all posts
						'orderby' => 'menu_order', // Images will be loaded in the order set in the page media manager
						'order'=> 'ASC', // Use ascending order
						'post_mime_type' => 'image', // Loads only images
						'post_parent' => $post->ID, // Loads only images associated with the specific page
						'post_status' => null, // No status
						'post_type' => 'attachment' // Type of the posts to load - attachments
					)
				);
			?>
			
			<?php if($images): ?>
			<section class="flexgallery">
            
				<?php 
					$id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(window).load(function() {"."\n"; 
					$output .=  "jQuery('#".$id."').flexslider({"."\n";
					$output .=  '    animation: "slide",'."\n";
					$output .=  '    slideshowSpeed:"5000",'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true'."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					print ($output); 
				?>
                <div class="flexslider" id="<?php echo esc_attr($id); ?>"><ul class="slides">
				<?php 
					foreach($images as $image) : 
				?>
				<li><figure>
					<img src="<?php echo esc_url($image->guid); ?>" alt="<?php echo esc_attr($image->post_title); ?>" title="<?php echo esc_attr($image->post_title); ?>" />
					
					<?php if($image->post_title != '' || $image->post_content != '' || $image->post_excerpt != '') : ?>
					<figcaption>
						<h3><?php echo esc_attr($image->post_title); // get the attachment title ?></h3>
						<p><?php echo esc_html($image->post_content); // get the attachment description ?></p>
						<small><?php echo esc_html($image->post_excerpt); // get the attachment caption ?></small>
					</figcaption>
					<?php endif; ?>
				</figure></li>
				<?php 
					endforeach;
				?>
			</ul></div>	
			</section>
		  	<?php endif; ?>
        <section class="intro">
			<?php the_content(); ?>
		</section>

		</section>
	</article>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF