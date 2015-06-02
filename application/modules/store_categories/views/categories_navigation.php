<?php 
	$data=Modules::run('store_categories/get_level_categories', 0);
    foreach ($data as $row) {

    	echo "<li><a href=" . base_url() . "store_categories/show_subcat_categories/" . 
    	$row->id . ">" .  $row->category_name .  "</a></li>" ;
    }

?>