

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class store_items extends MX_Controller
{

function __construct() {
parent::__construct();
}

function show_all_items_in_category ($cat_level) {

	
	if (is_numeric($cat_level)) {
		$category_parent = $cat_level;
	} else {

	} $category_parent = 0;

	$items_for_category = Modules::run('store_cat_assign/get_category_items', $cat_level);

	$data['category_level'] = $cat_level;
	
	foreach ($items_for_category as $item) {
		$data['category_items'][$item->item_id] = $this->get_data_from_db($item->item_id);
	}

	//echo('<pre>');

	//print_r($items_for_category);

	//echo('</pre>');

	//die ();

	$data['view_file'] = "show_multiple_items";
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data);
}

function showitem ($item_id) {

	/*

    if ($this->session->flashdata('cart_added')) {
      echo "flash";
      die();
      //$this->session->unset_userdata('cart_updated');
    }

    */
    
	$data = $this->get_data_from_db($item_id);
	$data['view_file'] = "showitem";
	$data['item_id'] = $item_id;
	$template = "public_one_col";
	$this->load->module('template');
	$this->template->$template($data);
}

function _display_items_table() {

	$data['query'] = $this->get('item_name');
	$this->load->view('items_table', $data);
}


function get_data_from_post() {

	$data['item_name'] = $this->input->post('item_name', TRUE);
	$data['item_price'] = $this->input->post('item_price', TRUE);
	$data['item_description'] = $this->input->post('item_description', TRUE);

	return $data;

}

function manage() {

	Modules::run('site_security/check_is_admin');

	$data['view_file'] = "manage";
	$template = "admin";

	$flash = $this->session->flashdata('item');

	if ($flash!="") {
		$data['flash'] = $flash;
	}

	$this->load->module('template');
	$this->load->template->$template($data);
}

function get_data_from_db($update_id) {

	$query = $this->get_where($update_id);
	foreach($query->result() as $row) {

		$data['item_id'] = $row->id;

		$data['item_name'] = $row->item_name;
		$data['item_price'] = $row->item_price;
		
		$data['small_pic'] = $row->small_pic;
		$data['big_pic'] = $row->big_pic;
		$data['item_description'] = $row->item_description;
		$data['item_url'] = $row->item_url;

	}

	if (!isset($data)) {
		$data = "";
	}

	return $data;

}

function create () {

	$data = $this->get_data_from_post();

	$item_id = $this->uri->segment(3);

	$submit = $this->input->post('submit', TRUE);

	if ($item_id > 0) {

		if ($submit!="Submit") {

			//form has not been posted yet read from database
			$data = $this->get_data_from_db($item_id);
		}

		$data['headline'] = "Edit Item";

	} else { 

		$data['headline'] = "Create New Item";
	}

	$current_url = current_url();

	$data['form_location'] = str_replace('/create' , '/submit', $current_url);

	$flash = $this->session->flashdata('item');

	if ($flash!="") {
		$data['flash'] = $flash;
	}

	$data['item_id'] = $item_id;

	$data['view_file'] = "create";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);

}

function submit() {

	//$data = $this->get_data_from_post();

	//print_r($data);

	//die();

	$this->load->library('form_validation');

	$this->form_validation->set_rules('item_name', 'Item Name', 'required| max_length[30] | min_length[3] | xss_clean');
	$this->form_validation->set_rules('item_price', 'Item Price', 'is_numeric');
	$this->form_validation->set_rules('item_description', 'Item Description', 'required| max_length[30] | min_length[3] | xss_clean');


	if ($this->form_validation->run($this) == FALSE) {

		$this->create();


	} else {

		$update_id = $this->uri->segment(3);

		if ($update_id > 0) {

			//this is an edit not a create

			$data = $this->get_data_from_post();

			$data['item_url'] = url_title($data['item_name']);

			$this->_update($update_id, $data);
			$value = "<p style='color: green'>The item was sucessfully updated.</p>";

		} else {

			// create a new record

			$data = $this->get_data_from_post();

			$data['item_url'] = url_title($data['item_name']);

			$this->_insert($data);
			$value = "<p style='color: green'>The item was sucessfully created.</p>";

			$update_id = $this->get_max();
		}

		$this->session->set_flashdata('item' , $value);

		
		redirect('store_items/create/'.$update_id);

	}

}

function delete_item ($update_id) {

	$submit = $this->input->post('submit', true);


	if ($submit=="No - Cancel") {
		redirect('store_items/create/'.$update_id);
	}

	echo $submit;

	if ($submit=="Yes - Delete Item") {

		$this->_delete($update_id);

		$value = "<p style='color: green'>The item was sucessfully deleted.</p>";
		$this->session->set_flashdata('item' , $value);

		echo $submit;

		redirect('store_items/manage');

	}


	$data['update_id'] = $update_id;
	$current_url = current_url();
	$data['form_location'] = current_url();

	$data['view_file'] = "delete_conf";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);

}

function upload_pic($item_id) {

	$data['item_id'] = $item_id;
	$data['view_file'] = "upload_pic";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);

}

function do_upload ($item_id) {

	Modules::run('site_security/check_is_admin');
	

	$config['upload_path'] = './itempics/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2768';

		$this->load->library('upload', $config);

	if ( ! $this->upload->do_upload())

	{
		
		$data['error'] = array('error' => $this->upload->display_errors("<p style='color:red'>", "</p>"));

		$data['item_id'] = $item_id;
		$data['view_file'] = "upload_pic";
		$template = "admin";
		$this->load->module('template');
		$this->template->$template($data);

	}
	else
	{	
		$data = $this->upload->data(); //name of the file is now uploaded

		$file_name = $data['file_name'];

		//create a thumbnail

		$config['image_library'] = 'gd2';
		$config['source_image'] = './itempics/'.$file_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 137;
		$config['height'] = 137;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();

		//resize the larger picture to 400px x 400px

		$new_width = 400;
		$new_height = 400;
		$this->_resize_pic($file_name, $new_width, $new_height);

		//update the database

		$raw_file_name = $data['raw_name'];
		$file_ext = $data['file_ext'];

		unset($data);

		$data['small_pic'] = $raw_file_name."_thumb".$file_ext;
		$data['big_pic'] = $file_name;

		$this->_update($item_id, $data);


		redirect("store_items/upload_success/".$item_id);

	}
	
}
function upload_success($item_id) {

	Modules::run('site_security/check_is_admin');


	$query = $this->get_where($item_id);

	foreach ($query->result() as $row) {
		$data['big_pic']= $row->big_pic;
	}


	$data['item_id'] = $item_id;
	$data['view_file'] = "upload_success";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);


}

function _resize_pic ($file_name, $new_width, $new_height) {

	$config['image_library'] = 'gd2';
	$config['source_image'] = './itempics/'.$file_name;
	$config['create_thumb'] = FALSE;
	$config['maintain_ratio'] = TRUE;
	$config['width'] = $new_width;
	$config['height'] = $new_height;

	$this->load->library('image_lib', $config);

	$this->image_lib->initialize($config);

	$this->image_lib->resize();

}

function get($order_by) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_items');
$count = $this->mdl_store_items->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_items');
$max_id = $this->mdl_store_items->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->_custom_query($mysql_query);
return $query;
}

}
