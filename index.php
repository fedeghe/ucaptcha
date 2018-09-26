<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
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
		<title>ucaptcha v. 1.1</title>
		<meta name="description" content="Generate highly customizable captcha images, with many effects and includes the possibility to enable some strong cognitive filters: Decide the charset for composing the string. You can decide a subcharset to ask the user to input only for example numbers and lowercase letters he recognoises. # BACKGROUND NOISES(grayscale noise; color noise; dots; lines; circles (filled or not); polygons (filled or not); grind; chessboard; random chars; cartesian, polar and parametric function plot; background image (clippable); logo watermark) you can speficy every color or use 'rand' to get a random color or 'srand' to randomize every element involved in a operation.# EFFECTS(warp; wave; shear; breeze; rotate; convolve (with many preset filters:gauss, blur, detect_hlines, detect_vlines, detect_45lines, detect_135lines, detect_edges, sobel_horiz, sobel_vert, sobel, detect_edges, edges, laplace, sharpen, laplace_emboss, , sharp, mean_removal, emboss) BUT You can even use your own passing a convolution matrix...and much more" />
		<meta name="keywords" content="ucaptcha,unbreakable captcha, cognitive captcha, captcha, php, captcha php, php captcha, federico ghedina" />
		<meta name="distribution" content="public" />
		<meta name="robots" content="all" />
		<meta name="revisit-after" content="10 days" />
	</head>
	<body>
		<a name="t"></a>
		<div id="container">
			<div id="spec_tongue_container">
				<div id="spec_tongue">More about setting</div>
			</div>
			<div id="complete">
				<div id="inner_complete">
					<?php 				
					include('ucaptcha/setting.php');
					?>
				</div>
			</div>
			
			<div id="ulogo"></div>
			
			<div id="content">
				<p class="logo"><font color="#aaa">Unbreakable</font> Completely Automated Turing Test To Tell Computers and Humans Apart</p>
				<?php ?>
				 
				<?php ?>
				<div class="floatp" id="left">
					<!--
					<h3>Setting tool</h3>
					<ul>
						<li><a href="javascript:this.blur();setting();">View setting panel</a></li>
					</ul>
					-->
					<h3>Sample list</h3>
						<?php
						$samples = array(
							'basic'=>array(
								'random text'=>'random_text',
								'dictionary text'=>'dictionary_text',
								'rotate string'=> 'rotate_string',
								'rotate letters'=>'rotate_letters',
								'both previous'=>'rotate_both'
							),
							'noises'=>array(
								'dots'=>'dots',
								'lines'=>'lines',
								'circles'=>'circles',
								'polygons'=>'polygons',
								'grind'=>'grind',
								'chessboard'=>'chessboard',
								'rand chars'=>'rand_chars',
								'back noise'=>'back_noise',
								'your functions'=>'your_functions',
								'background image'=>'bgimage',
								'your logo'=>'logo'
							),
							'effects'=>array(
								'warp'=>'warp',
								'wave'=>'wave',
								'shear'=>'shear',
								'breeze'=>'breeze',
								'rotate'=>'rotate',
								//'ripple'=>'ripple'
							),
							'filters'=>array(
							//	'embedded'=>'embedded_filters',
								'gauss'=>'gauss',
								'blur'=>'blur',
								'detect_hlines'=>'detect_hlines',
								'detect_vlines'=>'detect_vlines',
								'sobel'=>'sobel',
								'sobel_horiz'=>'sobel_horiz',
								'sobel_vert'=>'sobel_vert',
								'edges'=>'edges',
								'laplace'=>'laplace',
								'laplace_emboss'=>'laplace_emboss',
								'sharpen'=>'sharpen',
								'mean_removal'=>'mean_removal',
								'your one'=>'your_filter',
								'xxx' => 'xxx'						
							),
							'cognitive filters*'=>array(
								'subset based'=>'cognitive_filter',
								'subset count based'=>'cognitive_filter_num',
							)
						);
						$menu = '<ul>';
						foreach($samples as $l1=> $l2){
							$more = '';
							if(substr($l1, -1,1)=='*'){
								$more = ' class="bold"';
								$l1 = substr($l1, 0,strlen($l1)-1);
							}
							$menu.= '<li class="first_lev"><span'.$more.'>'.$l1.'</span>';
							$menu.=  '<ul class="inner_hidd">';
							foreach($l2 as $k => $lab){
								$menu.=  '<li class="second_lev" alt="'.$lab.'"><span>'.$k.'</span></li>';
							}
							$menu.=  '</ul>';
							$menu.=  '</li>';
						}
							$menu.=  '</ul>';
						
						echo $menu;
						?>
				</div>
				<div class="floatp" id="right">
					<iframe src="samples/index.php" width="100%" height="100%" id="sampleframe" frameborder="0" >
						<p>Your browser does not support iframes.</p>
					</iframe>
				</div>
				<div class="clearer">&nbsp;</div>
			</div>
			<div id="footer">
				<p>Created by <a href="http://www.linkedin.com/in/federicoghedina" target="_blank">me</a> on Dec 2011</p>
			</div>
		</div>
		
		
	</body>
</html>
