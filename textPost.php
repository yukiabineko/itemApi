<?php
	require 'pass.php';
	
	try {
		$dbh = new PDO("mysql:host=localhost;dbname=db1;charset=utf8",$user,$pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$smt = $dbh->query("SELECT *FROM items");
		$result = $smt->fetchAll(PDO::FETCH_ASSOC);
		$dbh = null;
		
	} catch (Exception $e) {
		echo htmlspecialchars($e->getMessage(),ENT_QUOTES);
		die();
	}

	$last = end($result);
	print_r($result);
	$id = (int)$last['id'] + 1;
	$img = "tmp/data".$id.".jpg"; 
	try {
		$dsn = 'mysql:dbname=db1;host=localhost';   
		if(!empty($_POST['itemsName'])){
			$dbh = new PDO($dsn, $user, $pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$smt2= $dbh->prepare('INSERT INTO items(name,price,path,memo)VALUES(?,?,?,?)');
			$smt2->bindValue(1, $_POST["itemsName"], PDO::PARAM_STR);
			$smt2->bindValue(2, $_POST["price"], PDO::PARAM_INT);
			$smt2->bindValue(3, $img, PDO::PARAM_STR);
			$smt2->bindValue(4, $_POST['memo'], PDO::PARAM_STR);
			$smt2->execute();
			echo '登録しました。';
		}
		else{
		    echo '失敗しました。';
		}
		

		} catch (PDOException $e) {
			echo "接続失敗: " . $e->getMessage() . "\n";
			exit();
		}
        $dbh = null;
?>

