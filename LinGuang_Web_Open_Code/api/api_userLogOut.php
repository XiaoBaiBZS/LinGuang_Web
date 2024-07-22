<?php
  session_start();
  $post_format_words = isset($_GET["format"])?$_GET["format"]:'';

  if(isset($_SESSION["userinfo"])){
    unset($_SESSION["userinfo"]);
    $message = "Successful";
    $code = 1;
  }else{
    $message = "You do not login or you have been logout!";
    $code = 0;
  }


  $response_data = [
    "code"=>1,
    "msg"=>$message,
    "data"=>[],
  ];
  if($post_format_words=='array'){
    print_r($response_data);
  }else{
    print_r(json_encode($response_data));
  }
?>