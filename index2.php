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
		echo $_POST['word'];
		echo $_POST['price'];
		print_r($result);
		$last = end($result);
		$id = (int)$last['id'];

		$data = file_get_contents("php://input");
		$fp = fopen("tmp/data".$id.".jpg", 'wb');
		chmod("tmp/data".$id.".jpg", 0777);
		fwrite($fp, $data);

		fclose($fp);

		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$smt2= $dbh->prepare('INSERT INTO users(name)VALUES(?)');
		$smt2->bindValue(1, $_POST["name"], PDO::PARAM_STR);
		$smt2->execute();

		$smt3= $dbh->prepare('INSERT INTO users(name)VALUES(?)');
		$smt3->bindValue(1, $_POST["price"], PDO::PARAM_STR);
		$smt3->execute();

		
		} catch (PDOException $e) {
			echo "接続失敗: " . $e->getMessage() . "\n";
			exit();
		}
        $dbh = null;

?>

