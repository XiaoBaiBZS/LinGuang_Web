<?php
  session_start();
  //print_r($user);
/*

if(!isset($_SESSION["userinfo"])){
  header("location= ./login.php?end_url=./upload_app.php");
  die();
}

*/
  if(!isset($_SESSION["userinfo"])){
    header("location: ./login.php");
    die();
  }

  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
  $userinfo = $_SESSION["userinfo"];
  $user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];

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
    <title>粼光-应用管理</title>
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

      .app-name {
        font-size: 24px;
        font-weight: 800;
      }

      .app-one-sentence-introduction {
        font-size: 18px;
        color: gray;
      }
    </style>
  </head>

  <body style="text-align:center;">
    <div style="text-align: left;">
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 5%; float: left;margin-top: 40px; " id="page_title">应用更新</h1>
      </div>
    </div>
    <div id="app_list"></div>



    <script>
      var data_post = JSON.stringify({ a: '1', b: '2' });
      // fetch请求
      var url = `../api/api_searchApp.php?key=<?php echo($user['id']); ?>&type=AppUpUserId`;
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
            data = data.data;
            for (let i = 0; i < data.length; i++) {
              //console.log(data[i]);
              var AppName = data[i]["AppName"];
              var AppNewVersion = data[i]["AppNewVersion"];
              var AppId = data[i]["AppId"];
              var OnloadDate = data[i]["OnloadDate"];
              var UpdateDate = data[i]["UpdateDate"];
              if (UpdateDate == null || UpdateDate == '') {
                UpdateDate = OnloadDate;
              }
              var app_list = document.getElementById('app_list');
              app_list.innerHTML += `
              <mdui-card
      style="width: 90%; margin-left: 5%;margin-right: 5%;padding-top: 10px;padding-bottom: 10px;margin-bottom: 20px;"
      clickable align="left" onclick="location.href='../page/update_app.php?AppId=${AppId}'">
      <text style="font-size: 20px;font-weight: 800; margin-left: 20px;">${AppName}</text>
      <text style="font-size: 16px; margin-left: 20px;color: gray;">${AppNewVersion}</text>
      <br>

      <mdui-chip disabled style="margin-left: 20px;margin-top: 7px;">${UpdateDate}更新</mdui-chip>

    </mdui-card>
              `;

            }
          }
        })
        .catch(error => {
          //异常处理
          console.log("error: ", error);
        })
    </script>
  </body>
  <?php
  require("../page/footer.php");
    ?>


</html>