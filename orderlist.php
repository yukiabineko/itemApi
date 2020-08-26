<?php 
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //全ユーザーの情報取得
   $smt = $dbh->query("SELECT * FROM users");
   $users = $smt->fetchAll(PDO::FETCH_ASSOC);
  
   /***********user関連 *****************************************************************/
   //userごとのオーダーを取得し配列格納
   $array =array();

   foreach($users as $user){
     $smt2 =$dbh->prepare("SELECT *FROM  orders WHERE user_id=? AND num >0");
     $smt2->bindValue(1, (int)$user["id"], PDO::PARAM_INT);
     $smt2->execute();
     $orders = $smt2->fetchAll(PDO::FETCH_ASSOC);
     $order_hash = array($user['shop']=>$orders);
     $array[] = $order_hash;
   }
   $json = json_encode($array,JSON_UNESCAPED_SLASHES);
   header("Access-Control-Allow-Origin: *");
   print_r($json);
   $dbh = null;
  }
 catch (Exception $e) {
  echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
  die();
}

?>