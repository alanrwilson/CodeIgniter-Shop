<h2><?php echo $headline;?></h2>

<div id="leftside">


	<?php 

	if (isset($flash)) {
		echo $flash;
	}

	echo validation_errors("<p style='color: red'>", "</p>");
	echo form_open($form_location);
	form_close();

	?>

	<table cellpadding="7" cellspacing="0" border="0" width="600">

		<tr>
			<td valign="top">Category Name</td>
			<td><?php echo form_input('category_name', $category_name);?></td>
		</tr>
		<tr>
			<td valign="top">Priority</td>
			<td><?php echo form_input('priority', $priority);?></td>
		</tr>
		<tr>
			<td valign="top">Thumb Image</td>
			<td><span class="btn btn-default btn-file"><?php echo form_upload('small_pic', $small_pic);?></span></td>
			<td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td><?php echo form_submit('submit', 'Submit');?></td>
		</tr>



	</table>

	<?php echo form_close(); ?>

</div>

<div id="rightside">
	<?php 
		if($category_id > 0) {
			//we are editing an item
			include ('additional_options.php');
		}
	?>


</div>


