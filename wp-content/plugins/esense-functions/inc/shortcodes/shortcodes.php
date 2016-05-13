<?php

// disable direct access to the file	
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 *
 * Shortcodes
 *
 * CSS loaded from shortcodes.css
 * JS loaded from shortcodes.js
 *
 * Groups of shortcodes
 *
 * - typography
 * - layout shortcodes
 * - page interactive elements
 * - template specific shortcodes
 *
 **/


		
	function typo_h1($atts, $content = null) {
		return '<h1>'.$content.'</h1>';
	}
	
	function typo_h2($atts, $content = null) {
		return '<h2>'.$content.'</h2>';
	}
	
	function typo_h3($atts, $content = null) {
		return '<h3>'.$content.'</h3>';
	}
	
	function typo_h4($atts, $content = null) {
		return '<h4>'.$content.'</h4>';
	}
	
	function typo_h5($atts, $content = null) {
		return '<h5>'.$content.'</h5>';
	}
	
	function typo_h6($atts, $content = null) {
		return '<h6>'.$content.'</h6>';
	}
	
	function typo_contentheading($atts, $content = null) {
		return '<div class="contentheading">'.$content.'</div>';
	}
	
	function typo_componentheading($atts, $content = null) {	
		return '<div class="component-header"><h2 class="componentheading">'.$content.'</h2></div>';
	}
	
	function typo_div($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => '',
			'class2' => ''
		), $atts));

		if($class != '') $class = ' class="'.$class.'"';
		if($class2 != '') $class2 = ' class="'.$class2.'"';
		return '<div'.$class.'><div'.$class2.'>'.do_shortcode($content).'</div></div>';
	}
	
	function typo_div2($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if($class != '') $class = ' class="'.$class.'"';
		return '<div'.$class.'>'.do_shortcode($content).'</div>';
	}

	function typo_div3($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => '',
			'class2' => '',
			'class3' => ''
		), $atts));

		if($class != '') $class = ' class="'.$class.'"';
		if($class2 != '') $class2 = ' class="'.$class2.'"';
		if($class3 != '') $class3 = ' class="'.$class3.'"';
		return '<div'.$class.'><div'.$class2.'><div'.$class3.'>'.do_shortcode($content).'</div></div></div>';
	}
	
	function typo_alert_box($atts, $content = null) {
		extract(shortcode_atts(array(
			'type' => 'error',
			'sticky' => 'no',
			'title' => '',
			'icon' => ''
			), $atts));
		$class = ' class="notification '.$type.'"';
		$html = '<div '.$class.'>';
        $html .='<p>';
		if ($icon != '') {
		$html .= '<i class="'.$icon.'"></i>';
		}
		if ($title != '') {
		$html .= '<span>'.$title.'</span>';
		}
		$html .= $content;
		$html .= '</p>';
		if ($sticky != 'no') {
		$html .= '<a class="close"></a>';
		}
		$html .= '</div>';
		
		return $html;
	}
	
	function typo_icon($atts, $content = null) {
		global $esense_tpl;
		extract(shortcode_atts(array(
			'icon' => 'icon-wordpress',
			'color' => '#555555',
			'badge' => '',
			'badgecolor' => '',
			'size' => 'small'
			
			), $atts));
		$icon = preg_replace('/\s/', '', $icon);
		if ($color != ''){
		$style1 = 'style="';
		$style1 .= 'color:'.$color.';';  
		$style1 .= '"';
		}
		if ($badgecolor != ''){
		$style2 = 'style="';
		$style2 .= 'background-color:'.$badgecolor.';';
		$style2 .= 'border-color:'.$badgecolor.';';
		$style2 .= '"';
		}
		$class = 'class="esense_icon '.$size.'';
		if ($badge!='') $class .=' '.$badge;
		$class .= '"';
		
		$outputcontent = '<div '.$class.' '.$style2.'>';
		$outputcontent.='<i class="'.$icon.'" '.$style1.'></i></div>';
		return $outputcontent;
	}
	
	
	function typo_pre($atts, $content = null) {	
		return '<pre>'.$content.'</pre>';
	}
	
	function typo_blockquote($atts, $content = null) {	
		return '<blockquote>'.$content.'</blockquote>';
	}
	
	
	function typo_legend1($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		return '<div class="esense_legend1"> <h4>'.$title.'</h4><p>'.do_shortcode($content).'</p></div>';
	}

	function typo_legend2($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		return '<div class="esense_legend2"> <h4>'.$title.'</h4><p>'.do_shortcode($content).'</p></div>';
	}
	function typo_legend3($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		return '<div class="esense_legend3"> <h4>'.$title.'</h4><p>'.do_shortcode($content).'</p></div>';
	}
	function typo_list($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if($class != '') $class = ' class="'.$class.'"';
		return '<ul'.$class.'>'.do_shortcode($content).'</ul>';
	}
	
	function typo_li($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => '',
			'size' => '',
			'color' => ''
		), $atts));
        global $esense_tpl;
		if ($color == "accented") {	$color = get_option($esense_tpl->name . '_maincontent_accent_color');}
		$class = preg_replace('/\s/', '', $class);
		if($class != '') :
			$class= 'icon-'.$class;
			if ($size !='') $class = $class = $class.' icon-large';
			if ($color !='') $color = ' style="color:'.$color.'"';
			return '<li style="list-style:none;line-height:2em"><i class="'.$class.'" '.$color.'></i>'.do_shortcode($content).'</li>';
		else :
			return '<li>'.do_shortcode($content).'</li>';
		endif;
	}
	
	function typo_ord_list($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if($class != '') $class = ' class="'.$class.'"';
		return '<ol'.$class.'>'.do_shortcode($content).'</ol>';
	}
	
	function typo_discnumber($atts, $content = null) {
		extract(shortcode_atts(array(
			'number' => '',
			'color1' => '#555',
			'color2' => '#fff'
		), $atts));
		return '<div class="number"><p><span style="color:'.$color2.'; background-color:'.$color1.'">'.$number.'</span>'.do_shortcode($content).'</p></div>';
	}
	
	function typo_bignumber($atts, $content = null) {
		extract(shortcode_atts(array(
			'number' => '',
			'color1' => '#555',
			'color2' => '#fff'
		), $atts));
		$style = 'style = "color:'.$color2.'; background-color:'.$color1.';"';
		return '<p  class="bignumber"><span class="bnumber" '.$style.'>'.$number.'</span>'.do_shortcode($content).'</p>';
	}
	
	function typo_emphasis($atts, $content = null) {	
		return '<em class="color">'.$content.'</em>';
	}
	
	function typo_emphasisbold($atts, $content = null) {	
		return '<em class="bold">'.$content.'</em>';
	}
	
	function typo_emphasisbold2($atts, $content = null) {	
		return '<em class="bold2">'.$content.'</em>';
	}
	
	
	function typo_dropcap($atts, $content = null) {
		extract(shortcode_atts(array(
			'cap' => ''
		), $atts));

		return '<p class="dropcap"><span class="dropcap">'.$cap.'</span>'.$content.'</p>';
	}
	
	function typo_important($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));

		return '<div class="important"><span class="important-title">'.$title.'</span>'.$content.'</div>';
	}
	
	function typo_underline($atts, $content = null) {	
		return '<span style="text-decoration:underline;">'.$content.'</span>';
	}
	
	function typo_bold($atts, $content = null) {	
		return '<span style="font-weight:bold;">'.$content.'</span>';
	}
	
	function typo_italic($atts, $content = null) {	
		return '<span style="font-style:italic;">'.$content.'</span>';
	}
	
	function typo_clear($atts, $content = null) {	
		return '<div class="clear"></div>';
	}
	
	function typo_readon($atts, $content = null) {
		extract(shortcode_atts(array(
			'url' => ''
		), $atts));

		return '<p><a class="button" style="margin-top:0!important;" href="'.esc_url($url).'">'.$content.'</a></p>';
	}
	
	function typo_readon2($atts, $content = null) {
		extract(shortcode_atts(array(
			'url' => ''
		), $atts));

		return '<a href="'.esc_url($url).'">&nbsp;&nbsp;'.$content.' &rarr;</a>';
	}
	
	function typo_clearboth() {
   return '<div class="clearboth"></div>';
	}
	
	function typo_divider() {
		return '<div class="divider"></div>';
	}
	
	function typo_divider_top() {
		return '<div class="divider top"><a href="#">'.__('Top','esense-functions').'</a></div>';
	}
	
	function typo_space($atts, $content = null) {
		extract(shortcode_atts(array(
			'size' => '5'
			), $atts));
		return '<div style="height:'.$size.'px; width:100%;clear:both"></div>';
	}
	
	function typo_divider_padding() {
		return '<div class="divider_padding"></div>';
	}
	
	function typo_divider_line() {
		return '<div class="divider_line"></div>';
	}
		
	function typo_button($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'id' => 'button-'.mt_rand(),
			'class' => false,
			'size' => 'small',
			'link' => '',
			'linktarget' => '',
			'style' => '',
			'icon' => '',
			'bgcolor' => '',
			'hbgcolor' =>'',
			'width' => false,
			'textcolor' => '',
			'htextcolor' => '',
			'full' => "false",
			'align' => '',
			'button' => "false",
			'dp_animation' => "",
			'subtitle' => ''
		), $atts));
		$icon = preg_replace('/\s/', '', $icon);
		$cssid = $id;
		$id = $id?' id="'.$id.'"':'';
		$full = ($full==="false")?'':' full';
		$style = $style?' '.$style:'';
		$class = $class?' '.$class:'';
		$link = $link?' href="'.$link.'"':'';
		$rel = '';
		if ($linktarget == 'lightbox') $rel = ' data-rel="esense_lightbox"';
		if ($linktarget != 'lightbox') $linktarget = $linktarget?' target="'.$linktarget.'"':'';
		
		if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
		if ($icon !='' && $icon !='none') {
		$icon = '<i class="'.$icon.'"></i> ';
		$class .=' btnwithicon';
		} else { $icon = '';
		}
		$width = $width?'width:'.$width.'px;':'';
		if($align == 'right'){
			$aligncss = ' style="float:right"';
		}else{
			$aligncss = '';
		}
		if($button == 'true'){
			$tag = 'button_dp';
		}else{
			$tag = 'a';
		}
		
		$customstyle = "";
		
		if ($bgcolor !="") $customstyle .= '#'.$cssid.' {background-color: '.$bgcolor.'!important; border-color: '.$bgcolor.'!important;}';
		if ($textcolor !="") $customstyle .= '#'.$cssid.' span {color: '.$textcolor.'!important;}';
		if ($hbgcolor !="") $customstyle .= '#'.$cssid.':hover {background-color: '.$hbgcolor.'!important; border-color: '.$hbgcolor.'!important;}';
		if ($htextcolor !="") $customstyle .= '#'.$cssid.' span:hover {color: '.$htextcolor.'!important;}';
		if ($customstyle != "") $customstyle ='<style scoped>'.$customstyle.'</style>';	
		$content = '<'.$tag.$id.$link.$linktarget.$dp_animation.$rel.' class="button_dp '.$size.$style.$full.$class.'" '.$aligncss.'><span'.(($width!='')?' style="'.$width.'"':'').'>'.$icon.' ' . trim($content);
		if ($size=='extralargebold') $content .= '<br/><span class="btn_subtitle">'.$subtitle.'</span>';
		$content .= '</span></'.$tag.'>';
		
		if($align === 'center'){
			return $customstyle.'<p class="center">'.$content.'</p>';
		}else{
			return $customstyle.$content;
		}
	}
	function typo_button_standart($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'link' => '',
			'linktarget' => '',
		), $atts));
		$link = $link?' href="'.$link.'"':'';
		$linktarget = $linktarget?' target="'.$linktarget.'"':'';
		
		
		$content = '<a class="btn" '.$link.' '.$linktarget. '>' . trim($content) . '</a>';
			return $content;
	}
/**
 *
 * Layout shortcodes
 *
 **/
function dp_column($atts, $content = null, $code) {
		
		return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
	}

 function dp_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'history' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			if($history=='true'){
				$href= '#'.str_replace(" ", "_", trim($matches[3][$i]['title']));
			}else{
				$href = '#';
			}
			$output .= '<li><a href="'.$href.'"><div class="tab_title"><i class="'.$matches[3][$i]['icon'].'"></i>' . $matches[3][$i]['title'] . '</div></a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		if($history=='true'){
			$data_history = ' data-history="true"';
		}else{
			$data_history = '';
		}
		
		return '<div class="'.$code.'_container"'.$data_history.'>' . $output . '</div>';
	}
}





function dp_faq($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => '',
		'icon' => ''
	), $atts));
	return '<div class="toggle faq"><h4 class="toggle_title"><span class="icon-holder"><i class="'.$icon.'"></i></span>'. $title . '</h4><div class="toggle_content">' . wpb_js_remove_wpautop($content, true) . '</div></div>';
}

function dp_frame_left( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'icon' => '',
		'lightbox' => '',
		'title' => '',
		'desc' => '',
		'popupw' => '',
		'popuph' => ''
		), $atts));
	if($link !='') { if($lightbox =='true') {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'?width='.$popupw.'&height='.$popuph.'" data-rel="esense_lightbox" title="'.esc_attr($title).' :: '.$desc.'"><img src="'.do_shortcode($content).'" /></a>';} 
	else {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'"><img src="'.do_shortcode($content).'" /></a>';}} else {$output= '<img src="' .do_shortcode($content) . '" />';}; 
   return '<span class="frame alignleft">' .$output . '</span>';
}

function dp_frame_right( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'icon' => '',
		'lightbox' => '',
		'title' => '',
		'desc' => '',
		'popupw' => '',
		'popuph' => ''
		), $atts));
	if($link !='') { if($lightbox =='true') {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'?width='.$popupw.'&height='.$popuph.'" data-rel="esense_lightbox" title="'.esc_attr($title).' :: '.$desc.'"><img src="'.do_shortcode($content).'" /></a>';} 
	else {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'"><img src="'.do_shortcode($content).'" /></a>';}} else {$output= '<img src="' .do_shortcode($content) . '" />';}; 
   return '<span class="frame alignright">' .$output . '</span>';
}

