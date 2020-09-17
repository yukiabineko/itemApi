<?php 
 
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 
  if(!empty($_POST)){
   
      //ユーザーの情報取得
      $smt = $dbh->prepare("SELECT*FROM users WHERE id=?");
      $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
      $smt->execute();
      $user = $smt->fetch(PDO::FETCH_ASSOC);

      $user_id = $user['id'];
      /***********user関連 *****************************************************************/
      /******************************送信データ****************************************** */
        $smt5 = $dbh->prepare("SELECT * FROM orders INNER JOIN items ON orders.item_id=items.id WHERE user_id=?");
        $smt5->bindValue(1, (int)$user_id, PDO::PARAM_INT);
        $smt5->execute();
        $result = $smt5->fetchAll(PDO::FETCH_ASSOC);

        $jsonArray = array();
        /*$user_json = json_encode($user,JSON_UNESCAPED_SLASHES);
        $json = json_encode($result,JSON_UNESCAPED_SLASHES);*/
        array_push($jsonArray,$user);
        array_push($jsonArray, $result);
        $send = json_encode($jsonArray,JSON_UNESCAPED_SLASHES);
        header("Access-Control-Allow-Origin: *");
        print_r($send);  

      }
      else{
        echo 'データ送信されてません。';
      }
  
  $dbh = null;
  
} catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}

?>