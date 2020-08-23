<?php
  require 'pass.php';
  try {
   $dbh = new PDO($dsn, $user, $pass);
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   if(!empty){
     $smt = $dbh->prepare("UPDATE items SET items name=?, price=?, info=? WHERE id=?");
     $smt->bindValue(1, $_POST['name'],PDO::PARAM_STR);
     $smt->bindValue(2, (int)$_POST['price'],PDO::PARAM_INT);
     $smt->bindValue(3, $_POST['info'],PDO::PARAM_STR);
     $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
     $smt->execute();
     echo '編集しました。';
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