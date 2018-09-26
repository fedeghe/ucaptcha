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
	
	'operations' => array(
		'lines',
		'text',		
		'convolve'=>array('blur2'),
	),
	'dimensions'=>array(
		'height'=>80,
		'width'=>250
	)
);
$uc = new ucaptcha($init_arr);
$uc->drawImage();
