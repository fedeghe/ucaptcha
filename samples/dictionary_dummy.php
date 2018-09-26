<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>32
	),
	'colors' => array(
		'text' => '333333', // text color will be white
		'bg' => '333333' ,// and background black
		'lines'=>'rand'
	),
	'nums'=>array(
		'lines'=>350
	),
	// list of operations to apply 
	'operations' => array(
		'lines',
		'dtext',
		'warp',
		'convolve'=>array('gauss')
	),
	'dimensions'=>array(
		'height'=>80,
		'width'=>250
	)
);
// obtain a new instance, passing init_arr and draw the image
$uc = new ucaptcha($setting);  
$uc->drawImage();
