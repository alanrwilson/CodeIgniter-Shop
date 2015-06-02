<div class="container">

<div class="page-header">
	<h1>Review Your Order</small></h1>
</div>


<?php

if ($this->session->userdata('user_id')) {
	$currency = Modules::run('site_settings/get_currency');
} else {
	//redirect();
}

?>

<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h4><strong>Your Details</strong></h4></div>
		  <div class="panel-body">

		  	<div class="row">
			  	<div class="col-md-6">
				  	<table class="table">
				  		<th>
				  			<strong>Delivery Address</strong>
				  		</th>
						<tr>
							<td><?php echo $user_details['firstname'] . ' ' . $user_details['lastname']; ?></td>
						</tr>
						<tr>
							<td><?php echo $user_details['address1']; ?></td>
						</tr>
						<tr>
							<td><?php echo $user_details['address2']; ?></td>
						</tr>
						<tr>
							<td><?php echo $user_details['city']; ?></td>
						</tr>
						<tr>
							<td><?php echo $user_details['postcode']; ?></td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table>
			  	</div>

			  	<div class="col-md-6">
			  		<table class="table">
				  		<th>
				  			<strong>Payment Details</strong>
				  		</th>
						<tr>
							<td>Paypal</td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table>
			  	</div>
			</div>
		  </div>
		</div>
	</div>

	<div class="col-md-4">

		<div class="panel panel-default">

			<div class="panel-heading"><h4><strong>Order Summary</strong></h4></div>

			<div class="panel-body">
				<div class="form-group">
				<?php

					echo form_open('orders/create_order', 'class="form-horizontal"'); 
					echo form_submit('submit', 'Purchase', 'class="btn btn-success btn-block"'); 
					echo form_close();
				?>
				</div>

				<table class="table">
					<tr>
						<td>Items</td>
						<td><?php echo $currency . number_format($cart_summary['basket_total'], 2, '.', ''); ?></td>
					</tr>
					<tr>
						<td>Postage and Packing</td>
						<td><?php echo $currency . number_format(0, 2, '.', '')?></td>
					</tr>
					<tr>
						<td><h4>Order Total</h4></td>
						<td><h4><?php echo $currency . number_format($cart_summary['basket_total'], 2, '.', '');?> </h4></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>

				</table>
				<br>
				<br>	
			</div>
		</div>

	</div>
</div>

</div>