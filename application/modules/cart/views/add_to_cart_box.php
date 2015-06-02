<div class="panel panel-default">
		  <!-- Default panel contents -->
	<div class="panel-heading">
		<h4>Add Item to Cart</h4>
	</div>

	<div class="panel-body">
		<?php
		echo form_open(base_url() . 'cart/submit/' . $this->uri->segment(3), 'class="form-horizontal"');
		echo form_hidden('item_id', $item_id);
		?>
		
		<button class="btn btn-info btn-block" type="submit" name="submit" value="Submit" >
		<span class="glyphicon glyphicon-plus"></span>
		 Add to Basket
		</button>

		<br>
		
		<div class="form-group">
	        <label for="" class="control-label col-sm-3">Colour</label>
	        <div class="col-sm-9">
	        <?php echo Modules::run ('store_item_colours/_draw_dropdown', $item_id); ?>
	        </div>
        </div>

        <div class="form-group">
	        <label for="" class="control-label col-sm-3">Size</label>
	        <div class="col-sm-9">
	        <?php echo Modules::run ('store_item_sizes/_draw_dropdown', $item_id); ?>
	        </div>
        </div>

        <div class="form-group">
	        <label for="" class="control-label col-sm-3">Qty</label>
	        <div class="col-sm-9">
	        <?php echo Modules::run ('cart/_draw_qty_dropdown', $item_id); ?>
	        </div>
        </div>
		<?php
		echo form_close()
		?>
	</div>
</div>

