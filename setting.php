<?php 
 function insertData(){
 	require 'pass.php';
  try {
    $dbh = new PDO("mysql:host=localhost;dbname=db1;charset=utf8",$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->query("SELECT *FROM items");
    $result = $smt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    
    return $result;
    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 }

?>