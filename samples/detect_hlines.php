<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => 'ff0000',
		'bg' => '000000',
		'lines'=>'ffffff'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'grind',
		'text',		
		'convolve'=>array('detect_hlines'),
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
