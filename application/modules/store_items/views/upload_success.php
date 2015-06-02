<h2>Upload Success</h2>
<p>The image was successfully uploaded.</p>

<p><?php echo anchor('store_items/create/'.$item_id, 'Return to item edit');?>
</p>

<?php 
if (isset($big_pic)) {
	$pic_ath = base_url()."itempics/".$big_pic;
	echo "<p>";
	echo "<img src='".$pic_ath."'>";
	echo "</p>";

}
?>

