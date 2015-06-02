

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_settings extends MX_Controller
{

function __construct() {
parent::__construct();
}

function get_max_category_depth () {

	$max_depth = 3;

	return $max_depth;

}

function get_site_name () {
	$site_name = "The Cool Shop";

	return $site_name;

}

function get_owner_name () {

	$name = "Alan";

	return $name;
}

function get_owner_email () {

	$email = "blah@blah.com";

	return $email;
	
}

function get_currency () {

	$currency = "&pound;";

	return $currency;
}

function get($order_by) {
$this->load->model('mdl_site_settings');
$query = $this->mdl_site_settings->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_site_settings');
$query = $this->mdl_site_settings->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_site_settings');
$query = $this->mdl_site_settings->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_site_settings');
$query = $this->mdl_site_settings->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_site_settings');
$this->mdl_site_settings->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_site_settings');
$this->mdl_site_settings->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_site_settings');
$this->mdl_site_settings->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_site_settings');
$count = $this->mdl_site_settings->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_site_settings');
$max_id = $this->mdl_site_settings->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_site_settings');
$query = $this->mdl_site_settings->_custom_query($mysql_query);
return $query;
}

}
