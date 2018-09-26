<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
	'colors' => array(
		'text' => 'srand',
		'chessboard_0'=>'srand', //tile1 background
		'chessboard_1'=>'#555'   //tile2 background
	),
	'string' => array(
		'lenght' => 4,
		'char_set' => 2,
		'font'=>'rage.ttf',
		'fontsize'=>70
	),
	'operations' => array(
		'chessboard'=>array(10), //draw chessboard, specify tile size (optional)
		'text'
	)
);

$uc = new ucaptcha($setting);
$uc->drawImage();
