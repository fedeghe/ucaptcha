<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'text' => 'rand', // 'rand' for text will randomize the color		                   
		'bg' => 'rand'
	),
	'string' => array(
		//'charset' => 10,     here unuseful because we use a dictionary 
		'font'=>'times.ttf', // use another font file
		'fontsize' => 25
	),
	'operations' => array('dtext') , // 'dtext' will use one word catching
	                                 // it randomly from dictionary.txt file
);

$uc = new ucaptcha($setting);
$uc->drawImage();
