<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string' => array(
		'char_set' => 30,
		'fontsize'=>60
	),
	'nums'=>array(
		'randchars'=>300
	),
	'colors'=>array(
		'randchars'=>'srand'
	),
	'operations' => array(
		'randchars',
		'text'
	)
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
