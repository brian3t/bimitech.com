<?php
function CompileOptionsLess($inputFile) {
	global $esense_tpl;
	require_once ('lessc.inc.php' );
    $less = new lessc;
    $less->setPreserveComments(true);
	$url = "'".get_template_directory_uri()."'";
	$body_bg_image = "'".get_option($esense_tpl->name . '_body_bg_image')."'";
	$subheader_area_bgimage = "'".get_option($esense_tpl->name . '_subheader_area_bgimage')."'";
	$branding_logo_image = "'".get_option($esense_tpl->name . '_branding_logo_image')."'";
	$expander_bgimage = "'".get_option($esense_tpl->name . '_expander_bgimage')."'";
	$footer_bg_image =  "'".get_option($esense_tpl->name . '_footer_bg_image')."'";
    $expander_bgimage =  "'".get_option($esense_tpl->name . '_expander_bgimage')."'";
	$footerbgtype = 'n';
	if (get_option($esense_tpl->name . '_footer_pattern','none') != 'none') $footerbgtype = 'p';
	if (get_option($esense_tpl->name . '_footer_bg_image') != '') $footerbgtype = 'i';
	$expanderbgtype = 'n';
	if (get_option($esense_tpl->name . '_expander_pattern','none') != 'none') $expanderbgtype = 'p';
	if (get_option($esense_tpl->name . '_expander_bgimage') != '') $expanderbgtype = 'i';
	$less->setVariables(array(
		"url" => $url,
		/* Typography */
		"fontsize_body" => get_option($esense_tpl->name . '_fontsize_body','13px'),
		"fontsize_h1" => get_option($esense_tpl->name . '_fontsize_h1','40px'),
		"fontsize_h2" => get_option($esense_tpl->name . '_fontsize_h2','30px'),
		"fontsize_h3" => get_option($esense_tpl->name . '_fontsize_h3','18px'),
		"fontsize_h4" => get_option($esense_tpl->name . '_fontsize_h4','16px'),
		"fontsize_h5" => get_option($esense_tpl->name . '_fontsize_h5','14px'),
		"fontsize_h6" => get_option($esense_tpl->name . '_fontsize_h6','12px'),
		/* Main colors */
		"maincontent_accent_color" => get_option($esense_tpl->name . '_maincontent_accent_color','#998675'),
		"maincontent_secondary_accent_color" => get_option($esense_tpl->name . '_maincontent_secondary_accent_color','#000000'),
		/* Page wrap and body */
		"page_wrap_state" => get_option($esense_tpl->name . '_page_wrap_state','streched'),
		"page_bgcolor" => get_option($esense_tpl->name . '_page_bgcolor','#ffffff'),
		"page_pattern" => get_option($esense_tpl->name . '_page_pattern','none'),
		"body_bg_image_state" => get_option($esense_tpl->name . '_body_bg_image_state','N'),
		"body_bg_image" => $body_bg_image,
		"body_bgcolor" => get_option($esense_tpl->name . '_body_bgcolor','#ffffff'),
		"body_pattern" => get_option($esense_tpl->name . '_body_pattern','none'),
		"paspartu_state" => get_option($esense_tpl->name . '_paspartu_state','N'),
		"paspartu_bg_color" => get_option($esense_tpl->name . '_paspartu_bg_color','#ffffff'),
		"paspartu_width" => get_option($esense_tpl->name . '_paspartu_width','30').'px',
		/* Top bar */
        "top_bar_bg_color" => get_option($esense_tpl->name . '_top_bar_bg_color','#000000'),
		"top_bar_text_color" => get_option($esense_tpl->name . '_top_bar_text_color','#ffffff'),
		"top_bar_link_color" => get_option($esense_tpl->name . '_top_bar_link_color','#998675'),
		"top_bar_hlink_color" =>get_option($esense_tpl->name . '_top_bar_hlink_color','#f2f2f2'),
		"top_bar_icon_color" => get_option($esense_tpl->name . '_top_bar_icon_color','#ffffff'),
		/* Main menu and header */
		"branding_logo_type" => get_option($esense_tpl->name . '_branding_logo_type'),
		"branding_logo_image" => $branding_logo_image,
		"branding_logo_image_width" => get_option($esense_tpl->name . '_branding_logo_image_width','160').'px',
		"branding_logo_image_height" => get_option($esense_tpl->name . '_branding_logo_image_height','50').'px',
		"branding_logo_top_margin" => get_option($esense_tpl->name . '_branding_logo_top_margin','30').'px',
		"branding_logo_bottom_margin" => get_option($esense_tpl->name . '_branding_logo_bottom_margin','10').'px',
		"sticky_logo_top_margin" => get_option($esense_tpl->name . '_sticky_logo_top_margin','10').'px',
		"menu_top_bg_color" => get_option($esense_tpl->name . '_menu_top_bg_color','transparent'),		
		"top_mainmenu_link_color" => get_option($esense_tpl->name . '_top_mainmenu_link_color','#222222'),
		"top_mainmenu_hlink_color" => get_option($esense_tpl->name . '_top_mainmenu_hlink_color','#998675'),
		"menutab1_color" => get_option($esense_tpl->name . '_menutab1_color','#f3b804'),
		"menutab2_color" => get_option($esense_tpl->name . '_menutab2_color','#e57d04'),
		"menutab3_color" => get_option($esense_tpl->name . '_menutab3_color','#dd012f'),
		"menutab4_color" => get_option($esense_tpl->name . '_menutab4_color','#b10058'),
		"menutab5_color" => get_option($esense_tpl->name . '_menutab5_color','#7d388b'),
		"menutab6_color" => get_option($esense_tpl->name . '_menutab6_color','#3465aa'),
		"menutab7_color" => get_option($esense_tpl->name . '_menutab7_color','#09a274'),
		"menutab8_color" => get_option($esense_tpl->name . '_menutab8_color','#7bb753'),
		"menutab9_color" => get_option($esense_tpl->name . '_menutab9_color','#f3b804'),
		"menutab_buttons_color" => get_option($esense_tpl->name . '_menutab_buttons_color','#f3b804'),
		"sticky_header_bgcolor" => get_option($esense_tpl->name . '_sticky_header_bgcolor', 'rgba(255,255,255,0.95)'),
		"sticky_mainmenu_link_color" => get_option($esense_tpl->name . '_sticky_mainmenu_link_color','#222222'),
		"sticky_mainmenu_hlink_color" => get_option($esense_tpl->name . '_sticky_mainmenu_hlink_color','#998675'),
		"aside_logo_image_width" => get_option($esense_tpl->name . '_aside_logo_image_width','101').'px',
		"aside_logo_image_height" => get_option($esense_tpl->name . '_aside_logo_image_height','35').'px',
		"aside_mainmenu_bg_color" => get_option($esense_tpl->name . '_aside_mainmenu_bg_color', '#ffffff'),
		"aside_mainmenu_link_color" => get_option($esense_tpl->name . '_aside_mainmenu_link_color','#222222'),
		"aside_mainmenu_hlink_color" => get_option($esense_tpl->name . '_aside_mainmenu_hlink_color','#998675'),
		"submenu_bgcolor" => get_option($esense_tpl->name . '_submenu_bgcolor','#ffffff'),
		"submenu_topbordercolor" => get_option($esense_tpl->name . '_submenu_topbordercolor','#998675'),
		"submenu_link_color" => get_option($esense_tpl->name . '_submenu_link_color','#AFB4B9'),
		"submenu_hlink_color" => get_option($esense_tpl->name . '_submenu_hlink_color','#AFB4B9'),
		"submenu_hbg_color" => get_option($esense_tpl->name . '_submenu_hbg_color','#F6F6F6'),
		"overlay_mainmenu_bg_color" => get_option($esense_tpl->name . '_overlay_mainmenu_bg_color', '#ffffff'),
		"overlay_mainmenu_link_color" => get_option($esense_tpl->name . '_overlay_mainmenu_link_color','#222222'),
		"overlay_mainmenu_hlink_color" => get_option($esense_tpl->name . '_overlay_mainmenu_hlink_color','#998675'),
		"overlay_mainmenu_bg_color" => get_option($esense_tpl->name . '_overlay_mainmenu_bg_color', '#ffffff'),
		"overlay_mainmenu_link_color" => get_option($esense_tpl->name . '_overlay_mainmenu_link_color','#222222'),
		"overlay_mainmenu_hlink_color" => get_option($esense_tpl->name . '_overlay_mainmenu_hlink_color','#998675'),
		"overlapping_header_bgcolor" => get_option($esense_tpl->name . '_overlapping_header_bgcolor', '#ffffff'),
		"overlapping_mainmenu_link_color_light" => get_option($esense_tpl->name . '_overlapping_mainmenu_link_color_light','#ffffff'),
		"overlapping_mainmenu_hlink_color_light" => get_option($esense_tpl->name . '_overlapping_mainmenu_hlink_color_light','#998675'),
		"overlapping_mainmenu_link_color_dark" => get_option($esense_tpl->name . '_overlapping_mainmenu_link_color_dark','#222222'),
		"overlapping_mainmenu_hlink_color_dark" => get_option($esense_tpl->name . '_overlapping_mainmenu_hlink_color_dark','#998675'),
		/* Subheader */
		"subheader_bgcolor" => get_option($esense_tpl->name . '_subheader_bgcolor','#F7F8FA'),
		"subheader_pattern" => get_option($esense_tpl->name . '_subheader_pattern','none'),
		"subheader_area_bgimage" => $subheader_area_bgimage,
		"subheader_text_color" => get_option($esense_tpl->name . '_subheader_text_color', '#ffffff'),
		/* Expandable sidebar */
		"expander_bgcolor" => get_option($esense_tpl->name . '_expander_bgcolor','#222222'),
		"expander_bgimage" => $expander_bgimage,
		"expander_pattern" => get_option($esense_tpl->name . '_expander_pattern','none'),
		"expander_text_color" => get_option($esense_tpl->name . '_expander_text_color','#ffffff'),
		"expander_link_color" => get_option($esense_tpl->name . '_expander_link_color','#998675'),
		"expander_hlink_color" => get_option($esense_tpl->name . '_expander_hlink_color','#f6f6f6'),
		"expanderbgtype" => $expanderbgtype,
		"searchoverlay_bgcolor" => get_option($esense_tpl->name . '_searchoverlay_bgcolor','#454545'),
		"searchoverlay_text_color" => get_option($esense_tpl->name . '_searchoverlay_text_color','#ffffff'),
		/* Main content */
		"maincontent_text_color" => get_option($esense_tpl->name . '_maincontent_text_color','#7A7A7A'),
		"maincontent_headers_color" => get_option($esense_tpl->name . '_maincontent_headers_color','#7A7A7A'),
		"maincontent_link_color" => get_option($esense_tpl->name . '_maincontent_link_color', '#998675'),
		"maincontent_hlink_color" => get_option($esense_tpl->name . '_maincontent_hlink_color','#76797C'),
		/* Footer */
		"footer_bg_color" => get_option($esense_tpl->name . '_footer_bg_color','#232D37'),
		"footer_bg_image" => $footer_bg_image,
		"footer_pattern" => get_option($esense_tpl->name . '_footer_pattern','none'),
		"footer_text_color" => get_option($esense_tpl->name . '_footer_text_color','#BCC1C5'),
		"footer_header_color" => get_option($esense_tpl->name . '_footer_header_color','#ffffff'),
		"footer_link_color" => get_option($esense_tpl->name . '_footer_link_color','#ffffff'),
		"footer_hlink_color" => get_option($esense_tpl->name . '_footer_hlink_color','#998675'),
		"footerbgtype" => $footerbgtype,
		"copyrightbgcolor" => get_option($esense_tpl->name . '_copyright_bg_color','rgba(0,0,0,.2)'),
		"copyrightbordercolor" => get_option($esense_tpl->name . '_copyright_border_color','rgba(0,0,0,0)'),
		"copyrighttextcolor" => get_option($esense_tpl->name . '_copyright_text_color','#A2A2A2'),
		"copyrightlinkcolor" => get_option($esense_tpl->name . '_copyright_link_color','#A2A2A2'),
		"copyrighthlinkcolor" => get_option($esense_tpl->name . '_copyright_hlink_color','#fff'),
		/* 404 Page */
		"page404_bg_image_state" => get_option($esense_tpl->name . '_404_bg_image_state','N'),
		"maincontent_accent_color_07" => esense_hexToRGBA(get_option($esense_tpl->name . '_maincontent_accent_color','#998675'),0.7)
    ));
	$upload_dir = wp_upload_dir();
	$dynamic_css_path		= $upload_dir['basedir'];
    $less->compileFile(get_template_directory() . '/css/less/' . $inputFile, $dynamic_css_path . '/esense-dynamic.css');
}
function addCustomCSS() {
	global $esense_tpl;
	$customcss = get_option($esense_tpl->name . '_custom_css_code');
	$output = '';
	if ((get_option($esense_tpl->name . '_404_bg_image_state','N') == "Y") && (get_option($esense_tpl->name . '_page404_bg_image','') != "") )
	{$output .= "<style type='text/css'>body.error404 {background-image:url(".get_option($esense_tpl->name . '_page404_bg_image','').")</style>";
	}
	if ($customcss != '') {
	$output .= "<style type='text/css'>".$customcss."</style>";
	}
	echo $output;
}
add_action('wp_head','addCustomCSS');

// EOF