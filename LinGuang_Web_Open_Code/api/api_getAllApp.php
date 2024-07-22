<?php
$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";

$post_format_words = isset($_GET["format"])?$_GET["format"]:'';

$result=array();


  $result['code']=1;
  $data = Db::table("app_data")->where([["AppId",">",0],["IsAvailable","=",1],["IsLastest","=",1]])->select();
  if($data[0]['IsAvailable']==0){
    $result['code']=-2;
  }else{
    $result['data']=$data;
  }


if($result['code']==-1){
  $result['message']="No legitimate post 'id'!";
}else if($result['code']==-2){
  $result['message']="This App is not available!";
}else{
  $result['message']="Successful!";
}

if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}

?>