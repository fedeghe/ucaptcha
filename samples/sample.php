<?php
session_start();
$fname = $_GET['n'].'.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> UCHAPTCHA v 1.0</title>
		<link rel ="stylesheet" href="style.css" type="text/css"/>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript"><?php include('../js/start.js.php'); ?></script>
				<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-27813147-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</head>
	<body >	
		<div id="container">
			<div id="captcha_form">
				<div class="captcha_container">
					<p>Click on the image to renew it</p>
					<img alt="chaptcha" class="captcha" title="click to refresh" id="captcha" src="<?php echo $fname; ?>?<?php echo rand(); ?>" />
				</div>
				<br />				
				<form action="sub.php" method="post">
					<input type="text" name ="stringa" id="prova" autocomplete="off" />
					<input type="submit" value="submit" class="testomini"/>
				</form>
			</div>
			<input type="button" value="View image code" id="toggle_code"/>
			<div id="code">
				<?php highlight_file($fname); ?>
			</div>
			
		</div>
		
		
	</body>
</html>
