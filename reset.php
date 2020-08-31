<?php
  require 'pass.php';
  
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->prepare("DELETE FROM items");
    $smt->execute();

  //アイテム削除によりオーダーも全削除
    $smt2 = $dbh->prepare("DELETE FROM orders");
    $smt2->execute();

    $dbh = null;
    $files = glob('tmp/*'); 
    foreach($files as $file){ 
          unlink($file); 
      }
      
    echo "削除しました";
    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 


?>
