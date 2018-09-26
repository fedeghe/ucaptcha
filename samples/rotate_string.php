<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string' => array(
		'char_set' => 30,
		'rotate'=>array(-30, 30) /*### rotate the string in that range ###*/
	),
	'colors'=>array('text'=>'srand'),
	'operations' => array('text')
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
