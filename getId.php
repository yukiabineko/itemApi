<?php
    require 'pass.php';
 
    try {
      $dbh = new PDO($dsn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $smt = $dbh->query("SHOW TABLE STATUS LIKE 'items' ");
      $result = $smt->fetchAll(PDO::FETCH_ASSOC);
      $dbh = null;
      
      $id = $result[0]['Auto_increment'];
      
    } catch (Exception $e) {
      echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
      die();
    }
  

?>
