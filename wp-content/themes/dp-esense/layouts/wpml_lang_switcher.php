<?php

// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');

    $languages = icl_get_languages('skip_missing=0&orderby=code');
	if(!empty($languages)){
?>
   	    <!--   Begin Language Switcher -->
        <div class="top_menu_lang_switcher">
        <a class="top_menu_lang_switcher_btn" href="#"><i class="icon-world"></i><span class="lang_code"><?php echo ICL_LANGUAGE_CODE ; ?></span></a>
		<div class ="esense_language_switcher_list">
        <?php
         	foreach($languages as $l){
			$langclass = "";
			if($l['active']) $langclass ="current_lang";
			if(!$l['active']) { echo '<a href="'.$l['url'].'">';}
            echo '<div class="lang_item '.$langclass.'">';
			echo '<div class ="flag" style="background-image: url('.$l['country_flag_url'].')"></div>';
            echo '<span>'.$l['translated_name'].'</span>';
            echo '</div>';
            if(!$l['active']) { echo '</a>'; }
		}
		?>
        </div>
		</div>
		<!--   End Language Switcher -->
<?php } ?>