function dp_frame_center( $atts, $content = null ) {
extract(shortcode_atts(array(
		'link' => '',
		'icon' => '',
		'lightbox' => '',
		'title' => '',
		'desc' => '',
		'popupw' => '',
		'popuph' => ''
		), $atts));
	if($link !='') { if($lightbox =='true') {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'?width='.$popupw.'&height='.$popuph.'" data-rel="esense_lightbox" title="'.esc_attr($title).' :: '.$desc.'"><img src="'.do_shortcode($content).'" /></a>';} 
	else {$output= '<a class="imgeffect '.$icon.'" href="'.$link.'"><img src="'.do_shortcode($content).'" /></a>';}} else {$output= '<img src="' .do_shortcode($content) . '" />';}; 
    return '<div class="textaligncenter"><span class="frame aligncenter">' .$output . '</span></div>';
}

function dp_frame_caption( $atts, $content = null ) {
extract(shortcode_atts(array(
		'title' => '',
		'caption' => ''
		), $atts));
	if($title !='') {$title = '<h5 class="cap1">'.$title.'</h5>';};
	if($caption !='') {$caption = '<h5 class="cap2">'.$caption.'</h5>';}; 
	$output= '<img src="' .do_shortcode($content) . '" width="100%" />'; 
    return '<div class="frame_caption">' .$output . '<div class="captions">'.$title.$caption.'</div></div>';
}

function dp_table($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'width' => false,
	), $atts));
	
	
	if($width){
		$width = ' style="width:'.$width.'"';
	}else{
		$width = '';
	}
	
	$id = $id?' id="'.$id.'"':'';
	
	return '<div'.$id.$width.' class="table_style">' . do_shortcode(trim($content)) . '</div>';
}

function dp_gallery( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'images' => '',
		'columns' => '',
		'nomargin' => '',
		'grayscale' => ''
	), $atts));
	$id = 'gallery-'.mt_rand();
	$addclass = '';
	if(strtolower($nomargin) == 'true') { $addclass .= ' nomargin'; }
	if(strtolower($grayscale) == 'true') { $addclass .= ' grayscale'; }
	$images = explode( ',', $images );
	$output = '<div class="esense-wall columns-'.$columns.$addclass.'">';
	foreach ( $images as $attach_id ) {
		$output .= '<div class="item">';
		$output .= '<figure><a href="'.wp_get_attachment_url( $attach_id ).'" data-rel="esense_lightbox['.$id.']">';
		$output .= '<div class="text-overlay"><div class="info"><span><i class="icon-search"></i></span></div></div>';
		$output .= '<img src='.wp_get_attachment_url( $attach_id ).' alt="">';
		$output .= '</a></figure>';
		$output .= '</div>';
		$output .= '';
		}
	$output .= '</div>';
	return $output;
}



function lightbox_shortcode($atts, $content = null) {
   
	extract(shortcode_atts(array(
		'videolink' => '',
		'images' => '',
		'title' => '',
		'album' => '',
		'desc' => '',
		'thumb' => '',
		'hover_icon' => 'zoom',
		'dp_animation' => ''
	), $atts));
	$album = '';
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	if ($hover_icon == 'zoom') $hover_icon = 'icon-zoom';
	if ($hover_icon == 'play') $hover_icon = 'icon-play';
	if ($hover_icon == 'file') $hover_icon = 'icon-document';
	if (is_numeric($thumb)) {
            $thumb_src = wp_get_attachment_url($thumb);
        } else {
            $thumb_src = $thumb;
        }
	if ($images == '') {$link = $thumb_src;
	} else {
	$images = explode( ',', $images );
	$link = wp_get_attachment_url($images[0]);
	$images = array_slice($images, 1);      
	if (count($images)>0) $album = 'album-'.mt_rand();
	}
	
	if ($desc !='') $title= $title.' :: '.$desc;
	if ($album !='') $album = '['.$album.']';
	$generate_lightbox = '';
	
	$generate_lightbox = '<figure '.$dp_animation.'><a href="'.$link.'" title="'.esc_attr($title).'" alt="" data-rel="esense_lightbox'.$album.'"><div class="text-overlay"><div class="info"><span><i class="'.$hover_icon.'"></i></span></div></div></a><img src="'.$thumb_src.'"></figure>';
	if (is_array($images)) {
	foreach ( $images as $attach_id ) {
	$generate_lightbox .= '<a class="display-none" href="'.wp_get_attachment_url( $attach_id ).'" title="'.esc_attr($title).'" alt="" data-rel="esense_lightbox'.$album.'"></a>';
	}
	}
	return $generate_lightbox;
}

function dp_slideshow($atts) {

	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
		'speed' =>'5',
		'type' =>'image',
	), $atts));
	
	esense_add_flex();
	include_once (get_template_directory() . '/dynamo_framework/helpers/helpers.contentslideshow.php');
		
		 
	$return_html = esense_contentslideshow($id, $speed, $type);
	
	return $return_html;
}

function dp_carousel($atts) {

	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
		'itemwidth' =>'190',
		'itemmargin' =>'5',
		'minitem' =>'3',
		'maxitem' =>'5',

	), $atts));
	
	esense_add_flex();
	include_once (get_template_directory() . '/dynamo_framework/helpers/helpers.contentcarousel.php');
		
		 
	$return_html = esense_contentcarousel($id, $itemwidth ,$itemmargin ,$minitem , $maxitem);
	
	return $return_html;
}

function dp_pricing_column( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'column_style' => '',
		'inistate' => '',
		'arrowed' => '',
		'price_bgcolor' => '',
		'price_txtcolor' => '',
		'useimage' => '',
		'image_type' =>'selector',
		'icon' => '',
		'icon_size' => '',
		'icon_color' => '',
		'icon_style' => '',
		'icon_badge_color' => '#fff',
		'image' => '',
		'title' => '',
		'subtitle' => '',
		'price' => '',
		'currency' => '',
		'currencypos' => '',
		'price_sub' => '',
		'ribbon' => '',
		'ribbon_text' => '',
		'ribbon_bgcolor' => '',
		'ribbon_txtcolor' =>'',
		'link' => '',
		'button_txt' => 'Buy Now',
		'button_style' => ''
    ), $atts));
	if (is_numeric($image)) {
            $image_src = wp_get_attachment_url($image);
        } else {
            $image_src = $image;
        }
	$customstyle1 = $customstyle2 = $icon_style1 = '';
	if ($column_style == 'custom') {
	$customstyle1 = ' style="background-color:'.$price_bgcolor.'"';
	$customstyle2 = ' style="color:'.$price_txtcolor.'"';
	}	
	if(strtolower($arrowed) == 'true') { $column_style .= ' is_indicator'; }
	if ($column_style == 'highlighted' && strtolower($inistate) == 'true') {
		$column_style .= ' premium'; 
	}
	if ($image_type == 'selector') { 
	$icon_style1 = ' style="';
	$icon_style1 .= 'color:'.$icon_color.';';
	if ($icon_style != '') {
	$icon_style1 .=  'background-color:'.$icon_badge_color.';';
	}
	$icon_style1 .= 'font-size:'.$icon_size.'px;';
	$icon_style1 .= '"';
	}
	$html ='';
	$html .= '<div class="plan '.$column_style.'">';
	if(strtolower($ribbon) == 'true'){
	$html.= '<div class="ribbon" style="background-color:'.$ribbon_bgcolor.';color:'.$ribbon_txtcolor.';">'.$ribbon_text.'</div>';	
	}
	$html .= '<div class="plan-top"'.$customstyle1.'>';
    $html .= '<h3'.$customstyle2.'>'.$title;
	if ($subtitle != '') $html .= '<br/><span>'.$subtitle.'</span>';
	$html .= '</h3>';
	if (strtolower($useimage) == 'true' && $image_type == 'image' && $image_src != '') {
	$html .= '<img src="'.$image_src.'" />';
	}
	if (strtolower($useimage) == 'true' && $image_type == 'selector' && $icon != '') {
	$html .= '<div class="i-holder '.$icon_style.'"><i class ="'.$icon.'"'.$icon_style1.'></i></div>';
	}
	$html .= '<div class=" plan-price"'.$customstyle2.'>';
	if ($currencypos =='after') { 
	$html .= '<span class="value">'.$price.'<span class="plan-currency">'.$currency.'</span><span class="period">'.$price_sub.'</span></span>';
	}
	if ($currencypos == 'before') { 
	$html .= '<span class="value"><span class="plan-currency">'.$currency.'</span>'.$price.'<span class="period">'.$price_sub.'</span></span>';
	}
	$html .= '</div>';
	if(strtolower($arrowed) == 'true') {
	$html .= '<div class="down_indicator"></div>';
	}
	$html .= '</div>';
	$html .= '<div class="plan-features">'.wpb_js_remove_wpautop($content, true);
	if ($link != '') {
	$html .= ' <div class="button-area">
		  <a href="'.$link.'" target="_self" class="button_dp small '.$button_style.'"><span>'.$button_txt.'</span></a>
		  </div>';
	}
	$html .= '</div>
          </div><div class="clearboth"></div>';
	
	return $html;
	
}

function dp_googlemap( $atts ){

    global $attributes;
    global $js;
    wp_register_script('google-map-api-js', 'http://maps.google.com/maps/api/js?sensor=false', array(), false, true);
	wp_enqueue_script('google-map-api-js');
	wp_register_script('gmap3-js', get_template_directory_uri().'/js/gmap3.min.js', array('jquery'),false);
	wp_enqueue_script('gmap3-js');

    extract(shortcode_atts(Array(
            'id'     => 'map1',
            'width'  => '600',
            'height' => '350',
            'margin' => '0',
            'text'  => '',
            'long'      => '',
            'lat'      => '',
            'zoom'   => 12 ,
			'mapcontrol' => 'false',
			'streetview' => 'false',
			'zoomcontrol'=> 'true',
			'pancontrol'=> 'true',
			'address' => ''
        ), $atts ));
    

	$id = 'map-'.mt_rand();
	$js = '<script type="text/javascript">';
	$js .= 'jQuery(document).ready(function(){'.'';
    $js .= 'jQuery("#'.$id.'").gmap3(
	 { map:{';
	if ($address != "") {
	$js .= 'address:"'.$address.'",';
	}
	$js .= 'options:{';
	if ($lat != "" && $long != "") {
	$js .= 'center:['.$lat.', '.$long.'],';
	}
	if ($text != '') {
	$js .= 'content:"'.$text.'",';
	}
	$js .= '
     zoom:'.$zoom.',';
	$js .= 'disableDefaultUI: '.$mapcontrol.',';
	$js .= 'panControl: '.$pancontrol.',';
	$js .= 'zoomControl: '.$zoomcontrol.',';
	$js .= 'streetViewControl: '.$streetview.',';
	$js .='}
 },
	marker:{';
	if ($lat != "" && $long != "") {
    $js .= 'latLng:['.$lat.', '.$long.']';
	}
	if ($address != "") {
	$js .= 'address:"'.$address.'",';
	}
	$js .= '		},';
	if ($text != '') {
	$js .= 'infowindow:{';
     $js .= 'options:{
       content: "'.$text.'"
     }
	}';
	}
	 $js .='}
	)';
    $js .= '});';
    $js .= '</script>';
    
    $attributes = 'id="'. $id .'" class="gmap" style="width:'. $width .'px; height:'. $height .'px; margin:'. $margin .'px; overflow:hidden;"';
    return $js . '<div '. $attributes .'></div>';}
		
function dp_chart( $atts ) {
	extract(shortcode_atts(array(
	    'data' => '',
	    'colors' => '',
		'size' => '400x200',
	    'bg' => 'bg,s,ffffff',
	    'title' => '',
	    'labels' => '',
	    'advanced' => '',
	    'type' => 'pie'
	), $atts));
 
	switch ($type) {
		case 'line' :
			$charttype = 'lc'; break;
		case 'xyline' :
			$charttype = 'lxy'; break;
		case 'sparkline' :
			$charttype = 'ls'; break;
		case 'meter' :
			$charttype = 'gom'; break;
		case 'scatter' :
			$charttype = 's'; break;
		case 'venn' :
			$charttype = 'v'; break;
		case 'pie' :
			$charttype = 'p3'; break;
		case 'pie2d' :
			$charttype = 'p'; break;
		case 'pie2d' :
			$charttype = 'p'; break;
		default :
			$charttype = $type;
		break;
	}
 
	
	$string = '&chs='.$size.'';
	$string .= '&chd=t:'.$data.'';
	$string .= '&chf='.$bg.'';
	if ($charttype=='bhg') $string .= '&chxt=x,y';
	if ($title) $string .= '&chtt='.$title.'';
	if ($labels) $string .= '&chxl='.$labels.'';
	if ($colors) $string .= '&chco='.$colors.'';
	
	return '<img title="'.esc_attr($title).'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.esc_attr($title).'" />';
}
function dp_youtube($atts) {

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
		'autoplay' => ''
	), $atts));
	$params = '';
	if ($autoplay == 'yes') $params ='&autoplay=1'; 
	$custom_id = time().rand();
	$return_html = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?feature=player_detailpage'.$params.'" frameborder="0" allowfullscreen></iframe>';
	return $return_html;
}


function dp_vimeo($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
		'autoplay' => '',
		'loop' => ''
	), $atts));
	$params = '';
	if ($autoplay == 'yes') $params ='&autoplay=1'; 
	if ($loop == 'yes') $params .='&loop=1';
	$custom_id = time().rand();
	
	$return_html = '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=777d80'.$params.'&amp;api=1&amp;player_id=vim_id0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
	return $return_html;
}

function dp_html5video($atts) {

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'poster' => '',
		'mp4' => '',
		'webm' => '',
		'ogg' => '',
	), $atts));
	
	$custom_id = time().rand();
	
	$return_html = '<div class="video-js-box vim-css"> 
    <video id="example_video_1" class="video-js" width="'.$width.'" height="'.$height.'" controls="controls" preload="auto" poster="'.$poster.'"> 
      <source src="'.$mp4.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' /> 
      <source src="'.$webm.'" type=\'video/webm; codecs="vp8, vorbis"\' /> 
      <source src="'.$ogg.'" type=\'video/ogg; codecs="theora, vorbis"\' /> 
      <object id="flash_fallback_1" class="vjs-flash-fallback" width="640" height="264" type="application/x-shockwave-flash"
        data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf"> 
        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" /> 
        <param name="allowfullscreen" value="true" /> 
        <param name="flashvars" value=\'config={"playlist":["'.$poster.'", {"url": "'.$mp4.'","autoPlay":false,"autoBuffering":true}]}\' /> 
        <img src="'.$poster.'" width="640" height="264" alt="Poster Image"
          title="No video playback capabilities." /> 
      </object> 
    </video> 
  </div> ';
	
	return $return_html;
}

