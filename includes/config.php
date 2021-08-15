<?php
ob_start(); //turns out output buffering
session_start();
date_default_timezone_set("Asia/Calcutta");
//PDO->Php data object
try{
  $con = new PDO("mysql:dbname=Netflix;host=localhost", "root", ""); // connection ;username password
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e){
  exit("Connection failed: ".$e->getMessage());
}
?>
