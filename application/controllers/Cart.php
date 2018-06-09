<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Cart extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('categories_model');
	}
	public function generate_cart_id_get() {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$this->set_response(array('status'=>true, 'message'=>'Cart ID generated', 'Cart_id'=> uniqid()));
	}

}
