<?php
session_start();

$result['code']=0;
if(!isset($_SESSION["userinfo"])){
  $result['code']=-1;
}

$post_format_words = isset($_GET["format"])?$_GET["format"]:'';

$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
$userinfo = $_SESSION["userinfo"];
$user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];


if($result['code']==0){
  $userinfo = Db::table("user")->where([["id","=",$user["id"]]])->find();
  
  if($userinfo !== false){
    
      //登录成功
      $data_result = Db::table("user")->where([["qq","=",$user["qq"]]])
      ->update(
        [
          "username"=>$_POST["name"],
        ]
        );
        if($data_result == 1){
        }else{
          $result['code']=-2;
        }
      
    }
  else{
    $result['code']=-3;
  }
}

if($result['code']==-1){
  $result['message']='You do not login!';
}else if($result['code']==-3){
  $result['message']='This user is not exist!';
}else if($result['code']==-2){
  $result['message']='Database Error!';
}else{
  $result['message']='Successful!';
  $result['code']=1;
}


if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}

?>