<?PHP
require_once 'class.template.php';
class NavigationTemplate extends Template {
	protected $url = "/var/www/printer/View/html/Files/navigation.php";
	public function getTemplate($state = "test") {

		$file = parent::getTemplate();
		if(isset($file)){
			switch ($state) {
				case 'about' :
					$file = str_replace("[%ACTIVE-PRINT%]", "", $file);
					$file = str_replace("[%ACTIVE-ABOUT%]", "class='active'", $file);
					$file = str_replace("[%ACTIVE-SETTINGS%]", "'", $file);
					break;
				case 'settings' :
					$file = str_replace("[%ACTIVE-PRINT%]", "", $file);
					$file = str_replace("[%ACTIVE-ABOUT%]", "'", $file);
					$file = str_replace("[%ACTIVE-SETTINGS%]", "class='active'", $file);
					break;
				default :
					$file = str_replace("[%ACTIVE-PRINT%]", "class='active'", $file);
					$file = str_replace("[%ACTIVE-ABOUT%]", "", $file);
					$file = str_replace("[%ACTIVE-SETTINGS%]", "", $file);
					break;
			}
			return $file;
		}

	}

}
?>