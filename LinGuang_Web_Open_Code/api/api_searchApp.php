<?php
$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
$post_key_words = isset($_GET["key"])?$_GET["key"]:'';
$post_type_words = isset($_GET["type"])?$_GET["type"]:'';
$post_format_words = isset($_GET["format"])?$_GET["format"]:'';

$TYPE = array("AppId","AppName","AppDownloadUrl","AppVersion","AppNewVersion","AppOneSentenceIntroduction","AppIntroduction","AppLogoUrl","AppIntroductionPictureUrl","AppUpdateIntroduction","AppInerVersion","AppUpUserId","AppUniqueId","AppType");

$result=array();

if($post_key_words == ''||$post_type_words == ''){
  $result['code']=-1;
}else if(!in_array($post_type_words,$TYPE)){
  $result['code']=-2;
}else{
  $result['code']=1;
  $data = Db::table("app_data")->where([[$post_type_words,"like",'%'.$post_key_words.'%'],['IsAvailable',"=",1],["IsLastest","=",1]])->select();
  if($data == null){
    $result['code']=-3;
    $result['data']=$data;
  }else{

    $result['data']=$data;
  }
}

if($result['code']==-1){
  $result['message']="No legitimate post 'key' or 'type'!";
}else if($result['code']==1){
  $result['message']="Successful!";
}else if($result['code']==-2){
  $result['message']="Type is not allowed!";
}else if($result['code']==-3){
  $result['message']="Not found data!";
}else{
  $result['message']="Unknown Error!";
}

if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}


?>