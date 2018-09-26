<?php
/**

Author : Federico Ghedina 

Contact : fedeghe@gmail.com

ucaptcha class version 1.1 - PHP5

-------------------------------------
LICENSE:  Free for non-commercial use
-------------------------------------





Generate highly customizable captcha images, with many effects and includes the possibility to enable some strong cognitive filters:

Decide the charset for composing the string. You can decide a subcharset to ask the user to input only for example numbers and lowercase letters he recognoises.


# BACKGROUND NOISES
> grayscale noise
> color noise
> dots
> lines
> circles (filled or not)
> polygons (filled or not)
> grind 
> chessboard
> random chars
> cartesian, polar and parametric function plot
> background image (clippable)
> logo watermark

you can speficy every color or use 'rand' to get a random color or 'srand' to randomize every element involved in a operation.

# EFFECTS
> warp
> wave
> shear
> breeze
> rotate
> convolve (with many preset filters:gauss, blur, detect_hlines, detect_vlines, detect_45lines, detect_135lines, detect_edges, sobel_horiz, sobel_vert, sobel, detect_edges, edges, laplace, sharpen, laplace_emboss, , sharp, mean_removal, emboss) BUT You can even use your own passing a convolution matrix.

..and much more





Many samples and a complete documentation on usage can be found at  : http://ucaptcha.majoranaframework.org/


Permission to use, copy, modify, and/or distribute this software for any
purpose without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.





*/

error_reporting(8191);


class ucaptcha{
	
	const FONT_FOLDER = 'fonts';
	
	// maximum string length
	const MAX_STRING_LENGHT = 8;
	
	// maximum number of lines that will be displayed
	const MAX_NUM_LINES = 500;
	
	// maximum number of dots that will be displayed
	const MAX_NUM_DOTS = 500;
	
	// maximum number of circles that will be displayed
	const MAX_NUM_CIRCLES = 100;
	
	// maximum number of polygons that will be displayed
	const MAX_NUM_POLYGONS = 100;
	
	// maximum number of randomchars that will be displayed
	const MAX_NUM_RANDCHARS = 100;
	
	// maximum size of grind
	const MAX_NUM_GRINDPX = 100;
	
	
	// maximum image width
	const MAX_WIDTH = 400;
	
	// maximum image_height
	const MAX_HEIGHT = 300;
	
	// maximum font size
	const MAX_FONTSIZE = 200;
	
	
	
	
	
	/////////////////////////
	//
	// COLORS 
	//
	
	
	/////////////////////////////////////////////////////////////
	//
	//
	// the following 5 basic colors are NOT meant to be editable from constructor params
	// 
	//
	
	/**
	 * black color
	 * 
	 * @var string 
	 */
	private $color_black='#000000';
	
	/**
	 * white color
	 * 
	 * @var string  
	 */
	private $color_white='#ffffff';
	
	/**
	 * red color
	 *
	 * @var type 
	 */
	private $color_red='#ff0000';
	
	/**
	 * green color
	 *
	 * @var type 
	 */
	private $color_green='#00ff00';
	
	/**
	 * blue color
	 * 
	 * @var type 
	 */
	private $color_blue='#0000ff';	 
	
	   
	
	
	/////////////////////////////////////////////////////////////
	//
	//
	// the following colors are editable from constructor params
	// 
	//
	
	
	/**
	 * exadecimal color for text, "rand" can be used to obtain a random color 
	 * 
	 * @var string 
	 */
	private $color_text = '#000000';
	
	/**
	 *
	 * @var string exadecimal color for background color, "rand" can be used to obtain a random color 
	 */
	private $color_bg = '#ffffff';
	
	/**
	 *
	 * @var string exadecimal color for lines, "rand" can be used to obtain a random color 
	 */
	private $color_lines = '#888888';
	
	/**
	 *
	 * @var string exadecimal color for dots, "rand" can be used to obtain a random color 
	 */
	private $color_dots = '#555555';
	
	/**
	 *
	 * @var string exadecimal color for circles, "rand" can be used to obtain a random color 
	 */
	private $color_circles = '#883333';
	
	/**
	 *
	 * @var string exadecimal color for polygons, "rand" can be used to obtain a random color 
	 */
	private $color_polygons = '#ffffff';
	
	/**
	 *
	 * @var string exadecimal color for grinds, "rand" can be used to obtain a random color 
	 */
	private $color_grind = '#338833';
	
	/**
	 *
	 * @var string exadecimal color for randomchars, "rand" can be used to obtain a random color 
	 */
	private $color_randchars = '#333333';
	
	/**
	 *
	 * @var string exadecimal color for functions, "rand" can be used to obtain a random color 
	 */
	private $color_functions = '#fede76';
	
	/**
	 *
	 * @var string exadecimal color for chessboard squares #A, "rand" can be used to obtain a random color 
	 */
	private $color_chessboard_0 = '#fede76';
	
	/**
	 *
	 * @var string exadecimal color for chessboard squares #B, "rand" can be used to obtain a random color 
	 */
	private $color_chessboard_1 = '#330000';
	
	
	
	
	
	
	/////////////////////
	//
	//	STRING default PARAMETERS
	//
	
	/**
	 *	the default string lenght for text to be guessed
	 * 
	 * @var integer 
	 */
	private $string_lenght=5;
	
	/**
	 * the default charset that will be used to compose the random string to be guessed
	 * 
	 * @var integer
	 */
	private $string_spacer = 5;
	
	/**
	 * the default charset that will be used to compose the random string to be guessed
	 * 
	 * @var integer
	 */
	private $string_char_set=5;
	
	/**
	 * the default font file name used for truetype font (see constructor)
	 * 
	 * @var string 
	 */
	private $string_font = array('arial.ttf');
	
	/**
	 * the default string size (fontsize)
	 * 
	 * @var string 
	 */
	private $string_fontsize = array(30,30);
	
	/**
	 * 	the default range of rotation
	 * @var boolean or array 
	 */
	//private $rotate_text = false;
	private $string_rotate = false;
	
	
	/**
	 * 	the default range of rotation for single letters
	 * @var boolean or array 
	 */
	//private $rotate_text = false;
	private $string_srotate = false;
	
	
	


	
	/////////////////////
	//
	//	SOME default number PARAMETERS
	//
	
	/**
	 * the number of default lines that will be traced adding operation 'lines'
	 * 
	 * @var type 
	 */
	private $num_lines=50;
	
	/**
	 * the number of default dots that will be traced adding operation 'dots'
	 * 
	 * @var type 
	 */
	private $num_dots=200;
	
	/**
	 * the number of default circles that will be traced adding operation 'circles'
	 * 
	 * @var type 
	 */
	private $num_circles=3;
	
	/**
	 * the number of default polygons that will be traced adding operation 'polygons'
	 * 
	 * @var type 
	 */
	private $num_polygons=4;
	
	/**
	 * the default distance between lines that compose the grind that will be traced adding operation 'grind'
	 * 
	 * @var type 
	 */
	private $num_grind_px=10;
	
	
	/**
	 * the number of default random chars that will be traced adding operation 'randchars'
	 * 
	 * @var type 
	 */
	private $num_randchars=20;
	


	/**
	 *	the default width of the image
	 * 
	 * @var type 
	 */
	private $width=300;
	
