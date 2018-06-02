<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Coupons extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('coupons_model');
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('coupon');
			$tmp = $this->coupons_model->get_single(array($auth['store_key'],$req['code'],$req['code']));
			if(!$tmp) {
				$req['publish']=='true'?$req['publish']=1:$req['publish']=0;
				$req['limit']==''?$req['limit']=0:$req['limit']=$req['limit'];
				$req['begin']==''?$req['begin']=null:$req['begin']=$req['begin'];
				$req['expire']==''?$req['expire']=null:$req['expire']=$req['expire'];
				$req['limit']==''?$req['has_count_limit']=0:$req['has_count_limit']=1;
				$data = array (
					$req['code'],
					$req['type'],
					$req['limit'],
					$req['begin'],
					$req['expire'],
					uniqid(),
					$req['publish'],
					$auth['store_id'],
					$req['limit'],
					$req['has_count_limit'],
					$req['value']
				);
				$res = $this->coupons_model->create($data);
				if($res) {
					$this->set_response(array(
						'status' => true,
						'message' => 'Coupon added',
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
				$this->set_response(array(
					'status' => false,
					'message' => 'Coupon code already exists'
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
			$tmp = $this->coupons_model->get_all(array($auth['store_key']));
			foreach ($tmp as $k => $v) {
				if($tmp[$k]['has_count_limit'] != "1") {
					$tmp[$k]['limit'] = 0;
					$tmp[$k]['remaining'] = 0;
				}
				else {
					$tmp[$k]['limit'] = floatval($tmp[$k]['limit']);
					$tmp[$k]['remaining'] = floatval($tmp[$k]['remaining']);
				}
				$tmp[$k]['value'] = floatval($tmp[$k]['value']);
				$tmp[$k]['publish']=="1"?$tmp[$k]['publish']=true:$tmp[$k]['publish']=false;
			}
			$this->set_response(array(
				'status' => true,
				'message' => 'Coupons displayed',
				'coupons' => $tmp
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
			$tmp = $this->coupons_model->get_single(array($public_key, $id, $id));
			if($tmp) {
				if($tmp['has_count_limit'] != "1") {
					$tmp['limit'] = 0;
					$tmp['remaining'] = 0;
				}
				else {
					$tmp['limit'] = floatval($tmp['limit']);
					$tmp['remaining'] = floatval($tmp['remaining']);
				}
				$tmp['value'] = floatval($tmp['value']);
				$tmp['publish']=="1"?$tmp['publish']=true:$tmp['publish']=false;
				$this->set_response(array(
					'status' => true,
					'message' => 'Coupon displayed',
					'coupon' => $tmp
				));

			}
			else {
				$this->set_response(array(
					'status' => true,
					'message' => 'Coupons not found',
				));
			}
		} 
		else {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
		}
	}
	public function edit_post() {
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('coupon');
			$tmp = $this->coupons_model->get_single(array($auth['store_key'],$req['code'],$req['code']), $req['id']);
			if(!$tmp) {
				$req['publish']=='true'?$req['publish']=1:$req['publish']=0;
				$req['limit']==''?$req['limit']=0:$req['limit']=$req['limit'];
				$req['begin']==''?$req['begin']=null:$req['begin']=$req['begin'];
				$req['expire']==''?$req['expire']=null:$req['expire']=$req['expire'];
				$req['limit']==''?$req['has_count_limit']=0:$req['has_count_limit']=1;
				$data = array (
					$req['type'],
					$req['limit'],
					$req['begin'],
					$req['expire'],
					$req['publish'],
					$req['remaining'],
					$req['has_count_limit'],
					$req['code'],
					$req['value'],
					$req['id'],
					$auth['store_id']
				);
				$res = $this->coupons_model->edit($data);
				if($res) {
					$this->set_response(array(
						'status' => true,
						'message' => 'Coupon edited',
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
				$this->set_response(array(
					'status' => false,
					'message' => 'Coupon code already exists'
				));	
			}
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function delete_post() {
		$coupon = $this->input->post('coupon');
		$auth = authenticate();
		if($auth) {
			$res = $this->coupons_model->delete($coupon['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Coupon deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Coupon still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
}
