<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'string' => array(
		'char_set' => 30,
		'srotate'=>array(-40, 40), /** rotate randomly each letter
								  *   in that range
		                          **/
		
		'font'=>array(       // 
			'Candice.ttf',   // every letter will 
			'Duality.ttf',   // use one of theese
			'Jura.ttf',      // fontfile, randomly
			'adventure.ttf'  // 
		),
		'fontsize'=>array(20,40) // fontsize will vary in that range
	),
	'colors'=>array('text'=>'srand'),
	'operations' => array('text')
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
