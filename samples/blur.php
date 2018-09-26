<?php
include("../ucaptcha/ucaptcha.class.php");
$init_arr = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => 'ff0000',
		'bg' => '000000',
		'lines'=>'rand'
	),
	//
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'text',		
		'convolve'=>array('blur0'),
	)
);
$uc = new ucaptcha($init_arr);
$uc->drawImage();
