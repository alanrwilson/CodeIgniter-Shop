<div class="container">

  <?php
  //if (isset($flash)) {

  if ($this->session->flashdata('cart_val_errors')) {
      ?>

      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="text-center"><strong><?php echo $this->session->flashdata('cart_val_errors') ?></strong></p>
      </div>

      <?php
      
    }

    if ($this->session->flashdata('cart_added')) {
      ?>

      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="text-center"><strong>Added to Cart</strong></p>
      </div>

      <?php
      
    }
  ?>

  <div class="row">
    <div class="col-md-4">
      <?php 
      $pic_path = base_url() . "itempics/" . $big_pic;
      ?>
      <img src="<?php echo $pic_path; ?>">
    </div>
    <div class="col-md-4">
      <h1>
      <?php echo $item_name; ?>
      </h1>
      <h4>Item Id: <?php echo $item_id; ?></h4>
      <?php 
        $currency = Modules::run('site_settings/get_currency');
        echo '<h4>Price: ' . $currency; echo str_replace('.00', '', number_format($item_price, 2)) . '</h4>'; 
        echo nl2br($item_description); ?>
    </div>
    <div class="col-md-4">
      <?php
      echo Modules::run('cart/_display_add_to_cart_box', $item_id, $item_price);
      ?>
    </div>
  </div>
</div>