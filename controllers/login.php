<?php
/**
 * 
 * basic login controller example
 * 
 */
class Login extends Controller {

	function __construct() {
		
		
		parent::__construct('login_model');	
		
		 $this->session=new Session();
		 $this->session->start();
	}
	
	function index( ) 
	{
		$token=$this->session->get('token');
		$this->viewLoader->render('login',array('token'=>$token) );
	}
	
	function runLogin()
	{
		$this->model->login($this->session);
	}
	function runLogout()
	{
		$this->model->logout($this->session);
	}

}
