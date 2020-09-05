<?php
	 require 'pass.php';
		
	try {
		$dbh = new PDO($dsn, $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if(!empty($_POST)){
			$hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$smt = $dbh->prepare('INSERT INTO users(shop, email, password, tel)VALUE(?, ?, ?, ?)');
			$smt->bindValue(1, $_POST['shop'],PDO::PARAM_STR);
			$smt->bindValue(2, $_POST['email'],PDO::PARAM_STR);
			$smt->bindValue(3, $hash_pass, PDO::PARAM_STR);
			$smt->bindValue(4, $_POST['tel'],PDO::PARAM_STR);
			$smt->execute();
			echo '登録しました。';
		}
		else{
		 echo "データがありません。";
		}
	} catch (PDOException $e) {
		echo "接続失敗: " . $e->getMessage() . "\n";
		exit();
	}
    $dbh = null;
?>

