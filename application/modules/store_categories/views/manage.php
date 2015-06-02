<h2><?php echo $headline;?></h2>


	<?php

	if (isset($flash)) {
		echo $flash;
	}

	if ($new_category_allowed == true) {

		echo anchor ('store_categories/create/x/' . $parent_category, 'Create New Category (on this level)');

	}


	if ($parent_category > 0 ) {

		echo nbs(3);

		echo anchor ('store_categories/create/' . $parent_category, 'Update Parent Category');

	}

	?>


<br>
<?php

echo Modules::run('store_categories/_display_categories_table', $parent_category);

?>

