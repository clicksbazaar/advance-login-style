<?php
/**
 * This file is used to display setting page
 *
 * @package admin
 * @subpackage pages
 */ 
 
global $advance_login_style_admin_pages;
//var_dump($advance_login_style_admin_pages);
$options = get_option( 'advance_login_style' );

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
        $("#link_text_color").wpColorPicker();
        });             
        </script>';


echo $advance_login_style_admin_pages->admin_header( __( 'General Settings', 'advance_login_style' ), true, 'cb_advance_login_style_options', 'advance_login_style' );


//echo $advance_login_style_admin_pages->textarea('advance_login_style', 'Login Page Message');
echo $advance_login_style_admin_pages->textinput('After_Login_Redirect_Link', 'Login Redirect Link');
echo "<br/>";

echo $advance_login_style_admin_pages->textinput('After_Logout_Redirect_Link', 'Log Out Redirect Link');
echo "<br/>";

echo $advance_login_style_admin_pages->textinput('After_Register_Redirect_Link', 'Register Redirect Link');
echo "<br/>";


echo "</br>";

echo '<script type="text/ecmascript">
jQuery(document).ready(function($){
	$("#buttonid").click(function() {
		tb_show("Upload a logo","media-upload.php?referer=plugin-bazaar-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0", false);
		return false;
	});
	window.send_to_editor = function(html) {
		var image_url = $("img",html).attr("src");
		//alert(html);
		$("#Login_Background_Image").val(image_url);
		tb_remove();
		$("#upload_logo_preview img").attr("src",image_url);		
		$("#Login_Background_Image").trigger("click");		
	}			
});

</script>';
//echo $advance_login_style_admin_pages->button('button','Select Background');
//echo  $advance_login_style_admin_pages->textinput('Login_Background_Image','Slect Image'); 
echo  $advance_login_style_admin_pages->selectimage('Login_Background_Image','Select Image', '', 'buttonid', 'upload_logo_preview'); 
echo "<br/>";
echo $advance_login_style_admin_pages->inputnumber('bgheight', 'Background  Height' ,'', 'px');
echo "<br/>";

//echo "<p class='desc'>px</p>";
echo $advance_login_style_admin_pages->inputnumber('bgwidth', 'Background  Width', '', 'px');
echo "<br/>";



echo $advance_login_style_admin_pages->textinput('Login_Background_Clore','Background Color');
echo "<br/>";


echo $advance_login_style_admin_pages->select('background_repeat', 'Repeat Background',array('no-repeat'=>'no-repeat','repeat'=>'repeat','x-repeat'=>'x-repeat','y-repeat'=>'y-repeat'));
echo "<br/>";

echo $advance_login_style_admin_pages->select('position', 'Background Position',array('left top'=>'left top', 'left center'=>'left center','right center'=>'right center','right top'=>'right top','center botton'=>'center botton','center center'=>'center center'));
echo "<br/>";

echo $advance_login_style_admin_pages->textinput('link_text_color','Link Text Color');



//echo $advance_login_style_admin_pages->inputnumber('opacity', 'Opacity');

//echo "<input type='button' id='upload_image_button' value='select Image'>";
//echo "<div id='upload_logo_preview' style='min-height: 100px;'>		<img style='max-width:100%;' src='".$options['Login_Background_Image']."' />";
//echo  $advance_login_style_admin_pages->imageprivew('Login_Background_Image','Priview', '', 'upload_logo_preview'); 


///echo $advance_login_style_admin_pages->file_upload('logo', 'change logo');

//echo $advance_login_style_admin_pages->textarea('textarea', 'textarea');
//echo $advance_login_style_admin_pages->file_upload('logo', 'change logo');
//echo "<p class='desc'></p>";
$advance_login_style_admin_pages->admin_footer();


