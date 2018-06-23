<?php

class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function get_cart($cart, $store_id) {
		$q = "
		SELECT o.order_key id, o.order_status as status FROM orders o where order_key = ? and o.store_id = ?";
		return $this->db->query($q, [$cart, $store_id])->row_array();
	}
	public function create_cart($cart, $order_id) {
		$q = "INSERT INTO `orders`(`order_key`, `store_id`) VALUES (?,?)";
		return $this->db->query($q, [$cart, $order_id]);	
	}
	public function get_order_products($cart, $store_id) {
		$q = "SELECT op.product_key id, p.product_name as name, product_sku sku, p.product_slug slug, op.op_qty qty, op.op_price original_price, op.op_sale_price sale_price, concat(?,i.image_src) as image_src FROM order_products op join orders o on op.order_key = o.order_key JOIN PRODUCTS p ON op.product_key = p.product_key join images i on p.product_key = i.product_key WHERE o.order_key = ? and o.store_id = ? group by id";
		return $this->db->query($q, [base_url("files/"), $cart, $store_id])->result_array();
	}
	public function delete_product_from_order($product, $order) {
		return $this->db->query('DELETE FROM order_products WHERE product_key = ? and order_key = ?', [
			$product,
			$order
		]);
	}
	public function add_to_cart ($obj) {
		$q = "INSERT INTO `order_products`(`product_key`, `op_qty`, `op_price`, `op_sale_price`, `order_key`) VALUES (?,?,?,?,?)";
		return $this->db->query($q, $obj);
	}
	public function get_token_by_cart($cart) {
		return $this->db->query("select s.store_key id from orders o join stores s on s.store_id = o.store_id where o.order_key = ?", [$cart])->row_array();
	}
}