

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{

	function __construct() {
	parent::__construct();
	}

	function index() {

		$data['view_file'] = "home";
		$template = "admin";
		$this->load->module('template');
		$this->load->template->$template($data);

	}

}
