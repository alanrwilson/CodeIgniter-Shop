<?php

class Tasks extends MX_Controller {

	
	function index() {
		echo "<h1>This is the tasks controller</h1>";
	

		$data['query'] = $this->get('priority');

		//$this->load->view('display', $data);

		$data['view_file'] = "display";

		$data['module']  = "tasks";

		//echo Modules::run('template/one_col', $data);
		//echo Modules::run('template/admin', $data);
		echo Modules::run('template/two_col', $data);

	}

	function create() {

		$update_id = $this->uri->segment(3);

		if (is_numeric($update_id)) {
			$data = $this->get_data_from_db($update_id);
			$data['update_id'] = $update_id;
		} else {

			$data = $this->get_data_from_post();

		}

		if (!isset($update_id)) {
			$update_id = $this->input->post('update_id', $id);

		}

		$data['module'] = "tasks";
		$data['view_file'] = "form";

		echo Modules::run('template/two_col', $data);
	}

	function get_data_from_post() {
		$data['title'] = $this->input->post('title', TRUE);
		$data['priority'] = $this->input->post('priority', TRUE);
		return $data;

	}

	function submit() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'title', 'required| min_length[3] | xss_clean');
		$this->form_validation->set_rules('priority', 'priority', 'required|numeric');

		$update_id = $this->input->post('update_id');

		echo "update_id" . $update_id;

		if ($this->load->form_validation->run() == FALSE) {
			$this->create();


		} else {

			$data = $this->get_data_from_post();

			if (is_numeric($update_id)) {
				$this->_update($update_id, $data);
			} else {
			
				$this->_insert($data);
			}


			redirect ('tasks');
		}

	}

	function get_data_from_db ($update_id) {

		$query = $this->get_where($update_id);
		
		foreach ($query->result() as $row) {
			$data['title'] = $row->title;
			$data['priority'] = $row->priority;
		
		}
		return $data;

	}


	function __construct() {
	parent::__construct();
	}

	function get($order_by) {
	$this->load->model('mdl_tasks');
	$query = $this->mdl_tasks->get($order_by);
	return $query;
	}

	function get_with_limit($limit, $offset, $order_by) {
	$this->load->model('mdl_tasks');
	$query = $this->mdl_tasks->get_with_limit($limit, $offset, $order_by);
	return $query;
	}

	function get_where($id) {
	$this->load->model('mdl_tasks');
	$query = $this->mdl_tasks->get_where($id);
	return $query;
	}

	function get_where_custom($col, $value) {
	$this->load->model('mdl_tasks');
	$query = $this->mdl_tasks->get_where_custom($col, $value);
	return $query;
	}

	function _insert($data) {
	$this->load->model('mdl_tasks');
	$this->mdl_tasks->_insert($data);
	}

	function _update($id, $data) {
	$this->load->model('mdl_tasks');
	$this->mdl_tasks->_update($id, $data);
	}

	function _delete($id) {
	$this->load->model('mdl_tasks');
	$this->mdl_tasks->_delete($id);
	}

	function count_where($column, $value) {
	$this->load->model('mdl_tasks');
	$count = $this->mdl_tasks->count_where($column, $value);
	return $count;
	}

	function get_max() {
	$this->load->model('mdl_tasks');
	$max_id = $this->mdl_tasks->get_max();
	return $max_id;
	}

	function _custom_query($mysql_query) {
	$this->load->model('mdl_tasks');
	$query = $this->mdl_tasks->_custom_query($mysql_query);
	return $query;
	}



}