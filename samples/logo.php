<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'dimensions'=>array(
		'height'=>80,
		'width'=>350
	),
	'colors' => array(
		'text' => '000000',
		'bg' => 'dddddd'
	),
	'string' => array(
		'lenght' => 6,
		'char_set' => 5,
		'font'=>'verdana.ttf',
		'fontsize'=>30,
		'rotate'=>array(-5,5),
		'srotate'=>array(-50,50)
	),
	'operations' => array(
		'text',
		// down,center,top ; left,center,right
		'logo_1'=>array('../ucaptcha/webfgk.gif', 'd_r'), // down right
		'logo_2'=>array('../ucaptcha/webfgk.gif', 't_c'), // top center
		/*
		 * 'logo' is a bit special because is one of those operations done as last,
		 * no matter where they are written in this array, in fact, even strong
		 * filters do not modify your logo
		 */
		'convolve'=>array('detect_edges'), 
		'warp'
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
