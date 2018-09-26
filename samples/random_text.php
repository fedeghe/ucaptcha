<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string' => array(
		/* 2 for numbers
		 * 3 for uppercase
		 * 5 for lowercase
		 * 7 for symbols
		 * any product for a combination
		 */
		'char_set' => 30,// numbers, lowercase and uppercase 2*3*5
		'spacer'=>10     // space between letters (default 5px)
	),
	//'colors'=>array('text'=>'rand'),
	'operations' => array('text') //simply draw a random text
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
