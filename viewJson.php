<?php
 require 'setting.php';

 $data = insertData();
 $json = json_encode($data,JSON_UNESCAPED_SLASHES);
 header("Access-Control-Allow-Origin: *");
 print_r($json);


?>