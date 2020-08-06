<?php
 require 'setting.php';

 $data = insertData();
 $json = json_encode($data,JSON_UNESCAPED_SLASHES);
 print_r($json);


?>