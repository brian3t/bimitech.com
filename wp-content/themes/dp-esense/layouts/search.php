<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

<?php if(get_option($esense_tpl->name . '_header_search', 'Y') == 'Y') : ?>
<div class="search-overlay">
		<div class="overlay-close"><i class="icon-close"></i></div>
        	<div class="esense-page">
                    <form method="get" id="searchform" action="<?php echo get_site_url(); ?>">
                    <input type="text" class="field" name="s" id="s" placeholder="<?php echo esc_html_e('Start typing...','dp-esense') ?>" value="">
                    </form>            
            		</div>
            </div>
<?php endif; ?>