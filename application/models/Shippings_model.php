<?php

class Shippings_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function int_shipping($data) {
		$q="SELECT store_shipping_int status, store_shipping_int_first shipping_first, store_shipping_int_each shipping_each FROM `stores` WHERE store_id=?";
		return $this->db->query($q,$data)->row_array();
	}
	public function edit_int_shipping($data) {
		$q="UPDATE `stores` SET `store_shipping_int`=?,`store_shipping_int_first`=?,`store_shipping_int_each`=? WHERE store_id=?";
		$this->db->query($q,$data);
		return true;
	}
	

}