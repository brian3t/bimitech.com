<?php

/**
 *
 * 404 Page
 *
 **/
$fullwidth = true;
$textcolorstyle = '';
if (get_option($esense_tpl->name . '_404_bg_image_state','N') == 'Y') {
$textcolorstyle = get_option($esense_tpl->name . '_page404_text_color','#ffffff');
}

esense_load('header');
esense_load('before', array('sidebar' => false));

?>
<div id="esense-mainbody" class="page404">
	<h1 style="color: <?php echo esc_attr($textcolorstyle); ?> "><?php esc_html_e('404', 'dp-esense'); ?></h1>
    <h3 style="color: <?php echo esc_attr($textcolorstyle); ?> " ><?php echo esc_html(get_option($esense_tpl->name . '_404_subtitle','')); ?></h3>
    <p style="color: <?php echo esc_attr($textcolorstyle); ?> "><?php echo esc_html(get_option($esense_tpl->name . '_404_content','')); ?></p>
	
    <p><a href="<?php echo esc_url(home_url('/')); ?>" target="_self" class="button_dp line-white large"><span><i class="ss-left"></i><?php esc_html_e('Back to home page', 'dp-esense') ?></span></a></p>
    <div class="centered-block-outer">
 			<div class="centered-block-middle">
  				<div class="centered-block-inner">
        <ul class="social-bar rounded">
        <?php esense_social_bar_content(); ?>
        </ul>
        </div>
        </div>
        </div>
</div>

<?php

esense_load('after-nosidebar', array('sidebar' => false));
esense_load('footer');

// EOF