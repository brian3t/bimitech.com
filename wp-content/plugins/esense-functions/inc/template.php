<?php
	
// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

// access to the template object
global $esense_tpl;
// load the form parser
include_once(get_template_directory().'/dynamo_framework/form.parser.php');
// create a new instance of the form parser
$parser = new Esense_WPFormParser($esense_tpl);
// get the tabs list from the JSON file
$tabs = $esense_tpl->esense_get_json('options','tabs');
// iterators
$tabsIterator = 0;
$contentIterator = 0;
// active tab
$activeTab = 0;


if(isset($_COOKIE['esense-esense' . '_active_tab']) && is_numeric($_COOKIE['esense-esense' . '_active_tab'])) {
	$activeTab = floor($_COOKIE['esense-esense' . '_active_tab']);
}

?>

<div class="dpWrap" id="dpMainWrap" data-theme="<?php echo 'esense-esense'; ?>">
	<h1>
    <big><?php if (get_option($esense_tpl->name . "_branding_admin_page_template_name") !='') echo get_option($esense_tpl->name . "_branding_admin_page_template_name"); else echo esc_html($esense_tpl->full_name); ?></big><small><?php echo esc_html(get_option($esense_tpl->name . "_branding_admin_page_slogan")) ?></small>

	
		<a href="customize.php?theme=<?php echo esc_html($esense_tpl->full_name); ?>" title="<?php esc_attr__('Customize theme', 'esense-functions'); ?>"><?php esc_attr__('Customize theme', 'esense-functions'); ?></a>
	</h1>
	<div>
		<ul id="dpTabs">
		<?php foreach($tabs as $tab) : ?>
        <?php $enabled = $tab[2];
			  if ($tab[3] != '')  {
				  
				  if ( !is_plugin_active( $tab[3] )) $enabled = 'disabled';
				  }	
		 ?>
			<?php if($enabled == 'enabled') : ?>
			<li<?php echo ($tabsIterator == $activeTab) ? ' class="'.str_replace(' ', '', strtolower($tab[0])).' active"' : ' class="'.str_replace(' ', '', strtolower($tab[0])).'"'; ?> title="<?php echo esc_attr($tab[0]); ?>"><?php echo esc_attr($tab[0]); ?></li>
			<?php 
				$tabsIterator++;
				endif; 
			?>
		<?php endforeach; ?>
		</ul>
		
		<div id="dpTabsContent">
		<?php foreach($tabs as $tab) : ?>
        <?php $enabled = $tab[2];
			  if ($tab[3] != '')  {
				  
				  if ( !is_plugin_active( $tab[3] )) $enabled = 'disabled';
				  }	
		 ?>
			<?php if($enabled == 'enabled') : ?>
			<div<?php if($contentIterator == $activeTab) echo ' class="active"'; ?>>
				<?php echo $parser->esense_generateForm($tab[1]); ?>
				
				<div class="dpSaveSettings">
					<img src="<?php echo site_url(); ?>/wp-admin/images/wpspin_light.gif" class="dpAjaxLoading" alt="Loading">
					<button class="dpSave" data-loading="<?php _e('Saving&hellip;', 'esense-functions'); ?>" data-loaded="<?php esc_attr__('Save settings', 'esense-functions'); ?>" data-wrong="<?php esc_attr__('Please check the form!', 'esense-functions'); ?>"><?php _e('Save settings', 'esense-functions'); ?></button>
				</div>
			</div>
			<?php
				$contentIterator++;
				endif; 
			?>
		<?php endforeach; ?>
		</div>
	</div>
</div>