<?php 
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  /*オーダー + アイテム*/
  $smt = $dbh->prepare("SELECT *FROM orders INNER JOIN users ON orders.user_id=users.id
  INNER JOIN items ON orders.item_id= items.id WHERE item_id=? AND num>0");
  $smt->bindValue(1, (int)$_POST['item_id'],PDO::PARAM_INT);
  $smt->execute();
  $result = $smt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;
/******************************************************************************************* */
  $send = json_encode($result,JSON_UNESCAPED_SLASHES);
  header("Access-Control-Allow-Origin: *");
  print_r($send);
  
  
} catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}
?>