	/**
	 *	the default height of the image
	 * 
	 * @var type 
	 */
	private $height=100;	
		
	
	/**
	 * convolution matrix used for effects
	 *
	 * @var array 
	 */
	private $convolve;
	
	
	//////////////////////////////////
	//
	// REALLY PRIVATE ,not meant to be modified
	//
	/**
	 *
	 * @var type 
	 */
	private $path_fonts;	
	
	
	/**
	 * inner string that must be guessed
	 * 
	 * @var string  
	 */
	private $captcha_string;	
	
	
	// cognitive charset parameter
	private $string_guess_set = false;
	private $string_guess_set_num = false;
	
	
	
	//	
	private $personal_dictionary = false;
	
	
	//
	// 
	//   Wave configuration in X and Y axes
	//
	
	/**
	 * period along x for wave function
	 * 
	 * @var integer 
	 */
	private $Xperiod = 11;
	/**
	 * amplitude along c for `wave` function
	 * 
	 * @var integer 
	 */
	private $Xamplitude = 5;
	/**
	 * period along y for wave function
	 * 
	 * @var integer
	 */
	private $Yperiod = 12;
	/**
	 * amplitude along y for `wave` function
	 * 
	 * @var integer
	 */
	private $Yamplitude = 5;

	/**
	 *	the default strength of wave effect
	 * 
	 * @var integer 
	 */
	private $wave_scale = 2; //(1: low, 2: medium, 3: high)
	

	/**
	 * inner image resource (main)
	 * 
	 * @var resource (image) 
	 */
	private $img1;

	/**
	 * inner image resource (buffer for inverse transformation)
	 * 
	 * @var resource (image) 
	 */
	private $img2;
	
	
	
	//available fonts autoloaded from load_font in the constructor
	
	/**
	 * Used to store filenames of loaded fonts
	 * 
	 * @var array
	 */
	private $fonts = array();
	
	
	/**
	 * Operations queue
	 * 
	 * @var array
	 */
	private $operations = array();
	
	
	/**
	 * Allocated colors
	 * 
	 * @var array 
	 */
	private $allcolors = array();


	/**
	 * charset key 
	 * 2 <=> numbers
	 * 3 <=> lowercase letters
	 * 5 <=> uppercase letters
	 * 7 <=> symbols
	 * 
	 * specify a product of these numbers in string_charSet parameter to decide the used set of characters
	 *  
	 * @var array 
	 */
	private $charSetArray = array(2, 3, 5, 7);
	
	/**
	 * ascii intervals for numbers, lowercase letters, uppercase letters, symbols: 
	 *
	 * @access private
	 * @var array 
	 */
	private $charSets = array();
	
	/**
	 * all char that do NOT belong to $charSets, used for noise: 
	 *
	 * @access private
	 * @var array 
	 */
	private $noiseCharSet = array();
	

	/**
	 * list of operations that will be executed at the end
	 * always after any effects
	 * 
	 * @var array 
	 */
	private $last_operation = array('logo');
	

	
	/**
	 * Filters callable with key in the operations with the convolve parameter:
	 * 
	 * ex: 'convolve'=>array('laplace_op','sharp'),
	 *
	 * @var array 
	 */
	private $filters = array(
		'gauss'				=>array(	array(1.0, 2.0, 1.0), 	array(2.0, 4.0, 2.0), 	array(1.0, 2.0, 1.0)	, 16, 0),		
		'blur0'				=>array(	array(0.1,0.1,0.1),	array(0.1,0.1,0.1),	array(0.1,0.1,0.1)	),
		'blur1'				=>array(	array(0.1,0.1,0.1),	array(0.1,0.1,0.1),	array(0.1,0.1,0.1)	),
		'blur2'				=>array(	array(0.2,0.2,0.2),	array(0.2,0.2,0.2),	array(0.2,0.2,0.2)	),
		'blur3'				=>array(	array(0.3,0.3,0.3),	array(0.3,0.3,0.3),	array(0.3,0.3,0.3)	),
		'detect_hlines'		=>array(	array(-1,-1,-1),		array(2,2,2),			array(-1,-1,-1)	),
		'detect_vlines'		=>array(	array(-1,2,-1),			array(-1,2,-1),			array(-1,2,-1)	),
		'detect_45lines'	=>array(	array(-1,-1,2),			array(-1,2,-1),			array(2,-1,-1)	),
		'detect_135lines'	=>array(	array(2,-1,-1),			array(-1,2,-1),			array(-1,-1,2)	),
		'detect_edges'		=>array(	array(-1,-1,-1),		array(-1,8,-1),			array(-1,-1,-1)	),
		'sobel_horiz'		=>array(	array(-1,-2,-1),		array(0,0,0),			array(1,2,1)	),
		'sobel_vert'		=>array(	array(-1,0,1),			array(-2,0,2),			array(-1,0,1)	),
		'sobel'				=>array(	array(0,2,2),			array(-2,0,3),			array(-2,-3,0)	),
		'detect_edges'		=>array(	array(-1,0,1),			array(-2,0,2),			array(-1,0,1)	),
		
		'edges'				=>array(	array(0,1,2),			array(-1,0,1),			array(-2,-1,0)	),
		
		'laplace'			=>array(	array(0,-1,0),			array(-1,5,-1),			array(0,-1,0)),
		'sharpen'			=>array(	array(-1, -1, -1),		array(-1, 16, -1),		array(-1, -1, -1),	8,	0),
		'laplace_emboss'	=>array(	array(-1,0,-1),			array(0,4,0),			array(-1,0,-1)),
		'sharp'				=>array(	array(0,-1,0),			array(-1,5,-1),			array(0,-1,0)),
		'mean_removal'		=>array(	array(-1,-1,-1),			array(-1,9,-1),			array(-1,-1,-1)),
		'emboss'=>array(array(-2,-1,0),array(-1,1,1), array(0,1,2))
	);
	

	
	/**
	 * handle unexistent calls
	 * 
	 * @param type $nome
	 * @param type $pars 
	 */
	function __call($nome, $pars) {;}

	
	/**
	 * Constructor:
	 * 
	 * the passed array allow the user to edit some parameters:
	 * color_text, color_bg, color_lines, color_dots, color_circles, color_polygons, color_grind, color_randchars, color_functions, color_chessboard_0, color_chessboard_1
	 * string__lenght, string_charSet, string_font
	 * num_lines, num_dots, num_circles, num_polygons, num_grind_px, num_randchars
	 * width, height, logo, font_size, rotate_text
	 * operations {breeze, chessboard, circles, convolve, cos, dots, grind, lines, logo, polygons, randchars, shear, sin, text, warp, wave}
	 * 
	 *
	 * @param array $args 
	 */
	function __construct($args=false) {
		
		if(!$args || !is_array($args))$args = array();
		
		
		defined('PATH_CORE') || define('PATH_CORE', dirname(__FILE__));
		
		defined('DS') || define('DS', DIRECTORY_SEPARATOR);
		
		//give right value to font folder
		$this->path_fonts = PATH_CORE.DS.ucaptcha::FONT_FOLDER.DS;
		
		
		$this->charSets = array(
			range(48, 57), // numbers
			range(65, 90), 
			range(97, 122),
			//array_merge(range(33, 47), range(58, 64),range(91, 96))
			array_merge(range(33, 47), range(58, 64),array(92,95,96))
		);
		$this->noiseCharSet = array_merge(range(33, 47), range(58, 64),array(92,95,96));
		
		//load fonts
		$this->load_fonts();	
		
		//try to load dictionary
		$this->load_dictionary();
		
		session_start();
		
		// use args to edit allowed parameters
		$this->init_params( $args );
		
	}
	
	
	private function pd($a){echo '<pre>'.print_r($a, true).'</pre>';}
	
	
	private function tfunc($arg = FALSE) {
		//die();
		$this->drawTfunc($arg);
	}
	private function pfunc($arg = FALSE) {
		//die();
		$this->drawPfunc($arg);
	}
	private function func($arg = FALSE) {
		//die();
		$this->drawFunc($arg);
	}
	
	
	
