<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => 'ff0000',
		'bg' => '000000',
		'lines'=>'ffffff',
		'randchars'=>'rand'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'randchars',
		'text',		
		'convolve'=>array('mean_removal'),
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
