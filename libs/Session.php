<?php

/**
 * very basic session wrapper
 * 
 * */
class Session {

       public function start() {
        session_start();
   
        if (!isset($_SESSION['user_agent'])) {
			
			/* save the user agent to add a bit of security */
            $_SESSION['user_agent'] = md5($_SERVER['HTTP_USER_AGENT'] . SESSION_SALT);
			
			/* set a token if needed to secure forms */
            $token = md5(uniqid(rand(), TRUE));
            $_SESSION['token'] = $token;

            return true;
        } else {

            if ($_SESSION['user_agent'] != md5($_SERVER['HTTP_USER_AGENT'] . SESSION_SALT)) {
                session_destroy();
                return false;
            }
        }
    }


    public function checkToken($var) {
        if (isset($_SESSION['token']) && $var == $_SESSION['token']){ 
			return true;
    } else {
        return false;
    }
}

public function set($key, $value) {
    $_SESSION[$key] = $value;
}

public function get($key) {
    if (isset($_SESSION[$key])){
        return $_SESSION[$key];
        }
}

public function regenerate() {
    session_regenerate_id();
}

public function destroy() {
    session_unset();
    session_destroy();
}

}
