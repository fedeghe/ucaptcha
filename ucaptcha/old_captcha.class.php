<?php

require_once('../FirePHPCore/fb.php' );
error_reporting(E_ERROR);
session_start();

class captcha {

	// limit some values
	private $limits = array(
		'STRING_LENGHT' => 8,
		'NUM_LINES' => 100,
		'NUM_DOTS' => 500,
		'NUM_CIRCLES' => 100,
		'NUM_RANDCHARS' => 50
	);
	//	base colors
	private $color_black, $color_white, $color_red,
			$color_green, $color_blue;
	// colors        
	private $color_text, $color_bg, $color_line, $color_dot,
			$color_circles, $color_grind, $color_randchars, $color_functions,
			$color_chessboard_0, $color_chessboard_1;
	//	string params 
	private $string_lenght, $string_charSet, $string_font;
	// number params
	private $num_lines, $num_dots, $num_circles, $num_grind_px, $num_randchars;
	
	//string to recognise
	private $stringa;
	
	//PARAMETERS waving
	private $wave_scale;
	
	/** Wave configuration in X and Y axes */
	private $Yperiod;
	private $Yamplitude;
	private $Xperiod;
	private $Xamplitude;
	/** letter rotation clockwise */
	private $maxRotation;
	
	private $img1;
	private $img2;
	
	private $logo;
	
	//available fonts
	private $fonts = array();
	
	// effects queue
	private $operations = array();
	
	//allocated colors arrary
	private $allcolors = array();


	/*	 * variabile $charSet
	 *
	 * Da inizializzare a
	 *
	 * # 2 per numerici
	 * # 3 per alfabetici minuscoli
	 * # 5 per alfabetici maiuscoli
	 * # 7 per i simboli
	 * # un prodotto dei precedenti per combinazioni
	 */
	private $charSet;
	private $charSetArray = array(2, 3, 5, 7);
	/**
	 * intervalli ascii per numerici, alfabetici minuscoli, maiuscoli e simboli: 
	 *
	 * @access private
	 * @var array 
	 */
	private $charSets = array(
		array(48, 57),
		array(65, 90),
		array(97, 122),
		array(145, 255),
	);
	/**
	 * tutti i caratteri che non fanno parte di $charSets: 
	 *
	 * @access private
	 * @var array 
	 */
	private $noiseCharSet = array(
		array(33, 47),
		array(58, 64),
		array(91, 96),
		array(145, 255),
	);
	//lista delle operazioni  che verranno in ogni caso effettuate per ultime 
	// dopo qualunque effetto
	private $last_operation = array('logo');
	//valori di default
	private $defaults = array(
		'color' => array(
			//colori base, non sono intesi per essere modificati tramite l`array passato al costrutture 
			'black' => '000000',
			'white' => 'ffffff',
			'red' => 'ff0000',
			'green' => '00ff00',
			'blue' => '0000ff',
			'text' => '000000',
			'noise_text' => 'ffffff',
			'bg' => 'ffffff',
			'line' => 'ff0000',
			'dot' => '00ff00',
			'circles' => 'ff0000',
			'functions' => '0000ff',
			'randchars' => '000000',
			'grind' => 'aaaaaa',
			'chessboard_0' => '000000',
			'chessboard_1' => 'ffffff',
		),
		'string' => array(
			'lenght' => 5,
			'charSet' => 5,
		),
		'num' => array(
			'lines' => 50,
			'dots' => 500,
			'randchars' => 20,
			'chess_box' => 10,
			'circles' => 2,
			'grind_px' => 10,
		),
		
	// caso array (vedi costruttore)
	// qui sono da aggiungere gli effetti che vengono applicati ordinatamente nel caso non ne vengano passati
		'operations' => array('dots', 'lines', 'grind', 'text', 'warp'),
		'logo' => 'webfgk.gif',
		
		//anche se modificate da querystring e args poi la coda delle operazioni
		//viene ordinata secondo questo array prima di essere processata
		'order' => array('dots','lines','circles','sin','cos','chessboard','text','wave','shear','warp','gauss','breeze','blur','convolve','logo'),
		
	// WAVING Standard PARAMETERS
		'wave_scale' => 1, //(1: low, 2: medium, 3: high)
		'Yperiod' => 12,
		'Yamplitude' => 14,
		'Xperiod' => 11,
		'Xamplitude' => 5,
		
	// letter rotation clockwise
		'maxRotation' => 8,
	);
	//internal reflection object
	private $classRef;

