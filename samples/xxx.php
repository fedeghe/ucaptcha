<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array(
    'string' => array(
        'char_set' => 6,// numbers, lowercase and uppercase 2*3*5
        'srotate'=>array(-40, 40),
        'rotate'=>array(-20, 20),
        'lenght'=>6,
        'fontsize'=>40
        //'font'=>array('Candice.ttf','rage.ttf'),
    ),
    'colors' => array(
        'bg' => 'rand',
        'text'=>'#ffffff',
        'grind'=>'333333',
        'randchars'=>'srand'
    ),
    'nums'=>array(
        'randchars'=>300
    ),
    'operations' => array(
        //'grind'=>array(10),
        'randchars',
        'text',
        //'warp',
        'wave',
        'wave'
    )    
);

$uc = new ucaptcha($setting);  
$uc->drawImage();