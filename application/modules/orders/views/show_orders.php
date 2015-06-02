<div class="container">

	<?php
  
    if ($this->session->userdata('delete_order_success')) {
      echo '<div class="alert alert-success alert-dismissible" role="alert">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      echo '<p class="text-center"><strong>' . $this->session->userdata('delete_order_success') . '</strong></p>';
      echo '</div>';

      $this->session->unset_userdata('delete_order_success');
  	}

    ?>

<div class="page-header">
  <h1>My Orders</h1>
</div>

<?php

$currency = Modules::run('site_settings/get_currency');

//var_dump($orders);


 foreach ($orders as $order) {
	
	?>

	<div class="panel panel-default">

	<div class="panel-heading">
		<div class="row">
			<div class="col-md-3">
				<h4><?php echo 'Order Placed: '; ?></h4>
			</div>
			<div class="col-md-2">
				<h4><?php echo 'Total '; ?></h4>
			</div>
			<div class="col-md-2">
				<h4><?php echo  'Payment State: '; ;?></h4>
			</div>
			<div class="col-md-2">
				<?php 
				echo form_open('orders/cancel_order', 'class="form-horizontal"'); 
				echo form_hidden('order_id', $order->order_id);
	            echo form_submit('submit', 'Cancel Order', 'class="btn btn-success btn-block"'); 
	            echo form_close();
	            ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<h5><?php echo $order->order_date; ?></h4>
			</div>
			<div class="col-md-2">
				<h5><?php echo $currency . number_format((float)$order->order_total, 2, '.', ''); ?></h4>
			</div>
			<div class="col-md-2">
				<h5><?php echo $order->payment_state; ?></h4>
			</div>
			
		</div>
	</div>

	<div class="panel-body">

		<?php 
		foreach ($order->order_items as $order_item) {
			?>

			<div class="row">
				<div class="col-md-3">
					<h5><?php echo $order_item->item_name; ?></h5>
				</div>
				<div class="col-md-2">
					<h5><?php echo $currency . number_format((float)$order_item->item_price , 2, '.', ''); ?></h5>
				</div>
				<div class="col-md-2">
					<h5><?php echo 'Qty: ' . $order_item->quantity; ?></h5>
				</div>
				<div class="col-md-2">
					<h5><?php echo  'Colour: ' . $order_item->item_colour ;?></h5>
				</div>
				<div class="col-md-2">
					<h5><?php echo  'Size: ' . $order_item->item_size ;?></h5>
				</div>
			</div>
			<?php } ?>
	</div>

	</div>

<?php } ?>

</div>