<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => esc_attr__("Section", 'esense-functions'),
	'icon' => ""
), $atts));
$iconbefore = '';
if ($icon !="") $iconbefore = '<i class="tabicon '.$icon.' iconbefore"></i>';
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$iconbefore.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
        $output .= ($content=='' || $content==' ') ? esc_attr__("Empty section. Edit page to add content here.", 'esense-functions') : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;