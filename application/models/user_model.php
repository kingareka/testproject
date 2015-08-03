<?php

class User_Model extends CI_Model
{
  public function authenticate($username, $password) {
    //print $password;
    
   $row = $this->db->select('*')->get_where('users', array('username' => $username, 'disabled' => 0))->row();
    if ($row) {
     // $salt = $row->salt;

      //if ($salt) {
          // hash password with salt and find user

         // $hash = md5($password);

          $user = $this->db->select('*')->get_where('users', array(
            'username' => $username,
            'password' => md5($password),
            'active' => 1
           
          ))->row();
          //print $this->db->last_query(); die();
          return $user;
      }
  //  }

    return false;
  }



  public function form_create($data) {
    //$this->load->helper('date');
    //$exp_token = now() + (60 * 60 * 168);
    $data = array(
      'username' => $data['username'],
      'email' => $data['email'],
      'name' => $data['name'],
      'role' => $data['role'],
      'age' => $data['age'],
      'phone' => $data['phone'],
      'password' => $data['password'],
      'description' => $data['description']//,
      //'access_token' => '',
      //'access_token_expiration' => date("Y-m-d H:i:s", $exp_token)
    );

    return $this->db->insert('users', $data);
  }

  public function set_key($email, $token) {
    $this->load->helper('date');
    $exp_token = now() + (60 * 60 * 168);
    $data = array(
      'password' => '',
      'access_token' => $token,
      'access_token_expiration' => date("Y-m-d H:i:s", $exp_token)
    );
    return $this->db->update('users', $data, array('email' => $email));
  }

  public function by_token($token) {
    if ($token) {
      $this->load->helper('date');
      $user = $this->db->select('id')->get_where('users', array(
        'access_token' => $token,
        'access_token_expiration >' => date("Y-m-d H:i:s", now()),
        'disabled' => 0
      ))->row();

      return $user;
    }

    return false;
  }

  public function only_by_token($token) {
    if ($token) {
      $this->load->helper('date');
      $user = $this->db->select('id')->get_where('users', array(
        'access_token' => $token,
        'disabled' => 0
      ))->row();

      return $user;
    }

    return false;
  }

  // public function by_id($id) {
  //   if ($id) {
  //     $user = $this->db->select('id, name, email, role')->get_where('users', array(
  //         'id' => $id
  //     ))->row();

  //     return $user;
  //   }

  //   return false;
  // }

  public function by_email($email, $deactivated = false) {   
    if ($email) {
      $filters = array(
        'email' => $email
      );
      if ($deactivated){       
        $filters['disabled'] = 0;
      }
      //print_r($filters);
      $user = $this->db->select('id')->get_where('users', $filters)->row();
      //print $this->db->last_query(); print_r( $user);die();
      return $user;
    }
    return false;
  }

  public function set_password($userid, $encrypt_pass) {
    //print $encrypt_pass;die();
    if ($userid && $encrypt_pass) {
      if ($this->by_id($userid)) {
        $data = array(  //         
          'password' => $encrypt_pass,
          'access_token' => '',
          'access_token_expiration' => '',
          'active' => 1
        );
      
        $this->db->where('id', $userid);
        return $this->db->update('users', $data);
      }
    }

    return false;
  }

  public function get_users() {
    $this->db->select('users.id, users.name, users.username, users.phone, users.email, users.role, users.description, user_type.name as role');
    $this->db->from('users');
    $this->db->join('user_type', 'user_type.id = users.role');
    $this->db->join('user_agecat', 'user_agecat.id = users.age', 'left');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_agecat(){

    $agecat = $this->db->get("user_agecat");
    return $agecat->result_array();    
  }

  public function delete_user($id) {
    if (is_numeric($id)) {
      return $this->db->delete('users', array('id' => $id));
    }

    return false;
  }

  // public function update($id, $data) {
  //   if (is_numeric($id)) {
  //     return $this->db->update('users', $data, array('id' => $id));
  //   }

  //   return false;
  // }

   public function update_token($id, $data) {
   // print_r ($data); print "qqqqqq";die();
     $this->load->helper('date');
     $this_data = array(
      'access_token' => $data['access_token'],
      'access_token_expiration' => date("Y-m-d H:i:s", $data['access_token_expiration'])
    );
     //print ($id->id);print_r($this_data);
    if (is_numeric($id->id)) {
      return $this->db->update('users', $this_data, array('id' => $id->id));
    }

    return false;
  }

  public function by_role($role) {
    $query = $this->db->where('role', $role)->where('disabled', 0)->where('active',1)->get('users');
    return $query->result_array();
  }

  public function by_id($id) {
    //$id = $this->input->post('id');   
    if ($id) {
      $user['list'] = $this->db->select('*')->get_where('users', array('id' => $id))->row();
    }    
    return $user;     
  }

  public function form_update($data, $id){
   if($id){
      $this->db->where('id', $id);
      $this->db->update('users', $data);  
    } 
    return false;
  }

  public function usersearch($search ) {
   
    if ($search != ''){
      $this->db->where('username like', "%$search%");
      $this->db->or_where('description like', "%$search%"); 
    }      
    $query = $this->db->get("users");
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return array();
 }

  
}