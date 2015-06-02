

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_security extends MX_Controller
{

function __construct() {
parent::__construct();
}

function check_is_admin() {
	//make sure the user has logged in as admin

	if ($this->session->userdata('user_id') == 1) {
		return true;
	} else {
		echo "you are not admin!";
		die();
	}
}

function get($order_by) {
$this->load->model('mdl_Site_security');
$query = $this->mdl_Site_security->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_Site_security');
$query = $this->mdl_Site_security->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_Site_security');
$query = $this->mdl_Site_security->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_Site_security');
$query = $this->mdl_Site_security->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_Site_security');
$this->mdl_Site_security->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_Site_security');
$this->mdl_Site_security->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_Site_security');
$this->mdl_Site_security->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_Site_security');
$count = $this->mdl_Site_security->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_Site_security');
$max_id = $this->mdl_Site_security->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_Site_security');
$query = $this->mdl_Site_security->_custom_query($mysql_query);
return $query;
}

}
