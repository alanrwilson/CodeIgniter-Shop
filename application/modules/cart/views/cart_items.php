<div class="container">

  <div class="page-header">
  <h1>Your Shopping Cart</h1>
</div>

<?php
  //if (isset($flash)) {
    if ($this->session->userdata('cart_updated')) {
      $this->session->unset_userdata('cart_updated');

      ?>

      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="text-center"><strong>Cart Updated!</strong></p>
      </div>

    <?php
    }
    
if (!empty($cart_items)) { ?>

   <div class="row">
    <div class="col-md-8">

<?php foreach ($cart_items as $cart_item) { ?>   

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3><?php echo $cart_item['item_name']; ?></h3>
        </div>
        <div class="panel-body">
          <div class="col-md-6">
            <?php $pic_path = base_url() . "itempics/" . $cart_item['small_pic']; ?>
            <img src="<?php echo $pic_path; ?>">
        	</div>
          <div class="col-md-6">
            <?php echo form_open('cart/update_cart', 'class="form-horizontal"'); ?>
              <div class="form-group">
                <label for="quantity" class="control-label col-md-3">Quantity:</label>
                <div class="col-md-9">
                    <?php 
                      $options = array();
                      for ($i=0; $i<10; $i++) {
                        $options[] = $i;
                      }
                      echo form_dropdown('quantity', $options, $cart_item['quantity'], 'class="form-control"');
                    ?>
                </div>
              </div>
              <div class="form-group">
                <label for="size_name" class="control-label col-md-3">Size:</label>
                <div class="col-md-9">
                  <?php 
                  $other_attrib = 'disabled class="form-control" id="size_name"';
                  $val = $cart_item['size_name'];
                  echo form_input('size_name', $val , $other_attrib); 
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="colour_name" class="control-label col-md-3">Colour:</label>
                <div class="col-md-9">
                  <?php 
                  $other_attrib = 'disabled class="form-control" id="colour_name"';
                  $val = $cart_item['colour_name'];
                  echo form_input('colour_name', $val , $other_attrib); 
                  ?>
                </div>
              </div>
            <?php $currency = Modules::run('site_settings/get_currency');?>
            <div class="form-group">
              <label for="" class="control-label col-md-3">Price:</label>
              <div class="col-md-9">
                <?php echo '<input disabled class="form-control" id="" type="text" placeholder="' . $currency . str_replace('.00', '', number_format($cart_item['item_price'], 2)) . '">'; ?>
              </div>
            </div>
             <div class="form-group">
              <label for="" class="control-label col-md-3">Total:</label>
              <div class="col-md-9">
                <?php echo '<input disabled class="form-control id="" type="text" placeholder="' . $currency . str_replace('.00', '', number_format($cart_item['total_price'], 2)) . '">'; ?>
              </div>
            </div>
            <div class="foorm-group">
  
              <?php
                 echo form_hidden('item_id', $cart_item['item_id']);
                 echo '<div class="foorm-control">';
                 echo form_submit('submit', 'delete', 'class="col-md-offset-3 col-md-4 btn btn-info "'); 
                 echo form_submit('submit', 'update', 'class="col-md-offset-1 col-md-4 btn btn-info "');
                 echo '</div>'; 
                  echo form_close();
              ?>

            
          </div>
        </div>
      </div>
    </div>
      

<?php } ?>

</div>

<div class="col-md-4">
  <div class="panel panel-default">
      <div class="panel-body">
        <h4>Total: £0.00</h4>
      <?php
      echo form_open('cart/checkout', 'class="form-horizontal"');
      echo form_submit('submit', 'Checkout', 'class="btn btn-info btn-lg btn-block"'); 
      echo form_close();
      ?>
      </div>
  </div>
</div>

<?php } else {

  echo "<h2>The Cart Is Empty</h2>";


} ?>

</div>
</div>

