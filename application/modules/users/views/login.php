<div class="container">

	<?php 
	
	if (validation_errors()) {

		echo '<div class="alert alert-danger alert-dismissible" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
     	echo validation_errors();
     	echo '</div>';
	}
	
	if ($this->session->userdata('login_success')) {
		
		echo '<div class="alert alert-success alert-dismissible" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
     	echo $this->session->userdata('login_success');
     	$this->session->unset_userdata('login_success');

     	echo '</div>';
	}

	?>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">

				<div class="panel-heading">
					<h3>Log in to your account</h3>
				</div>

				<div class="panel-body">

					<?php

				    echo form_open('users/login_submit', 'class="form-horizontal"'); 

				    ?>

					<div class="form-group">
						<label class="col-md-3 control-label" for="Email">Email address</label>
						<div class="col-md-9">
						<?php 
						$other_attrib = 'class="form-control" id="Email"';
						$val = '';
						echo $val;
						echo form_input('email', $val , $other_attrib); 
						?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="Password">Password</label>
						<div class="col-md-9">
						<?php 
						$other_attrib = 'class="form-control" id="password"';
						$val = '';
						echo $val;
						echo form_password('password', $val , $other_attrib); 
						?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-12">
						<?php 
						echo form_submit('submit', 'Login', 'class="btn btn-block btn-success"'); 
						echo form_close();
						?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

