<?php

/**
 *
 * Attachment page
 *
 **/

esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody">
<?php while ( have_posts() ) : the_post(); ?>
	<article>
		
		<section class="intro">
			<a href="<?php echo esc_url(get_permalink( $post->post_parent )); ?>" title="<?php esc_attr(printf(__('Return to %s', 'dp-esense'), get_the_title($post->post_parent))); ?>" rel="gallery">
				<?php printf(wp_kses_post(__('<span>&larr;</span> %s', 'dp-esense' )), get_the_title($post->post_parent)); ?>
			</a>
            <div class="space15"></div>
		
			<?php if ( wp_attachment_is_image() ) :
				$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
				//
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$k++;
				// If there is more than 1 image attachment in a gallery
				if (count($attachments) > 1) {
					if(isset($attachments[$k])) {
						$next_attachment_url = get_attachment_link($attachments[$k]->ID);
					} else {
						$next_attachment_url = get_attachment_link($attachments[0]->ID);
					}
				} else {
					$next_attachment_url = wp_get_attachment_url();
				}
			?>			
				<p>
					<a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, array( 900, 9999 ) ); ?>
					</a>
				</p>
				
				<?php previous_image_link( false ); ?>
				<?php next_image_link( false ); ?>
			<?php else : ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment">
				<?php echo basename(esc_url(get_permalink())); ?>
			</a>
			<?php endif; ?>
		</section>
		
		<?php if ( is_search() || is_archive() || is_tag() ) : ?>
		<section class="summary">
			<?php the_excerpt(); ?>
		</section>
		<?php else : ?>
		<section class="content">
			<?php the_content( esc_attr__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dp-esense' ) ); ?>
			<?php esense_post_links(); ?>
		</section>
		<?php endif; ?>
		
    <?php esense_get_template_part( 'layouts/content.post.footer' ); ?>
	</article>
	
	<?php comments_template('', true); ?>
<?php endwhile; ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF