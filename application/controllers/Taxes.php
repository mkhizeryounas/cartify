<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Taxes extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('taxes_model');
	}
	public function countries_get() {
		$auth = authenticate();
		if($auth) {
			$res = $this->taxes_model->getCountires($auth['store_id']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Countries displayed',
					'countries' => $res
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Countries couldn\'t be displayed'
				));	
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$tax = $this->input->post('tax');
			$tax['key'] = uniqid();
			$data = array(
				$tax['country'],
				$auth['store_id'],
				$tax['percent'],
				$tax['key']
			);
			$res = $this->taxes_model->create($data);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Tax created'
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Something went wrong'
				));
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function all_post() {
		$auth = authenticate();
		if($auth) {
			$res = $this->taxes_model->all($auth['store_id']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Taxes displayed',
					'taxes' => $res
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Taxes couldn\'t be displayed'
				));	
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function get_post() {
		$auth = authenticate();
		if($auth) {
			$id = $this->input->post('tax_id');
			$res = $this->taxes_model->get($id, $auth['store_id']);
			if($res) {
				$res['percent'] = floatval($res['percent']);
				$this->set_response(array(
					'status' => true,
					'message' => 'Tax displayed',
					'tax' => $res
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Tax couldn\'t be displayed'
				));	
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function edit_post() {
		$auth = authenticate();
		if($auth) {
			$tax = $this->input->post('tax');
			$data = array(
				$tax['percent'],
				$tax['id'],
				$auth['store_id']
			);
			$res = $this->taxes_model->update($data);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Tax edited'
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Something went wrong'
				));
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function delete_post() {
		$auth = authenticate();
		if($auth) {
			$tax = $this->input->post('tax');
			$data = array(
				$tax['id'],
				$auth['store_id']
			);
			$res = $this->taxes_model->delete($data);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Tax deleted'
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Something went wrong'
				));
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
}
