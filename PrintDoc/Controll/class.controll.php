<?php
require_once 'class.stateHTML.php';
class Controll {
	private $type;
	private $output;
	public function __construct($post, $get) {
		if (empty($get["type"])) {
			$this->type = "";
		} else {
			$this -> type = $get["type"];
		}

		switch ($this->type) {
			case 'json' :
				break;
			default :
				$content = array("login" => "test");
				$state = new StateHTML();
				$state -> getOutput($this->type, $post);
		}
	}

}
?>