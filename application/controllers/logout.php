<?php
class logout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
	}

	public function index() {
		$this->load->library('facebook');
		$this->session->sess_destroy();	
		$this->facebook->destroySession();
		delete_cookie('ci_session'); 
		redirect(base_url());
	}

}