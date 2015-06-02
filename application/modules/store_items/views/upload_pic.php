<h2>Upload Item Picture</h2>

<?php

if (isset($error)) {
	foreach($error as $fault) {
		echo $fault;
	}
}

?>


<p>Choose a picture from you computer to upload</p>



<?php echo form_open_multipart('store_items/do_upload/'.$item_id);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>