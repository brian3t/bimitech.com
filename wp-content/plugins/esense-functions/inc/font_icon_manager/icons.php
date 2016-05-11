<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
	$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 	$wp_load = $absolute_path[0] . 'wp-load.php';
	require_once($wp_load);
?>
<head>
<style type="text/css">
#smile_icon_search {height:396px!important;}
.smile_icon p { font-family:Arial, Helvetica, sans-serif; font-size:15px;}
.smile_icon {padding-left:2px;}
#submiticon {
	background-color:#3d94f6;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #337fed;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:14px;
	padding:5px 18px;
	text-decoration:none;
	text-shadow:0px 1px 0px #1570cd;
	margin-top:10px;
	float:right;
	margin-right:20px;
}
#submiticon:hover {
	background-color:#51a5d6;
}
#submiticon:active {
	position:relative;
	top:1px;
}

</style>
<link rel="stylesheet" id="vc-icon-manager-css" href="<?php echo plugins_url(); ?>/esense-functions/inc/font_icon_manager/assets/css/icon-manager.css" type="text/css" media="all" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
  <script type="text/javascript">
   jQuery(document).ready(function(){
	var parentid = '#' + jQuery('#parentid').val();
	var parentpreview = '#'+jQuery('#parentpreviewid').val();
	jQuery(".icons-list li").click(function() {
	var icon = jQuery(this).data('icon');
	jQuery(parentid,top.document).val(icon);
	jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
	});
	jQuery("#submiticon").click(function() {
	var icon = jQuery(".preview-icon").find(">:first-child").attr('class')
	jQuery(parentpreview,top.document).html('<i class="'+ icon + '"></i>');	 
	self.parent.tb_remove();	
	});
  });

	</script>
<?php $fonts = get_option('dp_font_icons');
				$upload_dir = wp_upload_dir(); 

				if(is_array($fonts))
				{
					foreach($fonts as $font => $info)
					{
					echo '<link rel="stylesheet" href="'.$upload_dir['baseurl'].'/dp_font_icons/'.$info['style'].'">';	
					}
				}
?>

</head>
<body>
    <?php echo ' <input type ="hidden" name="parentid" id="parentid" value="'.$_GET ["parentid"].'">';
	 	  echo ' <input type ="hidden" name="parentpreviewid" id="parentpreviewid" value="'.$_GET ["parentpreviewid"].'">';	
	 


				$output = esense_get_font_manager();
				$output .= '<button id="submiticon">Submit</button>';
				print ($output) ?>
</body>
</html>