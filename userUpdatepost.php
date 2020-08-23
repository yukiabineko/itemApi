<?php
  require 'pass.php';
  
  try {
    if(!empty($_POST)){
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Headers: Content-Type');
     
     //アップデート処理

      $dbh = new PDO($dsn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $smt = $dbh->prepare("UPDATE orders SET num=?, memo=?, day=?, name=?, price=? WHERE user_id=? AND item_id=?");
      $smt->bindValue(1, (int)$_POST['num'], PDO::PARAM_INT);
      $smt->bindValue(2, $_POST['memo'], PDO::PARAM_STR);
      $smt->bindValue(3, $_POST['day'], PDO::PARAM_STR);
      $smt->bindValue(4, $_POST['name'], PDO::PARAM_STR);
      $smt->bindValue(5, $_POST['price'], PDO::PARAM_STR);
      $smt->bindValue(6, (int)$_POST['user_id'], PDO::PARAM_INT);
      $smt->bindValue(7, (int)$_POST['item_id'], PDO::PARAM_INT);
      $smt->execute();
    

      //アップデート後結果出力
      $smt2 = $dbh->prepare("SELECT * FROM orders INNER JOIN items ON orders.item_id=items.id WHERE user_id=?");
      $smt2->bindValue(1, (int)$_POST['user_id'], PDO::PARAM_INT);
      $smt2->execute();
      $result = $smt2->fetchAll(PDO::FETCH_ASSOC);

      //店舗情報
      $smt3 = $dbh->prepare("SELECT*FROM users WHERE id=?");
      $smt3->bindValue(1, $_POST['user_id'],PDO::PARAM_INT);
      $smt3->execute();
      $user = $smt3->fetch(PDO::FETCH_ASSOC);

      $jsonArray = array();
      array_push($jsonArray,$user);
      array_push($jsonArray, $result);
      $send = json_encode($jsonArray,JSON_UNESCAPED_SLASHES);
      print_r($send);
      $dbh = null;
      
    }
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 


?>
