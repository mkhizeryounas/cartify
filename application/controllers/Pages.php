<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Pages extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('pages_model');
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('pages');
			// $this->categories_model->create_category($req['category_name'], $auth['store_id']);
			$this->set_response(array(
				'status' => true,
				'message' => 'Category added'
			));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function all_get() {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$res = $public_key;
		try {
			$pages=[];
			$tmp = $pages['key'];
			$this->set_response(array('status'=>true, 'message'=>'Pages dispalyed'));

		}
		catch (Exception $e) {
			$this->set_response(array('status'=>false, 'message'=>'Error occoured', 'error'=> $e->getMessage()));

		}
		// $res = $this->categories_model->get_all($public_key);
		// $this->set_response(array('status'=>true, 'message'=>'Categories dispalyed', 'categories'=> $res));
	}

}
