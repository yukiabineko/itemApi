<?php 
  require 'pass.php';
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->query("DELETE FROM orders");
    
    $dbh = null;
   
 } catch (Exception $e) {
   echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
   die();
 }

?>