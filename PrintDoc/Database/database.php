<?php
    class DatabaseConnection{
    	private $mysqlhost="localhost";
    	private $mysqluser="root";
    	private $mysqlpwd = "hummel1992";
    	private $mysqlDB="Printer";
    	private static $uniquee = null;
    	private function __construct(){
    		
    	}
		public static function instance(){
			if(self::$uniquee == null){
				self::$uniquee = new DatabaseConnection();
			}
			return self::$uniquee;
		}
    	private function connect(){
    			$connection = mysql_connect($this->mysqlhost,$this->mysqluser,$this->mysqlpwd) or die("Error while connecting");
    			return mysql_select_db($connection,$this->mysqlDB);
    	}
		public function login($user,$pwd){
			$conn = $this->connect();
			$stmt = $conn->prepare("Select * from user where name = ? and pwd = ?");
			$stmt->bindParam(1,$user);
			$stmt->bindParam(2,hash("sha256", $pwd + "test"));
			$stmt->execute();
			if($stmt->fetch()){
				return true;
			}
			return false;
			
		}
    }
?>