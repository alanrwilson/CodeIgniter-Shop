<nav class="header navbar navbar-default">
  <div class="container-fluid">
    <div class="col-sm-5">
      <div id="logo">
          <!-- <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>images/logo.png"></a><br> -->
        <h1>Magnam<small> Designer Jewellery</small></h1>
      </div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li>
            <?php echo Modules::run('cart/show_cart_widget'); ?>
          </li>
          <li>
            <?php echo Modules::run('users/show_login_widget'); ?>
          </li>
        </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>

  </div>
</nav>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript">
            $(function(){
    			$('#logo').click(function(e) {  
      				window.location.href = "<?php echo base_url() ?>"
    			});

    			$("#logo").hover(function() {
    				$(this).css('cursor','pointer');
    			});

			});
        </script>
