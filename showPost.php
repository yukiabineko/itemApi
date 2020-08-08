<?php
  require 'find.php';
  
  $find_data = $result;
  if(!empty($result)){
    json_encode($result, JSON_UNESCAPED_SLASHES);
    $json = json_encode($data,JSON_UNESCAPED_SLASHES);
    print_r($json);
  }
  else{
    echo "データがありません。";
  }

 