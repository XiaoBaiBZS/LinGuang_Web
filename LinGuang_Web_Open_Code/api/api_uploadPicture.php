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

$post_format_words = isset($_GET["format"])?$_GET["format"]:'';

if($result['code']==0){




$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";


$post_input = file_get_contents('php://input');
$post_data = json_decode($post_input,true);


$post_data_data = isset($post_data['data'])?$post_data['data']:'';
$post_data_upUserId = $user['id'];

if(
  $post_data_data==''
  ){
  $result['code']=-3;
}

}

if($result['code']==0){
  
$check_data_data = substr($post_data_data,strripos($post_data_data,",")+1);

  $originalLength = strlen($check_data_data);
  // 对于标准Base64编码，长度应该是4的倍数；对于URL安全的Base64编码，长度应该是3的倍数
  if($originalLength % 4 === 0|| $originalLength % 3 === 0){
    
    $regex = "/^[A-Za-z0-9+\/=-_]*$/";

    if (preg_match($regex, $check_data_data)) {
      // 判断是否能正常解码
      if(base64_decode($check_data_data, true) == false) {
        $result['code']=-6;
      }
    } else {
      $result['code']=-7;
    }

  }else{
    $result['code']=-8;
    }

}
if($result['code']==0){

    $post_result =  Db::table("picture")->insert([
        "upUserId"=>$post_data_upUserId,
        "data"=>$post_data_data,
        "isAvailable"=>1,
        "create_time"=>date("Y-m-d H:i:s")]);
      if($post_result !==1){
        $result['code'] = -5;
      }else{
        $result['code'] = 1;
      }
      $data = Db::table("picture")->where([["id",">",0]])->select();
      $result['data'] = $data[count($data)-1]['id'];
  }
    
    if($result['code']==-1){
      $result['message']="You do not have permission!";
    }else if($result['code']==1){
      $result['message']="Successful!";
    }else if($result['code']==-2){
      $result['message']="You do not login!";
    }else if($result['code']==-3){
      $result['message']="You do not post all information!";
    }else if($result['code']==-4){
      $result['message']="This App have been load on the database! If this App is not available on the list page, maybe it is checking now. Please wait or email us.";
    }else if($result['code']==-5){
      $result['message'] = "Database Error!";
    }else if($result['code']==-6){
  $result['message'] = "Not Base64!";
  
}else{
  $result['message']="Unknown Error!";
}


if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}
?>