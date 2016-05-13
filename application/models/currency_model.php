<?php
class currency_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_currencys($id = FALSE) {
		if ($id === FALSE)
		{
			$this->db->where('active',1);
			$this->db->order_by('country','ASC');
			$query = $this->db->get('currency_config');
			return $query->result_array();
		}

		$query = $this->db->get_where('currency_config', array('currency_id' => $id));
		return $query->row_array();
	}

	public function get_currencys_home($id = FALSE) {
		if ($id === FALSE)
		{
			$this->db->where('active',1);
			$this->db->order_by('displays','ASC');
			$query = $this->db->get('currency_config');
			return $query->result_array();
		}

		$query = $this->db->get_where('currency_config', array('currency_id' => $id));
		return $query->row_array();
	}

	public function add_currency() {
		$imgname = $_FILES['logo']['name'];
		$data = array(			
			'country'		=> $this->input->post('country'),
			'currency'	 	=> $this->input->post('currency'),
			'symbol'		=> $this->input->post('symbol'),
			'img_file'		=> $imgname,
			'decimal_no'	=> $this->input->post('decimal_no'),
		);
		return $this->db->insert('currency_config', $data);
	}

	public function update_currency($id) {

		if($_FILES['logo']['name'] != "")
		{
			$imgname = $_FILES['logo']['name'];
		}
		else{
			$imgname = $this->input->post('himg');
		}

		$data = array(			
			'country'		=> $this->input->post('country'),
			'currency'	 	=> $this->input->post('currency'),
			'symbol'		=> $this->input->post('symbol'),
			'img_file'		=> $imgname,
			'decimal_no'	=> $this->input->post('decimal_no'),
		);

		$this->db->where('currency_id', $id);
		return $this->db->update('currency_config', $data); 
	}

	public function delete_currency($id) {
		$data = array(
			'active' => 0,
        );
        $this->db->where('currency_id', $id);
		return $this->db->update('currency_config', $data); 
	}

	public function search_record_count() {
		if( $this->input->get('sort') && ( $this->input->get('sort') != '' ) ) {
			$this->db->order_by("cat_eng", $this->input->get('sort')); 
        }
        if( $this->input->get('currency') && ( $this->input->get('currency') != '' ) ) {
			$this->db->where('c.currency', $this->input->get('currency')); 
        } 
        $this->db->select('*');
        $this->db->from('currency_config c');
        $this->db->where('active', 1);
        $this->db->order_by('country','ASC');
        $query = $this->db->get();
		return $query->num_rows(); 
	}

	public function search_fetch_currency($limit, $start) {
		if( $this->input->get('sort') && ( $this->input->get('sort') != '' ) ) {
			$this->db->order_by("cat_eng", $this->input->get('sort')); 
        }
        if( $this->input->get('currency') && ( $this->input->get('currency') != '' ) ) {
			$this->db->where('c.currency', $this->input->get('currency')); 
        } 
        $this->db->select('*');
        $this->db->from('currency_config c');
        $this->db->where('active', 1);
        $this->db->order_by('country','ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
	}

	//for dashboard
	public function total_currency(){
		$this->db->select('*');
		$this->db->from('currency_config');
		$this->db->where('active',1);
		return $this->db->count_all_results();
	}

}