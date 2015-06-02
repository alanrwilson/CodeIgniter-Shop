

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_categories extends MX_Controller
{

function __construct() {
parent::__construct();
}

function index() {
	$this->show_homepage() ;
}

function show_homepage() {

	$data['category_level'] = 0;

	$data['view_file'] = "show_categories";
	$template = "public_home";
	$this->load->module('template');
	$this->template->$template($data);

}

function blah () {

	$this->load->view('categories_navigation');
}

function display_final_categories() {

	$categories = $this->get_end_of_line_categories();

	$this->load->view();
}

function get_level_categories ($cat_level=0) {

	if (!is_numeric($cat_level)) {
		$cat_level = 0;
	}

	$query = $this->get_where_custom('parent_category' , $cat_level);

	return $query->result();
}

function show_subcat_categories($cat_level) {

	if (!is_numeric($cat_level)) {
		$cat_level = 0;
	}

	$data['category_level'] = $cat_level;

	// see if there are any subcategories

	$i = $this->count_where('parent_category', $cat_level);

	if ($i > 0 ) {

		$data['view_file'] = "show_categories";
		$template = "public_one_col";
		$this->load->module('template');
		$this->template->$template($data);

	} else {
		// no subcategories so show items
		redirect($base_url . 'store_items/show_all_items_in_category/' . $cat_level);
	}

}

function produce_nav_breadcrumb ($category_id) {

	$breadcrumb = 'Home';

	if (!isset($parent_category)) {
		$parent_category = $category_id;
	}

	while ($parent_category > 0) {

		//echo  "<br>depth: ". $depth;

		//echo  "<br>Parent Category:" . $parent_category;

		$category_name = $this->get_category_name($parent_category);

		$categories[] = $category_name;

		if (is_numeric($parent_category)) {
			$parent_category = $this->get_parent_category($parent_category);
		} else {
			$parent_category = 0;
		}

	}

	//(($parent_category !="")  && ($parent_category > 0));

	//print_r ($categories);

	if (isset($categories)) {

		$categories = array_reverse($categories) ;

		foreach ($categories as $category) {

			$breadcrumb .= " > " . $category;
		}
	}

	return $breadcrumb;
}


function get_breadcrumb ($category_id) {

	$breadcrumb = '';

	do {

		if (!isset($parent_category)) {
			$parent_category = $category_id;
		}

		//echo  "<br>depth: ". $depth;

		//echo  "<br>Parent Category:" . $parent_category;

		$parent_category = $this->get_parent_category($parent_category);

		if ($parent_category > 0) {

			$category_name = $this->get_category_name($parent_category);

				//echo "<br>" . $category_name;
				//echo  "<br>Parent Category:" . $parent_category;

			$parents[] = $parent_category;
		}

		
	} while ($parent_category > 0);

	//(($parent_category !="")  && ($parent_category > 0));

	if (isset($parents)) {

		$parents = array_reverse($parents) ;

		foreach ($parents as $parent) {

			$category_name = $this->get_category_name($parent);

			$breadcrumb .= $category_name . " > ";
		}
	}

	return $breadcrumb;

}

function _is_new_category_allowed ($parent_category) {

	//return true or false

	$max_depth = Modules::run('site_settings/get_max_category_depth');

	//get current category depth;

	$current_category_depth = $this->get_category_depth ($parent_category);

	if ($current_category_depth < $max_depth) {
		return true;
	} else {
		return false;
	}
	
}

function get_end_of_line_categories() {

	$max_depth = Modules::run('site_settings/get_max_category_depth');

	$query = $this->get('category_name');

	foreach ($query->result() as $row) {
		$category_id = $row->id;
		$parent_category = $row->parent_category;
		$category_depth = $this->get_category_depth($parent_category);

		echo $category_id . " " . "depth " . $category_depth . " " ;

		if ($category_depth <= $max_depth) {
			//this must be end of line' category

			//echo "<br>";

			//echo "----------------------------------";

			//echo "<br>";
			//echo $category_id;

			//echo "<br>";
			//echo "-------------";

			//echo "<br>";
			//echo "cat depth: ". $category_depth;
			$categories[] = $category_id;
		}

	}

	if (!isset($categories)) {
		$categories = "";
	}

	return $categories;

}


function get_category_depth ($parent_category) {

	$depth = 0;

	while (($parent_category !="")) {

		$depth++;

		//echo  "<br>depth: ". $depth;

		//echo  "<br>Parent Category:" . $parent_category;

		$parent_category = $this->get_parent_category($parent_category);

		//echo  "<br>Parent Category:" . $parent_category;

	}

	//echo "g_c_d depth" . $depth;

	return $depth;

}

function get_parent_category($id) {

	//echo "id: " . $id;

	$query = $this->get_where($id);

	foreach ($query->result() as $row) {

		$parent_category = $row->parent_category;
	}

	if (!isset($parent_category)) {

		$parent_category = "";

	}

	// echo "gpc: pc: " . $parent_category;

	return $parent_category;

}

function test_category () {

	$category_id = $this->uri->segment(3);
	$category_name = $this->get_category_name($category_id);
	$parent_category = $this->get_parent_category($category_id);
	$category_depth = $this->get_category_depth($parent_category);

	echo "<h1>" . $category_name . "</h1>" ;
	echo "<p> exists at a depth of " . $category_depth ."</p>";
}

function get_category_name($id) {
	$data = $this->get_data_from_db($id);
	$category_name = $data['category_name'];
	return $category_name;
}

function _display_categories_table($parent_category) {

	$data['query'] = $this->get_where_custom('parent_category', $parent_category);
	$this->load->view('categories_table', $data);
}

function manage () {

	Modules::run('site_security/check_is_admin');

	$data['view_file'] = "manage";
	$template = "admin";

	$parent_category = $this->uri->segment(3);

	if (($parent_category < 1) || (!is_numeric($parent_category))) {
		$parent_category = 0;
	}

	$data['parent_category'] = $parent_category;

	if ($parent_category > 0) {
		$data['headline'] = "Manage " . $this->get_category_name($parent_category);
	} else {
		$data['headline'] = "Manage Store Category";

	}

	$flash = $this->session->flashdata('item');

	if ($flash!="") {
		$data['flash'] = $flash;
	}

	$data['new_category_allowed'] = $this->_is_new_category_allowed($parent_category);


	$this->load->module('template');
	$this->load->template->$template($data);

}

function get_data_from_post() {

	$data['category_name'] = $this->input->post('category_name', TRUE);
	$data['priority'] = $this->input->post('priority', TRUE);
	$data['small_pic'] = $this->input->post('small_pic', TRUE);
	
	return $data;
}

function get_data_from_db($update_id) {

	$query = $this->get_where($update_id);
	foreach($query->result() as $row) {

		$data['category_name'] = $row->category_name;
		$data['priority'] = $row->priority;
		$data['small_pic'] = $row->small_pic;
		
	}

	if (!isset($data)) {
		$data = "";
	}

	return $data;

}

function create () {

	$data = $this->get_data_from_post();

	$update_id = $this->uri->segment(3);

	$submit = $this->input->post('submit', TRUE);

	if ($update_id > 0) {

		if ($submit!="Submit") {

			//form has not been posted yet read from database
			$data = $this->get_data_from_db($update_id);
		}

		$data['headline'] = "Edit Category";

	} else { 

		$data['headline'] = "Create New Category";
	}

	$current_url = current_url();

	$data['form_location'] = str_replace('/create' , '/submit', $current_url);

	$flash = $this->session->flashdata('item');

	if ($flash!="") {
		$data['flash'] = $flash;
	}

	$data['category_id'] = $update_id;

	$data['view_file'] = "create";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);

}

