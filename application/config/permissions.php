<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['user_roles'] = array (
	'admin' => array('name' => 'Admin',
										'label' => 'label-default',
										'permissions' => array( 
													'users' => 'index,getuser,edit,createuser,create,search'
										)
							),
	'user' => array('name' => 'User',
									'label' => 'label-danger',
									'permissions' => array(
												'users' => 'index,editmyuser,myedit'										
									)
						)
	);
