<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'bg' => '000000',
		'text'=>'rand',
		'grind'=>'333333'
	),
	'operations' => array(
		'grind_1'=>array(20),
		'text',
		'rotate'=>array(-40,40),
		'grind_2'=>array(5)
	)	
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
