<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string' => array(
		'char_set' => 30,// numbers, lowercase and uppercase 2*3*5
		'srotate'=>array(-40, 40),
		'rotate'=>array(-20, 20),
		'font'=>array('Candice.ttf','rage.ttf'),
	),
	'colors'=>array('text'=>'srand'),
	'operations' => array('text') //simply draw a random text
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
