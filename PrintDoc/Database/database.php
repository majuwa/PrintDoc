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
    			$mysqli = new mysqli($this->mysqlhost,$this->mysqluser,$this->mysqlpwd,$this->mysqlDB) or die("Error while connecting");  
				  			
				return $mysqli;
    	}
		public function login($user,$pwd){
			$conn = $this->connect();
			
			$pwd = $pwd . "abd";
			if(!$stmt = $conn->prepare("Select * from user where user = ? and pwd = ?")){
				echo $conn->error;
			}
			$pwd = hash("sha256",$pwd);
			$stmt->bind_param("ss",$user,$pwd );
			//$stmt->bind_param());
			//$stmt->bind_param(2,));
			$stmt->execute();
			if($stmt->fetch()){
				return true;
			}
			return false;
			
		}
    }
?>