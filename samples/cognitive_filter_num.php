<?php
include("../ucaptcha/ucaptcha.class.php");
/*
 * That filter works quite like the previous one but the only difference
 * is that passing a 'guess_set_num' value the user will have to give
 * as response the number of elements corresponding to the subset
 */

$setting = array(	
	'colors' => array('bg' => '000000', 'text'=>'srand', 'lines'=>'srand'),
	'string' => array(
		'char_set' => 10,
		'lenght'=>6,
		'fontsize'=>50,
		'guess_set_num'=>5  //######### ASK FOR LOWERCASE LETTERS ##############//
	),
	'operations' => array(
		'lines',
		'text',
		'wave_1',
		'wave_2',
		'convolve'=>array('gauss')
	),
	
	// How many LOWERCASE letters U see ? 
	//
	 // target only numbers, use the same rule used for charSet
	//
	// so in that case
	// THE USERS WILL BE EXPLICITLY CALLED TO RECOGNOISE ONLY LOWERCASE LETTERS
	// AND COUNT THEM
	// the SUM will be the RIGHT response
	// 
);

$uc = new ucaptcha($setting);  
$uc->drawImage();
