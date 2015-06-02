<select name="quantity" class="form-control">
	<option value="">Choose Quantity..<option>
	<?php
	for ($i=0; $i < 9; $i++) {
		echo '<option value="' . $i. '">' .$i . '</option>';
	}
?>

</select>