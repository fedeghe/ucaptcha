<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(		
		'text' => 'dddddd',	
		'bg'=>'555555',
		'grind'=>'srand'
	),
	'string' => array(
		'lenght' => 6,
		'char_set' => 7,
		'font'=>'pristina.ttf',
		'fontsize'=>50,
		'rotate'=>array(-5,5)
	), 
	'operations' => array(
		'grind'=>array(5), // draw grind 5 pixel boxed
		'text'
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
