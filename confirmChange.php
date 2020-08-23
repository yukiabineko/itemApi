<?php

 require 'orderfind.php';
 
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(!empty($_POST)){
   $smt = $dbh->prepare("UPDATE orders SET confirm=? WHERE user_id=? AND item_id=?");
   if($_POST['confirm'] == '0'){
    $smt->bindValue(1, 1,PDO::PARAM_INT);
    $smt->bindValue(2, (int)$_POST['user_id'], PDO::PARAM_INT);
    $smt->bindValue(3, (int)$_POST['item_id'], PDO::PARAM_INT);
    $smt->execute();
    echo '発注数を確定しました。';
   }
   else if($_POST['confirm'] == '1'){
    $smt->bindValue(1, 0,PDO::PARAM_INT);
    $smt->bindValue(2, (int)$_POST['id'], PDO::PARAM_INT);
    $smt->execute();
    echo '発注数をリセットしました。';
   }
 
  }
 
  $dbh = null;
  
} catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}
?>