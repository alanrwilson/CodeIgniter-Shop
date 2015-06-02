
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller
{

	function __construct() {
	parent::__construct();
	}

	function index() {

		redirect($base_url . 'store_categories');

	}

	function _show_dom() {

		$url="http://www.amazon.co.uk";

		$html = file_get_contents($url);

		$doc = new DOMDocument();

		@$doc->loadHTML($html);

		$tags = $doc->getElementsByTagName('img');

		//print_r($tags);

		foreach ($tags as $tag) {

       			$img =  $tag->getAttribute('src');

       			if (preg_match ("(jpeg|jpg)", $img)) {
       				echo "<img src=$img>" . "<br>";
       			} 
			}
		
	}	

}
