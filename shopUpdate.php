<?php
  require 'pass.php';
  try {
   $dbh = new PDO($dsn, $user, $pass);
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   if(!empty($_POST)){
     //パスワード暗号化
     $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
     $smt = $dbh->prepare("UPDATE users SET shop=?, email=?, password=?, tel=? WHERE id=?");
     $smt->bindValue(1, $_POST['shop'],PDO::PARAM_STR);
     $smt->bindValue(2, $_POST['email'],PDO::PARAM_STR);
     $smt->bindValue(3, $hash_pass,PDO::PARAM_STR);
     $smt->bindValue(4, $_POST['tel'],PDO::PARAM_STR);
     $smt->bindValue(4, (int)$_POST['id'],PDO::PARAM_INT);
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