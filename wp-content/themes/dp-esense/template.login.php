<?php
/*
Template Name: Login Page
*/
esense_load('header');
esense_load('before');

?>

<section id="esense-mainbody" class="loginpage">
	<?php the_post(); ?>
	
		<header>
			<?php esense_get_template_part( 'layouts/content.post.header' ); ?>
		</header>
	
	<article>
		<section class="intro">
			<?php the_content(); ?>
		</section>
		
		<?php if ( is_user_logged_in() ) : ?>
			<?php 
				
			$current_user = wp_get_current_user();
			
			?>
			
			<p>
				<?php echo esc_attr__('Hi, ', 'dp-esense') . ($current_user->user_firstname) . ' ' . ($current_user->user_lastname) . ' (' . ($current_user->user_login) . ') '; ?>
				 <a href="<?php echo wp_logout_url(); ?>" title="<?php  printf (esc_attr(__('Logout', 'dp-esense'))); ?>">
					 <?php esc_attr__('Logout', 'dp-esense'); ?>
				 </a>
			</p>
		
		<?php else : ?>
		    
			<?php 
				wp_login_form(
					array(
						'echo' => true,
						'form_id' => 'loginform',
						'label_username' => esc_attr__( 'Username', 'dp-esense' ),
						'label_password' => esc_attr__( 'Password', 'dp-esense' ),
						'label_remember' => esc_attr__( 'Remember Me', 'dp-esense' ),
						'label_log_in' => esc_attr__( 'Log In', 'dp-esense' ),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => NULL,
						'value_remember' => false 
					)
				); 
			?>
			
			<nav class="small">
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url('/')); ?>/wp-login.php?action=lostpassword" title="<?php esc_attr__('Password Lost and Found', 'dp-esense'); ?>"><?php esc_attr__('Lost your password?', 'dp-esense'); ?></a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url('/')); ?>/wp-login.php?action=register" title="<?php esc_attr__('Not a member? Register', 'dp-esense'); ?>"><?php esc_attr__('Register', 'dp-esense'); ?></a>
					</li>
				</ul>
			</nav>
		
		<?php endif; ?>
	
	</article>
</section>

<?php

esense_load('after');
esense_load('footer');

// EOF