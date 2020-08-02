<?php 
   $dsn = 'mysql:dbname=db1;host=localhost';
   $user = 'abi';
   $password = '123';
   try {
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $smt= $dbh->query('SELECT*FROM users');
      $result = $smt->fetchAll(PDO::FETCH_ASSOC);
      echo "接続成功\n";
      print_r($result);
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
    }
   
?>