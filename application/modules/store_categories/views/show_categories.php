<?php

  $this->load->view('nav_breadcrumb');

?>

<div class="container">
  
<div class="row">

  <?php 
          $data=Modules::run('store_categories/get_level_categories', $category_level);
          foreach ($data as $row) {

            $image_file = $row->small_pic;

            if ($image_file == null) {
              $image_file = "womens-jewelry_thumb.jpg";
            }
      ?>
            <div class="col-md-4">
              <div class="thumbnail">
                <a href="<?php echo base_url() . "store_categories/show_subcat_categories/" . $row->id; ?>"><img id="thumb_img" src="<?php echo base_url() . "itempics/" . $image_file; ?>" alt="..."></a>
                <div class="caption">
                  <h3><?php echo $row->category_name ?></h3>
                </div>
              </div>
            </div>
          
        <?php  } 

  ?>
</div>

</div>