function submit() {

	$parent_category = $this->uri->segment(4);

	if (!is_numeric($parent_category)) {
		$parent_category = 0;

	}

	$this->load->library('form_validation');

	$this->form_validation->set_rules('category_name', 'Category Name', 'required| max_length[30] | min_length[3] | xss_clean');
	$this->form_validation->set_rules('priority', 'Priority', 'is_numeric');
	

	if ($this->form_validation->run($this) == FALSE) {

		$this->create();


	} else {

		$update_id = $this->uri->segment(3);

		if ($update_id > 0) {

			//this is an edit not a create

			$data = $this->get_data_from_post();

			$this->_update($update_id, $data);
			$value = "<p style='color: green'>The item was sucessfully updated.</p>";

		} else {

			// create a new record

			$data = $this->get_data_from_post();
			$data['category_url'] = url_title($data['category_name']);
			$data['parent_category'] = $parent_category;
			$data['small_pic'] = $thm_img;
			$this->_insert($data);
			$value = "<p style='color: green'>The item was sucessfully created.</p>";

			$update_id = $this->get_max();
		}

		$this->session->set_flashdata('item' , $value);

		
		redirect('store_categories/manage/'.$parent_category);

	}

}

function delete_category ($update_id) {

	$submit = $this->input->post('submit', true);


	if ($submit=="No - Cancel") {
		redirect('store_categories/create/'.$update_id);
	}

	echo $submit;

	if ($submit=="Yes - Delete Category") {

		$this->_delete($update_id);

		$value = "<p style='color: green'>The item was sucessfully deleted.</p>";
		$this->session->set_flashdata('item' , $value);

		echo $submit;

		redirect('store_categories/manage');

	}


	$data['update_id'] = $update_id;
	$current_url = current_url();
	$data['form_location'] = current_url();

	$data['view_file'] = "delete_conf";
	$template = "admin";
	$this->load->module('template');
	$this->template->$template($data);

}


function get($order_by) {
$this->load->model('mdl_Store_categories');
$query = $this->mdl_Store_categories->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_Store_categories');
$query = $this->mdl_Store_categories->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_Store_categories');
$query = $this->mdl_Store_categories->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_Store_categories');
$query = $this->mdl_Store_categories->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_Store_categories');
$this->mdl_Store_categories->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_Store_categories');
$this->mdl_Store_categories->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_Store_categories');
$this->mdl_Store_categories->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_Store_categories');
$count = $this->mdl_Store_categories->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_Store_categories');
$max_id = $this->mdl_Store_categories->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_Store_categories');
$query = $this->mdl_Store_categories->_custom_query($mysql_query);
return $query;
}

}
