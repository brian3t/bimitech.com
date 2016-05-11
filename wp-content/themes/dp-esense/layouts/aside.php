<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');



?>

<?php if(is_active_sidebar('aside')) : ?>
<div id="esense-dynamic-sidebar">
<i id="close-dynamic-sidebar" class="icon-close"></i>
<div class="inner-wrap">
<?php esense_dynamic_sidebar('aside'); ?>
</div>

</div>
<?php endif; ?>