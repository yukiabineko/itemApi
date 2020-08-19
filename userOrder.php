<?php 
 require 'pass.php';
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
  if(!empty($_POST)){
    //ユーザーの情報取得
   $smt = $dbh->prepare("SELECT * FROM users WHERE id=?");
   $smt->bindValue(1, (int)$_POST['id'],PDO::PARAM_INT);
   $smt->execute();
   $user = $smt->fetch(PDO::FETCH_ASSOC);
   $user_id = $user['id'];

   /***********user関連 *****************************************************************/
   //商品-欄
   $smt2 = $dbh->query("SELECT * from items");
   $items = $smt2->fetch(PDO::FETCH_ASSOC);

   /***********item関連 *****************************************************************/
   //このアイテム一覧に該当オーダーなければ作成
   
   foreach($items as $item){
     $smt3 =$dbh->prepare("SELECT * FROM orders WHERE item_id=? AND user_id=?");
     $smt3->bindValue(1, (int)$item['id'], PDO::PARAM_INT);
     $smt3->bindValue(2, (int)$user_id, PDO::PARAM_INT);
     $smt3->execute();
     $order = $smt->fetch(PDO::FETCH_ASSOC);
     if(empty($order)){
      $smt4 = $dbh->prepare("INSERT INTO orders(name, item_id, user_id)VALUES(?,?,?)");
      $smt4->bindValue(1, $item['name'], PDO::PARAM_STR);
      $smt4->bindValue(2, (int)$item['id'], PDO::PARAM_INT);
      $smt4->bindValue(3, (int)$user_id, PDO::PARAM_INT);
      $smt4->execute();

     }
   }
 
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