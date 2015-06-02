<?php

class Template extends MX_Controller {

	
	function admin($data) {

		Modules::run('site_security/check_is_admin');

		$this->load->view('admin', $data);
	}

	function public_one_col($data) {

		$this->load->view('public_one_col', $data);
	}

	function public_home($data) {

		$this->load->view('public_home', $data);
	}

	function two_col($data) {

		$this->load->view('two_col', $data);
	}
	
}