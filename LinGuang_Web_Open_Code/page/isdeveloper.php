<?php
session_start();
if(!isset($_SESSION["userinfo"])){
  header("location: ./login.php");
  die();
}

$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
$userinfo = $_SESSION["userinfo"];
$user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];
//print_r($user);
//print_r($_SESSION);

if($user["status"]==0){
  header("location: ./developer.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼光</title>
    <link rel="icon" href="../src/favicon.png">
    <link rel="stylesheet" href="https://unpkg.com/mdui@2.0.3/mdui.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
    <script src="https://unpkg.com/mdui@2.0.3/mdui.global.js"></script>
    <style>
      a {
        text-decoration: none;
        border-bottom: 1.25px solid transparent;
      }

      a:hover {
        border-bottom: 1.25px solid rgb(108, 28, 108);
        transition: border-bottom 0.9s ease;
      }

      /* 状态一: 未被访问过的链接 */
      a:link {
        text-decoration: none;
        color: #000;
      }

      /* 状态二: 已经访问过的链接 */
      a:visited {
        text-decoration: none;
        color: #000;
      }

      /* 状态三: 鼠标划过(停留)的链接(默认红色) */
      a:hover {
        text-decoration: none;
        color: #000;
      }

      /* 状态四: 被点击的链接 */
      a:active {
        text-decoration: none;
        color: #000;
      }

      .search-btn:hover {
        transition: all .3s ease-in-out;
      }

      .search-btn:hover {
        width: 100px;
      }

      .text-title {
        font-size: 22px;
        font-weight: 400;
      }
    </style>
  </head>

  <body style="text-align:center;">
    <div style="text-align: left;">
      <div style="margin-top: 100px;">

      </div>
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 5%; margin-top: 40px;opacity: 0;transition: opacity 1.5s; " id="page_title">
          <?php echo($user["username"]); ?>，欢迎加入！
        </h1>


        <text
          style="margin-left: 5%; margin-right: 5%; margin-top: 0px;font-size: 24px;opacity: 0;transition: opacity 3s; display: block;"
          id="welcome_text1">
          感谢您对粼光建设的贡献，期待遇到更多您分享的优质作品
        </text>
        <br>
        <br>

      </div>

      <div style="opacity: 0;transition: opacity 1.5s;" id="funBar">
        <div style="width: 100%;text-align: center;">
          <mdui-button icon="auto_awesome--rounded" variant="tonal" id="societyBtn"
            style="margin-top: 20px;">加入开发者社区</mdui-button>
          <mdui-button icon="attach_file--rounded" end-icon="arrow_forward" id="shareAppBtn"
            style="margin-top: 20px;margin-left: 20px;">分享应用</mdui-button>
        </div>
        <div style="width: 100%;text-align: center;margin-top: 0px;">
          <mdui-button icon="keyboard_backspace--rounded" variant="text" id="returnBtn"
            style="margin-top: 20px;">返回个人中心</mdui-button>

        </div>
      </div>
    </div>


    <script>
      var page_title = document.getElementById("page_title");
      var welcome_text1 = document.getElementById("welcome_text1");
      // var welcome_text2 = document.getElementById("welcome_text2");
      // var welcome_text3 = document.getElementById("welcome_text3");
      // var welcome_text4 = document.getElementById("welcome_text4");
      // var welcome_text5 = document.getElementById("welcome_text5");
      var funBar = document.getElementById("funBar");

      setTimeout(function () {
        page_title.style.opacity = 1;
        setTimeout(function () {
          welcome_text1.style.opacity = 1;
          setTimeout(function () {
            funBar.style.opacity = 1;
          }, 1000);
        }, 1000);
      }, 100);

      var societyBtn = document.getElementById("societyBtn");
      var shareAppBtn = document.getElementById("shareAppBtn");
      var returnBtn = document.getElementById("returnBtn");

      shareAppBtn.addEventListener("click", function () {
        location.href = "../page/upload_app.php";
      });
      returnBtn.addEventListener("click", function () {
        location.href = "../page/user_center.php";
      });

    </script>
  </body>
  <?php
  require("../page/footer.php");
  ?>

</html>