<h2>Category Assign</h2>

List of assigned categories

<?php

//echo "item id" . $item_id;

//$this->load->module('store_cat_assign');

//$this->store_cat_assign->_draw_assigned_categories($item_id);

echo Modules::run('store_cat_assign/_draw_assigned_categories', $item_id);

?>

<br><br>

<?php

$this->load->module('store_categories');

$available_categorites = $this->store_categories->get_end_of_line_categories();

print_r ($available_categorites);

//die();

$form_location = current_url();

echo form_open($form_location);

?>

<select name = "category_id"> 

	<?php 
	foreach ($available_categorites as $option) {

		$catname = $this->store_categories->get_category_name($option);

		$breadcrumb = $this->store_categories->get_breadcrumb($option);

		$category_name = $this->store_categories->get_category_name($option);

		echo "<option value='" . $option . "'>" . $breadcrumb . ' ' . $category_name . "</option>";

		// echo  $breadcrumb . ' ' . $category_name;

		// echo "<br>------------------------<br>";

	}

	?>

</select>

<?php

echo nbs(3);

echo form_submit('submit', 'Submit');

echo nbs(3);

echo form_submit('submit', 'Finished');

?>