function dp_mp3($atts) {

	//extract short code attr
	extract(shortcode_atts(array(
		'url' => '',
		'autoplay' => '',
		'title' => '',
		'author' => ''
	), $atts));
	if ($author != '') $author = $author.': ';
	$return_html = '';
	$id = 'mp3-'.mt_rand();
  $return_html = '<script type="text/javascript">';
  $return_html .= 'jQuery(document).ready(function(){';
  $return_html .= 'jQuery("#jquery_jplayer_'.$id.'").jPlayer({';
  $return_html .= 'ready: function () {';
  $return_html .= 'jQuery(this).jPlayer("setMedia", {';
  $return_html .= 'mp3: "'.$url.'",';
  $return_html .= '});';
  $return_html .= '},';
  $return_html .= 'cssSelectorAncestor: "#jp_container_'.$id.'",';
  $return_html .= 'supplied: "mp3"';
  $return_html .= '});';
  $return_html .= '});';
  $return_html .= '</script>';
 
  		$return_html .= '<div class="clearboth"></div><div id="jquery_jplayer_'.$id.'" class="jp-jplayer"></div>';
		$return_html .= '<div id="jp_container_'.$id.'" class="jp-audio">';
		$return_html .= '<div class="jp-type-single">';
		$return_html .= '	<div class="jp-gui jp-interface">';
	  	$return_html .= '		<div class="jp-progress">';
		$return_html .= '		  <div class="jp-seek-bar">';
		$return_html .= '			<div class="jp-play-bar"><span></span></div>';
		$return_html .= '		  </div>';
		$return_html .= '		</div>';
		$return_html .= '		<a href="javascript:;" class="jp-play" tabindex="1">play</a>';
		$return_html .= '		<a href="javascript:;" class="jp-pause" tabindex="1">pause</a>';
		$return_html .= '		<div class="jp-volume-bar">';
		$return_html .= '		  <div class="jp-volume-bar-value"><span class="handle"></span></div>';
		$return_html .= '		</div>';
		$return_html .= '		<a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a>';
		$return_html .= '		<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a>';
		$return_html .= '		<div class="mp3-title"><span>'.$author.'</span>'.$title.'</div>';
		$return_html .= '	</div><div class="clearboth"></div>';

		$return_html .= '	<div class="jp-no-solution">';
		$return_html .= '		<span>Update Required</span>';
		$return_html .= '		To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.';
		$return_html .= '	</div>';
		$return_html .= '</div>';
		$return_html .= '</div>';
	
	return $return_html;
}

function dp_soundcloud($atts) {
global $esense_tpl;
	//extract short code attr
	extract(shortcode_atts(array(
		'url' => '',
		'autoplay' => 'false',
		'artwork' => 'true',
		'playlist' => 'no',
		'color' =>''
	), $atts));
	$height = '166';
	if ($color =='') $color = get_option($esense_tpl->name . '_maincontent_accent_color');
	$color = str_replace( '#', '', $color);
	if ($playlist == 'yes') $height ='450';
	$return_html = '<iframe width="100%" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.esc_url($url).'&amp;color='.$color.'&amp;auto_play='.$autoplay.'&amp;show_artwork='.$artwork.'"></iframe>';
	return $return_html;
}

function dp_popular_posts($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'number' => '3',
		'thumb_width' => '70',
		'words' => '15'
	), $atts));
	
	
	$return_html = esense_print_popular_posts($number,$thumb_width, $words );
	
	return $return_html;
}

function dp_recent_posts($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'cat' => '',
		'number' => '3',
		'thumb_width' => '70',
		'words' => '15'
	), $atts));
	
	$return_html = esense_print_recent_post($cat,$number,$thumb_width, $words );
	
	return $return_html;
}
function dp_social_links( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'type' => '',
		"icon_color" => "",
		"el_class" => ""
		), $atts));
	//[social_links_container]
	$el_id =uniqid("el_");
	$custom_el_css = '';
	if ($icon_color !=''){
	$custom_el_css = '<style scoped>';
	$custom_el_css  .= '#'.$el_id.'.social-icons a {border-color:'.$icon_color.';}';
	$custom_el_css  .= '#'.$el_id.'.social-icons a:before {color:'.$icon_color.';}';
	$custom_el_css .= "</style>";
	}

	$dp_social_links='<ul id="'.$el_id.'" class="social-icons '.$el_class.' '.$type.'">';
	$dp_social_links .= do_shortcode(strip_tags($content));
	$dp_social_links.='</ul><div class="clearboth"></div>';
	return $custom_el_css.$dp_social_links;
}

function dp_social_links_item( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '#',
		'title' =>'',
		'type' => ''
		), $atts));
		$atributes = 'class="'.$type;
		if ($title != '') $atributes .= ' esense-tipsy';
		$atributes .= '" href="'.$link.'" '; 
		if ($title != '') $atributes .= ' data-tipcontent="'.$title.'"';
	$dp_social_links_item='<li><a '.$atributes.' target="_blank"></a></li>';
	
	return $dp_social_links_item;
	
}	

function dp_team_box($atts, $content) {
	//extract short code attr
	extract(shortcode_atts(array(
		'type' => '',
		'back_bgcolor' => '#3c3c3c',
		'highligth' => '',
		'name' => '',
		'position' => '',
		'imgurl' => '',
		'twitter' => '',
		'facebook' => '',
		'gplus' => '',
		'linkedin' => '',
		'flickr' => '',
		'rss' => '',
		'dribble' => ''

	), $atts));
	$addclass = '';
	$el_id =uniqid("el_");
	if(strtolower($highligth) == 'true') { $addclass .= ' highlited'; }
	if (is_numeric($imgurl)) {
            $image_src = wp_get_attachment_url($imgurl);
        } else {
            $image_src = $imgurl;
        }
	$backstyle = ' style="background-color:'.$back_bgcolor.'"';
	if ($type =="animated") {
	$html ='<div id="'.$el_id.'" class="team-box team-box-animated esense-flipbox">';
    $html .='<div class="flipper">';
    $html .='<div id="'.$el_id.'-front" class="esense-flipbox-front">';
    $html .='<img src="'.$image_src.'" alt="">';
    $html .='<h3>'.$name.'</h3>';
    $html .='<span class="position">'.$position.'</span>';
    $html .='</div>';
    $html .='<div id="'.$el_id.'-back" class="esense-flipbox-back"'.$backstyle.'>';
	$html .='<div class="back-content">';
    $html .='<h3>'.$name.'</h3>';
    $html .='<span>'.$position.'</span>';
    $html .= wpb_js_remove_wpautop($content, true);
	$html .='</div>';
	$html .= '<ul class="social-bar rounded">';
	if ($facebook != "") $html .= '<li><a href="'.$facebook.'" class="facebook" target="_blank"></a></li>';
	if ($gplus != "") $html .= '<li><a href="'.$gplus.'" class="gplus" target="_blank"></a></li>';
	if ($twitter != "") $html .= '<li><a href="'.$twitter.'" class="twitter" target="_blank"></a></li>';
	if ($linkedin != "") $html .= '<li><a href="'.$linkedin.'" class="linkedin" target="_blank"></a></li>';
	if ($dribble != "") $html .= '<li><a href="'.$dribble.'" class="dribbble" target="_blank"></a></li>';
	if ($flickr != "") $html .= '<li><a href="'.$flickr.'" class="flickr" target="_blank"></a></li>';
	if ($rss != "") $html .= '<li><a href="'.$rss.'" class="rss" target="_blank"></a></li>';
	$html .= '</ul>';
    $html .= '</div>';
    $html .='</div>';
    $html .='</div><div class="clearboth"></div>';
	} elseif ($type =="vcard") {
    $html = '<div class="team-box vcard'.$addclass.'">';
    $html .= '<div class="team_img_container"><img src="'.$image_src.'" alt=""></div>';
    $html .= '<div class="team-box-content">';
    $html .= '<h3>'.$name.'<br/><span class="position">'.$position.'</span></h3>';
    $html .= '<div>'.wpb_js_remove_wpautop($content, true).'</div>';
	$html .= '<ul class="social-bar rounded">';
	if ($facebook != "") $html .= '<li><a href="'.$facebook.'" class="facebook" target="_blank"></a></li>';
	if ($gplus != "") $html .= '<li><a href="'.$gplus.'" class="gplus" target="_blank"></a></li>';
	if ($twitter != "") $html .= '<li><a href="'.$twitter.'" class="twitter" target="_blank"></a></li>';
	if ($linkedin != "") $html .= '<li><a href="'.$linkedin.'" class="linkedin" target="_blank"></a></li>';
	if ($dribble != "") $html .= '<li><a href="'.$dribble.'" class="dribbble" target="_blank"></a></li>';
	if ($flickr != "") $html .= '<li><a href="'.$flickr.'" class="flickr" target="_blank"></a></li>';
	if ($rss != "") $html .= '<li><a href="'.$rss.'" class="rss" target="_blank"></a></li>';
	$html .= '</ul>';
	$html .= '</div>';
	$html .= '</div><div class="clearboth"></div>';
	} else {
    $html = '<div class="team-box">';
	$html .= '<figure><a href="'.$image_src.'" data-rel="esense_lightbox">';
    $html .= '<div class="text-overlay">'; 
	$html .= '<div class="info">';
    $html .= '<span><i class="icon-search"></i></span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<img src="'.$image_src.'" alt="">';
	$html .= '</a></figure>';
    $html .= '<div class="team-box-content">';
    $html .= '<h3>'.$name.'<br/><span class="position">'.$position.'</span></h3>';
    $html .= '<div>'.wpb_js_remove_wpautop($content, true).'</div>';
	$html .= '<ul class="social-bar rounded">';
	if ($facebook != "") $html .= '<li><a href="#" class="facebook" target="_blank"></a></li>';
	if ($twitter != "") $html .= '<li><a href="#" class="twitter" target="_blank"></a></li>';
	if ($gplus != "") $html .= '<li><a href="'.$gplus.'" class="gplus" target="_blank"></a></li>';
	if ($linkedin != "") $html .= '<li><a href="#" class="linkedin" target="_blank"></a></li>';
	if ($dribble != "") $html .= '<li><a href="#" class="dribbble" target="_blank"></a></li>';
	if ($flickr != "") $html .= '<li><a href="#" class="flickr" target="_blank"></a></li>';
	if ($rss != "") $html .= '<li><a href="#" class="rss" target="_blank"></a></li>';
	$html .= '</ul>';
	$html .= '</div>';
	$html .= '</div><div class="clearboth"></div>';
	}
	return $html;
}

/**
 *
 * Template specific shortcodes
 *
**/ 
function piechart($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'percent' => '80',
		'size' => '180',
		'title' => '',
		'linewidth' => '5',
		'barcolor' => '#998675',
		'trackcolor' => '#F5F5F5',
		'percentcolor' => '',
		'textcolor' => '',
		'dp_animation' => ''
		), $atts));
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	$style = 'style ="width:'.$size.'px; height:'.$size.'px;"';
	$style1 = 'style ="line-height:'.$size.'px;';
	if ($percentcolor !='') $style1 .= ' color:'.$percentcolor;
	$style1 .= '"';
	$style2 = '';
	if ($textcolor !='') $style2 .= ' style="color:'.$textcolor.'"';

	$return_html = '<div class="chartBox" '.$dp_animation.'>
					<span '.$style.' class="easyPieChart" data-percent="'.$percent.'" data-size="'.$size.'" data-line="'.$linewidth.'" data-barcolor="'.$barcolor.'" data-trackcolor="'.$trackcolor.'">
					<span class="percent" '.$style1.'>86</span>
					</span>
					<h3'.$style2.'>'.$title.'</h3><div'.$style2.'>'.wpb_js_remove_wpautop($content, false).'</div>                   
      				</div>';	
	return $return_html;	}

function piechart2($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'percent' => '80',
		'size' => '180',
		'title' => '',
		'linewidth' => '5',
		'barcolor' => '#ffffff',
		'trackcolor' => 'rgba(255,255,255,0.4)',
		'percentcolor' => '#ffffff',
		'bgcolor' => '',
		'textcolor' => '',
		'dp_animation' => ''
		), $atts));
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	$style = 'style ="width:'.$size.'px; height:'.$size.'px;';
		if ($bgcolor !='') $style .= ' background-color:'.$bgcolor.';';
	$style .= '"';
	$style1 = 'style ="line-height:'.$size.'px;';
	if ($percentcolor !='') $style1 .= ' color:'.$percentcolor;
	$style1 .= '"';
	$style2 = '';
	if ($textcolor !='') $style2 .= ' style="color:'.$textcolor.'"';
	$return_html = '<div class="chartBox" '.$dp_animation.'>
					<span '.$style.' class="easyPieChart2" data-percent="'.$percent.'" data-size="'.$size.'" data-line="'.$linewidth.'" data-barcolor="'.$barcolor.'" data-trackcolor="'.$trackcolor.'">
					<span class="percent" '.$style1.'>86</span>
					</span>
					<h3'.$style2.'>'.$title.'</h3><div'.$style2.'>'.wpb_js_remove_wpautop($content, false).'</div>                  
      				</div>';	
	return $return_html;	}


