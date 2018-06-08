<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Pages extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('pages_model');
	}
	public function all_get() {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$res = $this->pages_model->get_all($public_key);
		$this->set_response(array('status'=>true, 'message'=>'Pages dispalyed', 'pages'=> $res));
	}
	public function get_get() {
		$public_key = token();
		$id = $this->input->get('id');
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$res = $this->pages_model->get_single($public_key, $id);
		$this->set_response(array('status'=>true, 'message'=>'Page dispalyed', 'page'=> $res));
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('page');
			$id = uniqid();
			$data = [
				$req['page_name'],
				$req['page_content'],
				$id,
				$auth['store_id'],
				url_title($req['page_name'], 'dash', true)
			];
			$this->pages_model->create($data);
			$this->set_response(array(
				'status' => true,
				'message' => 'Page added',
				'page_id' => $id
			));
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function delete_post() {
		$cat = $this->input->post('page');
		$auth = authenticate();
		if($auth) {
			$res = $this->pages_model->delete($cat['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Page deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Page still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function edit_post() {
		$cat = $this->input->post('page');
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('page');
			$id = uniqid();
			$data = [
				$req['description'],
				$req['content'],
				url_title($req['description'], 'dash', true),
				$req['id'],
				$auth['store_id'],
			];
			$this->pages_model->edit($data);
			$this->set_response(array(
				'status' => true,
				'message' => 'Page edited',
				'page_id' => $id
			));
		}
		else {
			$this->set_response(auth_error());
		}
	}
}
