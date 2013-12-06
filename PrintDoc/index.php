<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_include_path('View');
require_once 'Controll/class.controll.php';
session_start();
new Controll($_POST,$_GET);

?>