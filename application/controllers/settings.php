<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('user_model');
		$this->load->library('session');
		$this->load->library('breadcrumb');		
	}

	//terms_list
	public function index(){
		//For Create and Update Message...
		$data['msg'] = $this->session->flashdata('msg');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_password', 'old Password', 'required|callback_check_old_password');
		$this->form_validation->set_rules('new_password', 'new Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'confirm Password', 'required|callback_check_confirm_password');
		if($this->form_validation->run() === FALSE) {
			$data['action'] = 'change';
			$this->breadcrumb->append_crumb('Change Password', '/');
			$this->load->view('template/header', $data);
			$this->load->view('settings/index', $data);
			$this->load->view('template/footer', $data);
		}
		else{
			$user_id  = $this->session->userdata('user_id');
			$this->user_model->change_password($user_id);
			$this->session->set_flashdata('msg', 'New Password Successfully Created');
			redirect(base_url().'settings/index');
		}
	}
	public function check_old_password(){
		$user_id  = $this->session->userdata('user_id');
	
        $old_password = $this->security->xss_clean($this->input->post('old_password'));

        $result = $this->user_model->check_old_password($user_id, $old_password);
        if($result){
        	return true;
        }
        $this->form_validation->set_message('check_old_password', 'Invalid old password');
        return false;
	}
	public function check_confirm_password(){
		$new_password = $this->security->xss_clean($this->input->post('new_password'));
		$confirm_password = $this->security->xss_clean($this->input->post('confirm_password'));

		if ($new_password == $confirm_password) {
			return true;
		}
		$this->form_validation->set_message('check_confirm_password', 'Your new password and confirm password do not match.');
        return false;
	}

}