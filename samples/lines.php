<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'lines'=>'srand', // each line will have a random color
		'bg'=>'#000' 
	),
	'nums'=>array(
		'lines'=>700 // will be lowered to 500
	),
	'string' => array(		
		'lenght' => 4,//use only 4 chars
		'char_set' => 30,
		'fontsize'=>50, // increase textsize
		'font'=>'Candice.ttf',
		'rotate'=>array(-5,5)
	),
	'operations' => array(
		'lines', // trace lines
		'text'
	)
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
