window.onload = function(){
	document.getElementById('prova').focus();
	document.getElementById('captcha').onclick = function(){
		document.getElementById('prova').value='';
		this.src = '../ucaptcha/spinner.gif';
		var rand = Math.random();
		base = '<?php echo $fname; ?>';
		this.src = base+'?'+rand;
	}
}
jQuery(function(){
	jQuery('#toggle_code').bind('click',
		function(){
			jQuery(this).blur();
			if(jQuery('#code').css('display') == 'block'){
				jQuery('#code').slideUp();
				jQuery('#toggle_code').attr('value', 'View image code again');
			}else{
				jQuery('#code').slideDown();
				jQuery('#toggle_code').attr('value', 'Hide image code');
			}
		}
	);
})