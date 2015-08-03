<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index() {
   
    $notification = $this->session->userdata('notification');
    $this->session->unset_userdata('notification');
    $data['users'] = $this->user_model->get_users();   
    $data['notification'] = $notification;

    if($this->input->post('search')){
      $search = $this->input->post('search');      
      $data['users'] = $this->user_model-> usersearch($search);
      $data['search'] = $search;
    }
      //print "aaa";
      $this->load->view('templates/header');
      $this->load->view('users/index', $data);
      $this->load->view('templates/footer');
   
  }


  public function getuser(){
    
    $id = $this->input->post('id');
    $data['user'] = $this->user_model->by_id($id);
    $data['agecat'] = $this->user_model->get_agecat();
    $this->load->view('users/edit_user', $data);  
  }
  
  public function edit() {   
   
    $id = $this->input->post('id');   
    $username = $this->input->post('edit_username');
    $type = $this->input->post('edit_role');    
      if($type=="admin") $mytype =1;
      if($type=="user") $mytype =2;
    $name = $this->input->post('edit_name');
    $email = $this->input->post('edit_email');
    $age = $this->input->post('edit_cat');
    $phone = $this->input->post('edit_phone');
    $description = $this->input->post('edit_description');  
      
    
    $this->load->helper('security');
    $this->load->library('form_validation');

    $config = $this->config->item('validations');
    $this->form_validation->set_rules($config['validations']['user']['edit_user']);
    $result = array();  
    if ($this->input->is_ajax_request()) {  
      if ($this->form_validation->run() === FALSE) {
        $result['error'] = true;  
        $result['message'] = validation_errors();
      }
      else{
        $result['error'] = false;  
        $data = array(
          'username' => $username,
          'role' => $mytype,
          'name' => $name,
          'email' => $email,
          'age' => $age,
          'phone' => $phone,
          'description' => $description,        
        );
        $result['message'] = 'Date salvate';       
        $this->user_model->form_update($data,$id);         
      }
      $json = json_encode($result);  
      die($json); 
    }
    else {  
      redirect('users/index', 'refresh');     
    } 
  }

  public function createuser(){

    $data['agecat'] = $this->user_model->get_agecat();
    $this->load->view('users/create_user', $data); 
  }
    
  public function create() {
    $username = $this->input->post('create_username');
    $type = $this->input->post('create_role');       
      if($type=="admin") $mytype = 1;
      if($type=="user") $mytype = 2;
    $name = $this->input->post('create_name');
    $email = $this->input->post('create_email');
    $phone = $this->input->post('create_phone');
    $agecat = $this->input->post('create_cat');
    $description = $this->input->post('create_description');
    $password = $this->input->post('create_password');
    
    $this->load->helper('security');
    $this->load->library('form_validation');

    $config = $this->config->item('validations');
    $this->form_validation->set_rules($config['validations']['user']['create_user']);
   ;
    if ($this->input->is_ajax_request()) {  
      if ($this->form_validation->run() === FALSE) {
        $result['error'] = true;  
        $result['message'] = validation_errors();
      }
      else{
        $result['error'] = false;  
        $data = array(
          'username' => $username,
          'role' => $mytype,
          'password' => md5($password),
          'name' => $name,
          'email' => $email,
          'age' => $agecat,
          'phone' => $phone,
          'description' => $description,        
        );       
        $result['message'] = 'Date salvate';       
        $this->user_model->form_create($data); 
      }
      $json = json_encode($result);  
      die($json); 
    }
    else {       
      redirect('users/index', 'refresh');      
    } 
  }


  public function editmyuser($id){    
   
    $data['user'] = $this->user_model->by_id($id);

    $this->load->view('templates/header');
    $this->load->view('users/edit_myuser', $data);  
    $this->load->view('templates/footer');
  }

  public function myedit($id){
            
    $this->load->helper('security');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    $data['user'] = $this->user_model->by_id($id);
    if($data['user']) {

      $config = $this->config->item('validations');
      $this->form_validation->set_rules($config['validations']['user']['edit_myuser']);

      if ($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header');
        $this->load->view('users/edit_myuser', $data);
        $this->load->view('templates/footer');
      }
      else{      
        $type = $this->input->post('edit_myrole');       
          if($type=="admin") $mytype = 1;
          if($type=="user") $mytype = 2;
       
        $data = array(         
          'role' => $mytype,
          'name' =>  $this->input->post('edit_myname'),
          'email' => $this->input->post('edit_myemail'),
          'phone' => $this->input->post('edit_myphone'),
          'description' => $this->input->post('edit_mydescription'),        
        );
        $this->user_model->form_update($data,$id); 
        $this->session->set_userdata('notification', 'User had been modified.');
        redirect('users');
      } 
    } 
  }  
  
  public function password_check($password) {
    ///print $password;
    $error='';
    if( !preg_match("#[0-9]+#", $password) ||  !preg_match("#\W+#", $password)) {
      $error .= "Password must include at least one number or at least one symbol!";
    }
    if( !preg_match("#[a-z]+#", $password) ) {
      $error .= "Password must include at least one letter!";
    }
    if( !preg_match("#[A-Z]+#", $password) ) {
      $error .= "Password must include at least one CAPS!";
    }
    if($error){
      $this->form_validation->set_message('password_check', 'Password validation failure.'.$error);
      return false;      
    } 
    else {
      return true;
    }




 
  

 
}
}