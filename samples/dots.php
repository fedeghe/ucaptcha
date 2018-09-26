<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(	
	'dimensions'=>array(
		'height'=>80,
		'width'=>250
	),
	'colors' => array(
		'text' => 'f00',
		'bg' => '#555',
		'dots' => 'srand', // specify dots color
	),
	'string' => array(
		'lenght' => 100, // will be lowered to a limit 
		'char_set' => 7, // symbols
		'font'=>'verdana.ttf',
		'fontsize'=>30,
		'rotate'=>array(-5,5)
	),
	'nums'=>array('dots' => 500000), // even this will be lowered
	'operations' => array(
		'dots'=>array(5), // optional parameter, set the top radius
		                  // used for dots,
						  // the radius will be a random number
						  // between 1 and that number
		'text'			
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
