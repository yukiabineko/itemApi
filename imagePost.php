<?php
    require 'getId.php';
		
                $imgid = (int)$id -1;
		$data = file_get_contents("php://input");
		$fp = fopen("tmp/data".$imgid.".jpg", 'wb');
		chmod("tmp/data".$id.".jpg", 0777);
		fwrite($fp, $data);
                fclose($fp);
       
?>

