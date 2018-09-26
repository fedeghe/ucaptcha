<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	// set some color
	'colors' => array(
		'text' => 'ffffff', // text color will be white
		'bg' => 'eddddd' ,// and background black
	),
	'string' => array(		
		'char_set' => 10, //only numbers and lowercase
	),
	// list of operations to apply 
	'operations' => array(		
		//'text',//only draw text
		//'randchars',
		'text'
	)
);
// obtain a new instance, passing init_arr and draw the image
$uc = new ucaptcha($setting);  
$uc->drawImage();
