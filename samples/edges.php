<?php
include("../ucaptcha/ucaptcha.class.php");

$init_arr = array(
	'string'=>array(
		'fontsize'=>40
	),
	'colors' => array(
		'text' => '0f0',
		'bg' => '000',
		'lines'=>'#fff'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'text',		
		'convolve'=>array('edges'),
	)
);

$uc = new ucaptcha($init_arr);
$uc->drawImage();
