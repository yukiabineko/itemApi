<?php
    require 'pass.php';
  
	try {
		$dbh = new PDO($dsn, $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$smt= $dbh->query('SELECT*FROM items');
		$result = $smt->fetchAll(PDO::FETCH_ASSOC);
	
		
		$last = end($result);
		$id = (int)$last['id'];

		$data = file_get_contents("php://input");
		$fp = fopen("tmp/data".$id.".jpg", 'wb');
		chmod("tmp/data".$id.".jpg", 0777);
		fwrite($fp, $data);

        fclose($fp);
        echo "完了";
		} catch (PDOException $e) {
			echo "接続失敗: " . $e->getMessage() . "\n";
			exit();
		}
        $dbh = null;
?>

