<?php

class Pages_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create($data) {
		$q = "INSERT INTO `pages`(`page_name`, `page_content`, `page_key`, `store_id`, `page_slug`) VALUES (?,?,?,?,?)";
		$this->db->query($q, $data);
		return $this->db->affected_rows();
	}
	public function get_all($public_key) {
		$q = "SELECT c.page_key id, c.page_slug slug, c.page_name as 'description', c.page_content as 'content' from pages c join stores s on c.store_id = s.store_id where s.store_key = ?";
		return $this->db->query($q, array($public_key))->result_array();
	}
	public function get_single($public_key, $id) {
		$q = "SELECT c.page_key id, c.page_slug slug, c.page_name as 'description', c.page_content as 'content' from pages c join stores s on c.store_id = s.store_id where s.store_key = ? and c.page_key=?";
		return $this->db->query($q, array($public_key, $id))->row_array();
	}
	public function delete($cat_id, $store_id) {
		$q = 'delete from pages where page_key = ? and store_id = ?';
		$this->db->query($q, array($cat_id, $store_id));
		return $this->db->affected_rows();			
	}
	public function edit($data) {
		$q = 'UPDATE `pages` SET `page_name`=?,`page_content`=?,`page_slug`=? WHERE page_key = ? and store_id = ?';
		$this->db->query($q, $data);
		return $this->db->affected_rows();			
	}
}