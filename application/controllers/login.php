<?php
class login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
		if( $this->session->userdata('validate_user') ) {
			//redirect('/order');
		}
	}

	public function index() {
		redirect(base_url());
	}

	public function forgot_password()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data = '';
		$data['msg'] = $this->session->flashdata('msg');
		$this->form_validation->set_rules('username', 'Username', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('forgot_password', $data);
		}
		else {
			// Validate the user can login
	        $result = $this->login_model->checkusername();
	        // Now we verify the result
	       if(empty($result))
	       {     // If user did not validate, then show them login page again
	            $data['invalid'] = 1;
	            $this->form_validation->set_message('username', 'Email or password wrong.');
	            $this->load->view('forgot_password', $data);
	        }else{
				 
				 // send email.....	        	
		         //redirect('dashboard'); 


					$this->load->library( 'email' );
					$config = array (
			                  'mailtype' => 'html',   
			                  'charset'  => 'utf-8',
			                  'priority' => '1'
			        );
					$this->email->initialize($config);


					$admessage = 'Partner ( User ) : ' . $result['username'] . '<br/><br/>' . 
									 'is trying to forgot password. ';

					$this->email->from( 'admin@chiangkong' );
				   	$this->email->to( 'admin@chiangkong' );
				   	$this->email->subject( 'Forgot Password' );	   		
				   	$this->email->message($admessage);
				   	//$this->email->send();
				   	
					$shmsg = 'Sent email successfully. Need to wait Administrator approve';
					$this->session->set_flashdata('msg', $shmsg);
					redirect(base_url().'login/');
	        } 
		}
	}

	public function validate_user(){
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		//$curl 	  	= $this->input->post('cur_url');

		$rdr = base_url().'home/main';

		$check_e = $this->check_user_email($email);
		$check_acc = $this->check_activate_acc($email);

		if($check_e != '1'){
			$ret = array(
				'status'	=> 'fail',
				'ret_msg'	=> 'Account does not exist!',
				'rd_url'	=> '',
			);
		}

		else if($check_acc != '1'){
			$ret = array(
				'status'	=> 'fail',
				'ret_msg'	=> 'Account need to activate!',
				'rd_url'	=> '',
			);
		}

		else{
			$check_p = $this->check_user_password($email,$password);
			if($check_p == 0){
				$ret = array(
					'status'	=> 'fail',
					'ret_msg'	=> 'Password is not correct!',
					'rd_url'	=> '',
				);
			}
			else{
	            $ret = array(
	            	'status'	=> 'success',
	            	'ret_msg'	=> 'Login Successfully!',
	            	'rd_url'	=> $rdr,
	            );
			}
		}

		echo json_encode($ret);
	}

	public function check_user_email($email) {
		//$email = $this->security->xss_clean($this->input->post('email'));

        $result = $this->user_model->email_exist($email);
        if($result){
        	return true;
        }
        else{
        	return 0;
        }
        //$this->form_validation->set_message('check_user_email', 'Account does not exist');
        return false;
	}

	public function check_user_password($email,$password) {
       // $email = $this->security->xss_clean($this->input->post('email'));
       // $password = $this->security->xss_clean($this->input->post('password'));
        $result = $this->user_model->login($email, $password);
        if($result){
        	return true;
        }
        else{
        	return 0;
        }
        //$this->form_validation->set_message('check_user_password', 'Password is not correct');
        return false;
	}

	public function check_activate_acc($email) {
		//$email = $this->security->xss_clean($this->input->post('email'));

        $result = $this->user_model->email_activate($email);
        if($result){
        	return true;
        }
        else{
        	return 0;
        }
        //$this->form_validation->set_message('check_user_email', 'Account does not exist');
        return false;
	}

}