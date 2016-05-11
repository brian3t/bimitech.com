<?php 
/**
 *
 * Code to create Featured Video metabox
 *
 **/


function esense_add_featured_video() {
    add_meta_box( 'esense_featured_video', esc_attr__( 'Featured Video', 'esense-functions' ), 'esense_add_featured_video_metabox', 'post', 'side', 'low' );
    add_meta_box( 'esense_featured_video', esc_attr__( 'Featured Video', 'esense-functions' ), 'esense_add_featured_video_metabox', 'page', 'side', 'low' );
    add_meta_box( 'esense_featured_video', esc_attr__( 'Featured Video', 'esense-functions' ), 'esense_add_featured_video_metabox', 'essential_grid', 'side', 'low' );
}


function esense_add_featured_video_metabox() {
    global $post;


    $featured_video = get_post_meta($post->ID, '_esense-featured-video', true);
    
    echo '<p>';
    echo '<label>'.esc_attr__('Featured video link', 'esense-functions').'</label>';
    echo '<input class=" widefat" name="esense_featured_video" type="text" value="'.$featured_video.'">'; ?>
	<span class="description"><?php esc_attr__("Just link, not embed code, this field is used for oEmbed.", 'esense-functions'); ?></span>
    <?php echo '<input type="hidden" name="esense_featured_video_nonce" id="esense_featured_video_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
    echo '</p>';
}
function esense_save_featured_video(){
    global $post,$user;
	// check nonce
    if(!isset($_POST['esense_featured_video_nonce']) || !wp_verify_nonce($_POST['esense_featured_video_nonce'], plugin_basename(__FILE__))) {
    	return is_object($post) ? $post->ID : $post;
	}
	// autosave
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return is_object($post) ? $post->ID : $post;
	}
	// user permissions
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
	// if the value exists
    if(isset($_POST['esense_featured_video'])) {
	    $featured_video = $_POST['esense_featured_video'];


	    if($featured_video != '') {
	    	delete_post_meta($post->ID, '_esense-featured-video');
	    	add_post_meta($post->ID, '_esense-featured-video', $featured_video);
	    } else {
	    	delete_post_meta($post->ID, '_esense-featured-video');
	    }
    }
    
	return true;
}

function esense_slide_setting_callback($post) { 
include (DPFUNCTIONS_DIR .'/inc/metaboxes/slide_meta_box.php'); 
} 

function esense_portfolio_setting_callback($post) { 
include (DPFUNCTIONS_DIR .'/inc/metaboxes/portfolio_meta_box.php'); 
}
 