	//handle unexistent calls
	function __call($nome, $pars) {
;
	}

	//	Costruttore
	/*
	  #	QUERY_STRING agisce su $args
	  #
	  #	args viene mergiato con la variabile di classe $defaults
	  #
	  #	da $args vengono valozizzate le variabili di classe
	 */
	function __construct($args = FALSE) {

		// buffer on 
		ob_start();


		/**
		 * Now merging is needed for obtaining a three level configuration:
		 * - default params within the captcha class (some of which cannot be deleted from querystring but only from args)
		 * - from the file which instantiate captcha (args)
		 * - from the querystring writed by javascript in the img tag src attribute
		 */
		$this->init_params($args);

		$this->classRef = new ReflectionClass('captcha');

		$this->load_fonts();
	}

	private function init_params($args = false) {
		
		/**
		 * First stage 
		 * *****************
		 * Parsing di eventuali paramentri in get (rep,add.rem)
		 * e aggiunta all`array passato
		 */

		$sq = $_SERVER['QUERY_STRING'];

		parse_str($sq);
		/*
		fb('add');
		fb($add);
		fb('rep');
		fb($rep);
		fb('rem');
		fb($rem);
		 



		fb('PRIMA');
		fb($args);
		*/
		 
		//ora potrebbero esserci $rep per rimpiazzare
		
		//fb('REPLACING');
		if (isSet($rep) && is_array($rep))
			foreach ($rep as $k => $el)
				foreach ($el as $k1 => $el2) {
					//se esiste in init allora lo sostituisco
						//fb('prima: '.$args[$k][$k1]);
					$args[$k][$k1] = $el2;
						//fb('dopo: '.$args[$k][$k1]);
						//fb($k.' '.$k1.' -> '.$el2);
				}
		//fb($args);
		//fb('ADDING');
		// o add per aggiungere (tipo effetti)
		if (isSet($add) && is_array($add))
			foreach ($add as $k => $el)
				foreach ($el as $k2 => $el2) {
					//aggiungo
					//fb($args[$k][$k2]);
					//fb('->');
					//fb($el2);
					array_push($args[$k], $el2);
				}
		//fb($args);
		//fb('REMOVING');
		// o rem per rimuovere (tipo effetti)
		if (isSet($rem) && is_array($rem))
			foreach ($rem as $k => $el)
				foreach ($el as $k2 => $el2) {
					//elimino da args se trovo
					foreach ($args[$k] as $kx => $op)
						if ($op == $el2) {
							unset($args[$k][$kx]);
						}
				}
	//	fb($args);
		/*
		 * ************** */



		/*****************
		 * Second stage 
		 * *****************
		 * Con $args modifico 
		 *
		 */
		if (!$args)
			$args = array();

		//per ognuna classe di default
		foreach ($this->defaults as $classe => $arr) {
			//$this->debug($classe . " " . $arr . "\n");
			/*			 * *
			 * nel caso in cui di default sia una variabile semplice e non un array
			 */
			if (!is_array($this->$classe)) {
				//se � array nelle classi di default allora
				if (is_array($this->defaults[$classe])) {
					//setto il default se non presente
					foreach ($this->defaults[$classe] as $k => $v)
						if (!isSet($args[$classe][$k]))
							$args[$classe][$k] = $this->defaults[$classe][$k];
					// valorizzo le altre (potrebbero anche non essere state dichiarate come variabili di classe)
					foreach ($args[$classe] as $k => $v)
						if (in_array($k, array_keys($args[$classe])))
							$this->{$classe . '_' . $k} = $v;
				}
				else
				// se non sono array li valorizzo col default o sovrascrivo (caso del logo)
					$this->$classe = (isSet($args[$classe])) ? $args[$classe] : $arr;
			}
			//se invece e` un array
			else {
				//caso di array (tipo "operations")
				//metto quelli di default

				foreach ($this->defaults[$classe] as $k => $v)
					array_push($this->$classe, $v);

				// sostituisco con gli eventuali passati
				if (isSet($args[$classe])) {
					$this->$classe = array();
					foreach ($args[$classe] as $k => $v)
						if (is_array($v))
							$this->{$classe}[$k] = $v;
						else
							array_push($this->$classe, $v);
				}
			}
		}
	}

