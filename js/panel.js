jQuery(function(){
	
	jQuery('input[name=text_source]').bind('change',function(){
		if(jQuery('#dtext:checked').length){
			jQuery('#charset_switch').fadeOut();
		}else{
			jQuery('#charset_switch').fadeIn();
		}
	});
	
	
	
	jQuery('#add_effect').bind('click',function(){
		var eff = jQuery('#adding_effect').val();
		if(eff !== ''){
			jQuery('#noises_list').append('<li>'+eff+'</li>');
		}
	});
	
	jQuery("#noises_list").sortable({
		opacity: 0.6,
		cursor: 'move',
		update: function() {
			var order = jQuery(this).sortable("toArray"); 
			console.debug(order); 															 
		}								  
	});
	
	
});