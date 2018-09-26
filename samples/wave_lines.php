<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'text' => '000000',//text will be white
		'lines'=>'rand', // lines will have random color
		'bg'=>'000000' //background will be black
	),
	'nums'=>array(
		'lines'=>500 // trace 500 lines (the limit rules)
	),
	'string' => array(		
		'lenght' => 4,//use only 4 chars
		'char_set' => 30, //numbers+uppercase+lowercase (2*3*5)
		'fontsize'=>40,
		'rotate'=>array(-5,5)
	),
	
	// list of operations to apply 
	'operations' => array(
		'lines', // trace lines
		'text', // draw text
		'wave', // wave effect
		'convolve'=>array('gauss') // blur filter
	),
	'height'=>80, // edit image height
	'width'=>250, // edit image width
);
// obtain a new instance, passing init_arr and draw the image
$uc = new ucaptcha($setting);  
$uc->drawImage();
