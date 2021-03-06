<?php 
    require 'pass.php';	
  try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $smt = $dbh->query("SELECT *FROM users");
    $result = $smt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    
    $json = json_encode($result,JSON_UNESCAPED_SLASHES);
    header("Access-Control-Allow-Origin: *");
    print_r($json);

    
  } catch (Exception $e) {
    echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
    die();
  }

?>