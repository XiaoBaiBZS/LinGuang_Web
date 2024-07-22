<?php
session_start();
$result=array();
if(!isset($_SESSION["userinfo"])){
  $result['code']=-2;
}else{
  $user = $_SESSION["userinfo"];
  
  //0为普通用户；1为管理员；2为认证开发者
  if($user["status"]==1){
    $result['code']=0;
    $UserState = 1;
  }else if($user["status"]==2){
    $result['code']=0;
    $UserState = 2;
  }
  else{
    $result['code']=-1;
  }
}


$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";


$get_format_words = isset($_GET["format"])?$_GET["format"]:'';
$get_AppId_words = isset($_GET["AppId"])?$_GET["AppId"]:'';
if($get_AppId_words==''){
  $result['code']=-3;
}else{
  $data = Db::table("app_data")->where([["AppId","=",$get_AppId_words]])->select();
  if($data[0]['IsAvailable']==0){
    $result['code']=-4;
  }else{
    if($data[0]['AppUpUserId']==$user["id"]||$user["status"]==1){
      $this_result = Db::table("app_data")->where([["AppId","=",$get_AppId_words]])
      ->update(
        [
          "IsAvailable"=>0,
        ]
        );
        if($this_result == 1){
          $result['code']=1;
        }else{
          $result['code']=-5;
        }
    }else{
      $result['code']=-1;
    }
  }

}
  

  
    if($result['code']==-1){
      $result['message']="You do not have permission!";
    }else if($result['code']==1){
      $result['message']="Successful!";
    }else if($result['code']==-2){
      $result['message']="You do not login!";
    }else if($result['code']==-3){
      $result['message']="You do not get all information!";
    }else if($result['code']==-4){
      $result['message']="This App have been delete on the database! If this App is still available on the list page, maybe it is checking now. Please wait or email us.";
    }else if($result['code']==-5){
      $result['message'] = "Database Error!";
}else{
  $result['message']="Unknown Error!";
}


if($get_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}
?>