<div class="container">

	<div class="page-header">
	  <h1>My Account</h1>
	</div>


	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">

				<div class="panel-heading">
					<h2>My Account Details</h2>
				</div>

				<div class="panel-body">

				<?php 

					if ($this->session->userdata('update_success')) {
						
						echo '<div class="alert alert-success alert-dismissible" role="alert">';
				        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				     	echo $this->session->userdata('update_success');
				     	$this->session->unset_userdata('update_success');

				     	echo '</div>';
					}

					if (validation_errors()) {

						echo '<div class="alert alert-danger alert-dismissible" role="alert">';
				        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				     	echo validation_errors();
				     	echo '</div>';
					}

				?>

				<?php echo form_open('users/update_account_submit', 'class="form-horizontal"'); ?>
						<div class="row">

							<div class="col-sm-12">
								<?php echo form_submit('submit', 'Update', 'class="btn btn-block btn-info"'); ?>
							</div>

						</div>

						<br>

						<?php echo form_hidden('id', $user_item['id']); ?>

						<div class="form-group">
							<label class="col-md-3 control-label" for="email">Email</label>
							<div class="col-md-9">
								<?php 
								$other_attrib = 'class="form-control" id="email"';
								$val = $user_item['email'];
								echo form_input('email', $val , $other_attrib); 
								?>
							</div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-3 control-label" for="firstname">First Name</label>
						  <div class="col-md-9">
						  <?php 
								$other_attrib = 'class="form-control" id="firstname"';
								$val = $user_item['firstname'];
								echo form_input('firstname', $val , $other_attrib); 
							?>
							</div>
						</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="lastname">Last Name</label>
						<div class="col-md-9">
							<?php 
							$other_attrib = 'class="form-control" id="lastname"';
							$val = $user_item['lastname'];
							echo form_input('lastname', $val , $other_attrib); 
							?>
						</div>
					</div>
					
					<div class="form-group">
					  <label class="col-md-3 control-label" for="address1">Address Line 1</label>
					  <div class="col-md-9">
					  <?php 
							$other_attrib = 'class="form-control" id="address1"';
							$val = $user_item['address1'];
							echo form_input('address1', $val , $other_attrib); 
						?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label" for="address2">Address Line 2</label>
						<div class="col-md-9">
							<?php 
							$other_attrib = 'class="form-control" id="address2"';
							$val = $user_item['address2'];
							echo form_input('address2', $val , $other_attrib); 
							?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="">City</label>
						<div class="col-md-9">
						<?php 
						$other_attrib = 'class="form-control" id="city"';
						$val = $user_item['city'];
						echo form_input('city', $val , $other_attrib); 
						?>
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-md-3 control-label" for="">Post Code</label>
						<div class="col-md-9">
						<?php 
						$other_attrib = 'class="form-control" id="postcode"';
						$val = $user_item['postcode'];
						echo form_input('postcode', $val , $other_attrib); 
						?>
						</div>
					</div>
				<?php
					 
				 	echo form_close(); 
				 ?>

				</div>
			</div>
		</div>
	</div>
</div>

