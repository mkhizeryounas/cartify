<?php

class Taxes_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function getCountires($id) {
		$q='SELECT c.country_id id, c.country_name name FROM countries as c WHERE not exists (select t.country_id country_id from tax_countries t where t.store_id = ? and c.country_id = t.country_id) and c.country_id != 0';
		return $this->db->query($q, array($id))->result_array();
	}
	public function create($data) {
		$q = "INSERT INTO `tax_countries`(`country_id`, `store_id`, `tc_percentage`, `tc_key`) VALUES (?,?,?,?)";
		$this->db->query($q, $data);
		return $this->db->affected_rows();
	}
	public function all($id) {
		$q = "SELECT c.country_name country_name, tc.country_id country, tc.tc_percentage percent, tc.tc_key id FROM tax_countries tc join countries c on tc.country_id = c.country_id  WHERE store_id = ?";
		return $this->db->query($q,array($id))->result_array();
	}
	public function get($tax_id, $id) {
		$q = "SELECT c.country_name country_name, tc.country_id country, tc.tc_percentage percent, tc.tc_key id FROM tax_countries tc join countries c on tc.country_id = c.country_id  WHERE store_id = ? and tc_key=?";
		return $this->db->query($q,array($id, $tax_id))->row_array();
	}
	public function update($data) {
		$q = "UPDATE `tax_countries` SET `tc_percentage`=? WHERE tc_key=? and store_id=?";
		$this->db->query($q, $data);
		return true;
	}
	public function delete($data) {
		$q = "DELETE FROM `tax_countries` WHERE tc_key=? and store_id=?";
		$this->db->query($q, $data);
		return $this->db->affected_rows();
	}

}