<?php 

	$data=Modules::run('cart/get_cart_summary');

	echo '<li class="dropdown">';
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span>Basket <br>' . $data['items_count'] . " items &pound;" . $data['basket_total'] . '<span class="caret"></span></a>';
	echo '<ul class="dropdown-menu" role="menu">';
	echo '<li class="divider"></li><li>' . anchor(base_url(). 'cart/show_cart_contents', 'Cart Contents', 'class=""') . '</li><li class="divider"></li>'; 
    echo '</ul>';
    echo '</li>';
?>