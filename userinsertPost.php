<?php
  require 'pass.php';
  
  try {
    if(!empty($_POST)){
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Headers: Content-Type');
     
     
      $dbh = new PDO($dsn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $smt = $dbh->prepare("INSERT INTO orders(day, shop, name, num, memo, item_id)VALUES(?, ?, ?, ?, ?, ?)");
      $smt->bindValue(1, $_POST['day'], PDO::PARAM_STR);
      $smt->bindValue(2, $_POST['shop'], PDO::PARAM_STR);
      $smt->bindValue(3, $_POST['name'], PDO::PARAM_STR);
      $smt->bindValue(4, (int)$_POST['num'], PDO::PARAM_INT);
      $smt->bindValue(5, $_POST['memo'], PDO::PARAM_STR);
      $smt->bindValue(6, (int)$_POST['item_id'], PDO::PARAM_INT);
      $smt->execute();
      $dbh = null;
     
      echo '送信しました。';

    }
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 


?>
