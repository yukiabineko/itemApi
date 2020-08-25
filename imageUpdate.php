<?php
  require 'find.php';

  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->prepare("SELECT * FROM items WHERE id=?");
    $smt->bindValue(1, (int)$_GET['id'],PDO::PARAM_INT);
    $smt->execute();
    $result = $smt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }
  unlink("tmp/data".$result['id'].".jpg");
  $data = file_get_contents("php://input");
  $fp = fopen("tmp/data".$result['id'].".jpg", 'wb');
  chmod("tmp/data".$result['id'].".jpg", 0777);
  fwrite($fp, $data);
  fclose($fp);
  print_r($result);
?>