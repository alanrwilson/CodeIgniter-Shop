<h2>Update Item Colours</h2>

<div id="leftside">

	<p>Please Enter a coour and press 'Submit'</p>

	<?php

	echo form_open($form_location);

	echo form_input('item_colour');

	echo nbs(3);

	echo form_submit('submit', 'Submit');

	echo form_submit('submit', 'Cancel');


	echo form_close();

	?>

</div>

<div id="rightside">

	<?php 
	echo Modules::run('store_item_colours/_display_options_so_far', $item_id);

	?>

<div>

