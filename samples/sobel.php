<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => '#f00',
		'bg' => '000000',
		'lines'=>'fff'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'text',		
		'convolve'=>array('sobel'),
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
