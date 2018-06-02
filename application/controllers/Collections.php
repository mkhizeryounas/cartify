<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Collections extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('collections_model');
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$collection = $this->input->post('collection');
			$collection['publish'] == "true" ? $collection['publish'] = 1 : $collection['publish'] = 0;
			$collection['key'] = uniqid();
			$data = array(
				$collection['name'],
				$collection['key'],
				$auth['store_id'],
				$collection['publish'],
				url_title($collection['name'],'dash',true)
			);
			isset($collection['products'])?$collection['products']=$collection['products']:$collection['products']=array();
			$res = $this->collections_model->create($data,$collection['products'],$collection['key']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Collections created'
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
	public function all_get() {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$res = $this->collections_model->get_all($public_key);
		if($res) {
			foreach ($res as $k => $v) {
				$res[$k]['publish']==1?$res[$k]['publish']=true:$res[$k]['publish']=false;
			}
			$this->set_response(array('status'=>true, 'message'=>'Collections dispalyed', 'collections'=> $res));
		}
		else {
			$this->set_response(array('status'=>false, 'message'=>'Something went wrong')) ;
		}
	}
	public function get_get() {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$id = $this->input->get('id');
		$res = $this->collections_model->get_single($public_key, $id);
		if($res) {
			$res['publish']==1?$res['publish']=true:$res['publish']=false;
			foreach ($res['products'] as $k => $v) {
				$res['products'][$k]['publish']==1?$res['products'][$k]['publish']=true:$res['products'][$k]['publish']=false;
				
			}
			foreach ($res['products'] as $k => $v) {
				!empty($v['image']) ? $res['products'][$k]['image'] = base_url().'files/'.$v['image']:$res['products'][$k]['image'] = base_url().'files/'.'default.png';

				if($res['products'][$k]['compare_price']!=null) {
					$res['products'][$k]['discount']=true;
					$res['products'][$k]['compare_price']=floatval($res['products'][$k]['compare_price']);
				}
				else {
					$res['products'][$k]['discount']=false;
					$res['products'][$k]['compare_price']=null;
				}
			}
			$this->set_response(array('status'=>true, 'message'=>'Collection dispalyed', 'collection'=> $res));
		}
		else {
			$this->set_response(array('status'=>false, 'message'=>'Something went wrong')) ;
		}
	}
	public function edit_post() {
		$auth = authenticate();
		if($auth) {
			$collection = $this->input->post('collection');
			$collection['publish'] == "true" ? $collection['publish'] = 1 : $collection['publish'] = 0;
			$data = array(
				$collection['name'],
				$collection['publish'],
				url_title($collection['name'],'dash',true),
				$collection['id'],
				$auth['store_id']
			);
			isset($collection['products'])?$collection['products']=$collection['products']:$collection['products']=array();
			$res = $this->collections_model->edit($data,$collection['products'],$collection['id']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Collections edited'
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
		$collection = $this->input->post('collection');
		$auth = authenticate();
		if($auth) {
			$res = $this->collections_model->delete($collection['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Collection deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Collection still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
}