<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class settings extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->library('encrypt');
		if( $this->session->userdata('validate_user') ) {
			//redirect('/order');
		}	
	}

	//terms_list
	public function index(){
		echo 'here';
	}


	public function upload_to_facebook($uid){
		$this->load->library('facebook'); 
		$this->facebook->setFileUploadSupport(true);
		$message = 'Generate profile via generateyourprofile.com';
		//$file = "@".realpath('uploads/'.$uid.'.jpg');  
		$file = new CURLFile('uploads/'.$uid.'.jpg', 'image/jpeg');
    	$data = $this->facebook->api('/me/photos', 'POST', array(
      		'message' => $message,
      		'source' => $file,
   	 	));
    	print_out($data);
    	exit;

		//upload photo
		// $file= 'uploads/'.$uid.'.jpg';
		// $args = array(
		//    'message' => 'Generate profile via generateyourprofile.com',
		// );
		// $args[basename($file)] = '@' . realpath($file);
		// $ch = curl_init();
		// $url = 'http://graph.facebook.com/'.$album_id.'/photos?access_token='.$access_token;
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_HEADER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		// $data = curl_exec($ch);
		// //returns the photo id
		// print_r(json_decode($data,true));

	}

}