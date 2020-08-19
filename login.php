<?php
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $smt = $dbh->prepare("SELECT*FROM users WHERE email=? and password=?");
  $smt->bindValue(1, $_POST['email'],PDO::PARAM_STR);
  $smt->bindValue(2, $_POST['password'],PDO::PARAM_STR);
  $smt->execute();
  $result = $smt->fetch(PDO::FETCH_ASSOC);
  $json = json_encode($result,JSON_UNESCAPED_SLASHES);
  header("Access-Control-Allow-Origin: *");
  print_r($json);
  
  $dbh = null;
 
} catch (Exception $e) {
 echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
 die();
}
?>