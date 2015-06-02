<?php 

 foreach ($query->result() as $row) {

	$cat_name =$row->category_name;
	$id = $row->id;

	echo "<a href=" . base_url() . 'store_categories/get_top_level_categories/' . $id . ">" . $cat_name . "</a>";

	echo "<br>";

}

//print_r($query->result());

//$category_id . <br> . $category_name . <br> 

?> 