<?php
  session_start();
  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
  $post_format_words = isset($_GET["format"])?$_GET["format"]:'';

//print_r($_POST);
//   require dirname(__DIR__).".{$DS}func{$DS}Func.php";
//   print_r($_POST["username"]);
//   print_r(json_encode($_POST,JSON_UNESCAPED_UNICODE));

  // 再次验证表单

  $message = "";
  foreach (['name','qq','password'] as $key => $value) {
    if(!isset($_POST[$value])){
      $message = $value."must be required!";
      break;
    }
    if($_POST[$value]==''){
      $message = $value."must be required!";
      break;
    }
  }

  //拒绝频繁请求
  //初始化

            $reg_seconds = 180;
            $reg_ban_seconds = 3600;
            if($message === ''){
                if(isset($_SESSION["reg_count"])){
                $_SESSION["reg_count"] += 1;
                $_SESSION["reg_time"] = time();
                }else{
                $_SESSION["reg_count"] = 1;
                }
            
                $_SESSION["reg_time"] = time();
                //请求超过限制
                if($_SESSION["reg_count"]>10 && !isset($_SESSION["reg_banned"])){
                if(isset($_SESSION["reg_time"]) && time() - $_SESSION["reg_time"] < $reg_seconds){
                    $_SESSION["reg_ban_time"] = time() + $reg_ban_seconds;
                    $_SESSION["reg_banned"] = true;
                }
                }
                //解除限制
                if(isset($_SESSION["reg_banned"])){
                if(time() - $_SESSION["reg_ban_time"] > 0){
                    unset($_SESSION["reg_ban_time"]);
                    unset($_SESSION["reg_banned"]);
                    $_SESSION["reg_count"] = 1;
                }else{
                    $message = "请求次数频繁，请在".date("Y-m-d H:i:s",$_SESSION["reg_ban_time"])."之后尝试。";
                }
                }
            }


  //用户名是否重复
  if($message === ''){
    $useinfo = Db::table("user")->where([["qq","=",$_POST["qq"]]])->find();
    if($useinfo !== false){
      $message = "This user is in database.";
    }
  }


  $result =  0;
  // 写入数据库
  if($message === ''){
    $pass = md5($_POST["password"].$_POST["qq"]);
    
    $result =  Db::table("user")->insert([
      "username"=>$_POST["name"],
      "qq"=>$_POST["qq"],
      "password"=>$pass,
      "create_date"=>date("Y-m-d H:i:s")]);
    if($result !==1){
      $message = "Unknown Error!";
    }
  }
  
  $response_data = [
    "code"=>1,
    "message"=>$message,
    "data"=>$result,
  ];


  if($message !== ""){
    $response_data["code"] = 0;
  }
  if($post_format_words=='array'){
    print_r($response_data);
  }else{
    print_r(json_encode($response_data,JSON_UNESCAPED_UNICODE));
  }
  
?>