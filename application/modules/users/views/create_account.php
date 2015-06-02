<div class="container">

<div class="page-header">
  <h1>Create Account</h1>
</div>


<?php 
	
	if (validation_errors()) {

		echo '<div class="alert alert-danger alert-dismissible" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
     	echo validation_errors();
     	echo '</div>';
	}

?>

<div class="panel panel-default">

<div class="panel-heading">
	<h2>Account Details</h2>
</div>

<div class="panel-body">

  <?php echo form_open('users/create_account_submit', 'class="form-horizontal"'); ?>
	
		<div class="form-group">
			<label class="col-sm-2 control-label" for="email">Email</label>
			<div class="col-sm-5">
				<?php 
				$other_attrib = 'class="form-control" id="email"';
				$val = $user_item['email'];
				echo form_input('email', $val , $other_attrib); 
				?>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-2 control-label" for="password1">Password</label>
			<div class="col-sm-5">
			<?php 
			$other_attrib = 'class="form-control" id="password"';
			$val = $user_item['password1'];
			echo form_password('password1', $val , $other_attrib); 
			?>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-2 control-label" for="password2">Password Confirm</label>
			<div class="col-sm-5">
			<?php 
			$other_attrib = 'class="form-control col-sm-10" id="password2"';
			$val = $user_item['password2'];
			echo form_password('password2', $val , $other_attrib); 
			?>
			</div>
		</div>

		<div class="form-group">
		  <label class="col-sm-2 control-label" for="firstname">First Name</label>
		  <div class="col-sm-5">
		  <?php 
				$other_attrib = 'class="form-control" id="firstname"';
				$val = $user_item['firstname'];
				echo form_input('firstname', $val , $other_attrib); 
			?>
			</div>
		</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label" for="lastname">Last Name</label>
		<div class="col-sm-5">
			<?php 
			$other_attrib = 'class="form-control" id="lastname"';
			$val = $user_item['lastname'];
			echo form_input('lastname', $val , $other_attrib); 
			?>
		</div>
	</div>
	
	<div class="form-group">
	  <label class="col-sm-2 control-label" for="address1">Address Line 1</label>
	  <div class="col-sm-5">
	  <?php 
			$other_attrib = 'class="form-control" id="address1"';
			$val = $user_item['address1'];
			echo form_input('address1', $val , $other_attrib); 
		?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label" for="address2">Address Line 2</label>
		<div class="col-sm-5">
			<?php 
			$other_attrib = 'class="form-control" id="address2"';
			$val = $user_item['address2'];
			echo form_input('address2', $val , $other_attrib); 
			?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="">City</label>
		<div class="col-sm-5">
		<?php 
		$other_attrib = 'class="form-control" id="city"';
		$val = $user_item['city'];
		echo form_input('city', $val , $other_attrib); 
		?>
		</div>
	</div>

	
	<div class="form-group">
		<label class="col-sm-2 control-label" for="">Post Code</label>
		<div class="col-sm-5">
		<?php 
		$other_attrib = 'class="form-control col-sm-10" id="postcode"';
		$val = $user_item['postcode'];
		echo form_input('postcode', $val , $other_attrib); 
		?>
		</div>
	</div>
<?php
	echo form_submit('submit', 'submit', 'class="btn btn-info btn-lg btn-block"'); 
 	echo form_close(); 
 ?>

</div>
</div>
</div>

