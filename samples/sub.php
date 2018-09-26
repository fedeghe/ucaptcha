<?php
session_start();
?>
<html>
	<head>
		<style type="text/css">
			body{
				font-size:12px;
				font-family: verdana,sans;
				background-color:#555555;
			}
		</style>
	</head>
	<body>
		<div style="background-color: white;    border: 4px solid black;    font-size: 10px;      overflow: hidden;    padding: 5px;">
			<?php highlight_string('<?php
// match the md5 of the posted value against
$_SESSION[\'ucaptcha_string\'];
//'); ?>
		</div>
		<h1><?php echo(md5($_POST['stringa']) == $_SESSION['ucaptcha_string'])? '<span style="color:#55FF55">RIGHT</span>':'<span style="color:#FF5555">WRONG</span>'; ?></h1>
		<span>Use the menu to repeat a test. Thank You</span>
	</body>
</html>
