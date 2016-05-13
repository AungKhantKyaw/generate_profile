<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class facebooklogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
        $this->load->library('facebook');
		//$this->load->model('post_config_model');
	}
	
	public function index()
	{

		$user = $this->facebook->getUser();

        if ($user) {
            try {
                $u_pro = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if (isset($u_pro['verified'])&&$u_pro['verified']==1) {
            if ($this->user_model->email_exist($u_pro['email'])) {
                if ($this->user_model->facebook_login($u_pro['email'])) {
                    redirect(base_url());
                    
                }
            }
            else{
                //$free_post_amt = $this->post_config_model->get(1);
                $this->user_model->register_with_facebook($u_pro['name'], $u_pro['email']);
                if ($this->user_model->facebook_login($u_pro['email'])) {
                    redirect(base_url());
                    
                }
            }
        }

        else {
            $ok_url = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('home/signup'), 
                'scope' => array("email,publish_actions") // permissions here
            ));
            
        }

        redirect($ok_url);

	}

	public function facebook_login(){

		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,name,email,verified,publish_actions');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('home'), 
                'scope' => array("email,name,id,publish_actions") // permissions here
            ));
        }
        //$this->load->view('home/signup',$data);

	}

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('<?=base_url()?>');
    }
}
