<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Customers extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('customers_model');
	}
	public function create_post() {
		$public_key = token();
		if($public_key) {
			$customer = $this->input->post('customer');
			$params = array(
				$public_key,
				$customer['email']
			);
			$check = $this->customers_model->customer_check($params);
			if(count($check) == 0) {
				$params = array(
					uniqid(),
					$customer['name'],
					$customer['email'],
					$customer['phone'],
					pwd($customer['password']),
					$customer['address']
				);
				$this->customers_model->create_customer($params, $public_key);
				$this->set_response(array(
					'status' => true,
					'message' => 'Customer added'
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Customer already exists'
				));
			}
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function edit_post() {
		$public_key = token();
		if($public_key) {
			$customer = $this->input->post('customer');
			$params = array(
				$public_key,
				$customer['email']
			);
			$check = $this->customers_model->customer_check($params, $customer['id']);
			if(count($check) == 0) {
				$params = array(
					$customer['name'],
					$customer['email'],
					$customer['phone'],
					$customer['address'],
					$customer['id']
				);
				$this->customers_model->edit_customer($params, $public_key);
				if($customer['password']!=='null') {
					$this->customers_model->edit_password(array(pwd($customer['password']),$customer['id']), $public_key);
				}
				$this->set_response(array(
					'status' => true,
					'message' => 'Customer edited'
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Customer already exists'
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
			$tmp = $this->customers_model->get_all(array($auth['store_id']));
			$this->set_response(array(
				'status' => true,
				'message' => 'Customers displayed',
				'customers' => $tmp
			));
		} 
		else {
			$this->set_response(auth_error());
		}
	}
	public function get_get() {
		$public_key = token();
		if($public_key) {
			$id = $this->input->get('id');
			$tmp = $this->customers_model->get_single(array($id, $public_key));
			if($tmp==false) {
				$this->set_response(array('status'=>false, 'message'=>'Customer not found'));
			}
			else {
				$this->set_response(array(
					'status' => true,
					'message' => 'Customer displayed',
					'customer' => $tmp
				));
			}
		} 
		else {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
		}
	}
	public function token_post() {
		$public_key = token();
		if($public_key) {
			$cus = $this->input->post('customer');
			$tmp = $this->customers_model->login(array($cus['email'], $cus['password'], $public_key));
			if($tmp==false) {
				$this->set_response(array('status'=>false, 'message'=>'Customer not found'));
			}
			else {
				$this->set_response(array(
					'status' => true,
					'message' => 'Customer displayed',
					'customer' => $tmp
				));
			}
		} 
		else {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
		}
	}
	public function delete_post() {
		$customer = $this->input->post('customer');
		$auth = authenticate();
		if($auth) {
			$res = $this->customers_model->delete($customer['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Customers deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Customer still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
}