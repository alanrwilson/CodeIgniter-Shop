<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Magnam Designer Jewelry</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/creative.css" type="text/css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">


  <link href="<?php echo base_url(); ?>css/stylesheet.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/sticky-footer.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="jumbotron.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  
  <?php $this->load->view('header'); ?>
  <?php $this->load->view('nav_bar'); ?>
  <?php $this->load->view('carousel'); ?>


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

  <section id="about">
        <div class="container">
          <hr>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Welcome To Magam Jewellery</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond"></i>
                        <h3>Only Quality</h3>
                        <p class="text-muted">We are a quality high end Jewellers catering for the discering a discreet customer. We price ourselves on only supplying the finest hand picked stock.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane" data-wow-delay=".1s"></i>
                        <h3>Ready to Ship</h3>
                        <p class="text-muted">We will only selling goods that we would be happy wearing ourselves.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o" data-wow-delay=".2s"></i>
                        <h3>Happy to Advise</h3>
                        <p class="text-muted">We offer a free advise service.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart" data-wow-delay=".3s"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">Give someone you love a memorable gift they will keep for a lifetime from Magnam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <section id="contact">
        <div class="container">
          <hr>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <p> We are here to help, if you would like any information or help. Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">info@magnamjewellery.com</a></p>
                </div>
            </div>
        </div>
    </section>

  <?php $this->load->view("footer"); ?>
    
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>

</html>



