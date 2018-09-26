<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'bg' => '000000',
		'text'=>'rand',
		'grind'=>'333333'	// grind lines will be darkgray
	),
	'operations' => array(
		'grind'=>array(6),
		'text',
		'breeze'=>array(2) // how many px
	)	
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
