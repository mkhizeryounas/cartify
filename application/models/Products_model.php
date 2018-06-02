<?php

class Products_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create($data, $imgs, $key) {
		$q = "INSERT INTO `products`(`product_name`, `category_key`, `product_inventory_track`, `product_quantity`, `product_price`, `product_description`, `product_shipping`, `product_weight`, `product_depth`, `product_width`, `product_height`, `product_meta`, `product_key`, `store_id`, `product_slug`, `product_publish`, `product_sku`, `product_taxable`, product_compare_price) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->db->query($q, $data);
		if($this->db->affected_rows()) {
			$q2 = "INSERT INTO `images`(`image_src`, `product_key`) VALUES (?,?)";
			foreach($imgs as $i) {
				$this->db->query($q2, array($i, $key));
			}
		}
		return $this->db->affected_rows();
	}
	public function get_all($public_key) {
		$q = "SELECT p.product_name name, p.product_sku sku, p.product_taxable taxable, p.product_publish publish, c.category_key category_id, p.product_inventory_track track_inventory, p.product_quantity quantity, p.product_price price, p.product_description description, p.product_shipping shipping, p.product_weight weight, p.product_depth depth, p.product_width width, p.product_height height, p.product_meta meta_description, p.product_key id, p.product_slug slug, p.product_compare_price compare_price, c.category_name category_name, c.category_slug category_slug, (select i.image_src from images i where i.product_key = p.product_key limit 1 ) image FROM products p join stores s on p.store_id = s.store_id join categories c on c.category_key = p.category_key where s.store_key = ?";
		return $this->db->query($q, array($public_key))->result_array();
	}
	public function get_single($product_key, $public_key) {
		$q = "SELECT p.product_name name, p.product_sku sku, p.product_taxable taxable, p.product_publish publish, c.category_key category_id, p.product_inventory_track track_inventory, p.product_quantity quantity, p.product_price price, p.product_description description, p.product_shipping shipping, p.product_weight weight, p.product_depth depth, p.product_width width, p.product_height height, p.product_meta meta_description, p.product_key id, p.product_compare_price compare_price, p.product_slug slug, c.category_name category_name, c.category_slug category_slug FROM products p join stores s on p.store_id = s.store_id join categories c on c.category_key = p.category_key where s.store_key = ? and p.product_key=?";
		$res = $this->db->query($q, array($public_key, $product_key))->row_array();
		if($res) {
			$q2="SELECT `image_src` FROM `images` WHERE product_key = ?";
			$res['pics'] = $this->db->query($q2, array($product_key))->result_array();
			return $res;
		}
		else 
			return false;
	}
	public function edit ($data, $imgs, $key) {
		$q = "UPDATE `products` SET `product_name`=?,`product_sku`=?,`category_key`=?,`product_inventory_track`=?,`product_quantity`=?,`product_price`=?,`product_description`=?,`product_shipping`=?,`product_weight`=?,`product_depth`=?,`product_width`=?,`product_height`=?,`product_meta`=?,`product_slug`=?,`product_publish`=?,`product_taxable`=?,`product_compare_price`=? WHERE product_key=? and store_id=?";
		$this->db->query($q, $data);
		// if($this->db->affected_rows()) {
			$tmp = "DELETE FROM `images` WHERE product_key = ?";
			$this->db->query($tmp, array($key));
			$q2 = "INSERT INTO `images`(`image_src`, `product_key`) VALUES (?,?)";
			foreach($imgs as $i) {
				$this->db->query($q2, array($i, $key));
			}
		// }
		return true;
	}
	public function delete($product_key, $store_id) {
		$tmp = "DELETE FROM `images` WHERE product_key = ?";
		$this->db->query($tmp, array($product_key));
		$q = 'delete from products where product_key = ? and store_id = ?';
		$this->db->query($q, array($product_key, $store_id));
		return $this->db->affected_rows();			
	}
}