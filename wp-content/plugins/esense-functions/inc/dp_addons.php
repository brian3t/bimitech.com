<?php
function esense_print_html_images( $content, $num = 1, $width = null, $height = null, $class = 'alignleft', $permalink = true, $echo = true ) {
	
	// Parse all of the defaults and parameters
	if ( is_array( $num ) ) {
		
		$defaults = array(
			'number' => 1,
			'width' => '',
			'height' => '',
			'class' => 'alignleft',
			'permalink' => true,
			'echo' => true	
		);
		
		$args = wp_parse_args( $num, $defaults );
	
		extract( $args, EXTR_OVERWRITE );

	} else {
		
		// Fix for number parameter
		$number = $num;
		
	}
	
	// Set $more variable to retrieve full post content
	global $more;
	$more = 1;

	// Setup variables according to passed parameters
	$size = empty( $width ) ? '' : ' width="' . $width . 'px"';
	$size = empty( $height ) ? $size : $size . ' height="' . $height . 'px"'; 
	$class = empty( $class ) ? '' : ' class="' . $class . '"';
	$link = empty( $permalink ) ? '' : '<a href="' . get_permalink() . '">';
	$linkend = empty( $permalink ) ? '' : '</a>';
	
	
	// Number of images in content
	$count = substr_count( $content, '<img' );
	$start = 0;
	
	// Loop through the images
	for ( $i = 1; $i <= $count; $i++ ) {

		// Get image src
		$imgBeg = strpos( $content, '<img', $start );
		$post = substr( $content, $imgBeg );
		$imgEnd = strpos( $post, '>' );
		$postOutput = substr( $post, 0, $imgEnd + 1 );

		// Replace width || height || class
		
			$replace = array( '/width="[^"]*" /', '/height="[^"]*" /', '/class="[^"]*" /' );
			$postOutput = preg_replace( $replace, '', $postOutput );			
			$replace = '/class="[^"]*" /';
			$postOutput = preg_replace( $replace, '', $postOutput );

		$image[$i] = '<div class="multiple-img-item">'.$postOutput.'</div>';

		$start = $imgBeg + $imgEnd + 1;

	}

	// Go through the images and return/echo according to above parameters
	if ( ! empty( $image ) ) {
	
		if ( 'all' == $number ) {
	
			$x = count( $image );
			$images = '';
			
			for ( $i = 1; $i <= $x; $i++ ) {
	
				if ( stristr( $image[$i], '<img' ) ) {
	
					$theImage = str_replace( '<img', '<img' . $size . $class, $image[$i] );
					$images .= $link . $theImage . $linkend;
				
				}
				
			}
	
		} else {
	
			if ( stristr( $image[$number], '<img' ) ) {
	
				$theImage = str_replace( '<img', '<img' . $size . $class, $image[$number] );
				$images = $link . $theImage . $linkend;
	
			}
			
		}
	
		// Reset the $more tag back to zero
		$more = 0;
	
		// Echo or return 
		if ( ! empty( $echo ) )
	    	echo $images;
	    else
	    	return $images;

	}

}
function dp_head_fonts() {
	global $esense_tpl;
	$usedsquirrel = $usedgoogle =  array();
	$output = "<style type=\"text/css\">\n";

	for($i = 0; $i < count($esense_tpl->fonts); $i++) {
		$selectors = get_option($esense_tpl->name . '_fonts_selectors_' . $esense_tpl->fonts[$i]['short_name'], '');
		$type = get_option($esense_tpl->name . '_fonts_type_' . $esense_tpl->fonts[$i]['short_name'], 'normal');
		$normal = get_option($esense_tpl->name . '_fonts_normal_' . $esense_tpl->fonts[$i]['short_name'], '');
		$squirrel = get_option($esense_tpl->name . '_fonts_squirrel_' . $esense_tpl->fonts[$i]['short_name'], '');
		$google = get_option($esense_tpl->name . '_fonts_google_' . $esense_tpl->fonts[$i]['short_name'], '');
		
		if(trim($selectors) != '') {
			$font_family = "";
			
			if($type == 'normal') {
				$normal = str_replace(
				                    array(
				                        "Times New Roman",
				                        "Trebuchet MS",
				                        "Arial Black",
				                        "Palatino Linotype",
				                        "Book Antiqua",
				                        "Lucida Sans Unicode",
				                        "Lucida Grande",
				                        "MS Serif",
				                        "New York",
				                        "Comic Sans MS",
				                        "Courier New",
				                        "Lucida Console",
				                    ),
				                    array(
				                        "'Times New Roman'",
				                        "'Trebuchet MS'",
				                        "'Arial Black'",
				                        "'Palatino Linotype'",
				                        "'Book Antiqua'",
				                        "'Lucida Sans Unicode'",
				                        "'Lucida Grande'",
				                        "'MS Serif'",
				                        "'New York'",
				                        "'Comic Sans MS'",
				                        "'Courier New'",
				                        "'Lucida Console'",
				                    ),
				                    $normal
				                );
			
				$font_family = str_replace('\&#039;', "'", $normal);
			} else if($type == 'squirrel') {
				if (!in_array($squirrel, $usedsquirrel)) {				
				wp_enqueue_style('esense-fonts-' . $i, get_template_directory_uri().'/fonts/' . $squirrel . '/stylesheet.css');
				array_push($usedsquirrel, $squirrel);
				}
				$font_family = "'" . $squirrel . "'";
				
			} else if($type == 'google') {
				if (!in_array($google, $usedgoogle)) {
				array_push($usedgoogle, $google);
				$fname = array();
				preg_match('@family=(.+)$@is', $google, $fname);
				if(!count($fname)) {
					preg_match('@family=(.+):.+@is', $google, $fname);
				} 
				
				if(!count($fname)) {
					preg_match('@family(.+)\|.+@is', $google, $fname);
				}
				
				
				// We are providing the protocol to avoid duplicated downloads on IE7/8
				$google = ($esense_tpl->isSSL) ? str_replace('http://', 'https://', $google) : $google;
				
				echo '<link href="'.$google.'" rel="stylesheet" type="text/css" />';
				}
				$font_family = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $fname[1]))) . "'";
			}
			
			$output .= str_replace(array('\\', '&quot;', '&apos;', '&gt;'), array('', '"', '\'', '>'), $selectors) . " { font-family: " . $font_family . "; }\n\n";
		}
	}
	
	$output .= "</style>\n";
	
	echo $output;
}
function esense_wp_fonts_hook() {
	// generates Dynamo fonts
	dp_head_fonts();
	
 	// YOUR HOOK CODE HERE
}

add_action('wp_head', 'esense_wp_fonts_hook', 9);

