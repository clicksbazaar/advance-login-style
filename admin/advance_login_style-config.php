<?php
/**
 * @package Admin
 */
if ( !class_exists( 'advance_login_style_Admin_Pages' ) ) 
{
/**
 * Class that holds most of the admin page functionality for WP AB Theme Testing Plugin.
 */
class advance_login_style_Admin_Pages 
{

	/**
	* Current options value.
	* @var String.
	*/
	var $currentoption = 'advance_login_style';
	
	/**
	* Array of admin pages.
	* @var Array.
	*/
	var $adminpages = array( 'advance_login_style_dashboard');
	
	/** 
	* @desc constructor of advance_login_style_Admin_Pages class 
	*/
	function __construct() {
	
		add_action( 'init', array( $this, 'init' ), 20 );
	}
	
	/** 
	* @desc callback function for on class initilizaiton .
	* @param 
	* @return 
	*/
	function init() {
		
		$this->adminpages = apply_filters( 'advance_login_style_admin_pages', $this->adminpages );

		global $advance_login_style_admin;

		if ( $advance_login_style_admin->grant_access() ) {
			
			add_action( 'admin_enqueue_scripts', array( $this, 'config_page_scripts' ) );
		}
	}
	
	/** 
	* @desc Function to display header for setting page .
	* @param	String	$title	Header title
	* @param	Boolean	$form	Is form or note
	* @param	String	$option	option name
	* @param	String	$optionshort	option 
	* @param	Boolean $contains_files	Is contains files or note
	* @return 
	*/
	function admin_header( $title, $form = true, $option = 'cb_advance_login_style_options', $optionshort = 'advance_login_style', $contains_files = false ) {
	?>
	
	<div id="content">
	
		<div class="box span12">
		<div class="box-header well" data-original-title="">
		ADVANCED LOGIN STYLE		<?php 
		if ( ( isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ) || ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) ) {
			$msg = __( 'Settings updated', 'advance-login-style' );
			echo ': <strong>' . esc_html( $msg ) . '</strong>';
		}
		?>
		</div>
		<div style="padding:5px 10px 0px 10px;">
		<?php
		if ( $form ) {
			echo '<form   action="' . admin_url( 'options.php' ) . '" method="post" ' . ( $contains_files ? ' enctype="multipart/form-data"' : '' ) . '>';
				
			settings_fields( $option );
			$this->currentoption = $optionshort;
		}

	}
	
	/** 
	* @desc Function to display footer for setting page .
	* @param Boolean $submit	True for show submit button
	* @return 
	*/
	function admin_footer( $submit = true ) {
		if ( $submit ) {
			?>
			<div style="text-align:center; margin: 10px;">
			
			<input type="submit" class="button-primary" name="submit" value="<?php _e( "Save Settings", 'advance_login_style' ); ?>"/>
			
			</div>
		<?php 
		} 
		?>
		</form>
		</div>
		</div>
	</div>
	<?php
	}
	
	/** 
	* @desc callback function for admin_enqueue_scripts.
	* @param none	
	* @return none
	*/
	function config_page_scripts() {
		global $pagenow;
		
		
			wp_enqueue_style( 'advance_login_style_plugin_tools', advance_login_style_URL . 'css/advance_login_style_plugin_tools.css', advance_login_style_VERSION );
	
			//wp_enqueue_script( 'advance_login_style-admin-script', advance_login_style_URL . 'js/advance_login_style-admin.js');
			
			/* color picker enqueue */
			    wp_enqueue_script('wp-color-picker');
        wp_enqueue_style( 'wp-color-picker' );
		
		
		/* media upload enqueue */
		
		wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
	 wp_enqueue_style('thickbox');
		
	}
	
	/** 
	* @desc Function to return option
	* @param String $option Option name
	* @return return option 
	*/
	function get_option( $option ) {
		if ( function_exists( 'is_network_admin' ) && is_network_admin() )
			return get_site_option( $option );
		else
			return get_option( $option );
	} 

	/** 
	* @desc Function to create checkbox
	* @param	String	$var	Variable name
	* @param	String	$label	Label for checkbox
	* @param	Boolean	$label_left	True for label left on checkbox
	* @param	Array	$option	Options array
	* @return return checkbox 
	*/
	function checkbox( $var, $label, $label_left = false, $option = '' ) {
		if ( empty( $option ) )
			$option = $this->currentoption;

		$options = $this->get_option( $option );
$label=__($label,'advance-login-style');
		if ( !isset( $options[$var] ) )
			$options[$var] = false;

		if ( $options[$var] === true )
			$options[$var] = 'on';

		if ( $label_left !== false ) {
			if ( !empty( $label_left ) )
				$label_left .= ':';
			$output_label = '<label class="checkbox" for="' . esc_attr( $var ) . '">' . $label_left . '</label>';
			$class        = 'checkbox';
		} else {
			$output_label = '<label for="' . esc_attr( $var ) . '">' . $label . '</label>';
			$class        = 'checkbox double';
		}

		$output_input = "<input class='$class' type='checkbox' id='" . esc_attr( $var ) . "' name='" . esc_attr( $option ) . "[" . esc_attr( $var ) . "]' " . checked( $options[$var], 'on', false ) . '/>';

		if ( $label_left !== false ) {
			$output = $output_label . $output_input . '<label class="checkbox" for="' . esc_attr( $var ) . '">' . $label . '</label>';
		} else {
			$output = $output_input . $output_label;
		}
		return $output . '<br class="clear" />';
	}

	/** 
	* @desc Function to create Textarea 
	* @param	String	$var	Variable name
	* @param	String	$label	Label for textarea
	* @param	String	$class	custom css class for textarea
	* @param	Array	$option	Options array
	* @return return textarea
	*/
	function textarea( $var, $label, $option = '', $class = '' ) {
		if ( empty( $option ) )
			$option = $this->currentoption;
			$label=__($label,'advance-login-style');
		$options = $this->get_option( $option );

		$val = '';
		if ( isset( $options[$var] ) )
			$val = esc_attr( $options[$var] );


		return '<label class="textinput" for="' . esc_attr( $var ) . '">' . esc_html( $label ) . ':</label><textarea class="textinput ' . $class . '" id="' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']">' . $val . '</textarea>' . '<br class="clear" />';
	}
	
	/** 
	* @desc Function to create hidden field 
	* @param	String	$var	Variable name
	* @param	Array	$option	Options array
	* @return return textarea
	*/
	function hidden( $var, $label, $option = '' ) {
		if ( empty( $option ) )
			$option = $this->currentoption;
		$label=__($label,'advance-login-style');
		$options = $this->get_option( $option );

		$val = '';
		if ( isset( $options[$var] ) )
			$val = esc_attr( $options[$var] );

		return '<input type="hidden" id="hidden_' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']" value="' . $val . '"/>';
	}
	


	function button( $var, $label, $option = '' ) {
		if ( empty( $option ) )
			$option = $this->currentoption;
		$label=__($label,'advance-login-style');
		$options = $this->get_option( $option );

		$val = '';
		if ( isset( $options[$var] ) )
			$val = esc_attr( $options[$var] );

		return ' <label  for="' . esc_attr( $var ) . '">' . esc_html( $label ) . ':</label><input type="button" id="hidden_' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']" value="upload"/>';
	}
	
	
	function imageprivew( $var, $label, $option = '', $divid='' ) {
		if ( empty( $option ) )
			$option = $this->currentoption;
$label=__($label,'advance-login-style');
		$options = $this->get_option( $option );

		$val = '';
		if ( isset( $options[$var] ) )
			$val = esc_attr( $options[$var] );

		return ' <label  >' . esc_html( $label ) . ':</label><div id="' . esc_attr( $divid ) . '"><img src= "'.$val.'"  /></div>';
	}
	
function selectimage( $var, $label, $option = '', $buttonid, $divid ) {
if ( empty( $option ) )
$option = $this->currentoption;
$label=__($label,'advance-login-style');
$options = $this->get_option( $option );

$val = '';
if ( isset( $options[$var] ) )
$val = esc_attr( $options[$var] );

return '<label class="textinput" for="' . esc_attr( $var ) . '">' . $label . ':</label><input class="textinput" type="text" id="' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']" value="' . $val . '"/> <input type="button" id="'. esc_attr( $buttonid ).'" value="'.$label.'">' . '<div id="' . esc_attr( $divid ) . '"><img src= "'.$val.'"  /></div><br class="clear" />';
}
	/**
	 * Create a Select multiple Box.
	 *
	 * @param string $var    The variable within the option to create the select for.
	 * @param string $label  The label to show for the variable.
	 * @param array  $values The select options to choose from.
	 * @param string $option The option the variable belongs to.
	 * @return string
	*/
	function selectmulti( $var, $label,$values, $option = '' ) {
	$arr=array();
	$options=array();
		if ( empty( $option ) )
			$option = $this->currentoption;
			$label=__($label,'advance-login-style');
		 $arr=$this->get_option( $option);
		if(isset($arr[$var]))
		 $options=$arr[$var];
		 

		$var_esc = esc_attr( $var );
		$opti='';	
			foreach ($values as $category) {
			$tname= explode('|', $category);
				if(!empty($options)){
				if (in_array($category, $options)) 
					{
					$opti.="<option  selected=selected value=$category>";
					$opti.=ucfirst($tname[0]);
					$opti.='</option>';
					}else
					{
					$opti .= "<option value=$category>";
					$opti .= ucfirst($tname[0]);
					$opti .= '</option>';
					}
				}
					else
					{
					$opti .= "<option value=$category>";
					$opti .= ucfirst($tname[0]);
					$opti .= '</option>';
					}
	    }
		return '<label class="select" for="' . $var_esc . '">' . $label . ':</label><select name="' . $option . '[' . $var_esc . '][]" id="wpab' . $var_esc . '" multiple="multiple">'.$opti.'</select>'.'<br class="clear"/>';
	}
	function textinput( $var, $label, $option = '', $placeholder='' )
	{
		if ( empty( $option ) )
			$option = $this->currentoption;
			$options = $this->get_option( $option );
			$label=__($label,'advance-login-style');
			$val = '';
				if ( isset( $options[$var] ) )
					$val = esc_attr( $options[$var] );
					return '<label class="textinput" for="' . esc_attr( $var ) . '">' . $label . ':</label><input placeholder="'.$placeholder.'" class="textinput" type="text" id="' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']" value="' . $val . '"/>' . '<br class="clear" />';
	}

	function inputnumber( $var, $label, $option = '', $rightlabel='' )
	{
		if ( empty( $option ) )
			$option = $this->currentoption;
			$options = $this->get_option( $option );
			$label=__($label,'advance-login-style');
			$val = '';
				if ( isset( $options[$var] ) )
					$val = esc_attr( $options[$var] );
					return '<label class="textinput" for="' . esc_attr( $var ) . '">' . $label . ':</label><input class="number" type="number" id="' . esc_attr( $var ) . '" name="' . $option . '[' . esc_attr( $var ) . ']" value="' . $val . '"/>'.$rightlabel . '<br class="clear" />';
	}

	function select( $var, $label, $values, $option = '' )
	{
		if ( empty( $option ) )
			$option = $this->currentoption;
			$options = $this->get_option( $option );
			$label=__($label,'advance-login-style');
			$var_esc = esc_attr( $var );
			$output  = '<label class="select" for="' . $var_esc . '">' . $label . ':</label>';
			$output .= '<select class="select" name="' . $option . '[' . $var_esc . ']" id="' . $var_esc . '">';
			foreach ( $values as $value => $label ) 
			{
			$sel = '';
				if ( isset( $options[$var] ) && $options[$var] == $value )
					$sel = 'selected="selected" ';

						if ( !empty( $label ) )
							$output .= '<option ' . $sel . 'value="' . esc_attr( $value ) . '">' . $label . '</option>';
			}
		$output .= '</select>';
		return $output . '<br class="clear"/>';
	}

	function file_upload( $var, $label, $option = '' )
	{
		if ( empty( $option ) )
			$option = $this->currentoption;
			$label=__($label,'advance-login-style');
			$options = $this->get_option( $option );
			$val = '';
				if ( isset( $options[$var] ) && strtolower( gettype( $options[$var] ) ) == 'array' ) {
					$val = $options[$var]['url'];
	}

	$var_esc = esc_attr( $var );
	$output  = '<label class="select" for="' . $var_esc . '">' . esc_html( $label ) . ':</label>';
	$output .= '<input type="file" value="' . $val . '" class="textinput" name="' . esc_attr( $option ) . '[' . $var_esc . ']" id="' . $var_esc . '"/>';

		if ( !empty( $options[$var] ) )
		{
			$output .= '<input class="hidden" type="hidden" id="' . $var_esc . '_file" name="fullseo_local[' . $var_esc . '][file]" value="' . esc_attr( $options[$var]['file'] ) . '"/>';
			$output .= '<input class="hidden" type="hidden" id="' . $var_esc . '_url" name="fullseo_local[' . $var_esc . '][url]" value="' . esc_attr( $options[$var]['url'] ) . '"/>';
			$output .= '<input class="hidden" type="hidden" id="' . $var_esc . '_type" name="fullseo_local[' . $var_esc . '][type]" value="' . esc_attr( $options[$var]['type'] ) . '"/>';
		}
			$output .= '<br class="clear"/>';

			return $output;
	}

	function radio( $var, $values, $label, $option = '' )
	{
		if ( empty( $option ) )
			$option = $this->currentoption;
			$options = $this->get_option( $option );
			$label=__($label,'advance-login-style');
			if ( !isset( $options[$var] ) )
				$options[$var] = false;
				$var_esc = esc_attr( $var );
				$output = '<div><label class="select">' . $label . ':</label>';
				foreach ( $values as $key => $value ) 
				{
					$key = esc_attr( $key );
					$output .= '<div><input type="radio" class="radio" id="' . $var_esc . '-' . $key . '" name="' . esc_attr( $option ) . '[' . $var_esc . ']" value="' . $key . '" ' . ( $options[$var] == $key ? ' checked="checked"' : '' ) . ' /> <label class="wpfullseo_radio" for="' . $var_esc . '-' . $key . '">' . esc_attr( $value ) . '</label></div>';
				}
					$output .= '</div>';
					return $output;
	}
} 

	global $advance_login_style_admin_pages;

	$advance_login_style_admin_pages = new advance_login_style_Admin_Pages();

	}