<?php
require_once 'Model/class.printjobs.php';
class DatabaseConnection {
	private $mysqlhost = "localhost";
	private $mysqluser = "root";
	private $mysqlpwd = "hummel1992";
	private $mysqlDB = "Printer";
	private static $uniquee = null;
	private function __construct() {

	}

	public static function instance() {
		if (self::$uniquee == null) {
			self::$uniquee = new DatabaseConnection();
		}
		return self::$uniquee;
	}

	private function connect() {
		$mysqli = new mysqli($this -> mysqlhost, $this -> mysqluser, $this -> mysqlpwd, $this -> mysqlDB) or die("Error while connecting");

		return $mysqli;
	}

	public function login($user, $pwd) {
		$conn = $this -> connect();

		$pwd = $pwd . "abd";
		if (!$stmt = $conn -> prepare("Select * from user where user = ? and pwd = ?")) {
			echo $conn -> error;
		}
		$pwd = hash("sha256", $pwd);
		$stmt -> bind_param("ss", $user, $pwd);
		//$stmt->bind_param());
		//$stmt->bind_param(2,));
		$stmt -> execute();
		if ($stmt -> fetch()) {
			return true;
		}
		$stmt -> close();
		$conn -> close();
		return false;

	}

	/**
	 * Get all Printjobs not started.
	 *
	 * @return Array of Printjobs
	 * @author majuwa
	 */
	public function getPrintjobs($user) {
		$array = array();
		$conn = $this -> connect();
		if (!$stmt = $conn -> prepare("Select ID,filename,printer from Printjobs where user = ?"))
			echo $conn -> error;
		$stmt -> bind_param("s", $user);
		$stmt -> execute();
		mysqli_stmt_bind_result($stmt, $id, $filename, $printer);
		while (mysqli_stmt_fetch($stmt)) {
			$job = new UserPrintJob($id, $filename, $printer);
			//$job = new UserPrintJob($row["ID"], $row["filename"], $row["printer"]);

			array_push($array, $job);

		}
		$stmt -> close();
		$conn -> close();
		return $array;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 */
	function insertPrintjobs($user, $filename, $printer) {
		$array = array();
		$conn = $this -> connect();
		if (!$stmt = $conn -> prepare("Insert into Printjobs(user,filename,printer) values(?,?,?)"))
			echo $conn -> error;
		$stmt -> bind_param("sss", $user, $filename, $printer);
		$stmt -> execute();
		$stmt -> close();
		$conn -> close();
		return TRUE;
	}
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author  
	 */
	function deletePrintjobs($user) {
				$array = array();
		$conn = $this -> connect();
		if (!$stmt = $conn -> prepare("DELETE FROM Printjobs WHERE user = ?"))
			echo $conn -> error;
		$stmt -> bind_param("s",$user);
		$stmt -> execute();
		$stmt -> close();
		$conn -> close();
		return TRUE;
	}
}
?>