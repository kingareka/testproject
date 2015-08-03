<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validations'] = array(
  "sessions"=> array(
               "authenticate" => array(
                                  array(
                                    'field'   => 'user_email', 
                                    'label'   => 'Email', 
                                    'rules'   => 'trim|xss_clean'
                                  ),
                                  array(
                                    'field'   => 'user_password', 
                                    'label'   => 'Password', 
                                    'rules'   => 'trim|md5'
                                  )
                                )

              ),
  "user"=> array(
            "set_password" => array(
                              array(
                                  'field'   => 'password', 
                                  'label'   => 'Parola', 
                                  'rules'   => 'trim|required|min_length[5]|matches[passconf]|md5|callback_password_check'
                              ),
                              array(
                                  'field'   => 'passconf', 
                                  'label'   => 'Confirmare Parola', 
                                  'rules'   => 'trim|required'
                              )
                            ),

            "reset_password" => array(
                                  array(
                                      'field'   => 'email', 
                                      'label'   => 'Email', 
                                      'rules'   => 'trim|xss_clean|valid_email|callback_email_exists'
                                  )
                                ),
            "edit_user"     => array(
                                  // array(
                                  //     'field'   => 'edit_username', 
                                  //     'label'   => 'Username', 
                                  //     'rules'   => 'trim|xss_clean'
                                  //     // 'rules'   => 'trim|xss_clean|is_unique[users.username]'
                                  //   ),
                                  array(
                                      'field'   => 'edit_name', 
                                      'label'   => 'Name', 
                                      'rules'   => 'trim|xss_clean|required'
                                    ),
                                  array(
                                      'field'   => 'edit_email', 
                                      'label'   => 'Email', 
                                      'rules'   => 'trim|xss_clean|valid_email|required'
                                    ),
                                   array(
                                      'field'   => 'edit_role', 
                                      'label'   => 'Role', 
                                      'rules'   => 'trim|xss_clean|required'
                                    ),
                                  array(
                                      'field'   => 'edit_phone', 
                                      'label'   => 'Phone', 
                                      'rules'   => 'trim|xss_clean|numeric|required'
                                    ),
                                  array(
                                      'field'   => 'edit_description', 
                                      'label'   => 'Description', 
                                      'rules'   => 'trim|xss_clean|required'
                                    )
              ),
            "create_user"     => array(
                                  array(
                                      'field'   => 'create_username', 
                                      'label'   => 'Username', 
                                      'rules'   => 'trim|xss_clean|is_unique[users.username]|required'
                                    ),
                                  array(
                                      'field'   => 'create_password', 
                                      'label'   => 'Parola', 
                                      //'rules'   => 'trim|required|min_length[5]|matches[create_passconf]|md5'
                                      'rules'   => 'trim|required|min_length[5]|matches[create_passconf]|callback_password_check'
                                    ),
                                  array(
                                      'field'   => 'create_passconf', 
                                      'label'   => 'Confirmare Parola', 
                                      'rules'   => 'trim|required'
                                   ),
                                   array(
                                      'field'   => 'create_role', 
                                      'label'   => 'Role', 
                                      'rules'   => 'trim|xss_clean|required'
                                    ),
                                  array(
                                      'field'   => 'create_name', 
                                      'label'   => 'Name', 
                                      'rules'   => 'trim|xss_clean|required'
                                    ),
                                  array(
                                      'field'   => 'create_email', 
                                      'label'   => 'Email', 
                                      'rules'   => 'trim|xss_clean|valid_email|required'
                                    ),
                                  array(
                                      'field'   => 'create_phone', 
                                      'label'   => 'Phone', 
                                      'rules'   => 'trim|xss_clean|numeric|required'
                                    ),
                                  array(
                                      'field'   => 'create_description', 
                                      'label'   => 'Description', 
                                      'rules'   => 'trim|xss_clean|required'
                                    )
              ),
            "edit_myuser"     => array(
                                  // array(
                                  //     'field'   => 'edit_username', 
                                  //     'label'   => 'Username', 
                                  //     'rules'   => 'trim|xss_clean'
                                  //     // 'rules'   => 'trim|xss_clean|is_unique[users.username]'
                                  //   ),
                                  array(
                                      'field'   => 'edit_myname', 
                                      'label'   => 'Name', 
                                      'rules'   => 'trim|xss_clean|required'
                                    ),
                                  array(
                                      'field'   => 'edit_myemail', 
                                      'label'   => 'Email', 
                                      'rules'   => 'trim|xss_clean|valid_email|required'
                                    ),
                                  array(
                                      'field'   => 'edit_myphone', 
                                      'label'   => 'Phone', 
                                      'rules'   => 'trim|xss_clean|numeric|required'
                                    ),
                                  array(
                                      'field'   => 'edit_mydescription', 
                                      'label'   => 'Description', 
                                      'rules'   => 'trim|xss_clean|required'
                                    )
              )
            )
	);