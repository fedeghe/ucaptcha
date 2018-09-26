<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' =>'ff0000',
		'bg' =>  '#000000',
		'lines'=>'#fff'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),	
		'grind',
		'text',		
		'convolve'=>array('sobel_horiz'),
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
