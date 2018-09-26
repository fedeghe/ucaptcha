<?php
include("../ucaptcha/ucaptcha.class.php");

$init_arr = array(
	'color' => array(
		'text' => 'rand',
		'bg' => '000000',
		'lines' => 'rand',
		'dots' => 'rand',
		'circles'=>'rand',
		'grind'=>'rand',
		'chessboard_0'=>'000000',
		'chessboard_1'=>'rand',
		'functions'=>'ffffff',
		'randchars'=>'rand',
		'polygons'=>'rand'
	),
	'string' => array(
		'lenght' => 10,
		'char_set' => 5,
		'font'=>'verdana.ttf',
		'fontsize'=>30,
		'rotate'=>array(-5,5)
	),
	'num'=>array(
		'dots' => 500,
		//'lines' => 20,
		'circles'=>50,
		'polygons'=>20,
		//'grind_px'=>10
	),
	'operations' => array(
		
		
		
		'chessboard'=>array(2),
		'dots'=>array(5),
		//
	//	'grind'=>array(8),
		//'grind',
		//'polygons'=>array(false,true),
		//'breeze'=>array(10),
	//	'cos'=>array(0.1),
	//	'circles'=>array(false,true),
	//	'randchars'=>array(100,50,true),
	//	'text',
		
		//'text',
		
		'text',
		//'breeze'=>array(1),
		
	//	'lines',
	//	'dots'=>array(10),
		
	//	'text',
//		'breeze'=>array(2),
//
		//'text',
		//'breeze'=>array(1),
		//'text'=>array('red',true),  //qui si puo solo usare uno dei colori preimpostati
		//'text'=>array('blue',true),  //qui si puo solo usare uno dei colori preimpostati
		//'text'=>array(false,true),
//		'sin'=>array(0.1),
		
		//'grind',
	//	'convolve'=>array('sharp'),
		
//'wave',
//'warp',
	//	'text'=>array(false,true),
		
		/*
		'convolve'=>array(
			//matrice
			array(
				array(0,10,0),
				array(10,1,-10),
				array(0,10,0)
			)
		),
		*/
		
		//'shear'=>array(-0.2),

		'logo'=>array('d_l')
			
	),
	//'height'=>80,
	//'width'=>250,
	'logo'=>'../captcha/webfgk.gif' 
);

$uc = new ucaptcha($init_arr);
  
$uc->drawImage();

/*
 * blur1
 * blur2
 * blur3
 * detect_hlines
 * detect_vlines
 * detect_45lines
 * detect_135lines
 * detect_edges
 * sobel_horiz
 * detect_edges
 * laplace_op
 * laplace_op_diag
 * emboss
 * gauss
 */
