<?php

class Collections_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create($data,$products,$key) {
		$q = "INSERT INTO `collections`(`collection_name`, `collection_key`, `store_id`, `collection_publish`,collection_slug) VALUES (?,?,?,?,?)";
		$this->db->query($q, $data);
		if($this->db->affected_rows()) {
			$q2="INSERT INTO `collection_products`(`collection_key`, `product_key`) VALUES (?,?)";
			foreach ($products as $k => $value) {
				$this->db->query($q2, array($key, $value['id']));
			}
		}
		else {
			return false;
		}
		return $this->db->affected_rows();
	}
	public function get_all($public_key) {
		$q = "SELECT c.collection_name name, c.collection_key id, c.collection_slug slug, c.collection_publish publish FROM collections c join stores s on s.store_id = c.store_id where s.store_key = ?";
		return $this->db->query($q, array($public_key))->result_array();
	}
	public function get_single($public_key, $collection_key) {
		$q = "SELECT c.collection_name name, c.collection_key id, c.collection_slug slug, c.collection_publish publish FROM collections c join stores s on s.store_id = c.store_id where s.store_key = ? and c.collection_key=?";
		$res = $this->db->query($q, array($public_key, $collection_key))->row_array();
		if($res) {
			$q2 = "SELECT p.product_name name, p.product_sku sku, p.product_taxable taxable, p.product_publish publish, c.category_key category_id, p.product_inventory_track track_inventory, p.product_quantity quantity, p.product_price price, p.product_description description, p.product_shipping shipping, p.product_weight weight, p.product_depth depth, p.product_width width, p.product_height height, p.product_meta meta_description, p.product_key id, p.product_slug slug, p.product_compare_price compare_price, c.category_name category_name, c.category_slug category_slug, (select i.image_src from images i where i.product_key = p.product_key limit 1 ) image FROM products p join stores s on p.store_id = s.store_id join categories c on c.category_key = p.category_key join collection_products cp on cp.product_key = p.product_key where s.store_key = ? and cp.collection_key = ?";
			$r = $this->db->query($q2, array($public_key, $collection_key))->result_array();
			$res['products']=$r;
		}
		else {
			return false;
		}
		return $res;
	}
	public function edit($data,$products,$key) {
		$q = "UPDATE `collections` SET `collection_name`=?,`collection_publish`=?, collection_slug=? WHERE collection_key=? and store_id=?";
		$this->db->query($q, $data);
		$tmp = "DELETE FROM `collection_products` WHERE collection_key=?";
		$this->db->query($tmp, array($key));
		$q2="INSERT INTO `collection_products`(`collection_key`, `product_key`) VALUES (?,?)";
		foreach ($products as $k => $value) {
			$this->db->query($q2, array($key, $value['id']));
		}
		return true;
	}
	public function delete($id, $store_id) {
		$q = 'delete from collection_products where collection_key = ?';
		$this->db->query($q, array($id));
		$q = 'delete from collections where collection_key = ? and store_id = ?';
		$this->db->query($q, array($id, $store_id));
		return $this->db->affected_rows();			
	}
}