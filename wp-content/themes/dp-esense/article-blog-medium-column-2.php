<?php

/**
 *
 * The default template for displaying content column in medium blog
 *
 **/


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
		   case 'audio':
				$more = 0;
				the_content('');
				$more =1;
				 break;
		   case 'status':
				echo '<i class="icon-chat"></i>';
				the_content('');
				$more =1;
				 break;
		   case 'video':
				$more = 0;
				the_content('');
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
		  default:		
          esense_excerpt();
 		  }
		?>
		</section>
		<?php esense_get_template_part( 'layouts/content.post.footer' ); ?>
