<?php
  require 'pass.php';
  //
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!empty($_POST)){
        $smt = $dbh->prepare("DELETE FROM users WHERE id=?");
        $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
        $smt->execute();
        echo "削除しました";
    }
    else{
        echo "データがありません。";
    }
    $dbh = null;
  
    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
 
?>
