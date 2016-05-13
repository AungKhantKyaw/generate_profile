<?php
class user_address_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	//for dashboard
	public function request_address($term){
		$this->db->select('*');
		$this->db->from('user_address');
		$this->db->where("(uaddress LIKE '%$term%')");
		$this->db->where('user_id',$this->session->userdata('sgcurrency_user_id'));
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	//check address have or not
	public function check_address($add){
		$this->db->select('*');
		$this->db->from('user_address');
		$this->db->where('user_id',$this->session->userdata('sgcurrency_user_id'));
		$this->db->where('active',1);
		$this->db->where('uaddress',$add);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function add_user_address($add){
		$data = array(
			'uaddress'	=> $add,
			'user_id'	=> $this->session->userdata('sgcurrency_user_id'),
		);
		return $this->db->insert('user_address', $data);
	}
}