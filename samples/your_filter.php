<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'text' => 'ffffff',
		'bg' => '000000'
	),
	'operations' => array(
		'bgimage'=>array('../ucaptcha/lion3.jpg'),
		'text',
		'convolve'=>array(
			array(
				array(0,	0,	0),
				array(0,	2,	-1),
				array(0,	-1,	1)
			)
		)
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
