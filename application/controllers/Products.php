<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Products extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('products_model');
	}
	public function create_post() {
		$auth = authenticate();
		if($auth) {
			$product = $this->input->post('product');
			$product['key'] = uniqid();
			$product['track'] == "true" ? $product['track'] = 1 : $product['track'] = 0;  
			$product['shipping'] == "true" ? $product['shipping'] = 1 : $product['shipping'] = 0;  
			$product['product_publish'] == "true" ? $product['product_publish'] = 1 : $product['product_publish'] = 0;  
			$product['taxable'] == "true" ? $product['taxable'] = 1 : $product['taxable'] = 0;  
			if(!isset($product['images'])) $product['images'] =array();
			if(!isset($product['compare_price'])||$product['compare_price']=="") {
				$product['compare_price']=null;
			}
			else {
				if($product['compare_price']<=$product['price']) {
					$product['compare_price'] = null;
				}	
			}
			$data = array(
				$product['name'],
				$product['category'],
				$product['track'],
				$product['qty'],
				$product['price'],
				$product['description'],
				$product['shipping'],
				$product['weight'],
				$product['depth'],
				$product['width'],
				$product['height'],
				$product['meta'],
				$product['key'],
				$auth['store_id'],
				url_title($product['name'], 'dash', true),
				$product['product_publish'],
				$product['sku'],
				$product['taxable'],
				$product['compare_price']
			);
			$res = $this->products_model->create($data, $product['images'], $product['key']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Product created'
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
		$res = $this->products_model->get_all($public_key);
		if($res) {
			foreach($res as $k => $v) {
				!empty($v['image']) ? $res[$k]['image'] = base_url().'files/'.$v['image']:$res[$k]['image'] = base_url().'files/'.'default.png';
				if($res[$k]['track_inventory'] === "0") {
					$res[$k]['track_inventory'] = false;
					$res[$k]['quantity'] = 0;
				} 
				else {
					$res[$k]['track_inventory'] = true;
				}
				if($res[$k]['shipping'] === "0") {
					$res[$k]['shipping'] = false;
					$res[$k]['depth'] = 0;
					$res[$k]['weight'] = 0;
					$res[$k]['width'] = 0;
					$res[$k]['height'] = 0;
				} 
				else {
					$res[$k]['shipping'] = true;
				}
				$res[$k]['publish']=="0" ? $res[$k]['publish'] = false : $res[$k]['publish'] = true;
				$res[$k]['taxable']=="0" ? $res[$k]['taxable'] = false : $res[$k]['taxable'] = true;
				if($res[$k]['compare_price']!=null) {
					$res[$k]['discount']=true;
					$res[$k]['compare_price']=floatval($res[$k]['compare_price']);
				}
				else {
					$res[$k]['discount']=false;
					$res[$k]['compare_price']=null;
				}
				$res[$k]['price'] = floatval($res[$k]['price']);

			}
			// $this->input->get('page')?$page = $this->input->get('page'):$page=1;
			// $this->input->get('limit')?$limit = $this->input->get('limit'):$limit=10;
			// $res=pagination($res,$page,$limit);
			$this->set_response(array('status'=>true, 'message'=>'Products dispalyed', 'products'=> $res));
		}
		else {
			$this->set_response(array('status'=>false, 'message'=>'Something went wrong'));
		}
	}
	public function get_get($e=null) {
		$public_key = token();
		if(!$public_key) {
			$this->set_response(array('status'=>false, 'message'=>'Authorization header missing'));
			return;
		}
		$id = $this->input->get('id');
		$res = $this->products_model->get_single($id, $public_key);
		if($res) {
			$res['images'] = [];
			if($e!=null) {
				foreach ($res['pics'] as $k => $v) {
					$src = $v['image_src'];
					array_push($res['images'], $src);  
				}
			}
			else {
				foreach ($res['pics'] as $k => $v) {
					$src = base_url().'files/'.$v['image_src'];
					array_push($res['images'], $src);  
				}
			}
			unset($res['pics']);
			if($res['track_inventory'] === "0") {
				$res['track_inventory'] = false;
				$res['quantity'] = 0;
			} 
			else {
				$res['track_inventory'] = true;
			}
			if($res['shipping'] === "0") {
				$res['shipping'] = false;
				$res['depth'] = 0;
				$res['weight'] = 0;
				$res['width'] = 0;
				$res['height'] = 0;
			} 
			else {
				$res['shipping'] = true;
			}
			$res['publish']=="0" ? $res['publish'] = false : $res['publish'] = true;
			$res['taxable']=="0" ? $res['taxable'] = false : $res['taxable'] = true;
			if($res['compare_price']!=null) {
				$res['compare_price'] = floatval($res['compare_price']);
				$res['discount']=true;
			}
			else {
				$res['compare_price'] = null;
				$res['discount']=false;
			}
			$res['price'] = floatval($res['price']);
			$this->set_response(array('status'=>true, 'message'=>'Display product', 'product'=>$res));
		}
		else {
			$this->set_response(array('status'=>false, 'message'=>'Something went wrong'));
		}
	}
	public function edit_post() {
		$auth = authenticate();
		if($auth) {
			$product = $this->input->post('product');
			$product['track_inventory'] == "true" ? $product['track_inventory'] = 1 : $product['track_inventory'] = 0;  
			$product['shipping'] == "true" ? $product['shipping'] = 1 : $product['shipping'] = 0;  
			$product['publish'] == "true" ? $product['publish'] = 1 : $product['publish'] = 0; 
			$product['taxable'] == "true" ? $product['taxable'] = 1 : $product['taxable'] = 0;  
			if(!isset($product['images'])) $product['images'] =array();
			if(!isset($product['compare_price'])||$product['compare_price']=="") {
				$product['compare_price']=null;
			}
			else {
				if($product['compare_price']<=$product['price']) {
					$product['compare_price'] = null;
				}	
			}
			$data = array(
				$product['name'],
				$product['sku'],
				$product['category_id'],
				$product['track_inventory'],
				$product['quantity'],
				$product['price'],
				$product['description'],
				$product['shipping'],
				$product['weight'],
				$product['depth'],
				$product['width'],
				$product['height'],
				$product['meta_description'],
				url_title($product['name'], 'dash', true),
				$product['publish'],
				$product['taxable'],
				$product['compare_price'],
				$product['id'],
				$auth['store_id']
			);
			$res = $this->products_model->edit($data, $product['images'], $product['id']);
			if($res) {
				$this->set_response(array(
					'status' => true,
					'message' => 'Product edited'
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
		$product = $this->input->post('product');
		$auth = authenticate();
		if($auth) {
			$res = $this->products_model->delete($product['id'], $auth['store_id']);
			if($res) {
				$this->set_response(array('status' => true, 'message' => 'Product deleted'));
			}
			else
				$this->set_response(array('status' => false, 'message' => 'Product still in use'));
			
		}
		else {
			$this->set_response(auth_error());
		}
	}
}
