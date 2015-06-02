

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MX_Controller
{

function __construct() {
	parent::__construct();
}

function show_login_widget() {
	$this->load->view('login_widget');
}

function get_user_details() {

	$query = $this->get_where_custom('id', $this->session->userdata('user_id'));

	foreach ($query->result() as $row) {
		$data['firstname'] = $row->firstname;
		$data['lastname'] = $row->lastname;
		$data['address1'] = $row->address1;
		$data['address2'] = $row->address2;
		$data['city'] = $row->city;
		$data['postcode'] = $row->postcode;
	}

	return $data;
}

function login() {

	$data_line['view_file'] = "login";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data_line);
}

function logout() {
	$this->session->unset_userdata('firstname');
	$this->session->unset_userdata('user_id');
	$this->session->unset_userdata('login_success');

	redirect(base_url());
}

function update_account_submit() {

	$this->session->unset_userdata('update_success');
	
	$this->load->library('form_validation');

	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]');
	$this->form_validation->set_rules('firstname', 'First Name', 'trim|required||min_length[1]');
	$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required||min_length[1]');
	$this->form_validation->set_rules('address1', 'Address Line 1', 'trim|required||min_length[5]');
	$this->form_validation->set_rules('city', 'City', 'trim|required||min_length[3]');
	$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required||min_length[3]');

	$this->form_validation->run();

	if (!$this->form_validation->run() == FALSE) {
		$data = $this->get_data_from_post();
		unset($data['password1']);
		unset($data['password2']);

		$query = $this->_update($data['id'], $data);
		$this->session->set_userdata('update_success', 'Updated sucessfully!');
	}

	$this->account();
}

function login_submit() {

	$this->load->library('form_validation');
	$this->load->library('encrypt');

	$email = $this->input->post('email', TRUE);
	$password = $this->input->post('password', TRUE);

	$enc_password = $this->encrypt->sha1($password);

	$query = $this->get_where_custom ('email', $email);

	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]');

	if (!$this->form_validation->run() == FALSE)
	{
		/* echo "email: " . $email;
		echo "username: " . $db_username;
		echo "dbp: " . $db_pass;
		echo "encp: " . $enc_password; */

		$query = $this->get_where_custom('email', $email);

		foreach ($query->result() as $row) {
			$email = $row->email;
			$db_firstname = $row->firstname;
			$db_userid = $row->id;
		}

		$this->load->model('mdl_users');

		if ($this->mdl_users->pword_check($email, $enc_password)) {
			$this->session->set_userdata('firstname', $db_firstname);
			$this->session->set_userdata('user_id', $db_userid);
			$this->session->set_userdata('login_success', 'Logged in sucessfully!');

			if ($this->session->userdata('checkout_attempted') == 'true') {
				$this->session->unset_userdata('checkout_attempted');
				redirect(base_url() . 'cart/checkout');
			} else {
				$this->session->unset_userdata('checkout_attempted');
				redirect(base_url());
			}

		} else {
			$this->session->set_userdata('login_success', 'Username or password is incorrect');

		}
	}
		
	$this->login();
}

function account() {

	$query = $this->get_where_custom('id', $this->session->userdata('user_id'));

	foreach ($query->result() as $row) {
		$data = $row;
	}

	$user_item['id'] = $data->id;
	$user_item['password1'] = '';
	$user_item['password2'] = '';
	$user_item['email'] = $data->email;
	$user_item['firstname'] = $data->firstname;
	$user_item['lastname'] = $data->lastname;
	$user_item['address1'] = $data->address1;
	$user_item['address2'] = $data->address2;
	$user_item['city'] = $data->city;
	$user_item['postcode'] = $data->postcode;

	$data_line['user_item'] = $user_item;

	$data_line['view_file'] = "account_details";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data_line);
}

function create_account($data='') {

	if ($data=='') {
		$data['password1'] = '';
		$data['password2'] = '';
		$data['email'] = '';
		$data['firstname'] = '';
		$data['lastname'] = '';
		$data['address1'] = '';
		$data['address2'] = '';
		$data['city'] = '';
		$data['postcode'] = '';
	}

	$data_line['user_item'] = $data;

	$data_line['view_file'] = "create_account";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data_line);

}

function get_data_from_db () {

	$data[''] = $this->input->post('some_data', TRUE);
	$data[''] = $this->input->post('some_data', TRUE);
	$data[''] = $this->input->post('some_data', TRUE);
	$data[''] = $this->input->post('some_data', TRUE);
}

function get_data_from_post () {

	$data['id'] = $this->input->post('id', TRUE);
	$data['email'] = $this->input->post('email', TRUE);
	$data['password1'] = $this->input->post('password1', TRUE);
	$data['password2'] = $this->input->post('password2', TRUE);
	$data['firstname'] = $this->input->post('firstname', TRUE);
	$data['lastname'] = $this->input->post('lastname', TRUE);
	$data['address1'] = $this->input->post('address1', TRUE);
	$data['address2'] = $this->input->post('address2', TRUE);
	$data['city'] = $this->input->post('city', TRUE);
	$data['postcode'] = $this->input->post('postcode', TRUE);

	return $data;
}

function create_account_submit() {

	$data = $this->get_data_from_post();

	$this->load->library('form_validation');
	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]');
	$this->form_validation->set_rules('password1', 'Password', 'trim|required||min_length[5]||matches[password2]');
	$this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required||min_length[5]');
	$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[1]');
	$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[1]');
	$this->form_validation->set_rules('address1', 'Address Line 1', 'trim|required|min_length[5]');
	$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[2]');
	$this->form_validation->set_rules('postcode', 'Post Code', 'trim|required|min_length[5]');


	$this->load->library('encrypt');

	if (!$this->form_validation->run() == FALSE)
	{	
		
		$data['password'] = $this->encrypt->sha1($data['password1']);

		unset($data['password1']);
		unset($data['password2']);

		$this->_insert($data);

		if ($this->db->affected_rows() > 0) {

			$this->session->set_userdata('user_id', $data['id']);
			$this->session->set_userdata('login_success', 'Logged in sucessfully!');

			$this->login_success();
		} 
		
	} else {

		$this->create_account($data);
	}
}

function login_success() {

	$data_line['view_file'] = "login_success";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data_line);

}

function get($order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_users');
$this->mdl_users->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_users');
$this->mdl_users->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_users');
$this->mdl_users->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_users');
$count = $this->mdl_users->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_users');
$max_id = $this->mdl_users->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_users');
$query = $this->mdl_users->_custom_query($mysql_query);
return $query;
}

}
