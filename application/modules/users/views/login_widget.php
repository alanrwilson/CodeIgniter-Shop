<?php

if ($this->session->userdata('user_id')) {
	echo '<li class="dropdown">';
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, ' .  $this->session->userdata('firstname') . '<br>Your Account' . '<span class="caret"></span></h5></a>';
	echo '<ul class="dropdown-menu" role="menu">';
	echo '<li>' . anchor(base_url() . 'orders/show_orders', 'My Orders', 'class=""') . '</li><li class="divider"></li>';
	echo '<li>' . anchor(base_url() . 'users/account', 'My Account', 'class=""') . '</li><li class="divider"></li>';

	if ($this->session->userdata('user_id') == 1) {
		echo '<li>' . anchor(base_url() . 'dashboard', 'Dashboard', 'class=""') . '</li><li class="divider"></li>';
	}
	echo '<li>' . anchor(base_url() . 'users/logout', 'Logout', 'class=""') . '</li><li class="divider"></li>';
	echo '</ul>';
	echo '</li>'; 

}else {

	echo '<li class="dropdown">';
	echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello. Sign in<span class="caret"></span></a>';
	echo '<ul class="dropdown-menu" role="menu">';
	echo '<li>' . anchor(base_url(). 'users/login', 'Sign In To Your Account', 'class=""') . '</li><li class="divider"></li>'; 
    echo '<li>' . anchor(base_url() . 'users/create_account', 'Create Account', 'class=""') . '</li><li class="divider"></li>';
    echo '</ul>';
    echo '</li>';
}

?>
    
   
   
