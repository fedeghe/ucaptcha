<h1>Settings array specifications</h1>
<p>
	That document is a reference for creating the setting array to be passed to the constructor of <i>ucaptcha</i> class
	<br />
	<br />
	All setting are passed to the constructor through an array structured like the following:
</p>
<p>
	<?php
	highlight_string('<?php
$setting = array(
	\'dimensions\' =>array(/* image dimensions here         */),	
	\'string\'     =>array(/* string settings go here       */),	
	\'operations\' =>array(/* containing noises and effects */),
	\'colors\'     =>array(/* color settings go here        */),
	\'nums\'       =>array(/* cardinality settings go here  */)
);
');
?>
</p>
<p>
	<b>NOTE</b>: In the setting array NO element is mandatory, you can even omit the setting array but the result will be a clean white default sized image.
</p>
