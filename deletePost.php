<?php
  require 'pass.php';
  
  try{
    if(!empty($_POST['id'])){
      $dbh = new PDO($dsn, $user, $pass);
      $dbh -> setAttribute(PDO::ATTR_ERRORMODE, PDO::ERRORMODE_EXCEPTION);
      $smt = $dbh -> prepare('DELETE FROM items WHERE id=?');
      $smt -> bindValue(1, (int)$_POST["id"], PDO::PARAM_INT);
      $smt -> execute();
      echo "削除しました。";
      $dbh = null;
    }
    else{ echo $_POST["id"]."です。";}
   
  }
  catch(Exception $e){
    echo htmlspecialchars($e->getMessage(), ENT_QUOTES);
    die();
  }



?>
