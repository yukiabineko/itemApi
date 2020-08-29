<?php 
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /*オーダー + アイテム*/
  $smt = $dbh->query("SELECT *FROM orders INNER JOIN users ON orders.user_id=users.id WHERE num>0");
  $result = $smt->fetchAll(PDO::FETCH_ASSOC);

  /************************************************************************************** */
  /*全店舗メールアドレス */ 
  $smt2 =   $smt = $dbh->query("SELECT email FROM users");
  $emails = $smt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;
/******************************************************************************************* */
  $jsonArray = array();
  array_push($jsonArray,$emails);
  array_push($jsonArray, $result);
  $send = json_encode($jsonArray,JSON_UNESCAPED_SLASHES);
  header("Access-Control-Allow-Origin: *");
  print_r($send);
  
  
} catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}
?>