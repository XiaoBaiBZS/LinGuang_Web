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

$post_data_AppName = isset($post_data['AppName'])?$post_data['AppName']:'';
$post_data_AppDownloadUrl = isset($post_data['AppDownloadUrl'])?$post_data['AppDownloadUrl']:'';
$post_data_AppVersion = isset($post_data['AppVersion'])?$post_data['AppVersion']:'';
$post_data_AppNewVersion = isset($post_data['AppNewVersion'])?$post_data['AppNewVersion']:'';
$post_data_AppOneSentenceIntroduction = isset($post_data['AppOneSentenceIntroduction'])?$post_data['AppOneSentenceIntroduction']:'';
$post_data_AppIntroduction = isset($post_data['AppIntroduction'])?$post_data['AppIntroduction']:'';
$post_data_AppLogoUrl = isset($post_data['AppLogoUrl'])?$post_data['AppLogoUrl']:'';
$post_data_AppIntroductionPictureUrl = isset($post_data['AppIntroductionPictureUrl'])?$post_data['AppIntroductionPictureUrl']:'';
$post_data_AppUpdateIntroduction = isset($post_data['AppUpdateIntroduction'])?$post_data['AppUpdateIntroduction']:'';
$post_data_AppUpUserId = isset($post_data['AppUpUserId'])?$post_data['AppUpUserId']:'';
$post_data_AppDeveloper = isset($post_data['AppDeveloper'])?$post_data['AppDeveloper']:'';
$post_data_AppDeveloperUrl = isset($post_data['AppDeveloperUrl'])?$post_data['AppDeveloperUrl']:'';
$post_data_AppPackageName = isset($post_data['AppPackageName'])?$post_data['AppPackageName']:'';
$post_data_AppType = isset($post_data['AppType'])?$post_data['AppType']:'';
$post_data_AppPlatform = isset($post_data['AppPlatform'])?$post_data['AppPlatform']:'';
$post_data_OnloadDate = 0;
$post_data_AppInerVersion = 0;
if(
  $post_data_AppName==''||
  $post_data_AppVersion==''||
  $post_data_AppOneSentenceIntroduction==''||
  $post_data_AppIntroduction==''||
  $post_data_AppLogoUrl==''||
  $post_data_AppPackageName==''
  ){
  $result['code']=-3;
}
if($post_data_AppDownloadUrl==''){
  $post_data_AppDownloadUrl = 0;
}
if($post_data_AppUpUserId==''){
  $post_data_AppUpUserId = $user["id"];
}
if($post_data_AppType==''){
  $post_data_AppType = 0;
}
if($post_data_AppPlatform==''){
  $post_data_AppPlatform = 0;
}

if($post_data_AppNewVersion==''){
  $post_data_AppNewVersion = $post_data_AppVersion;
}

//包名是否重复

  $app_data = Db::table("app_data")->where([["AppPackageName","=",$post_data_AppPackageName],['IsAvailable',"=",1]])->select();
  //print_r($app_data);
  if($app_data == false){
    $result['code']=-4;
  }else{
    
    $post_data_AppInerVersion = $app_data[0]['AppInerVersion'];
    for($i = 0;$i< count($app_data);$i++){
      if($app_data[$i]['AppInerVersion']>=$post_data_AppInerVersion){
        $post_data_AppInerVersion = $app_data[$i]['AppInerVersion']+1;
      }
      $post_data_OnloadDate = $app_data[$i]['OnloadDate'];
    }

        $this_result = Db::table("app_data")->where([["AppPackageName","=",$post_data_AppPackageName]])
        ->update(
          [
            "AppNewVersion"=>$post_data_AppNewVersion,
            "IsLastest"=>0,
          ]
          );
          

    
  }

}

if($result['code']==0){
  if($UserState==1){
    $post_result =  Db::table("app_data")->insert([
        "AppName"=>$post_data_AppName,
        "AppDownloadUrl"=>$post_data_AppDownloadUrl,
        "AppVersion"=>$post_data_AppVersion,
        "AppNewVersion"=>$post_data_AppNewVersion,
        "AppOneSentenceIntroduction"=>$post_data_AppOneSentenceIntroduction,
        "AppIntroduction"=>$post_data_AppIntroduction,
        "AppLogoUrl"=>$post_data_AppLogoUrl,
        "AppIntroductionPictureUrl"=>$post_data_AppIntroductionPictureUrl,
        "AppUpdateIntroduction"=>$post_data_AppUpdateIntroduction,
        "AppUpUserId"=>$post_data_AppUpUserId,
        "AppInerVersion"=>$post_data_AppInerVersion,
        "AppDeveloper"=>$post_data_AppDeveloper,
        "AppDeveloperUrl"=>$post_data_AppDeveloperUrl,
        "AppPackageName"=>$post_data_AppPackageName,
        "AppType"=>$post_data_AppType,
        "AppPlatform"=>$post_data_AppPlatform,
        "IsAvailable"=>1,
        "OnloadDate"=>$post_data_OnloadDate,
        "UpdateDate"=>date("Y-m-d H:i:s")]);
      if($post_result !==1){
        $result['code'] = -5;
      }else{
        $result['code'] = 1;
      }
  }else if($UserState==2){
$post_result =  Db::table("app_data")->insert([
        "AppName"=>$post_data_AppName,
        "AppDownloadUrl"=>$post_data_AppDownloadUrl,
        "AppVersion"=>$post_data_AppVersion,
        "AppNewVersion"=>$post_data_AppNewVersion,
        "AppOneSentenceIntroduction"=>$post_data_AppOneSentenceIntroduction,
        "AppIntroduction"=>$post_data_AppIntroduction,
        "AppLogoUrl"=>$post_data_AppLogoUrl,
        "AppIntroductionPictureUrl"=>$post_data_AppIntroductionPictureUrl,
        "AppUpdateIntroduction"=>$post_data_AppUpdateIntroduction,
        "AppUpUserId"=>$post_data_AppUpUserId,
        "AppInerVersion"=>$post_data_AppInerVersion,
        "AppDeveloper"=>$post_data_AppDeveloper,
        "AppDeveloperUrl"=>$post_data_AppDeveloperUrl,
        "AppPackageName"=>$post_data_AppPackageName,
        "AppType"=>$post_data_AppType,
        "AppPlatform"=>$post_data_AppPlatform,
        "IsAvailable"=>0,
        "OnloadDate"=>$post_data_OnloadDate,
        "UpdateDate"=>date("Y-m-d H:i:s")]);
      if($post_result !==1){
        $result['code'] = -5;
      }else{
        $result['code'] = 1;
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
      $result['message']="You do not post all information!";
    }else if($result['code']==-4){
      $result['message']="This App have not been load on the database! If this App is not available on the list page, maybe it is checking now. Please wait or email us.";
    }else if($result['code']==-5){
      $result['message'] = "Database Error!";
}else{
  $result['message']="Unknown Error!";
}


if($post_format_words=='array'){
  print_r($result);
}else{
  print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
}
?>