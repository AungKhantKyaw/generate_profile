<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_login_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('encrypt');
    }

    public function validate()
    {        
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        //Prep the query
        $this->db->select('*');
        $this->db->from('admin_user');
        $this->db->where('admin_name', $username);
        $this->db->where('admin_password',  md5($password));
        $this->db->where('active',1);
        
        // Run the query
        $query = $this->db->get();
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'user_id'       => $row->admin_id,
                'admin_name'    => $row->admin_name,               
                'validate_user' => true,
            );
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }

    public function search_record_count() {

        if( $this->input->get('currency') && ( $this->input->get('currency') != '' ) ) {
            $this->db->where('au.currency', $this->input->get('currency')); 
        } 
        $this->db->select('*');
        $this->db->from('admin_user au');
        $this->db->where('active', 1);
        $query = $this->db->get();
        return $query->num_rows(); 
    }

    public function search_fetch_systemuser($limit, $start) {
        if( $this->input->get('sort') && ( $this->input->get('sort') != '' ) ) {
            $this->db->order_by("cat_eng", $this->input->get('sort')); 
        }
        if( $this->input->get('currency') && ( $this->input->get('currency') != '' ) ) {
            $this->db->where('c.currency', $this->input->get('currency')); 
        } 
        $this->db->select('*');
        $this->db->from('admin_user au');
        $this->db->where('active', 1);
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

    public function get_users($id = FALSE) {
        if ($id === FALSE)
        {
            $array = array('active' => 1);
            $this->db->where($array); 
            $query = $this->db->get('admin_user');
            return $query->result_array();
        }

        $query = $this->db->get_where('admin_user', array('admin_id' => $id));
        return $query->row_array();
    }

    public function add_sys_user(){
        $data = array(
            'admin_name'        => $this->input->post('admin_name'),
            'admin_password'    => md5($this->input->post('password')),
        );
        return $this->db->insert('admin_user', $data);
    }

    public function update_sys_user($id){
        $data = array(
            'admin_name'      => $this->input->post('admin_name'),
        );
        if($this->input->post('password') != '') {
            $data['admin_password'] = md5($this->input->post('password'));
        }

        $this->db->where('admin_id', $id);
        return $this->db->update('admin_user', $data);         
    }

    public function delete_sys_user($id) {
        $data = array(
            'active' => 0,
        );
        $this->db->where('admin_id', $id);
        return $this->db->update('admin_user', $data); 
    }    
}
?>