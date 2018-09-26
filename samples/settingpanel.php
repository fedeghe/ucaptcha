<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> UCHAPTCHA v 1.0 (setting panel)</title>
		<link rel ="stylesheet" href="stylepanel.css" type="text/css"/>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript"><?php include('../js/panel.js'); ?></script>
	</head>
	<body >	
		<h1>Setting array generator utility</h1>
		<fieldset>
			<legend>Text</legend>
			<table>
				<tr valign="top">
					<td>
						Select a mode to generate the string
					</td>
					<td>
						<input type="radio" name="text_source" value="text" id="text" checked="checked"/> <label for="text">random</label>
						<br />
						<input type="radio" name="text_source" value="dtext" id="dtext"/> <label for="dtext">dictionary.txt</label>
					</td>
				</tr>
			</table>
			<hr />
			<label for="dtext">Font-size</label>
			<select name="font_size">
				<?php
				$r = range(5,100);
				foreach($r as $i)echo '<option value="'.$i.'" '.($i==15?'selected="selected"':'').'>'.$i.'</option>';
				?>
			</select>
			
			<div id="charset_switch">
				<hr />
				<table>
					<tr valign="top">
						<td>
							Charset
						</td>
						<td>
							<input type="checkbox" name="charset[]" value="num" id="num" checked="checked"/> <label for="num">numbers</label>
							<br />
							<input type="checkbox" name="charset[]" value="upper" id="upper"/> <label for="upper">lowercase</label>
							<br />
							<input type="checkbox" name="charset[]" value="lower" id="lower"/> <label for="lower">UPPERCASE</label>
							<br />
							<input type="checkbox" name="charset[]" value="symb" id="symbols"/> <label for="symbols">Symbols</label>
						</td>
					</tr>
				</table>
			</div>
		</fieldset>
		<fieldset>
			<legend>Image Dimensions</legend>
			<label>width</label><input type="text" name="width" value="" id="image_width"/> 
			<br />
			<label>height</label><input type="text" name="height" value="" id="image_height"/> 
		</fieldset>
		<fieldset>
			<legend>Noises</legend>
		</fieldset>
		<fieldset>
			<legend>Effects</legend>
			
			<div id="noises">
				<label>Add an effect:</label>
				<select id="adding_effect">
					<option>--select one--</option>
					<option>dots</option>
					<option>lines</option>
					<option>circles</option>
					<option>polygons</option>
					<option>grind</option>
					<option>chessboard</option>
					<option>rand chars</option>
					<option>back noise</option>
					<option>your function</option>
					<option>background image</option>
				</select><input type="button" value="+" id="add_effect"/>
			</div>
			<div id="noises_container">
				<ul  id="noises_list">
				</ul>
			</div>
			<div class="clearer">&nbsp;</div>
			
			
		</fieldset>
		<fieldset>
			<legend>Other</legend>
		</fieldset>
		<input type="button" value="Get setting array" id="go" />
	</body>
</html>
