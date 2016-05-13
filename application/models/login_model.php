<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function validate()
    {
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
   
        //Prep the query
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        
        // Run the query
        $query = $this->db->get();
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'login_user'    => 'system_user',
                'user_id'       => $row->user_id,
                'name'          => $row->username,
                'role'          => $row->role_id,
                'validate_user' => true,
            );
            $this->session->set_userdata($data);
            return true;
        }
        // else{
        //     $this->db->select('*');
        //     $this->db->from('customer');
        //     $this->db->where('email', $email);
        //     $this->db->where('password', md5($password));
        //     $query = $this->db->get();

        //     if($query->num_rows == 1)
        //     {
        //         // If there is a user, then create session data
        //         $row = $query->row();
        //        // echo 'herer';
        //         $data = array(
        //             'login_user'    => 'customer',
        //             'user_id'       => $row->customer_id,
        //             'name'          => $row->customer_name,
        //             'email'         => $row->email,
        //             'role'          => '',
        //             'validate_user' => true,
        //         );
        //         $this->session->set_userdata($data);
        //         return true;
        //     }
        // }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>