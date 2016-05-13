<?php
class currency_post_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_post_currencys($id = FALSE) {
		if ($id === FALSE)
		{
			$this->db->where('active', 1);
			$this->db->order_by('post_date','DESC');
			$query = $this->db->get('currency_post');
			return $query->result_array();
		}

		$query = $this->db->get_where('currency_post', array('post_id' => $id));
		return $query->row_array();
	}	

	public function get_change_currency($cur_name){
		$this->db->select('*');
		$this->db->from('currency_config cf');
		$this->db->where('cf.country',$cur_name);
		$this->db->where('cf.active',1);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function post_currency() {
		$data = array(			
			'currency_id'		=> $this->input->post('currency_id'),
			'rate'	 			=> $this->input->post('rate'),
			'location'	 		=> $this->input->post('location'),
			'address'	 		=> $this->input->post('address'),
			'post_date'			=> strtotime($this->input->post('datetime')),
			'post_by'			=> $this->session->userdata('sgcurrency_user_id'),
			'remark'			=> $this->input->post('remark'),
		);
		return $this->db->insert('currency_post', $data);
	}

	public function update_currency($id) {
		$data = array(			
			'country'		=> $this->input->post('country'),
			'currency'	 	=> $this->input->post('currency'),
			'symbol'		=> $this->input->post('symbol'),
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
        if( $this->input->post('location') && ( $this->input->post('location') != '' ) ) {
			
			$split = explode(',', $this->input->post('location'));
			// print_out($split);
			foreach($split as $val){				
				//$this->db->where('c.location', "MRT",'both');
				$this->db->or_where("(c.location LIKE '%$val%')");
			}
        } 

		if( $this->input->post('currency_id') && ( $this->input->post('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->post('currency_id'));
        }

        if( $this->input->post('start_date') && ( $this->input->post('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->post('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->post('end_date') && ( $this->input->post('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->post('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	


        if( $this->input->get('location') && ( $this->input->get('location') != '' ) ) {			
			$split = explode(',', $this->input->get('location'));
			// print_out($split);
			foreach($split as $val){				
				//$this->db->where('c.location', "MRT",'both');
				$this->db->or_where("(c.location LIKE '%$val%')");
			}
        } 

		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }


        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }

		if( $this->input->get('sort_by') && ( $this->input->get('sort_by') != '' ) ) {
			$this->db->order_by('c.post_date', $this->input->get('sort_by'));
        }
        else{
           $this->db->order_by('c.post_date','DESC');
        } 

        $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
       // $this->db->where('c.post_date BETWEEN DATE_SUB(NOW(), INTERVAL 3 DAY) AND NOW()');
        $this->db->order_by('c.post_date','DESC');
        $query = $this->db->get();
		return $query->num_rows(); 
	}

	public function search_fetch_post($limit, $start) {

        if( $this->input->post('location') && ( $this->input->post('location') != '' ) ) {
			
			$split = explode(',', $this->input->post('location'));
			foreach($split as $val){								
				$this->db->or_where("(c.location LIKE '%$val%')");
			}
        } 

		if( $this->input->post('currency_id') && ( $this->input->post('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->post('currency_id'));
        }

        if( $this->input->post('start_date') && ( $this->input->post('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->post('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->post('end_date') && ( $this->input->post('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->post('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	
        
        if( $this->input->get('location') && ( $this->input->get('location') != '' ) ) {			
			$split = explode(',', $this->input->get('location'));

			foreach($split as $val){	
				
				//$this->db->where('c.location', "MRT",'both');
				$this->db->or_where("(c.location LIKE '%$val%')");
			}
        }

		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }        

        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }

		if( $this->input->get('sort_by') && ( $this->input->get('sort_by') != '' ) ) {
			$this->db->order_by('c.post_date', $this->input->get('sort_by'));
        }
        else{
           $this->db->order_by('c.post_date','DESC');
        }  

        $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
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
	public function total_cur_post(){
		$this->db->select('*');
		$this->db->from('currency_post');
		$this->db->where('active',1);
		return $this->db->count_all_results();
	}

	//today best rate
	public function get_best_rates_by_date(){
		$this->db->select('cp.*,cg.currency');
		$this->db->from('currency_post cp');
		$this->db->join('currency_config cg','cp.currency_id = cg.currency_id');
		$this->db->order_by('cp.rate','DESC');
		$this->db->where('cp.active',1);
		$this->db->where('cg.active',1);
		$this->db->where('cp.post_date >=', time());
		$this->db->group_by('cp.currency_id');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result_array();
	}

	//latest best rate
	public function get_best_latest_rate(){
		$this->db->select('cp.*,cg.currency,cg.symbol,cg.decimal_no');
		$this->db->from('currency_post cp');
		$this->db->join('currency_config cg','cp.currency_id = cg.currency_id');
		$this->db->where('cp.active',1);
		$this->db->where('cg.active',1);
		$this->db->where('cp.post_date >=', strtotime(date('d-M-Y')));
		$this->db->group_by('cp.currency_id');
		$this->db->order_by('cp.rate','DESC');
		$this->db->limit(7);
		$query = $this->db->get();
		return $query->result_array();		
	}

	//using admin panel //
	public function search_record_count_post() {
		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }

        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	        
        $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
        $this->db->order_by('c.post_date','DESC');
        $query = $this->db->get();
		return $query->num_rows(); 
	}

	public function search_fetch_currency_rate($limit, $start){
		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }
        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	
	    $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
        $this->db->order_by('c.post_date','DESC');
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

	public function delete_currency_post($id){
		$data = array(
			'active' => 0,
        );
        $this->db->where('post_id', $id);
		return $this->db->update('currency_post', $data); 		
	}

	public function update_currency_post($id){
		$data = array(			
			'currency_id'		=> $this->input->post('currency_id'),
			'rate'	 			=> $this->input->post('rate'),
			'location'	 		=> $this->input->post('location'),
			'address'	 		=> $this->input->post('address'),			
			'remark'			=> $this->input->post('remark'),
		);
		$this->db->where('post_id',$id);
		return $this->db->update('currency_post',$data);
	}

	//for user post///
	public function count_user_post($id){

		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }

        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	        
        $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
        $this->db->where('c.post_by',$id);
        $this->db->order_by('c.post_date','DESC');
        $query = $this->db->get();
		return $query->num_rows(); 

	}


	public function search_fetch_user_post($limit, $start, $id){
		if( $this->input->get('currency_id') && ( $this->input->get('currency_id') != '' ) ) {
			$this->db->where('c.currency_id', $this->input->get('currency_id')); 
        }

        if( $this->input->get('start_date') && ( $this->input->get('start_date') != '' ) ) { 
            $start_date = get_earliesttimestamp($this->input->get('start_date'), '-');
            $this->db->where('c.post_date >=', $start_date);
        }

        if( $this->input->get('end_date') && ( $this->input->get('end_date') != '' ) ) { 
            $end_date = get_latesttimestamp($this->input->get('end_date'), '-');
            $this->db->where('c.post_date <=', $end_date);
        }	
        $this->db->select('c.*,u.email,cu.*');
        $this->db->from('currency_post c');
        $this->db->join('user u','c.post_by = u.user_id');
        $this->db->join('currency_config cu','c.currency_id = cu.currency_id');
        $this->db->where('c.active',1);
        $this->db->where('cu.active',1);
        $this->db->where('c.post_by',$id);
        $this->db->order_by('c.post_date','DESC');
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

	public function get_cur_detail($post_id){
		$this->db->select('cp.*,c.*');
		$this->db->from('currency_post cp');
		$this->db->join('currency_config c','cp.currency_id = c.currency_id');
		$this->db->where('cp.post_id',$post_id);
		$this->db->where('cp.active',1);
		$this->db->where('c.active',1);
		$query = $this->db->get();
		return $query->row_array();
	}

}