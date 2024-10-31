jQuery('.wpacp_pdel').click(function(){
	var pollid=jQuery(this).attr('alt');
	var r=confirm(wpacpadminL10n.delete_poll_confirm+pollid+' ?');
	if(r==true) {
		jQuery.post( wpacpadminL10n.delete_url , {'pollid' : pollid, '_ajax_nonce':wpacpadminL10n.ajn } , function(data){
			jQuery('#poll-'+pollid).remove();
		});	
	}
	return false;
});
jQuery('.wpacp_export').click(function(){
	var pollid=jQuery(this).attr('alt');
	jQuery.get( wpacpadminL10n.export_url , {'pollid' : pollid, '_ajax_nonce':wpacpadminL10n.ajn } , function(data){
		document.location.href = wpacpadminL10n.export_url+'?pollid='+pollid;
	});	
		
	return false;
});