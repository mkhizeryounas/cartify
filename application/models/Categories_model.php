<?php

class Categories_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create_category($category, $store) {
		$q='insert into categories(category_name, store_id, category_key, category_slug) values (?,?,?,?)';
		$this->db->query($q, array($category, $store, uniqid(), url_title($category, 'dash', true)));
	}
	public function get_all($public_key) {
		$q = "SELECT c.category_key id, c.category_slug slug, c.category_name name from categories c join stores s on c.store_id = s.store_id where store_key = ?";
		return $this->db->query($q, array($public_key))->result_array();
	}
	public function get_single($cat_id, $public_key) {
		$q = "SELECT c.category_key id, c.category_slug slug, c.category_name name from categories c join stores s on c.store_id = s.store_id where s.store_key = ? and c.category_key = ?";
		$res = $this->db->query($q, array($public_key, $cat_id))->row_array();
		if($res) {
			$q2 = "SELECT p.product_name name, p.product_sku sku, p.product_taxable taxable, p.product_publish publish, c.category_key category_id, p.product_inventory_track track_inventory, p.product_quantity quantity, p.product_price price, p.product_description description, p.product_shipping shipping, p.product_weight weight, p.product_depth depth, p.product_width width, p.product_height height, p.product_meta meta_description, p.product_key id, p.product_slug slug, p.product_compare_price compare_price, c.category_name category_name, c.category_slug category_slug, (select i.image_src from images i where i.product_key = p.product_key limit 1 ) image FROM products p join stores s on p.store_id = s.store_id join categories c on c.category_key = p.category_key join collection_products cp on cp.product_key = p.product_key where s.store_key = ? and p.category_key = ?";
			$r = $this->db->query($q2, array($public_key, $cat_id))->result_array();
			$res['products']=$r;
		}
		else {
			return false;
		}
		return $res;
	}
	public function edit_category($cat_id, $cat_name, $store_id) {
		$q = 'update categories set category_name = ? where category_key = ? and store_id = ?';
		$this->db->query($q, array($cat_name, $cat_id, $store_id));
		return true;			
	}
	public function delete_category($cat_id, $store_id) {
		$q = 'delete from categories where category_key = ? and store_id = ?';
		$this->db->query($q, array($cat_id, $store_id));
		return $this->db->affected_rows();			
	}


}