<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors'=> array(
		'bg'=> (rand()%2 == 0)?'noise':'cnoise'
	),
	'string' => array(
		'char_set' => 30
	),
	'operations' => array(
		'text'
	)
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
