<?php

class Customers_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function customer_check($customer, $id = null) {
		if($id != null) {
			$q = "SELECT * FROM `customers` c join stores s on c.store_id = s.store_id where s.store_key= ? and c.customer_email = ? and c.customer_key!=?";
			array_push($customer, $id);
		}
		else {
			$q = "SELECT * FROM `customers` c join stores s on c.store_id = s.store_id where s.store_key= ? and c.customer_email = ?";
		}
		return $this->db->query($q, $customer)->result_array();
	}
	public function create_customer($customer, $key) {
		$k = 'SELECT `store_id` FROM `stores` WHERE store_key = ?';
		$tmp = $this->db->query($k, array($key))->row_array();
		array_push($customer, $tmp['store_id']);
		$q='INSERT INTO `customers`(`customer_key`, `customer_name`, `customer_email`, `customer_phone`, `customer_password`, `customer_address`, `store_id`) VALUES (?,?,?,?,?,?,?)';
		$this->db->query($q, $customer);
	}
	public function get_all($data) {
		$q = "SELECT `customer_key` id, `customer_name`, `customer_email`, `customer_phone`, `store_id`, `customer_address` from customers where store_id= ?";
		return $this->db->query($q, $data)->result_array();
	}
	public function get_single($params) {
		$q = "SELECT c.customer_key id, c.customer_name name, c.customer_email email, c.customer_phone phone, c.customer_address address FROM customers c join stores s on c.store_id = s.store_id where c.customer_key = ? and s.store_key = ?";
		$res = $this->db->query($q, $params)->row_array();
		if($res) {
			return $res;
		}
		else {
			return false;
		}
	}
	public function login($params) {
		$q = "SELECT c.customer_key id, c.customer_name name, c.customer_email email, c.customer_phone phone, c.customer_address address FROM customers c join stores s on c.store_id = s.store_id where c.customer_email = ? and c.customer_password = ? and s.store_key = ?";
		$res = $this->db->query($q, $params)->row_array();
		if($res) {
			return $res;
		}
		else {
			return false;
		}
	}
	public function edit_customer($customer, $key) {
		$k = 'SELECT `store_id` FROM `stores` WHERE store_key = ?';
		$tmp = $this->db->query($k, array($key))->row_array();
		array_push($customer, $tmp['store_id']);
		$q='UPDATE `customers` SET `customer_name`=?,`customer_email`=?,`customer_phone`=?, `customer_address`=? where customer_key = ? and store_id = ?';
		$this->db->query($q, $customer);
	}
	public function edit_password($customer, $key) {
		$k = 'SELECT `store_id` FROM `stores` WHERE store_key = ?';
		$tmp = $this->db->query($k, array($key))->row_array();
		array_push($customer, $tmp['store_id']);
		$q='UPDATE `customers` SET `customer_password`=? where customer_key = ? and store_id = ?';
		$this->db->query($q, $customer);
	}
	public function delete($c_id, $store_id) {
		$q = 'delete from customers where customer_key = ? and store_id = ?';
		$this->db->query($q, array($c_id, $store_id));
		return $this->db->affected_rows();			
	}

}
