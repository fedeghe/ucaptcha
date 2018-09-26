<?php
include("../ucaptcha/ucaptcha.class.php");

// this class is used as callback object just to specify your functions
class funcs{
	public static function x($t){ return (149)*sin($t/3	); }
	public static function y($t){ return (49)*cos($t); }	
	public static function   r($t){ return $t/15; }
	public static function rho($t){ return $t/20; }
	public static function fx($x){ return 4*log(abs($x)	); }
	public static function fx2($x){ return -8*log(abs($x)	); }
}

$setting = array(
	'string'=>array(
		'fontsize'=>30
	),
	'colors' => array(
		'bg' => '555555',
		'text'=>'rand',
		'functions'=>'rand'	// functions will be traced with random color,
							// try 'srand' for randomize every segment
	),
	'operations' => array(
		'func'=>array(		// esplicit
			array('funcs','fx'),//
			range(-200, 200)    //
		),
		'tfunc'=>array(			// parametric 
			array('funcs', 'x'),// x function
			array('funcs', 'y'),// y function
			range(0, 1000),		// t range
			true				// join dots ?
		),
		'pfunc'=>array(			  // polar 
			array('funcs', 'r'),  // radius function
			array('funcs', 'rho'),// angle function
			range(0, 29000),	  // t range
			true                  // join dots ?
		),
		
		'dtext'
	)
);
$uc = new ucaptcha($setting);  
$uc->drawImage();
