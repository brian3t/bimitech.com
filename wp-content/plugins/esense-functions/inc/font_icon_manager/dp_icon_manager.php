<?php
	if(!class_exists('DP_Font_Icon_Manager'))
	{
		
		class DP_Font_Icon_Manager
		{
			var $paths = array();
			var $assets_js;
			var $assets_css;
			function __construct()
			{
				$this->assets_js = DPFUNCTIONS_URI.'inc/font_icon_manager/assets/js/';
				$this->assets_css = DPFUNCTIONS_URI.'inc/font_icon_manager/assets/css/';
				$this->paths = wp_upload_dir();
				$this->paths['fonts'] 	= 'dp_font_icons';
			 	$this->paths['fonturl'] = set_url_scheme(trailingslashit($this->paths['baseurl']).$this->paths['fonts']);				
				add_action('init',array($this,'DP_icon_manager_init'));
				add_action('admin_enqueue_scripts',array($this,'dp_icon_manager_admin_scripts'));
				add_action('wp_enqueue_scripts',array($this,'dp_icon_manager_front_scripts'));

			}// end constructor
			
			function DP_icon_manager_init()
			{
				require_once (__DIR__.'/modules/icon_manager.php');
			}// end DP_icon_manager_init
			function dp_icon_manager_admin_scripts()
			{
				// enqueue css files on backend
				wp_enqueue_style('vc-icon-manager',$this->assets_css.'icon-manager.css');
				wp_enqueue_script('vc-inline-editor',$this->assets_js.'vc-inline-editor.js',array('vc_inline_custom_view_js'),'1.5',true);
				$fonts = get_option('dp_font_icons');
				if(is_array($fonts))
				{
					foreach($fonts as $font => $info)
					{
						if(strpos($info['style'], 'http://' ) !== false) {
							wp_enqueue_style('dpf-'.$font,$info['style']);
							} else {
							wp_enqueue_style('dpf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
						}
					}
				}
			}// end dp_icon_manager_admin_scripts
			function dp_icon_manager_front_scripts()
			{
				$fonts = get_option('dp_font_icons');
				if(is_array($fonts))
				{
					foreach($fonts as $font => $info)
					{
						$style_url = $info['style'];
						if(strpos($style_url, 'http://' ) !== false) {
							wp_enqueue_style('dpf-'.$font,$info['style']);
							} else {
							wp_enqueue_style('dpf-'.$font,trailingslashit($this->paths['fonturl']).$info['style']);
						}
					}
				}
			}// end dp_icon_manager_front_scripts
		}//end class
		new DP_Font_Icon_Manager;
	}// end class check