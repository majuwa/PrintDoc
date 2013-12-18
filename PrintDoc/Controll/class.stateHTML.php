<?php
#------------------------
#includes:
require_once 'class.outControll.php';
require_once 'class.contentTemplate.php';
require_once 'class.loginTemplate.php';
require_once 'class.page.php';
require_once 'class.contentTemplate.php';
require_once '/var/www/printer/Model/class.user.php';
require_once '/var/www/printer/View/class.navigation.php';
require_once '/var/www/printer/View/class.html.output.php';
require_once 'View/class.content.php';
#------------------------
class StateHTML extends outControll {
	public function getOutput($state, $arrayContent, $file) {

		$template;
		$warning;
		switch ($state) {
			case 'login' :
				try {
					if (isset($arrayContent["user"]) && isset($arrayContent["pwd"])) {
						$user = new User($arrayContent["user"], $arrayContent["pwd"]);
						if ($user) {
							$template = new ContentTemplate();
							$state = "home";
							break;
						} else {
							$template = new LoginTemplate();
							break;
						}
					}
				} catch(UserException $e) {
					$warning = "Wrong Username or password";
					$template = new LoginTemplate();
					break;
				}
			case 'print' :
				$user = $_SESSION["username"];
				$jobs = DatabaseConnection::instance() -> getPrintjobs($user);
				for ($i = 0; $i < count($jobs); $i++) {
					$printers = shell_exec("lp -d " . $jobs[$i] -> getPrinter() . " " . $jobs[$i] -> getFilename());
					//echo "lp -d " . $jobs[$i] -> getPrinter() . " " . $jobs[$i] -> getFilename();
					//die();
					sleep(1);
				}
				for ($i = 0; $i < count($jobs); $i++) {
					unlink($jobs[$i] -> getFilename());
				}
				$jobs = DatabaseConnection::instance() -> deletePrintjobs($user);
				$warning = '<div class="alert alert-success">All Files printed</div>';
				$template = new ContentTemplate();
				$state = "home";
				break;
			case 'upload' :
				if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
					$uploaddir = '/var/www/printer/uploads/';
					$uploadfile = $uploaddir . basename($file['fileupload']['name']);

					if (move_uploaded_file($file['fileupload']['tmp_name'], $uploadfile)) {
						$user = $_SESSION["username"];
						$filename = $uploadfile;
						$printer = $arrayContent["printer"];
						DatabaseConnection::instance() -> insertPrintjobs($user, $filename, $printer);
					}

				}

			default :
				if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
					$template = new ContentTemplate();
					$state = "home";
				} else{
					$template = new LoginTemplate();
					$state = 'login';
				}
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
			$content = $this -> getContent($state);
			$mainPage -> setContent($content);
			$mainPage -> setNav($this -> getNav($state));
			echo $mainPage -> showPage();
		}

	}

	private function getMeta() {
		return "";
	}

	private function getTitle($state) {
		switch ($state) {
			case 'login' :
				return "Login";
			case 'home' :
				return "Print Jobs";
			case 'about' :
				return "About";
			case 'settings' :
				return "Settings";
			default :
				break;
		}
	}

	private function getContent($state) {
		switch ($state) {
			case 'login' :
				return "";
			case 'home' :
				$back = new Content();
				return $back -> getPrintContent($_SESSION["username"]);

			default :
				break;
		}
	}

	private function getNav($state) {
		$navi = new NavigationTemplate();
		return $navi -> getTemplate($state);
	}

}
?>