<?php
class user_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users($id = FALSE) {
		if ($id === FALSE)
		{
			$this->db->where('active',1);
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$query = $this->db->get_where('user', array('user_id' => $id));
		return $query->row_array();
	}

	public function add_user() {
		$data = array(
			'username'		=> $this->input->post('username'),
			'password'	 	=> md5($this->input->post('password')),
			'role_id'	 	=> $this->input->post('role_id'),
		);
		return $this->db->insert('user', $data);
	}

	public function update_user($id) {
		$data = array(
			'email'		    => $this->input->post('email'),
			'is_activate'	=> $this->input->post('is_activate'),
		);
		if($this->input->post('password') != '') {
        	$data['password'] = md5($this->input->post('password'));
        }

		$this->db->where('user_id', $id);
		return $this->db->update('user', $data); 
	}

	public function delete_user($id) {
		$data = array(
			'active' => 0,
        );
        $this->db->where('user_id', $id);
		return $this->db->update('user', $data); 
	}

    public function check_old_password($id, $old_password){
        $this->db->where('password =', md5($old_password));
        $this->db->where('user_id =', $id);
        $this->db->where('status !=', 1);
        $query = $this->db->get("user");
        if($query->num_rows == 1){
            return true;
        }
        return false;
    }

    public function change_password($id){
        $data = array(
            'password' => $this->security->xss_clean(md5($this->input->post('new_password'))),
            );
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data); 
    }

	public function search_record_count() {
       	if( $this->input->get('email') && ( $this->input->get('email') != '' ) ) {
			$this->db->where('u.email', $this->input->get('email')); 
        }	        				
        $this->db->select('u.*,');
        $this->db->from('user u');
        $this->db->where('u.active',1);
        $query = $this->db->get();
		return $query->num_rows(); 
	}

	public function search_fetch_user($limit, $start) {	
       	if( $this->input->get('email') && ( $this->input->get('email') != '' ) ) {
			$this->db->where('u.email', $this->input->get('email')); 
        }			
        $this->db->select('u.*,');
        $this->db->from('user u');
        $this->db->where('u.active',1);
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

	public function username_exist($username, $id=FALSE){
        if ($id) {
            $this->db->where('user_id !=', $id);
        }
        $query = $this->db->get_where('user', array('username' => $username, 'status' => 0));
        if ($query->num_rows()==1) {
            return $query->row();
        }
        return false;
    }

    public function email_exist($email, $id=FALSE){
        if ($id) {
            $this->db->where('user_id !=', $id);
        }
        $query = $this->db->get_where('user', array('email' => $email, 'active' => 1));
        if ($query->num_rows()==1) {
            return $query->row();
        }
        return false;
    }

    public function act_code_exist($id){
        $query = $this->db->get_where('user', array('act_code' => $id, 'active' => 1));
        if ($query->num_rows()==1) {
            return $query->row();
        }
        return false;
    }

    public function email_activate($email, $id=FALSE){
        if ($id) {
            $this->db->where('user_id !=', $id);
        }
        $query = $this->db->get_where('user', array('email' => $email, 'is_activate' => 1, 'active' => 1));
        if ($query->num_rows()==1) {
            return $query->row();
        }
        return false;
    }
    

    public function signup_user(){
        $data = array(
            'email'       => $this->input->post('email'),
            'password'    => md5($this->input->post('password')),           
            'date'        => strtotime(date('d-m-Y')),
        );
        $this->db->insert('user', $data);
        $int_id = $this->db->insert_id();
        $this->update_act($int_id);
        return $int_id;

    }

    public function getuserid($email){
        $query = $this->db->get_where('user', array('email' => $email, 'active' => 1));
        return $query->row_array();
    }

    public function update_act($int_id){
        $rnum = 'sgcurrencyrate'.$int_id.time();
        $enc = base64_url_encode($rnum);

        $data = array(
            'act_code' => $enc,
        );

        $this->db->where('user_id',$int_id);
        $this->db->update('user',$data);
    }

    public function login($email, $password){
        // Prep the query
        $this->db->select('u.*');
        $this->db->from('user u');      
        $this->db-> where('u.email', $email);
        $this->db->where('u.password', md5($password));
        $this->db->where('u.active', 1);
        $this->db->where('is_activate',1);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows == 1)
        {
            $row = $query->row();
            $data = array(
                'sgcurrency_user_id'           => $row->user_id,
                'sgcurrency_email'             => $row->email,
                'sgcurrency_facebook'          => 0,
                'sgcurrency_validate_user'     => true,
            );
            $this->session->set_userdata($data);
            return $row;
        }
        return false;
    }    

    public function activate_login($email){
        $this->db->select('u.*');
        $this->db->from('user u');      
        $this->db-> where('u.email', $email);
        $this->db->where('u.active', 1);
        $this->db->where('is_activate',1);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows == 1)
        {
            $row = $query->row();
            $data = array(
                'sgcurrency_user_id'           => $row->user_id,
                'sgcurrency_email'             => $row->email,
                'sgcurrency_facebook'          => 0,
                'sgcurrency_validate_user'     => true,
            );
            $this->session->set_userdata($data);
            return $row;
        }
        return false;        
    }

    public function change_user_password($id){
        $data = array(
            'password'    => md5($this->input->post('password')),     
        );
        $this->db->where('user_id',$id);
        return $this->db->update('user', $data);
    }

    //facebook /////

    public function facebook_login($act_code){
        $this->db->select('u.user_id, u.email, u.password');
        $this->db->from('user u');
        $this->db-> where('u.act_code', $act_code);
        $this->db->where('u.active',1);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows == 1)
        {
            $row = $query->row();         
            $data = array(
                'sgcurrency_user_id'           => $row->user_id,
                'sgcurrency_email'             => $act_code,
                'sgcurrency_facebook'          => 1,
                'sgcurrency_validate_user'     => true,
            );
            $this->session->set_userdata($data);
            return $row;
        }
        return false;
    }

    public function facebook_login_email($act_code){
        $this->db->select('u.user_id, u.email, u.password');
        $this->db->from('user u');
        $this->db-> where('u.email', $act_code);
        $this->db->where('u.active',1);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows == 1)
        {
            $row = $query->row();         
            $data = array(
                'sgcurrency_user_id'           => $row->user_id,
                'sgcurrency_email'             => $act_code,
                'sgcurrency_facebook'          => 1,
                'sgcurrency_validate_user'     => true,
            );
            $this->session->set_userdata($data);
            return $row;
        }
        return false;
    }

    public function register_with_facebook($contact_person,  $id){
        $data = array(
            // 'email'         => $email,
            'act_code'      => $id,
            'is_activate'   => 1,
            'date'          => time(),
            'is_facebook'   => 1,
        );
        $this->db->insert('user', $data);
        $user_id = $this->db->insert_id();
        return $user_id;
    }

    public function total_pub_user(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('active',1);
        $this->db->where('is_activate',1);
        return $this->db->count_all_results();
    }

    public function update_user_by_id($id,$pword){
        $data = array(
            'password'  => md5($pword),
        );

        $this->db->where('user_id',$id);
        return $this->db->update('user',$data);
    }

    public function check_activate_code($act_code,$id){
        $query = $this->db->get_where('user', array('active' => 1, 'act_code' => $act_code, 'user_id' => $id));
        if($query->num_rows == 0) {
            return FALSE;
        }
        return TRUE;
    }

    public function activate_user_by_id($id){
        $data = array(
            'is_activate' => 1,
        );  
        $this->db->where('user_id',$id);
        return $this->db->update('user',$data);
    }
}