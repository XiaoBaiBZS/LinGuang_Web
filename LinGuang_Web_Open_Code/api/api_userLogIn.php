<?php
  session_start();
  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";

  $post_format_words = isset($_GET["format"])?$_GET["format"]:'';

  $message = "";
  foreach (["qq","password"] as $key => $value) {
    if(!isset($_POST[$value])){
      $message = $value."must be required!";
      break;
    }
    if($_POST[$value]==''){
      $message = $value."must be required!";
      break;
    }
  }
  if($message === ''){
    $userinfo = Db::table("user")->where([["qq","=",$_POST["qq"]]])->find();
    if($userinfo !== false){
      $pass = md5($_POST["password"].$_POST["qq"]);
      if($userinfo["password"] == $pass){
        //登录成功
        // print_r($userinfo);
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
      }else{
        $message = "密码错误";
        
        //错误超过8次禁用
        $login_hour = 60*60;
        if(isset($_SESSION["login_err_count"])){
          $_SESSION["login_err_count"] += 1;
        }else{
          $_SESSION["login_err_count"] += 1;
        }
        if($_SESSION["login_err_count"] > 8 && !isset($_SESSION["login_banned"])){
          $_SESSION["login_ban_time"] = time()+$login_hour;
          $_SESSION["login_banned"] = true;
        }
        if(isset($_SESSION["login_banned"])){
          if(time() - $_SESSION["login_ban_time"] > 0){
            unset($_SESSION["login_ban_time"]);
            unset($_SESSION["login_banned"]);
            unset($_SESSION["login_err_count"]);
          }else{
            $message = "错误次数过多，请于".date("Y-m-d H:i:s",$_SESSION["login_ban_time"])."之后重试。";
          }
        }



      }
    }else{
      $message = "用户不存在";
    }
  }


  $response_data = [
    "code"=>0,
    "msg"=>$message,
    "data"=>[],
  ];

  if($message !== ''){
    $response_data["code"] = 0;
  }
  else{
    $response_data["code"] = 1;
    $response_data["msg"] = "Successful!";
  }

  if($post_format_words=='array'){
    print_r($response_data);
  }else{
    print_r(json_encode($response_data,JSON_UNESCAPED_UNICODE));
  }
?>