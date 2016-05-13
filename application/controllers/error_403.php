<?php
class error_403 extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->view('template/header');
		$this->load->view('my403');
		$this->load->view('template/footer');
	}

}