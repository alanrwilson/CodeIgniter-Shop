

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Imagelib extends MX_Controller
{

function __construct() {
	parent::__construct();
}

function upload () {

	$this->load->view('imageupload');

}

function do_upload()
	{
		$config['upload_path'] = './imagelib/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{

			$data = array('upload_data' => $this->upload->data());
			print_r($data);


			$data = $this->upload->data(); //name of the file is now uploaded

			$file_name = $data['file_name'];

			//create a thumbnail

			$config['image_library'] = 'gd2';
			$config['source_image'] = './imagelib/'.$file_name;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = false;
			$config['width'] = 320;
			$config['height'] = 200;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			//resize the larger picture to 400px x 400px

			$new_width = 600;
			$new_height = 320;

			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = $new_width;
			$config['height'] = $new_height;

			$this->load->library('image_lib', $config);

			$this->image_lib->initialize($config);

			$this->image_lib->resize();
			


			//$this->load->view('upload_success', $data);
		}
	}

function get($order_by) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_perfectcontroller');
$count = $this->mdl_perfectcontroller->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_perfectcontroller');
$max_id = $this->mdl_perfectcontroller->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->_custom_query($mysql_query);
return $query;
}

}
