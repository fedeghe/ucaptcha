<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'text' => 'rand',
		'bg' => '000000',
		'polygons'=>'srand'
	),
	'string' => array(
		'lenght' => 3,
		'char_set' => 3,
		'font'=>'verdana.ttf',
		'fontsize'=>50,
		'rotate'=>array(-5,5)
	),
	'nums'=>array(
		'polygons'=>20
	),	
	'operations' => array(
		'polygons_0'=>array(2,true),// two filled 
		'polygons_1'=>array(4,false),// four unfilled
		'text'
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
