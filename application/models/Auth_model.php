<?php

class Auth_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function check_store($store_email) {

		$q = 'select * from stores where store_email = ?';
		return $this->db->query($q, array(strtolower($store_email)))->result_array();
	}
	public function new_store($req) {
		$q = 'INSERT INTO stores(store_name, store_email, store_password, store_key, store_full_name) VALUES (?,?,?,?,?)';
		$this->db->query($q, array($req['store_name'],$req['store_email'],$req['store_password'],$req['store_key'],$req['store_full_name']));
	}
	public function login($email, $pass) {
		$q = 'select * from stores where store_email =? and store_password=?';
		return $this->db->query($q, array($email, pwd($pass)))->row_array();
	}
}