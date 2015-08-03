<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('validations', TRUE);
	}

	public function set_password() {
		if ($this->session->userdata('loggedin')) {
			redirect('/');
		}
		$this->load->model(array('user_model'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$token = $this->input->get('token');
		$userid = 0;
		
		if ($token) {
			if ($userid = $this->user_model->by_token($token)) {				
				$this->session->set_userdata('temp_user_id', $userid);
			}
		}

		if (!$userid){
			$userid = $this->session->userdata('temp_user_id');
		
		}

		if ($userid) {
			  $config = $this->config->item('validations');
        $this->form_validation->set_rules($config['validations']['user']['set_password']);

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('sessions/set_password');
				$this->load->view('templates/footer');
			} else {
				//$rand_salt = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),5,10);
				$encrypt_pass = $this->input->post('password');
				$this->session->unset_userdata('temp_user_id');
				if ($this->user_model->set_password($userid->id, $encrypt_pass)) {
					//print $this->input->post('password');print $encrypt_pass;die();
					$this->session->set_userdata('notification', 'Your password is saved. You can log in now');
				} 
				
				redirect('sessions/login');
			}
		} else {
			
				if ($token) {
					if ($onlyuserid = $this->user_model->only_by_token($token)) {
						$this->session->set_userdata('temp_user_id', $onlyuserid);					
					}
				}
				
				if ($onlyuserid) {						
					$rand_key = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),5,10);     
		      $data['access_token'] = $rand_key; 
		      $data['access_token_expiration'] = now() + (60 * 60 * 168);
		      $this->user_model->update_token($onlyuserid,$data); 
		    
		      $this->load->library('email');
		      $this->email->initialize($config);
		      $this->email->from('hamarrr@yahoo.com', 'Test project');
		      $this->email->to($this->input->post('email')); 
		      $this->email->subject('User create');
		      $this->email->message('For password set please click here: ' . site_url() . '/user/set_password?token=' .$rand_key );  
		      $this->email->send();

					$this->load->view('templates/header');
					$this->load->view('sessions/set_password');
					$this->load->view('templates/footer');
		      $this->session->set_userdata('notification', 'A new email has been sent with a validation cod which is valid one month.');
		      redirect('sessions/login');
				}

			
			redirect('sessions/login');
		}
	}
	
	public function reset_password() {
		if ($this->session->userdata('loggedin')) {
			redirect('/');
		}
		$this->load->model(array('user_model'));
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$config = $this->config->item('validations');
        $this->form_validation->set_rules($config['validations']['user']['reset_password']);

			
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('sessions/reset_password');
			$this->load->view('templates/footer');
		} else {
			$rand_key = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),5,10);
			//print $rand_key;die(0);
			//print_r($this->input->post('email'));die();
			$this->user_model->set_key($this->input->post('email'), $rand_key);
			$this->session->set_userdata('notification', 'You will receive an email.');

			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->from('hamarrr@yahoo.com', 'Test new password');
			$this->email->to($this->input->post('email')); 
			$this->email->subject('Your new password');
			$this->email->message('For password reset please click here: ' . site_url() . '/user/set_password?token=' .$rand_key );  
			$this->email->send();

			redirect('sessions/login');
		}
	}

	public function email_exists($email) {
		$user = $this->user_model->by_email($email, true);		
		if ($user)
			return true;
		else {
			$this->form_validation->set_message('email_exists', 'This email address is not a valid email address.');
			return false;
		}
	}
}