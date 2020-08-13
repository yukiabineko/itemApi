<?php
  require 'pass.php';
  
  try {
    if(!empty($_POST)){
      $dbh = new PDO($dsn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $smt = $dbh->prepare("INSERT INTO orders(shop, num, memo, item_id)VALUES(?, ?, ?, ?)");
      $smt->bindValue(1, $_POST['shop'], PDO::PARAM_STR);
      $smt->bindValue(2, (int)$_POST['num'], PDO::PARAM_INT);
      $smt->bindValue(3, $_POST['num'], PDO::PARAM_STR);
      $smt->bindValue(4, (int)$_POST['item_id'], PDO::PARAM_INT);
      $smt->execute();
      $dbh = null;
      header("Access-Control-Allow-Origin: *");
      echo '送信しました。';

    }
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 


?>
