<?php
 require 'pass.php';
 try {
   $dbh = new PDO($dsn, $user, $pass);
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $smt = $dbh->prepare("SELECT * FROM orders WHERE id=?");
   $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
   $smt->execute();
   $result = $smt->fetch(PDO::FETCH_ASSOC);

   $dbh = null;
  
} catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}
?>