function counter($atts, $content = null) {
	extract(shortcode_atts(array(
	"counter_style" => "",
	"numbercolor"=>"",
	"fontsize" => "",
	"titlecolor"=>"",
	"icon" => '',
	"iconcolor" => '',
	"badgecolor" => "",
	"badge_style" => "",
	"iconfontsize" => '',
	"number"=>"1000",
	"number_sufix" => "",
	"animate_stop"=>"800",
	"cssclass" => ""), $atts));
	
	$titlestyle = "";
	if ($titlecolor != "") $titlestyle = ' style ="color:'.$titlecolor.';"';
    $html = "";
	$html .=  '<div class="stats '.$badge_style.' '.$cssclass.' '.$counter_style.'">';
	if ($icon !='none' && $icon !="") {
	$iconstyle = '';
	if ( $iconcolor != '' || $iconfontsize != '') {
	$iconstyle = 'style = "';
	if ($iconcolor != '') $iconstyle .= 'color:'.$iconcolor.';';
	if ($badgecolor != '' && ($badge_style =='rounded' || $badge_style =='diamond')) $iconstyle .= 'background-color:'.$badgecolor.';';
	if ($badgecolor != '' && $badge_style =='bordered') $iconstyle .= 'border-color:'.$badgecolor.';';
	if ($iconfontsize != ''){
		$iconw = $iconfontsize;
		$iconh = $iconfontsize;
	if ($iconfontsize != '' && ($badge_style =='rounded' || $badge_style =='diamond')) {
		$iconw = $iconfontsize + 70;
		$iconh = $iconfontsize + 70;
	}
		$iconstyle .= 'font-size:'.$iconfontsize.'px;height:'.$iconh.'px;width:'.$iconw.'px;line-height:'.$iconh.'px;';
	}
	$iconstyle .= '"';
	}
	$html .=  '<div class="ico" '.$iconstyle.'><i class="'.$icon.'"></i></div>';
	}
	$html .=  '<div class="num-container"';
	if ( ($numbercolor !='') || ($fontsize != '') ) {  
	$html .= ' style="';
	if ($numbercolor != '') $html .= 'color:'.$numbercolor.';'; 
	if ($fontsize !='') $html .= 'font-size:'.$fontsize.'px; height:'.$fontsize.'px; line-height:'.$fontsize.'px;';
	}
	$html .= '"><div class="num" data-content="'.$number.'" data-num="'.$animate_stop.'">0</div>';
	$html .= '<div class="number-sufix">'.$number_sufix.'</div></div>';
	$html .= '<div class="type"'.$titlestyle.'>'.wpb_js_remove_wpautop($content, true).'</div></div>';
    return $html;
	
}

function progressbar($atts, $content = null) {
	extract(shortcode_atts(array(
	"title"=>"Title",
	"titlecolor"=>"",
	"percent"=>"50",
	"barcolor"=>""
	), $atts));
	$titlestyle = "";
	$barstyle = "";
	if ($titlecolor != "") $titlestyle = ' style ="color:'.$titlecolor.';"';
	if ($barcolor != "") $barstyle = ' style ="background-color:'.$barcolor.';"';
    $html = "";
	$html .=  '<div class="skill-bar"><p'.$titlestyle.'>'.$title.'</p><div class="bar-wrap"><span data-width="'.$percent.'"'.$barstyle.'>';
	$html .= '<strong>'.$percent.'%</strong></span></div></div>';
    return $html;
	
}

function headline($atts, $content = null) {
	
	extract(shortcode_atts(array(
	"style"=>"",
	"subtitle"=>"",
	"hedaline_alignment" =>"",
	"underline_style" => "",
	"hedaline_subtitle_size" => "subtitle-size-small",
	"hedaline_subtitle_position" =>"bellow",
	"customcolor" => "",
	"customcolor_u" => "",
	"cssclass"=>""
	), $atts));
	$el_id =uniqid("el_");
	$addclass = ' '.$style.' '.$cssclass;
	if ($style == "big") {
	$addclass .= ' '.$hedaline_alignment.' '.$hedaline_subtitle_size;
	}
	if ($style == "big" && $underline_style != "default" ) {
	$addclass .= ' svg_underline';
	}
	$addstyle= "";
	if ($customcolor != "") $addstyle = ' style="color:'.$customcolor.'"';
	$html = "";
	$html .=  '<div id="'.$el_id.'" class="headline'.$addclass.'">';
	if ($customcolor_u != "") {
	$html .= '<style scoped>';
	$html .= '#'.$el_id.' h3:after {background-color:'.$customcolor_u.'!important;}';
	if ($style == "big" && $underline_style != "default") {
	$html .= '#'.$el_id.' .svg-fill {fill:'.$customcolor_u.';}';
	}
	$html .= '</style>';
	}
	$html .=  '<h3>';	
	if ($subtitle != "" && ($style == "big") && $hedaline_subtitle_position == 'above') {
	$html .= '<span class="subtitle"'.$addstyle.'>'.$subtitle.'</span>';
	}
	$html .=  '<span'.$addstyle.'>'.$content.'</span>';
	if ($subtitle != "" && ($style == "big") && $hedaline_subtitle_position == 'bellow') {
	$html .= '<span class="subtitle"'.$addstyle.'>'.$subtitle.'</span>';
	}
	if ($style == "big" && $underline_style != "default") {
	require_once( 'dp_svg_shapes.php' );
	$html .= '<span class="svgunderline">'.addSVGshape($underline_style).'</span>';	}
	$html .= '</h3></div>';
    return $html;	
}

function testimonial($atts, $content = null) {
	extract(shortcode_atts(array(
	"img" =>"",
	"name"=>"",
	"position"=>"",
	"dp_animation" => "",
	"el_class"=>""
	), $atts));
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	if (is_numeric($img)) {
            $image_src = wp_get_attachment_url($img);
        } else {
            $image_src = $img;
        }
    $html = "";   
	$html .= '<div class="testimonials '.$el_class.'" '.$dp_animation.'>';
	$content = '"'.$content.'"';
	$html .= wpb_js_remove_wpautop($content, true);
	if ($image_src !='') $html .= '<img alt="" src="'.$image_src.'">';
	$html .= '<h2>'.$name.'';
	if ($position != '') {
		$html .= ' - <span>'.$position.'</span>';
		}
	$html .= '</h2>';
		
	$html .= '</div>';
	return $html;
}

function featuredbox($atts, $content = null) {
	global $esense_tpl; 
	extract(shortcode_atts(array(
	"type" => "centered",
	"style" => "rounded",
	"icon"=>"",
	"title" => "",
	"icon_color" => "",
	"icon_hcolor" => "",
	"textcolor" => "",
	"button_text" => "Read more",
	"button_link" => "",
	"button_style" => "",
	"dp_animation" => "",
	"el_class"=>""
	), $atts));
	$el_id =uniqid("el_");
	$accent_color = get_option($esense_tpl->name . '_maincontent_accent_color','#c52b5d');
	$css1 = "";
	$css2 = "";
	$css3 = "";
	$css4 = "";
	$css5 = ' style="color:'.$textcolor.'"';
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	if ($type == "centered") {
		$css1= "icon-center";
		$css2 = "featured-desc-center";
		$css3 = "small";
	}
	if ($type == "left-small") {
		$css1 = "icon-lefted-small";
		$css2 = "featured-desc-left";
		$css3 = "small";
	}
	if ($type == "left-big") {
		$css1 = "icon-lefted-big";
		$css2 = "featured-desc-left";
		$css3 = "small";
	}
	if ($type == "right-small") {
		$css1 = "icon-righted-small";
		$css2 = "featured-desc-right";
		$css3 = "small";
	}
	if ($type == "right-big") {
		$css1 = "icon-righted-big";
		$css2 = "featured-desc-right";
		$css3 = "small";
	}
	$custom_el_css = '';
	if ($icon_color !='' || $icon_hcolor !='' ){
	$custom_el_css = '<style scoped>';
	if ($icon_color !='') {
	if ($style == 'rounded-border') { $custom_el_css  .= '#'.$el_id.'  i {color:'.$icon_color.';border-color:'.$icon_color.';} ';
	$custom_el_css  .= '#'.$el_id.'  .circle-border {border-color:'.$icon_color.';} ';
	}
	if ($style == 'rounded'  ) $custom_el_css  .= '#'.$el_id.'  i {background-color:'.$icon_color.';} ';
	if ($style == 'no-border') {
		$custom_el_css  .= '#'.$el_id.' i {color:'.$icon_color.';} ';
		}
	}
	if ($icon_hcolor !='') {
	if ($style == 'no-border') {
		if ($type == "centered") {
		$custom_el_css  .= '#'.$el_id.':hover  i {background-color:'.$icon_hcolor.';border-color:'.$icon_hcolor.';color:#fff;} ';
		} else {
		$custom_el_css  .= '#'.$el_id.':hover  i {color:'.$icon_hcolor.';} ';
		}
		} 
	if ($style == 'rounded-border') {$custom_el_css  .= '#'.$el_id.':hover i {background-color:'.$icon_hcolor.';border-color:'.$icon_hcolor.'; color:#fff;} ';
	$custom_el_css  .= '#'.$el_id.':hover  .circle-border {border-color:'.$icon_hcolor.';} ';
	}
	if ($style == 'rounded' ) $custom_el_css  .= '#'.$el_id.':hover  i {background-color:'.$icon_hcolor.';} ';

	}
	$custom_el_css .= "</style>";
	}
	$html = "";
	$html .= '<div id= "'.$el_id.'" class="featured-box '.$type.' '.$el_class;
	$html .= ' '.$style;
	$html .= '" '.$dp_animation.'>';
	$html .= $custom_el_css;
	$html .= '<div class="'.$css1.'"><i class="'.$icon.'">';
	if ($style == 'rounded-border'  && $type == "centered") $html .= '<i class="circle-border"></i>';
	$html .= '</i></div>';
    $html .= '<div class="'.$css2.'"'.$css5.'>';
	if ($title != "") $html .= '<h3'.$css5.'>'.$title.'</h3>';
    $html .= wpb_js_remove_wpautop($content, true);
	if ($button_link != "") {
    $html .= '<a href="'.$button_link.'" class="button_dp '.$button_style.' '.$css3.'"><span>'.$button_text.'</span></a> ';
	}
	$html .= '</div></div>';
	return $html;
}
function numberbox($atts, $content = null) {
	extract(shortcode_atts(array(
	"type" => "centered",
	"style" => "round",
	"number"=>"",
	"number_color" => '',
	"title" => "Title",
	"button_text" => "Read more",
	"button_link" => "",
	"button_style" => "line-dark",
	"dp_animation" => "",
	"cssclass"=>""
	), $atts));
	$el_id =uniqid("el_");
	$css1 = "";
	$css2 = "";
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	if ($type == "centered") {
		$css1= "number-center";
		$css2 = "small";
	}
	if ($type == "left") {
		$css1 = "number-left";
		$css2 = "small";
	}
	if ($type == "right") {
		$css1 = "number-right";
		$css2 = "small";
	}
    $html = "";   
	$html .= '<div id="'.$el_id.'" class="number-box '.$css1.' '.$style.'" '.$dp_animation.'>';
	$custom_el_css = '';
	if ($number_color !=''){
	$custom_el_css = '<style scoped>';
	$custom_el_css  .= '#'.$el_id.' .number-container  {color:'.$number_color.'; -webkit-box-shadow:0 0 0 1px '.$number_color.'; -moz-box-shadow:0 0 0 1px '.$number_color.'; box-shadow:0 0 0 1px '.$number_color.';} ';
	$custom_el_css  .= '#'.$el_id.' .number-container span  {color:'.$number_color.';} ';
	$custom_el_css  .= '#'.$el_id.':hover .number-container  {background-color:'.$number_color.';} ';
	$custom_el_css  .= '#'.$el_id.':hover .number-container span {color:#fff;} ';
	$custom_el_css .= "</style>";
	}
	$html .= $custom_el_css;
    $html .= '<div class="desc">';
    $html .= '<div class="number-container"><span>'.$number.'</span></div>';
	$html .= '<h3>'.$title.'</h3>';
    $html .= wpb_js_remove_wpautop($content, true);
	if ($button_link != "") {
    $html .= '<a href="'.$button_link.'" class="button_dp '.$button_style.' '.$css2.'"><span>'.$button_text.'</span></a> ';
	}
	$html .= '</div></div>';
	return $html;
}

function dp_flipbox($atts, $content = null) {
	extract(shortcode_atts(array(
	"icon_type" => "selector",
	"icon" => "",
	"icon_size" => "",
	"icon_color" => "",
	"icon_style" => "",
	"icon_badge_color" => "",
	"icon_img" => "",
	"img_width" => "",
	"front_title" => "",
	"front_content" => "",
	"front_txt_color" => "",
	"front_bg_color" => "",
	"back_title" => "",
	"back_txt_color" => "",
	"back_bg_color" => "",
	"link" => "",
	"button_text" => "Read more",
	"button_style" => "",
	"button_size" => "small",
	"link_target" => "",
	"flip_type" => "",
	"height_type" => "",
	"box_height" => "",
	"el_class"=>""
	), $atts));
	$el_id =uniqid("el_");
		if (is_numeric($icon_img)) {
            $image_src = wp_get_attachment_url($icon_img);
        } else {
            $image_src = $icon_img;
        }
	$front_style = 'style="';
	if ($front_bg_color !="") $front_style .= 'background-color:'.$front_bg_color.';';
	if (($height_type == 'custom') && ($box_height != '')) $front_style .= 'height:'.$box_height.'px;';
	$front_style .= '"';
	$iconstyle= 'style="';
	if ($icon_size != '') $iconstyle .= 'font-size:'.$icon_size.'px; height:'.$icon_size.'px;width:'.$icon_size.'px;';
	if ($icon_color != '') $iconstyle .= 'color:'.$icon_color.';';
	$iconstyle .= '"';
	$badgestyle= 'style="';
	if ($icon_style == 'circle' || $icon_style == 'square') $badgestyle .= 'background-color:'.$icon_badge_color.';height:'.$icon_size.'px;width:'.$icon_size.'px;';
	if ($icon_style == 'circle') $badgestyle .= 'border-radius:50%;';
	$badgestyle .= '"';
	$front_text_style ='style="';
	if ($front_txt_color != '') $front_text_style .='color:'.$front_txt_color.'';
	$front_text_style .='"';
	$back_style = 'style="';
	if ($back_bg_color !="") $back_style .= 'background-color:'.$back_bg_color.';';
	$back_style .= '"';
	$back_text_style ='style="';
	if ($back_txt_color != '') $back_text_style .='color:'.$back_txt_color.';';
	$back_text_style .='"';
	if ($link != '') {
	$button_shortcode = '<a href="'.esc_url($link).'" class="button_dp '.$button_size.' '.$button_style.'" target="'.$link_target.'"><span>'.$button_text.'</span></a>';
	}
	$html = '<div id="'.$el_id.'" class="esense-flipbox '.$flip_type.'">';
	$html .='<div class="flipper">';
	$html .='<div id="'.$el_id.'-front" class="esense-flipbox-front" '.$front_style.'>';
	$html .='<div class="icon-holder">';
	if ($icon_type == 'selector') {
	$html .='<div class="icon-badge" '.$badgestyle.'>';
	$html .='<i class="'.$icon.'" '.$iconstyle.'></i>';	
	$html .='</div>';
	} else {
	$html .='<img src="'.$image_src.'" width="'.$img_width.'">';
	}
	$html .='</div>';
	$html .='<h3 '.$front_text_style.'>'.$front_title.'</h3>';
	$html .='<div class="front-content" '.$front_text_style.'>'.$front_content.'</div>';
	$html .='</div>';
	$html .='<div id="'.$el_id.'-back" class="esense-flipbox-back" '.$back_style.'>';
	$html .='<h3 '.$back_text_style.'>'.$back_title.'</h3>';
	$html .='<div class="back-content" '.$back_text_style.'>'.wpb_js_remove_wpautop($content, true).'</div>';
	if ($link != '') {
	$html .= '<p class="button-holder">'.$button_shortcode.'</p>';
	}
	$html .='</div>';
	$html .='</div>';
	$html .='</div><div style="clear:both"></div>';
	return $html;
}




