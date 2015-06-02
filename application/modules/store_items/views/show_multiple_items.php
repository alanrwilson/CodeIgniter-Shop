<?php

  $this->load->view('nav_breadcrumb');

?>

<div class="container">
  
<div class="row">

  

<?php 

if (isset($category_items)) {

  foreach ($category_items as $item) {

    if ($item['big_pic'] == null) {
      $item['big_pic'] = "womens-jewelry_thumb.jpg";
    }

  echo '<div class="col-md-4">';

  echo '<div class="thumbnail">';


    
    //print_r($item);


echo '<div class="caption">'  . "<h4>" .  $item['item_name'] . "</h4>" . "</div>";


          $pic_path = base_url() . "itempics/" . $item['big_pic'];
          ?>
          <a href="<?php echo base_url() . "store_items/showitem/" . $item['item_id'] ?>"><img id="thumb_img" src="<?php echo $pic_path; ?>"></a>
          <?php
          $currency = Modules::run('site_settings/get_currency');

          ?>
          <h4>Price: <?php echo $currency; echo str_replace('.00', '', number_format($item['item_price'], 2)); ?></h4>
        
       </div> 

       </div>


       <?php } 

} else {
  echo "<H3>No Items In Category</h3>";
} 

//$breadcrumb = Modules::run('store_categories/produce_nav_breabcrumb', $category_level);

//echo $breadcrumb;

?>

    </div>
 </div>

