<?php
#------------------------
#includes:
require_once 'class.outControll.php';
require_once 'class.contentTemplate.php';
require_once 'class.loginTemplate.php';
require_once 'class.page.php';
require_once 'class.contentTemplate.php';
require_once '/var/www/printer/Model/class.user.php';
#------------------------
class StateHTML extends outControll {
	public function getOutput($state, $arrayContent) {
		$template;
		$warning;
		switch ($state) {
			case 'home' :
				$template = new contentTemplate();
				break;
			case 'login' :
				try {
					$user = new User($arrayContent["user"], $arrayContent["pwd"]);
				} catch(UserException $e) {
					$warning = "Wrong Username or password";
				}
			default :
				$template = new LoginTemplate();
				break;
		}
		$page = $template -> getTemplate();
		$mainPage = new Page($page);
		$mainPage -> setMeta($this -> getMeta());
		$mainPage -> setTitle($this -> getTitle($state));
		if (!empty($warning)) {
			$mainPage -> setWarning($warning);
		} else {
			$mainPage -> setWarning("");
		}
		if ($state == 'login') {
			echo $mainPage -> showPage();
		} else {
			$mainPage -> setContent($arrayContent["content"]);
			$mainPage -> setNav($this -> getNav($state));
			echo $mainPage -> showPage();
		}

	}

	private function getMeta() {
		return "";
	}

	private function getTitle($state) {
		return "Login";
	}

	private function getNav($state) {
		return "";
	}

}
?>