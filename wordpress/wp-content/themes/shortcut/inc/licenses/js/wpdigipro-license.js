jQuery(document).ready(function(){
	jQuery("form[name='wpdigipro-licenses-form']").submit(function(e){
		e.preventDefault(); var licenseActive = jQuery(this).data('action');
		var license_key = jQuery("input[name='wpdigipro-license-key']").val();
		if(license_key!='') {
			var args = {'action':'wpdigipro_theme_license_action', 'license_action': licenseActive, 'license_key':license_key};
			jQuery.post(ajaxurl, args, function(response){
				if((response)&&(response!='')){
					var datas = JSON.parse(response);
					if(datas.status=='success') { 
						license_key = license_key.substr(0, 2)+'******************'+license_key.substr(-2); jQuery("#wpdigipro-license-key").val(license_key); window.location.reload();
					}
					else {
						jQuery("#wpdigipro-licenses-form .wpdigirpo-license-message").html('<p class="wpdigipro-error">'+datas.message+'</p>');
						jQuery("form[name='wpdigipro-licenses-form']").data('action', 'active');
						jQuery("button[name='license-action']").html('Activate'); jQuery("#wpdigipro-license-key").removeAttr('readonly');
					}
				}
			});
		}
	});
});