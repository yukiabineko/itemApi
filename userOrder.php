<?php 
 
 require 'pass.php';
 
 try {
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 
  if(!empty($_POST)){
    $password = $_POST['password'];   /*照合用パスワード*/
   
    //ユーザーの情報取得
    $smt = $dbh->prepare("SELECT*FROM users WHERE email=?");
    $smt->bindValue(1, $_POST['email'],PDO::PARAM_STR);
    $smt->execute();
    $user = $smt->fetch(PDO::FETCH_ASSOC);

    //パスワード暗号化照合 okならログイン情報送信
    if(password_verify($password, $user['password']) === TRUE){
      $user_id = $user['id'];
      /***********user関連 *****************************************************************/
      //商品-欄
      $smt2 = $dbh->query("SELECT * from items");
      $items = $smt2->fetchAll(PDO::FETCH_ASSOC);

      /***********item関連 *****************************************************************/
      //このアイテム一覧に該当オーダーなければ作成
      if(!empty($user_id) || !$user_id === 0){
        foreach($items as $item){
          $smt3 =$dbh->prepare("SELECT * FROM orders WHERE item_id=? AND user_id=?");
          $smt3->bindValue(1, (int)$item['id'], PDO::PARAM_INT);
          $smt3->bindValue(2, (int)$user_id, PDO::PARAM_INT);
          $smt3->execute();
          $order = $smt3->fetch(PDO::FETCH_ASSOC);
      
      
        if(empty($order)){
          $smt4 = $dbh->prepare("INSERT INTO orders(item_name, item_price, item_id, user_id, memo, day)VALUES(?,?,?,?,?,?)");
          $smt4->bindValue(1, $item['name'], PDO::PARAM_STR);
          $smt4->bindValue(2, (int)$item['price'], PDO::PARAM_INT);
          $smt4->bindValue(3, (int)$item['id'], PDO::PARAM_INT);
          $smt4->bindValue(4,(int)$user_id, PDO::PARAM_INT);
          $smt4->bindValue(5, '', PDO::PARAM_STR);
          $smt4->bindValue(6, $_POST['day'], PDO::PARAM_STR);
          $smt4->execute();

    
          }
        }
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
    }
    else{
      header("Access-Control-Allow-Origin: *");
      echo "失敗";
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