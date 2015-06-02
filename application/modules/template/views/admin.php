<html>

<head>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/admin.css"


</head>

<body>

	<div id="container">

			<h1>Admin Panel</h1>


				<?php 

				if (!isset($module)) {
					$module = $this->uri->segment(1);
				}

				if (!isset($view_file)) {
					$view_file = $this->uri->segment(2);

				}

				if (($module!="") && ($view_file!="")) {
					$path = $module."/".$view_file;
					$this->load->view($path);

				}
				

				?>
			
					
	</div>

</body>

</html>
