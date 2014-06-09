<?php
/**
* This function will enque our script to login page.
*
*/
			

function advance_login_style_enque_script(){
	//wp_enqueue_style( 'advance_login_style_plugin_tools', advance_login_style_URL . 'css/advance_login_style_plugin_tools.css', advance_login_style_VERSION );
	$options=get_advance_login_style_options();
	$css_login_form='#login form {';
	if(isset($options['Login_form1_Background_Clore']))
	{
	 $css_login_form.='background-color:'.$options['Login_form1_Background_Clore'].';';
	}
	if(isset($options['form_shadow']))
	{
 	  $css_login_form.='box-shadow:'.$options['form_shadow'].''.$options['Login_form1_Box_shadow_Clore'].';';
	}
	if(isset($options['Login_form_Background_Image']))
	{
	$css_login_form.='background-image:url('.$options['Login_form_Background_Image'].');';
	}
	if(isset($options['form_position']))
	{
	  $css_login_form.='background-position:'.$options['form_position'].';';
	}
	
	if(isset($options['form_background_repeat']))
	{
	 $css_login_form.='background-repeat:'.$options['form_background_repeat'].';';

	}
	
	if(isset($options['form_border_size']))
	{
	  $css_login_form.='border:'.$options['form_border_size'].'px solid '.$options['Login_form1_Background_border_Clore'].';';
	}
	if(isset($options['form_border_radius']))
	{
	  $css_login_form.='border-radius:'.$options['form_border_radius']. 'px;';
	}
	$css_login_form.="}";
	$css_login_form_label='.login label{';
if(isset($options['Login_form1_Background_lebel_Clore']))
	{
	$css_login_form_label.='color:'.$options['Login_form1_Background_lebel_Clore'].';';
	$css_login_form_label.='font-size:'.$options['form_lebal_font_size'].'px;';
	}
	
	$css_login_form_label.="}";
	
	
	$button='.wp-core-ui .button-primary{';
if(isset($options['button_color']))
	{
	 $button.='background-color:'.$options['button_color'].';';
	 $button.='color:'.$options['button_text_color'].';';
	 $button.='border-color:'.$options['button_border_color'].';';

	}
	
	$button.="}";
	
	$button_onhover='.wp-core-ui .button-primary:hover{';
if(isset($options['button_color']))
	{
	 $button_onhover.='background-color:'.$options['onhover_button_color'].';';
	 //$button.='color:'.$options['button_text_color'].';';
	// $button.='border-color:'.$options['button_border_color'].';';

	}
	 
	$button_onhover.="}";
	
	
	$logo='.login h1 a {';
	if(isset($options['Login_logo_Image']))
					  {
	 $logo.='background-image:url('.$options['Login_logo_Image'].') !important;';
						  
					  }
					  if(isset($options['logo_height']))
					  {
	 $logo.='height:'.$options['logo_height'].'px !important;';
						  
					  }
					  if(isset($options['logo_width']))
					  {
	 $logo.='width:'.$options['logo_width'].'px !important;';
						  
					  }
					  
					  if(isset($options['background_size']))
					  {
	 $logo.='background-size:'.$options['background_size'].'px '.$options['background_size'].'px;';
					  }
					 if(isset($options['logo_logo__repeat']))
					  {	
 	$logo.='background-repeat:'.$options['logo_logo__repeat'].';';
					  }  
	
	$logo.="}";
	
	$body='body, html {';
	if(isset($options['Login_Background_Image']))
					  {
	 $body.='background-image:url('.$options['Login_Background_Image'].') !important;';
						  
					  }
					   if(isset($options['background_repeat']))
					  {	
 	$body.='background-repeat:'.$options['background_repeat'].';';
					  } 
	 
	  if(isset($options['Login_Background_Clore']))
					  {	
	 $body.='background-color:'.$options['Login_Background_Clore'].';';
					  } 

				if(isset($options['position']))
					  {	
	 $body.='background-position:'.$options['position'].';';
					  } 
					  
					  if(isset($options['bgheight']))
					  {	
	 $body.='background-size:'.$options['bgheight'].'px;'.$options['bgwidth'].'px;';
					  } 
	
	$body.="}";
	
	
	$bodylink='.login #nav a{';
if(isset($options['link_text_color']))
	{
	// $button.='background-color:'.$options['button_color'].';';
	 $bodylink.='color:'.$options['link_text_color'].';';
	// $button.='border-color:'.$options['button_border_color'].';';

	}
	
	$bodylink.="}";
	
	$bodylink1='.login #backtoblog a, .login #nav a{';
if(isset($options['link_text_color']))
	{
	// $button.='background-color:'.$options['button_color'].';';
	 $bodylink1.='color:'.$options['link_text_color'].';';
	// $button.='border-color:'.$options['button_border_color'].';';

	}
	
	$bodylink1.="}";

		$advance_textlogo='.textlogo{';
			if(isset($options['text_logo_font_color']))
			{
			echo 	 $advance_textlogo.='color:'.$options['text_logo_font_color'].';';
			}
			if(isset($options['text_logo_font_size']))
			{
			echo 	 $advance_textlogo.='font-size:'.$options['text_logo_font_size'].';';
			
			}		
			$advance_textlogo.="}";

	
	//var_dump($options);
	$css="#loginform label {
	.login #backtoblog a, .login #nav a
	height: 500px !important;
	width: 500px !important;
	background-image: url('http://localhost/prakash/wp-content/uploads/2014/05/images1.jpg');
	background-position: right center;
	background-repeat: repeat;
	
	-webkit-background-size: contain;
	-moz-background-size: contain;
	-ms-background-size: contain;
	-o-background-size: contain;
	background-size: contain;
	}
";
	echo '<style type="text/css">'.$css_login_form.''.$css_login_form_label.''.$button.''.$button_onhover.''.$logo.''.$body.''.$bodylink.''.$bodylink1.''.$advance_textlogo.'</style>';

}
add_filter( 'login_message', 'the_advance_login_style_message' );
function the_advance_login_style_message( $message ) {
    if ( empty($message) ){
		$options=get_option( 'advance_login_style_logo' );
if ( !empty($options['text_logo']) ){
			return "<p class='advance_textlogo' >" . $options['text_logo'] ."<br></p>";
			}
    } else {
        return $message;
    }
}


add_action( 'init', 'advance_login_style_redirect' );
function advance_login_style_redirect() {
	$options=get_advance_login_style_options();
	$options= $options['After_Logout_Redirect_Link'];
	if ( !empty($options) ){
	if( isset($_GET['loggedout']) == 'true' ) {
		$redirect_link=$options;
		wp_redirect($redirect_link);
		exit;
 
	}
	}
	else return wp_login_url();
}

add_filter( 'registration_redirect', 'advance_login_style_registration_redirect' );
function advance_login_style_registration_redirect() {
$options=get_advance_login_style_options();
	$options= $options['After_Logout_Redirect_Link'];	if ( !empty($options) ){
    // Change this to the url to Updates page.
    return $options;
	}
} 
add_filter( 'login_redirect', 'advance_login_style_login_redirect' );
function advance_login_style_login_redirect() {
		$options=get_advance_login_style_options();
	$options= $options['After_Login_Redirect_Link'];
	if ( !empty($options) ){
    // Change this to the url to Updates page.
    return $options;
	}
	else return admin_url();
}

add_action( 'login_enqueue_scripts', 'advance_login_style_enque_script', 1 );

