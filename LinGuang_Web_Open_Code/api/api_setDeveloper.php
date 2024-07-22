<?php

$post_format_words = isset($_GET["format"])?$_GET["format"]:'';


$result["code"] = 0;


$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";


$post_input = file_get_contents('php://input');
$post_data = json_decode($post_input,true);

$post_data_id = isset($post_data['id'])?$post_data['id']:'';


if($post_data_id == 0){
  $result["code"]=-1;
}
//包名是否重复

  $user_data = Db::table("user")->where([["id","=",$post_data_id]])->select();
  //print_r($app_data);
  if($user_data == false){
    $result['code']=-4;
  }else{
    
        $this_result = Db::table("user")->where([["id","=",$post_data_id]])
        ->update(
          [
            "status"=>2
          ]
          );
          
          $result['code']=1;
    
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