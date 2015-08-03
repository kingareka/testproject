<?php

class MY_Controller extends CI_Controller {
	public $current_user;

    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->config->load('permissions', TRUE);       
        $this->config->load('validations', TRUE);

        if (!$this->session->userdata('loggedin')) {
          redirect('sessions/login');
        }
       
        if (!user_has_permission($this->session->userdata('loggedin_user'), $this->router->class, $this->router->method)) {
        	redirect('/');
        	// show_error('Nu poti accesa pagina');
        }

        $this->current_user = $this->session->userdata('loggedin_user');
    }
}