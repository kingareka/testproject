<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {

  public function __construct(){
    
    parent::__construct();

    $this->load->library('session');
    $this->config->load('validations', TRUE);
  }

  public function login() {
  
    if ($this->session->userdata('loggedin')) {     
      redirect('/');
    }
    $notification = $this->session->userdata('notification');
    $login_notification = $this->session->userdata('login_notification');
    $this->session->unset_userdata('notification');
    $this->session->unset_userdata('login_notification');
    $data['notification'] = $notification;
    $data['login_notification'] = $login_notification;    
    $this->load->view('templates/header');
    $this->load->view('sessions/login', $data);
    $this->load->view('templates/footer');
  }

  public function authenticate() {   
    if ($this->session->userdata('loggedin')) {
      redirect('/');
    }

    $this->load->model('user_model', '', true);
    $this->load->library('form_validation'); 
    $config = $this->config->item('validations');
    $this->form_validation->set_rules($config['validations']['sessions']['authenticate']);


    if ($this->form_validation->run() === TRUE) {      
      $userdata = $this->input->post('user');     

      if ($user = $this->user_model->authenticate($userdata['username'], $userdata['password'])) {
        $this->session->set_userdata('loggedin', true);
        $this->session->set_userdata('loggedin_user', $user);
        
        redirect('/');
      } else {
        $this->session->set_userdata('login_notification', 'User/password incorrect. Please try again');
      }
    }
  
    $this->login();
  }

  public function logout() {
    
    $this->session->unset_userdata('loggedin');
    $this->session->unset_userdata('loggedin_user');

    redirect('/');
  }
}