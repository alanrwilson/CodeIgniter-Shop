

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class order_items extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _delete_order_items($order_id) {
	$this->load->model('mdl_order_items');
	$this->mdl_order_items->_delete_order($order_id);
}

function get_order_items ($order_id) {

	$this->load->model('mdl_order_items');

	$query = $this->mdl_order_items->get_order_items($order_id);
	//return $query->result();
	return $query;
}

function get($order_by) {
$this->load->model('mdl_order_items');
$query = $this->mdl_order_items->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_order_items');
$query = $this->mdl_order_items->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_order_items');
$query = $this->mdl_order_items->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_order_items');
$query = $this->mdl_order_items->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_order_items');
$this->mdl_order_items->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_order_items');
$this->mdl_order_items->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_order_items');
$this->mdl_order_items->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_order_items');
$count = $this->mdl_order_items->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_order_items');
$max_id = $this->mdl_order_items->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_order_items');
$query = $this->mdl_order_items->_custom_query($mysql_query);
return $query;
}

}
