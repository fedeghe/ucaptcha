<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>50
	),
	'colors' => array(
		'bg' => '000000',
		'text'=>'ff0000'
	),
	'operations' => array(
		'bgimage'=>array(
			'../ucaptcha/lion'.rand(1,4).'.jpg',
			array(20,20,150,150) // that area will be resampled into the
			//                      whole background so You may lose
			//                      definition
		),
		'text',
	)	
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
