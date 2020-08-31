<?php
  require 'pass.php';
  //
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->prepare("DELETE FROM items WHERE id=?");
    $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
    $smt->execute();

    //このアイテムと関連オーダー削除
    $smt2 = $dbh->prepare("DELETE FROM orders WHERE item_id=?");
    $smt2->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
    $smt2->execute();

    $dbh = null;
    unlink("tmp/data".$_POST['id'].".jpg");
    echo "削除しました";
    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 
?>