	private function init_params($args = false) {

		if($args && is_array($args)){
			
			// colors
			// text, bg, lines, dots, circles, grind, randchars, functions, chessboard_0, chessboard_1
			if(array_key_exists('colors', $args) && is_array($args['colors'])){
				$col = $args['colors'];
				foreach($col as $k => $v){
					
					if(substr($v,0,1)=='#')$v= substr($v,1);
					if(strlen($v)==3)$v = str_repeat(substr ($v, 0,1), 2).str_repeat(substr ($v, 1,1), 2).str_repeat(substr ($v, 2,1), 2);
					
					$this->{'color_'.$k} = $v;
				}
			}				
			
			// string
			// lenght, charSet, font
			if(array_key_exists('string', $args) && is_array($args['string'])){
				$str = $args['string'];
				foreach($str as $k => $v){
					
					
					if($k == 'font' && !is_array($v)){
						$this->{'string_'.$k} = array($v);
					}elseif(in_array ($k, array('fontsize','rotate'))   && !is_array($v)){
						$this->{'string_'.$k} = array($v,$v);
					}else{
						$this->{'string_'.$k} = $v;
					}
					
				}
			}	
			
			// num
			// lines, dots, circles, grind_px, randchars
			if(array_key_exists('nums', $args) && is_array($args['nums'])){
				$num = $args['nums'];
				foreach($num as $k => $v){
					$this->{'num_'.$k} = $v;
				}
			}	
			
			// operation
			if(array_key_exists('operations', $args)  && is_array($args['operations']) ){
				$ope = $args['operations'];
				foreach($ope as $k => $v){
					$this->operations[] = is_Array($v) ? array($k, $v) : $v;
					
				}
			}	
			
			// dimensions
			$dimensions = array('width', 'height');
			if(array_key_exists('dimensions', $args)  && is_array($args['dimensions']) ){
				$dims = $args['dimensions'];
				
				if(array_key_exists('width', $dims)  && is_int($dims['width']) ){
					$this->width = min(intval($dims['width']),   constant('self::MAX_WIDTH') );
				}
				if(array_key_exists('height', $dims)  && is_int($dims['height']) ){
					$this->height = min(intval($dims['height']),   constant('self::MAX_HEIGHT') );
				}
			}	

			$this->string_fontsize[0] = min($this->string_fontsize[0], self::MAX_FONTSIZE);
			$this->string_fontsize[1] = min($this->string_fontsize[1], self::MAX_FONTSIZE);			
		}
	}

	
	private function load_fonts() {
		$exclude_font = array('.', '..', '.svn');
		$dir = $this->path_fonts;
		if (is_dir($dir) && $dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (!in_array($file, $exclude_font))
					$this->fonts[basename($file)] = realpath(dirname(__FILE__).'/fonts'.DS.$file);
			}
			closedir($dh);
		}
	}
	
	
	private function load_dictionary(){
		if(file_exists(dirname(__FILE__).'/dictionary.txt')){
			$tmp = file(dirname(__FILE__).'/dictionary.txt');
			foreach($tmp as $t){
				$t = str_replace ("\n", '', $t);
				if($t != '')$this->personal_dictionary[] = $t;
			}
		}
	}
	
	
	private function filter($arg){
		switch(true){
			case isSet($arg[0]) && isSet($arg[1]) && isSet($arg[2]) && isSet($arg[3]) && isSet($arg[4]) && count($arg) == 5 :
				imagefilter($this->img1, $arg[0], $arg[1], $arg[2], $arg[3], $arg[4]);
			break;
			case isSet($arg[0]) && isSet($arg[1]) && isSet($arg[2]) && isSet($arg[3]) && count($arg) == 4 :
				imagefilter($this->img1, $arg[0], $arg[1], $arg[2], $arg[3]);
			break;
			case isSet($arg[0]) && isSet($arg[1]) && isSet($arg[2]) && count($arg) == 3 :
				imagefilter($this->img1, $arg[0], $arg[1], $arg[2]);
			break;
			case isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2 :
				imagefilter($this->img1, $arg[0], $arg[1]);
			break;
			case isSet($arg[0]) && count($arg) == 1 :
				imagefilter($this->img1, $arg[0]);
			break;
			default:
				;
			break;
		}
	}
	
	

	private function allocateColors() {

		if($this->color_bg == 'trasparent'){
			$this->allcolors['color_bg'] = imagecolorallocatealpha($this->img1, 0, 0, 0,127);
			unset($this->color_bg);
		}

		$allocable = array(
			'black','white','red','green','blue',
			'text','bg','lines','dots','circles','polygons','grind','randchars','functions','chessboard_0','chessboard_1'
		);	
		foreach ($allocable as $k) {
			$hex_color = $this->hex_to_rgb($this->{'color_' . $k});
			$this->allcolors['color_' . $k] = imagecolorallocate($this->img1, $hex_color['red'], $hex_color['green'], $hex_color['blue']);
		}
		
		


	}

	/*
	 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	 * 
	 * 
	 * PROXY EFFECTS
	 * 
	 * 
	 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	 */

	private function warp() {

		$raggio_min = 20;
		$raggio_max = 60;
		$warpzone_limits = array(
			'x_min' => 0 + $raggio_max,
			'x_max' => $this->width - $raggio_max,
			'y_min' => 0 + $raggio_max,
			'y_max' => $this->height - $raggio_max
		);
		$x = $y = array();
		// la distanza massima da un warp all'altro � il raggio massimo di deformazione

		for ($ix = $raggio_max; $ix < $this->width; $ix+=$raggio_max)
			array_push($x, $ix);
		for ($iy = $raggio_max; $iy < $this->width; $iy+=$raggio_max)
			array_push($y, rand($warpzone_limits['y_min'], $warpzone_limits['y_max']));

		$this->img2 = $this->img1;
		for ($i = 0; $i < count($x); $i++) {
			//echo "\n".$i."\n";
			$fact = (rand(-5, 20)) / 10;
			$rand = rand(-3, 3);
			if ($rand == 0)
				$rand = count($x);
			$ragg = rand($raggio_min, $raggio_max);
			$this->EFF_warp($x[$i], $y[$i], $fact + $rand / 10 + 1, $ragg + $rand);
		}
	}

	private function grind($how_px = FALSE) {

		$distance = ($how_px[0]) ? $how_px[0] : $this->num_grind_px;
		
		$distance = min($distance, self::MAX_NUM_GRINDPX);
		
		$color = $this->getColor('color_grind');
		
		$x = $y = $distance;
		while ($x < $this->width) {
			$c = ($this->color_grind == 'srand') ?   $this->bad_rand() : $color;
			imageline($this->img1, $x, 0, $x, $this->height, $c);
			$x+=$distance;
		}
		$x = $y = $distance;
		while ($y < $this->height) {
			$c = ($this->color_grind == 'srand') ?   $this->bad_rand() : $color;
			imageline($this->img1, 0, $y, $this->width, $y, $c);
			$y+=$distance;
		}
	}
	
	private function rotate($arg=false) {
		
		switch(true){
			case isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2 :
				$this->EFF_rotate($arg[0], $arg[1]);
			break;
			case isSet($arg[0]) && count($arg) == 1 :
				$this->EFF_rotate($arg[0]);
			break;
			default:;break;
		}
		
	}

	/**
	 * Wave filter
	 */
	private function wave() {
		$this->EFF_wave();
	}

	private function shear($arg=false) {
		if(!$arg)$arg = array(-20,20);
		$this->EFF_shear('x', $arg);
	}
	
	
	

	private function dots($par = FALSE) {
		$this->drawDots($par[0]);
	}

	private function lines() {
		$this->drawLines();
	}


	private function chessboard($arg = FALSE) {
		
		switch(true){
			case isSet($arg[0]) && count($arg) == 1 :
				$this->drawChessboard($arg[0]);
			break;
			default:
				$this->drawChessboard();
			break;
		}
	}

	private function text($arg= FALSE) {
		
		$color = ($arg[0]) ? $this->getColor('color_' . $arg[0]) : $this->getColor('color_text');		
		
		if ($arg[1])
			$this->randString($this->string_lenght);
		
		if (isSet($arg[2]) && $arg[2])	$this->string_font = $this->path_fonts . $this->onefont();
		$this->drawText($color);
	}
	
	private function dtext($arg= FALSE) {
		
		$color = ($arg[0]) ? $this->getColor('color_' . $arg[0]) : $this->getColor('color_text');		
		
		
		if (isSet($arg[1]) && $arg[1])	$this->string_font = $this->path_fonts . $this->onefont();
		$this->drawDText($color);
	}
	

	private function onefont() {
		return $this->fonts[rand(0, count($this->fonts) - 1)];
	}

	private function circles($arg = FALSE) {
		
		switch(true){
			case isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2 :
				$this->drawCircles($arg[0], $arg[1]);
			break;
			case isSet($arg[0]) && count($arg) == 1 :
				$this->drawCircles($arg[0]);
			break;
			default:
				$this->drawCircles();
			break;
		}
	}
	
	private function polygons($arg = FALSE) {
		switch(true){
			case isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2 :
				$this->drawPolygons($arg[0], $arg[1]);
			break;
			case isSet($arg[0]) && count($arg) == 1 :
				$this->drawPolygons($arg[0]);
			break;
			default:
				$this->drawPolygons();
			break;
		}
		
	}

	

	private function breeze($arg = FALSE) {
		if (isSet($arg[0]) && count($arg) == 1)
			$this->EFF_breeze($arg[0]);
		elseif (isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2)
			$this->EFF_breeze($arg[0], $arg[1]);
		else
			$this->EFF_breeze();
	}
	
	private function bgimage($arg = false){
		if(isset($arg[0]) ){
			$dims = isset($arg[1])?$arg[1] : false;
			$this->drawBgImage($arg[0], $dims);
		}
	}

	private function blur() {
		$this->EFF_blur();
	}

	private function convolve($arr) {
		
		foreach($arr as $filter) $this->EFF_convolution($filter);
	}

	private function randchars($arg = FALSE) {
		if (isSet($arg[0]) && count($arg) == 1)
			$this->drawRandchars($arg[0]);
		elseif (isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2)
			$this->drawRandchars($arg[0], $arg[1]);
		else
			$this->drawRandchars();
	}
	private function get_noise_char(){
		$rnd_k = array_rand($this->noiseCharSet);
		return chr( $this->noiseCharSet[$rnd_k]  );
	}
	private function drawRandchars( $maxsize=false, $noise=false) {
		
		$numchars = min($this->num_randchars, ucaptcha::MAX_NUM_RANDCHARS);

		$color = $this->getColor('color_randchars');
		
		for ($i = 0; $i < $numchars; $i++) {
			
			$c = ($this->color_randchars == 'srand') ?   $this->bad_rand() : $color;
			
			$char = $noise ? $this->randString(1, true) : $this->get_noise_char();

			$xrand = rand(0, $this->width);
			$yrand = rand(0, $this->height);
			$angle = rand(0, 360);

			$textsize =    rand(1, $maxsize?min($maxsize, self::MAX_FONTSIZE):rand($this->string_fontsize[0],$this->string_fontsize[1]) );

			
			$k = array_rand($this->string_font);
			imagettftext($this->img1, $textsize, $angle, $xrand, $yrand, $c, $this->fonts[$this->string_font[$k]], $char);
		}
	}
	
	private function logo($arg = false) {
		
		if (isSet($arg[0]) && count($arg) == 1)
			$this->drawLogo($arg[0], 'd_r');
		elseif (isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2)
			$this->drawLogo($arg[0], $arg[1]);
	}


	
	
	

	private function drawLines(){
		$numlines = min($this->num_lines, ucaptcha::MAX_NUM_LINES);
		
		$color = $this->getColor('color_lines');
		
		for ($y = 0; $y < $numlines; $y++){
			
			$c = ($this->color_lines == 'srand') ?   $this->bad_rand() : $color;
			
			$x1 = rand(0, $this->width);
			$y1 = rand(0, $this->height);
			$x2 = rand(0, $this->width);
			$y2 = rand(0, $this->height);
			imageline( $this->img1, $x1, $y1, $x2, $y2, $c );
		}
	}

	private function drawDots($size=1) {
		$numdots = min($this->num_dots, ucaptcha::MAX_NUM_DOTS);

		$color = $this->getColor('color_dots');
		
		for ($i = 0; $i < $numdots; $i++){
			
			$c = ($this->color_dots == 'srand') ?   $this->bad_rand() : $color;
			
			($size==1)?
				imagesetpixel( $this->img1, rand(0, $this->width), rand(0, $this->height), $c)
				:
				imagefilledellipse ( $this->img1, rand(0, $this->width), rand(0, $this->height), rand(1, $size), rand(1, $size), $c)
			;
		}
	}

		
	// used by get_bb
	private function get_rot_bounding_box($letter, $font_file, $size, $angle){

		// i get the bounding box rotated (lower-left relative, 8 int array )
		$arr = imagettfbbox($size, $angle, $font_file, $letter);
		
		// getting the containing ortho bounding box
		$minX = min($arr[0],$arr[2],$arr[4],$arr[6]);
		$maxX = max($arr[0],$arr[2],$arr[4],$arr[6]);
		$minY = min($arr[1],$arr[3],$arr[5],$arr[7]);
		$maxY = max($arr[1],$arr[3],$arr[5],$arr[7]);

		//now i can store a distance that will be necessary after
		$dist  = array(abs($arr[0]-$minX), abs($arr[1]-$maxY));

		return array(
			'width'=>$maxX-$minX,
			'height'=>$maxY-$minY,
			'dist'=> $dist
		);
	}
	
	// used by drawtext
	private function get_bb(){

		$pre_chars = array();
		$lenght = 0;
		
		$font_angles = $this->string_srotate? $this->string_srotate: array(0,0);
		
		
		$string = $this->captcha_string;
		
		$max = 0;
		$hmax = 0;
		
		for($i = 0, $len = strlen($string); $i<$len; $i++){
			$str = substr($string, $i, 1);
			$arrand = array_rand($this->string_font);

			$size = rand($this->string_fontsize[0], $this->string_fontsize[1]);
			$angle = rand($font_angles[0], $font_angles[1]);


			$tmp = $this->get_rot_bounding_box($str, $this->path_fonts.$this->string_font[$arrand], $size, $angle);

			$lenght += $tmp['width'];

			$pre_chars[]=array(
				'str'=>$str,
				'angle'=>$angle,
				'size'=>$size,
				'font'=> $this->path_fonts.$this->string_font[$arrand],
				//'h_base'=> ($this->height+$tmp['height']) / 2,
				'rot_bb'=>$tmp
			);
			
			$max = max($max, ($this->height+$tmp['height']) / 2);
			$hmax = max($hmax, $tmp['height']);
			
		}
		return array($lenght,  $pre_chars, $max, $hmax);
	}
	
	public function rotate_around_point($p, $p_center, $angle){
		
		$t = $p;
		
		//traslate
		$t[0] -= $p_center[0];
		$t[1] -= $p_center[1];
		
		//rotate
		$t = $this->vec_mat0(
			array($t[0], $t[1]),
			array(
				array(cos($angle*M_PI/180), sin($angle*M_PI/180)),
				array(-sin($angle*M_PI/180), cos($angle*M_PI/180)),
			)
		);
		
		//untraslate
		$t[0] += $p_center[0];
		$t[1] += $p_center[1];
		
		return $t;
	}
	
	
	private function good_rand(){
		$rc = $this->rand_color();
		$tc = $this->hex_to_rgb($rc);
		return imagecolorallocate($this->img1, $tc['red'], $tc['green'], $tc['blue']);
	}
	private function bad_rand(){
		return imagecolorallocate($this->img1, rand(0, 255), rand(0, 255), rand(0, 255));
	}
	
	private function drawText($color) {
		$img_center = array(
			$this->width/2,
			$this->height/2
		);
		
		$srand = $this->color_text == 'srand';
		$rand = $this->color_text == 'rand';
		
		$srotate = $this->string_srotate;
		$rotate = $this->string_rotate;		
		
		$rotate_angle = $rotate ? rand($rotate[0], $rotate[1]) : 0;		
		
		list($lenght, $pre_chars, $max, $hmax) = $this->get_bb();

		//adjust lenght caring about letter spacing
		$lenght += (count($pre_chars)-1)*$this->string_spacer;
		
		
		$left = ($this->width-$lenght)/2;
		
		$red = imagecolorallocate($this->img1, 255, 0, 0);
		$green = imagecolorallocate($this->img1, 0, 255, 0);
		
		$c = $rand ? $this->good_rand() : $color;
		
		foreach($pre_chars as $pc){
			if($srand){
				$c = $this->bad_rand();
			}
			
			$L = $left + $pc['rot_bb']['dist'][0];
			$T = $max - $pc['rot_bb']['dist'][1];
			
			if($rotate){
				$new_p = $this->rotate_around_point(array($L, $T), $img_center, $rotate_angle);
				$L = $new_p[0];
				$T = $new_p[1];
			}
			
			imagettftext(
				$this->img1,
				$pc['size'],
				$pc['angle']+$rotate_angle,
				$L,	$T,
				$c,
				$pc['font'],
				$pc['str']
			);
			$left += $pc['rot_bb']['width'] + $this->string_spacer;
		}	
		
	}
	

	
	
	
	private function drawDText($color){
		//manage no dict
		if(!$this->personal_dictionary)return $this->drawText($color);
		
		$string = $this->personal_dictionary[array_rand($this->personal_dictionary)];		
		
		$sess_string=$string;		
		
		//if guess_set or guess_set_num
		switch(true){
			case $this->string_guess_set:
				$sess_string = $this->get_guess($string, $this->string_guess_set);
			break;
			case $this->string_guess_set_num:
				$sess_string = strlen($this->get_guess($string, $this->string_guess_set_num));
			break;
		}
		
		$_SESSION['ucaptcha_string'] = md5($sess_string);
		$this->captcha_string = $string;
		
		$this->drawText($color);
	}
	
	
	private function drawBgImage($img_name, $dst=false){
		$expl = explode('.', $img_name);
		$ext = end($expl);
		$im_tmp = false;
		switch($ext){
			case 'jpg':
			case 'jpeg':
				$im_tmp = imagecreatefromjpeg($img_name);
			break;
			case 'png':
				$im_tmp = imagecreatefrompng($img_name);
			break;
			case 'gif':
				$im_tmp = imagecreatefromgif($img_name);
			break;
			default : ;
		}
		if(!$im_tmp)return false;
		
		$tmp_width = imagesx($im_tmp);
		$tmp_height = imagesy($im_tmp);
		
		if(!$dst || (is_array($dst) && count($dst)!=4))$dst = array(0,0,$tmp_width, $tmp_height);
		if($dst && $dst[0] && $dst[0]<0)$dst[0]=0;
		if($dst && $dst[1] && $dst[1]<0)$dst[1]=0;	
		if($dst && $dst[2] && $dst[2]>$tmp_width)$dst[2] = $tmp_width-$dst[0];
		if($dst && $dst[3] && $dst[3]>$tmp_height)$dst[3] = $tmp_height-$dst[1];
		
		imagecopyresized($this->img1, $im_tmp, 0, 0, $dst[0], $dst[1], $this->width, $this->height, $dst[2], $dst[3]);
		imagedestroy($im_tmp);
	}
	
	
	private function drawChessboard($dim=FALSE) {
	
		$dimsq = $dim ? $dim : 5;
		$colCB = array($this->getColor('color_chessboard_0'), $this->getColor('color_chessboard_1'));
		
		$col = 0;
		$column = 0;

		$count= 0;
		for ($x = 0; $x <= $this->width; $x += $dimsq){

			for ($y = 0, $i = $count; $y <= $this->height; $y += $dimsq, $i++){
				
				$col_str = 'color_chessboard_'.($i%2);
				
				$c = ($this->$col_str == 'srand') ?   $this->bad_rand() : $colCB[$i%2];
				
				imagefilledrectangle($this->img1, $x, $y, $x + $dimsq-1, $y + $dimsq-1, $c);
				
			}
			$count++;
		}

	}

	private function drawCircles($num=false, $fill=false) {

		//check limit
		$numcircles = min((($num) ? $num : $this->num_circles), ucaptcha::MAX_NUM_CIRCLES);

		$min_radius = 10;
		$function = ($fill) ? 'imagefilledellipse' : 'imageellipse';
		
		
		$color = $this->getColor('color_circles');
		
		for ($i = 0; $i < $numcircles; $i++) {
			
			$c = ($this->color_circles == 'srand') ?   $this->bad_rand() : $color;
			
			$min = rand($min_radius, min($this->width, $this->height));
			$function($this->img1, rand(0, $this->width), rand(0, $this->height), $min, $min, $c );
		}
	}
	
	private function drawPolygons($num=false, $fill=false) {

		//check limit
		$numpoly = min((($num) ? $num : $this->num_polygons), ucaptcha::MAX_NUM_POLYGONS);

		$min_radius = 10;
		$function = ($fill) ? 'imagefilledpolygon' : 'imagepolygon';
		
		$color = $this->getColor('color_polygons');
		
		for ($i = 0; $i < $numpoly; $i++) {
			
			$c = ($this->color_polygons == 'srand') ?   $this->bad_rand() : $color;
			
			$num_dots = rand(3,5);
			$points = array();
			for($j = 0; $j<$num_dots; $j++)array_push ($points, rand(0,$this->width),rand(0,$this->height) );
			
			$min = rand($min_radius, min($this->width, $this->height));
			$function($this->img1, $points, $num_dots, $c);
			
		}
	}

	// parametric version
	private function drawTfunc() {
		$a = func_get_args();
		$arg = $a[0];
		
		$origX = $this->width/2;
		$origY = $this->height/2;
		$trange = $arg[2];
		
		$color = $this->getColor('color_functions');
	
		$last = array('x'=>$origX, 'y'=>$origY);
		$in =false;
		foreach($trange as $i) {
			
			$c = ($this->color_functions == 'srand') ?   $this->bad_rand() : $color;
			
			if(isSet($arg[3]) && $arg[3]){
				$tmpX = $origX + call_user_func($arg[0], $i);
				$tmpY = $origY + call_user_func($arg[1], $i);
				
				if($in)imageline($this->img1, $last['x'], $last['y'], $tmpX, $tmpY, $c);
				
				$last['x'] = $tmpX;
				$last['y'] = $tmpY;
				$in=true;
			}else{	
				imagesetpixel($this->img1, $origX + call_user_func($arg[0], $i), $origY + call_user_func($arg[1], $i), $c);
			}
		}
	}
	
	//polar version
	private function drawPfunc() {
		$a = func_get_args();
		$arg = $a[0];
		
		$origX = $this->width/2;
		$origY = $this->height/2;
		$trange = $arg[2];
		
		$color = $this->getColor('color_functions');
		
		$last = array('x'=>$origX, 'y'=>$origY);
		foreach($trange as $i) {
			
			$c = ($this->color_functions == 'srand') ?   $this->bad_rand() : $color;
			
			$r = call_user_func($arg[0], $i);
			$rho = call_user_func($arg[1], $i);

			$x = $r*cos( $rho );
			$y = $r*sin( $rho );
			
			if(isSet($arg[3]) && $arg[3]){
				$tmpX = $origX + $x;
				$tmpY = $origY + $y;
				
				imageline($this->img1, $last['x'], $last['y'], $tmpX, $tmpY, $c);
				
				$last['x'] = $tmpX;
				$last['y'] = $tmpY;
				
			}else{
				imagesetpixel($this->img1, $origX + $x, $origY + $y, $c);
				
				
			}
		}
		
		
	}	

	// carthesian version
	private function drawFunc() {
		$a = func_get_args();
		$arg = $a[0];
		
		$origX = $this->width/2;
		$origY = $this->height/2;
		$trange = $arg[1];
		
		$color = $this->getColor('color_functions');
		
		$last = array('x'=>$origX, 'y'=>$origY);
		foreach($trange as $i) {
			
			$y = call_user_func($arg[0], $i);
			$x = $i;

			$c = ($this->color_functions == 'srand') ?   $this->bad_rand() : $color;
			
			if(isSet($arg[2]) && $arg[2]){
				$tmpX = $origX + $x;
				$tmpY = $origY + $y;
				
				imageline($this->img1, $last['x'], $last['y'], $tmpX, $tmpY, $c);
				
				$last['x'] = $tmpX;
				$last['y'] = $tmpY;
				
			}else{
				imagesetpixel($this->img1, $origX + $x, $origY + $y, $c);
			}
		}		
		
	}	
	
	private function drawLogo($logo_file, $pos = false) {
		
		try{
			$img_logo = @imagecreatefromgif($logo_file);
		}catch(Exception $e){
			return false;
		}
		
		$x = imagesx($img_logo);
		$y = imagesy($img_logo);

		$pos = explode('_', $pos);
		$destX = 0;
		$destY = 0;
		switch ($pos[0]) {
			case 'u':
				$destY = 0;
				break;
			case 'c':
				$destY = ($this->height - $y) / 2;
				break;
			case 'd':
				$destY = $this->height - $y;
				break;
		}
		switch ($pos[1]) {
			case 'l':
				$destX = 0;
				break;
			case 'c':
				$destX = ($this->width - $x) / 2;
				break;
			case 'r':
				$destX = $this->width - $x;
				break;
		}
		imagecopy($this->img1, $img_logo, $destX, $destY, 0, 0, $x, $y);
		imagedestroy($img_logo);
	}	
	
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	  EFFECTS
	  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	
	private function EFF_rotate($angle0=false, $angle1=false) {
		
		if(!$angle0 && !$angle1)return;
		
		$angle = $angle1 ? rand($angle0, $angle1) : $angle0;
		
		$width_before = imagesx($this->img1);
		$height_before = imagesy($this->img1);
		$this->img1 = imagerotate($this->img1, $angle, $this->allcolors['color_bg']);
		//but is scaled so clip it
		
		$this->img2 = @imagecreatetruecolor($width_before, $height_before) or die("Cannot Initialize new GD image stream");
		$new_width = imagesx($this->img1);
		$new_height = imagesy($this->img1);
		imagecopyresampled ( $this->img2, $this->img1, 0, 0, ($new_width-$width_before)/2, ($new_height-$height_before )/2, $width_before, $height_before , $width_before, $height_before );
		$this->img1 = $this->img2;
	}
	
	
	
	private function EFF_warp($xp, $yp, $m, $h) {
		// $m � strength se  1  pari se <1 entrante se >1 uscente
		$U = imagesx($this->img1);
		$V = imagesy($this->img1);
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		for ($x = 0; $x < $U; $x++)
			for ($y = 0; $y < $V; $y++) {
				$dist = ($x - $xp) * ($x - $xp) + ($y - $yp) * ($y - $yp);
				if ($dist < $h * $h) {
					$hx = $hy = - ($m - 1) * ((sqrt($dist)) / $h) + $m;
					$u = abs((int) (($x + $xp * ($hx - 1)) / $hx));
					$v = abs((int) (($y + $yp * ($hy - 1)) / $hy));
				} else {
					$u = $x;
					$v = $y;
				}

				$real_Color = ( ($u < $U) && ($v < $V) ) ?
					ImageColorAt($this->img1, $u, $v) :
					ImageColorAt($this->img1, $x, $y);
				$color_tran = imagecolorsforindex($this->img1, $real_Color);
				
				imagecolorset($this->img1, 0, $color_tran['red'], $color_tran['green'], $color_tran['blue']);
				imagesetpixel($this->img2, $x, $y, $real_Color);
			}
		$this->img1 = $this->img2;
	}

	
	/**
	 * Generic affine transformation
	 *
	 * @param type $matrix 
	 */
	private function affine($matrix) {
		
		$U = imagesx($this->img1);
		$V = imagesy($this->img1);
		
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		
		$transMat = $matrix;
		
		for ($x = 0; $x < $U; $x++)
			for ($y = 0; $y < $V; $y++) {
				
				list($u, $v) = $this->vec_mat(array($x, $y, 1), $transMat);
			
				// remaining will be replaced with original ones
				if($u<0 || $v<0 || $u >= $this->width || $v >= $this->height){
					$u = $x;
					$v = $y;
				}
				
				$real_Color = ( ($u <= $U) && ($v <= $V) ) ?
					ImageColorAt($this->img1, $u, $v) :
					ImageColorAt($this->img1, $x, $y);

				$color_tran = imagecolorsforindex($this->img1, $real_Color);
				
				imagecolorset($this->img1, 0, $color_tran['red'], $color_tran['green'], $color_tran['blue']);
				imagesetpixel($this->img2, $x, $y, $real_Color);
			}
		$this->img1 = $this->img2;
	}
	
	
	private function EFF_shear($direction = 'x', $ab=false){
		
		if(!$ab)$ab = array(-10,10);
		
		$ab = rand($ab[0],$ab[1])*0.1;
		
		if ($direction == 'x') {
			$a = $ab;
			$b = 0;
		} else {
			$a = 0;
			$b = $ab;
		}
		//compose the shear matrix
		$transMat = array(array(1, $a, 0), array($b, 1, 0), array(0, 0, 1));
		
		$this->affine($transMat);		
	}

	
	private function EFF_wave() {		
		$xp =  $this->Xperiod * rand(1, 3);
		$k = rand(0, 100);
		for ($i = 0; $i<$this->width; $i++)
			imagecopy(
				$this->img1, $this->img1, $i-1, sin($k+$i/$xp)*$this->Xamplitude, $i, 0, 1, $this->height
			);
		
		$k = rand(0, 100);
		$yp =  $this->Yperiod * rand(1, 2);
		for ($i = 0; $i<$this->height; $i++)
			imagecopy(
				$this->img1, $this->img1, sin($k+$i/$yp)*$this->Yamplitude, $i-1, 0, $i, $this->width, 1
			);
		
	}

	private function EFF_breeze($how = 2, $dubb = FALSE) {
		$U = $this->width;
		$V = $this->height;
		
		
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		for ($y = 0; $y < $V; $y++){
			for ($x = 0; $x < $U; $x++) {
				if ($y % 2 == 0) {
					$u = $x + $how;
					$v = ($dubb) ? $y + $how : $y;
				} else {
					$u = $x;
					$v= $y;
				}
				
				$real_Color = (($u > 0 ) && ($v > 0) && ($u < $U) && ($v < $V) ) ?
					ImageColorAt($this->img1, $u, $v) :
					ImageColorAt($this->img1, $x, $y);
				$color_tran = imagecolorsforindex($this->img1, $real_Color);
				imagecolorset($this->img1, 0, $color_tran['red'], $color_tran['green'], $color_tran['blue']);
				imagesetpixel($this->img2, $x, $y, $real_Color);
			}
		}	
		$this->img1 = $this->img2;
	}

	private function xEFF_blur($how=3, $weight = 1, $shaped_border = TRUE) {
		$U = $this->width;
		$V = $this->height;
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);


		for ($y = (($shaped_border) ? 0 : $how); $y < (($shaped_border) ? $V : $V - $how); $y++){
			for ($x = (($shaped_border) ? 0 : $how); $x < (($shaped_border) ? $U : $U - $how); $x++) {

				//array per i colori con cui fare media
				$aroundcolors = array();
				for ($x1 = -$how; $x1 <= $how; $x1++)
					for ($y1 = -$how; $y1 <= $how; $y1++)
						array_push($aroundcolors, ImageColorAt($this->img1, $x + $x1, $y + $y1));
				$r = 0;
				$g = 0;
				$b = 0;
				foreach ($aroundcolors as $ac) {
					$r+= (float) (($ac >> 16) & 0xFF) * $weight;
					$g+= (float) (($ac >> 8) & 0xFF) * $weight;
					$b+= (float) ($ac & 0xFF) * $weight;
				}
				$r = intval($r / count($aroundcolors));
				$g = intval($g / count($aroundcolors));
				$b = intval($b / count($aroundcolors));


				$col = imagecolorallocate($this->img2, $r, $g, $b);

				//imagecolorset ( $this->img1, 0, $r, $g, $b);
				imagesetpixel($this->img2, $x, $y, $col);
			}
		}
		$this->img1 = $this->img2;
	}

		
	//for convolutions
	private function EFF_convolution($filter=false) {
		switch(true){
			case is_String($filter):
				if(array_key_exists($filter, $this->filters)){
					$a = isSet($this->filters[$filter][3])? $this->filters[$filter][3] : 1;
					$b = isSet($this->filters[$filter][4])? $this->filters[$filter][4] : 127;
					$f = array($this->filters[$filter][0], $this->filters[$filter][1], $this->filters[$filter][2]);
					imageconvolution($this->img1, $f, $a, $b);
				}
			break;
			case is_Array($filter):
				$a = isSet($filter[3])? $filter[3] : 1;
				$b = isSet($filter[4])? $filter[4] : 127;
				$f = array($filter[0], $filter[1], $filter[2]);
				imageconvolution($this->img1, $f, $a, $b);
			break;
		}
	}

	private function colorRGB($x, $y, $color) {

		$rgb = imagecolorat($this->img1, $x, $y);
		switch ($color) {
			case 0: return ($rgb >> 16) & 0xFF; //red
				break;
			case 1: return ($rgb >> 8 ) & 0xFF; //yellow
				break;
			case 2: return $rgb & 0xFF; //blue
				break;
		}
	}



	//
	//for random colors
	private function getColor($label) {

		return in_array($this->{$label},array('rand','srand')) ?
			$this->bad_rand() :
			$this->allcolors[$label];
	}

	private function getCharSets($override = false) {
		$choosen_set = $override ? $override : $this->string_char_set;
		$ret = array();
		foreach ($this->charSetArray as $k => $v)
			if ($choosen_set % $v == 0)
				$ret[] = $k;
		return $ret;
	}

	private function get_guess($string, $guess_mode){
		$fac = $this->getCharSets($guess_mode);
		$new_str = '';
		for($i = 0, $l = strlen($string);$i<$l; $i++ ){
			foreach($fac as $f){
				$s = substr($string,$i,1);
				if(in_array(ord($s), $this->charSets[$f]))
					$new_str.=$s;
			}
		}
		return $new_str;
	}
	
	
	/**
	 *
	 * @param integer $num
	 * @param type $sess
	 * @return type 
	 */
	private function randString($num=FALSE, $sess = FALSE) {

		$num = min(( ($num) ? $num : $this->string_lenght), ucaptcha::MAX_STRING_LENGHT);

		//recupero i fattori per gli insiemi
		$factors = $this->getCharSets();

		$string = '';
		for ($i = 0; $i < $num; $i++) {
			//tipo 0,1,2 (numerici, alfabetici minuscoli, alfabetici maiuscoli)
			//trovo tipo considerando gli insiemi possibili
			$tipo = $factors[rand(0, count($factors) - 1)];
			
			$rnd_k= array_rand($this->charSets[$tipo]);
			$string.= chr($this->charSets[$tipo][$rnd_k]);
		}

		if ($sess)return $string;
		
		$sess_string = $string;
		
		//if guess_set or guess_set_num
		switch(true){
			case $this->string_guess_set:
				$sess_string = $this->get_guess($string, $this->string_guess_set);
			break;
			case $this->string_guess_set_num:
				$sess_string = strlen($this->get_guess($string, $this->string_guess_set_num));
			break;
		}
	
		$_SESSION['ucaptcha_string'] = md5($sess_string);
		$this->captcha_string = $string;
	}

	//get rgb array from hexcolor
	public function hex_to_rgb($rgb1) {
		$rgb = (strlen($rgb1) > 6) ? substr($rgb1, strlen($rgb1) - 6, 6) : $rgb1;
		$r = base_convert(substr($rgb, 0, 2), 16, 10);
		$g = base_convert(substr($rgb, 2, 2), 16, 10);
		$b = base_convert(substr($rgb, 4, 2), 16, 10);
		return array('red' => $r, 'green' => $g, 'blue' => $b);
	}

	// get rgb array from integer
	private function int_to_rgb($rgb) {
		return array('red' => (($rgb >> 16) & 0xFF), 'green' => (($rgb >> 8) & 0xFF), 'blue' => ($rgb & 0xFF));
	}

	//get integer from rgb array
	private function rgb_to_int($arr) {
		return base_convert($arr['red'], 10, 16) . base_convert($arr['green'], 10, 16) . base_convert($arr['blue'], 10, 16);
	}

	public function rand_color() {
		$colRet = "";
		$i=0;
		$found = false;
		while (!$found) {
			$colRet = '';
			while ($i < 6){
				$colRet.=base_convert(rand(0, 15), 10, 16);
				$i++;
			}
			$i = 0;
			
			//decide if is good for the current background
			$ret1 = true;
			$ret2 = true;
			$sfondo = $this->color_bg;
			$msg = "";
			$rgb1 = (strlen($sfondo) > 6) ? substr($sfondo, 0, 6) : $sfondo;
			$rgb2 = (strlen($colRet) > 6) ? substr($colRet, 0, 6) : $colRet;

			$r1 = base_convert(substr($rgb1, 0, 2), 16, 10);
			$g1 = base_convert(substr($rgb1, 2, 2), 16, 10);
			$b1 = base_convert(substr($rgb1, 4, 2), 16, 10);
			$r2 = base_convert(substr($rgb2, 0, 2), 16, 10);
			$g2 = base_convert(substr($rgb2, 2, 2), 16, 10);
			$b2 = base_convert(substr($rgb2, 4, 2), 16, 10);

			$par1_1 = (($r1 * 299) + ($g1 * 587) + ($b1 * 114)) / 1000;
			$par1_2 = (($r2 * 299) + ($g2 * 587) + ($b2 * 114)) / 1000;
			$par2 = (max($r1, $r2) - min($r1, $r2)) + (max($g1, $g2) - min($g1, $g2)) + (max($b1, $b2) - min($b1, $b2));

			//check brightness and contrast
			if ($par1_1 - $par1_2 > 125)
				$ret1 = false; // > brightness problems
			if ($par2 < 500)
				$ret2 = false; //> contrast problems
			$found = ($ret1 && $ret2);
			
		}
		return $colRet;
	}

	/*
	 * utility vector*matrix multiplication
	 *                 | m00 m01 m02 |
	 *    (v0,v1,v2) * | m10 m11 m12 |
	 *                 | m20 m21 m22 |
	 */

	private function vec_mat($vec, $mat) {
		$ret = array();
		for ($i = 0; $i < count($vec); $i++)
			$ret[] = $vec[0] * $mat[$i][0] + $vec[1] * $mat[$i][1] + $vec[2] * $mat[$i][2];
		return $ret;
	}
	private function vec_mat0($vec, $mat) {
		$ret = array();
		for ($i = 0; $i < count($vec); $i++)
			$ret[] = $vec[0] * $mat[$i][0] + $vec[1] * $mat[$i][1];
		return $ret;
	}

	
	
	
	/*
	Build basic result
	*/
	private function base() {

		
		
		$this->img1 = @imagecreatetruecolor($this->width, $this->height) or die("Cannot Initialize new GD image stream");
		
		$this->allocateColors();
		
		switch(true){
			case $this->color_bg == 'noise':
				for ($x=0; $x < $this->width; $x++){
					for ($y=0; $y < $this->height; $y++){
						$rnd = rand(0 , 255);
						$temp_color = imagecolorallocate($this->img1, $rnd, $rnd, $rnd);
						imagesetpixel( $this->img1, $x, $y , $temp_color );
					}
				}
			break;
			case $this->color_bg == 'cnoise':
				for ($x=0; $x < $this->width; $x++){
					for ($y=0; $y < $this->height; $y++){
						$rnd1 = rand(0 , 255);
						$rnd2 = rand(0 , 255);
						$rnd3 = rand(0 , 255);
						$temp_color = imagecolorallocate($this->img1, $rnd1, $rnd2, $rnd3);
						imagesetpixel( $this->img1, $x, $y , $temp_color );
					}
				}
			break;
			default:
				imagefill($this->img1, 0, 0, $this->getColor('color_bg'));
			break;
		}
		
		return $this->img1;
	}

	
	private function begin(){ return $this->img1; }
	
	
	//apply all effects
	private function makeImage(){
		
		$this->randString($this->string_lenght);
		
		$apply_after = array();
		
		//mock first operation, do not remove that mock
		array_unshift($this->operations, 'begin');
		//  and even last
		$this->operations[] = 'begin';
			
		foreach ($this->operations as $k => $eo) {
			// params
			if (is_array($eo)) {			
				//manage double keys workaround
				$op  = preg_replace('/\_.*/', '', $eo[0]);  
				$params = $eo[1];
				//must be delayed?
				if (!in_array($op, $this->last_operation)) {
					$this->$op($params);				
				}else{
					$apply_after[] = array($op, $params);
				}
			//no params	
			}else {		
				//manage double keys workaround
				$eo  = preg_replace('/\_.*/', '', $eo); 
				//must be delayed?
				if (!in_array($eo, $this->last_operation)) {
					$this->$eo();
				}else{
					$apply_after[] = $eo;
				}
			}
		}

		//now apply late effects
		foreach ($apply_after as $k => $eo) {
			
			//params
			if (is_array($eo)) {
				$this->$eo[0]($eo[1]);
			//no params
			} else {
				$this->$eo();

			}
		}
	}
	

	/**
	 * fill buffer and print out image
	 * @return resource 
	 */
	public function drawImage() {
		ob_start();
		$this->base();
		$this->makeImage();
		header("Content-type: image/png");
		imagepng($this->img1);
		return ob_get_contents();
	}


}

