<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'text' => 'rand',
		'bg' => '000000',
		'circles'=>'rand'
	),
	'string' => array(
		'lenght' => 4,
		'char_set' => 14, //numbers & symbols
		'font'=>'verdana.ttf',
		'fontsize'=>40,
		'rotate'=>array(-5,5)
	),
	'operations' => array(		
		'circles_0'=>array(2,true),	// 2 circles filled
		'circles_1'=>array(4,false), // 4 not filled
		'text'			
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
