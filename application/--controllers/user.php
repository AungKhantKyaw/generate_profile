<?php
class user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('admin_login_model');
		$this->load->library('session');
		$this->load->library("pagination");
		
	}

	public function index()
	{	
		is_login();
		//For Create and Update Message...
		$data['msg'] = $this->session->flashdata('msg');
		//Load All users
		$b_url = base_url().'user/index';
		$t_rows = $this->user_model->search_record_count();
		$config = create_pagination_config( $b_url, $t_rows, 50, 3 );
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['links'] = $this->pagination->create_links();
		$data['currentPage'] =  floor(($this->uri->segment(3)/$config['per_page']) + 1);
		$data['totalRows'] =  $t_rows;
		$data['perPage'] = $config['per_page'];
		$data['users'] = $this->user_model->search_fetch_user($config['per_page'], $page);
		$data['pagination_msg'] = create_pagination_msg($data['currentPage'], $config['per_page'], $t_rows);

		$this->load->view('template/admin_header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('template/admin_footer', $data);
	}

	public function create() {
		is_login();
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['roles'] = $this->role_model->get_roles();

		$this->form_validation->set_rules('username', 'username', 'required|callback_check_add_username');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('role_id', 'role', 'required');

		if($this->form_validation->run() === FALSE) {
			$data['action'] = 'new';
			$this->breadcrumb->append_crumb('User List', 'index/');
			$this->breadcrumb->append_crumb('Add User', '/');
			$this->load->view('template/admin_header', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('template/admin_footer', $data);
		}
		else{
			$this->user_model->add_user();
			$this->session->set_flashdata('msg', 'User Successfully Created');
			redirect(base_url().'user');
		}


	}

	public function check_add_username(){
		$username = $this->input->post('username');

        $result = $this->user_model->username_exist($username);
        if($result){
	        $this->form_validation->set_message('check_add_username', 'This username already exist');
	        return false;
        }
        return true;
	}

	public function edit($id) {
		is_login();
		$data['user'] = $this->user_model->get_users($id);

		if (empty($data['user'])) {
			show_404();
		}
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'email', 'required|callback_check_edit_username['.$id.']');	

		if($this->form_validation->run() === FALSE) {
			$data['action'] = 'edit';
			$this->load->view('template/admin_header', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('template/admin_footer', $data);	
		} 
		else {
			$this->user_model->update_user($id);
			$this->session->set_flashdata('msg', 'User Successfully Updated');
			redirect(base_url().'user');
		}
	}

	public function delete($id) {
		$this->user_model->delete_user($id);	
		$this->session->set_flashdata('msg', 'User Successfully Deleted');
		redirect(base_url().'user');
	}

///////////////////// PUBLIC USER //////////////////////////////////
	public function profile($id) {
		$data['user'] = $this->user_model->get_users($id);
		$data['msg'] = $this->session->flashdata('msg');
		
		if (empty($data['user'])) {
			show_404();
		}

		if($this->session->userdata('sgcurrency_user_id') != $data['user']['user_id']){
			redirect(base_url().'error_403');
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'password', 'required');	

		if($this->form_validation->run() === FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('user/profile_update', $data);
			$this->load->view('template/footer', $data);	
		} 
		else {
			$this->user_model->change_user_password($id);
			$this->session->set_flashdata('msg', 'Profile Successfully Updated');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}	
///////////////////// SYSTEM USER //////////////////////////////////
	public function system_user(){
		is_login();
		//For Create and Update Message...
		$data['msg'] = $this->session->flashdata('msg');

		//Load All categorys
		$b_url = base_url().'user/system_user';
		$t_rows = $this->admin_login_model->search_record_count();
		$config = create_pagination_config( $b_url, $t_rows, 50, 3 );
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['links'] = $this->pagination->create_links();
		$data['currentPage'] =  floor(($this->uri->segment(3)/$config['per_page']) + 1);
		$data['pagination_msg'] = create_pagination_msg($data['currentPage'], $config['per_page'], $t_rows);
		$data['totalRows'] =  $t_rows;
		$data['perPage'] = $config['per_page'];
		$data['system_users'] = $this->admin_login_model->search_fetch_systemuser($config['per_page'], $page);
		
		$this->load->view('template/admin_header', $data);
		$this->load->view('user/system_user_list', $data);
		$this->load->view('template/admin_footer', $data);		
	}

	public function system_user_create(){
		is_login();
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required');
		$this->form_validation->set_rules('password', 'Admin Password', 'required');

		if($this->form_validation->run() === FALSE) {
			$data['action'] = 'new';
			$this->load->view('template/admin_header', $data);
			$this->load->view('user/system_user_edit', $data);
			$this->load->view('template/admin_footer', $data);
		}
		else{
			$this->admin_login_model->add_sys_user();
			$this->session->set_flashdata('msg', 'System User Successfully Created');
			redirect(base_url().'user/system_user');
		}
	}

	public function system_user_edit($id) {
		is_login();
		$data['sys_user'] = $this->admin_login_model->get_users($id);
		
		if (empty($data['sys_user'])) {
			show_404();
		}
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required');

		if($this->form_validation->run() === FALSE) {
			$data['action'] = 'edit';
			$this->load->view('template/admin_header', $data);
			$this->load->view('user/system_user_edit', $data);
			$this->load->view('template/admin_footer', $data);
		} 
		else {
			$this->admin_login_model->update_sys_user($id);
			$this->session->set_flashdata('msg', 'User Successfully Updated');
			redirect(base_url().'user/system_user');
		}
	}

	public function delete_sys_user($id) {
		$this->admin_login_model->delete_sys_user($id);	
		$this->session->set_flashdata('msg', 'User Successfully Deleted');
		redirect(base_url().'user/system_user');
	}
}