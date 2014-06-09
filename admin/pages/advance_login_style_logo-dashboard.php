<?php
/**
 * This file is used to display setting page
 *
 * @package admin
 * @subpackage pages
 */
 
global $advance_login_style_admin_pages;
//var_dump($advance_login_style_admin_pages);
$options = get_option( 'advance_login_style_logo' );

//$test_structure_admin_pages->admin_header( __( 'General Settings', 'test_structure' ), true, 'bkd_advance_login_style_options', 'test_structure' );
echo '<script type="text/javascript">
        jQuery(document).ready(function($) {   
        $("#LoginF_orm_Background_Clore").wpColorPicker();
        });             
        </script>';
		
		echo '<script type="text/javascript">
        jQuery(document).ready(function($) {   
        $("#Login_Background_Clore").wpColorPicker();
        });             
        </script>';
		
		echo '<script type="text/javascript">
        jQuery(document).ready(function($) {   
        $("#text_logo_font_color").wpColorPicker();
        });             
        </script>';



echo $advance_login_style_admin_pages->admin_header( __( 'General Settings', 'advance_login_style' ), true, 'cb_advance_login_style_logo_options', 'advance_login_style_logo' );



echo '<script type="text/ecmascript">
jQuery(document).ready(function($){
	$("#buttonid").click(function() {
		tb_show("Upload a logo","media-upload.php?referer=plugin-bazaar-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0", false);
		return false;
	});
	window.send_to_editor = function(html) {
		var image_url = $("img",html).attr("src");
		//alert(html);
		$("#Login_logo_Image").val(image_url);
		tb_remove();
		$("#upload_logo_preview img").attr("src",image_url);		
		$("#Login_logo_Image").trigger("click");		
	}			
});

</script>';
echo  $advance_login_style_admin_pages->selectimage('Login_logo_Image','Select Logo', '', 'buttonid', 'upload_logo_preview'); 
echo "<br/>";

echo $advance_login_style_admin_pages->inputnumber('background_size', 'Background size'  ,'', 'px');
echo "<br/>";
echo $advance_login_style_admin_pages->inputnumber('logo_height', 'Height'  ,'', 'px');
echo "<br/>";

echo $advance_login_style_admin_pages->inputnumber('logo_width', 'Width'  ,'', 'px');
echo "<br/>";

echo $advance_login_style_admin_pages->select('logo_logo__repeat', 'Repeat Background',array('no-repeat'=>'no-repeat','repeat'=>'repeat','x-repeat'=>'x-repeat','y-repeat'=>'y-repeat'));
//echo $advance_login_style_admin_pages->select('logo_position', 'Background Position',array('left'=>'left','right'=>'right','top'=>'top','center'=>'center'));
echo "<hr>";

echo "<h4>Text Logo</h4>";

echo $advance_login_style_admin_pages->textinput('text_logo', 'Enter Yout Logo Name');
echo "<br/>";

echo $advance_login_style_admin_pages->textinput('text_logo_font_color','Font Text Color');
echo "<br/>";

echo $advance_login_style_admin_pages->inputnumber('text_logo_font_color', 'Logo Font Size'  ,'', 'px');
echo "<br/>";



$advance_login_style_admin_pages->admin_footer();


