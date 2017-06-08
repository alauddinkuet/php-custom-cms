<?php
/**
 *
 * Very basic example of login model
 *
 * TODO security and error management!  
 * 
 */
class Login_Model extends Model {
	public function __construct() {
		parent::__construct();
		
	}

	public function login(Session $session) {
 
		$userName = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$passw = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS); 
		
		if(!$session->checkToken($_POST['token'])){
			throw new Exception('Invalid token');
			}
		 
		$passw = hash('sha256', $passw);

		$user = $this -> db -> fetchSingle("SELECT id, level FROM users WHERE 
				username = :username AND password = :password", array(':username' => $userName, ':password' => $passw));
		 
		if ( !empty($user) ) {

			$session->start();
			$session->set('username', $userName);
			$session->set('level', $user['level']);
			$session->set('loggedIn', true);
			$sessionId = session_id();
			$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId=$sessionId WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));
		
			header('location:' . BASEPATH . DEFAULTCONTROLLER);

		} else {
			header('location:' . BASEPATH . 'login');
		}

	}

	function logout(Session $session) {
		$session->start();
		$session->set('loggedIn', false);
		$session->set('user', null);
		$session->set('level', null);
		$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId='' WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));

		$session->destroy();
		header('location:' . BASEPATH);
	}

}