	private function load_fonts() {
		$exclude_font = array('.', '..', '.svn');
		$dir = './/fonts//';
		if (is_dir($dir) && $dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (!in_array($file, $exclude_font))
					array_push($this->fonts, $file);
			}
			closedir($dh);
		}
	}

	private function allocateColors() {
		//per ognuno dei colori 
		#fb('setto colori');
		//$this->img1 = imagecreatetruecolor(1, 1);
		foreach ($this->defaults['color'] as $k => $v) {
			$hex_color = $this->hex_to_rgb($this->{'color_' . $k});
			$this->allcolors['color_' . $k] = imagecolorallocate($this->img1, $hex_color['red'], $hex_color['green'], $hex_color['blue']);
			#fb('settato');
			#fb($this->allcolors['color_'.$k]);
		}
		#fb($this->allcolors);
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	  PROXY EFFETTI

	  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	private function warp() {

		$raggio_min = 20;
		$raggio_max = 40;
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


		//$x = array('20','50','100','130','150','180','200','220','250','280','300','320','350','380','400','420');
		//$y = array('20','40','50','40','20','40','50','40');
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
		//die('num: '.$distance);
		$x = $y = $distance;
		//orizz
		while ($x < $this->width) {
			imageline($this->img1, $x, 0, $x, $this->height, $this->getColor('color_grind'));
			$x+=$distance;
		}
		$x = $y = $distance;
		while ($y < $this->height) {
			imageline($this->img1, 0, $y, $this->width, $y, $this->getColor('color_grind'));
			$y+=$distance;
		}
	}

	/**
	 * Wave filter
	 */
	private function wave() {
		$this->EFF_wave();
	}

	private function shear() {
		$this->EFF_shear('x', -0.15);
	}

	private function dots() {
		$this->drawDots();
	}

	private function lines($par = FALSE) {
		//die('chiamata lines('.print_r($par,true).')');
		$this->drawLines($par[0]);
	}

	private function chessboard($par = FALSE) {
		$this->drawChessboard($par[0]);
	}

	private function text($arg= FALSE) {

		$color = ($arg[0]) ? $this->getColor('color_' . $arg[0]) : $this->getColor('color_text');
		//echo "\n $color";
		// se come secondo parametro viene passato true allora rinnova la stringa
		if ($arg[1])
			$this->randString($this->string_lenght);
		if ($arg[2])
			$this->string_font = realpath('.//fonts//' . $this->onefont());
		$this->drawText($color);
	}

	private function onefont() {
		return $this->fonts[rand(0, count($this->fonts) - 1)];
	}

	private function gauss($arg = FALSE) {
		if ($arg)
			for ($i = 0; $i < $arg[0]; $i++)
				$this->EFF_gauss();
		else
			$this->EFF_gauss();
	}

	private function circles($arg = FALSE) {
		$this->drawCircles($arg[0], $arg[1]);
	}

	private function sin($arg = FALSE) {
		$this->drawSinCos('sin', $arg[0]);
	}

	private function cos($arg = FALSE) {
		$this->drawSinCos('cos', $arg[0]);
	}

	private function breeze($arg = FALSE) {
		if (isSet($arg[0]) && count($arg) == 1)
			$this->EFF_breeze($arg[0]);
		elseif (isSet($arg[0]) && isSet($arg[1]) && count($arg) == 2)
			$this->EFF_breeze($arg[0], $arg[1]);
		else
			$this->EFF_breeze();
	}

	private function blur() {
		$this->EFF_blur();
	}

	private function convolve($arr) {
		$this->EFF_convolution($arr);
	}

	private function randchars($arg = FALSE) {
		$this->drawRandchars($arg[0]);
	}

	private function drawRandchars($num =10, $maxsize = 40) {
		$numchars = min((($num) ? $num : $this->num_randchars), $this->limits['NUM_RANDCHARS']);
		for ($i = 0; $i < $numchars; $i++) {
			$char = $this->randString(1, true);

			$xrand = rand(0, $this->width);
			$yrand = rand(0, $this->height);
			$angle = rand(0, 360);

			$textsize = rand(1, $maxsize);

			imagettftext($this->img1, $textsize, $angle, $xrand, $yrand, $this->getColor('color_randchars'), $this->string_font, $char);
		}
	}

	private function logo($pos = false) {
		$_pos = ($pos[0]) ? $pos[0] : 'd_r';
		$this->drawLogo($_pos);
	}

//////////////////////////////////////////////
/////////////////////////////////////  DISEGNO
//////////////////////////////////////////////

	private function drawLines($num = FALSE) {

		$numlines = min((($num) ? $num : $this->num_lines), $this->limits['NUM_LINES']);

		for ($y = 0; $y < $numlines; $y++)
			imageline(
				$this->img1, rand(0, $this->width), rand(0, $this->height), rand(0, $this->width), rand(0, $this->height), $this->getColor('color_line')
			);
	}

	private function drawDots($num = FALSE) {
		$numdots = min((($num) ? $num : $this->num_dots), $this->limits['NUM_DOTS']);

		for ($i = 0; $i < $numdots; $i++)
			imagesetpixel(
				$this->img1, rand(0, $this->width), rand(0, $this->height), $this->getColor('color_dot')
			);
	}

	private function drawText($colore) {
		$absangle = 20;
		$angle = rand(0, $absangle) - ($absangle / 2);
		$angleini = rand(3, 7);
		$segno = rand() % 2;
		if ($segno == 0)
			$angle+=$angleini;
		else
			$angle-=$angleini;
		$y = 60;
		if(is_array($colore)){
			for($i=0; $i<$this->string_lenght; $i++)
				imagettftext($this->img1, 30, $angle, 30+$i*20, $y, $colore[$i], $this->string_font, substr($this->stringa, $i, 1) );
		}else{
			imagettftext($this->img1, 30, $angle, 30, $y, $colore, $this->string_font, $this->stringa);
		}
	}

	private function drawChessboard($dim=FALSE) {
		$dimsq = ($dim) ? $dim : $this->num_chess_box;
		$colCB = array($this->getColor('color_chessboard_0'), $this->getColor('color_chessboard_1'));
		//print_r($colCB);
		$col = 0;
		for ($x = 0; $x <= $this->width; $x += $dimsq)
			for ($y = 0; $y <= $this->height; $y += $dimsq)
				imagefilledrectangle($this->img1, $x, $y, $x + $dimsq, $y + $dimsq, $colCB[$col++ % 2]);
	}

	private function drawCircles($num, $fill) {

		//controllo che non sfori
		$numcircles = min((($num) ? $num : $this->num_circles), $this->limits['NUM_CIRCLES']);

		$min_radius = 10;
		$function = ($fill) ? 'imagefilledellipse' : 'imageellipse';
		for ($i = 0; $i < $numcircles; $i++) {
			$min = rand($min_radius, min($this->width, $this->height));
			$function($this->img1, rand(0, $this->width), rand(0, $this->height), $min, $min, $this->getColor('color_circles'));
		}
	}

	private function drawSinCos($tipo = 'sin', $num=FALSE) {

		$min_amp = 5;
		$max_amp = 30;
		$mult = ($num) ? $num : 0.1;
		$func = $tipo;
		$coeff = 1000 * (float) ($this->height / $this->width);

		$ca = (float) (rand(-$coeff, $coeff) / 1000);

		$b = $this->height / 2 - ( $ca * $this->width / 2 );
		$amp = rand($min_amp, $max_amp);
		$first = array(0, $b);
		for ($i = 1; $i < $this->width; $i++) {
			imageline(
				$this->img1, $first[0], $first[1], $i, $ca * $i + $amp * $func($mult * $i) + $b, $this->getColor('color_functions')
			);
//			imagesetpixel ( $this->img1, $i, $b + $ca*$i + $amp*sin($mult*$i), $this->getColor('color_line'));
			$first = array($i, $ca * $i + $amp * $func($mult * $i) + $b);
		}
		//traccia la direttrice
		/*
		  imageline(
		  $this->img1,
		  0,
		  $b,
		  $this->width,
		  $this->height - $b ,
		  $this->getColor('color_line')
		  );
		 */
	}

	private function drawLogo($pos = false) {
		$img_logo = @imagecreatefromgif($this->logo);
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

//
//
//
//
//
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	  EFFETTI
	  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

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

	private function EFF_shear($direction = 'x', $ab=1) {
		$U = imagesx($this->img1);
		$V = imagesy($this->img1);
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		if ($direction == 'x') {
			$a = $ab;
			$b = 0;
		} else {
			$a = 0;
			$b = $ab;
		}
		$transMat = array(array(1, $a, 0), array($b, 1, 0), array(0, 0, 1));

		for ($x = 0; $x < $U; $x++)
			for ($y = 0; $y < $V; $y++) {
				$uv = $this->vec_mat(array($x, $y, 1), $transMat);
				$u = $uv[0];
				$v = $uv[1];

				$real_Color = ( ($u <= $U) && ($v <= $V) ) ?
					ImageColorAt($this->img1, $u, $v) :
					ImageColorAt($this->img1, $x, $y);
				$color_tran = imagecolorsforindex($this->img1, $real_Color);
				imagecolorset($this->img1, 0, $color_tran['red'], $color_tran['green'], $color_tran['blue']);
				imagesetpixel($this->img2, $x, $y, $real_Color);
			}
		$this->img1 = $this->img2;
	}

	private function EFF_wave($direction = 0) {
		$U = imagesx($this->img1);
		$V = imagesy($this->img1);
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);

		//$this->img2 = $this->img1;
		// X-axis wave generation

		$xp = $this->wave_scale * $this->Xperiod * rand(1, 3);
		$k = rand(0, 100);
		for ($i = 0; $i < ($U * $this->wave_scale); $i++) {
			imagecopy(
				$this->img2, $this->img1, $i, sin($k + $i / $xp) * ($this->wave_scale * $this->Xamplitude), $i, 0, 1, $V * $this->wave_scale
			);
		}

		// Y-axis wave generation
		$k = rand(0, 100);
		$yp = $this->wave_scale * $this->Yperiod * rand(1, 2);
		for ($i = 0; $i < ($V * $this->wave_scale); $i++) {
			imagecopy(
				$this->img2, $this->img1, sin($k + $i / $yp) * ($this->wave_scale * $this->Yamplitude), $i, 0, $i, $U * $this->wave_scale, 1
			);
		}

		//.......
		//.......
		//.......TRANS
		//.......
		//.......
		$this->img1 = $this->img2;
	}

	private function EFF_ripple($xp, $yp, $m, $h) {
		$U = imagesx($this->img1);
		$V = imagesy($this->img1);
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		//.......
		//.......
		//.......TRANS
		//.......
		//.......
		$this->img1 = $this->img2;
	}

	private function EFF_breeze($how = 2, $dubb = FALSE) {
		$U = $this->width;
		$V = $this->height;
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);
		for ($y = 0; $y <= $V; $y++)
			for ($x = 0; $x <= $U; $x++) {
				//$uv = $this->vec_mat(array($x, $y, 1),$transMat);
				if ($y % 2 == 0) {
					$u = $x + $how;
					$v = ($dubb) ? $y + $how : $y;
				} else {
					$u = $x - $how;
					$v = ($dubb) ? $y - $how : $y;
				}
				//$v = $y;


				$real_Color = (($u > 0 ) && ($v > 0) && ($u < $U) && ($v < $V) ) ?
					ImageColorAt($this->img1, $u, $v) :
					ImageColorAt($this->img1, $x, $y);
				$color_tran = imagecolorsforindex($this->img1, $real_Color);
				imagecolorset($this->img1, 0, $color_tran['red'], $color_tran['green'], $color_tran['blue']);
				imagesetpixel($this->img2, $x, $y, $real_Color);
			}

		//.......
		//.......
		//.......
		//.......
		$this->img1 = $this->img2;
	}

	private function EFF_blur($how=3, $weight = 1, $shaped_border = TRUE) {
		$U = $this->width;
		$V = $this->height;
		$this->img2 = @imagecreatetruecolor($U, $V) or die("Cannot Initialize new GD image stream");
		imagepalettecopy($this->img2, $this->img1);


		for ($y = (($shaped_border) ? 0 : $how); $y < (($shaped_border) ? $V : $V - $how); $y++)
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

				/*
				  $r*=$weight;
				  $g*=$weight;
				  $b*=$weight;


				  fb($r);
				  fb($g);
				  fb($b);
				 */
				$col = imagecolorallocate($this->img2, $r, $g, $b);

				//imagecolorset ( $this->img1, 0, $r, $g, $b);
				imagesetpixel($this->img2, $x, $y, $col);
			}


		//.......
		//.......
		//.......
		//.......
		$this->img1 = $this->img2;
	}

	//funzione per filtro Gaussiano
	private function EFF_gauss() {
		$gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
		imageconvolution($this->img2, $gaussian, 16, 0);
	}

	//per convoluzioni
	private function EFF_convolution($mat = array(array(1, 4, 0), array(0, 1, 0), array(0, -4, 1))) {

		imageconvolution($this->img2, $mat, 1, 127);
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

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	  EFFETTI

	  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	//
	//per i colori random
	private function getColor($label) {
		#fb($label);
		#fb($this->allcolors);
		if($this->{$label} == 'superand'){
			$randcolorz = array();
			for($i = 0; $i<$this->string_lenght; $i++)
				$randcolorz[] = imagecolorallocate($this->img1, rand(0, 255), rand(0, 255), rand(0, 255));
			return $randcolorz;
		}
		
		return($this->{$label} == 'rand') ?
			imagecolorallocate($this->img1, rand(0, 255), rand(0, 255), rand(0, 255)) :
			$this->allcolors[$label];
	}

	private function getCharSets() {
		$ret = array();
		foreach ($this->charSetArray as $k => $v)
			if ($this->string_charSet % $v == 0)
				$ret[] = $k;
		return $ret;
	}

	//restituisce una stringa casuale
	//e la fissa in sessione
	private function randString($num=FALSE, $sess = FALSE) {

		$num = min(( ($num) ? $num : $this->string_lenght), $this->limits['STRING_LENGHT']);
		#fb($num);
		//if(!$num)$num = $this->string_lenght;
		//recupero i fattori per gli insiemi
		$factors = $this->getCharSets();
		#fb($factors);
		//print_r($factors);
		$stringa = '';
		for ($i = 0; $i < $num; $i++) {
			//tipo 0,1,2 (numerici, alfabetici minuscoli, alfabetici maiuscoli)
			//trovo tipo considerando gli insiemi possibili
			$tipo = $factors[rand(0, count($factors) - 1)];
			$stringa.= chr(rand($this->charSets[$tipo][0], $this->charSets[$tipo][1]));
		}

		//questo perch� normalmente la cambio tranne con la funzione randchars che chiamaquesta con false
		if ($sess)
			return $stringa;
		$_SESSION['stringa'] = md5($stringa);
		$this->stringa = $stringa;
	}

	//restiruisce l'rgb array dallla esadecimale
	private function hex_to_rgb($rgb1) {
		$rgb = (strlen($col1) > 6) ? substr($rgb1, strlen($rgb1) - 6, 6) : $rgb1;
		$r = base_convert(substr($rgb, 0, 2), 16, 10);
		$g = base_convert(substr($rgb, 2, 2), 16, 10);
		$b = base_convert(substr($rgb, 4, 2), 16, 10);
		return array('red' => $r, 'green' => $g, 'blue' => $b);
	}

	//restituisce l'rgb array dall'int
	private function int_to_rgb($rgb) {
		return array('red' => (($rgb >> 16) & 0xFF), 'green' => (($rgb >> 8) & 0xFF), 'blue' => ($rgb & 0xFF));
	}

	//restituisce l'int  dall'array rgb
	private function rgb_to_int($arr) {
		return base_convert($arr['red'], 10, 16) . base_convert($arr['green'], 10, 16) . base_convert($arr['blue'], 10, 16);
	}

	private function rand_color() {
		$colRet = "";
		$i = 0;
		$found = false;
		while (!$found) {
			//compongo il colore alla cazzo
			while ($i < 6)
				$colRet.=base_convert(rand(0, 15), 10, 16);
			//decido se rispetto al background pu� andare
			$ret1 = true;
			$ret2 = true;
			$sfondo = $this->bgColor;
			$msg = "";
			$rgb1 = (strlen($sfondo) > 6) ? substr($sfondo, strlen($col1) - 6, 6) : $sfondo;
			$rgb2 = (strlen($colRet) > 6) ? substr($colRet, strlen($col2) - 6, 6) : $colRet;

			$r1 = base_convert(substr($rgb1, 0, 2), 16, 10);
			$g1 = base_convert(substr($rgb1, 2, 2), 16, 10);
			$b1 = base_convert(substr($rgb1, 4, 2), 16, 10);
			$r2 = base_convert(substr($rgb2, 0, 2), 16, 10);
			$g2 = base_convert(substr($rgb2, 2, 2), 16, 10);
			$b2 = base_convert(substr($rgb2, 4, 2), 16, 10);

			$par1_1 = (($r1 * 299) + ($g1 * 587) + ($b1 * 114)) / 1000;
			$par1_2 = (($r2 * 299) + ($g2 * 587) + ($b2 * 114)) / 1000;
			$par2 = (max($r1, $r2) - min($r1, $r2)) + (max($g1, $g2) - min($g1, $g2)) + (max($b1, $b2) - min($b1, $b2));

			//ora decido con le formule contrasto e luminosit�
			if ($par1_1 - $par1_2 > 125)
				$ret1 = false; // > problemi luminosit�
			if ($par2 < 500)
				$ret2 = false; //> problemi contrasto
			$found = ($ret1 && $ret2);
		}
		return $colRet;
	}

	/*
	 * moltiplica vettore per matrice
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

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////// 
	//////////////////////////////////////////////////////////////// 
	//////////////////////////////////////////////////////////////// 
	//////////////////////////////////////////////////////////////// 
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////// 
	////////////////////////////////////////////////////////////////   
	////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////// 
	//////////////////////////////////////////////////////////////// 
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////// 
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	/////PUBLIC/////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	public function base($strLenght=NULL, $charSet=NULL) {
		//proofImage($stringa, $lines=20, $points=30)
		if ($strLenght)
			$this->string_lenght = $strLenght;
		if ($charSet)
			$this->string_charSet = $charSet;
		$this->randString($this->string_lenght);


		$this->string_font = realpath('.//fonts//arial.ttf');
		$this->height = 100;

		$this->width = 35 * strlen($this->stringa);
		$this->img1 = @imagecreatetruecolor($this->width, $this->height) or die("Cannot Initialize new GD image stream");
		$this->allocateColors();
		//print_r($this->allcolors);
		imagefill($this->img1, 0, 0, $this->getColor('color_bg'));
	}

	private function myorder($a, $b){
		//die();
		$a_index = array_search($a, $this->defaults['order']);
		$b_index = array_search($b, $this->defaults['order']);
		return ($a_index >= $b_index) ? 1 : -1; 
	}
	
	//applica tutti gli effetti
	public function makeImage() {
		#fb($this->last_operation);

		$apply_after = array();
		fb($this->operations);
		
		usort($this->operations, array(self,'myorder'));
		
		//order ops
		fb($this->operations);

		foreach ($this->operations as $k => $eo) {

			/** verifico se e' un elemento
			 * con chiave->array (e in questo caso e' funzione->parametri)
			 * o solo elemento (e quindi funzione senza parametri)
			 */
			if (is_array($eo)) {
				//se non e' in quelli finali

				if (!in_array($k, $this->last_operation)) {
					$this->$k($eo);
					#fb('caso 1');
					#fb($k);
				}
				else
					$apply_after[$k] = $eo;
			}
			else {
				//se non e' in quelli finali
				if (!in_array($eo, $this->last_operation)) {
					$this->$eo();
					#	fb('caso 2');
					#	fb($eo);
				}
				else
					array_push($apply_after, $eo);
			}
		}
		#fb($apply_after);
		//ora posso applicare glieffetti che prima avevo skippato
		foreach ($apply_after as $k => $eo) {
			/** verifico se e' un elemento
			 * con chiave->elemento (e in questo caso e' funzione->parametri)
			 * o solo elemento (e quindi funzione senza parametri)
			 */
			if (is_array($eo)) {
				$this->$k($eo);
				#fb($k);
			} else {
				$this->$eo();
				#fb($eo);
			}
		}
	}

	//riempie buffer
	public function drawImage() {
		header("Content-type: image/png");
		echo imagepng($this->img1);
		return ob_get_contents();
	}

	private function __get($var) {
		return $this->$var;
	}

	private function __set($var, $val) {
		$this->$var = $val;
	}

	//visualizza variabili e metodi dell'oggetto
	public function seeProperties() {
		$prop = $this->classRef->getProperties();
		foreach ($prop as $k) {
			if ($k->isPublic() || $k->isPrivate()) {
				$name = $k->getName();
				$value = (is_array($this->{$k->getName()})) ? print_r($this->{$k->getName()}, true) : $this->{$k->getName()};
				echo "$" . $name . " = " . $value . "\n";
			}
		}
	}

	//mostra ascii
	public function printChars() {
		for ($i = 0; $i < 256; $i++)
			echo "$i : " . chr($i) . "\n";
	}

}

?>
