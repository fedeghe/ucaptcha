<?php
include("../ucaptcha/ucaptcha.class.php");
/*
 * That cognitive filter permits You to make the guess string limited to a
 * subset of characters (based on charsets) so you could show a string with
 * numbers, lowercase, uppercase and symbols and ask the user to enter only
 * the numbers he recognoises or even the lowercase letters or only the
 * symbols.
 * 
 * Look at the 'guess_set' parameter, it implies that only numbers will
 * compose the target string.
 * 
 */

$setting = array(	
	'colors' => array('bg' => '000000','text'=>'srand', 'lines'=>'srand'),
	
	'string' => array(
		'char_set' => 10,
		'lenght'=>6,
		'fontsize'=>array(30,50),
		'srotate'=>array(-20,20),
		'font'=>'Candice.ttf',
		'guess_set'=>2  //######### ASK FOR NUMBERS ##############//
	),
	'operations' => array(
		'lines',
		'text',
		'wave_1',
		'wave_2',
		'convolve'=>array('gauss')
	),
	
	// Which NUMBERS u see ?
	//
	 // target only numbers, use the same rule used for charSet
	//
	// so in that case
	// THE USERS WILL BE EXPLICITLY CALLED TO RECOGNOISE AND TYPE ONLY NUMBERS
	// 
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
