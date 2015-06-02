<h2>Additional Options</h2>

<ul>
	<li><?php echo anchor('store_item_colours/update/'. $item_id, 'Update Item Color'); ?> </li>
	<li><?php echo anchor('store_item_sizes/update/' . $item_id, 'Update Item Sizes'); ?> </li>
	<li><?php echo anchor('store_items/upload_pic/' . $item_id, 'Update Item Pictures'); ?> </li>
	<li><?php echo anchor('store_cat_assign/assign/' . $item_id, 'Assign to Category'); ?> </li>
	<li><?php echo anchor('store_items/delete_item/'.$item_id, '<span style="color: red">Delete Item</span>'); ?> </li>


</ul>