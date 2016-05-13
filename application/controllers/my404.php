<?php
class my404 extends CI_Controller {

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

	public function my404() {
		$this->load->view('template/header');
		$this->load->view('my404');
		$this->load->view('template/footer');
	}
}