<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => 'ff0000',
		'bg' => '000000',
		'lines'=>'rand'
	),
	'operations' => array(
		'grind',
		'text',		
		'convolve'=>array('detect_vlines'),
	),
	'dimensions'=>array(
		'height'=>80,
		'width'=>250
	)
);
$uc = new ucaptcha($setting);
$uc->drawImage();
