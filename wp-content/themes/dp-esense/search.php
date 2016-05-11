<?php

/**
 *
 * Search page
 *
 **/

esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody" class="search-page">
	<?php if ( have_posts() ) : ?>
		<?php 
			get_search_form(); 
			$founded = false;
		?>
        <div class="space20"></div>
		<?php while ( have_posts() ) : the_post(); ?>
		<header>
        <h2>
        <a href="<?php esc_url(the_permalink()); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dp-esense' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a>
        </h2>
	
		</header>
	<div class="meta">
    <a href="<?php esc_url(the_permalink()); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dp-esense' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
    <span class= "date"><?php echo mysql2date('F j , Y',get_post()->post_date); ?></span>
    </a>
	<span class="author-link"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_attr(sprintf(esc_attr__('%s', 'dp-esense'), get_the_author())); ?></a>
    </span>
	<?php if ( comments_open() && ! post_password_required() ) : ?>
	<?php if(get_option($esense_tpl->name . '_postmeta_coments_state','Y') == 'Y') : 
	?>
	<span class="comments">
    <?php $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = esc_attr__('No Comments','dp-esense');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . esc_attr__(' Comments','dp-esense');
		} else {
			$comments = esc_attr__('1 Comment','dp-esense');
		}
		$write_comments = '<a href="' . esc_url(get_comments_link()) .'">'. $comments.'</a>';
	} else {
		$write_comments =  esc_attr__('Comments are off for this post.','dp-esense');
	}
	echo wp_kses_post($write_comments);
	?>

    </span>
    <?php  endif; ?>

	<?php endif; ?> 
	
			
    </div>
    <p>
    <?php
			esense_excerpt_without_readmore();
				$founded = true;
			?>
    </p>
		<?php endwhile; ?>
		<?php esense_content_nav(); ?>
	
		<?php if(!$founded) : ?>
		<h2>
			<?php esc_attr__( 'Nothing Found', 'dp-esense' ); ?> 
     
		</h2>
		
		<section class="intro">
			<?php esc_attr__( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dp-esense' ); ?>
		</section>
		<?php endif; ?>
	
	<?php else : ?>				
		<h1 class="page-title">
			<?php esc_attr__( 'Nothing Found', 'dp-esense' ); ?>
		</h1>
		
		<?php get_search_form(); ?>
		
		<section class="intro">
			<p><?php esc_attr__( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dp-esense' ); ?></p>
		</section>
	<?php endif; ?>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF