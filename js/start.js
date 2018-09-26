window.onload = function(){
	document.getElementById('prova').focus();
	document.getElementById('captcha').onclick = function(){
		document.getElementById('prova').value='';
		this.src = '../ucaptcha/spinner.gif';
		var rand = Math.random();
		base = '../captcha/<?php echo $fname; ?>.php';
		//var pers = 'rep[color][bg]=000000';
		this.src = base+'?'+rand;
	}
}