function processbox($atts, $content = null) {
	extract(shortcode_atts(array(
	"title" => "Title",
	"style" => "round",
	"symbol_type" => "",
	"number"=>"",
	"icon" => "",
	"symbol_color" => '',
	"symbol_hcolor" => '',
	"line_color" => '',
	"symbol_size" => "medium",
	"finish" => '',
	"button_size" => "small",
	"button_text" => "Read more",
	"button_style" => "",
	"button_link" => "",
	"dp_animation" => "",
	"cssclass"=>""
	), $atts));
	global $esense_tpl;
	$el_id =uniqid("el_");	
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	$linestyle = $scopedcss = '';
	$class1 = '';
	if ($line_color != '') {
			$linestyle .= 'style="border-color:'.$line_color.'"';
	}
	if ($finish == 'yes') {
			$class1 .= 'finish';
	}
	$scopedcss = '<style scoped>';
	if ($symbol_color != '') {
	$scopedcss .= '
	#'.$el_id.'.process-box .front {
	background-color: '.$symbol_color.';
	}
	#'.$el_id.'.process-box .symbol-container {
	-webkit-box-shadow:0 0 0 1px '.$symbol_color.';
	-moz-box-shadow:0 0 0 1px '.$symbol_color.';
	box-shadow:0 0 0 1px '.$symbol_color.';
	}';
	}
	$hoverstatecolor = get_option($esense_tpl->name . '_maincontent_accent_color','#998675');
	$hoverstatecolor_04 = esense_hexToRGBa(get_option($esense_tpl->name . '_maincontent_accent_color','#998675'),0.4);
	if ($symbol_hcolor != '')  {
	$hoverstatecolor = $symbol_hcolor;
	$hoverstatecolor_04 = esense_hexToRGBa($symbol_hcolor,0.4);
	}
	$scopedcss .= '#'.$el_id.'.process-box:hover .front {
	background-color: '.$hoverstatecolor.';
	-webkit-box-shadow:0 0 11px 9px '.$hoverstatecolor_04.';
	-moz-box-shadow:0 0 11px 9px '.$hoverstatecolor_04.';
	box-shadow:0 0 11px 9px '.$hoverstatecolor_04.';
	}
	#'.$el_id.'.process-box:hover .symbol-container {
	-webkit-box-shadow:0 0 0 1px '.$hoverstatecolor.';
	-moz-box-shadow:0 0 0 1px '.$hoverstatecolor.';
	box-shadow:0 0 0 1px '.$hoverstatecolor.';
	}';
	$scopedcss .= '</style>';
    $html = "";
	$html .= $scopedcss;   
	$html .= '<div id="'.$el_id.'" class="process-box '.$symbol_size.' '.$style.' '.$class1.'" '.$dp_animation.'>';
	
    $html .= '<div class="symbol-container">';
	if ($symbol_type == 'number') {
    $html .= '<div class="front"><span >'.$number.'</span></div>';
	} else {
    $html .= '<div class="front"><span><i class="'.$icon.'" ></i></span></div>';
	}
    $html .= '</div>';
	$html .= '<div class="progress-line" '.$linestyle.'></div>';
	$html .= '<h3>'.$title.'</h3>';
	$html .= '<div class="desc">';
    $html .= wpb_js_remove_wpautop($content, true);
	if ($button_link != "") {
    $html .= '<a href="'.$button_link.'" class="button_dp '.$button_style.' '.$button_size.'"><span>'.$button_text.'</span></a> ';
	}
	$html .= '</div></div>';
	return $html;
}
function dp_textbox($atts, $content = null) {
	extract(shortcode_atts(array(
	"title" => "",
	"icon" => "",
	"bgcolor" => "",
	"txtcolor" => "",
	"border_color" => "",
	"border_width" => "",
	"border_style" => "",
	"border_radius" => "",
	"header_bgcolor" => "",
	"header_txtcolor" => "",
	"icon_color" => "",
	"el_class"=>""
	), $atts));
	$boxstyle = $iconstyle = $headerstyle = $headerstyle1 = '';
	if ( $bgcolor != "" || $txtcolor != "" || $border_color != "" || $border_width != "" || $border_style != "" || $border_radius != "") {
		$boxstyle = 'style = "';
		if ( $bgcolor != "") $boxstyle .= 'background-color:'.$bgcolor.';';
		if ( $txtcolor != "") $boxstyle .= 'color:'.$txtcolor.';';
		if ( $border_color != "") $boxstyle .= 'border-color:'.$border_color.';';
		if ( $border_width != "") $boxstyle .= 'border-width:'.$border_width.'px;';
		if ( $border_style != "") $boxstyle .= 'border-style:'.$border_style.';';
		if ( $border_radius != "") $boxstyle .= 'border-radius:'.$border_radius.'px;';
		$boxstyle .= '"';
	}
	if ($icon_color != "") $iconstyle = 'style = "color:'.$icon_color.'"';
	if ($header_txtcolor != "") {
	$headerstyle = 'style = "color:'.$header_txtcolor.'"';
	}
	if ($header_bgcolor != "" || $border_radius != "") {
	$headerstyle1 = 'style = "';
	if ($header_bgcolor != "" ) $headerstyle1 .= 'background-color:'.$header_bgcolor.';';
	if ($border_radius != "" ) {
		$hborder_radius = $border_radius - $border_width;
		if ($hborder_radius > 0) $headerstyle1 .= 'border-radius:'.$hborder_radius.'px '.$hborder_radius.'px 0 0';
	
	}
	$headerstyle1 .= '"';
	}
    $html = "";   
	$html .= '<div class="esense-text-box '.$el_class.'" '.$boxstyle.'>';
	if ($title != "" || $icon != "") {
	$html .= '<div class="box-header" '.$headerstyle1.'>';
	if ($icon != "") $html .= '<i class="'.$icon.'" '.$iconstyle.'></i>';
	if ($title != "") $html .= '<h4 '.$headerstyle.'>'.$title.'</h4>';
	$html .= '</div>';
	}
    $html .= '<div class="content">'.wpb_js_remove_wpautop($content, true).'</div>';
	$html .= '</div>';
	return $html;
}

function dp_portfolio_grid($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'items' => '4',
		'columns' => '4',
		'categories' => '',
		'filter' => '',
		'thumbsize' => 'horizontal',
		'showlightbox' => 'yes',
		'showlink' => 'yes',
		'showtitle' => 'yes',
		'showcategories' => 'no',
		'showdescription' => 'no'
		), $atts));
		
		 
	$return_html = esense_print_recent_projects_grid($items, $columns,$categories,$filter,$thumbsize,$showlightbox,$showlink,$showtitle,$showcategories,$showdescription);
	
	return $return_html;	}

function dp_portfolio_carousel($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_items' => '4',
		'items' => '4',
		'categories' => '',
		'itemsdesktop' => '',
		'itemsdesktopsmall' => '',
		'itemstablet' => '',
		'itemsmobile' => '',
		'autoplay' => '',
		
		), $atts));
	global $post;
	$thumb_size = "esense_portfolio-square";
	switch ($items) {
		case "1":
			$thumb_size = "esense_portfolio-square";
			break;
		case "2":
			$thumb_size = "esense_portfolio-square";
			break;
		case "3":
			$thumb_size = "esense_portfolio-square";
			break;
	}
	
	$selected_categories = array();
	if ($categories != '') {$selected_categories = explode(',', $categories);
		} else {
		$portfolio_category = get_terms('portfolios');
			if($portfolio_category):
			foreach($portfolio_category as $portfolio_cat):
			array_push($selected_categories,$portfolio_cat->slug);
			endforeach;
			endif;
		}
	$args = array(
				'post_type' => 'portfolio',
				'orderby' => 'menu_order date',
				'showposts' => $show_items,
				'order' => 'ASC',
				'tax_query' => array(
        array(
            'taxonomy' => 'portfolios',
            'field' => 'slug',
            'terms' => $selected_categories
        )
    )
				);
		$items = 'items : '.$items.',';
		if ($itemsdesktop !='')  $itemsdesktop = 'itemsdesktop : [1199,'.$itemsdesktop.'],';
		 else $itemsdesktop = 'itemsDesktop : false,';
		if ($itemsdesktopsmall !='')  $itemsdesktopsmall = 'itemsDesktopSmall : [980,'.$itemsdesktopsmall.'],';
		 else $itemsDesktopSmall = 'itemsDesktopSmall : false,';
		if ($itemstablet !='')  $itemstablet = 'itemsTablet : [768,'.$itemstablet.'],';
		 else $itemstablet = 'itemsTablet : false,';
		if ($itemsmobile !='')  $itemsmobile = 'itemsMobile : [479,'.$itemsmobile.'],';
		 else $itemsmobile = 'itemsMobile : false,';
		if ($autoplay !='') $autoplay = 'autoPlay: '.$autoplay.',';
		 else $autoplay = 'autoplay : false,';
	$id = "carousel".mt_rand();
	$navtext_left = '<i class="icon-angle-left"></i>';
	$navtext_right = '<i class="icon-angle-right"></i>';
	$carouselout = '<div class="port-carousel">';
	$gallery = new WP_Query($args);
	$carouselout .= "<script type='text/javascript'>
						jQuery(document).ready(function() {
 						jQuery('#".$id."').owlCarousel({"
        				.$autoplay.$items.$itemsdesktop.$itemsdesktopsmall.$itemstablet.$itemsmobile.
        				"navigationText : ['".$navtext_left."','".$navtext_right."'],pagination : false,navigation : true,theme : 'owl-portfolio' });});
						</script>";
	$carouselout .= '<div id="'.$id.'" class="owl-carousel">';
	while($gallery->have_posts()): $gallery->the_post();
	if(has_post_thumbnail()){
			$item_cats = get_the_terms($post->ID, 'portfolios');
			$like_count = get_post_meta( $post->ID, "_post_like_count", true );
			if ($like_count == '') $like_count = 0;
			$heart = '<i class="icon-hearth-outline"></i>';
			if ($like_count > 0) $heart = '<i class="icon-heart-filled"></i>';
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_size ); 
			if($item_cats):
			$count = count($item_cats);
			$cats = '';
			foreach($item_cats as $item_cat) {
				$cats .= $item_cat->name;
				if ($count > 1) $cats .= ', ';
				$count = $count -1;
			}
			endif;

	}
	$carouselout .= '<div class="item">';
	$carouselout .= '';
	$carouselout .= '<a href="'.get_permalink($post->ID).'"><div class="port-item-wrap"><figure>';
    $carouselout .= '<div class="text-overlay">'; 
	$carouselout .= '<div class="info">'.$cats;
    $carouselout .= '<h5>'.$heart.' '.$like_count.' Like</h5>';
    $carouselout .= '</div>';
    $carouselout .= '</div>';
    $carouselout .= '<img src="'.$thumb[0].'" alt="">';
	$carouselout .= '</figure></div></a>';
	$carouselout .= '</div>';
	endwhile;
	wp_reset_postdata();
	$carouselout .= '</div>';
	$carouselout .= '</div>';
		return $carouselout;
}

	
function dp_posts_grid($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'items_count' => '4',
		'columns' => '4',
		'categories' => '',
		'filter' => ''
		), $atts));
		
		 
	$return_html = esense_print_recent_post_grid($items_count,$columns,$categories,$filter);
	
	return $return_html;	}


