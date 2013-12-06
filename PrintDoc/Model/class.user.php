<?php
require_once 'Database/database.php';
class UserException extends  Exception {

}

/**
 *
 */
class User {
	private $user;
	private $pwd;
	function __construct($user, $pwd) {
		$this -> user = $user;
		$this -> pwd = $pwd;
		if (!($this -> login())){
			throw new UserException("Error User Data Wrong", 1);
		}
		else
			$_SESSION["login"] = true;
	}

	private function login() {
		return DatabaseConnection::instance() -> login($this -> user, $this -> pwd);
	}

}
?>