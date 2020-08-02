<?php
    
    $dsn = 'mysql:dbname=db1;host=localhost';
	$user = 'abi';
	$password = '123';
   
	try {
		if(!empty($_POST['itemsName'])){
			$dbh = new PDO($dsn, $user, $password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$smt2= $dbh->prepare('INSERT INTO items(name,price)VALUES(?,?)');
			$smt2->bindValue(1, $_POST["itemsName"], PDO::PARAM_STR);
			$smt2->bindValue(2, $_POST["price"], PDO::PARAM_INT);
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