function dp_blog_carousel($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_items' => '4',
		'items' => '4',
		'categories' => '',
		'itemsdesktop' => '',
		'itemsdesktopsmall' => '',
		'itemstablet' => '',
		'itemsmobile' => '',
		'autoplay' => '',
		'charlimit' => '100'
		
		), $atts));
	global $post,$esense_tpl;
	$selected_categories = array();
	if ($categories != '') {$selected_categories = explode(',', $categories);
		} else {
		$blog_category = get_terms('category');
			if($blog_category):
			foreach($blog_category as $blog_cat):
			array_push($selected_categories,$blog_cat->slug);
			endforeach;
			$selected_categories = implode (',',$selected_categories);
			endif;
		}
	if ($categories == '') { 
	$args = array(
				'orderby' => 'menu_order date',
				'showposts' => $show_items,
				'order' => 'ASC'
	);
	} else {
	$args = array(
				'orderby' => 'menu_order date',
				'showposts' => $show_items,
				'order' => 'ASC',
				'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $selected_categories
        )
    )
				);
	}
		$items = 'items : '.$items.',';
		if ($itemsdesktop !='')  $itemsdesktop = 'itemsdesktop : [1199,'.$itemsdesktop.'],';
		 else $itemsdesktop = 'itemsDesktop : false,';
		if ($itemsdesktopsmall !='')  $itemsdesktopsmall = 'itemsDesktopSmall : [980,'.$itemsdesktopsmall.'],';
		 else $itemsDesktopSmall = 'itemsDesktopSmall : false,';
		if ($itemstablet !='')  $itemstablet = 'itemsTablet : [768,'.$itemstablet.'],';
		 else $itemstablet = 'itemsTablet : false,';
		if ($itemsmobile !='')  $itemsmobile = 'itemsMobile : [479,'.$itemsmobile.'],';
		 else $itemsmobile = 'itemsMobile : false,';
		if ($autoplay !='') $autoplay = 'autoPlay: '.$autoplay.',';
		 else $autoplay = 'autoplay : false,';
	$id = "carousel".mt_rand();
	$navtext_left = '';
	$navtext_right = '';
	$carouselout = '<div class="blog-carousel">';
	$gallery = new WP_Query($args);
	$carouselout .= "<script type='text/javascript'>
						jQuery(document).ready(function() {
 						jQuery('#".$id."').owlCarousel({"
        				.$autoplay.$items.$itemsdesktop.$itemsdesktopsmall.$itemstablet.$itemsmobile.
        				"navigationText : ['".$navtext_left."','".$navtext_right."'],pagination : true,navigation : false });});
						</script>";
	
	$carouselout .= '<div id="'.$id.'" class="owl-carousel">';
	while($gallery->have_posts()): $gallery->the_post();
	$thumb = '';
	$author = get_the_author_meta('user_nicename');
	$num_comments = get_comments_number();
	if ( $num_comments == 0 ) {
			$comments = __('No Comments','esense-functions');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments','esense-functions');
		} else {
			$comments = __('1 Comment','esense-functions');
		}
	$title = '';
	$content = esense_PostContent();
	$content = strip_tags($content); 
	$content = substr($content, 0, $charlimit).' [...]';
	if (get_post_format() == 'gallery') $content = '';
	if (get_post_format() == 'audio') $content = esense_PostContent();
	if(has_post_thumbnail()){
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'single-post-thumbnail' ); 
	}
	$carouselout .= '<div class="item">';
	$carouselout .= '<div class="blog-item-wrap">';
	if(get_post_meta(get_the_ID(), "_esense-featured-video", true) != '') : 
	$carouselout .= '<p>'.wp_oembed_get( get_post_meta(get_the_ID(), "_esense-featured-video", true) ).'</p>';
	elseif (get_post_format() == 'gallery'):
$inpostgallery = get_post_gallery( $post->ID, false );
		  $images = explode(",", $inpostgallery['ids']);
		  if($inpostgallery): 
			esense_add_flex();
		    $carouselout .= '<div class="clearboth"></div>';
			$carouselout .= '<div id="gallery" class="flexgallery">';
					$inpostgallery_id = "flexslider_".mt_rand();
					$output = '<script type="text/javascript">'."\n";
					$output .= "   jQuery(document).ready(function() {"."\n"; 
					$output .=  "jQuery('#".$inpostgallery_id."').flexslider({"."\n";
					$output .=  '    animation: "slide",'."\n";
					$output .=  '    slideshowSpeed:"5000",'."\n";
					$output .=  '    controlNav: false,'."\n";
					$output .=  '    pauseOnHover: true,'."\n";
					$output .=  '    smoothHeight: true'."\n";
					$output .=  "  });"."\n";      
					$output .= "   });"."\n";
					$output .= "</script>"."\n";
					$carouselout .= $output; 

            $carouselout .= '<div class="flexslider" id="'.$inpostgallery_id.'"><ul class="slides">';
					foreach($images as $image) :
					$src = wp_get_attachment_image_src( $image, 'full' );
				$carouselout .='<li><figure class="noscale">';
				$carouselout .='<img src="'.$src[0].'" />';
				$carouselout .='</figure></li>';
					endforeach;
			$carouselout .='</ul></div>';
			$carouselout .='</div>';
		  	endif;
			else :
	if ($thumb != '') {
    $carouselout .= '<figure><a href="'.get_permalink($post->ID).'"><div class="text-overlay">'; 
	$carouselout .= '<div class="info">';
	$carouselout .= '<span class="button_dp small line-white"><span> READ MORE</span></span>';
    $carouselout .= '</div>';
    $carouselout .= '</div>';
	
    $carouselout .= '<img src="'.$thumb[0].'" alt="">';
	$carouselout .= '</a></figure><div class="space20"></div>';
	}
	endif;
   	$carouselout .= '<h2><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h2>';
	$carouselout .= '<div class="meta">';
	if(get_post_format() != '') : 
	$carouselout .= '<span class="format esense-format-'.get_post_format().'"></span>';
	endif; 	
    if(get_option($esense_tpl->name . '_postmeta_date_state') == 'Y') :
    if(!(is_tag() || is_search())) { 
    $carouselout .= '<span class= "date">'.mysql2date('F j , Y',get_post()->post_date).'</span>';
    } 
    endif;
	if(!(is_tag() || is_search())) : 
	if(get_option($esense_tpl->name . '_postmeta_author_state') == 'Y') : 
	$carouselout .= '<span class="author-link"><a href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'">'.esc_attr(sprintf(__('%s', 'esense-functions'), get_the_author())).'</a></span>';
    endif;
	endif;
	if ( comments_open() && ! post_password_required() ) : 
	if(get_option($esense_tpl->name . '_postmeta_coments_state') == 'Y') : 
	$carouselout .= '<span class="comments">';
    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments','esense-functions');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments','esense-functions');
		} else {
			$comments = __('1 Comment','esense-functions');
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __('Comments are off for this post.','esense-functions');
	}
	$carouselout .= $write_comments;

    $carouselout .='</span>';
    endif;
	endif;
	$carouselout .= '</div>'; 
	$carouselout .= '<p>'.$content.'</p>';
	$carouselout .= '</div>';
	$carouselout .= '</div>';
	endwhile;
	wp_reset_postdata();
	$carouselout .= '</div>';
	$carouselout .= '</div>';
		return $carouselout;
		
	}

function dp_teaser($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => '',
		'img' => '',
		'bigimg' => '',
		'overlay_icons' => '',
		'link' => '',
		'usebutton' => '',
		'button_text' => 'Read more',
		'button_style' => '',
		'el_class' => '',
		'dp_animation' => ""
		), $atts));
		if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
		if (is_numeric($img)) {
            $image_src = wp_get_attachment_url($img);
        } else {
            $image_src = $img;
        }
		if (is_numeric($bigimg)) {
            $bigimage_src = wp_get_attachment_url($bigimg);
        } else {
            $bigimage_src = $bigimg;
        }
		$addclass = '';
		if ($overlay_icons == 'no') $addclass ='no-overlay';
		$output = '<div class="esense-teaser '.$el_class.$addclass.'" '.$dp_animation.'>';
		if ($img !="") {
		if ($bigimg !="") {
		$output .= '<figure>';
        $output .= '<div class="text-overlay"><div class="info">';
        $output .= '<span>';
		if (($overlay_icons == 'zoom' || $overlay_icons == 'both') && $bigimage_src != '' ) {
		$output .= '<a href="'.$bigimage_src.'" data-rel="esense_lightbox"><i class="icon-search"></i></a>';
		}
		if (($overlay_icons == 'link' || $overlay_icons == 'both') && $link != '' ) {
		$output .= '<a href="'.$link.'"><i class="icon-link"></i></a>';
		}
		$output .= '</span>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<img src="'.$image_src.'"></figure>';
		} else {
		$output .= '<img src="'.$image_src.'">';
		}
		}
        $output .= '<div class="teaser-content">';
        $output .= '<h4 class="post-title upper">'.$title.'</h4>';
		$output .= wpb_js_remove_wpautop($content, true);
		if ($link != "" && 	strtolower($usebutton) == 'true') { 
		$output .= '<a href="'.$link.'" class="button_dp small '.$button_style.'"><span>'.$button_text.'</span></a>';
		}
        $output .= '</div>';
		$output .= '</div>';
		
		return $output;
		
	}



function dp_post_teaser($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'post_id' => '',
		'type' => 'left'	
		), $atts));
		$post = get_post($post_id);
		if  ($post) {
		$title = $post->post_title;
		if (has_post_thumbnail($post->ID ) ){
		$cats = '';
		$item_cats = get_the_terms($post->ID, 'category');
		if($item_cats):
			$count = count($item_cats);
			
			foreach($item_cats as $item_cat) {
				$category_link = get_category_link( $item_cat->term_id );
				$cats .= '<a href="'.esc_url( $category_link ).'">';
				$cats .= $item_cat->name;
				$cats .= '</a>';
				if ($count > 1) $cats .= ', ';
				$count = $count -1;
			}
		endif;
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
        $image = '<img src="'.$image[0].'" alt="">'; 
		} else {
		$image = 'Post with ID '.$post_id.' have no fetured image';
		}
		$author = $post->post_author;
		$author = get_userdata($author)->display_name;
		$num_comments = $post->comment_count;
		if ( $num_comments == 0 ) {
				$comments = __('No Comments','esense-functions');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments','esense-functions');
			} else {
				$comments = __('1 Comment','esense-functions');
		}
		$output = '<div class="post-teaser '.$type.'">';
		$output .= '<div class="img-block">';
		$output .= '<figure>';
		$output .= '<div class="text-overlay">';
		$output .= '<div class="info">';
		$output .= '<span class="button_dp small white"><span> READ MORE</span></span>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= $image;
		$output .= '</figure>';
		$output .= '</div>';
		$output .= '<div class="text-block">';
		$output .= '<h1><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h1>';
		$output .= '<div class="meta">';
		$output .= '<span>'.mysql2date('j F Y',$post->post_date).'</span>';
		$output .= '<span><a href="'.get_author_posts_url( get_the_author_meta( $post->ID ) ).'">'.$author.'</a></span>';
		$output .= '<span>'.$cats.'</span>';
		 
		$output .= '<span><a href="'.get_comments_link($post->ID).'">'.$comments.'</a></span>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div><div class="clearboth"></div>';
		} else {
		$output = 'Post with ID '.$post_id.' does not exist';
		}
		
		return $output;
		
	}



function dp_owl_carousel($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'slideshow' => '',
		'items' => '4',
		'itemsdesktop' => '',
		'itemsdesktopsmall' => '',
		'itemstablet' => '',
		'itemsmobile' => '',
		'autoplay' => '',
		'pagination' => '',
		'navigation' => '',
		'item_margin' => ''
		), $atts));
		$marginstyle = '';
		if ($item_margin !='') $marginstyle =' style="margin: 0 '.$item_margin.'px"';
		$query_string = 'post_type=slide&order=ASC&orderby=menu_order&nopaging=true';
	
	if($slideshow != 'All'){
		
		$query_string .= "&slideshows=$slideshow";
		
	}
		$slideshow_query = new WP_Query($query_string);
		$items = 'items : '.$items.',';
		if ($itemsdesktop !='')  $itemsdesktop = 'itemsDesktop : [1199,'.$itemsdesktop.'],';
		 else $itemsdesktop = 'itemsDesktop : false,';
		if ($itemsdesktopsmall !='')  $itemsdesktopsmall = 'itemsDesktopSmall : [980,'.$itemsdesktopsmall.'],';
		 else $itemsdesktopsmall = 'itemsDesktopSmall : false,';
		if ($itemstablet !='')  $itemstablet = 'itemsTablet : [768,'.$itemstablet.'],';
		 else $itemstablet = 'itemsTablet : false,';
		if ($itemsmobile !='')  $itemsmobile = 'itemsMobile : [479,'.$itemsmobile.'],';
		 else $itemsmobile = 'itemsMobile : false,';
		if ($autoplay !='') $autoplay = 'autoPlay: '.$autoplay.',';
		 else $autoplay = 'autoplay : false,';
		if ($navigation =='yes') $navigation = 'navigation : true,';
		 else $navigation = 'navigation : false,';
		if ($pagination =='yes') $pagination = 'pagiantion: true,';
		 else $pagination = 'pagination : false,';
		
		$id = "carousel".mt_rand();
		$carouselout = '<script type="text/javascript">
						jQuery(document).ready(function() {
 						jQuery("#'.$id.'").owlCarousel({'
        				.$autoplay.$items.$itemsdesktop.$itemsdesktopsmall.$itemstablet.$itemsmobile.$navigation.$pagination.
        				'navigationText : ["",""] });});
						</script>';
		$carouselout .= '<div id="'.$id.'" class="owl-carousel">';
		
if($slideshow_query->have_posts()) {
		
			while ($slideshow_query->have_posts()) {
				$carouselout .= '<div class="item"'.$marginstyle.'>';
            	$slideshow_query->the_post();
        		
        		global $post;
        		$slide_type = get_post_meta($post->ID, 'slide_type', true);       			
        		

                if($slide_type == 'i') {

                    if ( has_post_thumbnail() ) {
 					$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					if( get_post_meta($post->ID, 'slide_link', true) ){$carouselout .= '<a href="'.get_post_meta($post->ID, 'slide_link', true).'" title="">'."\n";} 
                    $carouselout .='<img src="'.$imageurl.'" title="" alt="" />'."\n";
					if( get_post_meta($post->ID, 'slide_link', true) ){$carouselout .= '</a>'."\n";}
                    }
                } // end image slide_type
        		else  {
				$carouselout .=	 apply_filters( 'the_content', get_the_content() );
				}
		$carouselout .= '</div>'."\n";    
		
			} //End while
		$carouselout .= '</div><div class="clearboth"></div>'."\n";    
		} else {
		
			$carouselout .= '<p class="warning">'."\n";
			$carouselout .= __("You don't have any Slides to display.", 'esense-functions');
			$carouselout .= '</p>'."\n";
			
		}
		wp_reset_postdata();
	 return $carouselout;
	}
	
function dp_timeline( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'type' => '',
		'line_color' => '',
		"el_class"=>""
		), $atts));
	//[time_container]
	$linecolor = '';
	if ($line_color != '') $line_color = 'style ="border-color:'.$line_color.'"';
	$dp_timeline ='<div class="timeline '.$el_class.'">';
	$dp_timeline .='<div class="central_line '.$type.'" '.$line_color.'></div>';
	$dp_timeline .= do_shortcode($content);
	$dp_timeline.='</div><div class="clearboth"></div>';
	return $dp_timeline;
}

