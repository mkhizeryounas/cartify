<?php

class Coupons_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create($data) {
		$q = "INSERT INTO `coupons`(`coupon_code`, `coupon_type`, `coupon_limit`, `coupon_begin`, `coupon_expire`, `coupon_key`, `coupon_publish`, `store_id`, `coupon_limit_left`, `coupon_has_count_limit`, `coupon_value`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$this->db->query($q, $data);
		return $this->db->affected_rows();
	}
	public function get_single($data,$e=null) {
		if($e==null) {
			$q = "SELECT c.coupon_type type, c.coupon_limit as 'limit', c.coupon_begin begin, c.coupon_expire expire, c.coupon_key id, c.coupon_publish publish, c.coupon_limit_left remaining, c.coupon_has_count_limit has_count_limit, c.coupon_code code, c.coupon_value value FROM coupons c join stores s on c.store_id = s.store_id where s.store_key= ? and c.coupon_code=? or c.coupon_key=?";
		}
		else {
			$q = "SELECT c.coupon_type type, c.coupon_limit as 'limit', c.coupon_begin begin, c.coupon_expire expire, c.coupon_key id, c.coupon_publish publish, c.coupon_limit_left remaining, c.coupon_has_count_limit has_count_limit, c.coupon_code code, c.coupon_value value FROM coupons c join stores s on c.store_id = s.store_id where s.store_key= ? and c.coupon_code=? and c.coupon_key!=?";
			$data[count($data)-1] = $e;
		}
		return $this->db->query($q, $data)->row_array();
	}
	public function get_all($data) {
		$q = "SELECT c.coupon_type type, c.coupon_limit as 'limit', c.coupon_begin begin, c.coupon_expire expire, c.coupon_key id, c.coupon_publish publish, c.coupon_limit_left remaining, c.coupon_has_count_limit has_count_limit, c.coupon_code code, c.coupon_value value FROM coupons c join stores s on c.store_id = s.store_id where s.store_key= ?";
		return $this->db->query($q, $data)->result_array();
	}
	public function edit($data) {
		$q = "UPDATE `coupons` SET `coupon_type`=?,`coupon_limit`=?,`coupon_begin`=?,`coupon_expire`=?,`coupon_publish`=?,`coupon_limit_left`=?,`coupon_has_count_limit`=?,`coupon_code`=?,`coupon_value`=? where coupon_key=? and store_id=?";
		$this->db->query($q, $data);
		return true;
	}
	public function delete($c_id, $store_id) {
		$q = 'delete from coupons where coupon_key = ? and store_id = ?';
		$this->db->query($q, array($c_id, $store_id));
		return $this->db->affected_rows();			
	}
}