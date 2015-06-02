

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends MX_Controller
{

function __construct() {
parent::__construct();
}

function order_item_full_details (){


/*
select oi.order_id, si.item_name, sic.item_colour, sis.item_size 
from 
order_items as oi
left outer join store_item_sizes as sis on oi.size=sis.id
left outer join store_item_colours sic on oi.colour=sic.id
join store_items as si on oi.item_id = si.id
*/


}

function cancel_order() {

	$order_id = $this->input->post('order_id', TRUE);

	$this->_delete($order_id);

	Modules::run('order_items/_delete_order_items', $order_id);

	if ($this->db->affected_rows() > 0) {
		$this->session->set_userdata('delete_order_success', 'Order Deleted Sucesfully!');
	} else {
		$this->session->set_userdata('delete_order_success', 'Order Delete Unsuccessfull!');
	}

	$this->show_orders();
}

function create_order() {

	$this->load->library('cart');
	
	$cart_contents = $this->cart->contents();

	$order_data['order_date'] = date('Y-m-d H:i:s');
	$order_data['user_id'] = $this->session->userdata('user_id');
	$order_data['payment_state'] = 'P';

	$this->_insert($order_data);

	$order_id = $this->db->insert_id();

	foreach ($cart_contents as $cart_line) {

		$item_data['order_id'] =  $order_id;
		$item_data['item_id'] = $cart_line['id'];
		$item_data['quantity'] = $cart_line['qty'];
		$item_data['price'] = $cart_line['price'];

		$item_data['size'] = $cart_line['options']['size'];
		$item_data['colour'] = $cart_line['options']['colour'];


		if ($item_data['size'] == '') {
			$item_data['size'] = null;
		}

		if ($item_data['colour'] == '') {
			$item_data['colour'] = null;
		}
		
		$this->mdl_orders->insert_order_item($item_data);
	}

	if ($this->db->affected_rows() > 0) {
		$this->cart->destroy();

		$data['view_file'] = "order_completed";
		$template = "public_one_col";
		$this->load->module('template');
		$this->template->$template($data);

	}
}

function get_open_orders($user_id) {

	echo "open orders " . $user_id;
}

function show_orders($user_id='') {

	$data['firstname'] = $this->session->userdata('firstname');
	$data['user_id'] = $this->session->userdata('user_id');

	$query = $this->get_where_custom('user_id', $data['user_id']);

	$orders = $query->result();

	$this->load->module('order_items');

	foreach ($orders as $order) {

		$order_total = 0;

		$order_items = $this->order_items->get_order_items($order->order_id);

		$data['orders'][$order->order_id] = $order;

		$data['orders'][$order->order_id]->order_items = array();

		foreach ($order_items as $order_item) {

			$data['orders'][$order->order_id]->order_items[$order_item->id]= $order_item;

			//var_dump($data['orders'][$order->order_id]->order_items[$order_item->id]);

			$order_total = (float)$order_total + (float)$order_item->item_price*(int)$order_item->quantity;

			//var_dump($order_item);

			//echo 'A:' . number_format((float)$order_total, 2, '.', '');
		}

		$data['orders'][$order->order_id]->order_total = $order_total;

	}

	//var_dump($data);

	$data['view_file'] = "show_orders";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data);

}

function get($order_by) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_orders');
$this->mdl_orders->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_orders');
$this->mdl_orders->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_orders');
$this->mdl_orders->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_orders');
$count = $this->mdl_orders->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_orders');
$max_id = $this->mdl_orders->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->_custom_query($mysql_query);
return $query;
}

}
