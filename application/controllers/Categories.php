<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Categories extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('categories_model');
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$req = $this->input->post('category');
			$this->categories_model->create_category($req['category_name'], $auth['store_id']);
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
		$res = $this->categories_model->get_all($public_key);
		$this->set_response(array('status'=>true, 'message'=>'Categories dispalyed', 'categories'=> $res));
	}
	public function get_get() {
		$cat_id = $this->input->get('id');
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$res = $this->categories_model->get_single($cat_id, $public_key);
		if($res) {
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
			$this->set_response(array('status'=>true, 'message'=>'Category dispalyed', 'category'=> $res));
		}
		else {
			$this->set_response(array('status'=>false, 'message'=>'Category not found'));
		}
	}
	public function edit_post() {
		$cat = $this->input->post('category');
		$auth = authenticate();
		if($auth) {
			$res = $this->categories_model->edit_category($cat['id'], $cat['name'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Category edited'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Something went wrong'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
	public function delete_post() {
		$cat = $this->input->post('category');
		$auth = authenticate();
		if($auth) {
			$res = $this->categories_model->delete_category($cat['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Category deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Category still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}

}
