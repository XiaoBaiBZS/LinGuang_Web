<?php
session_start();
$result=array();
if(!isset($_SESSION["userinfo"])){
  $result['code']=-1;
}else{
  $result['code']=0;
  $user = $_SESSION["userinfo"];
}

$post_format_words = isset($_GET["format"])?$_GET["format"]:'';

if($result['code']==0){

  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
  
  
  $userinfo = Db::table("user")->where([["id","=",$user['id']]])->find();
  if($userinfo !== false){
    $_SESSION["userinfo"] = [
        "id" => $userinfo["id"],
        "qq" => $userinfo["qq"],
        "status" => $userinfo["status"],
      ];
      Db::table("log_login")->insert([
        "userid"=>$userinfo["id"],
        "ip"=>$_SERVER["REMOTE_ADDR"],
        "create_date"=>date("Y-m-d H:i:s")
      ]);
      $result['code'] = 1;
  }else{
    $result['code'] = -2;
  }
}

if($result['code']==-1){
  $result['message']="You do not login!";
}else if($result['code']==1){
  $result['message']="Successful!";
}else if($result['code']==-2){
  $result['message']="User not found!";
}else{
  $result['message']="Unknown Error!";
}

if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}


?>