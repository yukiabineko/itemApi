<?php
  require 'find.php';
  
  if(!empty($result)){
    $json = json_encode($result,JSON_UNESCAPED_SLASHES);
    print_r($json);
  }
  else{
    echo "データがありません。";
  }

 