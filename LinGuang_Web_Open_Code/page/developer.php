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

if($user["status"]==1||$user["status"]==2){
  header("location: ./isdeveloper.php");
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
          你好，<?php echo($user["username"]); ?>！
        </h1>


        <text
          style="margin-left: 5%; margin-top: 0px;font-size: 24px;opacity: 0;transition: opacity 3s; display: block;"
          id="welcome_text1">
          准备好成为粼光认证开发者了吗？
        </text>
        <br>
        <br>
        <text
          style="margin-left: 5%; margin-top: 0px;font-size: 22px;opacity: 0;transition: opacity 3s; display: block;font-weight: 700;"
          id="welcome_text2">
          发现优质应用
        </text>
        <br>
        <text
          style="margin-left: 5%; margin-top: 0px;font-size: 22px;opacity: 0;transition: opacity 3s; display: block; font-weight: 700;"
          id="welcome_text3">
          并且乐于分享
        </text>
        <br>
        <text
          style="margin-left: 5%; margin-top: 0px;font-size: 22px;opacity: 0;transition: opacity 3s; display: block;font-weight: 700;"
          id="welcome_text4">
          亦或是推广你的作品
        </text>
        <br>
        <text
          style="margin-left: 5%; margin-top: 0px;font-size: 22px;opacity: 0;transition: opacity 3s; display: block;font-weight: 700;"
          id="welcome_text5">
          ......
        </text>
      </div>

      <div style="opacity: 0;transition: opacity 1.5s;" id="funBar">
        <mdui-checkbox style="margin-left: 5%;margin-right: 5%;margin-top: 20px;width: 90%;" id="check">
          <p><b>我已阅读并同意《粼光认证开发者协议》，</b>确认后您将成为粼光建设的一员，推广和分享您发现的优质应用。</p>
        </mdui-checkbox>
        <div style="width: 100%;text-align: center;">
          <mdui-button icon="verified_user--rounded" disabled end-icon="arrow_forward" id="becomeDeveloperBtn"
            style="margin-top: 20px;">成为粼光认证开发者</mdui-button>
        </div>
      </div>
    </div>


    <script>
      var page_title = document.getElementById("page_title");
      var welcome_text1 = document.getElementById("welcome_text1");
      var welcome_text2 = document.getElementById("welcome_text2");
      var welcome_text3 = document.getElementById("welcome_text3");
      var welcome_text4 = document.getElementById("welcome_text4");
      var welcome_text5 = document.getElementById("welcome_text5");
      var funBar = document.getElementById("funBar");

      setTimeout(function () {
        page_title.style.opacity = 1;
        setTimeout(function () {
          welcome_text1.style.opacity = 1;
          setTimeout(function () {
            welcome_text2.style.opacity = 1;
            setTimeout(function () {
              welcome_text3.style.opacity = 1;
              setTimeout(function () {
                welcome_text4.style.opacity = 1;
                setTimeout(function () {
                  welcome_text5.style.opacity = 1;
                  setTimeout(function () {
                    funBar.style.opacity = 1;
                  }, 2000);
                }, 2000);
              }, 2000);
            }, 2000);
          }, 2000);
        }, 2000);
      }, 100);

      var check = document.getElementById("check");
      var becomeDeveloperBtn = document.getElementById("becomeDeveloperBtn");

      check.addEventListener("click", function () {
        if (!check.checked) {
          becomeDeveloperBtn.disabled = false;
        } else {
          becomeDeveloperBtn.disabled = true;
        }
      });

      becomeDeveloperBtn.addEventListener("click", function () {
        var data_post = JSON.stringify({ id: '<?php echo($userinfo["id"]);?>' });
        // fetch请求
        var url = "../api/api_setDeveloper.php";
        fetch(url, {
          method: "POST",
          body: data_post,
        })
          .then(response => response.json())
          .then(data => {
            //console.log(data);
            if (data.code !== 1) {
              //未能成功
              alert(data.message);
              console.log(data);
            } else {
              //成功请求
              location.href = "../page/isdeveloper.php";
            }
          })
          .catch(error => {
            //异常处理
            console.log("error: ", error);
          })
      });
    </script>
  </body>
  <?php
  require("../page/footer.php");
  ?>

</html>