<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Shippings extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('shippings_model');
	}
	public function all_post() {
		$auth = authenticate();
		if($auth) {
			$res=array();
			$res['international'] = $this->shippings_model->int_shipping(array($auth['store_id']));
			$res['international']['status']=="1"?$res['international']['status']=true:$res['international']['status']=false;
			$res['international']['shipping_first'] = floatval($res['international']['shipping_first']);
			$res['international']['shipping_each'] = floatval($res['international']['shipping_each']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Shippings displayed',
					'shipping' => $res
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Shippings couldn\'t be displayed'
				));	
			}
		}
	}
	public function edit_international_post() {
		$auth = authenticate();
		if($auth) {
			$shipping = $this->input->post('shipping');
			$shipping['status']=="true"?$shipping['status']=1:$shipping['status']=0;
			$data=array(
				$shipping['status'],
				$shipping['shipping_first'],
				$shipping['shipping_each'],
				$auth['store_id']
			);
			$res=$this->shippings_model->edit_int_shipping($data);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Shippings edited',
				));
			}
			else {
				$this->set_response(array(
					'status' => false,
					'message' => 'Something went wrong'
				));	
			}
		}
	}
}