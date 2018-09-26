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
		'text',		
		'convolve'=>array('laplace_emboss'),
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
