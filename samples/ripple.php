<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'bg' => '000000',
		'text'=>'rand',
		'grind'=>'333333'
	),
	'operations' => array('grind'=>array(10), 'text', 'ripple')	
);
$uc = new ucaptcha($setting);  
$uc->drawImage();