function esense_sidebar_setting_callback($post) { 
include (DPFUNCTIONS_DIR .'/inc/metaboxes/sidebar_meta_box.php'); 
}
function esense_add_metaboxes() {
	global $esense_tpl;	
	add_meta_box( 'esense-post-params', esc_attr__('Post additional params', 'esense-functions'), 'esense_post_params_callback', 'post', 'normal', 'high' );
	add_meta_box( 'esense-post-params', esc_attr__('Page additional params', 'esense-functions'), 'esense_post_params_callback', 'page', 'normal', 'high' );	
	add_meta_box( 'esense-slide-setting', esc_attr__('Slide Setting', 'esense-functions'), 'esense_slide_setting_callback', 'slide', 'normal', 'high' );
	add_meta_box( 'esense-portfolio-setting', esc_attr__('Portfolio Item Setting', 'esense-functions'), 'esense_portfolio_setting_callback', 'portfolio', 'normal', 'high' );
	add_meta_box( 'esense-sidebar-setting', esc_attr__('Sidebar Description', 'esense-functions'), 'esense_sidebar_setting_callback', 'sidebar', 'normal', 'high' );
	add_meta_box( 'esense-post-params', esc_attr__('Page additional params', 'esense-functions'), 'esense_post_params_callback', 'portfolio', 'normal', 'high' );		

}
function esense_post_params_callback($post) {
	global $post; 
	$values = get_post_custom( $post->ID );  
	$value_title = isset( $values['esense-post-params-title'] ) ? esc_attr( $values['esense-post-params-title'][0] ) : 'Y';
	$value_menutype = isset( $values['esense-post-params-menutype'] ) ? esc_attr( $values['esense-post-params-menutype'][0] ) : 'default';
	$value_sidebarposition = isset( $values['esense-post-params-sidebarposition'] ) ? esc_attr( $values['esense-post-params-sidebarposition'][0] ) : 'default';
	$value_headertype = isset( $values['esense-post-params-headertype'] ) ? esc_attr( $values['esense-post-params-headertype'][0] ) : 'default';
	$value_subheadersize = isset( $values['esense-post-params-subheadersize'] ) ? esc_attr( $values['esense-post-params-subheadersize'][0] ) : 'default';
	$value_headerstyle = isset( $values['esense-post-params-headerstyle'] ) ? esc_attr( $values['esense-post-params-headerstyle'][0] ) : 'default';
	$value_breadcrumbuse = isset( $values['esense-post-params-breadcrumbuse'] ) ? esc_attr( $values['esense-post-params-breadcrumbuse'][0] ) : 'default';
	$value_paspartusetting = isset( $values['esense-post-params-paspartusetting'] ) ? esc_attr( $values['esense-post-params-paspartusetting'][0] ) : 'default';
	$value_paspartu_use = isset( $values['esense-post-params-paspartu-use'] ) ? esc_attr( $values['esense-post-params-paspartu-use'][0] ) : 'N';
	$value_paspartu_bg = isset( $values['esense-post-params-paspartu-bgcolor'] ) ? esc_attr( $values['esense-post-params-paspartu-bgcolor'][0] ) : '#ffffff';
	$value_featured = isset( $values['esense-post-params-featuredimg'] ) ? esc_attr( $values['esense-post-params-featuredimg'][0] ) : 'Y';
	$value_templates = isset( $values['esense-post-params-templates'] ) ? $values['esense-post-params-templates'][0] : false;   
    // if the data are JSON  
    if($value_templates) {  
      $value_templates = unserialize(unserialize($value_templates));  
      $value_contact = $value_templates['contact'];  
      if($value_contact != '' && count($value_contact) > 0) {  
         $value_contact = explode(',', $value_contact); // [0] - name, [1] - e-mail, [2] - send copy     
        }  
     }
	$value_category = isset( $values['esense-post-params-category'] ) ? esc_attr( $values['esense-post-params-category'][0] ) : '';
	$value_perpage = isset( $values['esense-post-params-perpage'] ) ? esc_attr( $values['esense-post-params-perpage'][0] ) : '';
	$value_columncount = isset( $values['esense-portfolio-params-columns'] ) ? esc_attr( $values['esense-portfolio-params-columns'][0] ) : '4';
	$value_pagestyle = isset( $values['esense-portfolio-params-pagestyle'] ) ? esc_attr( $values['esense-portfolio-params-pagestyle'][0] ) : 'white';
	$value_usefilter = isset( $values['esense-portfolio-params-usefilter'] ) ? esc_attr( $values['esense-portfolio-params-usefilter'][0] ) : 'no';
	$value_gridstyle = isset( $values['esense-portfolio-params-gridstyle'] ) ? esc_attr( $values['esense-portfolio-params-gridstyle'][0] ) : 'classic';
	$value_pcategory = isset( $values['esense-portfolio-params-category'] ) ? esc_attr( $values['esense-portfolio-params-category'][0] ) : '';
	$value_pperpage = isset( $values['esense-portfolio-params-perpage'] ) ? esc_attr( $values['esense-portfolio-params-perpage'][0] ) : ''; 
	$value_thumbsize = isset( $values['esense-portfolio-params-thumbsize'] ) ? esc_attr( $values['esense-portfolio-params-thumbsize'][0] ) : '';
	$value_lightboxicon = isset( $values['esense-portfolio-params-lightboxicon'] ) ? esc_attr( $values['esense-portfolio-params-lightboxicon'][0] ) : '';
	$value_linkicon = isset( $values['esense-portfolio-params-linkicon'] ) ? esc_attr( $values['esense-portfolio-params-linkicon'][0] ) : '';
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );	
	$subheader_use =  isset( $values['esense-post-params-subheader_use'] ) ? esc_attr( $values['esense-post-params-subheader_use'][0] ) : 'Y';
	$custom_title =  isset( $values['esense-post-params-custom_title'] ) ? esc_attr( $values['esense-post-params-custom_title'][0] ) : '';
	$custom_subtitle =  isset( $values['esense-post-params-custom_subtitle'] ) ? esc_attr( $values['esense-post-params-custom_subtitle'][0] ) : '';
	$custom_subheaderbg_color =  isset( $values['esense-post-params-subheader_bgcolor'] ) ? esc_attr( $values['esense-post-params-subheader_bgcolor'][0] ) : '';
	$custom_subheaderdbg =  isset( $values['esense-post-params-subheader_img'] ) ? esc_attr( $values['esense-post-params-subheader_img'][0] ) : '';
	$custom_subheadertxt_color =  isset( $values['esense-post-params-subheader_txtcolor'] ) ? esc_attr( $values['esense-post-params-subheader_txtcolor'][0] ) : '';
	$value_customcssclass = isset( $values['esense-post-params-customcssclass'] ) ? esc_attr( $values['esense-post-params-customcssclass'][0] ) : '';
	// nonce 
	wp_nonce_field( 'esense-post-params-nonce', 'esense_meta_box_params_nonce' ); 
    // output
	echo '<p class="col_onehalf"><label for="esense-post-params-title-value">'.esc_attr__('Show title:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-title-value" id="esense-post-params-title-value">';
    echo '<option value="Y"'.selected($value_title, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_title, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select></p>';
    echo '<p class="col_onehalf">';
    echo '<label for="esense-post-params-featuredimg-value">'.esc_attr__('Featured image:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-featuredimg-value" id="esense-post-params-featuredimg-value">';
    echo '<option value="Y"'.selected($value_featured, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_featured, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select>';
    echo '</p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-sidebarposition-value">'.esc_attr__('Sidebar position:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-sidebarposition-value" id="esense-post-params-sidebarposition-value">';
    echo '<option value="default"'.selected($value_sidebarposition, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="left"'.selected($value_sidebarposition, 'left', false).'>'.esc_attr__('Left', 'esense-functions').'</option>';
    echo '<option value="right"'.selected($value_sidebarposition, 'right', false).'>'.esc_attr__('Right', 'esense-functions').'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-menutype-value">'.esc_attr__('Menu type:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-menutype-value" id="esense-post-params-menutype-value">';
    echo '<option value="default"'.selected($value_menutype, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="top"'.selected($value_menutype, 'top', false).'>'.esc_attr__('Top', 'esense-functions').'</option>';
    echo '<option value="aside"'.selected($value_menutype, 'aside', false).'>'.esc_attr__('Aside', 'esense-functions').'</option>';
    echo '<option value="overlay"'.selected($value_menutype, 'overlay', false).'>'.esc_attr__('Overlay', 'esense-functions').'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-headertype-value">'.esc_attr__('Header overlaping:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-headertype-value" id="esense-post-params-headertype-value">';
    echo '<option value="default"'.selected($value_headertype, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="Y"'.selected($value_headertype, 'Y', false).'>'.esc_attr__('Yes', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_headertype, 'N', false).'>'.esc_attr__('No', 'esense-functions').'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-headerstyle-value">'.esc_attr__('Header overlapping style:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-headerstyle-value" id="esense-post-params-headerstyle-value">';
    echo '<option value="default"'.selected($value_headerstyle, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="light"'.selected($value_headerstyle, 'light', false).'>'.esc_attr__('Light', 'esense-functions').'</option>';
    echo '<option value="dark"'.selected($value_headerstyle, 'dark', false).'>'.esc_attr__('Dark', 'esense-functions').'</option>';
    echo '</select></p>';
	echo '<div class="clearboth"></div>';
	echo '<p class="col_onehalf"><label for="esense-post-params-breadcrumbuse-value">'.esc_attr__('Breadcrumb display:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-breadcrumbuse-value" id="esense-post-params-breadcrumbuse-value">';
    echo '<option value="default"'.selected($value_breadcrumbuse, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="Y"'.selected($value_breadcrumbuse, 'Y', false).'>'.esc_attr__('Enable', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_breadcrumbuse, 'N', false).'>'.esc_attr__('Disable', 'esense-functions').'</option>';
    echo '</select></p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-customcssclass">'.esc_attr__('Custom CSS class: ', 'esense-functions').'</label>';
	echo '<input name="esense-post-params-customcssclass" type="text" id="esense-post-params-customcssclass-value" value="'.$value_customcssclass.'">';
    echo '</p>';
	echo '<div class="clearboth"></div>'; 
	if ($page_template == 'template.latest_small_thumb.php' || $page_template == 'template.latest_big_thumb.php' || $page_template == 'template.latest_small_thumb_full.php' || $page_template == 'template.latest_big_thumb_full.php') {
	echo '<p class="subsection-title">'.esc_attr__('Blog pages custom setting', 'esense-functions').'</p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-post-params-category-value">'.esc_attr__('Category: &nbsp;', 'esense-functions').'</label>';
	echo '<input name="esense-post-params-category-value" type="text" id="esense-post-params-category-value" value="'.$value_category.'">';
	echo '&nbsp;<small>'.esc_attr__('You can specify category or coma separated list of categories witch will be used on this page. If you leave this field empty will be displayed posts from all categories.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-post-params-perpage-value">'.esc_attr__('Items per page: &nbsp;', 'esense-functions').'</label>';
	echo '<input name="esense-post-params-perpage-value" type="text" id="esense-post-params-perpage-value" value="'.$value_perpage.'">';
	echo '&nbsp;<small>'.esc_attr__('You can specify items per page witch will be used on this page. If you leave this field empty will be used general setting.', 'esense-functions').'</small></p>';
	}

	echo '<div class="clearboth"></div>'; 
	if ($page_template == 'template.portfolio-nosidebar.php' || $page_template == 'template.portfolio.php' || $page_template == 'template.portfolio-fullwidth.php') {
	echo '<p class="subsection-title">'.esc_attr__('Portfolio pages custom setting', 'esense-functions').'</p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-columns-value">'.esc_attr__('Columns count: &nbsp;', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-columns-value" id="esense-portfolio-params-columns-value">';
    echo '<option value="2"'.selected($value_columncount, '2', false).'>'.esc_attr__('2 columns', 'esense-functions').'</option>';
    echo '<option value="3"'.selected($value_columncount, '3', false).'>'.esc_attr__('3 columns', 'esense-functions').'</option>';
    echo '<option value="4"'.selected($value_columncount, '4', false).'>'.esc_attr__('4 columns', 'esense-functions').'</option>';
    echo '<option value="5"'.selected($value_columncount, '5', false).'>'.esc_attr__('5 columns', 'esense-functions').'</option>';
    echo '<option value="6"'.selected($value_columncount, '6', false).'>'.esc_attr__('6 columns', 'esense-functions').'</option>';
    echo '</select>';	
	echo '&nbsp;<small>'.esc_attr__('You can specify columns count for this portfolio page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-pagestyle-value">'.esc_attr__('Page style: &nbsp;', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-pagestyle-value" id="esense-portfolio-params-pagestyle-value">';
    echo '<option value="white"'.selected($value_pagestyle, 'white', false).'>'.esc_attr__('White background', 'esense-functions').'</option>';
    echo '<option value="gray"'.selected($value_pagestyle, 'gray', false).'>'.esc_attr__('Gray background', 'esense-functions').'</option>';
    echo '</select>';	
	echo '&nbsp;<small>'.esc_attr__('You can specify page background for this portfolio page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-usefilter-value">'.esc_attr__('Use category filter: &nbsp;', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-usefilter-value" id="esense-portfolio-params-usefilter-value">';
    echo '<option value="Y"'.selected($value_usefilter, 'Y', false).'>'.esc_attr__('Enable', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_usefilter, 'N', false).'>'.esc_attr__('Disable', 'esense-functions').'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.esc_attr__('You can enable fullwidth for this portfolio page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-gridstyle-value">'.esc_attr__('Grid style: &nbsp;', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-gridstyle-value" id="esense-portfolio-params-gridstyle-value">';
    echo '<option value="classic"'.selected($value_gridstyle, 'classic', false).'>'.esc_attr__('Classic', 'esense-functions').'</option>';
    echo '<option value="grid"'.selected($value_gridstyle, 'grid', false).'>'.esc_attr__('Thumbnail grid', 'esense-functions').'</option>';
    echo '<option value="gridnomargin"'.selected($value_gridstyle, 'gridnomargin', false).'>'.esc_attr__('Thumbnail grid no margin', 'esense-functions').'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.esc_attr__('You can style for this portfolio page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-category-value">'.esc_attr__('Category: &nbsp;', 'esense-functions').'</label>';
	echo '<input name="esense-portfolio-params-category-value" type="text" id="esense-portfolio-params-category-value" value="'.$value_pcategory.'">';
	echo '&nbsp;<small>'.esc_attr__('You can specify category or coma separated list of categories witch will be used on this page. If you leave this field empty will be displayed posts from all categories.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-perpage-value">'.esc_attr__('Items per page: &nbsp;', 'esense-functions').'</label>';
	echo '<input name="esense-portfolio-params-perpage-value" type="text" id="esense-portfolioparams-perpage-value" value="'.$value_pperpage.'">';
	echo '&nbsp;<small>'.esc_attr__('You can specify items per page witch will be used on this page. If you leave this field empty will be used general setting.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-thumbsize-value">'.esc_attr__('Thumb Size:', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-thumbsize-value" id="esense-portfolio-params-thumbsize-value">';
    echo '<option value="horizontal"'.selected($value_thumbsize, 'horizontal', false).'>'.esc_attr__('Horizontal 4:3', 'esense-functions').'</option>';
    echo '<option value="vertical"'.selected($value_thumbsize, 'vertical', false).'>'.esc_attr__('Vertical 3:4', 'esense-functions').'</option>';
    echo '<option value="square"'.selected($value_thumbsize, 'square', false).'>'.esc_attr__('Square', 'esense-functions').'</option>';
    echo '<option value="original"'.selected($value_thumbsize, 'original', false).'>'.esc_attr__('Original dimensions', 'esense-functions').'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.esc_attr__('You can specify thumb dimensions used on this page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-lightboxicon-value">'.esc_attr__('Lightbox icon in overlay:', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-lightboxicon-value" id="esense-portfolio-params-lightboxicon-value">';
    echo '<option value="N"'.selected($value_lightboxicon, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '<option value="Y"'.selected($value_lightboxicon, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.esc_attr__('If enabled lightbox link icon will be visble in overlay on this page.', 'esense-functions').'</small></p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-portfolio-params-linkicon-value">'.esc_attr__('Link icon in overlay:', 'esense-functions').'</label>';
    echo '<select name="esense-portfolio-params-linkicon-value" id="esense-portfolio-params-linkicon-value">';
    echo '<option value="N"'.selected($value_linkicon, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '<option value="Y"'.selected($value_linkicon, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '</select>';
	echo '&nbsp;<small>'.esc_attr__('If enabled link to portfolio item single view icon will be visble in overlay on this page.', 'esense-functions').'</small></p>';
 	}


	// output for the contact page options
	echo '<p data-template="template.contact.php" class="subsection-title">'.esc_attr__('Contact page settings', 'esense-functions').'</p>';
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="esense-post-params-contact-name">'.esc_attr__('Show name field:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-contact-name" id="esense-post-params-contact-name">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[0] == 'Y') ? ' selected="selected"' : '').'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.(($value_contact !== FALSE && $value_contact[0] == 'N') ? ' selected="selected"' : '').'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select>';
    echo '</p>';
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="esense-post-params-contact-email">'.esc_attr__('Show e-mail field:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-contact-email" id="esense-post-params-contact-email">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[1] == 'Y') ? ' selected="selected"' : '').'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.(($value_contact != FALSE && $value_contact[1] == 'N') ? ' selected="selected"' : '').'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select>';
    echo '</p>';  
    echo '<p data-template="template.contact.php" class="col_onefourth">';
    echo '<label for="esense-post-params-contact-copy">'.esc_attr__('Show "send copy":', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-contact-copy" id="esense-post-params-contact-copy">';
    echo '<option value="Y"'.((!$value_contact || $value_contact[2] == 'Y') ? ' selected="selected"' : '').'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.(($value_contact !== FALSE && $value_contact[2] == 'N') ? ' selected="selected"' : '').'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select>';
    echo '</p>';
	echo '<div class="clearboth"></div>';
	// output for the paspartu setting
	echo '<p class="subsection-title">'.esc_attr__('Paspartu custom style', 'esense-functions').'</p>';
	echo '<p class="description">'.esc_attr__('Here can you set custom layout of paspartu for this post/page', 'esense-functions').'</p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-paspartusetting-value">'.esc_attr__('Paspartu setting:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-paspartusetting-value" id="esense-post-params-paspartusetting-value">';
    echo '<option value="default"'.selected($value_paspartusetting, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="custom"'.selected($value_paspartusetting, 'custom', false).'>'.esc_attr__('Custom', 'esense-functions').'</option>';
    echo '</select><br clear="all"></p>';
	echo '<div class="clearboth"></div>';
	echo '<div id="paspartu_params_area">';
	echo '<p class="esense-indent"><label for="esense-post-params-paspartu-use-value">'.esc_attr__('Use paspartu:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-paspartu-use-value" id="esense-post-params-paspartu-use-value">';
    echo '<option value="Y"'.selected($value_paspartu_use, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($value_paspartu_use, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select><br clear="all"><span class="description">'.esc_attr__('Here you can enable or disable paspartu only for this page.', 'esense-functions').'</span></p>';
	echo '<p><label for="esense-post-params-paspartu-bgcolor-value" class="col_onefourth">'.esc_attr__('Custom background color for paspartu:', 'esense-functions').'</label>';
	echo '<input type="text" value="'.$value_paspartu_bg.'" class=" dpColor" name="esense-post-params-paspartu-bgcolor-value" id="esense-post-params-paspartu-bgcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<div class="clearboth"></div>';
	echo '</div>';
	// output for the subheader area
	echo '<p class="subsection-title">'.esc_attr__('Subheader area custom style', 'esense-functions').'</p>';
	echo '<p class="description">'.esc_attr__('Here can you set custom layout of subheader area for this post/page', 'esense-functions').'</p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-subheader_use-value">'.esc_attr__('Use subheader:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-subheader_use-value" id="esense-post-params-subheader_use-value">';
    echo '<option value="Y"'.selected($subheader_use, 'Y', false).'>'.esc_attr__('Enabled', 'esense-functions').'</option>';
    echo '<option value="N"'.selected($subheader_use, 'N', false).'>'.esc_attr__('Disabled', 'esense-functions').'</option>';
    echo '</select><br clear="all"><span class="description">'.esc_attr__('If you enable this you can also use custom title and subtitle','esense-functions').'</span></p>';
	echo '<p class="col_onehalf"><label for="esense-post-params-subheadersize-value">'.esc_attr__('Subheader size:', 'esense-functions').'</label>';
    echo '<select name="esense-post-params-subheadersize-value" id="esense-post-params-subheadersize-value">';
    echo '<option value="default"'.selected($value_subheadersize, 'default', false).'>'.esc_attr__('Default (as in general settings)', 'esense-functions').'</option>';
    echo '<option value="small"'.selected($value_subheadersize, 'small', false).'>'.esc_attr__('Small', 'esense-functions').'</option>';
    echo '<option value="big"'.selected($value_subheadersize, 'big', false).'>'.esc_attr__('Big', 'esense-functions').'</option>';
    echo '</select><br clear="all"><span class="description">'.esc_attr__('Here you can change subheader size for tis page.', 'esense-functions').'</span></p>';
	echo '<div class="clearboth"></div>';
	echo '<div id="subheader_params_area">';
	echo '<p class="esense-indent">';
	echo '<label for="esense-post-params-custom_title">'.esc_attr__('Custom title in header:', 'esense-functions').'</label>';
	echo '<input class="widefat" name="esense-post-params-custom_title-value" type="text" id="esense-post-params-custom_title-value" value="'.$custom_title.'">';
	echo '</p>';
	echo '<p class="esense-indent">';
	echo '<label for="esense-post-params-custom_subtitle">'.esc_attr__('Custom subtitle in header:', 'esense-functions').'</label>';
	echo '<input class="widefat" name="esense-post-params-custom_subtitle-value" type="text" id="esense-post-params-custom_subtitle-value" value="'.$custom_subtitle.'">';
	echo '</p>';
	echo '<p><label for="esense-post-params-subheader_bgcolor" class="col_onefourth">'.esc_attr__('Custom background color for subheader:', 'esense-functions').'</label>';
	echo '<input type="text" value="'.$custom_subheaderbg_color.'" class=" dpColor" name="esense-post-params-subheader_bgcolor-value" id="esense-post-params-subheader_bgcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<p><label for="esense-post-params-subheader_txtcolor" class="col_onefourth">'.esc_attr__('Custom text color for subheader:', 'esense-functions').'</label>';
	echo '<input type="text" value="'.$custom_subheadertxt_color.'" class=" dpColor" name="esense-post-params-subheader_txtcolor-value" id="esense-post-params-subheader_txtcolor-value"><input type="text" class="colorSelector"  /></p>';
	echo '<p class="col_twothird">';
	echo '<label for="esense-post-params-subheader_img-value">'.esc_attr__('Custom background image for subheader area:', 'esense-functions').'</label>';
	echo '<input class="widefat" name="esense-post-params-subheader_img-value" type="text" id="esense-post-params-subheader_img-value" value="'.$custom_subheaderdbg.'">';
	echo '<input  class="button uploadbtn" name="esense-post-params-subheader_img-button" id="esense-post-params-subheader_img-button" value="'.esc_attr__('Upload image', 'esense-functions').'" />';
	echo '<small><a  href="#" id="esense-post-params-subheader_img-clear" />'.esc_attr__('Remove Image', 'esense-functions').'</a></small>';
	echo '<br clear="all"><span class="description">'.esc_attr__('Recomended width 1680 px', 'esense-functions').'</span>';
	echo '</p>';
	echo '<p class="col_onefourth">';	
	echo '<span class="img-holder"><img id="esense-post-params-subheader_img-thumb" alt="" src="'.esc_url($custom_subheaderdbg).'"></span>';
	echo '</p>';
	echo '</div>';
	echo '<div class="clearboth"></div>';
	?>
    <script type="text/javascript">
	jQuery(document).ready(function($) {
	esense_PickerInit();
		//
		function esense_PickerInit() {
	jQuery('.colorSelector').spectrum({
    showAlpha: true,
    showInput: true,
	allowEmpty:true,
	preferredFormat: "hex",
	chooseText: "Select"
});
	jQuery('.colorSelector').each(
		function() {
		var initialColor = jQuery(this).prev('input').attr('value');
		jQuery(this).spectrum("set", initialColor);
		jQuery(this).change(function() {
		jQuery(this).prev('input').attr('value',jQuery(this).spectrum("get"));	
		})
		}
	);
	
	jQuery('.dpColor').change(function() {
		newColor = jQuery(this).val();
		jQuery(this).next('.colorSelector').spectrum("set", newColor);
		}
	)
	
}
if (jQuery('#esense-post-params-subheader_use-value').val() == 'N') {jQuery('#subheader_params_area').hide(); }
else {jQuery('#subheader_params_area').show();}
jQuery('#esense-post-params-subheader_use-value').change(
		function() {
if (jQuery('#esense-post-params-subheader_use-value').val() == 'N') {jQuery('#subheader_params_area').hide('slow'); }
else {jQuery('#subheader_params_area').show('slow');}
		}
);

if (jQuery('#esense-post-params-paspartusetting-value').val() == 'default') {jQuery('#paspartu_params_area').hide(); }
else {jQuery('#paspartu_params_area').show();}
jQuery('#esense-post-params-paspartusetting-value').change(
		function() {
if (jQuery('#esense-post-params-paspartusetting-value').val() == 'default') {jQuery('#paspartu_params_area').hide('slow'); }
else {jQuery('#paspartu_params_area').show('slow');}
		}
);

if($('#esense-post-params-subheader_img-value').length>0) {
	$('#esense-post-params-subheader_img-thumb').show("slow");
	$('#esense-post-params-subheader_img-clear').show();
	} 
else {
	$('#esense-post-params-subheader_img-thumb').hide();
	$('#esense-post-params-subheader_img-clear').hide();
	}
$('#esense-post-params-subheader_img-clear').click(function() {
	$('#esense-post-params-subheader_img-value').val('');
	$('#esense-post-params-subheader_img-clear').hide();
	$('#esense-post-params-subheader_img-thumb').hide("slow");
});

	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
 
	$('#esense-post-params-subheader_img-button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$('#esense-post-params-subheader_img-value').val(attachment.url);
				$('#esense-post-params-subheader_img-thumb').attr("src",attachment.url);
				$('#esense-post-params-subheader_img-thumb').show("slow");
				$('#esense-post-params-subheader_img-clear').show();

			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
 
		wp.media.editor.open(button);
		return false;
	});
 
	$('.add_media').on('click', function(){
		_custom_media = false;
	});

});
	</script>
    <?php
     
} 

function esense_metaboxes_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }  
    // check the existing of the fields and save it
    if( isset( $_POST['esense-post-desc-value'] ) ) {
        // check the nonce
        if( !isset( $_POST['esense_meta_box_seo_nonce'] ) || !wp_verify_nonce( $_POST['esense_meta_box_seo_nonce'], 'esense-post-seo-nonce' ) ) {
        	return;
        }
        // update post meta
        update_post_meta( $post_id, 'esense-post-desc', esc_attr( $_POST['esense-post-desc-value'] ) );  
    }
  	//
    if( isset( $_POST['esense-post-keywords-value'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['esense_meta_box_seo_nonce'] ) || !wp_verify_nonce( $_POST['esense_meta_box_seo_nonce'], 'esense-post-seo-nonce' ) ) {
    		return;
    	}
    	// update post meta
        update_post_meta( $post_id, 'esense-post-keywords', esc_attr( $_POST['esense-post-keywords-value'] ) ); 
    }

    //
    if( isset( $_POST['esense-post-params-title-value'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['esense_meta_box_params_nonce'] ) || !wp_verify_nonce( $_POST['esense_meta_box_params_nonce'], 'esense-post-params-nonce' ) ) {
    		return;
    	}
    	// update post meta
        update_post_meta( $post_id, 'esense-post-params-title', esc_attr( $_POST['esense-post-params-title-value'] ) );
        update_post_meta( $post_id, 'esense-post-params-sidebarposition', esc_attr( $_POST['esense-post-params-sidebarposition-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-featuredimg', esc_attr( $_POST['esense-post-params-featuredimg-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-customcssclass', esc_attr( $_POST['esense-post-params-customcssclass'] ) );
        update_post_meta( $post_id, 'esense-post-params-menutype', esc_attr( $_POST['esense-post-params-menutype-value'] ) );
        update_post_meta( $post_id, 'esense-post-params-headertype', esc_attr( $_POST['esense-post-params-headertype-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-headerstyle', esc_attr( $_POST['esense-post-params-headerstyle-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-breadcrumbuse', esc_attr( $_POST['esense-post-params-breadcrumbuse-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-subheadersize', esc_attr( $_POST['esense-post-params-subheadersize-value'] ) );
		//
    if( isset( $_POST['esense-post-params-contact-name'] ) ) {
    	// check the nonce
    	if( !isset( $_POST['esense_meta_box_params_nonce'] ) || !wp_verify_nonce( $_POST['esense_meta_box_params_nonce'], 'esense-post-params-nonce' ) ) {
    		return;
    	}
    	// update post meta
    	$contact_value = esc_attr( $_POST['esense-post-params-contact-name'] ) . ',' . esc_attr( $_POST['esense-post-params-contact-email'] ) . ',' . esc_attr( $_POST['esense-post-params-contact-copy'] );
    	$templates_value = array('contact' => $contact_value);
        update_post_meta( $post_id, 'esense-post-params-templates', serialize($templates_value) ); 
    }
		update_post_meta( $post_id, 'esense-post-params-subheader_use', esc_attr( $_POST['esense-post-params-subheader_use-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-custom_title', esc_attr( $_POST['esense-post-params-custom_title-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-custom_subtitle', esc_attr( $_POST['esense-post-params-custom_subtitle-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-subheader_img', esc_attr( $_POST['esense-post-params-subheader_img-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-subheader_bgcolor', esc_attr( $_POST['esense-post-params-subheader_bgcolor-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-subheader_txtcolor', esc_attr( $_POST['esense-post-params-subheader_txtcolor-value'] ) );
		
		update_post_meta( $post_id, 'esense-post-params-paspartusetting', esc_attr( $_POST['esense-post-params-paspartusetting-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-paspartu-use', esc_attr( $_POST['esense-post-params-paspartu-use-value'] ) );
		update_post_meta( $post_id, 'esense-post-params-paspartu-bgcolor', esc_attr( $_POST['esense-post-params-paspartu-bgcolor-value'] ) );
 
    }
}  
add_action( 'save_post', 'esense_portfolio_setting_save' );   
function esense_portfolio_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['item_short_desc'] ) ) {
        update_post_meta( $post_id, 'item_short_desc', esc_attr( $_POST['item_short_desc'] ) );  
    }
	if( isset( $_POST['item_type'] ) ) {
        update_post_meta( $post_id, 'item_type', esc_attr( $_POST['item_type'] ) );  
    }
	if( isset( $_POST['item_layout'] ) ) {
        update_post_meta( $post_id, 'item_layout', esc_attr( $_POST['item_layout'] ) );  
    }
	if( isset( $_POST['item_addimages'] ) ) {
		$datta = htmlspecialchars( $_POST['item_addimages']);
        update_post_meta( $post_id, 'item_addimages',$datta );  
    }
	if( isset( $_POST['item_video'] ) ) {
        update_post_meta( $post_id, 'item_video', esc_attr( $_POST['item_video'] ) );  
    }
	if( isset( $_POST['item_link'] ) ) {
        update_post_meta( $post_id, 'item_link', esc_attr( $_POST['item_link'] ) );  
    }
	if( isset( $_POST['item_date'] ) ) {
        update_post_meta( $post_id, 'item_date', esc_attr( $_POST['item_date'] ) );  
    }
	if( isset( $_POST['item_client'] ) ) {
        update_post_meta( $post_id, 'item_client', esc_attr( $_POST['item_client'] ) );  
    }
	if( isset( $_POST['item_client'] ) ) {
        update_post_meta( $post_id, 'item_www', esc_attr( $_POST['item_www'] ) );  
    }
}   
add_action( 'save_post', 'esense_slide_setting_save' );   
function esense_slide_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['slide_type'] ) ) {
    update_post_meta( $post_id, 'slide_type', esc_attr( $_POST['slide_type'] ) );  
    }
	if( isset( $_POST['slide_description'] ) ) {
        update_post_meta( $post_id, 'slide_description', esc_attr( $_POST['slide_description'] ) );  
    }
	if( isset( $_POST['slide_link'] ) ) {
        update_post_meta( $post_id, 'slide_link', esc_attr( $_POST['slide_link'] ) );  
    }
}
add_action( 'save_post', 'esense_sidebar_setting_save' );   
function esense_sidebar_setting_save( $post_id ) {  
    // check the user permissions  
    if( !current_user_can( 'edit_post', $post_id ) ) {
    	return;
    }
    // avoid requests on the autosave 
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    	return; 
    }
    // check the existing of the fields and save it
	if( isset( $_POST['sidebar_description'] ) ) {
        update_post_meta( $post_id, 'sidebar_description', esc_attr( $_POST['sidebar_description'] ) );  
    }
}  

add_action('add_meta_boxes', 'esense_add_metaboxes' );
add_action( 'admin_menu', 'esense_add_featured_video' );
add_action( 'save_post',  'esense_save_featured_video' );
add_action('add_meta_boxes', 'esense_add_metaboxes' );
add_action('save_post', 'esense_metaboxes_save' ); 



