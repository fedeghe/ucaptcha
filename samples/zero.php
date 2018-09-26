<?php
include("../ucaptcha/ucaptcha.class.php");

$setting = array();
$uc = new ucaptcha($setting);  
$uc->drawImage();
