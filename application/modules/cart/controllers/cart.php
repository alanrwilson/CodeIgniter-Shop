

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends MX_Controller
{

function __construct() {
	parent::__construct();

	$this->load->library('cart');
}

function checkout() {

	if (!$this->session->userdata('user_id')) {
		$this->session->set_userdata('checkout_attempted' , 'true');
		redirect(base_url() . 'users/login');
	} else {
		$data_line['user_details'] = Modules::run('users/get_user_details');
		$data_line['cart_summary'] = $this->get_cart_summary();
		$data_line['view_file'] = "checkout";
		$template = "public_one_col";
		$this->load->module('template');
		$this->template->$template($data_line);
	}
}

function delete_cart() {

	$this->cart->destroy();
}

function update_cart() {

	$data = $this->get_data_from_post();

	$cart_contents = $this->cart->contents();

	if ($data['submit'] == 'delete') {
		$data['quantity'] = 0;
	}

	if (!empty($cart_contents)) {

		foreach ($cart_contents as $cart_item) {

			if ($cart_item['id'] == $data['item_id']) {

				$cart_update = array(
               		'rowid' => $cart_item['rowid'],
               		'qty'   => $data['quantity']
            	);

            	$this->cart->update($cart_update);

            }
            	
		}

	}

	$this->session->set_userdata('cart_updated' , 'cart updated');
	$this->session->set_flashdata('cart_updated' , 'cart updated'); 
	$this->show_cart_contents();
}

function get_cart_summary() {

	$cart_contents = $this->cart->contents();

	$data['items_count'] = 0;

	$data['basket_total'] = 0; 

	if (!empty($cart_contents)) {

		foreach ($cart_contents as $cart_row) {

			$data['items_count']++;

			$data['basket_total'] += $cart_row['subtotal'];

		}

	}

	return $data;
}

function show_cart_contents() {

	$flash = $this->session->flashdata('cart_updated');

	$cart_contents = $this->cart->contents();

	$this->load->module('store_items');

	//print "<pre>";
	//print_r($cart_contents);
	//print "</pre>";

	//die();

	if (!empty($cart_contents)) {

		foreach ($cart_contents as $cart_row) {

			$data['row_id'] = $cart_row['rowid'];

			$data['item_id'] = $cart_row['id'];

			$data['item_colour'] =  $cart_row['options']['colour'];
			$data['item_size'] = $cart_row['options']['size'];
			$data['quantity'] = $cart_row['qty'];
	 
			$item_details = $this->store_items->get_data_from_db($data['item_id']);

			$data['item_name'] = $item_details['item_name'];
			$data['small_pic'] = $item_details['small_pic'];
			$data['item_price'] = $item_details['item_price'];

			$data['total_price'] = $item_details['item_price'] * $data['quantity'];

			if (is_numeric ($data['item_size'])) {

				$data['size_name'] = Modules::run('store_item_sizes/get_item_size_name', $data['item_size']);
			
			} else {
				$data['size_name'] = ' ';
			}

			if (is_numeric ($data['item_colour'])) {

				$data['colour_name'] = Modules::run('store_item_colours/get_item_colour_name', $data['item_colour']);

			} else {
				$data['colour_name'] = ' ';
			}

			//print_r($size_name);
	 
			//print_r($item_details);

			//die();


			$data_line['cart_items'][$data['row_id']]=$data;
		}
	}

	if ($flash != '') {
		$data_line['flash'] = $flash;
	}

	$data_line['view_file'] = "cart_items";

	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data_line);

}

function show_cart_widget() {

	$this->load->view('cart_widget');

}

function get_data_from_post() {

	$data['submit'] = $this->input->post('submit', TRUE);
	$data['colour'] = $this->input->post('colour', TRUE);
	$data['size'] = $this->input->post('size', TRUE);
	$data['quantity'] = $this->input->post('quantity', TRUE);
	$data['item_id'] = $this->input->post('item_id', TRUE);

	return $data;
}

function submit($item_id) {

	$this->load->library('form_validation');
	$this->form_validation->set_rules('quantity', 'Quantity', 'required');
  
    if ($this->form_validation->run() == FALSE)
    {
    	$this->session->set_flashdata('cart_val_errors', validation_errors());

    } else {

    	$data = $this->get_data_from_post();

    	//print_r($data); 

    	//die();

    	$this->load->module('store_items');

		$item_details = $this->store_items->get_data_from_db($data['item_id']);
		$data['item_name'] = $item_details['item_name'];
		$data['item_price'] = $item_details['item_price'];

    	$cartdata = array(
    	               'id'      => $item_id,
    	               'qty'     => $data['quantity'],
    	               'price'   => $data['item_price'],
    	               'name'    => $data['item_name'] ,
    	               'options' => array('size' => $data['size'], 'colour' => $data['colour'])
    	            );

    	$this->cart->insert($cartdata); 
    
		//print_r($this->cart->total_items());

		//print_r($this->cart->contents());

		$this->session->set_flashdata('cart_added' , 'cart added'); 

    }

    redirect(base_url() . 'store_items/showitem/' . $item_id);
}

function _display_add_to_cart_box($item_id, $item_price) {
	$data['item_id'] = $item_id;
	$data['item_price'] = $item_price;
	$data['currency'] = Modules::run('site_setttings/get_currency');
	$this->load->view('add_to_cart_box', $data);
}

function _draw_qty_dropdown($item_id) {

	$data = "";
	$this->load->view('draw_qty_dropdown', $data);
}

function get($order_by) {
$this->load->model('mdl_Cart');
$query = $this->mdl_Cart->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_Cart');
$query = $this->mdl_Cart->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_Cart');
$query = $this->mdl_Cart->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_Cart');
$query = $this->mdl_Cart->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_Cart');
$this->mdl_Cart->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_Cart');
$this->mdl_Cart->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_Cart');
$this->mdl_Cart->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_Cart');
$count = $this->mdl_Cart->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_Cart');
$max_id = $this->mdl_Cart->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_Cart');
$query = $this->mdl_Cart->_custom_query($mysql_query);
return $query;
}

}
