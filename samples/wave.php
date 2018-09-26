<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'bg' => 'rand',
		'text'=>'srand',
		'grind'=>'333333'
	),
	'string'=>array(
		'char_set' => 5,
		'font'=>array('Candice.ttf','Duality.ttf','Jura.ttf','adventure.ttf'),
		'fontsize'=>50
	),
	'operations' => array(
		'text',
		'wave_1',	  // doing that You can apply
		'wave_werw',   // an effect as many times
		'wave_ccc1111' // as You want
	)	
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
