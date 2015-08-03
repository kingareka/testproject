<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

if (!function_exists('role_name')) {
  function role_name($slug) {
    $CI = & get_instance();

    $roles = $CI->config->item('permissions');

    if(isset($roles['user_roles'][$slug])) {
      return $roles['user_roles'][$slug]['name'];
    }

    return $roles['user_roles']['default']['name'];
  }
}

if (!function_exists('role_label')) {
  function role_label($slug) {
    $CI = & get_instance();

    $roles = $CI->config->item('permissions');

    if(isset($roles['user_roles'][$slug])) {
      return $roles['user_roles'][$slug]['label'];
    }

    return $roles['user_roles']['default']['label'];
  }
}

if (!function_exists('role_options')) {
  function role_options() {
    $CI = & get_instance();

    $roles = $CI->config->item('permissions');

    $options = array();

    foreach ($roles['user_roles'] as $role => $value) {
      $options[$role] = $value['name'];
    }

    return $options;
  }
}

if (!function_exists('user_has_permission')) {   
  function user_has_permission($user, $controller, $method) {
    
    $CI = & get_instance();   
    if ($CI->session->userdata('loggedin')) { 
      $role = $user->role;
      if($role==1)$role='admin';
      if($role==2)$role='user';     
      $permissions = $CI->config->item('permissions');
      $user_permissions = $permissions['user_roles'][$role]['permissions'];
      if (isset($user_permissions[$controller])) {
        $keys = explode(',', $user_permissions[$controller]);
        if (in_array($method, $keys))
          return true;
      }

      if ($controller == 'users' && $method == 'edit') {
        if ($CI->router->uri->segments[3] == $user->id)
          return true;
      }
    }

    return false;
  }
}