function dp_timeline_item( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'node_color' => '',
		'date_color' =>'',
		'position' => 'right',
		'date_text_color' => '',
		'title' => '',
		'date' => '',
		'dp_animation' => "",
		"el_class"=>""
		), $atts));
	//[time_line_item]
	$date_style = '';
	if ($dp_animation != "") $dp_animation = ' data-animated ="'.$dp_animation.'"';
	if ($node_color !='') $node_color = 'style = "border-color:'.$node_color.'"';
	if (($date_color !='') || ($date_text_color != '')) {
	$date_style = 'style="';
	if ($date_color !='') $date_style .='background-color:'.$date_color.';';
	if ($date_color !='') $date_style .='color:'.$date_text_color.';';
	$date_style .= '"';
	}
	$dp_timeline_item ='<div class="timeline_item '.$position.' '.$el_class.'"><div class="inner">';
	$dp_timeline_item .='<div class="timeline_node" '.$node_color.'></div>';
	$dp_timeline_item .='<div class="item_date_container"><div class="item_date" '.$date_style.'>'.$date.'</div></div>';
	$dp_timeline_item .='<div class="item_content" '.$dp_animation.'><div class="item_content_inner">';
	if ($title != '') $dp_timeline_item .='<h4 class="item_title">'.$title.'</h4>';
	$dp_timeline_item .=wpb_js_remove_wpautop($content, true).'</div></div>';
	$dp_timeline_item .='</div><div class="clearboth"></div></div>';
	return $dp_timeline_item;
}			

function dp_timeline_sep( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'sep_color' => '',
		'sep_text_color' => '',
		'sep_text' => '',
		"el_class"=>""
		), $atts));
	//[time_line_item]
	$sep_style = '';
	if (($sep_color !='') || ($sep_text_color != '')) {
	$sep_style = 'style="';
	if ($sep_color !='') $sep_style .='background-color:'.$sep_color.';';
	if ($sep_color !='') $sep_style .='color:'.$sep_text_color.';';
	$sep_style .= '"';
	}
	$dp_timeline_sep = '<div class="timeline_sep '.$el_class.'"><div class="timeline_sep_inner"><span '.$sep_style.'>'.$sep_text.'</span></div></div>';
	return $dp_timeline_sep;
}			

function dp_anchor( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name' => ''
		), $atts));
	$output ='<div class="esense-anchor" id="'.$name.'"></div>';
	return $output;
}
// Countdown
function dp_countdown($atts) {
			wp_enqueue_script('jquery-countdown', get_template_directory_uri().'/js/jquery.countdown.min.js', array('jquery'),false);
			$style = $datetime = $digit_col = $digit_size = $digit_style = $unit_col = $unit_size = $unit_style = $el_class = '';
			extract(shortcode_atts( array(
				'style'=>'updown',
				'datetime'=>'',
				'countdown_opts'=>'',
				'digit_col'=>'',
				'digit_size'=>'60',
				'digit_style'=>'',
				'unit_col'=>'',
				'unit_size'=>'15',
				'unit_style'=>'',
				'el_class'=>''
			),$atts));
			$el_id =uniqid("el_");	
			$output = '';
			if($datetime!=''){
				$style1 = ' style="font-size:'.$digit_size.'px;';
				$style1 .= 'color:'.$digit_col.';';
				if ($digit_style == 'bold') $style1 .= 'font-weight:bold;';
				if ($digit_style == 'italic') $style1 .= 'font-style:italic;';
				if ($digit_style == 'bolditalic') $style1 .= 'font-weight:bold;font-style:italic;';
				$style1 .= '"';
				$style2 = ' style="font-size:'.$unit_size.'px;';
				$style2 .= 'color:'.$unit_col.';';
				if ($unit_style == 'bold') $style2 .= 'font-weight:bold;';
				if ($unit_style == 'italic') $style2 .= 'font-style:italic;';
				if ($unit_style == 'bolditalic') $style2 .= 'font-weight:bold;font-style:italic;';
				$style2 .= '"';
				$params = '<div class="count-container"><div class="digit"'.$style1.'>%D</div><div class="units"'.$style2.'>'.__('Days','blend').'</div></div>';
				$params .= '<div class="count-container"><div class="digit"'.$style1.'>%H</div><div class="units"'.$style2.'>'.__('Hours','esense-functions').'</div></div>';
				$params .= '<div class="count-container"><div class="digit"'.$style1.'>%M</div><div class="units"'.$style2.'>'.__('Minutes','esense-functions').'</div></div>';
				$params .= '<div class="count-container"><div class="digit"'.$style1.'>%S</div><div class="units"'.$style2.'>'.__('Seconds','esense-functions').'</div></div>'; 
				$output .= '<div id="'.$el_id.'" class="esense-countdown '.$style.' '.$el_class.'"></div>';
				$output .= '<div class="clearboth"></div>';
				$output .= "<script type='text/javascript'>
				jQuery(document).ready(function(){
				jQuery('#".$el_id."').countdown('".$datetime."', function(event) {
				jQuery(this).html(event.strftime('".$params ."')); });
				})
				</script>";
			}			
			return $output;		
		}
		

/* DP Modal Box */

function dp_modal($atts,$content = null) {
				extract(shortcode_atts( array(
				'trigger' => '<a href="#">Modal Box Link</a>',
				'usetitle' => '',
				'title' => '',
				'width' => '640',
				'textcolor' => '#555',
				'bgcolor' => '#f7f7f7',
				'overlay_bgcolor' => '',
				'title_textcolor' => '#fff',
				'title_bgcolor' => 'rgba(0,0,0,.45)',
				'animation' => '',
				'el_class'=>''
			),$atts));
			$el_id =uniqid();
			$addclass = '';
			$trigger =  rawurldecode(base64_decode(strip_tags($trigger)));
			if(strtolower($usetitle) == 'true') {
			$addclass = ' modhavetitle';
			}
			$output ='<div class="esense-md-trigger" data-id="'.$el_id.'">'.do_shortcode($trigger).'</div>';
			$modalcontent = "<div class='esense-modal ".$animation.$addclass."' id='modal-".$el_id."' style='width:".$width."px'>";
			$modalcontent .="<div class='esense-md-content' style='color:".$textcolor."; background-color:".$bgcolor."'>";
			if(strtolower($usetitle) == 'true'){
				$modalcontent .="<h3 style='color:".$title_textcolor."; background-color:".$title_bgcolor."'>".$title."</h3>";
			}
			$modalcontent .="<div>";
			
			$modalcontent .=rawurldecode(base64_decode(strip_tags($content)));
			$modalcontent .="</div>";
			$modalcontent .="</div>";
			$modalcontent .="<div class='esense-modal-close' data-id='".$el_id."'><i class='icon-close1'></i></div>";
			$modalcontent .="</div>";
			$modalcontent .="<div class='esense-md-overlay' id='overlay-".$el_id."' data-id='".$el_id."' style='background-color:".$overlay_bgcolor."'></div>";
			$js = '<script type="text/javascript">';
			$js .= 'jQuery(document).ready(function(){';
			$js .= 'jQuery("'.$modalcontent.'").prependTo("body")';
			$js .= '})</script>';
			return $js.$output;
}


/* DP Button Group */

function dp_buttongroup( $atts, $content = null ) {
	extract(shortcode_atts(array(
				'size' => '',
				'radius' => '4',
				'align' => '',
				'equal_width' => ''
		), $atts));
	$el_id =uniqid("buttongroup-");
	$addclass = $size;
	if(strtolower($equal_width) == 'true') $addclass .= ' equalized-group';
	$addclass .= ' '.$align;
	$output = '';
	if ($align == 'center') {
	$output .= '<div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner">';
	}
	$output .= '<div id="'.$el_id.'" class="button-group '.$addclass.'" data-radius="'.$radius.'">';
	$output .= do_shortcode(strip_tags($content));
	$output .= '</div>';
	if ($align == 'center') {
	$output .= '</div></div></div>';
	}
	return $output;
}

function dp_buttongroup_item( $atts, $content = null ) {
	extract(shortcode_atts(array(
				'position' => '',
				'text' => 'Button Text',
				'subtext' => '',
				'icon' => 'none',
				'icon_position' => 'left',
				'bgcolor' => '#222',
				'textcolor' => '#fff',
				'bordercolor' => '#222',
				'hbgcolor' => '#222',
				'htextcolor' => '#fff',
				'hbordercolor' => '#222',
				'link' => '#',
				'linktarget' => '_self',
		), $atts));
	$el_id =uniqid("gbutton-");
	$addclass = '';
	switch ($icon_position) {
	   case "left":
		 $adclass =' icononleft';
		 break;
	   case "right":
		 $adclass =' icononright';
		 break;
	   default:
		 $adclass =' noicon';
 	}
	if ($icon == 'none') $adclass = ' noicon';
	$style1 = ' style="background-color:'.$bgcolor.'; border-color:'.$bordercolor.'"';
	$style2 = ' style="color:'.$textcolor.'"';
	$output = '<div class="gbutton-wrap"><div id="'.$el_id.'" class="gbutton'.$adclass.'" '.$style1.' data-bgcolor="'.$bgcolor.'" data-bordercolor="'.$bordercolor.'" data-hbgcolor="'.$hbgcolor.'" data-hbordercolor="'.$hbordercolor.'">';
	$output .= '<a href="'.$link.'" target="'.$linktarget.'" '.$style2.' data-textcolor="'.$textcolor.'" data-htextcolor="'.$htextcolor.'">';
	if ($icon_position == "left" && $icon != "none") $output .= '<div class="bt-icon"><i class="'.$icon.'"></i></div>';
	$output .= '<div class="bt-text">';
	$output .= '<span class="title">'.$text.'</span>';
	$output .= '<br/><span class="subtitle">'.$subtext.'</span>';
	$output .= '</div>';
	if ($icon_position == "right" && $icon != "none") $output .= '<div class="bt-icon"><i class="'.$icon.'"></i></div>';
	$output .= '</a>';
	$output .= '</div></div>';
	return $output;
}			

function dp_buttongroup_dropdown( $atts, $content = null ) {
	extract(shortcode_atts(array(
				'text' => 'Button Text',
				'subtext' => '',
				'bgcolor' => '#222',
				'textcolor' => '#fff',
				'bordercolor' => '#222',
				'hbgcolor' => '#222',
				'htextcolor' => '#fff',
				'hbordercolor' => '#222',
				'menu' => '',
				'source_type' => '',
				"mode" => ''
		), $atts));
	wp_register_script('position-js', get_template_directory_uri().'/js/jquery.position.js', array('jquery'),false);
	wp_enqueue_script('position-js');

	$el_id =uniqid();
	$addclass = $addclass1 = '';
	if ($subtext != "") $adclass = " have-subtitle";
	if ($source_type == "menu") $addclass1 = " is-menu";
	$style1 = ' style="background-color:'.$bgcolor.'; border-color:'.$bordercolor.'; position:relative;"';
	$style2 = ' style="color:'.$textcolor.'"';
	$output = '<div class="gbutton-wrap"><div id="gbutton-'.$el_id.'" class="gbutton dropdown-bt'.$adclass.'" '.$style1.' data-bgcolor="'.$bgcolor.'" data-bordercolor="'.$bordercolor.'" data-hbgcolor="'.$hbgcolor.'" data-hbordercolor="'.$hbordercolor.'" data-mode="'.$mode.'" data-id="'.$el_id.'">';
	$output .= '<div class="bt-text">';
	$output .= '<div class="downindicator"><i class="icon-angle-down"></i></div>';		
	$output .= '<span class="title">'.$text.'</span>';
	$output .= '<br/><span class="subtitle">'.$subtext.'</span>';	
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div id ="drops-'.$el_id.'" class="button-drops'. $addclass1.'" data-parent="#gbutton-'.$el_id.'">';
		if ($source_type == 'menu') {
							if(is_nav_menu ( $menu )) {
							$menu_items = wp_get_nav_menu_items($menu);
							foreach ( (array) $menu_items as $key => $menu_item ) {
							$title = $menu_item->title;
							$url = esc_url($menu_item->url);
							$micon = ! empty( $menu_item->icon )        ? esc_attr( $menu_item->icon        ) : '';
							$output .= '<div class="btn-menu-item" ><i class="'.$micon.'"></i><a href="' . $url . '">' . $title . '</a></div>';
							}
							}
							else {
								$output .= 'No menu assigned!';
							}
		}
	  if ($source_type == 'html') {
	  		$output .= wpb_js_remove_wpautop($content, true);
	  }
	$output .= '</div></div>';

	return $output;
}			

function dp_buttongroup_sep( $atts, $content = null ) {
	extract(shortcode_atts(array(
				's_width' => '',
				'use_badge' => '',
				's_bgcolor1' => 'transparent',
				's_text' => 'or',
				's_bgcolor' => '',
				's_textcolor' => '',
				's_bordercolor' => '',
		), $atts));
			$output = '<div class="gbutton-wrap"><div class="btn-separator-wrap" style="background-color:'.$s_bgcolor1.'; width:'.$s_width.'px">';
			if(strtolower($use_badge) == 'true') {
			$output .= '<div class="btn-separator" style="background-color:'.$s_bgcolor.';color:'.$s_textcolor.';border-color:'.$s_bordercolor.';">';
			$output .= $s_text;
			$output .= '</div>';
			}
			$output .= '</div></div>';
	return $output;
}			
function dp_googlemap1( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'centertype' => 'address',
		'address' => 'San Jose CA 95129',
		'lat' => '37.297403',
		'long' => '-122.000141',
		'height' => '300',
		'zoom' => '14',
		'mapcontrol' => '',
		'maptypecontrol' => '',
		'pancontrol' => '',
		'zoomcontrol' => '',
		'streetviewcontrol' => '',
		'mapstyle' => '',
		'customtheme' => '',
		), $atts));
	$js = $mapoutput =  $options = $styles = "";
    wp_register_script('google-map-api-js', 'http://maps.google.com/maps/api/js?key=AIzaSyBPeYraJ4H0BiuD1IQanQFlY1npx114ZpM', array(), false);
	wp_enqueue_script('google-map-api-js');
	wp_register_script('gmap3-js', get_template_directory_uri().'/js/gmap3.min.js', array('jquery'),false);
	wp_enqueue_script('gmap3-js');
	wp_register_script('richmarker-js', get_template_directory_uri().'/js/richmarker.min.js', array('jquery'),false);
	wp_enqueue_script('richmarker-js');
	$mapid = 'map-'.mt_rand();
	if ($mapstyle !='no' && $mapstyle !='custom') {
	require_once(get_template_directory().'/dynamo_framework/helpers/helpers.gmapstyles.php');	
	$styles = esense_googlemapstyle($mapstyle);
	}
	if ($mapstyle =='custom' && $customtheme !='') $styles = 'styles: '.rawurldecode(base64_decode(strip_tags($customtheme))).','; 
	$js = '<script type="text/javascript">';
	$js .= 'jQuery(document).ready(function(){'.'';
    $js .= 'jQuery("#'.$mapid.'").gmap3(
	 { map:{';
	if ($centertype == "address") {
	$js .= 'address:"'.$address.'",';
	}
	$js .= 'options:{';
	if ($centertype != "address") {
	$js .= 'center:['.$lat.', '.$long.'],';
	}
	$js .= '
     zoom:'.$zoom.',';
	if ($mapcontrol == 'N') { $js .= 'disableDefaultUI: true,';}
	if (strtolower($maptypecontrol) == 'true') { $js .= 'mapTypeControl: false,';}
	if (strtolower($pancontrol) == 'true') { $js .= 'panControl: false,';}
	if (strtolower($zoomcontrol) == 'true') { $js .= 'zoomControl: false,';}
	if (strtolower($streetviewcontrol) == 'true') { $js .= 'streetViewControl: false,';}
	$js .= $styles;
	$js .='}
			}
     		 
	 }
	)';
    $js .= '});';
    $js .= '</script>';
	$mapoutput = $js .'<div id="'.$mapid.'" class = "gmap" style="height:'.$height.'px"></div>';
	$toreplace = '[dp_googlemap_marker';
	$replacement = '[dp_googlemap_marker parentid ="'.$mapid.'"';
	$content = str_replace($toreplace, $replacement, $content);
	$mapoutput .= do_shortcode(strip_tags($content));
	return $mapoutput;
}

