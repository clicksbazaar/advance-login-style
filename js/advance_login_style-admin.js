/** 
* @desc jQuery function to hide and show theme select options on theme testing enable or disable.
*/
jQuery(document).ready(function () {
	jQuery("#enable_wpabtheme").change(function() {
		if (jQuery("#enable_wpabtheme").is(':checked')) {
			jQuery("#themesselect").css("display","block");
		} else {
			jQuery("#themesselect").css("display","none");
		}
	}).change();	
});
