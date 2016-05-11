<?php

/**
 *
 * Comments part
 *
 **/
?>

<?php if ( post_password_required() ) : ?>
<section id="comments">
	<p class="no-password"><?php esc_attr__( 'This post is password protected. Enter the password to view any comments.', 'dp-esense' ); ?></p>
</section>
<?php
	return;/* Stop the rest of comments.php from being processed */	
	endif;
?>

<?php if ( have_comments() ) : ?>
<section id="comments">
	<div class="headline heading-line "><h3><?php printf(__( 'Comments <span class="comments-amount">(<i class="icon-chat"></i>%1$s)</span>', 'dp-esense'),number_format_i18n( get_comments_number() )); ?></h3></div>

	<?php if ( get_comment_pages_count() > 1 && get_option('page_comments' )) : ?>
	<nav>
		<div class="nav-prev">
			<?php previous_comments_link( esc_attr__( '&larr; Older Comments', 'dp-esense' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_comments_link( esc_attr__( 'Newer Comments &rarr;', 'dp-esense' ) ); ?>
		</div>
	</nav>
	<?php endif; ?>
	
	<ol>
		<?php wp_list_comments(array( 'callback' => 'esense_comment_template', 'style' => 'ol')); ?>	
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option('page_comments' )) : ?>
	<nav>
		<div class="nav-prev">
			<?php previous_comments_link( esc_attr__( '&larr; Older Comments', 'dp-esense' ) ); ?>
		</div>
		<div class="nav-next">
			<?php next_comments_link( esc_attr__( 'Newer Comments &rarr;', 'dp-esense' ) ); ?>
		</div>
	</nav>
	<?php endif;
	
	esense_comment_form(); ?>
</section>
<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
<section id="comments" class="nocomments">	
	<p class="no-comments"><?php esc_attr__( 'Comments are closed.', 'dp-esense' ); ?></p>
</section>
<?php else : ?>
<section id="comments" class="nocomments">
	<?php esense_comment_form(); ?>
</section>
<?php endif; ?>