function dp_googlemap_marker( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'parentid' => '',
		'locationtype' => 'address',
		'address' => 'San Jose, CA 95129',
		'lat' => '37.297403',
		'long' => '-122.000141',
		'markertype' => 'simple',
		'markercolor' => '#c52b5d',
		'icon' => '',
		'iconcolor' => '#c52b5d',
		'markerimage' => '',
		'infobox' => '',
		'title' =>'',
		'infoboximage' => ''
		), $atts));
	$markerid = 'marker-'.mt_rand();
	if (is_numeric($markerimage)) {
            $markerimage_src = wp_get_attachment_url($markerimage);
        } else {
            $markerimage_src = $markerimage;
        }
	if (is_numeric($infoboximage)) {
            $infoboximage_src = wp_get_attachment_url($infoboximage);
        } else {
            $infoboximage_src = $infoboximage;
        }
	if ($locationtype == 'address')	$location = "address:'".$address."',";
	if ($locationtype == 'coordinates')	$location = "latLng:[".$lat.", ".$long."],";
	$icon = preg_replace('/\s/', '', $icon);
	if ($markertype == 'simple') {
	$marker = '<div id="'.$markerid.'" class="gmapmarker simplemarker"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="35px" height="54.215px" viewBox="288.462 368.883 35 54.215" enable-background="new 288.462 368.883 35 54.215" xml:space="preserve"><g><path class="gmarker" d="M305.966 368.883c-9.668 0-17.504 7.836-17.504 17.488c0 9.7 16.4 35.9 16.4 35.9 c0.637 1 1.7 1 2.3 0c0 0 16.349-26.284 16.349-35.943C323.462 376.7 315.6 368.9 306 368.883z M305.966 396.062c-6.327 0-11.444-5.125-11.444-11.444s5.117-11.452 11.444-11.452s11.443 5.1 11.4 11.4 S312.293 396.1 306 396.062z"/><path class="gmarker" d="M314.965 384.622c0 4.967-4.026 8.994-8.993 8.994c-4.98 0-9.007-4.026-9.007-8.994c0-4.98 4.026-9.007 9.007-9.007 C310.938 375.6 315 379.6 315 384.622z"/></g></svg></div>';}
	if ($markertype == 'icon') {
	$marker = '<div id="'.$markerid.'" class="gmapmarker markerwithicon"><div class="markerbg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="35px" height="46.667px" viewBox="238.5 232.667 35 46.667" enable-background="new 238.5 232.667 35 46.667" xml:space="preserve"><path class="gmarker" d="M256 232.667c-9.665 0-17.5 7.836-17.5 17.5c0 9.7 14.6 29.2 17.5 29.167c2.916 0 17.5-19.503 17.5-29.167 C273.5 240.5 265.7 232.7 256 232.667z M256 261.834c-6.434 0-11.667-5.236-11.667-11.667S249.566 238.5 256 238.5 c6.434 0 11.7 5.2 11.7 11.667S262.434 261.8 256 261.834z"/><path fill="#FFFFFF" d="M267.667 250.167c0 6.431-5.233 11.667-11.667 11.667c-6.434 0-11.667-5.236-11.667-11.667 S249.566 238.5 256 238.5C262.434 238.5 267.7 243.7 267.7 250.167z"/></svg></div><i class="'.$icon.'"></div>';}
	if ($markertype == 'custom') {
	$marker = '<div id="'.$markerid.'" class="gmapmarker"><img src="'.$markerimage_src.'"></div>';}
	$infoboxcontent = '';
	if ($infobox == "Y") {
		$infoboxcontent = '<div class="gmapinfobox">';
		if ($title != '') $infoboxcontent .= '<h4>'.$title.'</h4>';
		$infoboxcontent .= '<p>'.do_shortcode($content).'</p>';
		if ($infoboximage_src != '') $infoboxcontent .= '<img src="'.$infoboximage_src.'">';
		$infoboxcontent .= '</div>';
		$infoboxcontent = "data:'".$infoboxcontent."'";
	}
	$markeroutput = '';
	$markeroutput .= '<script type="text/javascript">';
	$markeroutput .= 'jQuery(document).ready(function(){'.'';
    $markeroutput .= "jQuery('#".$parentid."').gmap3({
		defaults:{ 
            classes:{
              Marker:RichMarker
            }
          },
          marker:{
            values:[
              {".$location.$infoboxcontent."}
            ],
            options:{
              draggable: false,
			  shadow:'',
			  anchor: RichMarkerPosition['BOTTOM'],
			  content:'".$marker."'
            },";
			if ($infobox == "Y") {
            $markeroutput .= "events:{
              click: function(marker, event, context){
                var map = jQuery(this).gmap3('get'),
                  infowindow = jQuery(this).gmap3({get:{name:'infowindow'}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  jQuery(this).gmap3({
                    infowindow:{
                      anchor:marker,
					  options:{content: context.data,pixelOffset: new google.maps.Size(0, -50)
}
                    }
                  });
                }
              }
            }";
			}
          $markeroutput .= "}
		
        });";
    $markeroutput .= '});';
	$markeroutput .= '</script>';
	if ($markertype == 'simple' || $markertype == 'icon') {
	$markeroutput .= '<style scoped>#'.$markerid.' .gmarker {fill:'.$markercolor.';} #'.$markerid.' i {color:'.$iconcolor.';}</style>';	
	}
	return $markeroutput;
	
}

/* DP Vertical DotNav */

function dp_dotnav( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'nav_menu' => '',
	'el_class' => ''
		), $atts));
	$output = '';
	$output .= wp_nav_menu( array('menu' => $nav_menu,'container'       => 'div','container_class' => 'esense_dotnav_container '.$el_class,'walker' =>  new Esense_MenuWalkerDotnav(), 'menu_id'         => 'dotnav-menu', 'menu_class' => 'esense_dotnav','fallback_cb' => false )); 
	
	return $output;
}


 		add_shortcode('one_half', 'dp_column');
		add_shortcode('one_third', 'dp_column');
		add_shortcode('one_fourth','dp_column');
		add_shortcode('one_fifth', 'dp_column');
		add_shortcode('one_sixth', 'dp_column');
		add_shortcode('two_third', 'dp_column');
		add_shortcode('three_fourth', 'dp_column');
		add_shortcode('two_fifth', 'dp_column');
		add_shortcode('three_fifth', 'dp_column');
		add_shortcode('four_fifth', 'dp_column');
		add_shortcode('five_sixth', 'dp_column');
		add_shortcode('one_half_last', 'dp_column');
		add_shortcode('one_third_last', 'dp_column');
		add_shortcode('one_fourth_last','dp_column');
		add_shortcode('one_fifth_last', 'dp_column');
		add_shortcode('one_sixth_last', 'dp_column');
		add_shortcode('two_third_last' ,'dp_column');
		add_shortcode('three_fourth_last', 'dp_column');
		add_shortcode('two_fifth_last', 'dp_column');
		add_shortcode('three_fifth_last','dp_column');
		add_shortcode('four_fifth_last','dp_column');
		add_shortcode('five_sixth_last','dp_column');
		add_shortcode('h1', 'typo_h1');
		add_shortcode('h2', 'typo_h2');
		add_shortcode('h3', 'typo_h3');
		add_shortcode('h4', 'typo_h4');
		add_shortcode('h5', 'typo_h5');
		add_shortcode('h6', 'typo_h6');
		add_shortcode('contentheading', 'typo_contentheading');
		add_shortcode('componentheading', 'typo_componentheading');
    	add_shortcode('div', 'typo_div');
		add_shortcode('div2', 'typo_div2');
    	add_shortcode('div3', 'typo_div3');
		add_shortcode('box', 'typo_alert_box');
		add_shortcode('icon', 'typo_icon');
		add_shortcode('pre', 'typo_pre');
    	add_shortcode('blockquote', 'typo_blockquote');
		add_shortcode('legend1', 'typo_legend1');
		add_shortcode('legend2', 'typo_legend2');
		add_shortcode('legend3', 'typo_legend3');
		add_shortcode('list', 'typo_list');
		add_shortcode('li', 'typo_li');
		add_shortcode('ord_list', 'typo_ord_list');
		add_shortcode('discnumber', 'typo_discnumber');
		add_shortcode('bignumber', 'typo_bignumber');
		add_shortcode('emphasis', 'typo_emphasis');
		add_shortcode('emphasis', 'typo_emphasis');
		add_shortcode('emphasisbold', 'typo_emphasisbold');
		add_shortcode('emphasisbold2', 'typo_emphasisbold2');
		add_shortcode('dropcap', 'typo_dropcap');
		add_shortcode('important', 'typo_important');
		add_shortcode('underline', 'typo_underline');
		add_shortcode('bold', 'typo_bold');
		add_shortcode('italic', 'typo_italic');
		add_shortcode('clear', 'typo_clear');
		add_shortcode('readon', 'typo_readon');
		add_shortcode('readon2', 'typo_readon2');
		add_shortcode('clearboth', 'typo_clearboth');
		add_shortcode('divider', 'typo_divider');
		add_shortcode('divider_top', 'typo_divider_top');
		add_shortcode('space', 'typo_space');
		add_shortcode('divider_padding', 'typo_divider_padding');
		add_shortcode('divider_line', 'typo_divider_line');
		add_shortcode('button', 'typo_button');
		add_shortcode('btn', 'typo_button_standart');
		add_shortcode('tabs', 'dp_tabs');
		add_shortcode('frame_left', 'dp_frame_left');
		add_shortcode('frame_right', 'dp_frame_right');
		add_shortcode('frame_caption', 'dp_frame_caption');
		add_shortcode('table_style', 'dp_table');
		add_shortcode('dp_gallery', 'dp_gallery');
		add_shortcode('lightbox', 'lightbox_shortcode');
		add_shortcode('slideshow', 'dp_slideshow');
		add_shortcode('carousel', 'dp_carousel');	
		add_shortcode('pricing_column', 'dp_pricing_column');
		add_shortcode('gmap', 'dp_googlemap');
		add_shortcode('chart', 'dp_chart');
		add_shortcode('vimeo', 'dp_vimeo');
		add_shortcode('youtube', 'dp_youtube');
		add_shortcode('html5video', 'dp_html5video');
		add_shortcode('mp3', 'dp_mp3');
		add_shortcode('soundcloud', 'dp_soundcloud');
		add_shortcode('recent_posts', 'dp_recent_posts');
		add_shortcode('popular_posts', 'dp_popular_posts');
		add_shortcode('social_links', 'dp_social_links');
        add_shortcode('social_link', 'dp_social_links_item');
		add_shortcode('teambox', 'dp_team_box');
		add_shortcode('piechart', 'piechart');
		add_shortcode('piechart2', 'piechart2');
		add_shortcode('counter', 'counter');
		add_shortcode('progress_bar', 'progressbar');
		add_shortcode('headline', 'headline');
		add_shortcode('faq', 'dp_faq');
		add_shortcode('testimonial', 'testimonial');
		add_shortcode('featuredbox', 'featuredbox');
		add_shortcode('textbox', 'dp_textbox');
		add_shortcode('processbox', 'processbox');
		add_shortcode('numberbox', 'numberbox');
		add_shortcode('timeline', 'dp_timeline');
		add_shortcode('timeline_item', 'dp_timeline_item');
		add_shortcode('timeline_sep', 'dp_timeline_sep');
		add_shortcode('portfolio_grid', 'dp_portfolio_grid');
		add_shortcode('portfolio_carousel', 'dp_portfolio_carousel');
		add_shortcode('blog_grid', 'dp_posts_grid');
		add_shortcode('blog_carousel', 'dp_blog_carousel');
		add_shortcode('owl_carousel', 'dp_owl_carousel');
		add_shortcode('post_teaser', 'dp_post_teaser');
		add_shortcode('teaser', 'dp_teaser');
		add_shortcode('anchor', 'dp_anchor');
		add_shortcode('esense-countdown', 'dp_countdown');
		add_shortcode('esense-flipbox', 'dp_flipbox');
		add_shortcode('esense-notification', 'dp_notification');
		add_shortcode('esense-modal', 'dp_modal');
		add_shortcode('dual-button', 'dp_dual_button');
		add_shortcode('buttongroup', 'dp_buttongroup');
		add_shortcode('buttongroup_item', 'dp_buttongroup_item');
		add_shortcode('buttongroup_sep', 'dp_buttongroup_sep');
		add_shortcode('buttongroup_dropdown', 'dp_buttongroup_dropdown');
		add_shortcode('dp_googlemap', 'dp_googlemap1');
        add_shortcode('dp_googlemap_marker', 'dp_googlemap_marker');
        add_shortcode('dp_dotnav', 'dp_dotnav');
/*EOF*/