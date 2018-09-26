<?php
$elements = array(
	
	'dimensions'=>array(
		'note'=>'These parameters go into  $setting[\'dimensions\'] array',
		array(
			'width',
			'<i>integer</i>',
			'300',
			'the width of the image; upper limited by class constant MAX_WIDTH = 400'
		),
		array(
			'height',
			'<i>integer</i>',
			'100',
			'the height of the image; upper limited by class constant MAX_HEIGHT = 300'
		)
	),
	'string'=>array(
		'note'=>'These parameters go into  $setting[\'string\'] array',
		array(
			'lenght',
			'<i>integer</i>',
			'5',
			'the lenght of the string; upper limited by class constant MAX_STRING_LENGHT = 8'
		),
		array(
			'char_set',
			'<i>integer</i>',
			'5 (lowercase letters)',
			'<ul>
					<li><b>2</b> for numbers</li>
					<li><b>3</b> for uppercase</li>
					<li><b>5</b> for lowercase</li>
					<li><b>7</b> for symbols</li>
					<li>any product for a combination</li>
				</ul><br />
				<b>sample:</b> use 14 to see numbers and symbols
			'
		),
		array(
			'font',
			'<i>string</i><br />OR<br /><i>array(<br />string </i>ttf_file1<i>,<br /> string </i>ttf_file2<br />, [...]<i>)</i>',
			'"arial.ttf"',
			'ttf font filename , the font that will be used to write the string<br /><br /><b>NOTE</b>: that file by default must be in a folder named `fonts` and that folder must be a sibling of ucaptcha.class.php
			<br /><br />
			<span style="color:red">NOTE: </span><span>You can use the array parameter only from v 1.1</span>
			'
		),
		array(
			'fontsize',
			'<i>integer</i><br />OR<br /><i>array(<br />integer </i>min_size<i>,<br /> integer </i>max_size<br /><i>)</i>',
			'30',
			'the size used for the string; upper limited by class constant MAX_FONT_SIZE = 200
				<br /><br />
			<span style="color:red">NOTE: </span><span>You can use the array parameter only from v 1.1</span>'
		),
		
		array(
			'spacing',
			'<i>float</i>',
			'5',
			'Use that to specify the distance in pixel between two letters.
				<br /><br />
			<span style="color:red">NOTE: </span><span>Available only from v 1.1</span>'
		),
		
		
		
		array(
			'rotate',
			'<i>integer</i><br />OR<br /><i>array(<br />integer </i>min_angle<i>,<br /> integer </i>max_angle<br /><i>)</i>',
			'false',
			'to specify angle bounds for a random rotation of <u>the whole string</u>'
		),
		array(
			'srotate',
			'<i>array(<br />integer </i>min_angle<i>,<br /> integer </i>max_angle<br /><i>)</i>',
			'false',
			'to specify angle bounds for a random rotation of <u> every single element of the string</u>'
		),
		array(
			'guess_set',
			'<i>integer</i>',
			'false',
			'Give a value as You\'d do with <i>char_set</i><br /><br />
				<b>sample:</b> use 2 to ask the user to input only numbers recognoised
			'
		),
		array(
			'guess_set_num',
			'<i>integer</i>',
			'false',
			'Give a value as You\'d do with <i>char_set</i><br /><br />
				<b>sample:</b> use 2 to ask the user to input only how many numbers recognoised
			'
		)
	),
	'operations'=>array(
		'note'=>'These parameters go into $setting[\'operations\'] array<br /><br />
		As You`ll see, all elements that will be written in that array are label & params elements where<br />
		> <b>label</b> is a string that indicates which operation we want to add and<br />
		> <b>value</b> when requested is <u>always an array</u> that give to the operation some parameters needed<br />
		<br />
		<br />
		<b>NOTE</b>: All operations are applied in the exact order in which are inserted in this array. An exception is "logo", in fact `logo` if requested will be the last operation no matter where You write it.
		<br />
		<br />
		To apply the same operation more than once use _ symbol after the operation name and a unique sequence (within that operation).
		<br />
		<code>
				\'operations\' => (
					\'wave_ssdf\', \'wave_123\'
				)
		</code>
		<br />
		First of all let`s look at text operations',
		
		
		
		
		
		
		array(
			'text',
			'no parameters',
			false,
			'Prints out a random text'
		),
		array(
			'dtext',
			'no parameters',
			false,
			'Prints out a random text picked up (each line a word) from a dictionary.txt file that must be located in the same place as the class'
		),
		'_break1'=>'Now we get a look at some noises',
		
		array(
			'dots',
			'<i>array(integer</i> max_radius <i>)</i>
			',
			'array(1)',
			'That noise will add point to the image, the number of dots drawn is ruled by $setting[\'num\'][\'dots\'] array param and upper limited by a class constant NUM_DOTS = 500; the color of dots is ruled by $setting[\'color\'][\'dots\'] array param.;<br /><br />
			Parameters:<ul><li><b>max_radius</b>: maximum radius</li></ul>'
		),
		array(
			'lines',
			'no parameters',
			'',
			'That noise will add lines to the image, the number of lines drawn is ruled by $setting[\'num\'][\'lines\'] array param and upper limited by a class constant NUM_LINES = 500; the color of lines is ruled by $setting[\'color\'][\'lines\'] array param.'
		),
		array(
			'circles',
			'<i>array(integer </i>how_many<i>, boolean </i>fill_em<i>)</i>',
			'array(3, false)',
			'That noise will add circles to the image;<br /><br />
				Parameters:<ul><li><b>how_may</b>: number of circles</li><li><b>fill_em</b>: fill circles?</li></ul>'
		),
		array(
			'polygons',
			'<i>array(integer </i>how_many<i>, boolean </i>fill_em<i>)</i>',
			'array(2,true)',
			'That noise will add polygons with random vertex to the image;<br /><br />
				Parameters:<ul><li><b>how_may</b>: number of polygons</li><li><b>fill_em</b>: fill polygons?</li></ul>'
		),
		array(
			'grind',
			'<i>array(integer</i> distance <i>)</i>',
			'array(5)',
			'Draw a grind with lines distanced by <i>distance</i> parameter<br /><br />
				Parameters:<ul><li><b>distance</b>: the distance between two parallel lines contiguous</li></ul>'
		),
		array(
			'chessboard',
			'<i>array(integer</i> dimension <i>)</i>',
			'array(7)',
			'Draw a chessboard with squares dimensioned by <i>dimension</i> parameter<br /><br />
				Parameters:<ul><li><b>dimension</b>: side dimension of each square</li></ul>'
		),
		array(
			'randchars',
			'<i>array(integer </i>maxsize<i>, boolean </i>noise<i>)</i>',
			'array(specified font_size, false)',
			'That noise will add random chars  to the image;<br /><br />
				Parameters:<ul><li><b>maxsize</b>: maximum size for random noise chars</li><li><b>noise</b>: if true use charset paramter otherwise uses symbols</li></ul>'
		),
		array(
			'func',
			'<i>array(callback </i>obj_method<i>, array</i> range<i>)</i>',
			'no defaults',
			'Explicit function through callback<br /><br />Please see the example'
		),
		array(
			'pfunc',
			'<i>array(callback </i>obj_method_R<i>, callback </i>obj_method_RHO<i>, array</i> rangeR<i>, array</i> rangeRHO<i>, boolean </i>join_points<i>)</i>',
			'no defaults',
			'Polar function through callback<br /><br />Please see the example'
		),
		array(
			'tfunc',
			'<i>array(callback </i>obj_method_X<i>, callback </i>obj_method_Y<i>, array</i> rangeX<i>, array</i> rangeY<i>, boolean </i>join_points<i>)</i>',
			'no defaults',
			'Parametric function through callback<br /><br />Please see the example'
		),
		array(
			'bgimage',
			'<i>array(string </i>img_relative_path<i>, array </i>4 integers clipping array<i>)</i>',
			'no defaults',
			'Add the specified image in background covering the whole image optionally using the clipped part decided with the second parameter<br />
				<code>
				array(\'../ucaptcha/lion4.jpg\', 	array(20,20,150,150) )
				</code>
			<br /><br /><b>NOTE</b>: the image file path must be relative to the file that renders the image'
		),
		array(
			'logo',
			'<i>array(string </i>img_relative_path<i>, string </i>position<i>)</i>',
			'no defaults',
			'Add a logo in one of the 9 corner/centers of the image <br />
				<code>
				array(\'../ucaptcha/mylogo.gif\', 	\'d_r\' )
				</code>
				<br /><br />
				Parameters:<ul><li><b>img_relative_path</b>: the image to be used (<b>ONLY GIF</b>)</li><li><b>position</b>: a string within {\'u_l\',\'u_c\',\'u_r\',\'c_l\',\'c_c\',\'c_r\',\'d_l\',\'d_c\',\'d_r\'}</li></ul>
				vertical_horizontal:(u,c,d)_(l,c,r)
				
				<br /><br /><b>NOTE</b>: the image file path must be relative to the file that renders the image
				'
		),
		
		'_break2'=>'Now let`s look at some effects',
		
		array(
			'warp',
			'no parameters',
			false,
			'Warps randomly in the right places'
		),
		array(
			'wave',
			'no parameters',
			false,
			'Apply a wave effect'
		),
		array(
			'shear',
			'<i>array(integer</i> min, <i>integer</i> max,  <i>)</i>',
			'array(-20,20)',
			'Shears the image along the horizontal direction; the parameter give are not linear with angle but with horizont, 10 stand exactly to 45° and &infin; to 90° '
		),
		
		array(
			'breeze',
			'<i>array(integer</i> displacement)</i>',
			'array(1)',
			'Apply to the image an horizontal displacement line per line. The parameter is a strenght factor.'
		),
		array(
			'rotate',
			'<i>array(integer</i> min, <i>integer</i> max,  <i>)</i>',
			'false',
			'Rotates CCW the image around the center of a random angle between the specified bounds'
		),
		array(
			'convolve',
			'<i>array(mixed)</i>',
			'no defaults',
			'Within the array You can write one or more of the following built-in filters<br /><br />
				<ul>
					<li><i>gauss</i></li>
					<li><i>blur0</i></li>
					<li><i>blur1</i></li>
					<li><i>blur2</i></li>
					<li><i>blur3</i></li>
					<li><i>detect_hlines</i></li>
					<li><i>detect_vlines</i></li>
					<li><i>detect_45lines</i></li>
					<li><i>detect_135lines</i></li>
					<li><i>detect_edges</i></li>
					<li><i>sobel_horiz</i></li>
					<li><i>sobel_vert</i></li>
					<li><i>sobel</i></li>
					<li><i>detect_edges</i></li>
					<li><i>edges</i></li>
					<li><i>laplace</i></li>
					<li><i>sharpen</i></li>
					<li><i>laplace_emboss</i></li>
					<li><i>sharp</i></li>
					<li><i>mean_removal</i></li>
					<li><i>emboss</i></li>
				</ul>
				<br />				
				<br />
				<b>OR</b>
				<br />				
				<br />
				use Your own filters specifing one or more 3*3 matrix<br >
				<i>
				array(<br />
				&nbsp;&nbsp;&nbsp;array(float, float, float),<br />
				&nbsp;&nbsp;&nbsp;array(float, float, float),<br />
				&nbsp;&nbsp;&nbsp;array(float, float, float),<br />
				)
				</i>	
			'
		)
	),
	'colors'=>array(
		'note'=>'<p>
			These parameters go into  $setting[\'colors\'] array<br /><br />
			Allowed formats: #012345 ; #012 ; 012345; 012<br /><br />
			For every parameter but "bg" You can use two special color label:<br />
			<ul>
				<li>> <i>rand</i> : the whole element will be randomly colorized</li>
				<li>> <i>srand</i> : every single composing element will be randomly colorized</li>
			</ul>
		</p>',
		array(
			'text',
			'<i>string</i>',
			'"#000000"',
			'Color for text<br /><br />using "rand" the whole string will have a random color<br />using "srand" every character will have a random color'
		),
		array(
			'bg',
			'<i>string</i>',
			'"#ffffff"',
			'Color for background.<br /><br />NOTE: For background You can even use "<b>noise</b>" and "<b>cnoise</b>" producing respectively a random grayscale noise and rgb noise'
		),
		array(
			'lines',
			'<i>string</i>',
			'"#888888"',
			'Color for lines noise<br /><br />using "rand" all lines will have the same random color<br />using "srand" every line will have his own random color'
		),
		array(
			'dots',
			'<i>string</i>',
			'"#555555"',
			'Color for dots noise<br /><br />using "rand" all dots will have the same random color<br />using "srand" every dot will have his own random color'
		),
		array(
			'circles',
			'<i>string</i>',
			'"#883333"',
			'Color for circles noise<br /><br />using "rand" all circles will have the same random color<br />using "srand" every circle will have his own random color'
		),
		array(
			'grind',
			'<i>string</i>',
			'"#338833"',
			'Color for grind noise<br /><br />using "rand" all lines of the grind will have the same random color<br />using "srand" every line will have his own random color'
		),
		array(
			'polygons',
			'<i>string</i>',
			'"#ffffff"',
			'Color for polygons nooise<br /><br />using "rand" all polygons sides will have the same random color<br />using "srand" every polygon will have his sides with one random color'
		),
		array(
			'functions',
			'<i>string</i>',
			'"#fede76"',
			'Color for functions noise<br /><br />using "rand" all lines approximating the function graph will have the same random color<br />using "srand" every line will have his own random color'
		),
		array(
			'chessboard_0',
			'<i>string</i>',
			'"#fede76"',
			'Color for chessbard tiles odd<br /><br />using "rand" all squares will have the same random color<br />using "srand" every square will have his own random color'
		),
		array(
			'chessboard_1',
			'<i>string</i>',
			'"#330000"',
			'Color for chessboard tiles even... same as previous'
		),
		array(
			'randchars',
			'<i>string</i>',
			'"#333333"',
			'Color for randc-hars<br /><br />using "rand" all random chars will have the same random color<br />using "srand" every random char will have his own random color'
		),
	),
	'nums'=>array(
		'note'=>'These parameters go into  $setting[\'nums\'] array',
		array(
			'lines',
			'<i>integer</i>',
			'50',
			'Class constant upper limit MAX_NUM_LINES = 500.<br /><br />Number of lines traced when a "lines" element is in $setting[\'operations\']'
		),
		array(
			'dots',
			'<i>integer</i>',
			'200',
			'Class constant upper limit MAX_NUM_DOTS = 500.<br /><br />Number of dots traced when a "dots" element is in $setting[\'operations\']'
		),
		array(
			'circles',
			'<i>integer</i>',
			'3',
			'Class constant upper limit MAX_NUM_CIRCLES = 100<br /><br />Number of circles traced when a "circles" element is in $setting[\'operations\']'
		),
		array(
			'polygons',
			'<i>integer</i>',
			'3',
			'Class constant upper limit MAX_NUM_POLYGONS = 100<br /><br />Number of polygons traced when a "polygons" element is in $setting[\'operations\']'
		),
		array(
			'grind_px',
			'<i>integer</i>',
			'10',
			'Class constant upper limit MAX_NUM_GRINDPX = 100<br /><br />Distance between grind lines when a "grind" element is in $setting[\'operations\']'
		),
		array(
			'randchars',
			'<i>integer</i>',
			'20',
			'Class constant upper limit MAX_NUM_RANDCHARS = 100<br /><br />Number of random chars drawn when a "randchars" element is in $setting[\'operations\']'
		)
	)
);

$out = '';
foreach($elements as $label => $arr){
	$out .='<a name="'.$label.'">&nbsp;</a>';
	$out .='<fieldset>';
	$out .='<legend>'.$label.'</legend>';
	
	$note = false;
	
	// note ? 
	if(array_key_exists('note', $arr))$note = $arr['note'];
	
	
	if($note)$out.='<div class="note">'.$note.'</div>';
	
	$head ='<table cellpadding="2" cellspacing="0">
				<tr>
					<th>param</th><th>type</th><th width="500px">description</th>
				</tr>';
	
	$out.=$head;
	
	foreach($arr as $k => $el){
		
		if($k === "note") continue;
		
		if(substr($k,0,6) === '_break'){
			$out.='</table><div class="note">'.$el.'</div>'.$head;
			continue;
		}
		
		$out.='<tr valign="top">
			<td class="first"><b>'.$el[0].'</b></td>
			<td class="second">'.$el[1].'</td>
			<td>'.($el[2]===false?'':'<b>Default value</b> = '.$el[2].'<br /><br />').$el[3].'</td>
		</tr>';
	}	
			
	$out.='	</table>';
	$out .='</fieldset>';
}
?>

<div id="spec_head"><?php include('spec_head.php'); ?></div>

<hr />

<?php 
echo $out;
