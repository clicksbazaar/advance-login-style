<?php


//$option= get_test_structure_options();
//echo $bkcolor=$option[bckcolor];
$options12 = get_option( 'advance_login_style' );
print_r($options1 = get_option( 'advance_login_style_logo' ));
echo $options1['Login_logo_Image'];
add_action('login_enqueue_scripts', 'custom_login_style');
function custom_login_style()
{
	echo '<link rel="stylesheet" type="text/css" href="' . plugins_url('../css/people.css', __FILE__) . '" />';
		if ( is_rtl() ) {
			echo '<link rel="stylesheet" type="text/css" href="' . plugins_url('../css/rtl.css', __FILE__) . '" />';
		}
}

add_action('login_enqueue_scripts', 'custom_login_logo');
function custom_login_logo()
{
?>
		<?php
		  // $plugin_bazaar_options = get_option('theme_blue_options');
    $plugin_bazaar_options = $options1['Login_logo_Image'];
    if ($plugin_bazaar_options['logo'] != '') {
        $img_url = $plugin_bazaar_options['logo'];
        function get_attachment_id_from_url($attachment_url)
        {           
            global $wpdb;
            $attachment_id = false;
            // If there is no url, return.
            if ('' == $attachment_url)
                return;
            // Get the upload directory paths
            $upload_dir_paths = wp_upload_dir();
            // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
            if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
                // If this is the URL of an auto-generated thumbnail, get the URL of the original image
                $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
                // Remove the upload path base directory from the attachment URL
                $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
                // Finally, run a custom database query to get the attachment ID from the modified attachment URL
                $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
                
            }
            
            return $attachment_id;
        }
        $imgwidth         = get_attachment_id_from_url($img_url);
        $image_attributes = wp_get_attachment_image_src($imgwidth,'full');
        $width            = $image_attributes[1];
        $height           = $image_attributes[2];
        
    } else {
        $plugin_bazaar_options['logo'] = plugins_url('../images/Blue-Login-Logo.png', __FILE__);
        $width                = 250;
        $height               = 63;
    }
?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php
    echo $plugin_bazaar_options['logo'];
?>);
			height:<?php
    echo $height;
?>px;
			width:<?php
    echo $width;
?>px;
			background-size:auto;
			margin-top:10px;
			margin-left: auto;
			margin-right: auto;
			padding-bottom:10px;
        }
    </style>
	<?php
}

add_action('login_headerurl', 'plugins_bazaar_login_url',9999);
function plugins_bazaar_login_url()
{
	return home_url();
}

add_filter('login_headertitle', 'plugins_bazaar_login_text',9999);
function plugins_bazaar_login_text()
{
	return get_bloginfo();
}

add_action('login_head', 'my_login_head');
function my_login_head() {
	$options = get_option('default_style');
	if ($options == "DarkLight"){
	remove_action('login_head', 'wp_shake_js', 12);
	}
}
add_filter( 'login_message', 'the_login_message' );
function the_login_message( $message ) {
    if ( empty($message) ){
		$options =$options12['bgheight'];
			if ( !empty($options) ){
			return "<p class='message'>" . $options ."<br></p>";
			}
    } else {
        return $message;
    }
}
add_filter( 'login_redirect', 'plugins_bazaar_login_redirect' );
function plugins_bazaar_login_redirect() {
	$options = get_option('login_redirect');
	if ( !empty($options) ){
    // Change this to the url to Updates page.
    return $options;
	}
	else return admin_url();
}

add_filter( 'registration_redirect', 'plugins_bazaar_registration_redirect' );
function plugins_bazaar_registration_redirect() {
	$options = get_option('register_redirect');
	if ( !empty($options) ){
    // Change this to the url to Updates page.
    return $options;
	}
} 
 
//add_action( 'init', 'plugins_bazaar_loggedout_redirect' );
function plugins_bazaar_loggedout_redirect() {
	$options = get_option('logout_redirect');
	if ( !empty($options) ){
	if( isset($_GET['loggedout']) == 'true' ) {
		$redirect_link=$options;
		wp_redirect($redirect_link);
		exit;
 
	}
	}
	else return wp_login_url();
}

?>