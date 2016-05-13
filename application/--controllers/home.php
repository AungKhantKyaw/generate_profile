<?php
class home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->library('encrypt');
		if( $this->session->userdata('validate_user') ) {
			//redirect('/order');
		}
	}

	public function index() {
		//Check Already login or not 
		$data['msg'] = $this->session->flashdata('msg');

		$data['img'] = '1161216487240959.jpg';

		$this->load->view('template/header');
		if(!$this->session->userdata('sgcurrency_validate_user')){
			$this->load->view('home/index', $data);
		}
		else{
			$this->load->view('home/index', $data);
		}
		$this->load->view('template/footer');
		
	}

	public function img_download($uid){
		force_download($uid.'.jpg', 'uploads/'.$uid.'.jpg');
	}

	public function signup(){
		$data['msg'] = $this->session->flashdata('msg');
		$data['error_msg'] = $this->session->flashdata('error_msg');

		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		
		$rnumber = $this->unique_id();

		$this->form_validation->set_rules('email', 'email', 'required|callback_check_add_email');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() === FALSE) {
				$this->load->library('facebook'); // Automatically picks appId and secret from config

				$user = $this->facebook->getUser();
		       
		        if ($user) {
		            try {
		                $data['user_profile'] = $this->facebook->api('/me');
		            } catch (FacebookApiException $e) {
		                $user = null;
		            }
		        }else {
		            // Solves first time login issue. (Issue: #10)
		            //$this->facebook->destroySession();
		        }

		        if ($user) {
		        	redirect(base_url().'home/facebook_redirect');
		        } else {
		            $data['login_url'] = $this->facebook->getLoginUrl(array(
		                'redirect_uri' => site_url('signup'), 
		                'scope' => array("email") // permissions here
		            ));
		        }

			$this->load->view('template/header', $data);
	        $this->load->view('home/signup', $data);
	        $this->load->view('template/footer', $data);
		}
		else{

			$this->user_model->signup_user();

			$get_user_data 		= $this->user_model->getuserid($this->input->post('email'));
			$data['uid']   		= $get_user_data['user_id'];
			$data['email'] 		= $this->input->post('email');	
			$data['act_code'] 	= $get_user_data['act_code'];		
			$act_url = $data['uid'];

			$data['en_url'] = 'home/activate_account/' . $act_url . '?cdo=' . $data['act_code'];
			$message = $this->load->view('home/email', $data, true);

			$this->load->config('mandrill');
			$this->load->library('mandrill');
			$mandrill_ready = NULL;

			try {

			    $this->mandrill->init( $this->load->config->item('mandrill_api_key') );
			    $mandrill_ready = TRUE;

			} catch(Mandrill_Exception $e) {

			    $mandrill_ready = FALSE;

			}

			if( $mandrill_ready ) {

			    //Send us some email!
			    $email = array(
			        'html' => $message, //Consider using a view file
			        'text' => '',
			        'subject' => 'Account Activation from SG Currency Rate',
			        'from_email' => 'noreply@sgcurrencyrate.com',
			        'from_name' => 'SG Currency Rate',
			        'to' => array(array('email' => $this->input->post('email'))) //Check documentation for more details on this one
			        //'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
			        );

			    $result = $this->mandrill->messages_send($email);

			}

			$this->session->set_flashdata('msg', 'Successfully Signup.The activation link has been sent to your email address');
			redirect(base_url().'home/signup');

		}
	}

	public function facebook_redirect(){
		$this->load->library('facebook');
		$user = $this->facebook->getUser();
		
 		if ($user) {
            try {
                $get_user = $this->facebook->api('/me?fields=id,name,email,verified');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }

		if (isset($get_user['verified'])||$get_user['id']=='') {

			// if($get_user['id'] != ''){
			if ($this->user_model->act_code_exist($get_user['id'])) {
				if ($this->user_model->facebook_login($get_user['id'])) {
             		redirect(base_url().'gen_img/');
				}
			}
			// else if($this->user_model->email_exist($get_user['email'])) {
			// 	if ($this->user_model->facebook_login_email($get_user['email'])) {
   //           		redirect(base_url().'gen_img/');
			// 	}
			// }
			else{
				$this->user_model->register_with_facebook($get_user['name'], $get_user['id']);
				if ($this->user_model->facebook_login($get_user['id'])) {
             		redirect(base_url().'gen_img/');
				}
			}
		}
	}

	public function check_add_email(){
		$email = $this->input->post('email');

        $result = $this->user_model->email_exist($email);
        if($result){
	        $this->form_validation->set_message('check_add_email', 'This email already exist');
	        return false;
        }
        return true;
	}

	//generate auto radom number with characher.length is 8. 
	//for user activate code
	public function unique_id($l = 8) 
	{
    	return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}

	public function send_message(){
		$email 	= $this->input->post('s_email');
		$mess   = $this->input->post('s_message');

		$fromname = 'Contact Us';
		$from = $email;
		$to   = 'info@generateyourprofile.com';
		$subject = 'Send Message via Contact Form';
	    $message  = '--------------------- Message ---------------------<br><br>';
	    $message .= $mess;
	    $message .= '<br><br>------------------------- End --------------------------<br><br>';
	    $message .= 'This message generated by system';
	    //send_email($fromname, $from, $to, $subject, $message);
		//echo 'success';

		$this->load->library( 'email' );

		$config = array (
                  'mailtype' => 'html',   
                  'charset'  => 'utf-8',
         );

		$this->email->initialize($config);
	   	$this->email->from( $from, $fromname );
	   	$this->email->to( $to );
	   	$this->email->subject( 'Send Message via Contact Form' );	   		
	   	$this->email->message($message);
	   	$this->email->send();

	    $ret = array(
	    	'status'	=> 'success',
	    );
		echo json_encode($ret);
	}

	// public function forgot_password(){
	// 	$email = $this->input->post('femail');
	// 	$check_e = $this->check_user_email($email);

	// 	if($check_e != '1'){
	// 		$ret = array(
	// 			'status'	=> 'fail',
	// 			'ret_msg'	=> 'Account does not exist!',
	// 			'rd_url'	=> '',
	// 		);
	// 	}
	// 	else{
	// 		$user = $this->user_model->getuserid($email);
	// 		$rand_pass = random_password();

	// 	    $fromname = 'SG CURRENCY RATE';
	// 	    $from     = 'no-replay@sgcurrencyrate.com';
	// 	    $to       =  $user['email'];
	// 	    $subject  = 'Password Reset from SG Currency Rate';
	//      	$message  = '--------------------- Notification ---------------------<br><br>';
	//       	$message .= 'Hi,<br><br>';
	//       	$message .= 'Here is your new password: '.$rand_pass.'<br><br>';
	//       	$message .= 'Regards,<br><br> Administrator <br><br>';
	//       	$message .= '------------------------- End --------------------------<br><br>';
	//       	$message .= 'This message generated by system, please do not reply.';

	// 		$this->load->library( 'email' );

	// 		$config = array (
	//                   'mailtype' => 'html',   
	//                   'charset'  => 'utf-8',
	//          );

	// 		$this->email->initialize($config);
	// 	   	$this->email->from( $from, $fromname );
	// 	   	$this->email->to( $to );
	// 	   	$this->email->subject( $subject );	   		
	// 	   	$this->email->message($message);
	// 	   	$this->email->send();

	// 	   	$update = $this->user_model->update_user_by_id($user['user_id'],$rand_pass);

	// 		$ret = array(
	// 			'status'	=> 'success',
	// 			'ret_msg'	=> 'Send password to email. Check your email',
	// 			'rd_url'	=> '',
	// 		);

	// 	}	

	// 	echo json_encode($ret);	
	// }

	// public function check_user_email($email) {
 //        $result = $this->user_model->email_exist($email);
 //        if($result){
 //        	return true;
 //        }
 //        else{
 //        	return 0;
 //        }
 //        return false;
	// }

	// public function activate_account($id){

	// 	$data['id'] = $id;
	// 	$act_code = $_GET['cdo'];

	// 	$get_user = $this->user_model->get_users($id);

	// 	if($get_user['is_activate'] == 0){

	// 		if($act_code == $get_user['act_code']){
	// 			$update = $this->user_model->activate_user_by_id($id);

	// 			$this->user_model->activate_login($get_user['email']);
	// 			$this->session->set_flashdata('msg', 'Account successfully Activated!');
	// 			redirect(base_url().'home/main');
	// 		}
	// 		else{
	// 			$this->session->set_flashdata('msg', 'Sorry, your activation process is fail!...');
	// 			redirect(base_url().'home/invalid_activate');
	// 		}

	// 	}
	// 	else{
	// 		$this->session->set_flashdata('msg', 'Your account is already activated!');
	// 		redirect(base_url().'home/invalid_activate');
	// 	}
	// 	//redirect(base_url().'home/activate_account/'.$id);

	// 	//
	// }

	// public function check_activate($act_code,$id){
	// 	$valid = $this->user_model->check_activate_code($act_code,$id);
	// 	if($valid == FALSE) {
	// 		$this->form_validation->set_message('check_activate','This Activation Code is invalid!');
	// 		return FALSE;			
	// 	}
	// 	else {
	// 		return TRUE;
	// 	}
	// }

	// public function captcha($str)
	// {
 //    	$captcha_info = $this->session->userdata('captcha_info');

 //    	if ($captcha_info['code'] != $str)
 //    	{
 //        	$this->form_validation->set_message('captcha', 'The %s was not input correctly. Please try again.');
 //        	return false;
 //    	}	
 //    	return true;
	// }

	// public function invalid_activate(){
	// 	$data['msg'] = $this->session->flashdata('msg');
	// 	$this->load->view('template/header');
	// 	$this->load->view('invalid_error',$data);
	// 	$this->load->view('template/footer');
	// }


}