<?php
class UserPrintJob {
	private $printer;
	private $filename;
	private $id;
	public function __construct($id, $filename, $printer = null) {
		
		if (isset($printer)) {
			$this -> printer = $printer;
		}
		$this -> filename = $filename;
		$this -> id = $id;
	}

	public function getPrinter() {
		if (isset($this->printer))
			return $this -> printer;
		return null;
	}

	public function setPrinter($printer) {
		if (isset($printer)) {
			$this -> printer;
		}
	}

	public function getFilename() {
		return $this -> filename;
	}

	public function getID() {
		return $this -> id;
	}

}
?>